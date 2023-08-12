<?php

/**
 * Front
 */

use UniSharp\LaravelFilemanager\Lfm;

Route::get('/', [\Vanguard\Http\Controllers\Web\Front\HomeController::class, 'index'])->name('home.index');
Route::get('/article', [\Vanguard\Http\Controllers\Web\Front\NewsController::class, 'index'])->name('news.index');
Route::get('/article/{id}', [\Vanguard\Http\Controllers\Web\Front\NewsController::class, 'detail'])->name('news.detail');
Route::get('/document/{slug}', [\Vanguard\Http\Controllers\Web\Front\DocumentController::class, 'index'])->name('document.index');
Route::get('/other-page/{slug}', [\Vanguard\Http\Controllers\Web\Front\PageController::class, 'index'])->name('other_page.index');
Route::get('/contact-us', [\Vanguard\Http\Controllers\Web\Front\ContactUsController::class, 'index'])->name('contact_us.index');
Route::get('/search', [\Vanguard\Http\Controllers\Web\Front\SearchController::class, 'index'])->name('search.index');

/**
 * Authentication
 */
Route::get('login', 'Auth\LoginController@show');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('auth.logout');

Route::group(['middleware' => ['registration', 'guest']], function () {
    Route::get('register', 'Auth\RegisterController@show');
    Route::post('register', 'Auth\RegisterController@register');
});

Route::emailVerification();

Route::group(['middleware' => ['password-reset', 'guest']], function () {
    Route::resetPassword();
});

/**
 * Two-Factor Authentication
 */
Route::group(['middleware' => 'two-factor'], function () {
    Route::get('auth/two-factor-authentication', 'Auth\TwoFactorTokenController@show')->name('auth.token');
    Route::post('auth/two-factor-authentication', 'Auth\TwoFactorTokenController@update')->name('auth.token.validate');
});

/**
 * Social Login
 */
Route::get('auth/{provider}/login', 'Auth\SocialAuthController@redirectToProvider')->name('social.login');
Route::get('auth/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');

/**
 * Impersonate Routes
 */
