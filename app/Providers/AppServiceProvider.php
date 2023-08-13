<?php

namespace Vanguard\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use Vanguard\Repositories\Document\DocumentRepository;
use Vanguard\Repositories\Document\EloquentDocument;
use Vanguard\Repositories\DocumentCategory\DocumentCategoryRepository;
use Vanguard\Repositories\DocumentCategory\EloquentDocumentCategory;
use Vanguard\Repositories\Front\News\EloquentNews;
use Vanguard\Repositories\Front\News\NewsRepository;
use Vanguard\Repositories\FrontApi\EloquentFrontApi;
use Vanguard\Repositories\FrontApi\FrontApiRepository;
use Vanguard\Repositories\PageCategory\EloquentPageCategory;
use Vanguard\Repositories\PageCategory\PageCategoryRepository;
use Vanguard\Repositories\Pages\EloquentPages;
use Vanguard\Repositories\Pages\PagesRepository;
use Vanguard\Repositories\Partner\EloquentPartner;
use Vanguard\Repositories\Partner\PartnerRepository;
use Vanguard\Repositories\Post\EloquentPost;
use Vanguard\Repositories\Role\EloquentRole;
use Vanguard\Repositories\Session\DbSession;
use Vanguard\Repositories\Slide\EloquentSlide;
use Vanguard\Repositories\Slide\SlideRepository;
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
use Vanguard\Repositories\PostBlog\PostBlogRepository;
use Vanguard\Repositories\Permission\EloquentPermission;
use Vanguard\Repositories\PostStatus\EloquentPostStatus;
use Vanguard\Repositories\Permission\PermissionRepository;
use Vanguard\Repositories\PostStatus\PostStatusRepository;
use Vanguard\Repositories\PostCategory\EloquentPostCategory;
use Vanguard\Repositories\PostCategory\PostCategoryRepository;

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
        $this->registerAdminRepo();
        $this->registerFrontRepo();

        if ($this->app->environment('local')) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
    }

    private function registerAdminRepo()
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
        $this->app->singleton(FrontApiRepository::class, EloquentFrontApi::class);
        $this->app->singleton(ThemesRepository::class, EloquentThemes::class);
        $this->app->singleton(PagesRepository::class, EloquentPages::class);
        $this->app->singleton(SlideRepository::class, EloquentSlide::class);
        $this->app->singleton(PartnerRepository::class, EloquentPartner::class);
        $this->app->singleton(PageCategoryRepository::class, EloquentPageCategory::class);
        $this->app->singleton(DocumentRepository::class, EloquentDocument::class);
        $this->app->singleton(DocumentCategoryRepository::class, EloquentDocumentCategory::class);

    }

    private function registerFrontRepo()
    {
        $this->app->singleton(NewsRepository::class, EloquentNews::class);
    }
}
