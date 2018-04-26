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

Route::get( '/', function() {
	return view( 'layouts.pages.home' );
} );

Auth::routes();
Route::get( '/logout', 'Auth\LoginController@logout' );

Route::get( '/', 'HomeController@index' )->name( 'home' );
Route::get( '/cars', 'CarsController@index' )->name( 'cars' );
Route::post( '/cars-results', 'CarsController@getCars' );
Route::get( '/car/{id}', 'CarsController@carDetails' );
Route::get( '/myAds', 'CarsController@userAds' );
Route::get( '/categories', 'CategoriesController@index' )->name( 'categories' );
Route::get( '/edit/category/{id}', 'CategoriesController@edit' );
Route::get( '/edit/ad/{id}', 'CarsController@editMyAd' );
Route::post( '/addCategory', 'CategoriesController@addCategory' );
Route::post( '/deleteCategory', 'CategoriesController@deleteCategory' );
Route::post( '/editCategory', 'CategoriesController@editCategory' );
Route::post( '/updateAd', 'CarsController@updateAd' );
Route::get( '/addCar', 'CarsController@addCar' )->name( 'add_car' );
Route::post( '/saveCar', 'CarsController@saveCar' );
Route::get( '/adminListCars', 'CarsController@adminListCars' )->name( 'admin_list' );
Route::post( '/approveCar', 'CarsController@approveCar' );
Route::post( '/deleteCar', 'CarsController@deleteCar' )->name( 'delete' );
Route::get( '/searchCar', 'CarsController@searchCar' );
Route::post( '/search', 'CarsController@search' );
Route::get( '/external', 'CarsController@dataAction' );
Route::get( '/profile', 'HomeController@userProfile' );
Route::post( '/userSaveData', 'HomeController@userSaveData' );
Route::post( '/sendEmail', 'HomeController@sendEmail' )->name( 'send-email' );
