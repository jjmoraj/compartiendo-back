<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePerfilRequest;
use App\Http\Requests\UpdatePerfilRequest;
use App\Models\Perfil;
use App\Models\ImagenesPerfil;
use App\Models\Vivienda;
use App\Models\ImagenesVivienda;
use App\Models\Mascota;
use App\Models\Like;
use App\Models\ImagenesMascota;
use Carbon\Carbon;

use Illuminate\Support\Facades\Storage;

class PerfilController extends Controller
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
    public function create(Request $request)
    {
        $perfil = new Perfil();

        $perfil->user_id = $request->user()->id;
        $perfil->nombre = $request->nuevoPerfil['nombre'];
        $perfil->primer_apellido = $request->nuevoPerfil['primer_apellido'];
        $perfil->segundo_apellido = $request->nuevoPerfil['segundo_apellido'];
        $perfil->alias = $request->nuevoPerfil['alias'];
        $perfil->edad = $request->nuevoPerfil['edad'];
        $perfil->comunidad = $request->nuevoPerfil['comunidad'];
        $perfil->codigo_comunidad = $request->nuevoPerfil['codigo_comunidad'];
        $perfil->provincia = $request->nuevoPerfil['provincia'];
        $perfil->codigo_provincia = $request->nuevoPerfil['codigo_provincia'];
        $perfil->localidad = $request->nuevoPerfil['localidad'];
        $perfil->codigo_localidad = $request->nuevoPerfil['codigo_localidad'];
        $perfil->telefono = $request->nuevoPerfil['telefono'];
        $perfil->fumador = $request->nuevoPerfil['fumador'];
        $perfil->save();

        if ($request->imagenesPerfil['imagen1']['url'] != null) {
            $imagen_perfil_1 = new ImagenesPerfil();
            $image_info = getimagesize(
                $request->imagenesPerfil['imagen1']['url']
            );
            $ext = isset($image_info['mime'])
                ? explode('/', $image_info['mime'])[1]
                : '';

            $exp = explode(',', $request->imagenesPerfil['imagen1']['url']);
            $foto = $exp[1];

            $fecha = Carbon::now()->timestamp;
            $filename = "foto_{$request->user()->email}_imagen1_.png";

            $file = Storage::disk('imgPerfil')->put(
                $filename,
                base64_decode($foto)
            );
            $imagen_perfil_1->perfil_id = $perfil->id;
            $imagen_perfil_1->nombre = $filename;
            $imagen_perfil_1->ruta = $file;
            $imagen_perfil_1->save();
        }
        if ($request->imagenesPerfil['imagen2']['url'] != null) {
            $imagen_perfil_2 = new ImagenesPerfil();
            $image_info = getimagesize(
                $request->imagenesPerfil['imagen2']['url']
            );
            $ext = isset($image_info['mime'])
                ? explode('/', $image_info['mime'])[1]
                : '';

            $exp = explode(',', $request->imagenesPerfil['imagen2']['url']);
            $foto = $exp[1];

            $fecha = Carbon::now()->timestamp;
            $filename = "foto_{$request->user()->email}_imagen2_.png";

            $file = Storage::disk('imgPerfil')->put(
                $filename,
                base64_decode($foto)
            );
            $imagen_perfil_2->perfil_id = $perfil->id;
            $imagen_perfil_2->nombre = $filename;
            $imagen_perfil_2->ruta = $file;
            $imagen_perfil_2->save();
        }
        if ($request->imagenesPerfil['imagen3']['url'] != null) {
            $imagen_perfil_3 = new ImagenesPerfil();
            $image_info = getimagesize(
                $request->imagenesPerfil['imagen3']['url']
            );
            $ext = isset($image_info['mime'])
                ? explode('/', $image_info['mime'])[1]
                : '';

            $exp = explode(',', $request->imagenesPerfil['imagen3']['url']);
            $foto = $exp[1];

            $fecha = Carbon::now()->timestamp;
            $filename = "foto_{$request->user()->email}_imagen3_.png";

            $file = Storage::disk('imgPerfil')->put(
                $filename,
                base64_decode($foto)
            );
            $imagen_perfil_3->perfil_id = $perfil->id;
            $imagen_perfil_3->nombre = $filename;
            $imagen_perfil_3->ruta = $file;
            $imagen_perfil_3->save();
        }
        if ($request->imagenesPerfil['imagen4']['url'] != null) {
            $imagen_perfil_4 = new ImagenesPerfil();
            $image_info = getimagesize(
                $request->imagenesPerfil['imagen4']['url']
            );
            $ext = isset($image_info['mime'])
                ? explode('/', $image_info['mime'])[1]
                : '';

            $exp = explode(',', $request->imagenesPerfil['imagen4']['url']);
            $foto = $exp[1];

            $fecha = Carbon::now()->timestamp;
            $filename = "foto_{$request->user()->email}_imagen4_.png";

            $file = Storage::disk('imgPerfil')->put(
                $filename,
                base64_decode($foto)
            );
            $imagen_perfil_4->perfil_id = $perfil->id;
            $imagen_perfil_4->nombre = $filename;
            $imagen_perfil_4->ruta = $file;
            $imagen_perfil_4->save();
        }
        $vivienda = new Vivienda();
        if ($request->nuevaVivienda['creado']) {
            $vivienda->perfil_id = $perfil->id;
            $vivienda->comunidad = $request->nuevaVivienda['comunidad'];
            $vivienda->codigo_comunidad =
                $request->nuevaVivienda['codigo_comunidad'];
            $vivienda->provincia = $request->nuevaVivienda['provincia'];
            $vivienda->codigo_provincia =
                $request->nuevaVivienda['codigo_provincia'];
            $vivienda->localidad = $request->nuevaVivienda['localidad'];
            $vivienda->codigo_localidad =
                $request->nuevaVivienda['codigo_localidad'];
            $vivienda->calle = $request->nuevaVivienda['calle'];
            $vivienda->numero = $request->nuevaVivienda['numero'];
            $vivienda->puerta = $request->nuevaVivienda['puerta'];
            $vivienda->habitaciones = $request->nuevaVivienda['habitaciones'];
            $vivienda->baños = $request->nuevaVivienda['baños'];
            $vivienda->compañeros = $request->nuevaVivienda['compañeros'];

            $vivienda->save();

            if ($request->imagenesVivienda['imagen1']['url'] != null) {
                $imagen_vivienda_1 = new ImagenesVivienda();
                $image_info = getimagesize(
                    $request->imagenesVivienda['imagen1']['url']
                );
                $ext = isset($image_info['mime'])
                    ? explode('/', $image_info['mime'])[1]
                    : '';

                $exp = explode(
                    ',',
                    $request->imagenesVivienda['imagen1']['url']
                );
                $foto = $exp[1];

                $fecha = Carbon::now()->timestamp;
                $filename = "foto_{$request->user()->email}_imagen1_.png";

                $file = Storage::disk('imgVivienda')->put(
                    $filename,
                    base64_decode($foto)
                );
                $imagen_vivienda_1->vivienda_id = $vivienda->id;
                $imagen_vivienda_1->nombre = $filename;
                $imagen_vivienda_1->ruta = $file;
                $imagen_vivienda_1->save();
            }
            if ($request->imagenesVivienda['imagen2']['url'] != null) {
                $imagen_vivienda_2 = new ImagenesVivienda();
                $image_info = getimagesize(
                    $request->imagenesVivienda['imagen2']['url']
                );
                $ext = isset($image_info['mime'])
                    ? explode('/', $image_info['mime'])[1]
                    : '';

                $exp = explode(
                    ',',
                    $request->imagenesVivienda['imagen2']['url']
                );
                $foto = $exp[1];

                $fecha = Carbon::now()->timestamp;
                $filename = "foto_{$request->user()->email}_imagen2_.png";

                $file = Storage::disk('imgVivienda')->put(
                    $filename,
                    base64_decode($foto)
                );
                $imagen_vivienda_2->vivienda_id = $vivienda->id;
                $imagen_vivienda_2->nombre = $filename;
                $imagen_vivienda_2->ruta = $file;
                $imagen_vivienda_2->save();
            }
            if ($request->imagenesVivienda['imagen3']['url'] != null) {
                $imagen_vivienda_3 = new ImagenesVivienda();
                $image_info = getimagesize(
                    $request->imagenesVivienda['imagen3']['url']
                );
                $ext = isset($image_info['mime'])
                    ? explode('/', $image_info['mime'])[1]
                    : '';

                $exp = explode(
                    ',',
                    $request->imagenesVivienda['imagen3']['url']
                );
                $foto = $exp[1];

                $fecha = Carbon::now()->timestamp;
                $filename = "foto_{$request->user()->email}_imagen3_.png";

                $file = Storage::disk('imgVivienda')->put(
                    $filename,
                    base64_decode($foto)
                );
                $imagen_vivienda_3->vivienda_id = $vivienda->id;
                $imagen_vivienda_3->nombre = $filename;
                $imagen_vivienda_3->ruta = $file;
                $imagen_vivienda_3->save();
            }
            if ($request->imagenesVivienda['imagen4']['url'] != null) {
                $imagen_vivienda_4 = new ImagenesVivienda();
                $image_info = getimagesize(
                    $request->imagenesVivienda['imagen4']['url']
                );
                $ext = isset($image_info['mime'])
                    ? explode('/', $image_info['mime'])[1]
                    : '';

                $exp = explode(
                    ',',
                    $request->imagenesVivienda['imagen4']['url']
                );
                $foto = $exp[1];

                $fecha = Carbon::now()->timestamp;
                $filename = "foto_{$request->user()->email}_imagen4_.png";

                $file = Storage::disk('imgVivienda')->put(
                    $filename,
                    base64_decode($foto)
                );
                $imagen_vivienda_4->vivienda_id = $vivienda->id;
                $imagen_vivienda_4->nombre = $filename;
                $imagen_vivienda_4->ruta = $file;
                $imagen_vivienda_4->save();
            }
        }
        $mascota = new Mascota();
        if ($request->nuevaMascota['creado']) {
            $mascota->perfil_id = $perfil->id;
            $mascota->nombre = $request->nuevaMascota['nombre'];
            $mascota->especie = $request->nuevaMascota['especie'];
            $mascota->edad = $request->nuevaMascota['edad'];
            $mascota->save();

            if ($request->imagenesMascota['imagen1']['url'] != null) {
                $imagen_mascota_1 = new ImagenesMascota();
                $image_info = getimagesize(
                    $request->imagenesMascota['imagen1']['url']
                );
                $ext = isset($image_info['mime'])
                    ? explode('/', $image_info['mime'])[1]
                    : '';

                $exp = explode(
                    ',',
                    $request->imagenesMascota['imagen1']['url']
                );
                $foto = $exp[1];

                $fecha = Carbon::now()->timestamp;
                $filename = "foto_{$request->user()->email}_imagen1_.png";

                $file = Storage::disk('imgMascota')->put(
                    $filename,
                    base64_decode($foto)
                );
                $imagen_mascota_1->mascota_id = $mascota->id;
                $imagen_mascota_1->nombre = $filename;
                $imagen_mascota_1->ruta = $file;
                $imagen_mascota_1->save();
            }
            if ($request->imagenesMascota['imagen2']['url'] != null) {
                $imagen_mascota_2 = new ImagenesMascota();
                $image_info = getimagesize(
                    $request->imagenesMascota['imagen2']['url']
                );
                $ext = isset($image_info['mime'])
                    ? explode('/', $image_info['mime'])[1]
                    : '';

                $exp = explode(
                    ',',
                    $request->imagenesMascota['imagen2']['url']
                );
                $foto = $exp[1];

                $fecha = Carbon::now()->timestamp;
                $filename = "foto_{$request->user()->email}_imagen2_.png";

                $file = Storage::disk('imgMascota')->put(
                    $filename,
                    base64_decode($foto)
                );
                $imagen_mascota_2->mascota_id = $mascota->id;
                $imagen_mascota_2->nombre = $filename;
                $imagen_mascota_2->ruta = $file;
                $imagen_mascota_2->save();
            }
        }

        return response()->json([
            'success' => true,
            'perfil' => $perfil,
            'vivienda' => $vivienda,
            'mascota' => $mascota,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $user = $request->user();

        $perfil = Perfil::where('user_id', $user->id)->first();

        $perfil->user_id = $request->user()->id;
        $perfil->nombre = $request->perfil['nombre'];
        $perfil->primer_apellido = $request->perfil['primer_apellido'];
        $perfil->segundo_apellido = $request->perfil['segundo_apellido'];
        $perfil->alias = $request->perfil['alias'];
        $perfil->edad = $request->perfil['edad'];
        $perfil->comunidad = $request->perfil['comunidad'];
        $perfil->codigo_comunidad = $request->perfil['codigo_comunidad'];
        $perfil->provincia = $request->perfil['provincia'];
        $perfil->codigo_provincia = $request->perfil['codigo_provincia'];
        $perfil->localidad = $request->perfil['localidad'];
        $perfil->codigo_localidad = $request->perfil['codigo_localidad'];
        $perfil->telefono = $request->perfil['telefono'];
        $perfil->fumador = $request->perfil['fumador'];
        $perfil->save();

        foreach ($request->imagenesPerfil as $key => $imagenPerfil) {
            $imagen = ImagenesPerfil::where('perfil_id', $perfil->id)
                ->where('nombre', 'LIKE', "%_{$key}_%")
                ->first();

            if ($imagenPerfil['ha_cambiado']) {
                if ($imagen && $imagenPerfil['url'] == null) {
                    $imagen->delete();
                    continue;
                }
                if ($imagen && $imagenPerfil['url'] != null) {
                    $image_info = getimagesize($imagenPerfil['url']);
                    $ext = isset($image_info['mime'])
                        ? explode('/', $image_info['mime'])[1]
                        : '';

                    $exp = explode(',', $imagenPerfil['url']);
                    $foto = $exp[1];

                    $fecha = Carbon::now()->timestamp;
                    $filename = "foto_{$request->user()->email}_{$key}_.png";

                    $existe = Storage::disk('imgPerfil')->exists($filename);

                    if ($existe) {
                        Storage::disk('imgPerfil')->delete($filename);
                    }

                    $file = Storage::disk('imgPerfil')->put(
                        $filename,
                        base64_decode($foto)
                    );
                    $imagen->perfil_id = $perfil->id;
                    $imagen->nombre = $filename;
                    $imagen->ruta = $file;
                    $imagen->save();
                    continue;
                }
            }
            if (!$imagen && $imagenPerfil['url'] != null) {
                $imagen = new ImagenesPerfil();
                $image_info = getimagesize($imagenPerfil['url']);
                $ext = isset($image_info['mime'])
                    ? explode('/', $image_info['mime'])[1]
                    : '';

                $exp = explode(',', $imagenPerfil['url']);
                $foto = $exp[1];

                $fecha = Carbon::now()->timestamp;
                $filename = "foto_{$request->user()->email}_{$key}_.png";

                $existe = Storage::disk('imgPerfil')->exists($filename);

                if ($existe) {
                    Storage::disk('imgPerfil')->delete($filename);
                }
                $file = Storage::disk('imgPerfil')->put(
                    $filename,
                    base64_decode($foto)
                );
                $imagen->perfil_id = $perfil->id;
                $imagen->nombre = $filename;
                $imagen->ruta = $file;
                $imagen->save();
                continue;
            }
        }

        $perfil = Perfil::with('imagenes')
            ->where('user_id', $user->id)
            ->first();

        return response()->json([
            'success' => true,
            'perfil' => $perfil,
        ]);
    }

    public function delete(Request $request)
    {
        $user = $request->user();

        $perfil = Perfil::where('user_id', $user->id)->first();

        $imagenes = ImagenesPerfil::where('perfil_id', $perfil->id)->get();

        foreach ($imagenes as $imagen) {
            $imagen->delete();
        }

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

        $perfil->delete();
        $user->delete();

        return response()->json([
            'success' => true,
        ]);
    }

    public function getPerfiles(Request $request)
    {
        $user = $request->user();

        $miPerfil = Perfil::where('user_id', $user->id)->first();

        if ($request->localidad != 'false') {
            $perfiles = Perfil::with('imagenes', 'mascota', 'vivienda')
                ->where('id', '!=', $miPerfil->id)
                ->where('codigo_comunidad', $request->comunidad)
                ->where('codigo_provincia', $request->provincia)
                ->where('codigo_localidad', $request->localidad)
                ->whereBetween('edad', [
                    intval($request->edad_desde),
                    intval($request->edad_hasta),
                ])
                ->get();

            foreach ($perfiles as $perfil) {
                $like = Like::where('emisor_id', $miPerfil->id)
                    ->where('receptor_id', $perfil->id)
                    ->first();
                $perfil->like = isset($like);
            }

            return response()->json([
                'success' => true,
                'perfiles' => $perfiles,
            ]);
        }
        if ($request->provincia != 'false') {
            $perfiles = Perfil::with('imagenes', 'mascota', 'vivienda')
                ->where('id', '!=', $miPerfil->id)
                ->where('codigo_comunidad', $request->comunidad)
                ->where('codigo_provincia', $request->provincia)
                ->whereBetween('edad', [
                    intval($request->edad_desde),
                    intval($request->edad_hasta),
                ])
                ->get();

            foreach ($perfiles as $perfil) {
                $like = Like::where('emisor_id', $miPerfil->id)
                    ->where('receptor_id', $perfil->id)
                    ->first();
                $perfil->like = isset($like);
            }

            return response()->json([
                'success' => true,
                'perfiles' => $perfiles,
            ]);
        }
        if ($request->comunidad != 'false') {
            $perfiles = Perfil::with('imagenes', 'mascota', 'vivienda')
                ->where('id', '!=', $miPerfil->id)
                ->where('codigo_comunidad', $request->comunidad)
                ->whereBetween('edad', [
                    intval($request->edad_desde),
                    intval($request->edad_hasta),
                ])
                ->get();

            foreach ($perfiles as $perfil) {
                $like = Like::where('emisor_id', $miPerfil->id)
                    ->where('receptor_id', $perfil->id)
                    ->first();
                $perfil->like = isset($like);
            }

            return response()->json([
                'success' => true,
                'perfiles' => $perfiles,
            ]);
        }

        $perfiles = Perfil::with('imagenes', 'mascota', 'vivienda')
            ->where('id', '!=', $miPerfil->id)
            ->whereBetween('edad', [
                intval($request->edad_desde),
                intval($request->edad_hasta),
            ])
            ->get();

        foreach ($perfiles as $perfil) {
            $like = Like::where('emisor_id', $miPerfil->id)
                ->where('receptor_id', $perfil->id)
                ->first();
            $perfil->like = isset($like);
        }

        return response()->json([
            'success' => true,
            'perfiles' => $perfiles,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        $perfil = Perfil::with('imagenes')
            ->where('id', $perfil->id)
            ->first();

        $vivienda = Vivienda::with('imagenes')
            ->where('perfil_id', $perfil->id)
            ->first();

        $mascota = Mascota::with('imagenes')
            ->where('perfil_id', $perfil->id)
            ->first();

        return response()->json([
            'success' => true,
            'perfil' => $perfil,
            'vivienda' => $vivienda,
            'mascota' => $mascota,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePerfilRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePerfilRequest $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePerfilRequest  $request
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePerfilRequest $request, Perfil $perfil)
    {
        //
    }
}
