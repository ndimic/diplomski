<?php namespace App\Http\Controllers;

use App\Car;
use App\Category;
use App\Mail\NotifyAdminAboutNewAd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Behaviors\Upload;
use App\Behaviors\Expire;
use Illuminate\Support\Facades\Mail;

class CarsController extends Controller
{
	use Upload, Expire;
	
	public function index()
	{
		$cars = Car::whereStatus( 1 )->with( 'category' )->orderBy( 'id', 'desc' )->paginate( 3 );
		
		$categories = Category::all();
		
		// We are checking if ads are expired
		// $this->expiredAds();
		
		return view( 'layouts.pages.cars', compact( 'cars', 'categories' ) );
	}
	
	public function getCars( Request $request )
	{
		
		$categories = Category::all();
		
		$category_id = $request->get( 'category' );
		$price       = $request->get( 'price' );
		$year_from   = $request->get( 'car_year_from' );
		$year_to     = $request->get( 'car_year_to' );
		
		if ( $category_id || $price || $year_from || $year_to ) {
			
			$query = Car::where( 'status', 1 );
			
			if ( $category_id ) {
				
				$query->where( 'category_id', $category_id );
				
			}
			
			if ( $price ) {
				
				$query->where( 'price', '<=', $price );
				
			}
			
			if ( $year_from ) {
				
				$query->where( 'year', '>=', $year_from );
				
			}
			
			if ( $year_to ) {
				
				$query->where( 'year', '<=', $year_to );
				
			}
			
		} else {
			
			return redirect()->route( 'cars' );
		}
		
		$cars = $query->get();
		
		return view( 'layouts.pages.search_result', compact( 'cars', 'categories' ) );
		
	}
	
	public function carDetails( $id )
	{
		$car = Car::find( $id );
		
		$car->update( [
			
			'counter' => $car->counter + 1
		] );
		
		return view( 'layouts.pages.car', compact( 'car' ) );
	}
	
	public function addCar()
	{
		$categories = Category::all();
		
		return view( 'layouts.pages.add_car', compact( 'categories' ) );
	}
	
	public function saveCar( Request $request )
	{
		// Validation messages
		
		$messages = [
			'car_category_id.required' => 'Morate izabrati kategoriju automobila!',
			'car_name.required'        => 'Morate uneti naziv automobila!',
			'car_price.required'       => 'Morate uneti cenu automobila!',
			'car_price.digits_between' => 'Cena nije uneta u dobrom formatu!',
			'car_year_id.required'     => 'Morate izabrati godinu proizvodnje automobila!',
			'car_km.required'          => 'Morate uneti pređenu kilometražu!',
			'car_km.digits_between'    => 'Kilometraža nije uneta u dobrom formatu!',
			'car_image.required'       => 'Morate postaviti sliku automobila!'
		];
		
		// Validation
		
		$this->validate( $request, [
			'car_category_id' => 'required',
			'car_name'        => 'required',
			'car_price'       => 'required|digits_between:1,20',
			'car_year_id'     => 'required',
			'car_km'          => 'required|digits_between:1,20',
			'car_image'       => 'required|image'
		], $messages );
		
		// Uploading picture
		
		$imageCar  = $request->file( 'car_image' );
		$imageName = time() . '.' . $imageCar->getClientOriginalName();
		
		$this->upload( $imageCar, $imageName );
		
		// Inserting car in database
		
		$car = Car::create( [
			'category_id' => $request->get( 'car_category_id' ),
			'name'        => $request->get( 'car_name' ),
			'price'       => $request->get( 'car_price' ),
			'year'        => $request->get( 'car_year_id' ),
			'km'          => $request->get( 'car_km' ),
			'image'       => $imageName,
			'description' => $request->get( 'car_description' ) ? $request->get( 'car_description' ) : '',
			'user_id'     => Auth::id()
		] );
		
		Mail::to( 'nenad.dimic34@gmail.com' )->send( new NotifyAdminAboutNewAd( auth()->user(), $car ) );
		
		$request->session()->flash( 'alert-success', 'Oglas je uspešno dodat! Naši administatori će razmotriti Vaš oglas.' );
		
		return redirect()->route( 'add_car' );
	}
	
	public function userAds()
	{
		$cars = Car::whereUserId( Auth::id() )->with( 'category' )->paginate( 3 );
		
		return view( 'layouts.pages.my_ads', compact( 'cars' ) );
	}
	
	public function editMyAd( $id )
	{
		
		$car = Car::find( $id );
		
		return view( 'layouts.pages.edit_ad', compact( 'car' ) );
	}
	
