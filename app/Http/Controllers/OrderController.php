<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Pet;
use Google\Service\CloudSearch\Id;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $orders = Order::with(['pet', 'pet.breed', 'pet.breed.category', 'user'])->get();
        // return $orders;
        // return view('orders.index', compact('orders'));
        // return view('orders.index');
        $orders = Order::with(['user', 'pet'])->get();
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        // return $request;
        $existedOrder = Order::where('pet_id', $request->pet_id)
            ->where('user_id', $request->user_id)
            ->first();
        // return $existedOrder;
        if (!$existedOrder) {
            $order = new Order();
            $order->user_id = $request->user_id;
            $order->pet_id = $request->pet_id;
            $order->phone = $request->phone;
            $order->address = $request->address;
            $order->status = 'pending';
            $order->save();
            return redirect()->route('pets.detail', $request->pet_id)->with('success', 'Order created successfully');
        } else {
            if ($existedOrder->status == 'cancelled' && $existedOrder) {
                $existedOrder->status = 'pending';
                $existedOrder->phone = $request->phone;
                $existedOrder->address = $request->address;
                $existedOrder->save();
                return redirect()->route('pets.detail', $request->pet_id)->with('success', 'Order created successfully');
            } elseif ($existedOrder->status == 'approved') {
                return redirect()->route('pets.detail', $request->pet_id)->with('error', 'Order already approved');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        // return $order;
        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        // return $request;
        $pet = Pet::find($order->pet_id);
        $order->status = $request->status;
        $order->save();
        if ($order->status == 'approved') {
            $pet->status = 'adopted';
            $pet->save();
        } elseif ($order->status == 'cancelled' || $order->status == 'pending') {
            $pet->status = 'available';
            $pet->save();
        }
        return redirect()->route('orders.index')->with('success', 'Order updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully');
    }

    public function cancelOrder(Pet $pet, StoreOrderRequest $request)
    {
        // return $pet;
        $order = Order::where('pet_id', $pet->id)
            ->where('user_id', $request->user()->id)
            ->where('status', 'pending')
            ->first();
        if (!$order) {
            return redirect()->route('pets.detail', $pet->id)->with('error', 'No pending order found for this pet.');
        }
        $order->delete();
        $pet->status = 'available';
        $pet->save();
        return redirect()->route('pets.detail', $pet->id)->with('success', 'Order cancelled successfully');
        // return $request;
    }
}
