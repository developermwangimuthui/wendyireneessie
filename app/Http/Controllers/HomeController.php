<?php

namespace App\Http\Controllers;

use App\Analytic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use App\Post;
use App\User;
use App\ReportPost;
use Yajra\Datatables\Datatables;
use Symfony\Component\HttpFoundation\Response;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth')->except('redirectPlayStore');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        $memes = Post::count();
        $users = User::count();
        $reportedMemes = Post::where('is_reported')->count();
        $reportedUsers = User::where('is_reported')->count();
       
        
        return view('admin.dashboard.index',compact('memes','users','reportedMemes','reportedUsers'));
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $memes = Post::with('user')->get();
            return Datatables::of($memes)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '
                    <a class="btn btn-outline-danger btn-round waves-effect waves-light name="delete" id="' . $data->id . '" onclick="memedelete(\'' . $data->id . '\')"><i class="icon-trash"></i>Delete</a>&nbsp;&nbsp;';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
// dd($categories);
        return view ('admin.memes.index');

    }
    public function reportedMemes(Request $request)
    {
//         $reportedMemes = ReportPost::with('posts')->get();
//  return $reportedMemes;
        if ($request->ajax()) {
            $reportedMemes = Post::with('user')->where('posts.is_reported','=',1)->get();
            return Datatables::of($reportedMemes)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '
                    <a class="btn btn-outline-danger btn-round waves-effect waves-light name="delete" id="' . $data->id . '" onclick="memedelete(\'' . $data->id . '\')"><i class="icon-trash"></i>Delete</a>&nbsp;&nbsp;';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
// dd($categories);
        return view ('admin.reportedMemes.index');

    }
    public function reportedUsers(Request $request)
    {
//         $reportedMemes = $reportedUsers = User::where('is_reported','=',1)->get();
//  return $reportedMemes;
        if ($request->ajax()) {
            $reportedUsers = User::where('is_reported','=',1)->get();
            return Datatables::of($reportedUsers)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '
                    <a class="btn btn-outline-danger btn-round waves-effect waves-light name="delete" id="' . $data->id . '" onclick="memedelete(\'' . $data->id . '\')"><i class="icon-trash"></i>Delete</a>&nbsp;&nbsp;';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
// dd($categories);
        return view ('admin.reportedUsers.index');

    }
    public function memeShow($id)
    {
      if (request()->ajax()) {
        $data = Post::where('id',$id)->pluck('file_path')->first();
        $type = Post::where('id',$id)->pluck('type')->first();
        // return $data;
        return response(['data' => $data,'type' => $type], Response::HTTP_OK);
      }
    }
    public function memeDestroy(Request $request)
    {
        
        if($request->ajax()){
                $meme_id = $request->meme_id;
                // dd($meme_id);
        $product = Post::find($meme_id);
        if ($product) {
            $product->delete();
            return response([
                'success'=>True,
                'message'=>'Meme  deleted Succesfully',
            ],Response::HTTP_OK);
        } else {
            return response([
                'errors'=>True,
                'message'=>'Meme  not deleted',
            ],Response::HTTP_OK);
        }
        }
    
    }
    public function userDestroy(Request $request)
    {
        
        if($request->ajax()){
                $user_id = $request->user_id;
                // dd($meme_id);
        $user = User::find($user_id);
        if ($user) {
            $user->delete();
            return response([
                'success'=>True,
                'message'=>'MemeLord  deleted Succesfully',
            ],Response::HTTP_OK);
        } else {
            return response([
                'errors'=>True,
                'message'=>'MemeLord  not deleted',
            ],Response::HTTP_OK);
        }
        }
    
    }

    public function redirectPlayStore(Request $request)
    {
        // $referer = $request->headers->get('referer');
        // $referer = URL::previous();
        $referer = $request->server('HTTP_REFERER');
                // $referer  = Request::server('HTTP_REFERER');
                

                 // dd($referer);
              $clientIP = request()->ip();
          
                $analytic = new Analytic();
                $analytic->referring_url = $referer;
                $analytic->ip_adress = $clientIP;
                $analytic->save();
            
        
        return Redirect::to('https://play.google.com/store/apps/details?id=com.trichain.kenyasihami');
    }
}
