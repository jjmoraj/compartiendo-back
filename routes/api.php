<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Perfil;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\MascotaController;
use App\Http\Controllers\ViviendaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['Las credenciales no son correctas'],
        ]);
    }

    return $user->createToken('token')->plainTextToken;
});

Route::post('/create/user', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $email = User::where('email', $request->email)->first();

    if ($email) {
        throw ValidationException::withMessages([
            'email' => ['Este correo electronico ya esta en uso'],
        ]);
    }
    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->save();

    $user = User::where('email', $request->email)->first();

    return $user->createToken('token')->plainTextToken;
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    $user = $request->user();

    $perfil = Perfil::with('imagenes')
        ->where('user_id', $request->user()->id)
        ->first();

    return response()->json([
        'user' => $user,
        'perfil' => $perfil,
    ]);
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/crear/perfil', [PerfilController::class, 'create']);
    Route::get('/perfiles', [PerfilController::class, 'getPerfiles']);
    Route::delete('/borrar/perfil', [PerfilController::class, 'delete']);
    Route::put('/modificar/perfil', [PerfilController::class, 'edit']);
    Route::get('/perfil/{perfil}', [PerfilController::class, 'show']);

    Route::post('/crear/vivienda', [ViviendaController::class, 'create']);
    Route::delete('/borrar/vivienda', [ViviendaController::class, 'delete']);
    Route::put('/modificar/vivienda', [ViviendaController::class, 'edit']);

    Route::post('/crear/mascota', [MascotaController::class, 'create']);
    Route::delete('/borrar/mascota', [MascotaController::class, 'delete']);
    Route::put('/modificar/mascota', [MascotaController::class, 'edit']);

    Route::post('/dar/like', [LikeController::class, 'darLike']);
    Route::get('/notificaciones', [
        NotificacionController::class,
        'getNotificaciones',
    ]);
    Route::post('/ver/notificaciones', [
        NotificacionController::class,
        'verNotificaciones',
    ]);
});
