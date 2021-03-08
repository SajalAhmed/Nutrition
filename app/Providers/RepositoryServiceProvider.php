<?php

namespace App\Providers;

use App\Repository\CourseCompleteInterFace;
use App\Repository\CourseModuleRepositoryInterface;
use App\Repository\CourseRepositoryInterface;
use App\Repository\DashboardInterface;
use App\Repository\Eloquent\CourseCompleteRepository;
use App\Repository\Eloquent\CourseModuleRepository;
use App\Repository\Eloquent\CourseRepository;
use App\Repository\Eloquent\DashboardRepository;
use App\Repository\Eloquent\ModuleProgressRepository;
use App\Repository\Eloquent\ModuleSessionRepository;
use App\Repository\Eloquent\QuizRepository;
use App\Repository\Eloquent\RegisterUserRepository;
use App\Repository\Eloquent\UserReviewRepository;
use App\Repository\ModuleProgressInterface;
use App\Repository\ModuleSessionInterface;
use App\Repository\QuizRepositoryInterface;
use App\Repository\RegisterUserInterface;
use App\Repository\UserReviewInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       $this->app->bind(CourseRepositoryInterface::class, CourseRepository::class);
       $this->app->bind(CourseModuleRepositoryInterface::class, CourseModuleRepository::class);
       $this->app->bind(ModuleSessionInterface::class, ModuleSessionRepository::class);
       $this->app->bind(RegisterUserInterface::class, RegisterUserRepository::class);
       $this->app->bind(ModuleProgressInterface::class, ModuleProgressRepository::class);
       $this->app->bind(QuizRepositoryInterface::class, QuizRepository::class);
       $this->app->bind(UserReviewInterface::class, UserReviewRepository::class);
       $this->app->bind(DashboardInterface::class, DashboardRepository::class);
       $this->app->bind(CourseCompleteInterFace::class, CourseCompleteRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
