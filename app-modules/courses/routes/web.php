<?php

use FossHaas\Courses\Livewire\CourseGroupRootView;
use FossHaas\Courses\Livewire\CourseGroupView;
use FossHaas\Courses\Livewire\DashboardView;
use FossHaas\Courses\Models\CourseGroup;
use Illuminate\Support\Facades\Route;

Route::name('courses.')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', DashboardView::class)
            ->name('dashboard');

        Route::get('/g', CourseGroupRootView::class)
            ->middleware('can:viewAny,' . CourseGroup::class)
            ->name('root');

        Route::get('/g/{courseGroup:path}', CourseGroupView::class)
            ->where('courseGroup', '[0-9a-z]+(?:/[0-9a-z]+)*')
            ->middleware('can:view,courseGroup')
            ->name('group');
        // Route::get('/c/{course:slug}', CourseView::class)->name('course');
        // Route::get('/c/{course:slug}/a/{activity:id}', ActivityView::class)->name('activity');
    });
