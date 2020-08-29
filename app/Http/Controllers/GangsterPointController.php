<?php

namespace App\Http\Controllers;

use App\GangsterPoint;
use App\Payment;
use Illuminate\Http\Request;
use Auth;
use App\User;
use Symfony\Component\HttpFoundation\Response;
class GangsterPointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getGansterPoints($user)
    {
       
        $redeemed_points = Payment::where('user_id',$user->id)->pluck('redeemed')->sum();
        $cumulative_points = GangsterPoint::where('user_id',$user->id)->pluck('cumulative_gangster_points')->first();

        $redeemable_points = $cumulative_points - $redeemed_points;
        return $redeemable_points;

    }
    public function getCumulativeGansterPoints($user)
    {
       
        $cumulative_points = GangsterPoint::where('user_id',$user->id)->pluck('cumulative_gangster_points')->first();

        return $cumulative_points;

    }
    public function redeem(Request $request)
    {
        $user = Auth::user();

        $redeemed_points = Payment::where('user_id',$user->id)->pluck('redeemed')->sum();
        $cumulative_points = GangsterPoint::where('user_id',$user->id)->pluck('cumulative_gangster_points')->first();

        $redeemable_points = $cumulative_points- $redeemed_points;
// dd($redeemable_points);
        $payment= 0;
        $redeemed= 0;
        $remaining= 0;
        if ($redeemable_points>=200 && $redeemable_points<300) {
            $payment= 100;
            $redeemed = 200;
            $remaining = $redeemable_points-200;
        }elseif ($redeemable_points>=300 && $redeemable_points<500) {
            $payment= 170;

            $redeemed = 300;
            $remaining = $redeemable_points-300;
        }elseif ($redeemable_points>=500 && $redeemable_points<1000) {
            $payment= 300;

            $redeemed = 500;
            $remaining = $redeemable_points-500;
        }elseif ($redeemable_points>=1000) {
            $redeemed= (int)($redeemable_points /1000 ) *1000;
            $payment= (int)($redeemable_points /1000 ) * 750;
            $remaining = ($redeemable_points %1000 );
        }else{

        }
        if ($redeemed ==0) {
            return response([
                'error' => False,
                'message' => 'You do not have enongh gangster points to redeem.Your balance is '.$redeemable_points.' gangsterpoints',
                
            ], Response::HTTP_OK);
        }else{

            $newpayment = new Payment();
            $newpayment->user_id = $user->id;
            $newpayment->redeemed=$redeemed;
            $newpayment->amount=$payment;
            if ($newpayment->save()) {
    
                return response([
                    'error' => False,
                    'message' => 'You have succesfully redeemed '.number_format($redeemed).' gangsterpoints .Your payment of KSH '.number_format($payment).' will be processed within 4 hours',
                    
                ], Response::HTTP_OK);
            }
        }


    }
    public function calculateGangsterPoints($user)
    {

        // $user = Auth::user();
        $followers_count = $user->followers()->count();
        $likes_count = 0;
        foreach($user->posts as $post){
            $likes_count += $post->likers()->count();
        }
        $gangsterPoints =($followers_count * 3) + $likes_count;
        // store the gansterpoints
        $status = GangsterPoint::where('user_id',$user->id)->count();
        if ($status>0) {
            GangsterPoint::where('user_id',$user->id)->update([
                'cumulative_gangster_points'=>$gangsterPoints,
            ]);
            
        }else{

            $points = new GangsterPoint();
            $points->cumulative_gangster_points = $gangsterPoints; 
            $points->user_id = $user->id; 
            $points->save(); 
        }
        return $gangsterPoints;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GangsterPoint  $gangsterPoint
     * @return \Illuminate\Http\Response
     */
    public function show(GangsterPoint $gangsterPoint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GangsterPoint  $gangsterPoint
     * @return \Illuminate\Http\Response
     */
    public function edit(GangsterPoint $gangsterPoint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GangsterPoint  $gangsterPoint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GangsterPoint $gangsterPoint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GangsterPoint  $gangsterPoint
     * @return \Illuminate\Http\Response
     */
    public function destroy(GangsterPoint $gangsterPoint)
    {
        //
    }
}
