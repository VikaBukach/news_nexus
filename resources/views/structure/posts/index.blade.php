@extends('structure.layout')

@section('title', 'Posts')

@section('content')
    @include('structure.partials.header')

    <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mt-10 mb-20">
        @foreach($posts as $post)
            @include("structure.posts.partials.item", ["post"=>$post])
        @endforeach

        {{ $posts->links() }}
    </div>

@endsection
