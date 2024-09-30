<?php

use FossHaas\Courses\Http\Controllers\DownloadActivityController;
use FossHaas\Courses\Http\Controllers\WeblinkActivityController;
use FossHaas\Courses\Livewire\CourseGroupRootView;
use FossHaas\Courses\Livewire\CourseGroupView;
use FossHaas\Courses\Livewire\CourseView;
use FossHaas\Courses\Livewire\DashboardView;
use FossHaas\Courses\Models\CourseGroup;
use Illuminate\Support\Facades\Route;

Route::name('courses.')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', DashboardView::class)
            ->name('dashboard');

        Route::get('/g', CourseGroupRootView::class)
            ->can('viewAny', CourseGroup::class)
            ->name('root');

        Route::get('/g/{courseGroup:slug}', CourseGroupView::class)
            ->can('view', 'courseGroup')
            ->name('group');

        Route::get('/c/{course:slug}', CourseView::class)
            ->can('view', 'course')
            ->name('course');

        Route::get('/c/{course:slug}/a/{activity:id}/download', DownloadActivityController::class)
            ->can('view', 'activity')
            ->name('activity.download');

        Route::get('/c/{course:slug}/a/{activity:id}/weblink', WeblinkActivityController::class)
            ->can('view', 'activity')
            ->name('activity.weblink');

        // Route::get('/c/{course:slug}/a/{activity:id}', ActivityView::class)->name('activity');
    });
