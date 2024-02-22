<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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
// web routes
Route::get('/', function () {
    global $users;
    return $users;
});
Route::get('/user', function () {
    global $users;
    $u = '';

    foreach ($users as $user) {
        $u .= $user['name'] . ',';
    }
    return "The users are: " . $u;
});


//Route cho API 
Route::prefix('/user')->group(function(){
    // danh sách user name
    // Route::get('/user', [ApiController::class,'index'])->name('api.User');
    // Route::get('/user/{userIndex}', [ApiController::class,'getUserIndex'])->name('api.UserIndex')->where(['userIndex' => '[0-9]+']);
    // Route::get('/user/{userName}', [ApiController::class,'getUserIndex'])->name('api.UserName')->where(['userIndex' => '[0-9]+']);
});
