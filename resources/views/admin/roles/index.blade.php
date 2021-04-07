@extends('layouts.app')
@section('content')
    @foreach ($roles as $role)
       <p><a href="{{ route('admin.roles.show', ['role' => $role])}}">{{ $role->id }} {{ $role->name }}</a></p>
    @endforeach
    <p><a href="{{ route('admin.roles.create') }}">Новый пользователь</a></p>
@endsection
