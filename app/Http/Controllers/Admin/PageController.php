<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Auth;
use App\Models\Page;
use App\Models\Category;

/**
 * Class PageController
 * @package App\Http\Controllers\Admin
 */
class PageController extends Controller
{
    /**
     * PageController constructor.
     */
     public function __construct(){
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('isadmin');
    }

    /**
     * @return Factory|View
     */
    public function getAllPages()
    {
    	$pages = Page::orderBy('id', 'Desc')->paginate(10);
    	$data = ['pages' => $pages];
    	return view('admin.pages.home', $data);
    }

    /**
     * @param $id
     * @return Factory|View
     */
    public function getPageDetail($id)
    {
        $page = Page::findOrfail($id);
        $data = ['page' => $page];
        return view('admin.pages.detail', $data);
    }

    /**
     * @param $id
     * @return Factory|View
     */
    public function getPageEdit($id)
    {
        $page = Page::findOrfail($id);
        $cats = Category::where('module', '1')->pluck('name', 'id');
        $data = ['cats' => $cats, 'page' => $page];
        return view('admin.pages.edit', $data);
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function postPageEdit(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
    		'title'            => 'required',
            'category'         => 'required',
    		'short'            => 'required',
    		'content'          => 'required',
            'meta_keywords'    => 'required',
            'meta_description' => 'required',
            'links'            => 'required',
            'robots'           => 'required'
    	]);

    	if($validator->fails()):
    		return back()->with('errors', $validator->messages()->all()[0])->withInput();
    	else:
    		$page = Page::findOrfail($id);
            $ipp = $page->file_path;
            $ip = $page->image;
            $page->status = e($request->input('status'));
    		$page->title = e($request->input('title'));
    		$page->slug = Str::slug($request->input('title'));
    		$page->category = e($request->input('category'));
    		$page->content = $request->input('content');
            $page->meta_keywords = $request->input('meta_keywords');
            $page->meta_description = $request->input('meta_description');
            $page->links = $request->input('links');
            $page->robots = $request->input('robots');
    		$page->short = e($request->input('short'));
            if($request->hasFile('img')):
                $path = '/'.date('Y-m-d');
                $fileExt = trim($request->file('img')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.pages.root');
                $name = Str::slug(str_replace($fileExt, '', $request->file('img')->getClientOriginalName()));

                $filename = rand(1,999).'-'.$name.'.'.$fileExt;
                $file_file = $upload_path.'/'.$path.'/'.$filename;
                $page->file_path = date('Y-m-d');
                $page->image = $filename;
            endif;

    		if($page->save()):
                if($request->hasFile('img')):
                    $fl = $request->img->storeAs($path, $filename, 'pages');
                    $img = Image::make($file_file);
                    $img->resize(300, 300, function($constraint){
                        $constraint->upsize();
                    });
                    $img->save($upload_path.'/'.$path.'/t_'.$filename);
                    unlink($upload_path.'/'.$ipp.'/'.$ip);
                    unlink($upload_path.'/'.$ipp.'/t_'.$ip);
                endif;
                Alert::success(Lang::get('Page Updated'), Lang::get('The page has updated successfully'));
                Log::info(Lang::get('Updated page by Admin: '), ['Admin Id' => Auth::user()->getAuthIdentifier()]);
    			return back();
    		endif;
    	endif;
    }

    /**
     * @return Factory|View
     */
    public function getPageAdd()
    {
        $cats = Category::where('module', '1')->pluck('name', 'id');
        $data = ['cats' => $cats];
        return view('admin.pages.add', $data);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function postPageAdd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'            => 'required',
            'category'         => 'required',
            'short'            => 'required',
            'content'          => 'required',
            'img'              => 'required',
            'meta_keywords'    => 'required',
            'meta_description' => 'required',
            'links'            => 'required',
            'robots'           => 'required'
        ]);

        if($validator->fails()):
            return back()->with('errors', $validator->messages()->all()[0])->withInput();
        else:
            $path = '/'.date('Y-m-d');
            $fileExt = trim($request->file('img')->getClientOriginalExtension());
            $upload_path = Config::get('filesystems.disks.pages.root');
            $name = Str::slug(str_replace($fileExt, '', $request->file('img')->getClientOriginalName()));

            $filename = rand(1,999).'-'.$name.'.'.$fileExt;
            $file_file = $upload_path.'/'.$path.'/'.$filename;

            $page = new Page;
            $page->status = '0';
            $page->user_id = Auth::id();
            $page->title = e($request->input('title'));
            $page->slug = Str::slug($request->input('title'));
            $page->category = e($request->input('category'));
            $page->file_path = date('Y-m-d');
            $page->image = $filename;
            $page->content = $request->input('content');
            $page->short = e($request->input('short'));
            $page->meta_keywords = e($request->input('meta_keywords'));
            $page->meta_description = e($request->input('meta_description'));
            $page->links = e($request->input('links'));
            $page->robots = e($request->input('robots'));

            if($page->save()):
                if($request->hasFile('img')):
                    $fl = $request->img->storeAs($path, $filename, 'pages');
                    $img = Image::make($file_file);
                    $img->resize(300, 300, function($constraint){
                        $constraint->upsize();
                    });
                    $img->save($upload_path.'/'.$path.'/t_'.$filename);
                endif;
                Alert::success(Lang::get('Page Created'), Lang::get('The page has created successfully'));
                Log::info(Lang::get('Created page by Admin: '), ['Admin Id' => Auth::user()->getAuthIdentifier()]);
                return redirect('admin/pages');
            endif;
        endif;
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function deletePage($id)
    {
        $page = Page::findOrfail($id);
        if($page->delete()):
            Alert::success(Lang::get('Page Deleted'), Lang::get('The page has deleted successfully'));
            Log::info(Lang::get('Delete page by Admin: '), ['Admin Id' => Auth::user()->getAuthIdentifier()]);
            return back();
        endif;
    }
}
