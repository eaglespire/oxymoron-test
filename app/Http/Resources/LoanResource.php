<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoanResource extends JsonResource
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
            'firstname'=>ucwords($this->firstname),
            'lastname'=>ucwords($this->lastname),
            'age'=>$this->age,
            'loan_amount'=>$this->loan_amount,
            'monthly_salary'=>$this->monthly_salary,
            'payback_period'=>$this->payback_period,
            'next_of_kin_name'=>ucwords($this->next_of_kin_name),
            'guarantor_name'=>ucwords($this->guarantor_name)
        ];
    }
}
