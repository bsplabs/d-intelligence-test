<?php

use App\Http\Controllers\Api\PassportAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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

Route::group(['middleware' => ['cors', 'json.response']], function() {
    Route::post('/login', [PassportAuthController::class, 'login'])->name('login.api');
    Route::post('/register', [PassportAuthController::class, 'register'])->name('register.api');

    Route::middleware('auth:api')->group(function() {
        // Logout
        Route::post('/logout', [PassportAuthController::class, 'logout'])->name('logout.api');
        
        
        /**
         * Provinces
         */
        Route::get('/provinces', function() {
            $provinces = DB::table('provinces')->get();
            return response([
                'status' => 'success',
                'data' => array(
                    'provinces' => $provinces
                )
            ], 200);
        });

        Route::get('/provinces/{id}', function($id) {
            $province = DB::table('provinces')->where('id', $id)->get();
            return response([
                'status' => 'success',
                'data' => array(
                    'provinces' => $province
                )
            ], 200);
        });

        Route::get('/code/{code}/province', function($code) {
            $province = DB::table('provinces')->where('code', $code)->get();
            return response([
                'status' => 'success',
                'data' => array(
                    'provinces' => $province
                )
            ], 200);
        });

    
        /**
         * Geographies
         */
        Route::get('/geographies', function() {
            $geographies = DB::table('geographies')->get();
            return response([
                'status' => 'success',
                'data' => array(
                    'geographies' => $geographies
                )
            ], 200);
        });

        Route::get('/geographies/{id}', function($id) {
            $geographies = DB::table('geographies')->where('id', $id)->get();
            return response([
                'status' => 'success',
                'data' => array(
                    'geographies' => $geographies
                )
            ], 200);
        });

        Route::get('/geographies/{id}/provinces', function($geography_id) {
            $province = DB::table('provinces')->where('geography_id', $geography_id)->get();
            return response([
                'status' => 'success',
                'data' => array(
                    'provinces' => $province
                )
            ], 200);
        });

    });
});

Route::fallback(function () {
    return response([
        'status' => 'success',
        'message' => 'The requested URL was not found'
    ], 404);
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
