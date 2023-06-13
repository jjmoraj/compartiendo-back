<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotificacionRequest;
use App\Http\Requests\UpdateNotificacionRequest;
use App\Models\Notificacion;
use Illuminate\Http\Request;
use App\Models\Perfil;
use Carbon\Carbon;

class NotificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getNotificaciones(Request $request)
    {
        $user = $request->user();

        $perfil = Perfil::where('user_id', $user->id)->first();

        $semanaActual = (new Carbon())
            ->addDay()
            ->endOfDay()
            ->toDateString();
        $semanaAnterior = (new Carbon())
            ->subWeek()
            ->endOfDay()
            ->toDateString();
        $notificaciones = Notificacion::where('receptor_id', $perfil->id)
            ->where('visto', false)
            ->orWhereBetween('created_at', [$semanaAnterior, $semanaActual])
            ->get();

        $visto = false;

        foreach ($notificaciones as $notificacion) {
            if ($notificacion->visto) {
                $visto = true;
            }
        }
        return response()->json([
            'success' => true,
            'notificaciones' => $notificaciones,
            'visto' => $visto,
        ]);
    }
    public function verNotificaciones(Request $request)
    {
        $user = $request->user();

        $perfil = Perfil::where('user_id', $user->id)->first();

        $notificaciones = Notificacion::where('receptor_id', $perfil->id)
            ->where('visto', false)
            ->get();

        foreach ($notificaciones as $notificacion) {
            $notificacion->visto = 1;
            $notificacion->save();
        }
        return response()->json([
            'success' => true,
        ]);
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
     * @param  \App\Http\Requests\StoreNotificacionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNotificacionRequest $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notificacion  $notificacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Notificacion $notificacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNotificacionRequest  $request
     * @param  \App\Models\Notificacion  $notificacion
     * @return \Illuminate\Http\Response
     */
    public function update(
        UpdateNotificacionRequest $request,
        Notificacion $notificacion
    ) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notificacion  $notificacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notificacion $notificacion)
    {
        //
    }
}
