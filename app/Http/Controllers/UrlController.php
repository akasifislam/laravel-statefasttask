<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $urls = Url::latest('id')->get();
        return view('admin.url.index', compact('urls'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.url.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'original_url' => 'required|url',
        ]);

        function generateUniqueShortCode($length = 6)
        {
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwx';
            $shortCode = '';
            for ($i = 0; $i < $length; $i++) {
                $shortCode .= $characters[rand(0, strlen($characters) - 1)];
            }
            return $shortCode;
        }

        do {
            $shortCode = generateUniqueShortCode();
        } while (Url::where('short_code', $shortCode)->exists());

        $url = Url::create([
            'original_url' => $request->original_url,
            'short_code' => $shortCode,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('urls.show', $url);
    }



    /**
     * Display the specified resource.
     */
    public function show(Url $url)
    {
        return view('admin.url.show', compact('url'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Url $url)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Url $url)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Url $url)
    {
        //
    }
}
