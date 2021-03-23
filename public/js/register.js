function validate() {

    let name = document.registerForm.name;
    let email = document.registerForm.email;
    let password = document.registerForm.password;
    let passwordConfirm = document.registerForm.password_confirmation;
    let role = document.registerForm.role;
    let username = document.registerForm.username;
    let lastName = document.registerForm.last_name;

    if (name.value === "") {
        name.focus();
        alert("Please provide your name!");
        return false;
    } else if (lastName.value === "") {
        lastName.focus();
        alert("Please provide your Last Name!");
        return false;
    } else if (username.value === "") {
        username.focus();
        alert("Please provide your Username!");
        return false;
    } else if (email.value === "") {
        email.focus();
        alert("Please provide your Email!");
        return false;
    } else if (email.value !== "" && !validateEmail(email.value)) {
        email.focus();
        alert('The email must be a valid email address.');
        return false;
    } else if (role.value === "") {
        role.focus();
        alert("Please select your Role!");
        return false;
    } else if (password.value === "") {
        password.focus();
        alert('Password is required');
        return false;
    } else if (password.value.length < 8) {
        password.focus();
        alert('password must be at least 8 characters');
        return false;
    } else if (password.value !== passwordConfirm.value) {
        password.focus();
        passwordConfirm.focus();
        alert('The two passwords do not match');
        return false;
    }

    return (true);
}


function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

