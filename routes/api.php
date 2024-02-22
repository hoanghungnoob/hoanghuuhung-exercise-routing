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


//Route cho API 
Route::prefix('/user')->group(function(){
    Route::get('/',function(){
        global $users ; 
        return response()->json($users);
    });
    Route::get('/{userIndex}', function($index){
        global $users ;
        
        if ($index < count($users)) {
            return response()->json($users[$index]);
        } else {
            return "Cannot find user with index " . $index;
        }
    })->name('api.UserIndex')->where(['userIndex' => '[0-9]+']);
    Route::get('/{userName}', function($name){
        global $users;
        $foundUser = null;
        foreach ($users as $user) {
            if ($user['name'] == $name) {
                $foundUser = $user;
                break; // Once found, exit the loop
            }
        }
        if ($foundUser !== null) {
            return response()->json($foundUser);
        }
        return "Cannot find user with name " . $name;
    })->name('api.UserName')->where(['userName' => '[a-zA-Z]+']);
    Route::get('/{userIndex}/post/{postIndex}', function($userIndex, $postIndex) {
        global $users;
        if (!isset($users[$userIndex])) {
            return "Cannot find user with index " . $userIndex;
        }
        $user = $users[$userIndex];
        if (!isset($user['posts'][$postIndex])) {
            return "Cannot find post with id $postIndex for user $userIndex";
        }
        $post = $user['posts'][$postIndex];
        return "$post";
    })->where(['userIndex' => '[0-9]+', 'postIndex' => '[0-9]+']);
    
});
// Fallback route khi nhận request sai
Route::fallback(function () {
    return "You cannot get a user like this";
});