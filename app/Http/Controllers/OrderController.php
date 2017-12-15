<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\StoreStudentRequest;
use App\Order;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function store(StoreOrderRequest $request)
    {
        $input = $request->all();
        foreach($input as $key => $value) {
            if($key === 'vat'
            || $key === 'fiscal_code') {
                $input[$key] = Str::upper($value);
            }
        }
        $order = new Order($input);
        $order->save();

        return redirect()->route('main.page')->withMsg("Thank you for registration!");
    }

    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->get();

        return view('order.index', compact('orders'));
    }
}
