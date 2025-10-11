<?php
namespace Database\Seeders;

use App\Models\JobApplicant;
use App\Models\JobVacancy;
use App\Models\User;
use Illuminate\Database\Seeder;

class JobApplicantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobVacancies = JobVacancy::all();
        $users        = User::all();

        foreach ($jobVacancies as $jobVacancy) {
            foreach ($users as $user) {
                JobApplicant::factory()->create([
                    'job_vacancy_id' => $jobVacancy->id,
                    'user_id'        => $user->id,
                ]);
            }
        }
    }
}
