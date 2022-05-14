@extends('teacher.layouts.app')

@section('content')
<a href="{{route('teacher')}}" class="btn btn-secondary btn-sm">На головну</a>
@include('layouts.error')
@include('layouts.success')

<p  class="text-center fs-1">Дисципліна: {{$item->name}}</p>
<p>{{$item->description}}</p>
<hr>

<ul class="list-group mb-3">
    <li class="list-group-item list-group-item-success">
        <p class="fs-5 mb-0">Викладачі які викладають:</p> 
    </li>
    @forelse($item->users->sortBy('name') as $user)
    <li class="list-group-item d-flex justify-content-between">
        <p>{{$user->name}}</p>
    </li>
    @empty
    <li class="list-group-item list-group-item-secondary">
        Викладачів не вибрано
    </li>
    @endforelse
</ul>

<ul class="list-group mb-3">
    <li class="list-group-item list-group-item-success">
        <p class="fs-5 mb-0">Групи в яких викладається дисципліна:</p> 
    </li>
    @forelse($item->groups->sortBy('name') as $group)
    <li class="list-group-item">
        <a class="text-decoration-none" href="{{route('teacher', $group->id)}}">{{$group->name}}</a>
    </li>
    @empty
    <li class="list-group-item list-group-item-secondary">
        Групи не вибрано
    </li>
    @endforelse
</ul>


<ul class="list-group">
    <li class="list-group-item list-group-item-success d-flex justify-content-between">
        <p class="fs-5 mb-0">Тести:</p> 
        <a class="btn btn-outline-dark" href="{{route('teacher.tests.create', $item->id)}}"> додати тест</a>
    </li>
    @forelse($item->tests as $test)
    @if($test->visible)
    <li class="list-group-item d-flex justify-content-between">
    @else
    <li class="list-group-item d-flex list-group-item-secondary justify-content-between">
    @endif
        <a class="text-decoration-none" href="{{route('teacher.tests.show', $test->id)}}">{{$test->title}}</a>
        <div>
            <a href="{{route('teacher.tests.visible',$test->id)}}" class="btn btn-outline-info">V</a>
            <a href="{{route('teacher.tests.edit',$test->id)}}" class="btn btn-outline-warning">O</a>
            <form action="{{route('teacher.tests.destroy',$test->id)}}" 
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
    @empty
    <li class="list-group-item list-group-item-secondary">
        Тестів немає
    </li>
    @endforelse
</ul>
<hr>
<a class="btn btn-outline-warning" href="{{route('teacher', $item->id)}}">Оновити</a>

@endsection