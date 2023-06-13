<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImagenesPerfilRequest;
use App\Http\Requests\UpdateImagenesPerfilRequest;
use App\Models\ImagenesPerfil;

class ImagenesPerfilController extends Controller
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
     * @param  \App\Http\Requests\StoreImagenesPerfilRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreImagenesPerfilRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ImagenesPerfil  $imagenesPerfil
     * @return \Illuminate\Http\Response
     */
    public function show(ImagenesPerfil $imagenesPerfil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ImagenesPerfil  $imagenesPerfil
     * @return \Illuminate\Http\Response
     */
    public function edit(ImagenesPerfil $imagenesPerfil)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateImagenesPerfilRequest  $request
     * @param  \App\Models\ImagenesPerfil  $imagenesPerfil
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateImagenesPerfilRequest $request, ImagenesPerfil $imagenesPerfil)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ImagenesPerfil  $imagenesPerfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImagenesPerfil $imagenesPerfil)
    {
        //
    }
}
