<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChatController;
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
    return view('landing');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/ban', function () {
    return view('ban');
})->name('ban');
Route::get('/update', function () {
    return view('landlord.updateAnnonce');
});
Route::get('/landing', function () {
    return view('landing');
})->name('landing');
Route::get('/test', function () {
    return view('test');
})->name('home');
Route::get('/chat', function () {
    return view('chat');
})->name('chat');
Route::get('/profile', function () {
    return view('profile');
});

route::get('/Annonces');


//////////////////////////////////////backend////////////////////////////////

// Route::get('/chat', [ChatController::class, 'index']);
// Route::get('/chat/conversation/{conversationId}', [ChatController::class, 'getConversation']);
// Route::post('/chat/send', [ChatController::class, 'sendMessage']);



Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('/register',  [AuthController::class, 'register'])->name('register');
Route::post('/register',  [AuthController::class, 'registerPost'])->name('register.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forget-password', [AuthController::class, 'forgot'])->name('forgot');


// Route::post('/dashboard/search', [AnnonceController::class, 'search'])->name('search');
// Route::get('/annonces', [AnnonceController::class, 'show'])->name('show.annonce');
    Route::get('/home', [AnnonceController::class, 'viewClient'])->name('home');
    Route::post('/annonce/search', [AnnonceController::class, 'viewClient'])->name('annonce.search');
    Route::get('/details/{id}', [AnnonceController::class, 'showDetails'])->name('details');



    Route::post('/Forget-password', [AuthController::class, 'ForgetPassword'])->name('forget');

    Route::get('/reset-password/{token}' , [AuthController::class, 'resetPassword'])->name('reset.password');
    Route::post('/reset-password' , [AuthController::class, 'ResetPasswordPost'])->name('reset.password.post');

Route::middleware('auth', 'banned')->group(function () {

  

    Route::middleware('advertiser')->group(function () {
        Route::get('/dashboard', [AnnonceController::class, 'viewlandlord'])->name('landlord.dashboard');
        Route::get('/create', [AnnonceController::class, 'createAnnonce'])->name('addAnnonce');
        Route::post('/create', [AnnonceController::class, 'create'])->name('addAnnonce');
        Route::get('/annonce/{id}/edit', [AnnonceController::class, 'EditAnnoce'])->name('annonces.edit');
        Route::put('/annonce/{id}/update', [AnnonceController::class, 'update'])->name('annonces.update');
    });


    Route::middleware('admin')->group(function () {
        Route::get('/Categories', [CategoryController::class, 'view'])->name('categories');
        Route::post('/Categories', [CategoryController::class, 'create'])->name('addCategorie');
        Route::delete('/Categories/{category}', [CategoryController::class, 'delete'])->name('deleteCategorie');
        //still not working
        Route::put('/Categorie', [CategoryController::class, 'update'])->name('updateCategorie');
        Route::get('/annonces', [AnnonceController::class, 'viewAll'])->name('admin.annonces');
        Route::get('/Users', [UserController::class, 'viewUsers'])->name('users');
        Route::get('/users/search', [UserController::class, 'searchUsers'])->name('users.search');
        Route::put('/ban/user/{userId}',  [UserController::class, 'banUser'])->name('ban.user');
        Route::put('/Unban/user/{userId}',  [UserController::class, 'unbanUser'])->name('unban.user');
        Route::get('/statistique', [UserController::class, 'statistics'])->name('statistique');
        // Route::get('/Allannonces', [AnnonceController::class, 'adStats'])->name('adstats');
        Route::get('/Allannonces', [AnnonceController::class, 'viewAll'])->name('viewAll');
        Route::delete('/Allannonces/{annonce}', [AnnonceController::class, 'delete'])->name('deleteAd');
        Route::get('/annonces', [UserController::class, 'stats'])->name('stats');

    });
});
