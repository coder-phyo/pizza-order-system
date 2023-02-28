<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Order;
use App\Models\OrderList;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    // GET
    // get all pizza data list with api
    public function pizzaDataList()
    {
        // get all product list
        $products = Product::get();
        // get all user list
        $users = User::get();
        // get all category list
        $category = Category::orderBy('id', 'desc')->get();
        // get all order list
        $orderList = OrderList::get();
        // get all order
        $order = Order::get();
        // get all contact
        $contact = Contact::get();

        $data = [
            "products" => $products,
            "users" => $users,
            "category" => $category,
            "orderList" => $orderList,
            "order" => $order,
            "contact" => $contact
        ];

        return response()->json($data, 200);
    }

    // POST
    public function categoryCreate(Request $request)
    {
        // get category list
        $data = [
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        Category::create($data);

        return response()->json($data, 200);
    }

    // create contact
    public function createContact(Request $request)
    {
        $data = $this->getContactData($request);
        Contact::create($data);

        $contact = Contact::orderBy('created_at', 'desc')->get();
        return response()->json($contact, 200);
    }

    // delete category
    public function categoryDelete($id)
    {
        $data = Category::where('id', $id)->first();

        if (isset($data)) {
            Category::where('id', $id)->delete();
            return response()->json(["status" => true, 'message' => "delete success...", "data" => $data], 200);
        }

        return response()->json(["status" => false, "message" => "There is no Category..."], 200);
    }

    // get contact data
    private function getContactData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ];
    }
}
