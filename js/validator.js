function validate(val) {
    userName = document.getElementById("user_name");
    userEmail = document.getElementById("email");
    userPhone = document.getElementById("user_phone");
    jopTitle = document.getElementById("jop_title");
    aboutUser = document.getElementById("about_friend");

    flag1 = true;
    flag2 = true;
    flag3 = true;
    flag4 = true;
    flag5 = true;
    flag6 = true;

    if (val >= 1 || val == 0) {
        if (userName.value == "") {
            userName.style.borderColor = "red";
            flag1 = false;
        }
        else {
            userName.style.borderColor = "green";
            flag1 = true;
        }
    }
    if (val >= 3 || val == 0) {
        if (userEmail.value == "") {
            userEmail.style.borderColor = "red";
            flag3 = false;
        }
        else {
            userEmail.style.borderColor = "green";
            flag3 = true;
        }
    }
    if (val >= 4 || val == 0) {
        if (userPhone.value == "") {
            userPhone.style.borderColor = "red";
            flag4 = false;
        }
        else {
            userPhone.style.borderColor = "green";
            flag4 = true;
        }
    }
    if (val >= 5 || val == 0) {
        if (jopTitle.value == "") {
            jopTitle.style.borderColor = "red";
            flag5 = false;
        }
        else {
            jopTitle.style.borderColor = "green";
            flag5 = true;
        }
    }
    if (val >= 6 || val == 0) {
        if (aboutUser.value == "") {
            aboutUser.style.borderColor = "red";
            flag6 = false;
        }
        else {
            aboutUser.style.borderColor = "green";
            flag6 = true;
        }
    }

    flag = flag1 && flag2 && flag3 && flag4 && flag5 && flag6;

    return flag;
}