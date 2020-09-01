<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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


Route::get('/', function () {
    return redirect('home');
});

Route::get('/blast', function() {
    return view('mailblast');
});


Auth::routes();

//Fitur Forum diskusi
Route::post('/comment/addDiscuss/{video}', 'CommentController@addDiscuss')->name('addDiscuss');
Route::post('/comment/replyDiscuss/{comment}', 'CommentController@replyDiscuss')->name('replyDiscuss');
Route::post('/comment/updateDiscuss/{id}', 'CommentController@update')->name('updateDiscussVideo');
//Fungsi Like dan dislike
Route::post('/comment/like', 'LikeController@likeComment')->name('likeComment');

Route::get('/comment/editDiscuss/{id}', 'CommentController@edit')->name('editDiscussVideo');
Route::get('/comment/deleteDiscuss/{id}', 'CommentController@destroy')->name('deleteDiscussVideo');
//Route::get('/comment/like', 'CommentController@like')->name('like');

//Fitur Review
Route::post('/review/addReview/{video}', 'RatingController@addReview')->name('addReview');

//Fitur Bantuan dan Dukungan
Route::post('/bantuan/storeTiketBantuan/', 'BantuanController@storeTiketBantuan')->name('storeTiketBantuan');
Route::post('/bantuan/storeBalasanPesan/{bantuan}', 'BantuanController@storeBalasanPesan')->name('storeBalasanPesan');
Route::post('/bantuan/storeBalasanAdmin/{bantuan}', 'BantuanController@storeBalasanAdmin')->name('storeBalasanAdmin');

//Fitur Karya Kelas
Route::post('/karya_kelas/storeKaryaKelas/{video}', 'KaryaKelasController@storeKaryaKelas')->name('storeKaryaKelas');
Route::post('/karya_kelas/addDiscussKaryaKelas/{karya_kelas}', 'KaryaCommentController@addDiscussKaryaKelas')->name('addDiscussKaryaKelas');
Route::post('/karya_kelas/replyDiscussKaryaKelas/{karya_comment}', 'KaryaCommentController@replyDiscussKaryaKelas')->name('replyDiscussKaryaKelas');
Route::post('/karya_kelas/updateDiscussKaryaKelas/{id}', 'KaryaCommentController@update')->name('updateDiscuss');
Route::get('/karya_kelas/editDiscussKaryaKelas/{id}', 'KaryaCommentController@edit')->name('editDiscuss');
Route::get('/karya_kelas/deleteDiscussKaryaKelas/{id}', 'KaryaCommentController@destroy')->name('deleteDiscuss');


// Registrasi
Route::get('/daftar', ['as' => 'web.daftar', 'uses' => 'blogcontroller@regis']);
Route::POST('/daftarstore', ['as' => 'web.daftarstore', 'uses' => 'blogcontroller@daftarstore']);
Route::POST('/daftarstore', ['as' => 'web.daftarstore', 'uses' => 'blogcontroller@daftarstore']);
Route::post('/cek_email', 'blogcontroller@cek_email');

// Provider Login
Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

Route::get('/home', ['as' => 'web.home', 'uses' => 'blogcontroller@home']);
Route::get('/about', 'blogcontroller@company');
Route::get('/course', 'blogcontroller@try');
Route::get('/sharing', 'blogcontroller@sharing')->name('sharing');
Route::get('/sharing/video/{id?}', 'blogcontroller@detailsharing')->name('detailsharing');
Route::get('/talktocoach', 'blogcontroller@ttc');
Route::get('/help', ['as' => 'web.help', 'uses' => 'blogcontroller@help']);
Route::get('/upgrade', 'blogcontroller@upgrade');
Route::get('/modul/{modul}/show', ['as' => 'web.moduldetail', 'uses' => 'blogcontroller@detail']);
Route::get('/modul/{modul}/show/trainer', ['as' => 'web.trainerdetail', 'uses' => 'blogcontroller@profiletrainer']);
Route::get('/video/show/{video}/{modul}', ['as' => 'web.videodetail', 'uses' => 'blogcontroller@videodetail']);
Route::get('/{id?}/query', 'blogcontroller@cari_data');
// Route::get('/course/kategori', 'subcontroller@index');
Route::get('/course/filter', 'subcontroller@filter')->name('filter');
Route::get('/course/kategori', 'subcontroller@index')->name('sub');

