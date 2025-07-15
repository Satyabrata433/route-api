<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\MemeController;
use App\Http\Controllers\UserAuthController;
use Illuminate\Routing\RouteSignatureParameters;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('signup',[UserAuthController::class,'signup']);
Route::post('login',[UserAuthController::class,'login']);

// Route::get("/test",function(){
//     return ["name" => "satya", "age" =>"24"];
// });
Route::group(['middleware'=>"auth:sanctum"],function(){
    Route::get('/students',[StudentController::class,'list']);
    Route::post('/add',[StudentController::class,'addStudent']);
    Route::put('/update-student',[StudentController::class,'updateStudent']);
    Route::delete('/delete-student/{id}',[StudentController::class,'deleteStudent']);
    Route::get('/search/{name}',[StudentController::class,'searchStudent']);

    Route::resource('member',MemeController::class);

});

Route::get('login',[UserAuthController::class,'login'])->name('login');



