<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HeadOfFamilyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            /* jika ingin memanggil relasi:
            1. panggil relasi dengan nama tabel yang direlasikan
            2. jika relasi pada modelnya belongs to atau memanggil, bisa menggunakan method new dengan memanggil resource yang tabelnya terkait dengan relasinya.
            3. jika has many menggunakan collection.
            */
            'user'            => new UserResource($this->user),
            'profile_picture' => $this->profile_picture,
            'identity_number' => $this->identity_number,
            'gender'          => $this->gender,
            'date_of_birth'   => $this->date_of_birth,
            'phone_number'    => $this->phone_number,
            'occupation'      => $this->occupation,
            'marital_status'  => $this->marital_status,
            'family_members'  => FamilyMemberResource::collection($this->familyMembers),
        ];
    }
}
