<?php namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Behaviors\Upload;

class CategoriesController extends Controller
{
	use Upload;
	
	public function index()
	{
		$categories = Category::all();
		
		return view( 'layouts.pages.categories', compact( 'categories' ) );
	}
	
	public function edit( $id )
	{
		$category = Category::find( $id );
		
		return view( 'layouts.pages.edit_category', compact( 'category' ) );
	}
	
	public function addCategory( Request $request )
	{
		$messages = [
			'category_name.required' => 'Morate uneti naziv kategorije!',
			'category_logo.required' => 'Morate uneti logo kategorije!',
			'category_name.unique'   => 'Kategorija sa ovim nazivom vec postoji!',
			'category_logo.image'    => 'Logo kategorije u dobrom formatu!'
		];
		
		$this->validate( $request, [
			'category_name' => 'required|unique:categories,name|max:255',
			'category_logo' => 'required|image'
		], $messages );
		
		$name = $request->input( 'category_name' );
		
		if ( $name && $request->hasFile( 'category_logo' ) ) {
			
			$category = new Category;
			
			$category->name = $name;
			
			$logo      = $request->file( 'category_logo' );
			$imageName = time() . '.' . $logo->getClientOriginalName();
			
			$this->upload( $logo, $imageName );
			
			$category->logo = $imageName;
			
			$category->save();
			
			$request->session()->flash( 'alert-success', 'Kategorija je uspešno dodata!' );
			
			return redirect()->route( 'categories' );
		}
		
		$request->session()->flash( 'alert-danger', 'Morate uneti naziv i logo kategorije!' );
		
		return redirect()->route( 'categories' );
	}
	
	public function deleteCategory( Request $request )
	{
		$id = $request->input( 'category_id' );
		
		$category = Category::find( $id )->delete();
		
		$request->session()->flash( 'alert-success', 'Kategorija je uspešno izbrisana!' );
		
		return redirect()->route( 'categories' );
	}
	
	public function editCategory( Request $request )
	{
		$id = $request->input( 'category_id' );
		
		if ( $request->hasFile( 'category_logo' ) ) {
			
			$logo            = $request->file( 'category_logo' );
			$imageName       = time() . '.' . $logo->getClientOriginalName();
			$destinationPath = public_path( '/images', $logo->getClientOriginalName() );
			
			$logo->move( $destinationPath, $imageName );
			
			Category::whereId( $id )->update( [ 'logo' => $imageName ] );
			
			$request->session()->flash( 'alert-success', 'Kategorija je uspešno izmenjena!' );
			
			return redirect()->to( 'edit/category/' . $id );
		}
		
		$request->session()->flash( 'alert-danger', 'Unesite logo kategorije!' );
		
		return redirect()->to( 'edit/category/' . $id );
	}
	
}