<?php namespace App\Http\Controllers;

use App\Car;
use App\Mail\NewUserInfo;
use App\Mail\SendEmailToOwner;
use App\User;
use DB;
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
		$messages = [
			'name.required'        => 'Morate uneti Vase ime!',
			'email.required'       => 'Morate uneti Vasu email adresu!',
			'email.email'          => 'Email adresa nije u dobrom formatu!',
			'email.unique'         => 'Uneta email adresa vec postoji!',
			'phone.digits_between' => 'Unet broj telefona nije u dobrom formatu!',
			'role.required'        => 'Morate uneti ulogu novog korisnika!',
		];
		
		// Validation
		
		$this->validate( $request, [
			'name'  => 'required',
			'email' => 'required|email',
			'phone' => 'nullable|sometimes|digits_between:5,15',
			'role'  => 'required',
		], $messages );
		
		$id      = $request->input( 'user_id' );
		$role_id = $request->input( 'role' );
		
		$user = User::find( $id );
		
		$user->update( $request->all() );
		
		DB::table( 'users_roles' )->where( 'user_id', $user->id )->update( [
			'user_id' => $user->id,
			'role_id' => $role_id,
		] );
		
		$request->session()->flash( 'alert-success', 'Uspesno ste izmenili korisnika!' );
		
		return redirect()->route( 'admin_users' );
	}
	
	public function deleteUser( $id, Request $request )
	{
		$user = User::find( $id );
		
		$name = $user->name;
		
		if ( $user->cars_count ) {
			
			// Removing all user's ads
			$user->cars()->delete();
		}
		
		$user->delete();
		
		$request->session()->flash( 'alert-success', "Uspesno ste izbrisali korisnika {$name}!" );
		
		return redirect()->back();
	}
	
	public function adminNewUser()
	{
		return view( 'layouts.pages.admin_new_user', compact( 'user' ) );
	}
	
	public function newUser( Request $request )
	{
		$messages = [
			'name.required'        => 'Morate uneti Vase ime!',
			'email.required'       => 'Morate uneti Vasu email adresu!',
			'email.email'          => 'Email adresa nije u dobrom formatu!',
			'email.unique'         => 'Uneta email adresa vec postoji!',
			'password.required'    => 'Morate uneti Vasu lozinku!',
			'password.min'         => 'Lozinka mora imati najmanje 6 karaktera!',
			'phone.digits_between' => 'Unet broj telefona nije u dobrom formatu!',
			'role.required'        => 'Morate uneti ulogu novog korisnika!',
		];
		
		// Validation
		
		$this->validate( $request, [
			'name'     => 'required',
			'email'    => 'required|email|unique:users,email',
			'password' => 'required|min:6',
			'phone'    => 'nullable|sometimes|digits_between:5,15',
			'role'     => 'required',
		], $messages );
		
		
		$email    = $request->input( 'email' );
		$password = $request->input( 'password' );
		$role_id  = $request->input( 'role' );
		$role     = $role_id == 1 ? 'Administrator' : 'Korisnik';
		
		$request->merge( [ 'password' => bcrypt( $request->input( 'password' ) ) ] );
		
		$user = User::create( $request->all() );
		
		DB::table( 'users_roles' )->insert( [
			'user_id' => $user->id,
			'role_id' => $role_id,
		] );
		
		$request->session()->flash( 'alert-success', 'Uspesno ste kreirali novog korisnika!' );
		
		Mail::to( 'nenad.dimic34@gmail.com' )->send( new NewUserInfo( $email, $password, $role ) );
		
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
