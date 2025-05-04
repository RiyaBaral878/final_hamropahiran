<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\OrderConfirmed;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function checkout()
    {
        $cartItems = Cart::where('user_id', auth()->id())->with('outfit')->get();

        $total = $cartItems->sum(function ($item) {
            return $item->cost * $item->quantity;
        });
        return view('frontend.checkout', compact('cartItems', 'total'));
    }

    public function storeCheckout(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'country' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postcode' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'payment_type' => 'required|in:cod,esewa',
        ]);

        $user_id = auth()->id();
        $carts = Cart::where('user_id', $user_id)->get();

        $order = Order::create([
            'user_id' => $user_id,
            'status' => "pending",
            'total_amount' => $carts->sum('cost'),
            'payment_method' => $request->payment_type,
        ]);

        ShippingAddress::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'country' => $request->country,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postcode' => $request->postcode,
            'phone' => $request->phone,
            'email' => $request->email,
            'order_id' => $order->id,
        ]);

        foreach ($carts as $cart) {
            $order_item = new OrderItem();
            $order_item->order_id = $order->id;
            $order_item->outfit_id = $cart->outfit_id;
            $order_item->quantity = $cart->quantity;
            $order_item->cost = $cart->cost;
            $order_item->save();
        }
        session()->flash('order_id', $order->id);
        return redirect()->route('confirmation');
    }

    public function getConfirmation()
    {
        $order_id = session()->get('order_id');
        if (!($order_id && Order::where('id', $order_id)->exists())) {
            return redirect()->route('index')->with('error', 'Carts not found');
        }
        $data = ShippingAddress::where('order_id', $order_id)->first();
        $cartItems = Cart::where('user_id', auth()->id())->get();

        return view('frontend.confirmation', compact('data', 'cartItems'));
    }

    public function finalize($oid)
    {
        $order = Order::with('items')->findOrFail($oid);

        $transaction_uuid = Str::orderedUuid();
        $total_amount = (int) $order->total_amount; // Esewa expects integer amount

        // Store transaction UUID in order for verification later (optional but recommended)
        $order->transaction_uuid = $transaction_uuid;
        $order->save();

        Cart::where('user_id', auth()->id())->delete();

        if ($order->payment_method == "esewa") {

            // Prepare signature
            $message = "total_amount={$total_amount},transaction_uuid={$transaction_uuid},product_code=EPAYTEST";
            $secret = "8gBm/:&EnhH.1/q";
            $s = hash_hmac('sha256', $message, $secret, true);
            $signature = base64_encode($s);

            return view('frontend.esewa_form', [
                'amount' => $total_amount,
                'transaction_uuid' => $transaction_uuid,
                'product_code' => 'EPAYTEST',
                'success_url' => route('payment.success'),
                'failure_url' => route('payment.failure'),
                'signature' => $signature,
            ]);
        }

        Mail::to($order->address->email)->send(new OrderConfirmed($order));
        return redirect()->route('payment.successPage', $order);

    }

    public function success(Request $request)
    {
        // 1. Get the base64 encoded `data` param
        $encodedData = $request->query('data');

        // 2. Decode base64 to get the JSON string
        $jsonData = base64_decode($encodedData);

        // 3. Convert JSON string to PHP array
        $data = json_decode($jsonData, true);

        if (!$data || !isset($data['transaction_uuid'])) {
            return redirect()->route('payment.failure')->with('error', 'Invalid payment response');
        }

        // 4. Find order using the transaction_uuid
        $order = Order::where('transaction_uuid', $data['transaction_uuid'])->first();

        if (!$order) {
            return redirect()->route('payment.failure')->with('error', 'Order not found');
        }

        // 5. Check if payment is successful
        if ($data['status'] === 'COMPLETE') {
            $order->payment_status = 'paid';
            $order->payment_method = 'esewa';
            $order->save();

            Mail::to($order->address->email)->send(new OrderConfirmed($order));
            return redirect()->route('payment.successPage', $order->id);
        } else {
            return redirect()->route('payment.failure')->with('error', 'Payment not complete');
        }
    }

    public function successPage($orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('frontend.orders.success', compact('order'));

    }

    public function failure()
    {
        return view('frontend.orders.failure');
    }

    public function myOrders()
    {
        $orders = Order::with('items.outfit')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('frontend.orders.my_orders', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('items.outfit.seller')
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('frontend.orders.order_detail', compact('order'));
    }
}
