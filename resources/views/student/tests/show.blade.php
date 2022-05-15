@extends('student.layouts.app')

@section('content')

<p  class="text-center fs-1">Тест: {{$item->title}}</p>
<hr>
@php
    $i = 1;
@endphp
<form action="{{route('student.tests.calculateScore')}}" method="POST">
@csrf
    <input type="hidden" value="{{$item->id}}" name="test_id">
    @foreach($item->questions as $question)
    <ul class="list-group mb-3">
        <li class="list-group-item list-group-item-primary">
            <p class="fs-5 mb-0">{{$i++ }}. {{$question->question}}</p> 
        </li>
    @foreach($question->answers as $answer)
        <li class="list-group-item">
            <input class="form-check-input" type="radio" name="answers[{{$i}}]" value="{{$answer->id}}" id="{{$answer->id}}">
            <label class="form-check-label" for="{{$answer->id}}">{{$answer->answer}}</label>
        </li>
        @endforeach
    </ul>
    @endforeach
    <button type="submit" class="btn btn-primary">Завершити тест</button>
</form>

@endsection