$(document).on('click', '.clickable-row', function (event) {
    getToDetails(event);
})

$(document).on('click', '#question', function () {
    window.location.href = 'add-question.php';
})

getRoleByUserId();


function getToDetails(event){
    var questionId = event.target.parentElement.getAttribute('data-id');
    console.log(questionId);
    var url = './assets/ajax-services/get-questions.php';
    var data = {
        'questionId' : questionId
    }

    $.post(url, data, function (result) {
        localStorage.setItem('questionDetails', result);
        window.location.href = 'questions-with-answer.php';
    })
}

function getRoleByUserId(){
    var username = document.getElementById('navbarDropdownMenuLink').getAttribute('data-user');
    var url = './assets/ajax-services/get-roles-by-username.php';
    var data = {
        'username' : username
    }

    $.post(url, data, function (result) {
        if(result.toString().toUpperCase().startsWith('PRO')){
            $('#question').disable();
        }
    })
}