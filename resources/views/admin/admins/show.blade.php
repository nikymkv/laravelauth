@extends('layouts.app')
@section('content')
    <p>id: {{ $admin->id }}</p>
    <p>name: {{ $admin->name }}</p>
    <p>email: {{ $admin->email }}</p>
    <p>created: {{ $admin->created_at }}</p>
    <p>updated: {{ $admin->updated_at }}</p>
    <p>role: {{ $admin->roles->first()->name }}</p>
    <p>permissions:
        @foreach ($admin->permissions as $perm)
            <input type="checkbox" name="permissions" value="{{ $perm->id }}" > {{ $perm->name }}
        @endforeach
    </p>
    @if (isset($admin->photo->path))
        <img src="{{ route('admin.admins.photo_profile', ['admin' => $admin]) }}" width="200" alt="" srcset="">        
    @endif
    <p><a href="{{ route('admin.admins.edit', ['admin' => $admin]) }}">Изменить</a></p>
@endsection