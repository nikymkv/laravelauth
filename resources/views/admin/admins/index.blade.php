@extends('layouts.app')
@section('content')
    @foreach ($admins as $admin)
       <p><a href="{{ route('admin.admins.show', ['admin' => $admin])}}">{{ $admin->id }} {{ $admin->name }} {{ $admin->email }}</a></p>
    @endforeach
    <p><a href="{{ route('admin.admins.create') }}">Новый пользователь</a></p>
@endsection
