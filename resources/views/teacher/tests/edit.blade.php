@extends('teacher.layouts.app')

@section('content')
<a href="{{route('teacher')}}" class="btn btn-secondary btn-sm">На головну</a>
<a href="" class="btn btn-secondary btn-sm">Назад</a>

@include('layouts.success')
@include('layouts.error')

<form action="{{route('teacher.tests.updateTest', $item->id)}}" method="POST">
@csrf
    <input type="text" hidden name="discipline_id" value="{{$item->discipline_id}}">
    <div class="mb-3">
        <label for="testName" class="form-label fs-3">Оновити тест</label>
        <input type="text" 
            required
            class="form-control" 
            id="testName" 
            name="title" 
            aria-describedby="hint"
            value="{{$item->title}}">
        <div id="hint" class="form-text">Введіть назву тесту</div>
        <textarea
            required
            class="form-control" 
            id="testDescription" 
            name="description" 
            aria-describedby="hintDescription"
            rows="3">{{$item->description}}</textarea>
        <div id="hintDescription" class="form-text">Введіть опис тесту</div>
    </div>
    <button class="btn btn-warning" type="submit" >Оновити</button>
    <hr>
    @php
        $questions = $item->questions;
        $i = 0;
    @endphp
    <div id="list">
        <form></form>
        @for($i; $i < count($questions); $i++)
        <div class="card mb-3 alert alert-secondary">
            <div class="card-body">
                <p>Запитання №{{$i+1}}</p>
                <div class="input-group mb-3" id="question" data-value="{{$i}}">
                    <textarea 
                        required
                        id="questionName" 
                        name="questions[{{$i}}][question]" 
                        class="form-control mb-3" 
                        placeholder="Введіть запитання"
                        rows="3">{{$questions[$i]->question}}</textarea>
                    @if(count($questions) > 1)
                    <a href=""></a>
                        <form action="{{route('teacher.tests.destroyQuestion',$questions[$i]->id)}}" 
                            method="post" 
                            class=""
                            onSubmit="return confirm('Підтвердити видалення');">
                            @csrf
                            <button 
                                type="submit" 
                                class=" btn btn-outline-danger"
                                formaction="{{route('teacher.tests.destroyQuestion',$questions[$i]->id)}}">
                                видалити
                            </button>
                        </form> 
                    @endif

                    @for($j = 0; $j < count($questions[$i]->answers); $j++)
                    <div class="input-group mb-3">
                        <div class="input-group-text">
                            <input 
                                class="form-check-input" 
                                type="radio" 
                                value="{{$j}}" 
                                @if($questions[$i]->answers[$j]->right)
                                checked
                                @endif
                                name="questions[{{$i}}][right]">
                        </div>
                        <input 
                            required
                            type="text"
                            id="answerName" 
                            name="questions[{{$i}}][answers][]" 
                            class="form-control" 
                            placeholder="Введіть відповідь"
                            value="{{$questions[$i]->answers[$j]->answer}}">
                        @if(count($questions[$i]->answers) > 2)
                            <form action="{{route('teacher.tests.destroyAnswer',$questions[$i]->answers[$j]->id)}}" 
                                method="post" 
                                class="d-inline"
                                onSubmit="return confirm('Підтвердити видалення');">
                                @csrf
                                <button 
                                    type="submit" 
                                    class="btn btn-outline-danger"
                                    formaction="{{route('teacher.tests.destroyAnswer',$questions[$i]->answers[$j]->id)}}">
                                    видалити
                                </button>
                            </form> 
                        @endif
                    </div>
                    @endfor
                </div>
                <button class="btn btn-primary" id="add_answer" value="{{$j}}">Додати відповідь</button>
            </div>
        </div>
        @endfor
    </div>
    <button class="btn btn-primary" id="add_question" value="{{$i}}">Додати завдання</button>
    <hr>
</form>

<script src="{{ asset('js/newQuestion.js')}}"></script>

@endsection