Route::group(['middleware' => 'auth'], function () {
    Route::impersonate();
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'verified']], function () {

    /**
     * Dashboard
     */

    Route::get('/', function () {
        return redirect(route('dashboard'));
    });
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    /**
     * Post
     */

    Route::get('/post/index', 'Post\PostController@index')->name('post.index');
    Route::get('/post/create', 'Post\PostController@create')->name('post.create');
    Route::post('/post/store', 'Post\PostController@store')->name('post.store');
    Route::post('/post/update', 'Post\PostController@update')->name('post.update');
    Route::get('/post/edit/{id}', 'Post\PostController@edit')->name('post.edit');
    Route::delete('/post/delete/{id}', 'Post\PostController@delete')->name('post.delete');
    Route::delete('/post/duplicate/{id}', 'Post\PostController@duplicate')->name('post.duplicate');
    Route::delete('/post/delete-many', 'Post\PostController@deleteMany')->name('post.delete-many');

    Route::get('/post/log/{post_id}', 'Post\PostLogController@index')->name('post.log');

    Route::get('/post-category/index', 'Post\PostCategoryController@index')->name('post-category.index');
    Route::get('/post-category/create', 'Post\PostCategoryController@create')->name('post-category.create');
    Route::post('/post-category/store', 'Post\PostCategoryController@store')->name('post-category.store');
    Route::get('/post-category/edit/{id}', 'Post\PostCategoryController@edit')->name('post-category.edit');
    Route::post('/post-category/update', 'Post\PostCategoryController@update')->name('post-category.update');
    Route::delete('/post-category/delete/{id}', 'Post\PostCategoryController@delete')->name('post-category.delete');

    Route::get('/post-blog/index', 'Post\PostBlogController@index')->name('post-blog.index');
    Route::get('/post-blog/create', 'Post\PostBlogController@create')->name('post-blog.create');
    Route::post('/post-blog/store', 'Post\PostBlogController@store')->name('post-blog.store');
    Route::post('/post-blog/update', 'Post\PostBlogController@update')->name('post-blog.update');
    Route::get('/post-blog/edit/{id}', 'Post\PostBlogController@edit')->name('post-blog.edit');
    Route::delete('/post-blog/delete/{id}', 'Post\PostBlogController@delete')->name('post-blog.delete');

    Route::get('/post-status/index', 'Post\PostStatusController@index')->name('post-status.index');
    Route::get('/post-status/create', 'Post\PostStatusController@create')->name('post-status.create');
    Route::post('/post-status/store', 'Post\PostStatusController@store')->name('post-status.store');
    Route::post('/post-status/update', 'Post\PostStatusController@update')->name('post-status.update');
    Route::get('/post-status/edit/{id}', 'Post\PostStatusController@edit')->name('post-status.edit');
    Route::delete('/post-status/delete/{id}', 'Post\PostStatusController@delete')->name('post-status.delete');

    /**
     * Pages
     */

    Route::get('/page/index', 'Page\PageController@index')->name('page.index');
    Route::get('/page/create', 'Page\PageController@create')->name('page.create');
    Route::post('/page/store', 'Page\PageController@store')->name('page.store');
    Route::post('/page/update', 'Page\PageController@update')->name('page.update');
    Route::get('/page/edit/{id}', 'Page\PageController@edit')->name('page.edit');
    Route::delete('/page/delete/{id}', 'Page\PageController@delete')->name('page.delete');

    Route::get('/page-category/index', 'Page\PageCategoryController@index')->name('page-category.index');
    Route::get('/page-category/create', 'Page\PageCategoryController@create')->name('page-category.create');
    Route::post('/page-category/store', 'Page\PageCategoryController@store')->name('page-category.store');
    Route::get('/page-category/edit/{id}', 'Page\PageCategoryController@edit')->name('page-category.edit');
    Route::post('/page-category/update', 'Page\PageCategoryController@update')->name('page-category.update');
    Route::delete('/page-category/delete/{id}', 'Page\PageCategoryController@delete')->name('page-category.delete');


    /**
     * MenusItem
     */

    Route::get('/menuitem/index', 'MenuItems\MenuItemsController@index')->name('menuitem.index');
    Route::get('/menuitem/create', 'MenuItems\MenuItemsController@create')->name('menuitem.create');
    Route::post('/menuitem/store', 'MenuItems\MenuItemsController@store')->name('menuitem.store');
    Route::post('/menuitem/update', 'MenuItems\MenuItemsController@update')->name('menuitem.update');
    Route::get('/menuitem/edit/{id}', 'MenuItems\MenuItemsController@edit')->name('menuitem.edit');
    Route::delete('/menuitem/delete/{id}', 'MenuItems\MenuItemsController@delete')->name('menuitem.delete');

    /**
     * Themes Setting
     */

    Route::get('themes', 'Themes\ThemesController@index')->name('themes.general');
    Route::post('/themes/store', 'Themes\ThemesController@store')->name('themes.store');
    Route::post('themes/update', 'Themes\ThemesController@update')->name('themes.update');

    /**
     * Menus
     */

    Route::get('/menus/index', 'Menus\MenusController@index')->name('menus.index');
    Route::get('/menus/create', 'Menus\MenusController@create')->name('menus.create');
    Route::post('/menus/store', 'Menus\MenusController@store')->name('menus.store');
    Route::post('/menus/update', 'Menus\MenusController@update')->name('menus.update');
    Route::get('/menus/edit/{id}', 'Menus\MenusController@edit')->name('menus.edit');
    Route::delete('/menus/delete/{id}', 'Menus\MenusController@delete')->name('menus.delete');


    /**
     * Advertise
     */

    Route::get('/advertise/index', 'Advertise\AdvertiseController@index')->name('advertise.index');
    Route::get('/advertise/create', 'Advertise\AdvertiseController@create')->name('advertise.create');
    Route::post('/advertise/store', 'Advertise\AdvertiseController@store')->name('advertise.store');
    Route::post('/advertise/update', 'Advertise\AdvertiseController@update')->name('advertise.update');
    Route::get('/advertise/edit/{id}', 'Advertise\AdvertiseController@edit')->name('advertise.edit');
    Route::delete('/advertise/delete/{id}', 'Advertise\AdvertiseController@delete')->name('advertise.delete');

    Route::get('/advertise-blog/index', 'Advertise\AdvertiseBlogController@index')->name('advertise-blog.index');
    Route::get('/advertise-blog/create', 'Advertise\AdvertiseBlogController@create')->name('advertise-blog.create');
    Route::post('/advertise-blog/store', 'Advertise\AdvertiseBlogController@store')->name('advertise-blog.store');
    Route::post('/advertise-blog/update', 'Advertise\AdvertiseBlogController@update')->name('advertise-blog.update');
    Route::get('/advertise-blog/edit/{id}', 'Advertise\AdvertiseBlogController@edit')->name('advertise-blog.edit');
    Route::delete('/advertise-blog/delete/{id}', 'Advertise\AdvertiseBlogController@delete')->name('advertise-blog.delete');

    Route::get('/advertise-page/index', 'Advertise\AdvertisePageController@index')->name('advertise-page.index');
    Route::get('/advertise-page/create', 'Advertise\AdvertisePageController@create')->name('advertise-page.create');
    Route::post('/advertise-page/store', 'Advertise\AdvertisePageController@store')->name('advertise-page.store');
    Route::post('/advertise-page/update', 'Advertise\AdvertisePageController@update')->name('advertise-page.update');
    Route::get('/advertise-page/edit/{id}', 'Advertise\AdvertisePageController@edit')->name('advertise-page.edit');
    Route::delete('/advertise-page/delete/{id}', 'Advertise\AdvertisePageController@delete')->name('advertise-page.delete');

    Route::get('/advertise-log/index', 'Advertise\AdvertiseLogController@index')->name('advertise-log.index');
    Route::get('/advertise-log/export', 'Advertise\AdvertiseLogController@export')->name('advertise-log.export');

    /**
     * File Manager
     */

    Route::group(['prefix' => 'filemanager'], function () {
        Lfm::routes();
    });

    Route::post('/tiny-editor/upload', 'Upload\UploadTinyFileController@upload')->name('tiny-editor.upload');


    /**
     * User Profile
     */

    Route::group(['prefix' => 'profile', 'namespace' => 'Profile'], function () {
        Route::get('/', 'ProfileController@show')->name('profile');
        Route::get('activity', 'ActivityController@show')->name('profile.activity');
        Route::put('details', 'DetailsController@update')->name('profile.update.details');

        Route::post('avatar', 'AvatarController@update')->name('profile.update.avatar');
        Route::post('avatar/external', 'AvatarController@updateExternal')
            ->name('profile.update.avatar-external');

        Route::put('login-details', 'LoginDetailsController@update')
            ->name('profile.update.login-details');

        Route::get('sessions', 'SessionsController@index')
            ->name('profile.sessions')
            ->middleware('session.database');

        Route::delete('sessions/{session}/invalidate', 'SessionsController@destroy')
            ->name('profile.sessions.invalidate')
            ->middleware('session.database');
    });

    /**
     * Two-Factor Authentication Setup
     */

    Route::group(['middleware' => 'two-factor'], function () {
        Route::post('two-factor/enable', 'TwoFactorController@enable')->name('two-factor.enable');

        Route::get('two-factor/verification', 'TwoFactorController@verification')
            ->name('two-factor.verification')
            ->middleware('verify-2fa-phone');

        Route::post('two-factor/resend', 'TwoFactorController@resend')
            ->name('two-factor.resend')
            ->middleware('throttle:1,1', 'verify-2fa-phone');

        Route::post('two-factor/verify', 'TwoFactorController@verify')
            ->name('two-factor.verify')
            ->middleware('verify-2fa-phone');

        Route::post('two-factor/disable', 'TwoFactorController@disable')->name('two-factor.disable');
    });


    /**
     * User Management
     */
    Route::resource('users', 'Users\UsersController')
        ->except('update')->middleware('permission:users.manage');

    Route::group(['prefix' => 'users/{user}', 'middleware' => 'permission:users.manage'], function () {
        Route::put('update/details', 'Users\DetailsController@update')->name('users.update.details');
        Route::put('update/login-details', 'Users\LoginDetailsController@update')
            ->name('users.update.login-details');

        Route::post('update/avatar', 'Users\AvatarController@update')->name('user.update.avatar');
        Route::post('update/avatar/external', 'Users\AvatarController@updateExternal')
            ->name('user.update.avatar.external');

        Route::get('sessions', 'Users\SessionsController@index')
            ->name('user.sessions')->middleware('session.database');

        Route::delete('sessions/{session}/invalidate', 'Users\SessionsController@destroy')
            ->name('user.sessions.invalidate')->middleware('session.database');

        Route::post('two-factor/enable', 'TwoFactorController@enable')->name('user.two-factor.enable');
        Route::post('two-factor/disable', 'TwoFactorController@disable')->name('user.two-factor.disable');
    });

    /**
     * Roles & Permissions
     */
    Route::group(['namespace' => 'Authorization'], function () {
        Route::resource('roles', 'RolesController')->except('show')->middleware('permission:roles.manage');

        Route::post('permissions/save', 'RolePermissionsController@update')
            ->name('permissions.save')
            ->middleware('permission:permissions.manage');

        Route::resource('permissions', 'PermissionsController')->middleware('permission:permissions.manage');
    });


    /**
     * Settings
     */

    Route::get('settings', 'SettingsController@general')->name('settings.general')
        ->middleware('permission:settings.general');

    Route::post('settings/general', 'SettingsController@update')->name('settings.general.update')
        ->middleware('permission:settings.general');

    Route::get('settings/auth', 'SettingsController@auth')->name('settings.auth')
        ->middleware('permission:settings.auth');

    Route::post('settings/auth', 'SettingsController@update')->name('settings.auth.update')
        ->middleware('permission:settings.auth');

    if (config('services.authy.key')) {
        Route::post('settings/auth/2fa/enable', 'SettingsController@enableTwoFactor')
            ->name('settings.auth.2fa.enable')
            ->middleware('permission:settings.auth');

        Route::post('settings/auth/2fa/disable', 'SettingsController@disableTwoFactor')
            ->name('settings.auth.2fa.disable')
            ->middleware('permission:settings.auth');
    }

    Route::post('settings/auth/registration/captcha/enable', 'SettingsController@enableCaptcha')
        ->name('settings.registration.captcha.enable')
        ->middleware('permission:settings.auth');

    Route::post('settings/auth/registration/captcha/disable', 'SettingsController@disableCaptcha')
        ->name('settings.registration.captcha.disable')
        ->middleware('permission:settings.auth');

    Route::get('settings/notifications', 'SettingsController@notifications')
        ->name('settings.notifications')
        ->middleware('permission:settings.notifications');

    Route::post('settings/notifications', 'SettingsController@update')
        ->name('settings.notifications.update')
        ->middleware('permission:settings.notifications');

    /**
     * Activity Log
     */

    Route::get('activity', 'ActivityController@index')->name('activity.index')
        ->middleware('permission:users.activity');

    Route::get('activity/user/{user}/log', 'ActivityController@userActivity')->name('activity.user')
        ->middleware('permission:users.activity');

});


/**
 * Installation
 */

Route::group(['prefix' => 'install'], function () {
    Route::get('/', 'InstallController@index')->name('install.start');
    Route::get('requirements', 'InstallController@requirements')->name('install.requirements');
    Route::get('permissions', 'InstallController@permissions')->name('install.permissions');
    Route::get('database', 'InstallController@databaseInfo')->name('install.database');
    Route::get('start-installation', 'InstallController@installation')->name('install.installation');
    Route::post('start-installation', 'InstallController@installation')->name('install.installation');
    Route::post('install-app', 'InstallController@install')->name('install.install');
    Route::get('complete', 'InstallController@complete')->name('install.complete');
    Route::get('error', 'InstallController@error')->name('install.error');
});
