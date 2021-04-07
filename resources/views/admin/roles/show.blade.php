@extends('layouts.app')
@section('content')
    <p>id: {{ $role->id }}</p>
    <p>name: {{ $role->name }}</p>
    <p>created: {{ $role->created_at }}</p>
    <p>updated: {{ $role->updated_at }}</p>
    <p>permissions:
        <ul>
            @foreach ($role->permissions as $perm)
                <li>{{ $perm->name }}</li>
            @endforeach
        </ul>
    </p>
    <p><a href="{{ route('admin.roles.edit', ['role' => $role]) }}">Изменить</a></p>
@endsection