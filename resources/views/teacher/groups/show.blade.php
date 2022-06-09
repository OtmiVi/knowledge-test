@extends('teacher.layouts.app')

@section('content')
<a href="{{route('teacher')}}" class="btn btn-secondary btn-sm">На головну</a>
<a href="{{route('teacher.disciplines.show', $discipline->id)}}" class="btn btn-secondary btn-sm">До дисципліни</a>

<p  class="text-center fs-1">Група: {{$item->name}}</p>
<p  class="text-center fs-2">Дисципліна: {{$discipline->name}}</p>
<hr>
<table class="table table-striped table-hover" >
    <thead >
        <tr class="table-dark">
            <th>№</th>
            <th>Студент</th>
            <th>Email</th>
            <th>Середній бал</th>
        </tr>
    </thead>
    <tbody>
    @php
        $number = 1
    @endphp
    @foreach($item->users->sortBy('name') as $user)
        <tr>
            <td>{{$number ++}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>
                @if($user->scores->count())
                    @php
                        $i = 0;
                        $sum = 0;
                        foreach($user->scores as $score){
                            $i +=1;
                            $sum += $score->score;
                        }
                    @endphp
                 {{(int)($sum/$i)}}
                @else
                 Балів немає
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection