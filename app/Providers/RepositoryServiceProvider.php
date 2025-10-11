<?php
namespace App\Providers;

use App\Interface\AuthRepositoryInterface;
use App\Interface\DashboardRepositoryInterface;
use App\Interface\EventParticipantRepositoryInterface;
use App\Interface\EventRepositoryInterface;
use App\Interface\FamilyMemberRepositoryInterface;
use App\Interface\HeadOfFamilyRepositoryInterface;
use App\Interface\JobApplicantRepositoryInterface;
use App\Interface\JobVacancyRepositoryInterface;
use App\Interface\ProfileRepositoryInterface;
use App\Interface\SocialAssistanceRecipientRepositoryInterface;
use App\Interface\SocialAssistanceRepositoryInterface;
use App\Interface\UserRepositoryInterface;
use App\Repositories\AuthRepository;
use App\Repositories\DashboardRepository;
use App\Repositories\EventParticipantRepository;
use App\Repositories\EventRepository;
use App\Repositories\FamilyMemberRepository;
use App\Repositories\HeadOfFamilyRepository;
use App\Repositories\JobApplicantRepository;
use App\Repositories\JobVacancyRepository;
use App\Repositories\ProfileRepository;
use App\Repositories\SocialAssistanceRecipientRepository;
use App\Repositories\SocialAssistanceRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //untuk mendaftarkan repository dan interface

        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);

        $this->app->bind(HeadOfFamilyRepositoryInterface::class, HeadOfFamilyRepository::class);

        $this->app->bind(FamilyMemberRepositoryInterface::class, FamilyMemberRepository::class);

        $this->app->bind(SocialAssistanceRepositoryInterface::class, SocialAssistanceRepository::class);

        $this->app->bind(SocialAssistanceRecipientRepositoryInterface::class, SocialAssistanceRecipientRepository::class);

        $this->app->bind(EventRepositoryInterface::class, EventRepository::class);
        $this->app->bind(EventParticipantRepositoryInterface::class, EventParticipantRepository::class);

        $this->app->bind(JobVacancyRepositoryInterface::class, JobVacancyRepository::class);
        $this->app->bind(JobApplicantRepositoryInterface::class, JobApplicantRepository::class);

        $this->app->bind(ProfileRepositoryInterface::class, ProfileRepository::class);

        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(DashboardRepositoryInterface::class, DashboardRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
