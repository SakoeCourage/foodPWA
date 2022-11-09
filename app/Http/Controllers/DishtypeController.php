<?php

namespace App\Http\Controllers;

use App\Models\dishtype;
use Illuminate\Http\Request;

class DishtypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return dishtype::get(['dishtype','id']);
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
     * @param  \App\Models\dishtype  $dishtype
     * @return \Illuminate\Http\Response
     */
    public function show(dishtype $dishtype)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\dishtype  $dishtype
     * @return \Illuminate\Http\Response
     */
    public function edit(dishtype $dishtype)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\dishtype  $dishtype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, dishtype $dishtype)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\dishtype  $dishtype
     * @return \Illuminate\Http\Response
     */
    public function destroy(dishtype $dishtype)
    {
        //
    }
}
