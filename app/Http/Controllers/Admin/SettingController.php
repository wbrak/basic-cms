<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Config;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Lang;

/**
 * Class SettingController
 * @package App\Http\Controllers\Admin
 */
class SettingController extends Controller
{
    /**
     * SettingController constructor.
     */
    public function __construct()
    {
    	$this->middleware('auth');
    	$this->middleware('user.status');
        $this->middleware('user.permissions');
    	$this->middleware('isadmin');
    }

    /**
     * @return Factory|View
     */
    public function getSettings()
    {
        return view('admin.settings.home');
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function postSettings(Request $request)
    {
        if(!file_exists(config_path().'/company.php')):
            fopen(config_path().'/company.php', 'w');
        endif;

        $file = fopen(config_path().'/company.php', 'w');
        fwrite($file, '<?php'.PHP_EOL);
        fwrite($file, 'return ['.PHP_EOL);
        foreach ($request->except(['_token']) as $key => $value):
            if(is_null($value)):
                fwrite($file, '\''.$key.'\' => null,' .PHP_EOL);
            else:
                fwrite($file, '\''.$key.'\' => \''.$value.'\',' .PHP_EOL);
            endif;
        endforeach;
        fwrite($file, ']'.PHP_EOL);
        fwrite($file, '?>'.PHP_EOL);
        fclose($file);

        Alert::success(Lang::get('Updated Settings'), Lang::get('Settings were updated successfully'));
        Log::info(Lang::get('Updated settings by Admin:'), ['admin' => Auth::id()]);
        return redirect('admin');
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function postSettingsLogo(Request $request)
    {
        $path = '/';
        $fileExt = 'png';
        $upload_path = Config::get('filesystems.disks.public.root');
        $name = 'logo';

        $filename = $name.'.'.$fileExt;
        $file_file = $upload_path.'/'.$path.'/'.$filename;
        if($request->hasFile('logo')):
            $fl = $request->logo->storeAs($path, $filename, 'public');
            $img = Image::make($file_file);
            $img->resize(500, 125, function($constraint){
                $constraint->upsize();
            });
            $img->save($upload_path.'/'.$path.'/'.$filename);
        endif;
        Alert::success(Lang::get('Updated Settings'), Lang::get('Logo were updated successfully'));
        Log::info(Lang::get('Updated logo by Admin:'), ['admin' => Auth::id()]);
        return redirect('admin');
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function postSettingsFaviconAdmin(Request $request)
    {
        $path = '/';
        $fileExt = 'ico';
        $upload_path = Config::get('filesystems.disks.public.root');
        $name = 'faviconAdmin';

        $filename = $name.'.'.$fileExt;
        $file_file = $upload_path.'/'.$path.'/'.$filename;
        if($request->hasFile('faviconAdmin')):
            $fl = $request->faviconAdmin->storeAs($path, $filename, 'public');
        endif;
        Alert::success(Lang::get('Updated Settings'), Lang::get('Favicon were updated successfully'));
        Log::info(Lang::get('Updated favicon by Admin:'), ['admin' => Auth::id()]);
        return redirect('admin');
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function postSettingsFavicon(Request $request)
    {
        $path = '/';
        $fileExt = 'ico';
        $upload_path = Config::get('filesystems.disks.public.root');
        $name = 'favicon';

        $filename = $name.'.'.$fileExt;
        $file_file = $upload_path.'/'.$path.'/'.$filename;
        if($request->hasFile('favicon')):
            $fl = $request->favicon->storeAs($path, $filename, 'public');
        endif;
        Alert::success(Lang::get('Updated Settings'), Lang::get('Favicon were updated successfully'));
        Log::info(Lang::get('Updated favicon by Admin:'), ['admin' => Auth::id()]);
        return redirect('admin');
    }

    /**
     * @param $lang
     * @return RedirectResponse
     */
    public function swap($lang)
    {
        // Almacenar el lenguaje en la session
        session()->put('locale', $lang);
        Alert::success(Lang::get('Updated Settings'), Lang::get('Language were updated successfully'));
        Log::info(Lang::get('Updated language by Admin:'), ['admin' => Auth::id()]);
        return redirect()->back();
    }
}
