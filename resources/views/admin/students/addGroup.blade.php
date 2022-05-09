@extends('admin.layouts.app')

@section('content')
<a href="{{route('admin')}}" class="btn btn-secondary btn-sm">На головну</a>
<a href="{{route('admin.students.index') }}" class="btn btn-secondary btn-sm">Список студентів</a>
<a href="{{route('admin.students.show', $item->id)}}" class="btn btn-secondary btn-sm">Профіль</a>
@include('layouts.error')

@if($groups->count())
<form action="{{route('admin.students.store')}}" method="POST">
@csrf
    <input type="hidden" name="user_id" value="{{$item->id}}">
    <div id="hintGroup" class="form-text">Виберіть нову групу</div>
    <div class="mb-3">
        <label for="studentName" class="form-label fs-3">Вибір групи для студента</label>
        <p  class="text-center fs-1">Студент: {{$item->name}}</p>
        <select class="form-select" aria-describedby="hintGroup" name="group_id">
            @foreach($groups as $group)
                <option value="{{$group->id}}">{{$group->name}}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-success">Додати до групи</button>
</form>
@else
<p class="text-center fs-1">Груп немає
    <a class="btn btn-outline-success" href="{{route('admin.groups.create')}}">Нова група</a>
</p>
@endif
@endsection