@extends('layouts.app')
@section('content')
    <form action="{{ route('admin.permissions.update', ['permission' => $permission]) }}" method="POST">
        @csrf
        @method('PUT')
        <p><input type="text" name="id" value="{{ $permission->id }}" readonly></p>
        <p><input type="text" name="name" value="{{ $permission->name }}"></p>
        <p>Создан: {{ $permission->created_at }}</p>
        <p>Последнее редактирование: {{ $permission->updated_at }}</p>
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