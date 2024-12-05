<?php

namespace App\Http\Controllers;

use App\Services\ShortenerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShortenerController extends Controller
{
    public function __construct(private ShortenerService $shortenerService)
    {
    }

    public function encode(Request $request): JsonResponse
    {
        $url = $request->query('url');
        if (empty($url)) {
            return response()->json(['error' => 'You must provide a "url" parameter.'], 422);
        }

        return response()->json([
            'url' => $this->shortenerService->encode($url),
        ], 200);
    }

    public function decode(Request $request): JsonResponse
    {
        $url = $request->query('url');
        if (empty($url)) {
            return response()->json(['error' => 'You must provide a "url" parameter.'], 422);
        }

        $url = $this->shortenerService->decode($url);
        if (empty($url)) {
            return response()->json(['error' => 'No full URL is linked to this shortened one.'], 404);
        }

        return response()->json(['url' => $url], 200);
    }
}
