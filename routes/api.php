<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MessageProducerController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function() {
    Route::group([
        'as' => 'mensagens'
    ], function(){
        Route::post('/mensagens',[MessageProducerController::class,'produzir']);
    });
});
