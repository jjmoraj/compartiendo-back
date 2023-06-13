<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Models\Perfil;
use App\Models\Like;
use App\Models\Notificacion;

class LikeController extends Controller
{
    public function darLike(Request $request)
    {
        $user = $request->user();

        $perfil_emisor = Perfil::where('user_id', $user->id)->first();

        if ($request->like) {
            $like = new Like();

            $like->emisor_id = $perfil_emisor->id;
            $like->receptor_id = $request->perfil_id;

            $like->save();

            $hay_notificacion = Notificacion::where(
                'emisor_id',
                $perfil_emisor->id
            )
                ->where('receptor_id', $request->perfil_id)
                ->where('asunto', '¡Te han dado like!')
                ->first();

            if (!$hay_notificacion) {
                $notificacion = new Notificacion();

                $notificacion->emisor_id = $perfil_emisor->id;
                $notificacion->receptor_id = $request->perfil_id;
                $notificacion->asunto = '¡Te han dado like!';
                $notificacion->cuerpo = "¡{$perfil_emisor->nombre} te ha dado like!";
                $notificacion->save();
            }

            return response()->json([
                'success' => true,
                'like' => $like,
            ]);
        } else {
            $like = Like::where('emisor_id', $perfil_emisor->id)
                ->where('receptor_id', $request->perfil_id)
                ->first();

            $like->delete();

            return response()->json([
                'success' => true,
            ]);
        }
    }
}
