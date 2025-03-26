<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buates;

class BuatesController extends Controller
{
    public function index()
    {
        $documents = Buates::all();
        return view('documents.index', compact('documents'));
    }

    public function create()
    {
        return view('documents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        Buates::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('documents.index');
    }

    public function show($id)
    {
        $document = Buates::find($id);
        return view('documents.show', compact('document'));
    }
}
