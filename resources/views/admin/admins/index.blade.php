@extends('layouts.app')
@section('content')
    @foreach ($admins as $admin)
       <a href="{{ route('admin.admins.show', ['admin' => $admin])}}">{{ $admin->id }} {{ $admin->name }} {{ $admin->email }}</a><br>
    @endforeach
@endsection
