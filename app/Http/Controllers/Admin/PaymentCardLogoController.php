<?php

namespace App\Http\Controllers\Admin;

use App\PaymentCardLogo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\ManageText;
use App\NotificationText;
use App\ValidationText;

class PaymentCardLogoController extends Controller
{

    public $notify;
    public $errorTexts;
    public $websiteLang;

    public function __construct()
    {
        $this->middleware('auth:admin');

        $websiteLang=ManageText::all();
        $this->websiteLang=$websiteLang;

        $notify=NotificationText::all();
        $this->notify=$notify;

        $errorTexts=ValidationText::all();
        $this->errorTexts=$errorTexts;
    }

    public function index()
    {
        $icons=PaymentCardLogo::all();
        $websiteLang=$this->websiteLang;
        return view('admin.card.index',compact('icons','websiteLang'));
    }


    public function store(Request $request)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'icon'=>'required',
            'status'=>'required'
        ];

        $customMessages = [
            'icon.required' => $this->errorTexts->where('id',42)->first()->custom_text,
            'status.required' => $this->errorTexts->where('id',34)->first()->custom_text,

        ];

        $this->validate($request, $rules, $customMessages);

        $icon=new PaymentCardLogo();
        $icon->icon=$request->icon;
        $icon->status=$request->status;
        $icon->save();
        $notification=array(
            'messege'=>$this->notify->where('id',9)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.card-icon.index')->with($notification);
    }


    public function update(Request $request, $id)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'icon'=>'required',
            'status'=>'required'
        ];

        $customMessages = [
            'icon.required' => $this->errorTexts->where('id',42)->first()->custom_text,
            'status.required' => $this->errorTexts->where('id',34)->first()->custom_text,

        ];

        $this->validate($request, $rules, $customMessages);

        $icon=PaymentCardLogo::find($id);
        $icon->icon=$request->icon;
        $icon->status=$request->status;
        $icon->save();
        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.card-icon.index')->with($notification);
    }


    public function destroy($id)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $icon=PaymentCardLogo::find($id);
        $icon->delete();
        $notification=array(
            'messege'=>$this->notify->where('id',9)->first()->custom_text,
            'alert-type'=>'success'
        );

        return redirect()->route('admin.card-icon.index')->with($notification);
    }


    public function changeStatus($id){
        $icon=PaymentCardLogo::find($id);
        if($icon->status==1){
            $icon->status=0;
            $message=$this->notify->where('id',12)->first()->custom_text;
        }else{
            $icon->status=1;
            $message=$this->notify->where('id',11)->first()->custom_text;
        }
        $icon->save();
        return response()->json($message);

    }
}
