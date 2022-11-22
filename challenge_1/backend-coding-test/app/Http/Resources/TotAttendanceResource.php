<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TotAttendanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return
        [
            'id' => $this->id,
            'employee' => new EmployeeResource($this->employee),
            'total hours' => $this->total,
        ];
    }
}
