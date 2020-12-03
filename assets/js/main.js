/**
 * Regisztrációs form validálás.
 *
 * @returns {boolean}
 */
function validateSignUpForm()
{
    var password = $('#password').val(),
        password2 = $('#password2').val();

    if (password !== password2) {
        alert('A két jelszó nem egyezik, kérem, javítsa!');
        return false;
    }

    return true;
}

/**
 * OOP Javascript AJAX megoldás a szervertől a dátum és az idő lekérdezésére.
 * Az AJAX-hívás valójában egy SOAP klienst hív meg, amely egy SOAP szervertől kérdezi le az adatokat.
 *
 * @type {Object}
 */
var footman = new Object({
    whatTimeIsIt: function () {
        $.get('/soap/client.php')
            .done(function(data) {
                $('#current-datetime').html(data);
            });
    }
});

// Megkérdezzük az inastól a pontos időt :-)
$(document).ready(function() {
    footman.whatTimeIsIt();
});
