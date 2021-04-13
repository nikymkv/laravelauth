@extends('layouts.app')
@section('content')
    <form action="{{ route('admin.admins.update', ['admin' => $admin]) }}" method="POST">
        @csrf
        @method('PUT')
        <p><input type="text" name="id" id="admin_id" value="{{ $admin->id }}" readonly></p>
        <p><input type="text" name="name" value="{{ $admin->name }}"></p>
        <p><input type="text" name="email" value="{{ $admin->email }}"></p>
        <p><input type="password" name="old_password" placeholder="Старый пароль"></p>
        <p><input type="password" name="password" placeholder="Новый пароль"></p>
        <p><input type="password" name="password_confirmation" placeholder="Подтверждение нового пароля"></p>
        <p>Создан: {{ $admin->created_at }}</p>
        <p>Последнее редактирование: {{ $admin->updated_at }}</p>
        <p>
            <select name="role">
                @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ $admin->roles->first()->name === $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                @endforeach
            </select>
        </p>
        <p><input type="submit" value="Сохранить"></p>
    </form>
    <p><input type="file" name="images[]" id="upload_photo" placeholder="Фото профиля" multiple></p>
    @if (isset($admin->photos))
        @foreach ($admin->photos as $photo)
            <img src="{{ route('admin.admins.photo_profile', ['photo' => $photo]) }}" width="200" alt="" srcset="">
        @endforeach
    @endif

        @if (isset($admin->photos))
            @foreach ($admin->photos as $photo)
                <input type="checkbox" name="removePhotos[]" value="{{ $photo->id }}" id="remove_photo">Image
            @endforeach
            <button type="submit" id="remove_button">Удалить</button>
        @endif
        
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
    fileInput.onchange = function () {
        let formData = new FormData()
        for(let i = 0; i < fileInput.files.length; i++) {
            formData.append('images[]', fileInput.files[i])
        }
        let adminId = document.getElementById('admin_id').value
        formData.append('admin_id', adminId)
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

    let removeButton = document.getElementById('remove_button')
    console.log(removeButton)
    removeButton.onclick = function () {
        let formData = new FormData()
        let adminId = document.getElementById('admin_id').value
        let removeImages = document.getElementsByName('removePhotos[]')
        for(let i = 0; i < removeImages.length; i++) {
            if (removeImages[i].checked) {
                formData.append('removeImages[]', removeImages[i].value)
            }
        }
        formData.append('_method', 'DELETE')
        formData.append('admin_id', adminId)
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