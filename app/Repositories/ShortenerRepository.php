<?php

namespace App\Repositories;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ShortenerRepository
{
    public function getFullUrlForShortUrl(string $shortUrl) : ?string
    {
        return DB::table('urls')->where('short', $shortUrl)->value('full');
    }

    public function insertShortUrlForFullUrl(string $fullUrl, string $shortUrl) : bool {
        try {
            DB::table('urls')->insert([
                'full' => $fullUrl,
                'short' => $shortUrl,
            ]);
        } catch (QueryException $e) {
            return false;
        }

        return true;
    }
}