<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front;
use App\Http\Controllers\Back;
/*
|
| Offline Route
|
*/

Route::get('site-bakimda',function(){
    return view('front.offline');
});
/*
|
| Backend Routes
|
*/
Route::prefix('admin')->name('admin.')->middleware('isLogin')->group(function () {
    Route::get('giris', [Back\AuthController::class, 'login'])->name('login');
    Route::post('giris', [Back\AuthController::class, 'loginPost'])->name('login.post');
});

Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function () {
    Route::get('panel', [Back\Dashboard::class, 'index'])->name('dashboard');
    //Article Routes
    Route::get('makaleler/silinenler', [Back\ArticleController::class, 'trashed'])->name('trashed.article');
    Route::resource('makaleler', Back\ArticleController::class)->shallow();
    Route::get('/switch', [Back\ArticleController::class, 'switch'])->name('switch');
    Route::get('/deletearticle/{id}', [Back\ArticleController::class, 'delete'])->name('delete.article');
    Route::get('/harddeletearticle/{id}', [Back\ArticleController::class, 'hardDelete'])->name('hard.delete.article');
    Route::get('/recoverarticle/{id}', [Back\ArticleController::class, 'recover'])->name('recover.article');
    //Category Route
    Route::get('/kategoriler', [Back\CategoryController::class, 'index'])->name('category.index');
    Route::post('/kategori/create', [Back\CategoryController::class, 'create'])->name('category.create');
    Route::post('/kategori/update', [Back\CategoryController::class, 'update'])->name('category.update');
    Route::post('/kategori/delete', [Back\CategoryController::class, 'delete'])->name('category.delete');
    Route::get('/kategori/status', [Back\CategoryController::class, 'switch'])->name('category.switch');
    Route::get('/kategori/getData', [Back\CategoryController::class, 'getData'])->name('category.getdata');
    //Pages Route
    Route::get('/sayfalar', [Back\PageController::class, 'index'])->name('page.index');
    Route::get('/sayfalar/status', [Back\PageController::class, 'switch'])->name('page.switch');
    Route::get('/sayfalar/olustur', [Back\PageController::class, 'create'])->name('page.create');
    Route::get('/sayfalar/guncelle/{id}', [Back\PageController::class, 'update'])->name('page.edit');
    Route::post('/sayfalar/guncelle/{id}', [Back\PageController::class, 'updatePost'])->name('page.edit.post');
    Route::post('/sayfalar/olustur', [Back\PageController::class, 'post'])->name('page.post');
    Route::get('sayfalar/sil/{id}', [Back\PageController::class,'delete'])->name('page.delete');
    Route::get('sayfalar/siralama', [Back\PageController::class,'orders'])->name('page.orders');
    //Config Route
    Route::get('ayarlar', [Back\ConfigController::class ,'index'])->name('config.index');
    Route::post('ayarlar/update', [Back\ConfigController::class ,'update'])->name('config.update');

    //Logout Route
    Route::get('cikis', [Back\AuthController::class, 'logout'])->name('logout');

});
/*
|
| Front Routes
|
*/

Route::get('/', [Front\Homepage::class, 'index'])->name('homepage');
Route::get('sayfa', [Front\Homepage::class, 'index']);
Route::get('/iletisim', [Front\Homepage::class, 'contact'])->name('contact');
Route::post('/iletisim', [Front\Homepage::class, 'contactpost'])->name('contact.post');
Route::get('/kategori/{category}', [Front\Homepage::class, 'category'])->name('category');
Route::get('/{category}/{slug}', [Front\Homepage::class, 'single'])->name('single');
Route::get('{sayfa}', [Front\Homepage::class, 'page'])->name('page');


