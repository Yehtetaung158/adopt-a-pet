<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
        return view('orders.edit', compact('order'));
    }


    public function update(UpdateOrderRequest $request, Order $order)
    {
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
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully');
    }

    public function cancelOrder(Pet $pet, StoreOrderRequest $request)
    {
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
    }

    public function cancelOrderForOrderPage(Pet $pet, StoreOrderRequest $request)
    {
        $order = Order::where('pet_id', $pet->id)
            ->where('user_id', $request->user()->id)
            ->where('status', 'pending')
            ->first();
        $order->delete();
        $pet->status = 'available';
        $pet->save();
        return redirect()->route('pets.orders')->with('success', 'Order cancelled successfully');
    }
    public function showPublicOrders()
    {
        $AuthUser = Auth::user();

        if (!$AuthUser) {
            abort(403, 'Unauthorized');
        }

        $user = User::find($AuthUser->id);

        if (!$user) {
            abort(404, 'User not found');
        }

        $orders = $user->orders()->where('status', '!=', 'cancelled')->with('pet')->get();
        // return $orders;
        return view('public.order.index', compact('orders'));
    }
}
