<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    { return [
        'user_id'=>$this->user_id,
        'gangster_points'=>$this->redeemed,
        'phone_number'=>$this->phone_number,
        'status'=>$this->status,
        'amount'=>$this->amount,
        'date_made'=>$this->updated_at->format('d M, yy'),

    ];
    }
}
