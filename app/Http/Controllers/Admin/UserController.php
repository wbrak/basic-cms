<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Post;
use App\Models\Page;
use App\Models\Comment;

/**
 * Class UserController
 * @package App\Http\Controllers\Admin
 */
class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
    	$this->middleware('auth');
    	$this->middleware('user.status');
        $this->middleware('user.permissions');
    	$this->middleware('isadmin');
    }

    /**
     * @param $status
     * @return Factory|View
     */
    public function getAllUsers($status)
    {
    	if($status == 'all'):
    		$users = User::orderBy('id', 'Desc')->paginate(10);
    	else:
    		$users = User::where('status', $status)->orderBy('id', 'Desc')->paginate(10);
    	endif;
    	$data = ['users' => $users];
    	return view('admin.users.home', $data);
    }

    /**
     * @param $id
     * @return Factory|View
     */
    public function getUserEdit($id)
    {
    	$user     = User::findOrFail($id);
        $users    = Auth::id();
        $pages    = Page::orderBy('created_at', 'Desc')->where('user_id', $id)->limit('3')->get();
        $posts    = Post::orderBy('created_at', 'Desc')->where('user_id', $id)->limit('3')->get();
        $comments = Comment::orderBy('created_at', 'Desc')->where('user_id', $id)->limit('3')->get();
    	$data = ['user' => $user, 'users' => $users, 'posts' => $posts, 'pages' => $pages, 'comments' => $comments];
    	return view('admin.users.edit', $data);
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse|Redirector
     */
    public function postUserEdit(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->role = $request->input('role');
        if($request->input('role') != "0"):
            if(is_null($user->permissions)):
                $permissions = [
                    'Dashboard' => true
                ];
                $permissions = json_encode($permissions);
                $user->permissions = $permissions;
            endif;
        else:
            $user->permissions = null;
        endif;
        if($user->save()):
            if($request->input('role') >= "2"):
            Alert::success(Lang::get('Updated User'), Lang::get('The user role was updated successfully to Employee'));
            Log::info(Lang::get('Modified employee by'), ['admin' => Auth::user()->getAuthIdentifier()]);
            return redirect('/admin/user/'.$user->id.'/permissions');
            else:
                Alert::success(Lang::get('Updated User'), Lang::get('The user role was updated successfully'));
                return back();
            endif;
        endif;
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function getUserBanned($id)
    {
    	$user = User::findOrFail($id);
    	if($user->status == "100"):
    		$user->status = "1";
    		Alert::success(Lang::get('Updated User'), Lang::get('User reactivated successfully'));
            Log::info(Lang::get('User reactivated by'), ['admin' => Auth::user()->getAuthIdentifier()]);
    	else:
    		$user->status = "100";
    		Alert::warning(Lang::get('Updated User'), Lang::get('User suspended successfully'));
            Log::info(Lang::get('User suspended by'), ['admin' => Auth::user()->getAuthIdentifier()]);
    	endif;

    	if($user->save()):
    		return back();
    	endif;
    }

    /**
     * @param $id
     * @return Factory|View
     */
    public function getUserPermissions($id)
    {
        $user = User::findOrFail($id);
        $data = ['user' => $user];
        return view('admin.users.permissions', $data);
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function postUserPermissions(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->permissions = $request->except(['_token']);
        if($user->save()):
            Alert::success(Lang::get('Updated User'), Lang::get('User permissions were successfully updated'));
            Log::info(Lang::get('User permissions were updated by'), ['admin' => Auth::id()]);
            return back();
        endif;
    }

    /**
     * @return Factory|View
     */
    public function getUserProfile()
    {
        return view('admin.users.profile');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function postUserProfileAvatar(Request $request)
    {
        $rules = [
            'avatar' => 'required'
        ];

        $messages = [
            'avatar.required' => Lang::get('Select an image')
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            Alert::error(Lang::get('Avatar not Updated'), Lang::get('The profile avatar could not be updated'));
            return back();
        else:
            if($request->hasFile('avatar')):
                $path = '/'.Auth::id();
                $fileExt = trim($request->file('avatar')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.profiles.root');
                $name = Str::slug(str_replace($fileExt, '', $request->file('avatar')->getClientOriginalName()));

                $filename = rand(1,999).'_'.$name.'.'.$fileExt;
                $file_file = $upload_path.'/'.$path.'/'.$filename;

                $user = User::find(Auth::id());
                $act_avatar = $user->avatar;
                $user->avatar = $filename;

                if($user->save()):
                    if($request->hasFile('avatar')):
                        $fl = $request->avatar->storeAs($path, $filename, 'profiles');
                        $img = Image::make($file_file);
                        $img->resize(256, 256, function($constraint){
                            $constraint->upsize();
                        });
                        $img->save($upload_path.'/'.$path.'/av_'.$filename);
                    endif;
                    unlink($upload_path.'/'.$path.'/'.$act_avatar);
                    unlink($upload_path.'/'.$path.'/av_'.$act_avatar);
                    Alert::success(Lang::get('Avatar Uploaded'), Lang::get('The selected avatar was uploaded successfully'));
                    Log::info(Lang::get('Uploaded avatar Admin:'), ['admin' => Auth::id()]);
                    return back();
                endif;

            endif;
        endif;
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function postUserProfileInfo(Request $request)
    {
        $rules = [
            'name' => 'required'
        ];

        $messages = [
            'name.required' => Lang::get('Name is required')
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            Alert::error(Lang::get('Profile no Updated'), Lang::get('Profile data could not be updated'));
            return back();
        else:
            $user = User::find(Auth::id());
            $user->name = e($request->input('name'));
            $user->lastname = e($request->input('lastname'));
            if ($user->save()):
                Alert::success(Lang::get('Profile Updated'), Lang::get('The profile data was successfully updated'));
                Log::info(Lang::get('Updated profile data Admin:'), ['admin' => Auth::id()]);
                return back();
            endif;
        endif;
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function postUserProfilePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'apassword'  => 'required|min:8',
            'npassword'  => 'required|min:8',
            'cnpassword' => 'required|min:8|same:npassword'
    ]);

        if ($validator->fails()):
            return back()->with('errors', $validator->messages()->all()[0])->withInput();
        else:
            $user = User::find(Auth::id());
            if(Hash::check($request->input('apassword'), $user->password)):
                $user->password = Hash::make($request->input('npassword'));
                if ($user->save()):
                    Alert::success(Lang::get('Change of Password'), Lang::get('The password was updated successfully'));
                    Log::info(Lang::get('Updated password Admin:'), ['admin' => Auth::id()]);
                    return back();
                endif;
            else:
                Alert::error(Lang::get('Change of Password'), Lang::get('The current password is not correct'));
                return back();
            endif;
        endif;
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function deleteUser($id){
        $user = User::findOrfail($id);
        if($user->delete()):
            Alert::success(Lang::get('User Deleted'), Lang::get('The selected user was removed successfully'));
            Log::notice(Lang::get('User deleted by Admin:'), ['admin' => Auth::id()]);
            return back();
        endif;
    }
}
