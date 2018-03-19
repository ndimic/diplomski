<?php namespace App\Http\Controllers;

use App\Car;

class HomeController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('auth');
	}
	
	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$car = Car::whereDefault( 1 )->first();
		
		return view( 'layouts.pages.home', compact( 'car' ) );
	}
}
