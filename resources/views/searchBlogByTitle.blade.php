@extends('layouts.app')

@section('content')
<div class="container">
        <h1>Posts</h1>

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