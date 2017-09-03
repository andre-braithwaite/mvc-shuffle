var submit_button = $('#testAjax');

submit_button.click(function() {

    //window.alert("did you click?");

    var resultArea = document.getElementById("result");

    var answerWord = document.getElementById("answerWord").value;
    var seconds = document.getElementById("seconds").value;

    $.ajax({

        type:'GET',
        url: 'process-card',
        data: {answerWord: answerWord, seconds: seconds},

        success: function(response) {
            resultArea.value = response;

        }
    });
});