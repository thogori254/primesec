<?php

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

Route::domain('{domain}.primesecke.com')->group(function () {

    Route::get('/', 'AdminController@admin')->name('admin');
    Route::post('/author/save-article', 'AdminController@saveArticle');
    Route::post('/author/save-analysis', 'AdminController@saveAnalysis');
    Route::post('/author/save-recommendation', 'AdminController@saveRecommendation');
    Route::post('/author/save-post', 'AdminController@savePost');
    Route::post('/author/edit-article/{id}', 'AdminController@editArticle');
    Route::post('/author/edit-analysis/{id}', 'AdminController@editAnalysis');
    Route::post('/author/edit-recommendation/{id}', 'AdminController@editRecommendation');
    Route::post('/author/edit-post/{id}', 'AdminController@editPost');
    Route::post('/edit/homepage', 'AdminController@saveHomepage');
    Route::post('/new/category', 'AdminController@saveCategory');
    Route::get('/getposts', 'AdminController@getBlogPosts');
    Route::get('/getarticles', 'AdminController@getArticles');
    Route::get('/getanalysis', 'AdminController@getAnalysis');
    Route::get('/getrecommendations', 'AdminController@getRecommendations');
    Route::post('/publish-post/{id}', 'AdminController@publishPost');
    Route::post('/publish-article/{id}', 'AdminController@publishArticle');
    Route::post('/publish-analysis/{id}', 'AdminController@publishAnalysis');
    Route::post('/publish-recommendation/{id}', 'AdminController@publishRecommendation');
    Route::post('/saveproduct', 'ApiController@saveProduct');
    Route::get('/admin/post/{id}', 'AdminController@getBlogPost');
    Route::get('/admin/article/{id}', 'AdminController@getArticle');
    Route::get('/admin/analysis/{id}', 'AdminController@getOneAnalysis');
    Route::get('/admin/recommendation/{id}', 'AdminController@getOneRecommendation');
});

Auth::routes();

Route::post('/delete-post/{id}', 'AdminController@deletePost');
Route::post('/delete-article/{id}', 'AdminController@deleteArticle');
Route::post('/delete-analysis/{id}', 'AdminController@deleteAnalysis');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/article/{id}', 'HomeController@getArticle')->middleware('auth', 'checkSubscription');
Route::get('/analysis/{id}', 'HomeController@getAnalysis')->middleware('auth', 'checkSubscription');
//Route::get('/recommendation/{id}', 'HomeController@getRecommendation')->middleware('auth', 'checkSubscription');


Route::get('/test', function () {
    $article = \App\Article::find(1);
    return $article->categories();
});

Route::domain('{domain}.primesecke.com')->group(function () {
    Route::fallback(function () {
        return view('admin');
    });
});

Route::fallback(function () {
    return view('home');
});

Route::get('/subscribe', 'SubscribeController@createform')->middleware('auth');

Route::post('/subscribe', 'SubscribeController@storeform');

Route::post('register-user','Auth\CustomAuthController@registerUser')->name('register-user');

Route::post('user/login','Auth\CustomAuthController@login');




Route::domain('{domain}.primesecke.com')->group(function () {
//Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function (){
//    Route::resource('/users','UsersController',['except'=>['show','create','store']]);
//
//});
});


//Route::domain('{domain}.primesecke.com')->group(function () {
//Admin Routes
//Route::group(['namespace' => 'Admin'],function(){
//
//    // Tag Routes
//    Route::resource('admin/tag','TagController');
//    // Category Routes
//    Route::resource('admin/category','CategoryController');
//
//});
// Post Routes
//Route::resource('admin/recommendation','Admin\RecommendationController');


//Route::domain('{domain}.primesecke.com')->group(function () {

Route::get('admin_create_tag','Admin\TagController@create');
Route::get('admin_view_tags','Admin\TagController@index');
Route::post('admin_store_tag','Admin\TagController@store');
Route::get('admin_store_tag','Admin\TagController@store');
Route::post('admin_edit_tag/{id}','Admin\TagController@edit');
Route::get('admin_edit_tag/{id}','Admin\TagController@edit');
Route::post('admin_update_tag/{id}','Admin\TagController@update');
Route::get('admin_update_tag/{id}','Admin\TagController@update');
Route::get('admin_delete_tag/{id}','Admin\TagController@destroy');



