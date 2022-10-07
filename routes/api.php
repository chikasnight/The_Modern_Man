<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\UserController;



Route::group(['middleware' =>'auth:sanctum'],function(){
    Route::post('threads',[ThreadController::class,'thread']);
    Route::put('threads/{threadId}',[ThreadController::class,'updateThread']);
    Route::delete('threads/{threadId}',[ThreadController::class,'deleteThread']);

    Route::post('comments',[CommentController::class,'comment']);
    Route::put('comments/{commentId}',[CommentController::class,'updateComment']);
    Route::delete('comments/{commentId}',[CommentController::class,'deleteComment']);

    Route::post('pictures',[PictureController::class,'picture']);
    Route::put('pictures/{pictureId}',[PictureController::class,'updatePicture']);
    
    
    Route::post('logout',[UserController::class,'logout']);
    Route::put('profiles/{profileId}',[UserController::class,'updateProfile']);

});
Route::post('register',[UserController::class,'register']);
Route::post('login',[UserController::class,'login']);
Route::get('threads/{threadId}',[GroceryController::class,'getThread']);

