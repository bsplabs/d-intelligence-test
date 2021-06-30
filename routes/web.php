<?php

use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
  $geographies = DB::table('geographies')->get();
  $provinces = DB::table('provinces')
    ->leftJoin('geographies', 'provinces.geography_id', '=', 'geographies.id')
    ->select('provinces.*', 'geographies.name AS geography_name', 'geographies.id AS geography_id')
    ->orderBy('id', 'desc')
    ->paginate(10);
  // dd($provinces);
  return view('welcome', ['provinces' => $provinces, 'geographies' => $geographies]);
});


/**
 * CREATE PROVINCE
 */
Route::post('/provices/create', function(Request $request) {
  $validator = Validator::make($request->all(), [
    'province_th' => 'required',
    'province_en' => 'required',
    'province_geography_id' => 'required'
  ]);

  if ($validator->fails()) {
    return response()->json([
      'status' => 'error',
      'errors' => $validator->errors()
    ]);
  } 

  $createProvince = DB::table('provinces')
    ->insertOrIgnore([
      'name_th' => $request->province_th,
      'name_en' => $request->province_en,
      'geography_id' => $request->province_geography_id
    ]);

  return response()->json([
    'status' => 'success',
    'data' => $createProvince,
    'errors' => null
  ]);

})->name('province.create');


/**
 * EDIT PROVICE
 */

// สำหรับ Request Form
// Route::get('/provices/{province_id}/edit', function() {

// })->name('province.edit');

Route::patch('/provices/edit', function(Request $request) {
  // $validator = $request->validate([
  //   'province_id' => 'required',
  //   'province_th' => 'required',
  //   'province_en' => 'required'
  // ]);

  $validator = Validator::make($request->all(), [
    'province_id' => 'required',
    'province_th' => 'required',
    'province_en' => 'required',
    'province_geography_id' => 'required'
  ]);

  if ($validator->fails()) {
    return response()->json([
      'status' => 'error',
      'errors' => $validator->errors()
    ]);
  } 

  $updateProvince = DB::table('provinces')
    ->where('id', $request->province_id)
    ->update([
      'name_th' => $request->province_th,
      'name_en' => $request->province_en,
      'geography_id' => $request->province_geography_id
    ]);

  return response()->json([
    'status' => 'success',
    'data' => $updateProvince,
    'errors' => null
  ]);

})->name('province.edit');



/**
 * DELETE PROVINCE
 */

// Route::delete('/provices/{province_id}', function() {
//   print_r($request->all());
// })->name('province.delete');

Route::delete('/provices/delete', function(Request $request) {

  $validator = Validator::make($request->all(), [
    'province_id' => 'required'
  ]);

  if ($validator->fails()) {
    return response()->json([
      'status' => 'error',
      'errors' => $validator->errors()
    ]);
  } 

  $deleteProvince = DB::table('provinces')
    ->where('id', $request->province_id)
    ->delete();

  return response()->json([
    'status' => 'success',
    'data' => $deleteProvince,
    'errors' => null
  ]);

})->name('province.delete');


// GET Geographies
Route::get('/geographies', function() {
  $geographies = DB::table('geographies')->get();
  return response()->json([
    'status' => 'success',
    'data' => array(
      'geographies' => $geographies
    )
  ]);
})->name('geographies');



// Route::get('/', function (Request $request) {
//     // if (Auth::check()) {
//     //     echo "Skip auth login <br>";
//     // } else {
//     //     echo "Auth login <br>";
//     //     Auth::loginUsingId(1);
//     // }
//     // phpinfo();
//     // dd(Auth::user());
//     // dd(Auth::user());
    
//     return view('welcome');
// });

// Route::get('/logout', function(Request $request) {
//     // log out other devices
//     // Auth::logoutOtherDevices('asanic123');

//     // Auth::logout();

//     // $request->session()->invalidate();

//     // $request->session()->regenerateToken();

//     // return redirect('/');
// });

// Route::get('/confirm-password', function () {
//     return view('auth.confirm-password');
// })->middleware('auth')->name('password.confirm');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// require __DIR__.'/auth.php';
