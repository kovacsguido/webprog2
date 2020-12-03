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
