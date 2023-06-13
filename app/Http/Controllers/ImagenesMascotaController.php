<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImagenesMascotaRequest;
use App\Http\Requests\UpdateImagenesMascotaRequest;
use App\Models\ImagenesMascota;

class ImagenesMascotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
     * @param  \App\Http\Requests\StoreImagenesMascotaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreImagenesMascotaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ImagenesMascota  $imagenesMascota
     * @return \Illuminate\Http\Response
     */
    public function show(ImagenesMascota $imagenesMascota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ImagenesMascota  $imagenesMascota
     * @return \Illuminate\Http\Response
     */
    public function edit(ImagenesMascota $imagenesMascota)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateImagenesMascotaRequest  $request
     * @param  \App\Models\ImagenesMascota  $imagenesMascota
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateImagenesMascotaRequest $request, ImagenesMascota $imagenesMascota)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ImagenesMascota  $imagenesMascota
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImagenesMascota $imagenesMascota)
    {
        //
    }
}
