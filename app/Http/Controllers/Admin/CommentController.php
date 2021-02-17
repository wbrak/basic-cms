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
use Illuminate\Support\Facades\Lang;
use App\Models\Comment;

/**
 * Class CommentController
 * @package App\Http\Controllers\Admin
 */
class CommentController extends Controller
{
    /**
     * CommentController constructor.
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
    public function getAllComments()
    {
    	$comments = Comment::orderBy('id', 'desc')->paginate(10);
    	$data = ['comments' => $comments];
    	return view('admin.comments.home', $data);
    }

    /**
     * @param $id
     * @return Factory|View
     */
    public function getCommentDetail($id){
        $comment = Comment::findOrfail($id);
        $data = ['comment' => $comment];
        return view('admin.comments.detail', $data);
    }

    /**
     * @param $id
     * @return Factory|View
     */
    public function getCommentEdit($id)
    {
        $comment = Comment::findOrfail($id);
        $data = ['comment' => $comment];
        return view('admin.comments.edit', $data);
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function postCommentEdit(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
    		'user_id'          => 'required',
    		'post_id'          => 'required',
            'meta_keywords'    => 'required',
            'meta_description' => 'required',
    		'comment'          => 'required'
    	]);

    	if($validator->fails()):
    		return back()->with('errors', $validator->messages()->all()[0])->withInput();
    	else:
    		$comment = Comment::findOrfail($id);
    		$comment->user_id = e($request->input('user_id'));
            $comment->status = e($request->input('status'));
    		$comment->post_id = e($request->input('post_id'));
            $comment->meta_keywords = e($request->input('meta_keywords'));
            $comment->meta_description = e($request->input('meta_description'));
    		$comment->comment = e($request->input('comment'));
            if($comment->save()):
                Alert::success(Lang::get('Comment Updated'), Lang::get('The comment has been updated successfully'));
                Log::info(Lang::get('Updated comment by Admin: '), ['Admin Id' => Auth::user()->getAuthIdentifier()]);
    			return back();
    		endif;
    	endif;
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function deleteComment($id){
        $comment = Comment::findOrfail($id);
        if($comment->delete()):
            Alert::success(Lang::get('Comment Deleted'), Lang::get('The comment has been deleted successfully'));
            Log::info(Lang::get('Delete comment by Admin: '), ['Admin Id' => Auth::user()->getAuthIdentifier()]);
            return back();
        endif;
    }
}
