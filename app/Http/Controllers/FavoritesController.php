<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddDish as Dish;
use Illuminate\Support\Facades\Auth;
use App\Notifications\DishFavorited;
use App\Events\DishMarkedEvent;

class FavoritesController extends Controller
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

    public function togglefavorites(Dish $dish){
        $user = Auth::user();
        if($user->hasFavorited($dish)){
            $user->unfavorite($dish);
        }else{
            $user->favorite($dish);
            $dish->user->notify(new DishFavorited($user,$dish));
            // Send Notification Brodcast on this line
            broadcast(new DishMarkedEvent($dish->user->id));
          
        }

       return ($dish->favoriters()->count());
      
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
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
