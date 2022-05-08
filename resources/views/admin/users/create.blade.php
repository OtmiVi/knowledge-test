@extends('admin.layouts.app')

@section('content')
<a href="{{route('admin')}}" class="btn btn-secondary btn-sm">На головну</a>
<a href="{{route('admin.users.index')}}" class="btn btn-secondary btn-sm">Список користувачів</a>
@include('layouts.error')


<form action="{{route('admin.users.store')}}" method="POST">
@csrf
    <div class="mb-3">
        <label for="userName" class="form-label fs-3">Створити користувача</label>
        <div id="hint" class="form-text">Введіть ім'я користувача</div>
        <input type="text" 
            class="form-control" 
            id="userName" 
            name="name" 
            required
            aria-describedby="hint"
            value="{{old('name')}}">
        <div id="hintEmail" class="form-text">Введіть e-mail</div>
        <input type="email" 
            class="form-control" 
            id="userEmail" 
            name="email" 
            required
            aria-describedby="hintEmail"
            value="{{old('email')}}">
        <div id="userPassword1" class="form-text">Введіть новий пароль</div>
        <input type="password" 
            class="form-control" 
            id="userPassword1" 
            name="password" 
            required
            aria-describedby="userPassword">
        <div id="userPassword2" class="form-text">Повторіть пароль</div>
        <input type="password" 
            class="form-control" 
            id="userPassword2" 
            required
            aria-describedby="userPassword">
        <div id="userType" class="form-text">Виберіть тип користувача</div>
        <select name="userType" id="userType" class="form-select">
            <option value="" selected>Без типу</option>
            <option value="admin">Адмін</option>
            <option value="teacher">Викладач</option>
            <option value="student">Студент</option>
        </select>
       
    </div>
    <button type="submit" class="btn btn-primary" onclick="return validateForm()">Додати</button>
</form>

<script src="{{ asset('js/userValid.js')}}"></script>
@endsection