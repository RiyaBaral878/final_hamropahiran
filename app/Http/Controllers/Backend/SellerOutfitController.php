<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SellerOutfit;
use App\Models\Outfit;

class SellerOutfitController extends Controller
{
    public function index()
    {
        $outfits = SellerOutfit::with('outfit')
            ->get()
            ->groupBy('seller_name');

        return view('backend.sellers-outfits.index', compact('outfits'));
    }



    public function create()
    {
        $outfits = Outfit::whereDoesntHave('seller')->get();
        return view('backend.sellers-outfits.create', compact('outfits'));
    }

    public function show($id)
    {
        $outfit = SellerOutfit::with('outfit')->findOrFail($id);

        return view('backend.sellers-outfits.show', compact('outfit'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'outfit_id' => 'required|exists:outfits,id',
            'seller_name' => 'required|string|max:255',
            'seller_contact' => 'nullable|string|max:20|regex:/^\d+$/',
            'seller_address' => 'nullable|string',
            'price' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'stock' => 'required|integer|min:0',
        ]);

        SellerOutfit::create($request->all());

        return redirect()->route('admin.sellers-outfits.index')->with('success', 'Seller outfit added successfully.');
    }

    public function edit($sellerOutfitId)
    {
        $sellerOutfit = SellerOutfit::findOrFail($sellerOutfitId);
        $outfits = Outfit::all();
        return view('backend.sellers-outfits.edit', compact('sellerOutfit', 'outfits'));
    }

    public function update(Request $request, $sellerOutfitId)
    {
        $sellerOutfit = SellerOutfit::findOrFail($sellerOutfitId);
        $request->validate([
            'outfit_id' => 'required|exists:outfits,id',
            'seller_name' => 'required|string|max:255',
            'seller_contact' => 'nullable|string|max:20',
            'seller_address' => 'nullable|string',
            'price' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'stock' => 'required|integer|min:0',
        ]);

        $sellerOutfit->update($request->all());

        return redirect()->route('admin.sellers-outfits.index')->with('success', 'Seller outfit updated successfully.');
    }

    public function destroy(SellerOutfit $sellerOutfit)
    {
        $sellerOutfit->delete();
        return redirect()->route('admin.sellers-outfits.index')->with('success', 'Seller outfit deleted successfully.');
    }
}
