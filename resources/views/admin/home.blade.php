@extends('layouts.app')
@section('content')
    {{ dd(Auth::user()) }}
@endsection
