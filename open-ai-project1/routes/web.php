<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\listecontroller;
use App\Http\Controllers\updatecontroller;
use App\Http\Controllers\createcontroller;
use App\Http\Controllers\chatcontroller;
use App\Http\Controllers\speachtotextcontroller;
use App\Http\Controllers\TextToSpeechController;
use App\Http\Controllers\visioncontroller;
use App\Http\Controllers\texttoimagecontroller;
use App\Http\Controllers\settingcontroller;
use App\Http\Controllers\signupcontroller;
use App\Http\Controllers\logincontroller;
use App\Http\Controllers\controllersocialite;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


//login-sign up:




///admin:
//aficher:
route::get('/liste' , [listecontroller::class , 'index'])->name('liste');


//update:
route::get('/update/{utilisateur}' , [updatecontroller::class , 'index'])->name('update');
route::put('/edit/{utilisateur}' , [updatecontroller::class , 'edit'])->name('edit');

//delete:
route::delete('/delete/{utilisateur}' , [listecontroller::class , 'delete'])->name('delete');

//create:
route::get('/create' , [createcontroller::class , 'index'])->name('create');
route::post('/store' , [createcontroller::class , 'store'])->name('store');

///user:
//chat:
route::get('/chat' , [chatcontroller::class , 'index'])->name('chat');
route::post('/chatai' , [chatcontroller::class , 'chat'])->name('chatai');
Route::get('/clear-session', [ChatController::class, 'clearSession'])->name('clear-session');


//speech-to-text:
route::get('/speach-to-text' , [speachtotextcontroller::class , 'index'])->name('speech-to-text');
route::post('/text_audio' , [speachtotextcontroller::class , 'text'])->name('text-audio');




//text-to-speech:
route::get('/text-to-speach' , [TextToSpeechController::class , 'index'])->name('text-to-speech');
route::post('/audio' , [TextToSpeechController::class , 'audio'])->name('audio');



//vision:
route::get('/vision' , [visioncontroller::class , 'index'])->name('vision');
route::post('/vision/script' , [visioncontroller::class , 'script'])->name('script');


//text-to-image:
route::get('/text-to-image' , [texttoimagecontroller::class , 'index'])->name('text-to-image');
route::post('/image' , [texttoimagecontroller::class , 'image'])->name('image');


//setting:
route::get('/setting' , [settingcontroller::class , 'index'])->name('setting');
route::post('/key' , [settingcontroller::class , 'key'])->name('key');



//connexion:
route::get('/create_compte' , [signupcontroller::class , 'index'])->name('create_compte');
route::post('/store_compte' , [signupcontroller::class , 'store'])->name('store_compte');
route::get('/' , [logincontroller::class , 'index'])->name('show');
route::post('/login' , [logincontroller::class , 'login'])->name('login');

Route::get('/auth/{provider}/redirect',[controllersocialite::class , 'redirect']);
Route::get('/auth/{provider}/callback',[controllersocialite::class , 'callback']);