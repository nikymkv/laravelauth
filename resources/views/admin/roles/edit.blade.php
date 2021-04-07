@extends('layouts.app')
@section('content')
    <form action="{{ route('admin.roles.update', ['role' => $role]) }}" method="POST">
        @csrf
        @method('PUT')
        <p><input type="text" name="id" value="{{ $role->id }}" readonly></p>
        <p><input type="text" name="name" value="{{ $role->name }}"></p>
        <p>Создан: {{ $role->created_at }}</p>
        <p>Последнее редактирование: {{ $role->updated_at }}</p>
        <p>permissions:
            @foreach ($permissions as $key => $perm)
                <br><input type="checkbox" name="permissions[]" value="{{ $key }}" {{ $perm->get('has') ? 'checked' : '' }}>{{ $perm->get('name') }}
            @endforeach
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