@extends('teacher.layouts.app')

@section('content')
<a href="{{route('teacher')}}" class="btn btn-secondary btn-sm">На головну</a>
<a href="{{route('teacher.disciplines.show', $item->discipline_id)}}" class="btn btn-secondary btn-sm">До дисципліни</a>

<p  class="text-center fs-1">Тест: {{$item->title}}</p>
<hr>
@if($scores->count())
<table class="table table-striped table-hover" >
    <thead >
        <tr class="table-dark">
            <th>Студент</th>
            <th>Група</th>
            <th>Час здачі</th>
            <th>Бал</th>
        </tr>
    </thead>
    <tbody>
    @foreach($scores as $score)
        <tr>
            <td>{{$score->user->name}}</td>
            <td>{{$score->user->group[0]->name}}</td>
            <td>{{$score->created_at}}</td>
            <td>{{$score->score}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@else
<div class="alert alert-dark" role="alert">
    Ніхто не пройшов тест
</div>
@endif
@endsection