<?php

use Illuminate\Http\Request;
use App\Watson\Assistant;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/teste', function(){
    return 'teste';
});

Route::post('/dialog', function(){
    $message = request()->input('message');

    $assistant = app()->make(Assistant::class);

    $response = $assistant->dialog($message);

    $response = json_decode($response, true);

    // print_r($response);
    $mensagens = [];
    foreach ($response['output']['generic'] as $arrayResposta) {
        // foreach ($arrayResposta as $resposta) {
            $mensagens[] = $arrayResposta['text'];
        // }
        
    }

    return $mensagens;
} );
