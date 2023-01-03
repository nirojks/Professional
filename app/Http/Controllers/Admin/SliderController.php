<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Slider;
use App\SliderImage;
use App\ManageText;
use Illuminate\Http\Request;
use Image;
use File;

use App\NotificationText;
use App\ValidationText;
class SliderController extends Controller
{
    public $notify;
    public $errorTexts;
    public function __construct()
    {
        $this->middleware('auth:admin');

        $notify=NotificationText::all();
        $this->notify=$notify;

        $errorTexts=ValidationText::all();
        $this->errorTexts=$errorTexts;
    }

    public function index()
    {
        $slider=Slider::where('type','=','banner')->first();
        $slider_images=Slider::where('type','=','slider')->get();
        $websiteLang=ManageText::all();
        return view('admin.slider.index',compact('slider','websiteLang','slider_images'));
    }


    public function update(Request $request, $id=null)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'image'=>'required'
        ];

        $customMessages = [
            'image.required' => $this->errorTexts->where('id',27)->first()->custom_text,

        ];

        $this->validate($request, $rules, $customMessages);

        if(!empty($id)){
            $slider=Slider::find($id);
        }else{
            $slider= new Slider();
        }
        
        $old_slider=$slider->image;
        $image=$request->image;
        $extention=$image->getClientOriginalExtension();
        $name= 'home-page-banner-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
        $image_path='uploads/website-images/'.$name;

        Image::make($image)
            ->resize(1000,null,function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path($image_path));

        $slider->image=$image_path;
        // $slider->status=$request->status;
        $slider->type='banner';
        $slider->save();

        if(!empty($id)){
            if(File::exists(public_path($old_slider)))unlink(public_path($old_slider));
        }

        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return back()->with($notification);
    }

    public function storeSlider(Request $request)
    {
        
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'image'=>'required'
        ];

        $customMessages = [
            'image.required' => $this->errorTexts->where('id',27)->first()->custom_text,

        ];

        $this->validate($request, $rules, $customMessages);

        $slider= new Slider();
        $old_slider=$slider->image;
        $image=$request->image;
        $extention=$image->getClientOriginalExtension();
        $name= 'home-page-slider-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
        $image_path='uploads/slider-images/'.$name;

        Image::make($image)
            ->resize(1000,null,function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path($image_path));

        $slider->image=$image_path;
        $slider->type='slider';
        $slider->save();

        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return back()->with($notification);
    }

    public function updateSlider(Request $request, $id)
    {
        
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'image'=>'required'
        ];

        $customMessages = [
            'image.required' => $this->errorTexts->where('id',27)->first()->custom_text,

        ];

        $this->validate($request, $rules, $customMessages);

        $slider=Slider::find($id);
        $old_slider=$slider->image;
        $image=$request->image;
        $extention=$image->getClientOriginalExtension();
        $name= 'home-page-slider-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
        $image_path='uploads/slider-images/'.$name;

        Image::make($image)
            ->resize(1000,null,function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path($image_path));

        $slider->image=$image_path;
        $slider->status=0;
        $slider->type='slider';
        $slider->save();

        if(File::exists(public_path($old_slider)))unlink(public_path($old_slider));

        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return back()->with($notification);
    }



}
