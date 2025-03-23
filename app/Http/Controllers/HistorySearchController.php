<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Historysearch;

class HistorysearchController extends Controller
{
    public function Search(Request $request)
    {
        $request->validate([
            'history' => 'required|string',
        ]);

        if (!session('isLoggedIn')) {
            return redirect()->route('appes.artikeles')->with('searcherror', 'Harus login dulu untuk mencari.');
        }

        Historysearch::create([
            'userid' => session('userid'),
            'history' => $request->history,
        ]);

        return redirect()->route('appes.searches');
    }

    public function index()
    {
        if (!session('isLoggedIn')) {
            return redirect()->route('authes')->with('searcherror', 'Harus login dulu.');
        }

        $histories = Historysearch::where('userid', session('userid'))->latest()->get();
        return view('appes.searches', compact('histories'));
    }
}
