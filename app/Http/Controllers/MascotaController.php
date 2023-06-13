<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreMascotaRequest;
use App\Http\Requests\UpdateMascotaRequest;
use App\Models\Mascota;
use App\Models\Perfil;
use App\Models\ImagenesMascota;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class MascotaController extends Controller
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
    public function create(Request $request)
    {
        $user = $request->user();

        $perfil = Perfil::where('user_id', $user->id)->first();

        $mascota = new Mascota();
        $mascota->perfil_id = $perfil->id;
        $mascota->nombre = $request->mascota['nombre'];
        $mascota->especie = $request->mascota['especie'];
        $mascota->edad = $request->mascota['edad'];
        $mascota->save();

        foreach ($request->imagenesMascota as $key => $imagenMascota) {
            if (!$imagenMascota['url']) {
                continue;
            }
            $imagen = new ImagenesMascota();
            $image_info = getimagesize($imagenMascota['url']);
            $ext = isset($image_info['mime'])
                ? explode('/', $image_info['mime'])[1]
                : '';

            $exp = explode(',', $imagenMascota['url']);
            $foto = $exp[1];

            $fecha = Carbon::now()->timestamp;
            $filename = "foto_{$request->user()->email}_{$key}_.png";
            $existe = Storage::disk('imgVivienda')->exists($filename);

            if ($existe) {
                Storage::disk('imgVivienda')->delete($filename);
            }
            $file = Storage::disk('imgMascota')->put(
                $filename,
                base64_decode($foto)
            );
            $imagen->mascota_id = $mascota->id;
            $imagen->nombre = $filename;
            $imagen->ruta = $file;
            $imagen->save();
            continue;
        }

        $mascota = Mascota::with('imagenes')
            ->where('perfil_id', $perfil->id)
            ->first();

        return response()->json([
            'success' => true,
            'mascota' => $mascota,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMascotaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMascotaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mascota  $mascota
     * @return \Illuminate\Http\Response
     */
    public function show(Mascota $mascota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mascota  $mascota
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $user = $request->user();

        $perfil = Perfil::where('user_id', $user->id)->first();

        $mascota = Mascota::where('perfil_id', $perfil->id)->first();

        $mascota->perfil_id = $perfil->id;
        $mascota->nombre = $request->mascota['nombre'];
        $mascota->especie = $request->mascota['especie'];
        $mascota->edad = $request->mascota['edad'];
        $mascota->save();

        foreach ($request->imagenesMascota as $key => $imagenMascota) {
            $imagen = ImagenesMascota::where('mascota_id', $mascota->id)
                ->where('nombre', 'LIKE', "%_{$key}_%")
                ->first();

            if ($imagenMascota['ha_cambiado']) {
                if ($imagen && $imagenMascota['url'] == null) {
                    $imagen->delete();
                    continue;
                }
                if ($imagen && $imagenMascota['url'] != null) {
                    $image_info = getimagesize($imagenMascota['url']);
                    $ext = isset($image_info['mime'])
                        ? explode('/', $image_info['mime'])[1]
                        : '';

                    $exp = explode(',', $imagenMascota['url']);
                    $foto = $exp[1];

                    $fecha = Carbon::now()->timestamp;
                    $filename = "foto_{$request->user()->email}_{$key}_.png";

                    $existe = Storage::disk('imgMascota')->exists($filename);

                    if ($existe) {
                        Storage::disk('imgMascota')->delete($filename);
                    }
                    $file = Storage::disk('imgMascota')->put(
                        $filename,
                        base64_decode($foto)
                    );
                    $imagen->mascota_id = $mascota->id;
                    $imagen->nombre = $filename;
                    $imagen->ruta = $file;
                    $imagen->save();
                    continue;
                }
            }
            if (!$imagen && $imagenMascota['url'] != null) {
                $imagen = new ImagenesMascota();
                $image_info = getimagesize($imagenMascota['url']);
                $ext = isset($image_info['mime'])
                    ? explode('/', $image_info['mime'])[1]
                    : '';

                $exp = explode(',', $imagenMascota['url']);
                $foto = $exp[1];

                $fecha = Carbon::now()->timestamp;
                $filename = "foto_{$request->user()->email}_{$key}_.png";
                $existe = Storage::disk('imgVivienda')->exists($filename);

                if ($existe) {
                    Storage::disk('imgVivienda')->delete($filename);
                }

                $file = Storage::disk('imgMascota')->put(
                    $filename,
                    base64_decode($foto)
                );
                $imagen->mascota_id = $mascota->id;
                $imagen->nombre = $filename;
                $imagen->ruta = $file;
                $imagen->save();
                continue;
            }
        }

        $mascota = Mascota::with('imagenes')
            ->where('perfil_id', $perfil->id)
            ->first();

        return response()->json([
            'success' => true,
            'mascota' => $mascota,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMascotaRequest  $request
     * @param  \App\Models\Mascota  $mascota
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMascotaRequest $request, Mascota $mascota)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mascota  $mascota
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $user = $request->user();

        $perfil = Perfil::where('user_id', $user->id)->first();
        $mascota = Mascota::where('perfil_id', $perfil->id)->first();

        if ($mascota) {
            $imagenesMascota = ImagenesMascota::where(
                'mascota_id',
                $mascota->id
            )->get();

            foreach ($imagenesMascota as $imagenMascota) {
                $imagenMascota->delete();
            }
            $mascota->delete();
        }

        return response()->json([
            'success' => true,
        ]);
    }
}
