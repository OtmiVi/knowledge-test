@extends('admin.layouts.header')

@section('content')
<a href="{{route('admin')}}" class="btn btn-secondary btn-sm">На головну</a>
<a href="{{route('admin.disciplines.index')}}" class="btn btn-secondary btn-sm">Список дисциплін</a>
@include('layouts.error')
@include('layouts.success')

<p  class="text-center fs-1">Дисципліна: {{$item->name}}</p>
<p>{{$item->description}}</p>



<ul class="list-group mb-3">
    <li class="list-group-item list-group-item-success">
        <p class="fs-5 mb-0">Викладачі які викладають:</p> 
    </li>
    @foreach($item->users->sortBy('name') as $user)
    <li class="list-group-item d-flex justify-content-between">
        <a href="{{route('admin.teachers.show', $user->id)}}">{{$user->name}}</a>
        <form action="{{route('admin.teachers.destroy_discipline',[$user->id, $item->id])}}" 
            method="post" 
            class="d-inline"
            onSubmit="return confirm('Підтвердити видалення');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger">
                X
            </button>
        </form>
        
    </li>
    @endforeach
</ul>

<ul class="list-group mb-3">
    <li class="list-group-item list-group-item-success d-flex justify-content-between">
        <p class="fs-5 mb-0">Групи в яких викладається дисципліна:</p> 
        <a class="btn btn-outline-dark" href="{{route('admin.disciplinesgroups.show', $item->id)}}"> редагувати групи</a>
    </li>
    @foreach($item->groups->sortBy('name') as $group)
    <li class="list-group-item d-flex justify-content-between">
        <a href="{{route('admin.groups.show', $group->id)}}">{{$group->name}}</a>
        <form action="{{route('admin.disciplinesgroups.destroy',[$item->id, $group->id])}}" 
            method="post" 
            class="d-inline"
            onSubmit="return confirm('Підтвердити видалення');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger">
                X
            </button>
        </form>
        
    </li>
    @endforeach
</ul>


<ul class="list-group">
    <li class="list-group-item list-group-item-success d-flex justify-content-between">
        <p class="fs-5 mb-0">Тести:</p> 
        <a class="btn btn-outline-dark" href="{{route('admin.disciplinesgroups.show', $item->id)}}"> додати тест</a>
    </li>
    @foreach($item->tests as $test)
    <li class="list-group-item d-flex justify-content-between">
        <a href="{{route('admin.groups.show', $group->id)}}">{{$test->title}}</a>
        
        <div>
            <a href="" class="btn btn-outline-warning">O</a>
            <form action="{{route('admin.disciplinesgroups.destroy',[$item->id, $group->id])}}" 
                method="post" 
                class="d-inline"
                onSubmit="return confirm('Підтвердити видалення');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">
                    X
                </button>
            </form>
        </div>
        
        
    </li>
    @endforeach
</ul>


@endsection