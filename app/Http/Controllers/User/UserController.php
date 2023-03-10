<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Contact;
use App\Models\Order;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // user home page
    public function home()
    {
        $pizza = Product::orderBy('created_at', 'desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $history = Order::where('user_id', Auth::user()->id)->get();
        return view('user.main.home', compact('pizza', 'category', 'cart', 'history'));
    }

    // user change password page
    public function changePasswordPage()
    {
        return view('user.password.change');
    }

    // change password
    public function changePassword(Request $request)
    {
        $this->passwordValidationCheck($request);

        $user = User::select('password')->where('id', Auth::user()->id)->first();
        $dbHashValue = $user->password;

        if (Hash::check($request->oldPassword, $dbHashValue)) {
            User::where('id', Auth::user()->id)->update([
                'password' => Hash::make($request->newPassword)
            ]);

            return back()->with(['changeSuccess' => 'Password Change Success']);
        }

        return back()->with(['notMatch' => 'The Old Password doesn\'t Match.Try Again!']);
    }

    // account change page
    public function accountChangePage()
    {
        return view('user.profile.account');
    }

    // account change
    public function accountChange($id, Request $request)
    {
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        if ($request->hasFile('image')) {
            $dbImage = User::where('id', $id)->first();
            $dbImage = $dbImage->image;

            if ($dbImage != null) {
                Storage::delete('public/' . $dbImage);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }
        User::where('id', $id)->update($data);
        return back()->with(['updateSuccess' => 'Account Updated Success...']);
    }

    // filter
    public function filter($categoryId)
    {
        $pizza = Product::where('category_id', $categoryId)->orderBy('created_at', 'desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $history = Order::where('user_id', Auth::user()->id)->get();
        return view('user.main.home', compact('pizza', 'category', 'cart', 'history'));
    }

    // direct pizza details
    public function pizzaDetails($pizzaId)
    {
        $pizza = Product::where('id', $pizzaId)->first();
        $pizzaAll = Product::get();
        return view('user.main.detail', compact('pizza', 'pizzaAll'));
    }

    // cart list
    public function cartList()
    {
        $cartList = Cart::select('carts.*', 'products.name as pizza_name', 'products.price as pizza_price', 'products.image as pizza_Image')
            ->leftJoin('products', 'products.id', 'carts.product_id')
            ->where('carts.user_id', Auth::user()->id)
            ->get();
        $totalPrice = 0;
        foreach ($cartList as $c) {
            $totalPrice += $c->pizza_price * $c->qty;
        }
        return view('user.cart.cart', compact('cartList', 'totalPrice'));
    }

    // direct history page
    public function history()
    {
        $order = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(6);
        return view('user.main.history', compact('order'));
    }

    // direct contact page
    public function createPage()
    {
        return view('user.contact.contact');
    }

    // create contact
    public function create(Request $request)
    {
        $this->contactValidationCheck($request);
        $data = $this->requestContactData($request);
        Contact::create($data);
        return back()->with(['createSuccess' => 'Send Message Success...']);
    }

    // password validation check
    private function passwordValidationCheck($request)
    {
        Validator::make($request->all(), [
            'oldPassword' => 'required|min:6|max:10',
            'newPassword' => 'required|min:6|max:10',
            'confirmPassword' => 'required|min:6|max:10|same:newPassword'
        ])->validate();
    }

    // account validation check
    private function accountValidationCheck($request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'image' => 'mimes:png,jpg,jpeg,webp|file',
            'address' => 'required'
        ])->validate();
    }

    // get user data
    private function getUserData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
            'updated_at' => Carbon::now()
        ];
    }

    // request contact data
    private function requestContactData($request)
    {
        return [
            'name' => $request->userName,
            'email' => $request->userEmail,
            'message' => $request->userMessage
        ];
    }

    // contact validation check
    private function contactValidationCheck($request)
    {
        Validator::make($request->all(), [
            'userName' => 'required',
            'userEmail' => 'required',
            'userMessage' => 'required'
        ])->validate();
    }
}
