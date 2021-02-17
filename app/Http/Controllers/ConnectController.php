<?php

namespace App\Http\Controllers;

use App\Events\NewUserRegistered;
use App\Events\UserLogin;
use App\Events\UserNewPassword;
use App\Events\UserRecoverPassword;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * Class ConnectController
 * @package App\Http\Controllers
 */
class ConnectController extends Controller
{
    /**
     * ConnectController constructor.
     */
    public function __construct()
    {
		$this->middleware('guest')->except(['getLogout']);
	}

    /**
     * @return Factory|View
     */
    public function getFormLogin()
    {
    	return view('connect.login');
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function postFormLogin(Request $request)
    {
        $rules = [
            'email'    => 'required|email',
            'password' => 'required|min:8'
        ];

        $messages = [
            'email.required'    => Lang::get('E-Mail Address is required'),
            'email.email'       => Lang::get('The email format is invalid'),
            'password.required' => Lang::get('Password is required'),
            'password.min'      => Lang::get('Password must be at least 8 characters long')
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', Lang::get('An error has occurred'))
                ->with('typealert', 'danger');
        else:
            if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], true)):
                if(Auth::user()->status == "100"):
                    Log::info(Lang::get('Banned user tried to access'), ['User Email' => $request->input('email')]);
                    return redirect('/logout');
                elseif(Auth::user()->role > "1"):
                    Log::info(Lang::get('An administrator logged in'), ['Admin Email' => $request->input('email')]);
                    event(new UserLogin(Auth::user()));
                    return redirect('/admin');
                elseif(Auth::user()->status == "0"):
                    Log::info(Lang::get('Unverified user tried to access'), ['User Email' => $request->input('email')]);
                    event(new UserLogin(Auth::user()));
                    return redirect('/logout');
                else:
                    Log::info(Lang::get('Verified user successfully logged in'), ['User Email' => $request->input('email')]);
                    event(new UserLogin(Auth::user()));
                    return redirect('/');
                endif;
            else:
                Log::error(Lang::get('User could not access'), ['User Email' => $request->input('email')]);
                return back()->with('message', Lang::get('Wrong email or password'))->with('typealert', 'danger');
            endif;
        endif;
    }

    /**
     * @return Factory|View
     */
    public function getFormRegister()
    {
    	return view('connect.register');
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function postFormRegister(Request $request)
    {
        $rules = [
            'name'             => 'required',
            'email'            => 'required|email|unique:users,email',
            'password'         => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password'
        ];

        $messages = [
            'name.required'             => Lang::get('Name is required'),
            'email.required'            => Lang::get('E-Mail Address is required'),
            'email.email'               => Lang::get('The email format is invalid'),
            'email.unique'              => Lang::get('There is already a registered user with this email'),
            'password.required'         => Lang::get('Password is required'),
            'password.min'              => Lang::get('Password must be at least 8 characters long'),
            'confirm_password.required' => Lang::get('Password needs to be confirmed'),
            'confirm_password.min'      => Lang::get('Password confirmation must be at least 8 characters long'),
            'confirm_password.same'     => Lang::get('Passwords do not match')
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', Lang::get('An error has occurred'))
                ->with('typealert', 'danger');
        else:
            $user                    = new User;
            $user->name              = e($request->input('name'));
            $user->email             = e($request->input('email'));
            $user->confirmation_code = Str::random(25);
            $user->password          = Hash::make($request->input('password'));

            if($user->save()):
                event(new NewUserRegistered($user));
                Log::notice(Lang::get('New user successfully registered '.$request->input('User Email')), ['name'  => $request->input('name')]);
                return redirect('/login')->with('message', Lang::get('User created successfully, we have sent a link to confirm the email'))
                                             ->with('typealert', 'success');
            endif;
        endif;
    }

    /**
     * @param $code
     * @return RedirectResponse|Redirector
     */
    public function getVerify($code)
    {
        $user = User::where('confirmation_code', $code)->first();

        if (! $user)
            return redirect('login')->with('message', Lang::get('Your email could not be confirmed'))
                                        ->with('typealert', 'danger');

        $user->status = "1";
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->confirmed = true;
        $user->confirmation_code = null;
        $user->save();
        Log::info(Lang::get('User verified his email'), ['User Email' => $user->email]);
        return redirect('/login')->with('message', Lang::get('You have successfully confirmed your email, now you can log in!'))
                                     ->with('typealert', 'success');
    }

    /**
     * @return Factory|View
     */
    public function getFormRecover()
    {
        return view('connect.recover');
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse|Redirector
     */
    public function postFormRecover(Request $request)
    {
        $rules = [
            'email' => 'required|email'
        ];

        $messages = [
            'email.required' => Lang::get('E-Mail Address is required'),
            'email.email'    => Lang::get('The email format is invalid')
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', Lang::get('An error has occurred'))
                                                 ->with('typealert', 'danger');
        else:
            $user = User::where('email', $request->input('email'))->count();
            if($user == "1"):
                $user = User::where('email', $request->input('email'))->first();
                $code = rand(100000, 999999);
                $user = User::find($user->id);
                $user->password_code = $code;
                if($user->save()):
                    event(new UserRecoverPassword($user));
                    Log::info(Lang::get('Recovery code sent to user'), ['email' => $user->email]);
                    return redirect('/reset?email='.$user->email)->with('message', Lang::get('Enter the code that we have sent to the email'))
                                                                     ->with('typealert', 'success');
                endif;
            else:
                return back()->with('message', Lang::get('This email does not exist on our platform'))
                             ->with('typealert', 'danger');
            endif;
        endif;
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function getFormReset(Request $request)
    {
        $data = ['email' => $request->get('email')];
        return view('connect.reset', $data);
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse|Redirector
     */
    public function postFormReset(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'code'  => 'required'
        ];

        $messages = [
            'email.required' => Lang::get('E-Mail Address is required'),
            'email.email'    => Lang::get('The email format is invalid'),
            'code.required'  => Lang::get('Code recover is required')
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', Lang::get('An error has occurred'))
                                                 ->with('typealert', 'danger');
        else:
            $user = User::where('email', $request->input('email'))->where('password_code', $request->input('code'))->count();

            if($user == "1"):
                $user                = User::where('email', $request->input('email'))->where('password_code', $request->input('code'))->first();
                $new_password        = Str::random(8);
                $user->password      = Hash::make($new_password);
                $user->password_code = null;

                if($user->save()):
                    $data = ['name' => $user->name, 'password' => $new_password];
                    event(new UserNewPassword($user, $data));
                    Log::info(Lang::get('New password send to user'), ['email' => $user->email]);
                    return redirect('/login')->with('message', Lang::get('The password was reset successfully, we have sent an email with the new password to be able to log in'))
                                                 ->with('typealert', 'success');
                endif;
            else:
                return back()->with('message', Lang::get('The email or the recovery code is wrong'))
                             ->with('typealert', 'danger');
            endif;
        endif;
    }

    /**
     * @return RedirectResponse|Redirector
     */
    public function getLogout()
    {
        $status = Auth::user()->status;
        $email = Auth::user()->email;
        Auth::logout();
        if($status == "100"):
            return redirect('/login')->with('message', Lang::get('Suspended user account'))
                                         ->with('typealert', 'danger');
        elseif($status == "0"):
            return redirect('/login')->with('message', Lang::get('Email not verified'))
                                         ->with('typealert', 'danger');
        else:
            Log::info(Lang::get('User logout'), ['email' => $email]);
            return redirect('/');
        endif;
    }
}
