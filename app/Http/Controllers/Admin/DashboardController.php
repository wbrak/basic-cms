<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Post;
use App\Models\Page;
use App\Models\Comment;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Admin
 */
class DashboardController extends Controller
{
    /**
     * DashboardController constructor.
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
    public function getDashboard()
    {
    	$users = User::all()->count();
        $usersVerified = User::where('confirmed', '1')->count();
        $usersNoVerified = User::where('status', '0')->count();
        $usersBanned = User::where('status' , '100')->count();
    	$posts = Post::all()->count();
        $postsPublished = Post::where('status', '1')->count();
        $postsDraft = Post::where('status', '0')->count();
        $pages = Page::all()->count();
        $pagesPublished = Page::where('status', '1')->count();
        $pagesDraft = Page::where('status', '0')->count();
        $comments = Comment::all()->count();
        $commentsPublished = Comment::where('status', '1')->count();
        $commentsApproved = Comment::where('status', '0')->count();

        $users = array($users);
        $usersVerified = array($usersVerified);
        $usersNoVerified = array($usersNoVerified);
        $usersBanned = array($usersBanned);
        $posts = array($posts);
        $postsPublished = array($postsPublished);
        $postsDraft = array($postsDraft);
        $pages = array($pages);
        $pagesPublished = array($pagesPublished);
        $pagesDraft = array($pagesDraft);
        $comments = array($comments);
        $commentsPublished = array($commentsPublished);
        $commentsApproved = array($commentsApproved);
        return view('admin.dashboard',['users' => $users, 'usersVerified' => $usersVerified, 'usersNoVerified' => $usersNoVerified,
                                            'usersBanned' => $usersBanned, 'posts' => $posts, 'postsPublished' => $postsPublished,
                                            'postsDraft' => $postsDraft, 'pages' => $pages, 'pagesPublished' => $pagesPublished,
                                            'pagesDraft' => $pagesDraft, 'comments' => $comments, 'commentsPublished' => $commentsPublished,
                                            'commentsApproved' => $commentsApproved]);
    }

}
