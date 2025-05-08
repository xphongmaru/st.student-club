<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthenticateController;
use App\Http\Controllers\Admin\Clubs\RequestClubController;
use App\Http\Controllers\Admin\Clubs\ClubController;
use App\Http\Controllers\Client\Club\PageIndexController;
use App\Http\Controllers\Admin\Clubs\MemberController;
use App\Http\Controllers\Admin\Clubs\RoleController;
use App\Http\Controllers\Admin\Clubs\RecruitmentMemberController;
use App\Models\User;

//route đăng nhâp sso
Route::get('/auth/redirect', [AuthenticateController::class, 'redirectToSSO'])->name('sso.redirect');
//Route::get('/auth/redirect', function (){
//    $user = User::query()->where('id', 2
//    )->firstOrFail();
//    Auth::login($user);
//})->name('sso.redirect');
Route::get('/auth/callback', [AuthenticateController::class, 'handleSSOCallback'])->name('sso.callback');
Route::get('/logout', [AuthenticateController::class, 'logout'])->name('handelLogout');

//route client
Route::get('/',fn()=> view('client.pages.index'))->name('client.index');
Route::get('/cau-lac-bo/{id}',[PageIndexController::class, 'index'])->name('client.page-club');

Route::middleware('auth.sso')->group(function () {
    Route::get('tai-khoan', function () {
        return view('client.pages.account');
    })->name('client.account');

});

//route admin
Route::middleware('auth.sso')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.pages.dashboard');
        })->name('admin.dashboard');

        Route::middleware('permission:Quản lý câu lạc bộ')->group(function () {
            Route::get('/club', [ClubController::class,'index'])->name('admin.club.index');
            Route::get('/club/detail/{id}', [ClubController::class,'detail'])->name('admin.club.detail');

            Route::get('/request-club', [RequestClubController::class,'requestClub'])->name('admin.request-club.list');
            Route::get('/request-club/detail/{id}', [RequestClubController::class,'detail'])->name('admin.request-club.detail');
        });

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
    });
});
