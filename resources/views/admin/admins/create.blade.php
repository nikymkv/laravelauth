@extends('layouts.app')
@section('content')
    <form action="{{ route('admin.admins.store') }}" method="POST">
        @csrf
        <p><input type="text" name="name" placeholder="Имя"></p>
        <p><input type="text" name="email" placeholder="Почта"></p>
        <p><input type="password" name="password" placeholder="Пароль"></p>
        <p><input type="password" name="password_confirmation" placeholder="Подтвреждение пароля"></p>
        <p>
            <select name="role">
                @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
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