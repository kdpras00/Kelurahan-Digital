<?php
namespace App\Repositories;

use App\Interface\SocialAssistanceRecipientRepositoryInterface;
use App\Models\SocialAssistanceRecipient;
use Exception;
use Illuminate\Support\Facades\DB;

class SocialAssistanceRecipientRepository implements SocialAssistanceRecipientRepositoryInterface
{
    public function getAll(
        ?string $search,
        ?int $limit,
        bool $execute) {
        $query = SocialAssistanceRecipient::where(function ($query) use ($search) {
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
        $query = SocialAssistanceRecipient::where('id', $id);

        return $query->first();
    }
    public function create(array $data)
    {
        DB::beginTransaction();

        try {
            $socialAssistanceRecipient                       = new SocialAssistanceRecipient;
            $socialAssistanceRecipient->social_assistance_id = $data['social_assistance_id'];
            $socialAssistanceRecipient->head_of_family_id    = $data['head_of_family_id'];
            $socialAssistanceRecipient->amount               = $data['amount'];
            $socialAssistanceRecipient->reason               = $data['reason'];
            $socialAssistanceRecipient->bank                 = $data['bank'];
            $socialAssistanceRecipient->account_number       = $data['account_number'];

            if (isset($data['proof'])) {
                $socialAssistanceRecipient->proof = $data['proof']->store(
                    'assets/social-assistance-recipients',
                    'public'
                );
            }
            if (isset($data['status'])) {
                $socialAssistanceRecipient->status = $data['status'];
            }
            $socialAssistanceRecipient->save();

            DB::commit();

            return $socialAssistanceRecipient;
        } catch (\Exception $e) {
            DB::rollBack();

            throw new Exception($e->getMessage());
        }
    }

    public function update(string $id, array $data)
    {
        DB::beginTransaction();

        try {
            $socialAssistanceRecipient = SocialAssistanceRecipient::find($id);

            $socialAssistanceRecipient->social_assistance_id = $data['social_assistance_id'];
            $socialAssistanceRecipient->head_of_family_id    = $data['head_of_family_id'];
            $socialAssistanceRecipient->amount               = $data['amount'];
            $socialAssistanceRecipient->reason               = $data['reason'];
            $socialAssistanceRecipient->bank                 = $data['bank'];
            $socialAssistanceRecipient->account_number       = $data['account_number'];

            if (isset($data['proof'])) {
                $socialAssistanceRecipient->proof = $data['proof']->store(
                    'assets/social-assistance-recipients',
                    'public'
                );
            }
            if (isset($data['status'])) {
                $socialAssistanceRecipient->status = $data['status'];
            }
            $socialAssistanceRecipient->save();
            DB::commit();
            return $socialAssistanceRecipient;
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
            $socialAssistanceRecipient = SocialAssistanceRecipient::find($id);
            $socialAssistanceRecipient->delete();

            DB::commit();

            return $socialAssistanceRecipient;
        } catch (\Exception $e) {
            //throw $th;
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }
}
