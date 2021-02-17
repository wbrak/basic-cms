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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use App\Models\Post;
use App\Models\Category;

/**
 * Class PostController
 * @package App\Http\Controllers\Admin
 */
class PostController extends Controller
{
    /**
     * PostController constructor.
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
    public function getAllPosts()
    {
        $posts = Post::orderBy('created_at', 'Desc')->paginate(4);
        $data = ['posts' => $posts];
        return view('admin.posts.home', $data);
    }

    /**
     * @param $id
     * @return Factory|View
     */
    public function getPostDetail($id)
    {
        $post = Post::findOrfail($id);
        $data = ['post' => $post];
        return view('admin.posts.detail', $data);
    }

    /**
     * @param $id
     * @return Factory|View
     */
    public function getPostEdit($id)
    {
        $post = Post::findOrfail($id);
        $cats = Category::where('module', '0')->pluck('name', 'id');
        $data = ['cats' => $cats, 'post' => $post];
        return view('admin.posts.edit', $data);
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function postPostEdit(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title'            => 'required',
            'category'         => 'required',
            'meta_keywords'    => 'required',
            'meta_description' => 'required',
            'status'           => 'required',
            'short'            => 'required',
            'content'          => 'required'
        ]);

        if($validator->fails()):
            return back()->with('errors', $validator->messages()->all()[0])->withInput();
        else:
            $post = Post::findOrfail($id);
            $ipp = $post->file_path;
            $ip = $post->image;
            $post->status = $request->input('status');
            $post->title = e($request->input('title'));
            $post->slug = Str::slug($request->input('title'));
            $post->content = $request->input('content');
            $post->short = e($request->input('short'));
            $post->category = $request->input('category');
            if($request->hasFile('img')):
                $path = '/'.date('Y-m-d');
                $fileExt = trim($request->file('img')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.posts.root');
                $name = Str::slug(str_replace($fileExt, '', $request->file('img')->getClientOriginalName()));

                $filename = rand(1,999).'-'.$name.'.'.$fileExt;
                $file_file = $upload_path.'/'.$path.'/'.$filename;
                $post->file_path = date('Y-m-d');
                $post->image = $filename;
            endif;
            $post->meta_keywords = $request->input('meta_keywords');
            $post->meta_description = $request->input('meta_description');

            if($post->save()):
                if($request->hasFile('img')):
                    $fl = $request->img->storeAs($path, $filename, 'posts');
                    $img = Image::make($file_file);
                    $img->resize(300, 300, function($constraint){
                        $constraint->upsize();
                    });
                    $img->save($upload_path.'/'.$path.'/t_'.$filename);
                    unlink($upload_path.'/'.$ipp.'/'.$ip);
                    unlink($upload_path.'/'.$ipp.'/t_'.$ip);
                endif;
                Alert::success(Lang::get('Post Updated'), Lang::get('The post has updated successfully'));
                Log::info(Lang::get('Updated post by Admin: '), ['Admin Id' => Auth::user()->getAuthIdentifier()]);
                return back();
            endif;
        endif;
    }

    /**
     * @return Factory|View
     */
    public function getPostAdd()
    {
        $cats = Category::where('module', '0')->pluck('name', 'id');
        $data = ['cats' => $cats];
        return view('admin.posts.add', $data);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function postPostAdd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'            => 'required',
            'img'              => 'required',
            'category'         => 'required',
            'meta_keywords'    => 'required',
            'meta_description' => 'required',
            'short'            => 'required',
            'content'          => 'required'
        ]);

        if ($validator->fails()):
            return back()->with('errors', $validator->messages()->all()[0])->withInput();
        else:
            $path = '/'.date('Y-m-d');
            $fileExt = trim($request->file('img')->getClientOriginalExtension());
            $upload_path = Config::get('filesystems.disks.posts.root');
            $name = Str::slug(str_replace($fileExt, '', $request->file('img')->getClientOriginalName()));

            $filename = rand(1,999).'-'.$name.'.'.$fileExt;
            $file_file = $upload_path.'/'.$path.'/'.$filename;

            $post = new Post;
            $post->status = $request->input('status');
            $post->title = e($request->input('title'));
            $post->slug = Str::slug($request->input('title'));
            $post->user_id = Auth::id();
            $post->content = $request->input('content');
            $post->short = e($request->input('short'));
            $post->category = e($request->input('category'));
            $post->file_path = date('Y-m-d');
            $post->image = $filename;
            $post->meta_keywords = e($request->input('meta_keywords'));
            $post->meta_description = e($request->input('meta_description'));
            $post->robots = $request->input('robots');
            $post->links = $request->input('links');

            if($post->save()):
                if($request->hasFile('img')):
                    $fl = $request->img->storeAs($path, $filename, 'posts');
                    $img = Image::make($file_file);
                    $img->resize(300, 300, function($constraint){
                        $constraint->upsize();
                    });
                    $img->save($upload_path.'/'.$path.'/t_'.$filename);
                endif;
                Alert::success(Lang::get('Post Created'), Lang::get('The post has created successfully'));
                Log::info(Lang::get('Created post by Admin: '), ['Admin Id' => Auth::user()->getAuthIdentifier()]);
                return redirect('admin/posts');
            endif;
        endif;
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function deletePost($id)
    {
        $post = Post::findOrfail($id);
        if($post->delete()):
            Alert::success(Lang::get('Post Delete'), Lang::get('The selected post has been successfully removed'));
            Log::info(Lang::get('Delete post by Admin: '), ['Admin Id' => Auth::user()->getAuthIdentifier()]);
            return back();
        endif;
    }
}
