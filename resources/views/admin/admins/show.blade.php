@extends('layouts.app')
@section('content')
    id: {{ $admin->id }} <br>
    name: {{ $admin->name }} <br>
    email: {{ $admin->email }} <br>
    created: {{ $admin->created_at }} <br>
    updated: {{ $admin->updated_at }} <br>
    role: {{ $admin->roles->first()->name }} <br>
    permissions:
    @foreach ($admin->permissions as $perm)
        <input type="checkbox" name="permissions" value="{{ $perm->id }}" > {{ $perm->name }}
    @endforeach
    <br>
    Available roles: 
    <select name="roles">
        @foreach ($roles as $role)
                <option value="{{ $role->id }}" {{ $admin->roles->first()->name === $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
        @endforeach
    </select>
@endsection