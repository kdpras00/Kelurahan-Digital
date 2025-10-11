<?php
namespace App\Repositories;

use App\Interface\JobApplicantRepositoryInterface;
use App\Models\JobApplicant;
use Exception;
use Illuminate\Support\Facades\DB;

class JobApplicantRepository implements JobApplicantRepositoryInterface
{
    public function getAll(
        ?string $search,
        ?int $limit,
        bool $execute) {
        $query = JobApplicant::where(function ($query) use ($search) {
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
        $query = JobApplicant::where('id', $id);

        return $query->first();
    }

    public function create(array $data)
    {
        DB::beginTransaction();

        try {
            $jobApplicant                 = new JobApplicant;
            $jobApplicant->job_vacancy_id = $data['job_vacancy_id'];
            $jobApplicant->user_id        = $data['user_id'];

            if (isset($data['status'])) {
                $jobApplicant->status = $data['status'];
            }
            $jobApplicant->save();

            DB::commit();

            return $jobApplicant;
        } catch (\Exception $e) {
            DB::rollBack();

            throw new Exception($e->getMessage());
        }
    }

    public function update(string $id, array $data)
    {
        DB::beginTransaction();

        try {
            $jobApplicant = JobApplicant::find($id);

            $jobApplicant->job_vacancy_id = $data['job_vacancy_id'];
            $jobApplicant->user_id        = $data['user_id'];

            if (isset($data['status'])) {
                $jobApplicant->status = $data['status'];
            }
            $jobApplicant->save();

            DB::commit();

            return $jobApplicant;
        } catch (\Exception $e) {
            //throw $th;
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function delete(string $id)
    {
        DB::beginTransaction();

        try {
            $jobApplicant = JobApplicant::find($id);
            $jobApplicant->delete();

            DB::commit();

            return $jobApplicant;
        } catch (\Exception $e) {
            //throw $th;
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }
}
