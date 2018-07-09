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
Route::get( '/logout', 'Auth\LoginController@logout' )->name( 'logout' );

Route::get( '/', 'HomeController@index' )->name( 'home' );
Route::get( '/cars', 'CarsController@index' )->name( 'cars' );
Route::post( '/cars/results', 'CarsController@getCars' )->name( 'car_results' );
Route::get( '/car/{id}', 'CarsController@carDetails' )->name( 'car_details' );
Route::get( '/user/ads', 'CarsController@userAds' )->name( 'my_ads' )->middleware( 'auth' );
Route::get( '/categories', 'CategoriesController@index' )->name( 'categories' )->middleware( 'auth', 'admin' );
Route::get( '/edit/category/{id}', 'CategoriesController@edit' )->name( 'edit_category' );
Route::get( '/edit/ad/{id}', 'CarsController@editMyAd' )->name( 'edit_car' );
Route::post( '/addCategory', 'CategoriesController@addCategory' )->name( 'add_category' );
Route::post( '/deleteCategory', 'CategoriesController@deleteCategory' );
Route::post( '/editCategory', 'CategoriesController@editCategory' );
Route::post( '/updateAd', 'CarsController@updateAd' );
Route::get( '/add/car', 'CarsController@addCar' )->name( 'add_car' )->middleware( 'auth' );
Route::post( '/saveCar', 'CarsController@saveCar' );
Route::get( '/admin/cars', 'CarsController@adminListCars' )->name( 'admin_cars' )->middleware( 'auth', 'admin' );
Route::get( '/admin/users', 'HomeController@users' )->name( 'admin_users' )->middleware( 'auth', 'admin' );
Route::get( '/admin/edit/user/{id}', 'HomeController@adminEditUser' )->name( 'admin_edit_user' )->middleware( 'auth', 'admin' );
Route::get( '/admin/new/user', 'HomeController@adminNewUser' )->name( 'admin_new_user' )->middleware( 'auth', 'admin' );
Route::post( '/newUser', 'HomeController@newUser' )->name( 'new_user' );
Route::post( '/editUser', 'HomeController@editUser' )->name( 'edit_user' );
Route::get( '/delete/user/{id}', 'HomeController@deleteUser' )->name( 'delete_user' );
Route::post( '/approveCar', 'CarsController@approveCar' )->name( 'approve_car' );
Route::post( '/deleteCar', 'CarsController@deleteCar' )->name( 'disapprove_car' );
Route::post( '/admin/delete/car', 'CarsController@hardDeleteCar' )->name( 'delete_car' );
Route::get( '/searchCar', 'CarsController@searchCar' );
Route::post( '/search', 'CarsController@search' );
Route::get( '/external', 'CarsController@dataAction' );
Route::get( '/profile', 'HomeController@userProfile' )->name( 'profile' )->middleware( 'auth' );
Route::post( '/userSaveData', 'HomeController@userSaveData' )->name( 'save_user_info' );
Route::post( '/sendEmail', 'HomeController@sendEmail' )->name( 'send_email' );
