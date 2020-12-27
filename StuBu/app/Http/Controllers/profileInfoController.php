<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\profileInfo;
use Illuminate\Support\Facades\DB;
use Auth;

use App\Models\Comment;
use App\Models\Thread;


class profileInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        $user= Auth::user();
   
        $threads = Thread::where('user_id',$user->id)->latest()->get();
        $comments= Comment::where('user_id',$user->id)->where('commentable_type','App\Models\Thread')->get();
      
        return view('profile.index', compact('threads','comments','user'));
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
     
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(profileInfo $profile)
    {
        //
        $user= $profile;
        $threads = Thread::where('user_id',$user->id)->latest()->get();
        $comments= Comment::where('user_id',$user->id)->where('commentable_type','App\Models\Thread')->get();
      
        return view('profile.index',compact('threads','comments','user'));
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $user = Auth::user();


     if($request->hasfile('image')){
            $file=$request->file('image');
            $extension=$file->getClientOriginalExtension();
            $filename= time() . '.' . $extension;
            $file->move('images/profilePic/',$filename);
            $user->image=$filename;

            
        }

        $user->name= $request->name;
        $user->mobile_number= $request->mobile_number;
        $user->about_me= $request->about_me;
    

    

        if($request->has('password')){

            $user->password= bcrypt($request->password);
        }

        $user->save();

        $user= Auth::user();
        $threads = Thread::where('user_id',$user->id)->latest()->get();
        $comments= Comment::where('user_id',$user->id)->where('commentable_type','App\Models\Thread')->get();
      
        return view('profile.index', compact('threads','comments','user'));
       

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(profileInfo $user)
    {
        //
        
        $threads = Thread::where('user_id',$user->id)->latest()->get();
        $comments= Comment::where('user_id',$user->id)->where('commentable_type','App\Models\Thread')->get();

        return view('profile.index',compact('threads','comments','user'));
    }


}
