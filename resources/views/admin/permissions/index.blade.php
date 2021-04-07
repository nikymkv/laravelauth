@extends('layouts.app')
@section('content')
    @foreach ($permissions as $permission)
       <p><a href="{{ route('admin.permissions.show', ['permission' => $permission])}}">{{ $permission->id }} {{ $permission->name }}</a></p>
    @endforeach
    <p><a href="{{ route('admin.permissions.create') }}">Новые права</a></p>
@endsection
