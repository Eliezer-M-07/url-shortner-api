<?php

namespace App\Http\Controllers;

use App\Models\Url;
use App\Services\Base62;
use App\Http\Requests\Url\StoreRequest;
use App\Http\Requests\Url\UpdateRequest;
use App\Http\Resources\UrlResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class UrlController extends Controller
{
    public function index(Request $request)
    {
        $urls = $request->user()->urls()->latest()->paginate(10);

        return UrlResource::collection($urls);
    }    

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
            'short_url' => url("u/" . $url->short_code) 
        ]);
    }

    public function show(Url $url)
    {
        Gate::authorize('view', $url);

        return new UrlResource($url);
    }

    public function update(UpdateRequest $request, Url $url)
    {
        Gate::authorize('update', $url);

        $url->update($request->validated());

        return response()->json([
            'message' => 'URL alterada com sucesso.',
            'data' => new UrlResource($url)
        ]);
    }

    public function destroy(Url $url)
    {
        Gate::authorize('delete', $url);

        $url->delete();

        return response()->noContent();

    }


    public function redirect(string $code)
    {
        $url = Url::where('short_code', $code)->firstOrFail();
        
        $url->increment('clicks');

        return redirect()->to($url->original_url);
    }
}
