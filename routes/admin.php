<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->group(function(){
    Route::get('/', [DashboardController::class, 'getDashboard'])->name('Dashboard');

	// Module Categories
    Route::get('/categories/{module}', [CategoryController::class, 'getAllCategories'])->name('Categories');
    Route::get('/category/{id}/edit', [CategoryController::class, 'getCategoryEdit'])->name('CategoryEdit');
    Route::post('/category/{id}/edit', [CategoryController::class, 'postCategoryEdit'])->name('CategoryEdit');
    Route::post('/category/add', [CategoryController::class, 'postCategoryAdd'])->name('CategoryAdd');
    Route::delete('/category/{id}/delete', [CategoryController::class, 'deleteCategory'])->name('CategoryDelete');

	// Module Posts
    Route::get('/posts', [PostController::class, 'getAllPosts'])->name('Posts');
    Route::get('/post/{id}/detail', [PostController::class, 'getPostDetail'])->name('PostDetail');
    Route::get('/post/{id}/edit', [PostController::class, 'getPostEdit'])->name('PostEdit');
    Route::post('/post/{id}/edit', [PostController::class, 'postPostEdit'])->name('PostEdit');
    Route::get('/post/add', [PostController::class, 'getPostAdd'])->name('PostAdd');
    Route::post('/post/add', [PostController::class, 'postPostAdd'])->name('PostAdd');
    Route::delete('/post/{id}/delete', [PostController::class, 'deletePost'])->name('PostDelete');

    // Module Pages
    Route::get('/pages', [PageController::class, 'getAllPages'])->name('Pages');
    Route::get('/page/{id}/detail', [PageController::class, 'getPageDetail'])->name('PageDetail');
    Route::get('/page/{id}/edit', [PageController::class, 'getPageEdit'])->name('PageEdit');
    Route::post('/page/{id}/edit', [PageController::class, 'postPageEdit'])->name('PageEdit');
    Route::get('/page/add', [PageController::class, 'getPageAdd'])->name('PageAdd');
    Route::post('/page/add', [PageController::class, 'postPageAdd'])->name('PageAdd');
    Route::delete('/page/{id}/delete', [PageController::class, 'deletePage'])->name('PageDelete');

	// Module Comments
    Route::get('/comments', [CommentController::class, 'getAllComments'])->name('Comments');
    Route::get('/comment/{id}/detail', [CommentController::class, 'getCommentDetail'])->name('CommentDetail');
    Route::get('/comment/{id}/edit', [CommentController::class, 'getCommentEdit'])->name('CommentEdit');
    Route::post('/comment/{id}/edit', [CommentController::class, 'postCommentEdit'])->name('CommentEdit');
    Route::delete('/comment/{id}/delete', [CommentController::class, 'deleteComment'])->name('CommentDelete');

    // Module Products
    Route::get('/products', [ProductController::class, 'getAllProducts'])->name('Products');
    Route::get('/product/{id}/detail', [ProductController::class, 'getProductDetail'])->name('ProductDetail');
    Route::get('/product/{id}/edit', [ProductController::class, 'getProductEdit'])->name('ProductEdit');
    Route::post('/product/{id}/edit', [ProductController::class, 'postProductEdit'])->name('ProductEdit');
    Route::get('/product/add', [ProductController::class, 'getProductAdd'])->name('ProductAdd');
    Route::post('/product/add', [ProductController::class, 'postProductAdd'])->name('ProductAdd');
    Route::post('/product/{id}/gallery/add', [ProductController::class, 'postProductGalleryAdd'])->name('ProductGalleryAdd');
    Route::get('/product/{id}/gallery/{gid}/delete', [ProductController::class, 'getProductGalleryDelete'])->name('ProductGalleryAdd');
    Route::delete('/product/{id}/delete', [ProductController::class, 'deleteProduct'])->name('ProductDelete');

	// Module Users
    Route::get('/users/{status}', [UserController::class, 'getAllUsers'])->name('Users');
    Route::get('/user/{id}/edit', [UserController::class, 'getUserEdit'])->name('UserEdit');
    Route::post('/user/{id}/edit', [UserController::class, 'postUserEdit'])->name('UserEdit');
    Route::get('/user/{id}/banned', [UserController::class, 'getUserBanned'])->name('UserBanned');
    Route::get('/user/{id}/permissions', [UserController::class, 'getUserPermissions'])->name('UserPermissions');
    Route::post('/user/{id}/permissions', [UserController::class, 'postUserPermissions'])->name('UserPermissions');
    Route::get('/user/profile', [UserController::class, 'getUserProfile'])->name('UserProfile');
    Route::post('/user/profile/avatar', [UserController::class, 'postUserProfileAvatar'])->name('UserProfileAvatar');
    Route::post('/user/profile/info', [UserController::class, 'postUserProfileInfo'])->name('UserProfileInfo');
    Route::post('/user/profile/password', [UserController::class, 'postUserProfilePassword'])->name('UserProfilePassword');
    Route::delete('/user/{id}/delete', [UserController::class, 'deleteUser'])->name('UserDelete');

	// Module Settings
    Route::get('/settings', [SettingController::class, 'getSettings'])->name('Settings');
    Route::post('/settings', [SettingController::class, 'postSettings'])->name('Settings');
    Route::post('/settings/logo', [SettingController::class, 'postSettingsLogo'])->name('SettingsLogo');
    Route::post('/settings/faviconAdmin', [SettingController::class, 'postSettingsFaviconAdmin'])->name('SettingsFaviconAdmin');
    Route::post('/settings/favicon', [SettingController::class, 'postSettingsFavicon'])->name('SettingsFavicon');
    Route::get('/settings/{lang}', [SettingController::class, 'swap'])->name('SettingsLang');

});
