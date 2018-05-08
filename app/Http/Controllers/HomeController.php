<?php namespace App\Http\Controllers;

use App\Car;
use App\Mail\SendEmailToOwner;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
	
	public function userProfile()
	{
		$user = auth()->user();
		
		return view( 'layouts.pages.user_profile', compact( 'user' ) );
	}
	
	public function userSaveData( \Illuminate\Http\Request $request )
	{
		
		$messages = [
			'user_name.required'        => 'Morate uneti Vase ime!',
			'user_email.required'       => 'Morate uneti Vas email!',
			'user_email.email'          => 'Email nije u dobrom formatu!',
			'user_phone.required'       => 'Morate uneti Vas broj telefona!',
			'user_phone.digits_between' => 'Broj telefona nije u dobrom formatu!'
		];
		
		// Validation
		
		$this->validate( $request, [
			'user_name'  => 'required',
			'user_email' => 'required|email',
			'user_phone' => 'required|digits_between:7,20',
		], $messages );
		
		
		$name    = $request->get( 'user_name' );
		$email   = $request->get( 'user_email' );
		$phone   = $request->get( 'user_phone' );
		$user_id = $request->input( 'user_id' );
		
		User::whereId( $user_id )->update( [
			
			'name'  => $name,
			'email' => $email,
			'phone' => $phone
		
		] );
		
		$request->session()->flash( 'alert-success', 'Uspesno ste izmenili Vas profil!' );
		
		return redirect()->back();
	}
	
	public function sendEmail( Request $request )
	{
		$car    = json_decode( $request->get( 'car_details' ) );
		$sender = json_decode( $request->get( 'user_sender' ) );
		
		Mail::to( 'nenad.dimic34@gmail.com' )->send( new SendEmailToOwner( $car, $sender, $request ) );
		
		$request->session()->flash( 'alert-success', 'Uspesno ste poslali poruku!' );
		
		return redirect()->back();
	}
}
