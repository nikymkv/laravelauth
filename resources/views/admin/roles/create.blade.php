@extends('layouts.app')
@section('content')
    <form action="{{ route('admin.roles.store') }}" method="POST">
        @csrf
        <p><input type="text" name="name" placeholder="Название"></p>
        <p>permissions:
            @foreach ($permissions as $perm)
                <br><input type="checkbox" name="permissions[]" value="{{ $perm->id }}">{{ $perm->name }}
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