@extends('layouts.app')

@section('content')
<div class="container">
        <h1>Posts</h1>
        <!-- Search posts by title form  -->
        <form action="/searchByTitle" method="GET" role="search">
            {{csrf_field()}}
            <div class="input-group">
                <input type="text" name="title" placeholder="Search Post by Title">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary">Search</button>
                </span>
            </div>
        </form>
        <hr>
        <div class="mg-t 50px" >

        <!-- Sort posts by title  -->
        <a href="/sortByTitle" class="btn btn-primary">Sort Posts By Title</a>
        </div>
        <hr>

        <!-- Filter posts by title and body  -->
        <form action="/filterPosts" method="GET" role="search">
            {{csrf_field()}}
            <div class="input-group">
                <input type="text" name="filter" placeholder="Title or Body contains...">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary">Filtering</button>
                </span>
            </div>
        </form>
        <br>
        @if(count($results) > 1)
            @foreach($results as $post)
                <div class="card card-body bg-light">
                <h3>{{$post->title}}</h3>
                <h6>{{$post->body}}</h6>
                </div>
            @endforeach
        @else 
            <p>No posts found</p>
        @endif
        {{$results->links()}}
</div>
    
@endsection

