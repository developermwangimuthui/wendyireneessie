<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\User;
use Auth;
use App\Http\Controllers\GangsterPointController;
class  FollowsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $gangster_points = new GangsterPointController;
        $authUser = Auth::user();
        $user2 = User::find($this->id);
        $i_am_following=$authUser->isFollowing($user2);
        $redeemable_gangster_points = 0;
        if($authUser->id==$user2->id){
            $redeemable_gangster_points = $gangster_points->getGansterPoints($user2);
        }
        (int) $cumulativeGansterPoints = $gangster_points->getCumulativeGansterPoints($user2);


        return [
            'id'=>$this->id,
            'firstname'=>$this->firstname,
            'lastname'=>$this->lastname,
            'username' => $this->username,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'gangster_points'=>$cumulativeGansterPoints,
            'redeemable_points'=>$redeemable_gangster_points,
            'gender'=>$this->gender,
            'birth_date'=>$this->DOB,
            'about'=>$this->about,
            'profile_pic_path'=> url('UserProfilePics', $this->profile_pic_path),            
            'is_active'=>$this->is_active,
            'is_verified'=>$this->is_verified,
            'is_following'=>$i_am_following,
            'created_at'=>$this->created_at->format('d M, yy'),
        ];
    }
}
