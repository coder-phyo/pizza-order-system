<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // order list
    public function orderList()
    {
        $order = Order::select('orders.*', 'users.name as user_name')
            ->when(request('key'), function ($query) {
                $query->where('users.name', 'like', '%' . request('key') . '%')
                    ->orWhere('orders.total_price', 'like', '%' . request('key') . '%');
            })
            ->leftJoin('users', 'users.id', 'orders.user_id')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.order.list', compact('order'));
    }

    // sort with ajax
    public function ajaxStatus(Request $request)
    {
        $order = Order::select('orders.*', 'users.name as user_name')
            ->when(request('key'), function ($query) {
                $query->where('users.name', 'like', '%' . request('key') . '%')
                    ->orWhere('orders.total_price', 'like', '%' . request('key') . '%');
            })
            ->leftJoin('users', 'users.id', 'orders.user_id')
            ->orderBy('created_at', 'desc');


        if ($request->status === null) {
            $order = $order->get();
        } else {
            $order = $order->where('orders.status', $request->status)->get();
        }

        return response()->json($order, 200);
    }

    // ajax change status
    public function ajaxChangeStatus(Request $request)
    {
        Order::where('id', $request->orderId)->update([
            'status' => $request->status
        ]);
    }
}
