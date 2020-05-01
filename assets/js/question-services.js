var questionDetails = JSON.parse(localStorage.getItem('questionDetails'));
console.log(questionDetails);
var isSolved = (questionDetails.isSolved == 0) ? 'Not Solved' : 'Solved';
document.getElementById('head').innerHTML = questionDetails.title;
document.getElementById('title').innerHTML = questionDetails.title
    + '<button class="btn btn-primary" style="margin-left: 5px; margin-bottom: 3px;" id="title-button" disabled></button>';
document.getElementById('description').innerHTML = '<h5>Description : </h5>' + questionDetails.description;
document.getElementById('title-button').innerHTML = isSolved;

getAnswers();

$(document).on('click', '#ans-submit', function () {
    addAnswers();
})

$(document).on('click', '.select-buttons', function (event) {
    selectAsAnswer(event);
})

function addAnswers() {
    let text = document.getElementById('answer-text').value;
    let questionId = questionDetails.id;
    let userId = document.getElementById('get-session-id').innerText;
    let url = './assets/ajax-services/add-answer.php';
    let data = {
        'name' : text,
        'questionId' : questionId,
        'answeredBy' : userId
    }
    $.post(url, data, function (result) {
        console.log(result);
        alert('Answer Posted Successfully');
        getAnswers();
    })
}

function getAnswers() {
    $('#answers').empty();
    var questionId = questionDetails.id;
    var url = './assets/ajax-services/get-answers.php';
    var data = {
        'questionId' : questionId
    };
    var html = '';

    $.post(url, data, function (result) {
        var value = JSON.parse(result);
        console.log(value);
        html += '<br><h4>'+ value.length + ' Answers</h4><br>';

        value.forEach(function (item) {
            html += '<div class="card bg-secondary text-white">';
            html += '<div class="card-body"><p class="card-text" data-id="'+ item['id'] +'">'+ item['answer'] + '</p></div></div>';
            html += '<br>';
            if(questionDetails.isSolved == 0){
                html += '<button class="btn btn-gray select-buttons" id="'+ item['id'] +'">Select As Answer</button>';
            } else {
                if(item['isSelected'] == 1){
                    html += '<button class="btn btn-success" id="'+ item['id'] +'">Selected As Answer</button>';
                }
            }
            html += '<hr>';
        })
        $('#answers').append(html);
    })
}

function selectAsAnswer(event){
    var answerId = event.target.getAttribute('id');
    var url = './assets/ajax-services/select-answer.php';
    var questionUrl = './assets/ajax-services/solve-question.php';
    var data = {
        'answerId' : answerId
    };
    var quesData = {
        'questionId' : questionDetails.id
    }

    $.post(url, data, function (result) {
        console.log(result);
        $.post(questionUrl, quesData, function (result1) {
            console.log(result1);
        })
    })

}