// User
Route::group(['middleware' => ['web', 'auth', 'roles']],function(){
 Route::group(['roles'=>'user'],function(){

    // Profil
    Route::get('/profile', ['as' => 'web.profile', 'uses' => 'blogcontroller@profile']);
    Route::POST('/updateuser', ['as' => 'web.updateuser', 'uses' => 'blogcontroller@userupdate']);

    // Cart
    // Route::resource('cart/', 'cartcontroller', ['as' => 'cart']);
    Route::resource('/cart', 'cartcontroller', ['as' => 'cart']);
    Route::post('/addbuy', 'cartcontroller@addbuy');

    // Payment Flow
    Route::get('/checkout', 'cartcontroller@checkout');
    Route::get('/pembayaran/{id}', 'cartcontroller@pembayaran');
    Route::get('/checkout/success/{id}', 'cartcontroller@result')->name('result');

    Route::POST('addcart', ['uses' => 'cartcontroller@addcart']);

    Route::get('/mycourse', 'blogcontroller@mycourse');
    Route::post('/edit_notif', 'cartcontroller@edit_notif');
    Route::post('/delete_cart', 'cartcontroller@delete_cart');

});

// Admin
 Route::group(['roles'=>'admin'],function(){
    Route::get('/admin', ['as' => 'web.admin', 'uses' => 'AdmController@index']);

    // Order
    Route::get('/admin/order', ['as' => 'web.order', 'uses' => 'ordercontroller@index']);
    Route::post('/update-stt', ['uses' => 'ordercontroller@update']);

    // Appearence
    Route::get('admin/appearance', ['as' => 'web.admin', 'uses' => 'blogcontroller@appearance']);
    Route::post('admin/appearance/{slide}', 'blogcontroller@appearance_post')->name('admin.appearance.upload');

    // User
    Route::resource('admin/admin', 'usercontroller', ['as' => 'admin']);
    Route::get('admin/cari_admin', 'usercontroller@search');

    // Dahshboard
    Route::get('/admin', ['as' => 'web.admin', 'uses' => 'blogcontroller@admin']);
    Route::get('/filtergrafik/{id}', ['as' => 'web.admin', 'uses' => 'blogcontroller@filtergrafik']);

    // Webinar
    Route::resource('admin/webinar', 'webinarcontroller', ['as' => 'admin']);
    Route::get('admin/cari_webinar', 'webinarcontroller@search');

    // Modul
    Route::resource('admin/modul', 'modulcontroller', ['as' => 'admin']);
    Route::get('admin/cari_modul', 'modulcontroller@search');
    Route::post('/cekJenjang', 'modulcontroller@cekJenjang');
    Route::post('/update-post', ['uses' => 'modulcontroller@update_post']);

    Route::get('admin/kategori_modul/{id?}', 'modulcontroller@kategori_modul');
    Route::post('admin/insert_km', 'modulcontroller@insert_km');
    Route::post('admin/edit_km/{id}', 'modulcontroller@edit_km');
    Route::get('admin/delete_km/{id}', 'modulcontroller@delete_km');

    // Video
    Route::resource('admin/video', 'videocontroller', ['as' => 'admin']);
    Route::get('admin/cari_video', 'videocontroller@search');

    // Mapel
    Route::resource('admin/mapel', 'mapelcontroller', ['as' => 'admin']);
    Route::get('admin/mapel/destroy/{id}', 'mapelcontroller@destroy');
    Route::post('admin/mapel/update/{id}', 'mapelcontroller@update');

    Route::resource('admin/help', 'helpcontroller', ['as' => 'admin']);

    Route::resource('admin/kategorivideo', 'kategorivideocontroller', ['as' => 'admin']);
    Route::get('admin/cari_kategorivideo', 'kategorivideocontroller@search');

    //Status
    Route::resource('admin/karyakelas', 'KaryaKelasController', ['as' => 'admin']);
    Route::get('admin/karyakelas','KaryaKelasController@index');
    Route::get('admin/karyakelas/{id}','KaryaKelasController@edit');
    Route::post('admin/karyakelas/{id}','KaryaKelasController@update');

    //Bantuan
    Route::resource('admin/bantuan', 'BantuanController', ['as' => 'admin']);
    Route::get('admin/bantuan','BantuanController@index');
    Route::get('admin/bantuan/{id}','BantuanController@edit');
    Route::post('admin/bantuan/{id}','BantuanController@update');
    Route::post('/bantuan/storeBalasanPesan/{bantuan}', 'BantuanController@storeBalasanPesan')->name('storeBalasanPesan');
    });


});

