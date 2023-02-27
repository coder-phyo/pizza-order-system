<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderList;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    // get all pizza data list with api
    public function pizzaDataList()
    {
        // get all product list
        $products = Product::get();
        // get all user list
        $users = User::get();
        // get all category list
        $category = Category::get();
        // get all order list
        $orderList = OrderList::get();
        // get all order
        $order = Order::get();

        $data = [
            "products" => $products,
            "users" => $users,
            "category" => $category,
            "orderList" => $orderList,
            "order" => $order
        ];

        return response()->json($data, 200);
    }
}
