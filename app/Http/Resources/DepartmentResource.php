<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'departments_name' => $this->departments_name,
            'employees' => DepartmentEmployeeResource::collection($this->employees),
            'employees_count' => count($this->employees),
            'employees_max_wage' => $this->maxwage
        ];
    }
}
