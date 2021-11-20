function initializeGame() {
    $('.playNowButton').hide(100)
    $('.playground').show(100)
    $.ajax({
        url: "initialize_game",
        method: 'get',
        success: function (response) {
            $('#game_id').val(response.game_id)
            $('#move_number').val(1)
            $('#guess_value').focus()

        }
    });

}

function guess() {
    $('#guessForm').validate({
        submitHandler: function (form) {
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                beforeSend: () => {
                    $('#guessButton').prop('disabled', true)
                    $('#guess_value').val('')
                },
                success: function (response) {
                    let lastGuess = response.latest_guess;
                    let guessHistoryHTML = response.guess_history;
                    $('#guessButton').prop('disabled', false)
                    if (lastGuess.computer_answer == "Bingo") {
                        $('#guessMessage').text("Your guess " + lastGuess.guess_value + " is Right.");
                        $('.playground').hide(100)
                        $('.won').show()
                    } else {
                        $('#guessMessage').text("Your guess " + lastGuess.guess_value + " is " + lastGuess.computer_answer);
                        let move_number = parseInt($('#move_number').val());
                        $('#move_number').val(++move_number)
                    }
                    $('#guessHistory').html(guessHistoryHTML)
                    $('#guess_value').focus()

                },

            });
        },
        rules: {
            guess_value: "required",
        },
        messages: {
            guess_value: "Please enter a number",

        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    })
}

$(document).ready(function () {

    $('.playNowButton').on('click', () => initializeGame())
    $('.playAgain').on('click', () => {
        $('.won').hide(100)
        $('#guessHistory').html('')
        $('#guessMessage').html('')
        initializeGame()
    })
    guess()

})

