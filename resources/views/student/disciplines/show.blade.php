@extends('student.layouts.app')

@section('content')
<a href="{{route('student')}}" class="btn btn-secondary btn-sm">На головну</a>
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
        <p>{{$user->email}}</p>
    </li>
    @empty
    <li class="list-group-item list-group-item-secondary">
        Викладачів не вибрано
    </li>
    @endforelse
</ul>

<ul class="list-group">
    <li class="list-group-item list-group-item-success">
        <p class="fs-5 mb-0">Тести:</p> 
    </li>
    @forelse($item->tests->where('visible', 1) as $test)
        @if(isset($score[$test->id]))
            <li class="list-group-item d-flex justify-content-between">
                <p class="mb-0">{{$test->title}}</p>
                <span class="badge bg-success rounded-pill">{{$score[$test->id]}}</span>
            </li>
        @else
            <li class="list-group-item">
                <a class="text-decoration-none" href="{{route('student.tests.open', $test->id)}}">{{$test->title}}</a>
            </li>
        @endif
    @empty
    <li class="list-group-item list-group-item-secondary">
        Тестів немає
    </li>
    @endforelse
</ul>
@endsection