	public function updateAd( Request $request )
	{
		$id          = $request->input( 'car_id' );
		$name        = $request->input( 'car_name' );
		$price       = $request->input( 'car_price' );
		$year        = $request->input( 'car_year' );
		$km          = $request->input( 'car_km' );
		$description = $request->input( 'car_description' );
		
		if ( ! $name || is_numeric( $name ) ) {
			
			if ( is_numeric( $name ) ) {
				$request->session()->flash( 'alert-danger', 'Naziv automobila nije unet u dobrom formatu!' );
			} else {
				$request->session()->flash( 'alert-danger', 'Morate uneti naziv automobila!' );
			}
			
			return redirect()->back();
			
		} elseif ( ! $price || ! is_numeric( $price ) ) {
			
			if ( ! is_numeric( $price ) && $price ) {
				$request->session()->flash( 'alert-danger', 'Cena nije uneta u dobrom formatu!' );
			} else {
				$request->session()->flash( 'alert-danger', 'Morate uneti cenu automobila!' );
			}
			
			return redirect()->back();
			
		} elseif ( ! $year ) {
			
			$request->session()->flash( 'alert-danger', 'Morate izabrati godinu proizvodnje automobila!' );
			
			return redirect()->back();
			
		} elseif ( ! $km || ! is_numeric( $km ) ) {
			
			if ( ! is_numeric( $km ) && $km ) {
				$request->session()->flash( 'alert-danger', 'Kilometraža nije uneta u dobrom formatu!' );
			} else {
				$request->session()->flash( 'alert-danger', 'Morate uneti pređenu kilometražu!' );
			}
			
			return redirect()->back();
			
		}
		
		if ( $request->hasFile( 'car_image' ) ) {
			
			$new             = $request->file( 'car_image' );
			$imageName       = time() . '.' . $new->getClientOriginalName();
			$destinationPath = public_path( '/images', $new->getClientOriginalName() );
			$new->move( $destinationPath, $imageName );
			
			Car::whereId( $id )->update( [ 'image' => $imageName ] );
		}
		
		Car::whereId( $id )->update( [
			'name'        => $name,
			'price'       => $price,
			'year'        => $year,
			'km'          => $km,
			'description' => $description
		] );
		
		$request->session()->flash( 'alert-success', 'Uspešno se izmenili Vaš oglas!' );
		
		return redirect()->back();
	}
	
	public function adminListCars()
	{
		$cars = Car::with( 'user' )->orderBy( 'id', 'desc' )->paginate( 3 );
		
		return view( 'layouts.pages.approve_car', compact( 'cars' ) );
	}
	
	public function approveCar( Request $request )
	{
		$id = $request->input( 'approve_car_id' );
		
		if ( $id ) {
			
			Car::whereId( $id )->update( [
				'status'     => 1,
				'is_expired' => 0
			] );
			
			$request->session()->flash( 'alert-success', 'Oglas je odobren!' );
			
			return redirect()->back();
		}
		
		$request->session()->flash( 'alert-danger', 'Oglas nije odobren!' );
		
		return redirect()->back();
	}
	
	public function deleteCar( Request $request )
	{
		$id = $request->input( 'delete_car_id' );
		
		if ( $id ) {
			
			Car::whereId( $id )->update( [ 'status' => 0 ] );
			
			$request->session()->flash( 'alert-info', 'Oglas je neodobren!' );
			
			return redirect()->back();
		}
		
		$request->session()->flash( 'alert-danger', 'Oglas nije izbrisan!' );
		
		return redirect()->back();
	}
	
	public function hardDeleteCar( Request $request )
	{
		$id = $request->input( 'delete_car_id' );
		
		$car = Car::find( $id );
		
		$car->delete();
		
		$request->session()->flash( 'alert-success', 'Uspesno ste izbrisali oglas!' );
		
		return redirect()->back();
	}
	
	public function searchCar()
	{
		$categories = Category::all();
		
		return view( 'layouts.pages.search_car', compact( 'categories' ) );
	}
	
	public function search( Request $request )
	{
		if ( $request->ajax() ) {
			
			$cars = Car::whereCategoryId( $request->category_id )->whereStatus( 1 )->get();
			
			if ( count( $cars ) ) {
				$request->session()->flash( 'alert-warning', 'Pronadjeni su sledeci oglasi.' );
			} else {
				$request->session()->flash( 'alert-warning', 'Nema pronadjenih oglasa.' );
			}
			
			return view( 'layouts.pages.search_result', compact( 'cars' ) )->render();
		}
	}
	
}