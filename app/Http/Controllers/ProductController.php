<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // products list
    public function list()
    {
        $pizzas = Product::orderBy('created_at', 'desc')->paginate(5);

        return view('admin.products.pizzaList', compact('pizzas'));
    }

    // products create page
    public function createPage()
    {
        $categories = Category::select('id', 'name')->get();

        return view('admin.products.create', compact('categories'));
    }

    // create products
    public function create(Request $request)
    {
        $this->productValidationCheck($request);
        $data = $this->requestProductInfo($request);

        $fileName = uniqid() . $request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public', $fileName);
        $data['image'] = $fileName;

        Product::create($data);
        return redirect()->route('products#list');
    }

    // request product info
    private function requestProductInfo($request)
    {
        return [
            'category_id' => $request->pizzaCategory,
            'name' => $request->pizzaName,
            'description' => $request->pizzaDescription,
            'price' => $request->pizzaPrice,
            'waiting_time' => $request->pizzaWaitingTime
        ];
    }

    // product validation check
    private function productValidationCheck($request)
    {
        Validator::make($request->all(), [
            'pizzaName' => 'required|min:5|unique:products,name',
            'pizzaCategory' => 'required',
            'pizzaDescription' => 'required',
            'pizzaImage' => 'required|mimes:jpg,png,jpeg,webp',
            'pizzaPrice' => 'required',
            'pizzaWaitingTime' => 'required',
        ])->validate();
    }
}
