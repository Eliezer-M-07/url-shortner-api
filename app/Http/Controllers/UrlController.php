<?php

namespace App\Http\Controllers;

use App\Models\Url;
use App\Services\Base62;
use App\Http\Requests\URL\StoreRequest;

class UrlController extends Controller
{
    public function store(StoreRequest $request, Base62 $base62)
    {
        $result = $request->validated();

        $url = $request->user()->urls()->create([
            'original_url' => $result['url'],
            'short_code' => 0
        ]);

        $url->update([
            'short_code' => $base62->encode($url->id)
        ]);

        return response()->json([
            'message' => 'URL gerada com sucesso.',
            'short_url' => url("api/u/" . $url->short_code) 
        ]);
    }


    public function redirect(string $code)
    {
        $url = Url::where('short_code', $code)->firstOrFail();
        
        $url->increment('clicks');

        return redirect()->to($url->original_url);
    }
}
