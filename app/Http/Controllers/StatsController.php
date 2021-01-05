<?php

namespace App\Http\Controllers;

use App\Stats;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Post;

class StatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $memes = Post::where('created_at', 'like', date('Y-m-d').'%')->count();
        $users_posted_today = Post::where('created_at', 'like', date('Y-m-d').'%')->distinct('user_id')->count('user_id');
        $users = User::where('created_at', 'like',  date('Y-m-d').'%')->count();
        $onlineusers = Stats::where('created_at', 'like',  date('Y-m-d').'%')->distinct('user_id')->count('user_id');
        // $reportedMemes = Post::where('is_reported','=',1)->count();
        // $reportedUsers = User::where('is_reported','=',1)->count();
        // dd ($onlineusers);

        return view('admin.stats.index',compact('memes','users','onlineusers','users_posted_today'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function hourly()
    {
        //
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
     * @param  \App\stats  $stats
     * @return \Illuminate\Http\Response
     */
    public function show(stats $stats)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\stats  $stats
     * @return \Illuminate\Http\Response
     */
    public function edit(stats $stats)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\stats  $stats
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, stats $stats)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\stats  $stats
     * @return \Illuminate\Http\Response
     */
    public function destroy(stats $stats)
    {
        //
    }
}
