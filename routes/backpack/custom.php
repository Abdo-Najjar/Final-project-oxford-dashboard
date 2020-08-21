<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => [
        config('backpack.base.web_middleware', 'web'),
        config('backpack.base.middleware_key', 'admin'),
    ],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('advertisement', 'AdvertisementCrudController');
    Route::crud('application', 'ApplicationCrudController');
    Route::crud('course', 'CourseCrudController');
    Route::crud('coursetype', 'CourseTypeCrudController');
    Route::crud('section', 'SectionCrudController');
    Route::crud('user', 'UserCrudController');
    Route::crud('userinfo', 'UserInfoCrudController');
    Route::crud('usertype', 'UserTypeCrudController');
    Route::crud('studentevaluation', 'StudentEvaluationCrudController');
}); // this should be the absolute last line of this file