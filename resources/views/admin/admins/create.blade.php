@extends('layouts.app')
@section('content')
    <form action="{{ route('admin.admins.store') }}" method="POST" enctype="multipart/form-data">
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
    <p><input type="file" name="images[]" id="upload_photo" placeholder="Фото профиля"></p>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <script>
        let fileInput = document.getElementById('upload_photo')
        console.log(fileInput)
        fileInput.onchange = function () {
            let formData = new FormData()
            for(let i = 0; i < fileInput.files.length; i++) {
                formData.append('images[]', fileInput.files[i])
            }
            axios.post('http://laravelauth/admin/storage/profile/photo', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then(function (data) {
                console.log('success', data)
            })
            .catch(function (data) {
                console.log('success', data)
            })
        }
    </script>
@endsection
