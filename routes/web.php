<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\MemberController;

Route::get('/', function () {
    return view('landing_page/index');
});

Route::get('/landing-page', [LandingController::class, 'index'])->name('landing.index');

Route::get('/blog-page', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog-page/show/{id}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/project-page', [ProjectController::class, 'index'])->name('project.index');
Route::get('/project-page/show/{id}', [ProjectController::class, 'show'])->name('project.show');

Route::get('/member-page', [MemberController::class, 'index'])->name('member.index');
Route::get('/member-page/show/{id}', [MemberController::class, 'show'])->name('member.show');
