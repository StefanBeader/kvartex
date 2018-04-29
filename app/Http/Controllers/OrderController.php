<?php

namespace App\Http\Controllers;

use App\Grids\OrdersGrid;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grid = OrdersGrid::create();
        return view('orders.index', compact('grid'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function store(Request $request)
    {
        $createData = array_add($request->all(), 'user_id', Auth::user()->id);

        $validator = Validator::make($createData, Order::rules());

        if ($validator->fails()) {
            return [
                'message' => 'error',
                'errors' => $validator->getMessageBag()->toArray()
            ];
        }

        $order = Order::create($createData);


        OrderStatus::create([
            'order_id' => $order->id
        ]);
        return [
            'message' => 'success',
            'order' => $order
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }
}
