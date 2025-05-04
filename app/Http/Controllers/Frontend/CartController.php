<?php

namespace App\Http\Controllers\Frontend;

use App\Events\sendMail;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Outfit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class CartController extends Controller
{
    public function index(){
        $userId = Auth::user()->id;

        $carts = Cart::where('user_id', $userId)->with('outfit')->get();
        return view('frontend.shoping-cart', compact('carts'));
    }

    public function store(Request $request){
        $request->validate([
            'outfit_id' => 'required|exists:outfits,id',
            'quantity' => 'sometimes|integer|min:1',
        ]);

        $userId = auth()->id();

        $outfit = Outfit::with('seller')->findOrFail($request->outfit_id);
        $cost = ($outfit->seller->price * $request->quantity);

        Cart::updateOrCreate(
            [
                'user_id' => $userId,
                'outfit_id' => $request->outfit_id,
            ],
            [
                'quantity' => $request->input('quantity', 1),
                'cost' => $cost ?? 0.00,
            ]
        );

        Event::dispatch(new sendMail($userId));

        return redirect()->route('getCart')->with('success', 'Successfully store cart');
    }

    public function update(Request $request, $id){
        $cart = Cart::with('outfit')->findOrFail($id);
        $request->validate([
            'quantity' => 'nullable|integer|min:1',
            'cost' => 'nullable|numeric|min:0'
        ]);

        $cost = ($cart->outfit->seller->price * $request->quantity);

        $cart->update([
            'quantity' => $request->quantity,
            'cost' => $cost,
        ]);

        return redirect()->route('getCart')->with('success', 'Successfully updated cart');
    }

    public function destroy($id){
        $cart = Cart::findOrFail($id);
        $cart->delete();
        
        return redirect()->route('getCart')->with('success', 'Successfully deleted cart');
    }
}
