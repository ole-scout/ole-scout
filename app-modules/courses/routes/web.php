<?php

use FossHaas\Courses\Livewire\CourseGroupRootView;
use FossHaas\Courses\Livewire\CourseGroupView;
use FossHaas\Courses\Livewire\DashboardView;
use Illuminate\Support\Facades\Route;

Route::name('courses.')->group(function () {
    Route::get('/', DashboardView::class)->name('dashboard');
    Route::get('/g', CourseGroupRootView::class)->name('root');
    Route::get('/g/{courseGroup:slug}', CourseGroupView::class)->name('group');
    // Route::get('/c/{course:slug}', CourseView::class)->name('course');
    // Route::get('/c/{course:slug}/a/{activity:id}', ActivityView::class)->name('activity');
})->middleware('auth');
