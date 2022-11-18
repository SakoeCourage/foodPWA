<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function deleteimage_ifexist($fullimagepath){
        
        Storage::delete($fullimagepath);
    }

    public  function storeimage($imagefile)
    {

        $profileimage = request()->user()->profile?->profileimage;
        if($profileimage){
         $this->deleteimage_ifexist('public/images/profileimages/'.$profileimage);
        }
        $image    = $imagefile;
        $newfilename =  Auth::user()->name;
        $filename = $newfilename . '.' . $image->getClientOriginalExtension();
        $mypath = 'public/images/profileimages/';
        if (!Storage::exists($mypath)) {
            Storage::makeDirectory($mypath, 0775, true, true);
        }
        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize(400, 400, function ($constraint) {
		    $constraint->aspectRatio();
		});
        
        $image_resize->save(public_path('storage/images/profileimages/' .$filename));  
        return ($filename);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       
        $request->validate([
            'profileimage' => 'nullable|image|mimes:tiff,jpeg,jpg,png|max:4048',
            'preference'=> 'nullable',
            'ownsretaurant' => 'nullable',
            'restaurant_name' => 'nullable',
            'restaurant_location' => 'nullable'

        ]);

       Profile::updateOrCreate([
            'user_id' => Auth::user()->id
       ],
       [    'profileimage'=> request()->hasFile('profileimage') ? $this->storeimage($request->profileimage): $request->user()->profile->profileimage,
            'preference' => request()->has('preference') ? $request->preference: $request->user()->profile->preference  ,
            'ownsrestaurant'=> request()->has('ownsrestaurant') ? $request->ownsrestaurant: $request->user()->profile->ownsrestaurant  ,
            'restaurant_name' => $request->restaurant_name ,
            'restaurant_location'=> $request->restaurant_location  
       ]);
        return('ok');
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
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
