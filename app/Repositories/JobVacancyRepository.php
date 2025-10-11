<?php
namespace App\Repositories;

use App\Interface\JobVacancyRepositoryInterface;
use App\Models\JobVacancy;
use Exception;
use Illuminate\Support\Facades\DB;

class JobVacancyRepository implements JobVacancyRepositoryInterface
{
    public function getAll(
        ?string $search,
        ?int $limit,
        bool $execute) {
        $query = JobVacancy::where(function ($query) use ($search) {
            // kondisi jika melakukan pencarian data yang didefinisikan dalam model user
            if ($search) {
                // melakukan search
                $query->search($search);
            }
        });

        $query->orderBy('created_at', 'desc');

        if ($limit) {
            // untuk membatasi data yang diambil berdasarkan limit
            $query->take($limit);
        }

        if ($execute) {
            // untuk menjalankan query
            return $query->get();
        }

        return $query;
    }

    public function getAllPaginated(
        ?string $search,
        ?int $rowPerPage) {
        $query = $this->getAll($search, $rowPerPage, false);

        return $query->paginate($rowPerPage);
    }

    public function getById(string $id)
    {
        $query = JobVacancy::where('id', $id);

        return $query->first();
    }

    public function create(array $data)
    {
        DB::beginTransaction();

        try {

            //   'thumbnail',
            // 'job_title',
            // 'description',
            // 'company_in_charge',
            // 'start_date',
            // 'end_date',
            // 'salary',
            // 'job_status',
            $jobVacancy                    = new JobVacancy;
            $jobVacancy->thumbnail         = $data['thumbnail']->store('assets/job-vacancies', 'public');
            $jobVacancy->job_title         = $data['job_title'];
            $jobVacancy->description       = $data['description'];
            $jobVacancy->company_in_charge = $data['company_in_charge'];
            $jobVacancy->start_date        = $data['start_date'];
            $jobVacancy->end_date          = $data['end_date'];
            $jobVacancy->salary            = $data['salary'];
            $jobVacancy->job_status        = $data['job_status'];

            $jobVacancy->save();

            DB::commit();

            return $jobVacancy;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function update(
        string $id,
        array $data) {
        DB::beginTransaction();

        try {
            $jobVacancy = JobVacancy::find($id);

            if (isset($data['thumbnail'])) {
                $jobVacancy->thumbnail = $data['thumbnail']->store('assets/job-vacancies', 'public');
            }

            $jobVacancy->job_title         = $data['job_title'];
            $jobVacancy->description       = $data['description'];
            $jobVacancy->company_in_charge = $data['company_in_charge'];
            $jobVacancy->start_date        = $data['start_date'];
            $jobVacancy->end_date          = $data['end_date'];
            $jobVacancy->salary            = $data['salary'];
            $jobVacancy->job_status        = $data['job_status'];

            $jobVacancy->save();

            DB::commit();

            return $jobVacancy;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function delete(string $id)
    {
        DB::beginTransaction();

        try {
            $jobVacancy = JobVacancy::find($id);
            $jobVacancy->delete();

            DB::commit();

            return $jobVacancy;
        } catch (\Exception $e) {
            //throw $th;
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }
}
