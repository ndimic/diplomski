<?php namespace App\Http\Controllers;

use App\Car;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarsController extends Controller
{
	function __construct()
	{
		//include_once('simple_html_dom.php');
	}
	
	public function index()
	{
		$allCars = Car::where( 'status', 1 )->get();
		
		if ( count( $allCars ) > 10 ) {
			
			// Number of cars per page
			$paginate = 4;
			
			$cars = Car::where( 'status', 1 )->with( 'category' )->paginate( $paginate );
			
		} else {
			
			// Number of cars per page
			$paginate = 3;
			
			$cars = Car::where( 'status', 1 )->with( 'category' )->paginate( $paginate );
			
		}
		
		return view( 'layouts.pages.cars', compact( 'cars' ) );
	}
	
	public function carDetails( $id )
	{
		$car = Car::where( 'id', $id )->with( 'category' )->first();
		
		return view( 'layouts.pages.car', compact( 'car' ) );
	}
	
	public function addCar()
	{
		$categories = Category::where( 'name', '!=', 'Audi' )->get();
		
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
		
		$imageCar        = $request->file( 'car_image' );
		$imageName       = time() . '.' . $imageCar->getClientOriginalName();
		$destinationPath = public_path( '/images', $imageCar->getClientOriginalName() );
		$imageCar->move( $destinationPath, $imageName );
		$image = $imageName;
		
		// Inserting car in database
		
		Car::create( [
			'category_id' => $request->get( 'car_category_id' ),
			'name'        => $request->get( 'car_name' ),
			'price'       => $request->get( 'car_price' ),
			'year'        => $request->get( 'car_year_id' ),
			'km'          => $request->get( 'car_km' ),
			'image'       => $image,
			'description' => $request->get( 'car_description' ) ? $request->get( 'car_description' ) : '',
			'user_id'     => Auth::id()
		] );
		
		$request->session()->flash( 'alert-success', 'Oglas je uspešno dodat! Naši administatori će razmotriti Vaš oglas.' );
		
		return redirect()->action( 'CarsController@addCar' )->with( 'success', 'Oglas uspesan test!' );
	}
	
	public function userAds()
	{
		$cars = Car::where( 'user_id', Auth::id() )->with( 'category' )->paginate( 3 );
		
		return view( 'layouts.pages.my_ads', compact( 'cars', 'now' ) );
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
			
			return redirect()->to( 'edit/ad/' . $id );
			
		} elseif ( ! $price || ! is_numeric( $price ) ) {
			
			if ( ! is_numeric( $price ) && $price ) {
				$request->session()->flash( 'alert-danger', 'Cena nije uneta u dobrom formatu!' );
			} else {
				$request->session()->flash( 'alert-danger', 'Morate uneti cenu automobila!' );
			}
			
			return redirect()->to( 'edit/ad/' . $id );
			
		} elseif ( ! $year ) {
			
			$request->session()->flash( 'alert-danger', 'Morate izabrati godinu proizvodnje automobila!' );
			
			return redirect()->to( 'edit/ad/' . $id );
			
		} elseif ( ! $km || ! is_numeric( $km ) ) {
			
			if ( ! is_numeric( $km ) && $km ) {
				$request->session()->flash( 'alert-danger', 'Kilometraža nije uneta u dobrom formatu!' );
			} else {
				$request->session()->flash( 'alert-danger', 'Morate uneti pređenu kilometražu!' );
			}
			
			return redirect()->to( 'edit/ad/' . $id );
			
		}
		
		if ( $request->hasFile( 'car_image' ) ) {
			
			$new             = $request->file( 'car_image' );
			$imageName       = time() . '.' . $new->getClientOriginalName();
			$destinationPath = public_path( '/images', $new->getClientOriginalName() );
			$new->move( $destinationPath, $imageName );
			
			Car::where( 'id', $id )->update( [ 'image' => $imageName ] );
		}
		
		Car::where( 'id', $id )->update( [
			'name'        => $name,
			'price'       => $price,
			'year'        => $year,
			'km'          => $km,
			'description' => $description
		] );
		
		$request->session()->flash( 'alert-success', 'Uspešno se izmenili Vaš oglas!' );
		
		return redirect()->to( 'edit/ad/' . $id );
	}
	
	public function adminListCars()
	{
		$cars = Car::with( 'user' )->paginate( 4 );
		
		return view( 'layouts.pages.approve_car', compact( 'cars' ) );
	}
	
	public function approveCar( Request $request )
	{
		$id = $request->input( 'approve_car_id' );
		
		if ( $id ) {
			
			Car::where( 'id', $id )->update( [ 'status' => 1 ] );
			
			$request->session()->flash( 'alert-success', 'Oglas je odobren!' );
			
			return redirect()->action( 'CarsController@adminListCars' );
		}
		
		$request->session()->flash( 'alert-danger', 'Oglas nije odobren!' );
		
		return redirect()->action( 'CarsController@adminListCars' );
	}
	
	public function deleteCar( Request $request )
	{
		$id = $request->input( 'delete_car_id' );
		
		if ( $id ) {
			
			Car::where( 'id', $id )->update( [ 'status' => 0 ] );
			
			$request->session()->flash( 'alert-info', 'Oglas je neodobren!' );
			
			return redirect()->action( 'CarsController@adminListCars' );
		}
		
		$request->session()->flash( 'alert-danger', 'Oglas nije izbrisan!' );
		
		return redirect()->action( 'CarsController@adminListCars' );
	}
	
	public function searchCar()
	{
		$categories = Category::all();
		
		return view( 'layouts.pages.search_car', compact( 'categories' ) );
	}
	
	public function search( Request $request )
	{
		if ( $request->ajax() ) {
			
			$cars = Car::where( 'category_id', $request->category_id )->where( 'status', 1 )->get();
			
			if ( count( $cars ) ) {
				$request->session()->flash( 'alert-warning', 'Pronadjeni su sledeci oglasi.' );
			} else {
				$request->session()->flash( 'alert-warning', 'Nema pronadjenih oglasa.' );
			}
			
			return view( 'layouts.pages.search_result', compact( 'cars' ) )->render();
		}
	}
	
	/*public function dataAction()
	{
		//$data = file_get_contents('https://www.polovniautomobili.com/putnicka-vozila/pretraga?page=1&brand=38&model=&price_from=40000&price_to=&year_from=&year_to=&door_num=&submit_1=&without_price=1&date_limit=&showOldNew=all&modeltxt=&engine_volume_from=&engine_volume_to=&power_from=&power_to=&mileage_from=&mileage_to=&emission_class=&seat_num=&wheel_side=&registration=&country=&city=&page=&sort=');
		$data = file_get_contents('https://www.polovniautomobili.com/putnicka-vozila/pretraga?brand=38&model=&price_from=75000&price_to=&year_from=&year_to=&door_num=&submit_1=&without_price=1&date_limit=&showOldNew=all&modeltxt=&engine_volume_from=&engine_volume_to=&power_from=&power_to=&mileage_from=&mileage_to=&emission_class=&seat_num=&wheel_side=&registration=&country=&city=&page=&sort=');

		$element_title = 'a[class=ga-title]';
		$element_price = 'span[class=price]';
		$title = $this->getTextBetweenTags($data, $element_title);
		$images = [];
		foreach($title as $t){
			$element_image = 'img[alt=' . $t . ']';
			$image = $this->getTextBetweenTags($data, $element_image);
			$images[] = $image;
		}
		$price = $this->getTextBetweenTags($data, $element_price);

		$import_data = [];
		$count_data = count($title);

		for ($i = 0; $i < $count_data; $i++) {
			$import_data[$i]['name'] = $title[$i];
		}

		for ($i = 0; $i < $count_data; $i++) {
			//$key = 4 + $i;
			$import_data[$i]['price'] = $price[$i];
		}

		for ($i = 0; $i < $count_data; $i++) {
			$import_data[$i]['image'] = $images[1][0];
		}

		//TODO: Nedostaju slika, godiste i kilometraza
		foreach ($import_data as $data) {
			$car = new Car;
			$car->name = $data['name'];
			$car->price = $data['price'];
			$car->image = $data['image'];
			$car->category_id = 2;
			$car->status = 0;
			$car->external = 1;
			$car->save();
		}

		return redirect()->action('CarsController@adminListCars');
	}

	private function getTextBetweenTags($string, $element) {
		// Create DOM from string
		$html = str_get_html($string);

		$data = array();
		// Find all tags
		foreach($html->find($element) as $k => $element) {
			if(isset($element->attr['src'])){
				$data[] = $element->attr['src'];
			}else{
				$data[] = $element->plaintext;
			}
		}

		return $data;
	}*/
	
	
}