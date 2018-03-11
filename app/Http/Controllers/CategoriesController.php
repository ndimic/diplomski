<?php namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
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
		$name = $request->input( 'category_name' );
		
		if ( $name ) {
			
			$category       = new Category;
			$category->name = $name;
			
			if ( $request->hasFile( 'category_logo' ) ) {
				
				$logo            = $request->file( 'category_logo' );
				$imageName       = time() . '.' . $logo->getClientOriginalName();
				$destinationPath = public_path( '/images', $logo->getClientOriginalName() );
				$logo->move( $destinationPath, $imageName );
				$category->logo = $imageName;
				
			}
			
			$category->save();
			
			$request->session()->flash( 'alert-success', 'Kategorija je uspešno dodata!' );
			
			return redirect()->action( 'CategoriesController@index' );
		}
		
		$request->session()->flash( 'alert-danger', 'Unesite naziv kategorije.' );
		
		return redirect()->action( 'CategoriesController@index' );
	}
	
	public function deleteCategory( Request $request )
	{
		$id = $request->input( 'category_id' );
		
		Category::find( $id )->delete();
		
		$request->session()->flash( 'alert-success', 'Kategorija je uspešno izbrisana!' );
		
		return redirect()->action( 'CategoriesController@index' );
	}
	
	public function editCategory( Request $request )
	{
		$id = $request->input( 'category_id' );
		
		if ( $request->hasFile( 'category_logo' ) ) {
			
			$logo            = $request->file( 'category_logo' );
			$imageName       = time() . '.' . $logo->getClientOriginalName();
			$destinationPath = public_path( '/images', $logo->getClientOriginalName() );
			$logo->move( $destinationPath, $imageName );
			
			Category::where( 'id', $id )->update( [ 'logo' => $imageName ] );
			
			$request->session()->flash( 'alert-success', 'Kategorija je uspešno izmenjena!' );
			
			return redirect()->to( 'edit/category/' . $id );
		}
		
		$request->session()->flash( 'alert-danger', 'Unesite logo kategorije!' );
		
		return redirect()->to( 'edit/category/' . $id );
	}
	
}