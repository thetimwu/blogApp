<?php
 
namespace App\Traits;
use Illuminate\Http\Request; 
use Illuminate\Pagination\LengthAwarePaginator;

trait connectPublicAPI {
 
    // create pagination and return an array
    public function createPagination($inputArray) {
        $page = request()->has('page') ? request('page') : 1;
        $perPage = request()->has('per_page') ? request('per_page') : 15;
        $offset = ($page * $perPage) - $perPage;

        $newCollection = collect($inputArray);

        $results = new LengthAwarePaginator(
            $newCollection->slice($offset, $perPage),
            $newCollection->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return $results;
    }

    public function getDataFromAPI() {
        // Get date from a public api
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://jsonplaceholder.typicode.com/posts');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        // Execute the request and fetch the response. Check for errors
        $output = curl_exec($ch);

        if ($output === FALSE) {
            echo "cURL error: " . curl_error($ch);
        }

        curl_close($ch);

        return  json_decode($output);

    }
 
}