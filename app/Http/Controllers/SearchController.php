<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\connectPublicAPI;

class SearchController extends Controller
{
    use connectPublicAPI;

    public function index() {
        //
    }

    // Search posts by title
    public function searchByTitle(Request $request) {
        // validate input, only letters are allowed
        $this->validate($request, [
            'title' => ['required', 'regex:/^[a-zA-Z]+$/'],
        ]);

        // get input from input form
        $title = $request->get('title');
        
        $posts = $this->getDataFromAPI();
        
        //dd($posts);
        $newPosts = array();
        
        // find posts containing the input string and push to a new array
        foreach($posts as $post) {
            if (strpos($post->title, $title) !== false ) {
                array_push($newPosts, $post);
            }
        }

        $results = $this->createPagination($newPosts);
    
        return view('searchBlogByTitle', compact('results'));
        
    }

    

    public function sortPostsByTitle() {

        $posts = $this->getDataFromAPI();

        // sort posts array by comparing title string
        usort($posts, function($a, $b) {
            return $a->title <=> $b->title;
        });
        
        $results = $this->createPagination($posts);
    
        return view('searchBlogByTitle', compact('results'));

    }

    public function filterPosts(Request $request) {
        $this->validate($request, [
            'filter' => ['required', 'regex:/^[a-zA-Z]+$/'],
        ]);

        $filter_str = $request->get('filter');

        $posts = $this->getDataFromAPI(); 
        
        // filter posts, only shows posts which contains the string in title or in body
        foreach($posts as $post) {
            if (strpos($post->title, $filter_str) !== false || strpos($post->body, $filter_str) !== false ) {
                // do nothing
            } else {
                //dd(key($posts));
                unset($posts[key($posts)]);
               
            }
        }

        $results = $this->createPagination($posts);
    
        return view('searchBlogByTitle', compact('results'));
    }
       

}
