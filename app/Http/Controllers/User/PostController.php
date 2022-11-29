<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\NotificationText;
use App\ValidationText;
use App\ManageText;
use App\Post;
use Image;
use File;
use Auth;
use App\Navigation;
use App\Listing;
use App\Setting;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
        $notify=NotificationText::all();
        $this->notify=$notify;

        $errorTexts=ValidationText::all();
        $this->errorTexts=$errorTexts;

        $websiteLang=ManageText::all();
        $this->websiteLang=$websiteLang;
    }

    public function index($id)
    {

        $user=Auth::guard('web')->user();
        $posts=Post::where(['listing_id'=>$id])->orderBy('id','desc')->paginate(10);
        $listing = Listing::where('id',$id)->first();
        $allPosts=Post::where('user_id',$user->id)->orderBy('id','desc')->get();

        $notify=$this->notify->where('id',32)->first()->custom_text;
        $websiteLang=$this->websiteLang;
        $menus=Navigation::all();

        return view('user.profile.listing.post.index',compact('posts','notify','websiteLang','menus','user','allPosts','listing'));
    }

    public function allPosts()
    {
        $user=Auth::guard('web')->user();
        $posts=Post::with('listing')->orderBy('id','desc')->paginate(10);
        $allPosts=Post::where('user_id',$user->id)->orderBy('id','desc')->get();

        $notify=$this->notify->where('id',32)->first()->custom_text;
        $websiteLang=$this->websiteLang;
        $menus=Navigation::all();

        return view('user.profile.post.index',compact('posts','notify','websiteLang','menus','user','allPosts'));
    }

    public function create($id=null)
    {
    	$user=Auth::guard('web')->user();
        $posts=Post::where(['user_id'=>$user->id])->orderBy('id','desc')->paginate(10);
        $allPosts=Post::where('user_id',$user->id)->orderBy('id','desc')->get();
        $listings=Listing::where('user_id',$user->id)->get();
        $listing = Listing::where('id',$id)->first();
        if(auth()->user()->type!='user' && $listings->count()==0){
            $notification=array(
                'messege'=>$this->notify->where('id',39)->first()->custom_text,
                'alert-type'=>'error'
            );

            return redirect()->route('user.dashboard')->with($notification);
        }
        $postCreateWithListingID = false;
        if($id == null){
            $listings=null;
            $postCreateWithListingID = true;
        }
        $notify=$this->notify->where('id',32)->first()->custom_text;
        $websiteLang=$this->websiteLang;
        $menus=Navigation::all();

        return view('user.profile.listing.post.create',compact('posts','postCreateWithListingID','listings','notify','websiteLang','menus','user','allPosts','listing'));
    }

   	public function store(Request $request,$listing_id=null)
   	{
        // dd($request->all());
   		   // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'title'=>'required|unique:posts',
            'slug'=>'required|unique:posts',
            'image'=>'file',
        ];

        $customMessages = [
            'title.required' => $this->errorTexts->where('id',18)->first()->custom_text,
            'title.unique' => $this->errorTexts->where('id',46)->first()->custom_text,
            'slug.required' => $this->errorTexts->where('id',19)->first()->custom_text,
            'slug.unique' => $this->errorTexts->where('id',45)->first()->custom_text,
            'listing_id.required' => $this->errorTexts->where('id',19)->first()->custom_text,
            'image.required' => $this->errorTexts->where('id',27)->first()->custom_text,
            'description.required' => $this->errorTexts->where('id',30)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);

        $post = new Post();

        // for image
        if($request->file('image')){
            $image=$request->image;
            $image_extention=$image->getClientOriginalExtension();
            $image_name= 'image-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$image_extention;
            $image_path='uploads/custom-images/'.$image_name;

            Image::make($image)
                ->resize(600,null,function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->crop(400,400)
                ->save(public_path($image_path));

            $post->image=$image_path;
        }


        $user=Auth::guard('web')->user();
        $post->user_id=$user->id;
        $post->title=$request->title;
        $post->slug=$request->slug;
        $post->listing_id=$listing_id??"0";
        $post->body=$request->description??"";
        $post->save();

        $notification=array(
            'messege'=>$this->notify->where('id',9)->first()->custom_text,
            'alert-type'=>'success'
        );

        if($listing_id==null){
            return redirect()->route('user.posts')->with($notification);
        }
        return redirect()->route('user.post.index',$listing_id)->with($notification);


   	}

   	 public function show($slug){
        $user=Auth::guard('web')->user();
        $post=Post::where(['user_id'=>$user->id,'slug'=>$slug])->first();
        if($post){
            $websiteLang=$this->websiteLang;
            $menus=Navigation::all();
            $currency=Setting::first();
            $logo=Setting::first();
            return view('user.profile.listing.post.show',compact('post','websiteLang','menus','currency','logo'));
        }else{
            $notification=array(
                'messege'=>$this->notify->where('id',7)->first()->custom_text,
                'alert-type'=>'error'
            );

            return redirect()->route('user.dashboard')->with($notification);
        }

    }

    public function edit($id)
    {
    	$user=Auth::guard('web')->user();
        $post=Post::where(['id'=>$id])->first();
        $listings=Listing::where('user_id',$user->id)->get();
        $notify=$this->notify->where('id',32)->first()->custom_text;
        $websiteLang=$this->websiteLang;
        $menus=Navigation::all();

        return view('user.profile.listing.post.edit',compact('post','notify','websiteLang','menus','user','listings'));
    }

    public function update(Request $request, $id)
    {
    	$post=Post::where(['id'=>$id])->first();

        // project demo mode check
        if(env('PROJECT_MODE')==0){
        $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
        return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'title'=>'required|unique:posts,title,'.$post->id,
            'slug'=>'required|unique:posts,slug,'.$post->id,
        ];

        $customMessages = [
            'title.required' => $this->errorTexts->where('id',18)->first()->custom_text,
            'title.unique' => $this->errorTexts->where('id',46)->first()->custom_text,
            'slug.required' => $this->errorTexts->where('id',19)->first()->custom_text,
            'slug.unique' => $this->errorTexts->where('id',45)->first()->custom_text,
            'listing_id.required' => $this->errorTexts->where('id',19)->first()->custom_text,
            'image.required' => $this->errorTexts->where('id',27)->first()->custom_text,
            'description.required' => $this->errorTexts->where('id',30)->first()->custom_text,
        ];

        $this->validate($request, $rules, $customMessages);


        $user=Auth::guard('web')->user();
        // for image
        if($request->file('image')){
            $old_image=$post->image;

            $image=$request->image;
            $extention=$image->getClientOriginalExtension();
            $name= 'image-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_path='uploads/custom-images/'.$name;

            Image::make($image)
            ->resize(1000,null,function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path($image_path));

            $post->image = $image_path;
            if(File::exists(public_path($old_image)))unlink(public_path($old_image));

        }

            $post->user_id=$user->id;
	        $post->title=$request->title;
	        $post->slug=$request->slug;
	        $post->body=$request->description??"";
            $post->save();


        $notification=array(
            'messege'=>$this->notify->where('id',8)->first()->custom_text,
            'alert-type'=>'success'
        );

        if(auth()->user()->type=='user' || $post->listing_id==0){
            return redirect()->route('user.posts')->with($notification);
        }
        return redirect()->route('user.post.index',$post->listing_id)->with($notification);

    }


    public function delete($id)
    {
        $post=Post::where(['id'=>$id])->first();
        $listing_id = (isset($post->listing_id) && !empty($post->listing_id))?$post->listing_id:null;
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
            }
            // end

        $old_image=$post->image;
        $post->delete();
        if(!empty($old_image)){
            if(File::exists(public_path($old_image)))unlink(public_path($old_image));
        }

        $notification=array(
            'messege'=>$this->notify->where('id',10)->first()->custom_text,
            'alert-type'=>'success'
        );

        if($listing_id ==null){
            return redirect()->route('user.posts')->with($notification);
        }
        return redirect()->route('user.post.index',$listing_id)->with($notification);
    }
}
