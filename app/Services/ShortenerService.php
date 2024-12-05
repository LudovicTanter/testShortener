<?php

namespace App\Services;

use App\Repositories\ShortenerRepository;

class ShortenerService
{
    CONST PROTOCOL = 'http';
    CONST HOST = 'short.est';
    CONST SALT = '::shortener';

    public function __construct(private ShortenerRepository $shortenerRepository)
    {
    }

    public function encode(string $url) : string
    {
        do {
            $short = $this->hashIntoShort($url);
            $success = $this->shortenerRepository->insertShortUrlForFullUrl($url, $short);
        } while (!$success);

        return $short;
    }

    public function decode(string $url) : ?string
    {
        return $this->shortenerRepository->getFullUrlForShortUrl($url);
    }

    private function hashIntoShort(string $url) : string {
        // encode to md5
        $h = md5($url . uniqid($this::SALT, true));
        // keep only first bits
        $h = substr($h, 0, 12);
        // convert from hexa to dec
        $h = hexdec($h);
        // encode to base62
        $h = gmp_strval(gmp_init($h, 10), 62);

        return sprintf(
            '%s://%s/%s',
             $this::PROTOCOL,
             $this::HOST,
            $h,
        );
    }
}