<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobVacancyResource extends JsonResource
{
    public function toArray(Request $request): array
    {

        return [
            'id'                => $this->id,
            'thumbnail'         => $this->thumbnail,
            'job_title'         => $this->job_title,
            'description'       => $this->description,
            'company_in_charge' => $this->company_in_charge,
            'start_date'        => $this->start_date,
            'end_date'          => $this->end_date,
            'salary'            => (float) (string) $this->salary,
            'job_status'        => $this->job_status,
        ];
    }
}
