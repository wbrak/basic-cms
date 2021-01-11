<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Config;
use App\Models\Category;

/**
 * Class CategoryController
 * @package App\Http\Controllers\Admin
 */
class CategoryController extends Controller
{
    /**
     * CategoryController constructor.
     */
    public function __construct(){
    	$this->middleware('auth');
    	$this->middleware('user.status');
        $this->middleware('user.permissions');
    	$this->middleware('isadmin');
    }

    /**
     * @param $module
     * @return Factory|View
     */
    public function getAllCategories($module)
    {
        $categories = Category::where('module', $module)->orderBy('name', 'Asc')->get();
        $data = ['categories' => $categories];
    	return view('admin.categories.home', $data);
    }

    /**
     * @param $id
     * @return Factory|View
     */
    public function getCategoryEdit($id)
    {
        $category = Category::findOrFail($id);
        $data = ['category' => $category];
        return view('admin.categories.edit', $data);
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function postCategoryEdit(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if($validator->fails()):
            return back()->with('errors', $validator->messages()->all()[0])->withInput();
        else:
            $category = Category::find($id);
            $category->module = $request->input('module');
            $category->name = e($request->input('name'));
            $category->slug = Str::slug($request->input('name'));
            if($request->hasFile('icon')):
                $actual_icon = $category->icono;
                $actual_file_path = $category->file_path;
                $path = '/'.date('Y-m-d');
                $fileExt = trim($request->file('icon')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.categories.root');
                $name = Str::slug(str_replace($fileExt, '', $request->file('icon')->getClientOriginalName()));
                $filename = rand(1,999).'_'.$name.'.'.$fileExt;
                $fl = $request->icon->storeAs($path, $filename, 'categories');
                $category->file_path = date('Y-m-d');
                $category->icono = $filename;
                if(!is_null($actual_icon)):
                    unlink($upload_path.'/'.$actual_file_path.'/'.$actual_icon);
                endif;
            endif;
            if($category->save()):
                Alert::success(Lang::get('Category Updated'), Lang::get('The category has been updated successfully'));
                Log::info(Lang::get('Updated category by Admin:'), ['admin' => Auth::id()]);
                return back();
            endif;
        endif;
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function postCategoryAdd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'icon' => 'required'
        ]);

        if ($validator->fails()):
            return back()->with('errors', $validator->messages()->all()[0])->withInput();
        else:
            $path = '/'.date('Y-m-d');
            $fileExt = trim($request->file('icon')->getClientOriginalExtension());
            $upload_path = Config::get('filesystems.disks.categories.root');
            $name = Str::slug(str_replace($fileExt, '', $request->file('icon')->getClientOriginalName()));
            $filename = rand(1,999).'_'.$name.'.'.$fileExt;

            $category = new Category;
            $category->module = $request->input('module');
            $category->name = e($request->input('name'));
            $category->slug = Str::slug($request->input('name'));
            $category->file_path = date('Y-m-d');
            $category->icono = $filename;
            if($category->save()):
                if($request->hasFile('icon')):
                    $fl = $request->icon->storeAs($path, $filename, 'categories');
                endif;
                Alert::success(Lang::get('Category Created'), Lang::get('The category has been created successfully'));
                Log::info(Lang::get('Created category by Admin:'), ['admin' => Auth::id()]);
                return back();
            endif;
        endif;
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function deleteCategory($id)
    {
        $category = Category::findOrfail($id);
        if($category->delete()):
            Alert::success(Lang::get('Category Deleted'), Lang::get('The category has been deleted successfully'));
            Log::info(Lang::get('Delete category by Admin:'), ['admin' => Auth::id()]);
            return back();
        endif;
    }
}
