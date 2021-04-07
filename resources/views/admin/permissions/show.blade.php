@extends('layouts.app')
@section('content')
    <p>id: {{ $permission->id }}</p>
    <p>name: {{ $permission->name }}</p>
    <p>created: {{ $permission->created_at }}</p>
    <p>updated: {{ $permission->updated_at }}</p>
    <p><a href="{{ route('admin.permissions.edit', ['permission' => $permission]) }}">Изменить</a></p>
@endsection