Route::get('admin_create_category','Admin\CategoryController@create');
Route::get('admin_view_categories','Admin\CategoryController@index');
Route::post('admin_store_category','Admin\CategoryController@store');
Route::get('admin_store_category','Admin\CategoryController@store');
Route::post('admin_edit_category/{id}','Admin\CategoryController@edit');
Route::get('admin_edit_category/{id}','Admin\CategoryController@edit');
Route::post('admin_update_category/{id}','Admin\CategoryController@update');
Route::get('admin_update_category/{id}','Admin\CategoryController@update');
Route::get('admin_delete_category/{id}','Admin\CategoryController@destroy');



Route::get('admin_create_topic','Admin\TopicController@create');
Route::get('admin_view_topics','Admin\TopicController@index');
Route::post('admin_store_topic','Admin\TopicController@store');
Route::get('admin_store_topic','Admin\TopicController@store');
Route::post('admin_edit_topic/{id}','Admin\TopicController@edit');
Route::get('admin_edit_topic/{id}','Admin\TopicController@edit');
Route::post('admin_update_topic/{id}','Admin\TopicController@update');
Route::get('admin_update_topic/{id}','Admin\TopicController@update');
Route::get('admin_delete_topic/{id}','Admin\TopicController@destroy');



Route::get('admin_recommendation_create','Admin\RecommendationController@create');
Route::get('admin_view_recommendations','Admin\RecommendationController@index');
Route::post('admin_store_recommendations','Admin\RecommendationController@store');
Route::get('admin_store_recommendations','Admin\RecommendationController@store');
Route::post('admin_edit_recommendations/{id}','Admin\RecommendationController@edit');
Route::get('admin_edit_recommendations/{id}','Admin\RecommendationController@edit');
Route::post('admin_update_recommendations/{id}','Admin\RecommendationController@update');
Route::get('admin_update_recommendations/{id}','Admin\RecommendationController@update');
Route::get('admin_delete_recommendations/{id}','Admin\RecommendationController@destroy');


Route::get('admin_discussion_create','Admin\DiscussionController@create');
Route::get('admin_view_discussions','Admin\DiscussionController@index');
Route::post('admin_store_discussions','Admin\DiscussionController@store');
Route::get('admin_store_discussions','Admin\DiscussionController@store');
Route::post('admin_edit_discussions/{id}','Admin\DiscussionController@edit');
Route::get('admin_edit_discussions/{id}','Admin\DiscussionController@edit');
Route::post('admin_update_discussions/{id}','Admin\DiscussionController@update');
Route::get('admin_update_discussions/{id}','Admin\DiscussionController@update');
Route::get('admin_delete_discussions/{id}','Admin\DiscussionController@destroy');



    Route::get('admin_view_subscribers','Admin\UsersController@index');
    Route::get('admin_edit_subscribers/{id}','Admin\UsersController@edit');
    Route::post('admin_edit_subscribers/{id}','Admin\UsersController@edit');
    Route::get('admin_update_subscribers/{id}','Admin\UsersController@update');
    Route::post('admin_update_subscribers/{id}','Admin\UsersController@update');
    Route::get('admin_delete_subscribers/{id}','Admin\UsersController@destroy');


//});

//Route::get('admin_recommendation_edit/{id}','Admin\RecommendationController@edit');

//Route::get('recommendation','User\RecommendationController@recommendation')->name('recommendation');

// User Routes
Route::group(['namespace' => 'User'],function(){
    Route::get('recommendations','HomeController@recommendations_home')
        ->middleware('auth', 'checkSubscription');
    Route::get('recommendation/{id}','RecommendationController@recommendation')
        ->name('recommendation')->middleware('auth', 'checkSubscription');

    Route::get('discussions','HomeController@discussions_home')
        ->middleware('auth', 'checkSubscription');
    Route::get('discussion/{id}','DiscussionController@discussion')
        ->name('discussion')->middleware('auth', 'checkSubscription');

    Route::get('recommendation/tag/{tag}','HomeController@tag')
        ->name('tag')->middleware('auth', 'checkSubscription');
    Route::get('recommendation/category/{category}','HomeController@category')
        ->name('category')->middleware('auth', 'checkSubscription');
    Route::get('discussion/topic/{topic}','HomeController@topic')
        ->name('topic')->middleware('auth', 'checkSubscription');

});
