$(document).ready(function () {
    $("#submit").click(
        function () {
                x = document.getElementById('value_x'),
                y = document.getElementById('value_y'),
                r = document.getElementById('value_r')
            console.log("Хуйня")
            console.log("Началось");
            sendAjaxForm('handler_form.php');
            console.log("Закончилось");
            return false;
        }
    );
});

let
    x = document.getElementById('value_x'),
    y = document.getElementById('value_y'),
    r = document.getElementById('value_r')

function sendAjaxForm(url) {

    console.log(x.value)
    console.log(y.value)
    console.log(r.value)

    if (checkY()) {
        $.ajax({
            url: url,
            type: "GET",
            dataType: "html",
            data: {
                x: x.value.trim().replace(",", "."),
                y: y.value.trim().replace(",", "."),
                r: r.value.trim().replace(",", ".")
            },
            success: function (response) {
                console.log("Хуйня 1");
                console.log(response.innerHTML);
                $('#result').html(response);
            },
            error: function (response) {
                console.log("Хуйня")
                alert("Нихуя не работает, ты лох, иди исправляй")
            }
        });
    }
}

document.addEventListener('DOMContentLoaded', function(){
    document.getElementById('clear').addEventListener('click', clear);
});

const clear = function(e) {
    $.ajax({
        url: 'clear_form.php',
        type: "GET",
        dataType: "html",
        data: {
            x: x.value.trim().replace(",", "."),
            y: y.value.trim().replace(",", "."),
            r: r.value.trim().replace(",", ".")
        },
        success: function (response) {
            console.log("Хуйня 1");
            console.log(response.innerHTML);
            $('#result').html(response);
        },
        error: function (response) {
            console.log("Хуйня")
            alert("Нихуя не работает, ты лох, иди исправляй")
        }
    });
}




function checkY() {
    console.log(y);
    console.log("Началась проверка");
    if (y === null || y === undefined) {
        return false;
    } else {
        let y_func = y.value.trim().replace(",", ".");
        if (y_func === "") {
            alert("Заполните поле Y")
            y.style.background = '#e51212'
            return false;
        } else if (y_func === "-0" || !isFinite(y_func)) {
            alert("Y должно быть числом")
            y.style.background = '#e51212'
            return false;
        } else if (y_func >= 3 || y_func <= -5) {
            alert("Y должно быть в диапазоне: (-5 ... 3)")
            y.style.background = '#e51212'
            return false;
        } else
            console.log("Работает")
        y.style.background = '#6092ba'
        return true;
    }
    return false;
}
