<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreViviendaRequest;
use App\Http\Requests\UpdateViviendaRequest;
use App\Models\Vivienda;
use App\Models\Perfil;
use App\Models\ImagenesVivienda;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ViviendaController extends Controller
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

        $vivienda = new Vivienda();

        $vivienda->perfil_id = $perfil->id;
        $vivienda->comunidad = $request->vivienda['comunidad'];
        $vivienda->codigo_comunidad = $request->vivienda['codigo_comunidad'];
        $vivienda->provincia = $request->vivienda['provincia'];
        $vivienda->codigo_provincia = $request->vivienda['codigo_provincia'];
        $vivienda->localidad = $request->vivienda['localidad'];
        $vivienda->codigo_localidad = $request->vivienda['codigo_localidad'];
        $vivienda->calle = $request->vivienda['calle'];
        $vivienda->numero = $request->vivienda['numero'];
        $vivienda->puerta = $request->vivienda['puerta'];
        $vivienda->habitaciones = $request->vivienda['habitaciones'];
        $vivienda->baños = $request->vivienda['baños'];
        $vivienda->compañeros = $request->vivienda['compañeros'];

        $vivienda->save();

        foreach ($request->imagenesVivienda as $key => $imagenVivienda) {
            if (!$imagenVivienda['url']) {
                continue;
            }
            $imagen = new ImagenesVivienda();
            $image_info = getimagesize($imagenVivienda['url']);
            $ext = isset($image_info['mime'])
                ? explode('/', $image_info['mime'])[1]
                : '';

            $exp = explode(',', $imagenVivienda['url']);
            $foto = $exp[1];

            $fecha = Carbon::now()->timestamp;
            $filename = "foto_{$request->user()->email}_{$key}_.png";
            $existe = Storage::disk('imgVivienda')->exists($filename);

            if ($existe) {
                Storage::disk('imgVivienda')->delete($filename);
            }
            $file = Storage::disk('imgVivienda')->put(
                $filename,
                base64_decode($foto)
            );
            $imagen->vivienda_id = $vivienda->id;
            $imagen->nombre = $filename;
            $imagen->ruta = $file;
            $imagen->save();
            continue;
        }

        $vivienda = Vivienda::with('imagenes')
            ->where('perfil_id', $perfil->id)
            ->first();

        return response()->json([
            'success' => true,
            'vivienda' => $vivienda,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreViviendaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreViviendaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vivienda  $vivienda
     * @return \Illuminate\Http\Response
     */
    public function show(Vivienda $vivienda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vivienda  $vivienda
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $user = $request->user();

        $perfil = Perfil::where('user_id', $user->id)->first();

        $vivienda = Vivienda::where('perfil_id', $perfil->id)->first();

        $vivienda->perfil_id = $perfil->id;
        $vivienda->comunidad = $request->vivienda['comunidad'];
        $vivienda->provincia = $request->vivienda['provincia'];
        $vivienda->localidad = $request->vivienda['localidad'];
        $vivienda->calle = $request->vivienda['calle'];
        $vivienda->numero = $request->vivienda['numero'];
        $vivienda->puerta = $request->vivienda['puerta'];
        $vivienda->habitaciones = $request->vivienda['habitaciones'];
        $vivienda->baños = $request->vivienda['baños'];
        $vivienda->compañeros = $request->vivienda['compañeros'];

        $vivienda->save();

        foreach ($request->imagenesVivienda as $key => $imagenVivienda) {
            $imagen = ImagenesVivienda::where('vivienda_id', $vivienda->id)
                ->where('nombre', 'LIKE', "%_{$key}_%")
                ->first();

            if ($imagenVivienda['ha_cambiado']) {
                if ($imagen && $imagenVivienda['url'] == null) {
                    $imagen->delete();
                    continue;
                }
                if ($imagen && $imagenVivienda['url'] != null) {
                    $image_info = getimagesize($imagenVivienda['url']);
                    $ext = isset($image_info['mime'])
                        ? explode('/', $image_info['mime'])[1]
                        : '';

                    $exp = explode(',', $imagenVivienda['url']);
                    $foto = $exp[1];

                    $fecha = Carbon::now()->timestamp;
                    $filename = "foto_{$request->user()->email}_{$key}_.png";

                    $existe = Storage::disk('imgVivienda')->exists($filename);

                    if ($existe) {
                        Storage::disk('imgVivienda')->delete($filename);
                    }

                    $file = Storage::disk('imgVivienda')->put(
                        $filename,
                        base64_decode($foto)
                    );
                    $imagen->vivienda_id = $vivienda->id;
                    $imagen->nombre = $filename;
                    $imagen->ruta = $file;
                    $imagen->save();
                    continue;
                }
            }
            if (!$imagen && $imagenVivienda['url'] != null) {
                $imagen = new ImagenesVivienda();
                $image_info = getimagesize($imagenVivienda['url']);
                $ext = isset($image_info['mime'])
                    ? explode('/', $image_info['mime'])[1]
                    : '';

                $exp = explode(',', $imagenVivienda['url']);
                $foto = $exp[1];

                $fecha = Carbon::now()->timestamp;
                $filename = "foto_{$request->user()->email}_{$key}_.png";

                $existe = Storage::disk('imgVivienda')->exists($filename);

                if ($existe) {
                    Storage::disk('imgVivienda')->delete($filename);
                }
                $file = Storage::disk('imgVivienda')->put(
                    $filename,
                    base64_decode($foto)
                );
                $imagen->vivienda_id = $vivienda->id;
                $imagen->nombre = $filename;
                $imagen->ruta = $file;
                $imagen->save();
                continue;
            }
        }

        $vivienda = Vivienda::with('imagenes')
            ->where('perfil_id', $perfil->id)
            ->first();

        return response()->json([
            'success' => true,
            'vivienda' => $vivienda,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateViviendaRequest  $request
     * @param  \App\Models\Vivienda  $vivienda
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateViviendaRequest $request, Vivienda $vivienda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vivienda  $vivienda
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $user = $request->user();

        $perfil = Perfil::where('user_id', $user->id)->first();
        $vivienda = Vivienda::where('perfil_id', $perfil->id)->first();

        if ($vivienda) {
            $imagenesVivienda = ImagenesVivienda::where(
                'vivienda_id',
                $vivienda->id
            )->get();

            foreach ($imagenesVivienda as $imagenVivienda) {
                $imagenVivienda->delete();
            }
            $vivienda->delete();
        }

        return response()->json([
            'success' => true,
        ]);
    }
}
