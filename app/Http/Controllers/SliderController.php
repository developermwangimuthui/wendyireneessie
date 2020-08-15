<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Yajra\Datatables\Datatables;
use Symfony\Component\HttpFoundation\Response;
class SliderController extends Controller
{
    function __construct()
    {
        //  $this->middleware('role:Super-Admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        if ($request->ajax()) {

            $slider = Slider::all();
            return Datatables::of($slider)
                ->addIndexColumn()
               ->addColumn('action', function ($data) {
                    return '<a class="btn btn-outline-danger btn-round waves-effect waves-light name="delete" id="' . $data->id . '" onclick="sliderdelete(\'' . $data->id . '\')"><i class="icon-trash"></i>Delete</a>&nbsp;&nbsp;<a class="btn btn-outline-warning btn-round waves-effect waves-light name="edit" href="' . route('slider.edit', $data->id) . '" id="' . $data->id . '" ><i class="ti-pencil"></i>Edit</a>';
                })

                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.slider.index');
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
        $imgdestination = '/SliderImages';
    //   dd($request->hasfile('main_image'));
        if ($request->hasfile('main_image')) {
            $sliderimages = $request->file('main_image');
            $imgname = $this->generateUniqueFileName($sliderimages, $imgdestination);
        }


        $slider = new Slider();
        $slider->title = $request->title;
        $slider->subtitle = $request->description;
        $slider->image_path = $imgname;
        if ($slider->save()) {
            return response([
                'success'=>True,
                'message'=>'Slider Updated Succesfully',
            ],Response::HTTP_OK);
        }else{
            return response([
                'error'=>True,
                'message'=>'Slider not updated ',
            ],Response::HTTP_OK);
        }
    }

        public function generateUniqueFileName($image, $destinationPath)
    {
        $initial = "music";
        $random = Str::random();
        $name = $initial  .$random. time() . '.' . $image->getClientOriginalExtension();
        if ($image->move(public_path() . $destinationPath, $name)) {
            return $name;
        } else {
            return null;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SLider  $sLider
     * @return \Illuminate\Http\Response
     */
    public function show(SLider $sLider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SLider  $sLider
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $sliders =Slider::where('id',$id)->get();
                 

        return view ('admin.slider.edit',compact('sliders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SLider  $sLider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $imgdestination = '/SliderImages';
        $gallerarray = [];
        if ($request->hasfile('main_image')) {
            // foreach ($request->file('upl') as $image) {
            $sliderimages = $request->file('main_image');
            $imgname = $this->generateUniqueFileName($sliderimages, $imgdestination);
        } else{
            $imgname = Slider::where('id',$id)->pluck('image_path')->first();
        } 
     $slider_update=Slider::where('id',$id)->update([
            'title'=>$request->title,
            'subtitle'=>$request->description,
            'image_path'=>$imgname
            ]); 
            return $slider_update;
        if($slider_update) {
            return response([
                'success'=>True,
                'message'=>'Slider Updated Succesfully',
            ],Response::HTTP_OK);
        }else{
            return response([
                'error'=>True,
                'message'=>'Slider not updated ',
            ],Response::HTTP_OK);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SLider  $sLider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if($request->ajax()){
        $slider_id = $request->slider_id;
        $slider = Slider::find($slider_id);
        if ($slider) {
            $slider->delete();
            return response([
                'success'=>True,
                'message'=>'Slider  deleted Succesfully',
            ],Response::HTTP_OK);
        } else {
            return response([
                'success'=>True,
                'message'=>'Slider  not deleted',
            ],Response::HTTP_OK);
        }
        }
    
    }
}
