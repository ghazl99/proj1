<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('welcome');
});
Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
// Route::get('test',function(){
//     $users= App\Models\User::where('expire',1)->get();
//         foreach($users as $user)
//         {
//             $user ->update(['expire'=>0]);
//         }
// });
Route::get('/fillable',[App\Http\Controllers\OfferController::class, 'get_offer']);
Route::group(['prefix'=>'offers'],function(){
    Route::get('store',[App\Http\Controllers\OfferController::class, 'store']);
Route::get('create',[App\Http\Controllers\OfferController::class, 'create']);
    Route::post('store',[App\Http\Controllers\OfferController::class, 'store'])->name('offer.store');
Route::get('all',[App\Http\Controllers\OfferController::class, 'getOffer'])->name('offers.all');
Route::get('edit/{id}',[App\Http\Controllers\OfferController::class, 'editOffer']);
Route::put('update/{id}',[App\Http\Controllers\OfferController::class, 'updateOffer'])->name('offer.update');
Route::get('delete/{id}',[App\Http\Controllers\OfferController::class, 'deleteOffer'])->name('offer.delete');
Route::get('youtube',[App\Http\Controllers\OfferController::class, 'getVideo']);
});
##########################begin ajax##########################
Route::group(['prefix'=>'offersajax'],function(){
Route::get('create',[App\Http\Controllers\OfferAjaxController::class, 'create']);
Route::post('save',[App\Http\Controllers\OfferAjaxController::class, 'save']);
Route::get('all',[App\Http\Controllers\OfferAjaxController::class, 'getOffer'])->name('offers.ajax.all');
Route::get('delete',[App\Http\Controllers\OfferAjaxController::class, 'deleteOffer'])->name('offer.ajax.delete');
Route::get('edit/{id}',[App\Http\Controllers\OfferAjaxController::class, 'editOffer']);
Route::put('update',[App\Http\Controllers\OfferAjaxController::class, 'updateOffer'])->name('offer.ajax.update');
});
##########################end ajax##########################
##########################excel############################
Route::get('upload-form',[App\Http\Controllers\ExcelController::class, 'index']);
Route::post('upload-data',[App\Http\Controllers\ExcelController::class, 'importFile']);
############################################################

###############middleware########################
Route::get('/adult', function () {
    return view('welcome');
});