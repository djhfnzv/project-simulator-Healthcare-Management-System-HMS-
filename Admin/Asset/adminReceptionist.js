function enableInputs(enable = true) {
    document.querySelectorAll("#receptionistForm input")
        .forEach(el => el.disabled = !enable);
}

function clearInputs() {
    document.querySelectorAll("#receptionistForm input")
        .forEach(el => {
            if (el.type !== "hidden") el.value = "";
        });
}


function addreceptionist() {
    clearInputs();
    enableInputs(true);

    document.getElementById("action").value = "add";
    document.getElementById("saveBtn").disabled = false;
}

function selectreceptionist(name, age, dob, email, mobile, speciality) {
    document.getElementById("name").value = name;
    document.getElementById("age").value = age;
    document.getElementById("dob").value = dob;
    document.getElementById("email").value = email;
    document.getElementById("mobile").value = mobile;
    document.getElementById("speciality").value = speciality;

    document.getElementById("email_key").value = email;

    enableInputs(false); 
}

function editreceptionist() {
    if (!document.getElementById("email_key").value) {
        alert("Select a receptionist first");
        return;
    }

    enableInputs(true);

    document.getElementById("email").disabled = true;
    document.getElementById("action").value = "update";
    document.getElementById("saveBtn").disabled = false;
}

function deletereceptionist() {
    if (!document.getElementById("email_key").value) {
        alert("Select a receptionist first");
        return;
    }

    if (confirm("Are you sure?")) {
        document.getElementById("action").value = "delete";
        document.getElementById("receptionistForm").submit();
    }
}
