@extends('admin.layouts.header')

@section('content')
<a href="{{route('admin')}}" class="btn btn-secondary btn-sm">На головну</a>
<a href="" class="btn btn-secondary btn-sm">Назад</a>

@include('layouts.error')
<form action="{{route('admin.tests.store')}}" method="POST">
@csrf
    <input type="hidden" name="discipline_id" value="{{$discipline}}">
    <div class="mb-3">
        <label for="testName" class="form-label fs-3">Новий тест</label>
        <input type="text" 
            class="form-control" 
            id="testName" 
            name="title" 
            aria-describedby="hint"
            value="{{old('title')}}">
        <div id="hint" class="form-text">Введіть назву тесту</div>
        <textarea
            class="form-control" 
            id="testDescription" 
            name="description" 
            aria-describedby="hintDescription"
            rows="3">{{old('description')}}</textarea>
        <div id="hintDescription" class="form-text">Введіть опис тесту</div>
    </div>
    <hr>
    <div id="list">
        <div class="card mb-3">
            <div class="card-body">
                <p>Запитання</p>
                <div class="input-group mb-3" id="question" data-value="0">
                    <textarea 
                        id="questionName" 
                        name="questions[0][question]" 
                        class="form-control mb-3" 
                        placeholder="Введіть запитання"
                        rows="3"></textarea>
                    <div class="input-group mb-3">
                        <div class="input-group-text">
                            <input 
                                class="form-check-input" 
                                type="radio" 
                                value="0" 
                                checked
                                name="questions[0][right]">
                        </div>
                        <input 
                            type="text"
                            id="answerName" 
                            name="questions[0][answers][]" 
                            class="form-control" 
                            placeholder="Введіть відповідь">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-text">
                            <input 
                                class="form-check-input" 
                                type="radio" 
                                value="1" 
                                name="questions[0][right]">
                        </div>
                        <input 
                            type="text"
                            id="answerName" 
                            name="questions[0][answers][]" 
                            class="form-control" 
                            placeholder="Введіть відповідь">
                    
                    </div>
                </div>
                <button class="btn btn-primary" id="add_answer" value="2">Додати відповідь</button>
            </div>
        </div>
        
    </div>
    <button class="btn btn-primary" id="add_question" value="1">Додати завдання</button>
    <hr>
    <button type="submit" class="btn btn-success">Створити тест</button>
</form>

<script src="{{ asset('js/newquestion.js')}}"></script>

@endsection