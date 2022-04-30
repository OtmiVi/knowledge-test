window.addEventListener('load', () => {
    var num = 0;

    const question_id = document.querySelector('#question');
    question_id.value = num;

    const add_question = document.querySelector('#add_question');

    add_question.addEventListener('click', (e) =>{
		e.preventDefault();

        const list = document.querySelector('#list');
/*
        <div class="card mb-3">
            <div class="card-body">
                <p>Запитання</p>
                <div class="input-group mb-3" id="question">
                    <textarea 
                        id="questinName" 
                        name="question" 
                        class="form-control mb-3" 
                        placeholder="Введіть запитання"
                        rows="3"></textarea>
                    <button class="btn btn-outline-danger mb-3">Видалити</button>
                    відповідь
                    відповідь
                </div>
                <button class="btn btn-primary" id="add_answer">Додати відповідь</button>
            </div>
        </div>*/
        const card_div = document.createElement('div');
        card_div.className = "card mb-3";
        card_div.id = "question";
        list.appendChild(card_div);

        const card_body = document.createElement('div');
        card_body.className = "card-body";

        card_div.appendChild(card_body);

        const title = document.createElement('p');
        title.innerText = "Запитання";
        card_body.appendChild(title);

        const question_div = document.createElement('div');
        question_div.value = ++num
        question_div.className = "input-group mb-3";
        
        card_body.appendChild(question_div);

        const id = question_div.value;

        const question_textarea = document.createElement('textarea');
        question_textarea.id = "questionName";
        question_textarea.name = `questions[${id}][question]`;
        question_textarea.className = "form-control mb-3";
        question_textarea.placeholder = "Введіть запитання";
        question_textarea.rows = 3;

        question_div.appendChild(question_textarea);

        const question_del = document.createElement('button');
		question_del.className = "btn btn-outline-danger mb-3";
		question_del.innerText = "Видалити";

        question_div.appendChild(question_del);

        card_body.appendChild(question_div);
        question_div.appendChild(createAnswerNoDel(id, 0, true));
        question_div.appendChild(createAnswerNoDel(id, 1));

        question_del.addEventListener('click', (e) => {
			list.removeChild(card_div);
		});

        const add_btn = document.createElement('button');
        add_btn.className = "btn btn-primary";
        add_btn.id = "add_answer";
        add_btn.innerText = "Додати відповідь";
        add_btn.value = 2;
        card_body.appendChild(add_btn);

        add_btn.addEventListener('click', (e) =>{
            e.preventDefault();

            question_div.appendChild(createAnswer(question_div, id, add_btn.value));
            add_btn.value++;
            
        });

    });

    const add_answer = document.querySelector('#add_answer');

    add_answer.addEventListener('click', (e) =>{
		e.preventDefault();
        const question = document.querySelector('#question');
        const id = question.value;
        question.appendChild(createAnswer(question, id, add_answer.value));
        add_answer.value++;
        
    });

    function createAnswer(parrent, id, number){
        const answer_div = document.createElement('div');
        answer_div.className = "input-group mb-3";

        answer_div.appendChild(createRadio(id, number));

        const answer_input = document.createElement('input');
        answer_input.type = "text";
        answer_input.id = "answerName";
        answer_input.name = `questions[${id}][answers][]`;
        answer_input.className = "form-control";
        answer_input.placeholder = "Введіть відповідь";

        answer_div.appendChild(answer_input);

        const answer_del = document.createElement('button');
		answer_del.className = "btn btn-outline-danger";
		answer_del.innerText = "Видалити";

        answer_div.appendChild(answer_del);

        answer_del.addEventListener('click', (e) => {
			parrent.removeChild(answer_div);
		});

        return answer_div;
    }

    function createAnswerNoDel(id, number, is_active = false){
        const answer_div = document.createElement('div');
        answer_div.className = "input-group mb-3";

        answer_div.appendChild(createRadio(id, number, is_active));

        const answer_input = document.createElement('input');
        answer_input.type = "text";
        answer_input.id = "answerName";
        answer_input.name = `questions[${id}][answers][]`;
        answer_input.className = "form-control";
        answer_input.placeholder = "Введіть відповідь";

        answer_div.appendChild(answer_input);

        return answer_div;
    }

    function createRadio(id, number, is_active = false){
        /*
        <div class="input-group-text">
            <input 
                class="form-check-input mt-0" 
                type="radio" value="1" 
                name="questions[1][]">
        </div>
        */
        const radio_div = document.createElement('div');
        radio_div.className = "input-group-text";

        const radio = document.createElement('input');
        radio.className = "form-check-input";
        radio.type = "radio";
        radio.name = `questions[${id}][right]`;
        radio.value = number;
        radio.checked = is_active;

        radio_div.appendChild(radio);

        return radio_div;
    }

});