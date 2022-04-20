@extends('admin.layouts.header')

@section('content')
<a href="{{route('admin')}}" class="btn btn-secondary btn-sm">На головну</a>
<a href="{{route('admin.students.index') }}" class="btn btn-secondary btn-sm">Список студентів</a>
<a href="{{route('admin.students.show', $item->id) }}" class="btn btn-secondary btn-sm">Профіль</a>
@include('layouts.error')

<form action="{{route('admin.students.update', $item->id)}}" method="POST">
@method('PATCH')
@csrf
    <div class="mb-3">
        <label for="studentName" class="form-label fs-3">Редагування профілю</label>
        <input type="text" 
            class="form-control" 
            id="studentName" 
            name="name" 
            aria-describedby="hintName" 
            value="{{$item->name}}">
        <div id="hintName" class="form-text">Введіть нове ім'я cтудента</div>
        <input type="email" 
            class="form-control" 
            id="studentEmail" 
            name="email" 
            aria-describedby="hintEmail" 
            value="{{$item->email}}">
        <div id="hintEmail" class="form-text">Введіть новий email студента</div>
        <select class="form-select" aria-describedby="hintGroup" name="group_id">
            @if(!isset($item->group[0]))
                <option selected>$item->group[0]->name</option>
            @endif
            @foreach($groups as $group)
                <option value="{{$group->id}}">{{$group->name}}</option>
            @endforeach
        </select>
        <div id="hintGroup" class="form-text">Виберіть нову групу</div>
    </div>
    <button type="submit" class="btn btn-warning">Оновити</button>
</form>

@endsection