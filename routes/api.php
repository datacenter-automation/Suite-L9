<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/chart/{model}', function ($model) {
    $model = sprintf("\\App\\Models\\%s", ucfirst($model))::all();

    $data = collect([]);
    foreach ($model as $m) {
        $data->add([
            'id' => $m->id,
            'fullName' => $m->name,
            'userName' => $m->username,
            'emailAddress' => $m->email,
            'profilePhoto' => ['path' => $m->profile_photo_path, 'url' => $m->profile_photo_url],
            'createdAt' => $m->created_at
        ]);
    }

    $data = collect(['data' => $data]);

    return dd($data->first());
});

