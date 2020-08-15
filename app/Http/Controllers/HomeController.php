<?php

namespace App\Http\Controllers;

use App\Analytic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use App\Post;
use App\User;
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
        // $this->middleware('auth');
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
        
        return view('admin.dashboard.index',compact('memes','users'));
    }
    public function index(Request $request)
    {
        // if ($request->ajax()) {
            $memes = Post::with('user')->get();
            return Datatables::of($memes)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '
                    <a class="btn btn-outline-danger btn-round waves-effect waves-light name="delete" id="' . $data->id . '" onclick="memedelete(\'' . $data->id . '\')"><i class="icon-trash"></i>Delete</a>&nbsp;&nbsp;';
                })
                ->rawColumns(['action'])
                ->make(true);
        // }
// dd($categories);
        return view ('admin.memes.index');

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

    public function redirectPlayStore(Request $request)
    {
        $referer = $request->headers->get('referer');
        // $referer = URL::previous();
        // $referer = $request->server('HTTP_REFERER');
        // dd($referer);
        if ($referer != null) {
            $status = Analytic::where('referring_url', $referer)->count();
            if ($status > 0) {
                $analytic = Analytic::where('referring_url', $referer)->first();
                $analytic->referring_url = $referer;
                $analytic->increment('clicks');
                $analytic->update();
            } else {
                $analytic = new Analytic();
                $analytic->referring_url = $referer;
                $analytic->increment('clicks');
                $analytic->save();
            }
        } else {
            $status = Analytic::where('referring_url', 'uknown')->count();
            if ($status > 0) {
                $analytic = Analytic::where('referring_url', 'uknown')->first();
                $analytic->increment('clicks');
                $analytic->update();
            } else {
                $analytic = new Analytic();
                $analytic->referring_url = 'uknown';
                $analytic->increment('clicks');
                $analytic->save();
            }
        }

        return Redirect::to('https://play.google.com/store/apps/details?id=com.trichain.kenyasihami');
    }
}
