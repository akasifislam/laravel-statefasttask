<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UrlShortenerController extends Controller
{
    public function shorten(Request $request)
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
            'original_url' => $request->input('original_url'),
            'short_code' => $shortCode,
            'user_id' => auth()->id(),
        ]);

        return response()->json([
            'short_code' => url($shortCode),
            'original_url' => $url->original_url
        ], 201);
    }
}
