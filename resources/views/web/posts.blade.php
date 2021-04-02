@extends('layouts.app')
@section('content')
    @foreach ($posts as $post)
        <a href="{{route('posts.show', ['post' => $post->id])}}">{{$post->title}}</a><br>
    @endforeach        
@endsection