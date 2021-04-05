@extends('layouts.app')
@section('content')
    <form action="{{ route('admin.admins.update', ['admin' => $admin]) }}" method="POST">
        @csrf
        @method('PUT')
        <p><input type="text" name="id" value="{{ $admin->id }}" readonly></p>
        <p><input type="text" name="name" value="{{ $admin->name }}"></p>
        <p><input type="text" name="email" value="{{ $admin->email }}"></p>
        <p><input type="text" name="created_at" value="{{ $admin->created_at }}"></p>
        <p><input type="text" name="updated_at" value="{{ $admin->updated_at }}"></p>
        <p>
            <select name="role">
                @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ $admin->roles->first()->name === $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                @endforeach
            </select>
        </p>
        <p><input type="submit" value="Сохранить"></p>
    </form>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@endsection