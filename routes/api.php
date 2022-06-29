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

Route::post('callback/{id}','Api\TransactionsController@salesCallback');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::domain('{domain}.primesecke.com')->group(function () {

    Route::get('/gettickets', 'ApiController@getTickets')->name('gettickets');
    Route::get('/getstats', 'ApiController@getStats')->name('getstats');
    Route::get('/getsubscriptions', 'ApiController@getSubscriptions')->name('getsubscriptions');
    Route::get('/ticketread/{id}', 'ApiController@ticketRead');
    Route::get('/icons', 'ApiController@getIcons');

});


Route::get('/getblogdetails', 'ApiController@getDetails')->name('getblogdetails');

Route::get('/getcategories', 'ApiController@getCategories')->name('getcategories');

Route::get('/getposts', 'ApiController@getBlogPosts')->name('getposts');

Route::get('/getarticles', 'ApiController@getArticles')->name('getarticles');

Route::get('/getanalysis', 'ApiController@getAnalysis')->name('getanalysis');

Route::get('/getrecommendations', 'ApiController@getRecommendations')->name('getrecommendations');

Route::get('/getrecents', 'ApiController@getRecents')->name('getrecents');

Route::get('/article/{id}', 'ApiController@getArticle');

Route::get('/analysis/{id}', 'ApiController@getAnalysis');

Route::get('/recommendation/{id}', 'ApiController@getRecommendation');

Route::get('/post/{slug}', 'ApiController@getBlogPost');

Route::post('/mailing', 'ApiController@newMailing')->name('mailing');

Route::post('/contact-us', 'ApiController@newTicket')->name('ticket');

Route::get('/getproducts', 'ApiController@getProducts');

