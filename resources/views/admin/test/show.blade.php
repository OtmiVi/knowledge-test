@extends('admin.layouts.app')

@section('content')
<a href="{{route('admin')}}" class="btn btn-secondary btn-sm">На головну</a>
<a href="{{route('admin.disciplines.index')}}" class="btn btn-secondary btn-sm">Список дисциплін</a>
@include('layouts.error')
@include('layouts.success')

<p  class="text-center fs-1">Тест: {{$item->title}}</p>
<p>{{$item->description}}</p>
<hr>
<a class="btn btn-outline-warning" href="{{route('admin.disciplines.edit', $item->id)}}">Оновити</a>
<form action="{{route('admin.disciplines.destroy', $item->id)}}" 
    method="post" 
    class="d-inline" 
    onSubmit="return confirm('Підтвердити видалення');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-outline-danger">
        Видалити
    </button>
</form>
<hr>
@php
    $i = 1;
@endphp
@foreach($item->questions as $question)
<ul class="list-group mb-3">
    <li class="list-group-item list-group-item-primary">
        <p class="fs-5 mb-0">{{$i++ }}. {{$question->question}}</p> 
    </li>
   
    @foreach($question->answers as $answer)
    
    @php 
        $class = "list-group-item d-flex justify-content-between";
        if($answer->right) $class .= " list-group-item-success"; 
    @endphp
    <li class="{{$class}}">
        <p>{{$answer->answer}}</p>
    </li>
    @endforeach
</ul>
@endforeach

@endsection