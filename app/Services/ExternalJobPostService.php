<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ExternalJobPostService
{
    /**
     * Fetch external job posts
     * 
     * @throws \Exception
     * @return array
     */
    public function fetchPosts(): array
    {
        try {
            $external = Http::get(config('jobposts.mrge.url'));
            $xml = simplexml_load_string($external, "SimpleXMLElement", LIBXML_NOCDATA);
            $posts = json_decode(
                json_encode($xml),
                true
            );

            return $posts['position'] ?? [];
        } catch (\Exception $e) {
            throw new \Exception('Unable to fetch external job posts: ' . $e->getMessage());
        }
    }
}
