<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Outfit;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $outfits = Outfit::with('seller')->limit(8)->latest()->get();
        return view('frontend.index', compact('outfits'));
    }

    public function productDetail($id)
    {
        $outfit = Outfit::with('materials', 'seller', 'ethnicGroup')->findOrFail($id);
        $outfits = Outfit::where('ethnic_group_id', $outfit->ethnic_group_id)->limit(4)->latest()->get();
        return view('frontend.product-details', compact('outfit', 'outfits'));
    }

    public function shop(Request $request)
    {
        $query = Outfit::whereHas('seller')->with('ethnicGroup', 'seller')->latest();

        if ($request->has('group_id') && $request->group_id) {
            $query->where('ethnic_group_id', $request->group_id);
        }

        if ($request->has('name') && $request->name) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        $outfits = $query->paginate(20);

        return view('frontend.shop-grid', compact('outfits'));
    }

    public function blog()
    {
        return view('frontend.blog');
    }

    public function contact()
    {
        return view('frontend.contact');
    }
}
