<?php

use App\Http\Controllers\Admin\Clubs\ClubController;
use App\Http\Controllers\Admin\Clubs\MemberController;
use App\Http\Controllers\Admin\Clubs\PostController;
use App\Http\Controllers\Admin\Clubs\RecruitmentMemberController;
use App\Http\Controllers\Admin\Clubs\RequestClubController;
use App\Http\Controllers\Admin\Clubs\RoleController;
use App\Http\Controllers\Auth\AuthenticateController;
use App\Http\Controllers\CategoryPostController;
use App\Http\Controllers\Client\Club\ClientPostController;
use App\Http\Controllers\Client\Club\PageIndexController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

//route đăng nhâp sso
Route::get('/auth/redirect', [AuthenticateController::class, 'redirectToSSO'])->name('sso.redirect');
//Route::get('/auth/redirect', function (){
//    $user = User::query()->where('id',3
//    )->firstOrFail();
//    Auth::login($user);
//})->name('sso.redirect');
Route::get('/auth/callback', [AuthenticateController::class, 'handleSSOCallback'])->name('sso.callback');
Route::get('/logout', [AuthenticateController::class, 'logout'])->name('handelLogout');

//route client
Route::get('/',fn()=> view('client.pages.index'))->name('client.index');
Route::get('/danh-sach-cau-lac-bo', [PageIndexController::class, 'listClub'])->name('client.list-club');
Route::get('/cau-lac-bo/{id}',[PageIndexController::class, 'index'])->name('client.page-club');

Route::middleware('auth.sso')->group(function () {
    Route::get('tai-khoan/{item}', function ($item) {
        return view('client.pages.account',[
            'item' => $item,
        ]);
    })->name('client.account');

});
Route::get('/bai-viet', [ClientPostController::class, 'index'])->name('client.post');

Route::prefix('/cau-lac-bo/{id}')->group(function () {
    Route::get('/bai-viet', [ClientPostController::class, 'PostIndex'])->name('client.club.post');
    Route::get('/bai-viet/{slug}', [ClientPostController::class, 'PostDetail'])->name('client.club.post-detail');
});


//route super admin
Route::middleware('auth.sso')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::middleware('permission:Quản lý câu lạc bộ')->group(function () {
            Route::get('/club', [ClubController::class,'index'])->name('admin.club.index');
            Route::get('/club/detail/{id}', [ClubController::class,'detail'])->name('admin.club.detail');
            Route::get('/request-club', [RequestClubController::class,'requestClub'])->name('admin.request-club.list');
            Route::get('/request-club/detail/{id}', [RequestClubController::class,'detail'])->name('admin.request-club.detail');
        });


    });
});

//route admin club
Route::middleware('auth.sso')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.pages.dashboard');
        })->name('admin.dashboard');
        Route::post('/post/upload', [PostController::class, 'upload'])->name('admin.post.upload');

        Route::get('/club/list', [ClubController::class, 'listClub'])->name('admin.club.list-club');

        Route::middleware('permission.club:Quản lý thành viên')->group(function () {
            Route::get('/club/{id}/member', [MemberController::class, 'index'])->name('admin.club.member-index');
            Route::get('/club/{id}/member/{member_id}', [MemberController::class, 'detail'])->name('admin.club.member-detail');
        });

        Route::middleware('permission.club:Quản lý chức vụ')->group(function () {
            Route::get('/club/{id}/role', [RoleController::class, 'index'])->name('admin.club.role-index');
            Route::get('/club/{id}/role/create', [RoleController::class, 'create'])->name('admin.club.role-create');
            Route::get('/club/{id}/role/{role_id}', [RoleController::class, 'detail'])->name('admin.club.role-detail');
        });

        Route::middleware('permission.club:Tuyển thành viên')->group(function () {
            Route::get('/club/{id}/recruitment-member', [RecruitmentMemberController::class, 'index'])->name('admin.club.recruitment-member-index');
            Route::get('/club/{id}/recruitment-member/create', [RecruitmentMemberController::class, 'create'])->name('admin.club.recruitment-member-create');
            Route::get('/club/{id}/recruitment-member/{recruitment_id}', [RecruitmentMemberController::class, 'detail'])->name('admin.club.recruitment-member-detail');

            Route::get('/club/{id}/recruitment-member/{recruitment_id}/list-request', [RecruitmentMemberController::class, 'listRequest'])->name('admin.club.recruitment-member.list-request');
            Route::get('/club/{id}/recruitment-member/{recruitment_id}/list-request/{request_id}', [RecruitmentMemberController::class, 'detailRequest'])->name('admin.club.recruitment-member.detail-request');
        });

        Route::middleware('permission.club:Tạo bài viết mới')->group(function () {
            Route::get('/club/{id}/post', [PostController::class, 'index'])->name('admin.club.post-index');
            Route::get('/club/{id}/post/create', [PostController::class, 'create'])->name('admin.club.post-create');
            Route::get('/club/{id}/post/edit/{post_id}', [PostController::class, 'edit'])->name('admin.club.post-edit');
            Route::get('/club/{id}/post/{post_id}', [PostController::class, 'detail'])->name('admin.club.post-detail');

            Route::get('/club/{id}/category/post', [CategoryPostController::class, 'index'])->name('admin.club.category-post.index');
            Route::get('/club/{id}/category/post/create', [CategoryPostController::class, 'create'])->name('admin.club.category-post.create');
            Route::get('/club/{id}/category/post/edit/{category_id}', [CategoryPostController::class, 'edit'])->name('admin.club.category-post.edit');
            Route::get('/club/{id}/category/post/{category_id}', [CategoryPostController::class, 'detail'])->name('admin.club.category-post.detail');
        });


    });
});
