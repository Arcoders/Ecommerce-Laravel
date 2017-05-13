<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\ShoppingCart;
use App\Product;

class MainController extends Controller{

	public function home(){
		$products = Product::latest()->simplePaginate(10);
		return view('main.home', ['products' => $products]);
	}

}
