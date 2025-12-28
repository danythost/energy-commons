<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BuyController extends Controller
{
    public function index()
    {
        return view('buy.index');
    }

    public function store(Request $request)
    {
        // Placeholder for purchase logic
        // TODO: Implement payment processing for Bank Transfer, Token, and Ada
        return redirect()->back()->with('success', 'Purchase initiated successfully.');
    }
}
