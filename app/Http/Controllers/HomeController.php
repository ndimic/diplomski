<?php namespace App\Http\Controllers;

use App\Car;
use App\Mail\NewUserInfo;
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
		$randomCars = Car::whereStatus( 1 )->orderBy( 'counter', 'desc' )->get();
		
		return view( 'layouts.pages.home', compact( 'randomCars' ) );
	}
	
	public function users()
	{
		$users = User::where( 'id', '!=', auth()->user()->id )->get();
		
		return view( 'layouts.pages.admin_users', compact( 'users' ) );
	}
	
	public function adminEditUser( $id )
	{
		$user = User::find( $id );
		
		return view( 'layouts.pages.admin_edit_user', compact( 'user' ) );
	}
	
	public function editUser( Request $request )
	{
		$id = $request->input( 'user_id' );
		
		$user = User::find( $id );
		
		$user->update( $request->all() );
		
		$request->session()->flash( 'alert-success', 'Uspesno ste izmenili korisnika!' );
		
		return redirect()->route( 'admin_users' );
	}
	
	public function deleteUser( $id, Request $request )
	{
		$user = User::find( $id );
		
		$name = $user->name;
		
		// Removing all user's ads
		$user->cars()->delete();
		
		$request->session()->flash( 'alert-success', "Uspesno ste izbrisali korisnika {$name}!" );
		
		return redirect()->back();
	}
	
	public function adminNewUser()
	{
		return view( 'layouts.pages.admin_new_user', compact( 'user' ) );
	}
	
	public function newUser( Request $request )
	{
		$email    = $request->input( 'email' );
		$password = $request->input( 'password' );
		
		$request->merge( [ 'password' => bcrypt( $request->input( 'password' ) ) ] );
		
		User::create( $request->all() );
		
		$request->session()->flash( 'alert-success', 'Uspesno ste kreirali novog korisnika!' );
		
		Mail::to( 'nenad.dimic34@gmail.com' )->send( new NewUserInfo( $email, $password ) );
		
		return redirect()->route( 'admin_users' );
	}
	
	public function userProfile()
	{
		$user = auth()->user();
		
		return view( 'layouts.pages.user_profile', compact( 'user' ) );
	}
	
	public function userSaveData( Request $request )
	{
		
		$messages = [
			'user_name.required'        => 'Morate uneti Vase ime!',
			'user_email.required'       => 'Morate uneti Vas email!',
			'user_email.email'          => 'Email nije u dobrom formatu!',
			'user_phone.digits_between' => 'Broj telefona nije u dobrom formatu!'
		];
		
		// Validation
		
		$this->validate( $request, [
			'user_name'  => 'required',
			'user_email' => 'required|email',
			'user_phone' => 'nullable|sometimes|digits_between:7,20',
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
