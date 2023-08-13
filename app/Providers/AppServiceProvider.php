<?php

namespace Vanguard\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use Vanguard\Repositories\DocumentCategory\DocumentCategoryRepository;
use Vanguard\Repositories\DocumentCategory\EloquentDocumentCategory;
use Vanguard\Repositories\FrontApi\EloquentFrontApi;
use Vanguard\Repositories\FrontApi\FrontApiRepository;
use Vanguard\Repositories\MenuItems\EloquentMenuItemsItems;
use Vanguard\Repositories\MenuItems\MenuItemsRepository;
use Vanguard\Repositories\Menus\EloquentMenus;
use Vanguard\Repositories\Menus\MenusRepository;
use Vanguard\Repositories\PageCategory\EloquentPageCategory;
use Vanguard\Repositories\PageCategory\PageCategoryRepository;
use Vanguard\Repositories\Pages\EloquentPages;
use Vanguard\Repositories\Pages\PagesRepository;
use Vanguard\Repositories\Post\EloquentPost;
use Vanguard\Repositories\Role\EloquentRole;
use Vanguard\Repositories\Session\DbSession;
use Vanguard\Repositories\Themes\EloquentThemes;
use Vanguard\Repositories\Themes\ThemesRepository;
use Vanguard\Repositories\User\EloquentUser;
use Vanguard\Repositories\Post\PostRepository;
use Vanguard\Repositories\Role\RoleRepository;
use Vanguard\Repositories\User\UserRepository;
use Vanguard\Repositories\Country\EloquentCountry;
use Vanguard\Repositories\PostLog\EloquentPostLog;
use Illuminate\Database\Eloquent\Factories\Factory;
use Vanguard\Repositories\Activity\EloquentActivity;
use Vanguard\Repositories\Country\CountryRepository;
use Vanguard\Repositories\PostBlog\EloquentPostBlog;
use Vanguard\Repositories\PostLog\PostLogRepository;
use Vanguard\Repositories\Session\SessionRepository;
use Vanguard\Repositories\Activity\ActivityRepository;
use Vanguard\Repositories\Advertise\EloquentAdvertise;
use Vanguard\Repositories\PostBlog\PostBlogRepository;
use Vanguard\Repositories\Advertise\AdvertiseRepository;
use Vanguard\Repositories\Permission\EloquentPermission;
use Vanguard\Repositories\PostStatus\EloquentPostStatus;
use Vanguard\Repositories\Permission\PermissionRepository;
use Vanguard\Repositories\PostStatus\PostStatusRepository;
use Vanguard\Repositories\AdvertiseLog\EloquentAdvertiseLog;
use Vanguard\Repositories\PostCategory\EloquentPostCategory;
use Vanguard\Repositories\AdvertiseBlog\EloquentAdvertiseBlog;
use Vanguard\Repositories\AdvertiseLog\AdvertiseLogRepository;
use Vanguard\Repositories\AdvertisePage\EloquentAdvertisePage;
use Vanguard\Repositories\PostCategory\PostCategoryRepository;
use Vanguard\Repositories\AdvertiseBlog\AdvertiseBlogRepository;
use Vanguard\Repositories\AdvertisePage\AdvertisePageRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (config('app.env') === 'production') {
            \URL::forceScheme('https');
        }

        Carbon::setLocale(config('app.locale'));
        config(['app.name' => setting('app_name')]);
        \Illuminate\Database\Schema\Builder::defaultStringLength(191);

        Factory::guessFactoryNamesUsing(function (string $modelName) {
            return 'Database\Factories\\' . class_basename($modelName) . 'Factory';
        });

        \Illuminate\Pagination\Paginator::useBootstrap();

        Inertia::titleTemplate(fn($title) => $title ? "$title | CAMAGRIMARKET" : 'Home | CAMAGRIMARKET');

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UserRepository::class, EloquentUser::class);
        $this->app->singleton(ActivityRepository::class, EloquentActivity::class);
        $this->app->singleton(RoleRepository::class, EloquentRole::class);
        $this->app->singleton(PermissionRepository::class, EloquentPermission::class);
        $this->app->singleton(SessionRepository::class, DbSession::class);
        $this->app->singleton(SessionRepository::class, DbSession::class);
        $this->app->singleton(CountryRepository::class, EloquentCountry::class);
        $this->app->singleton(PostRepository::class, EloquentPost::class);
        $this->app->singleton(PostLogRepository::class, EloquentPostLog::class);
        $this->app->singleton(PostCategoryRepository::class, EloquentPostCategory::class);
        $this->app->singleton(PostBlogRepository::class, EloquentPostBlog::class);
        $this->app->singleton(PostStatusRepository::class, EloquentPostStatus::class);
        $this->app->singleton(AdvertiseRepository::class, EloquentAdvertise::class);
        $this->app->singleton(AdvertisePageRepository::class, EloquentAdvertisePage::class);
        $this->app->singleton(AdvertiseBlogRepository::class, EloquentAdvertiseBlog::class);
        $this->app->singleton(AdvertiseLogRepository::class, EloquentAdvertiseLog::class);
        $this->app->singleton(MenuItemsRepository::class, EloquentMenuItemsItems::class);
        $this->app->singleton(MenusRepository::class, EloquentMenus::class);
        $this->app->singleton(FrontApiRepository::class, EloquentFrontApi::class);
        $this->app->singleton(ThemesRepository::class, EloquentThemes::class);
        $this->app->singleton(PagesRepository::class, EloquentPages::class);
        $this->app->singleton(PageCategoryRepository::class, EloquentPageCategory::class);
        $this->app->singleton(DocumentCategoryRepository::class, EloquentDocumentCategory::class);

        if ($this->app->environment('local')) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
    }
}
