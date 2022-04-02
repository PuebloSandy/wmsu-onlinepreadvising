function password_show_admin() {
    var x = document.getElementById("passeditadmin");
    var show_eyed = document.getElementById("show_eyed");
    var hide_eyed = document.getElementById("hide_eyed");
    hide_eyed.classList.remove("d");
    if (x.type === "password") {
    x.type = "text";
    show_eyed.style.display = "none";
    hide_eyed.style.display = "block";
    } else {
    x.type = "password";
    show_eyed.style.display = "block";
    hide_eyed.style.display = "none";
    }
}

function password_show_adviser_add() {
    var x_adviser = document.getElementById("passeditadviser");
    var show_eyed_adviser = document.getElementById("show_eye_edit_adviser");
    var hide_eyed_adviser = document.getElementById("hide_eye_edit_adviser");
    hide_eyed_adviser.classList.remove("d_edit_adviser");
    if (x_adviser.type === "password") {
    x_adviser.type = "text";
    show_eyed_adviser.style.display = "none";
    hide_eyed_adviser.style.display = "block";
    } else {
    x_adviser.type = "password";
    show_eyed_adviser.style.display = "block";
    hide_eyed_adviser.style.display = "none";
    }
}

function password_show_edit_student() {
    var x = document.getElementById("passeditstudent");
    var show_eyed = document.getElementById("show_eye_edit_student");
    var hide_eyed = document.getElementById("hide_eye_edit_student");
    hide_eyed.classList.remove("d_edit_student");
    if (x.type === "password") {
    x.type = "text";
    show_eyed.style.display = "none";
    hide_eyed.style.display = "block";
    } else {
    x.type = "password";
    show_eyed.style.display = "block";
    hide_eyed.style.display = "none";
    }
}