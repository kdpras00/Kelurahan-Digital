<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobApplicantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'job_vacancy' => new JobVacancyResource($this->socialAssistance),
            'user'        => new UserResource($this->user),
            'status'      => $this->status,
        ];
    }
}
