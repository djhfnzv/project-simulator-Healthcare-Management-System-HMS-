function enableInputs(enable = true) {
    document.querySelectorAll("#doctorForm input, #doctorForm select")
        .forEach(el => el.disabled = !enable);
}

function clearInputs() {
    document.querySelectorAll("#doctorForm input, #doctorForm select")
        .forEach(el => {
            if (el.type !== "hidden") el.value = "";
        });
}

function addDoctor() {
    clearInputs();
    enableInputs(true);

    document.getElementById("action").value = "add";
    document.getElementById("saveBtn").disabled = false;
}

function selectDoctor(name, age, dob, email, mobile, speciality) {
    document.getElementById("name").value = name;
    document.getElementById("age").value = age;
    document.getElementById("dob").value = dob;
    document.getElementById("email").value = email;
    document.getElementById("mobile").value = mobile;
    document.getElementById("speciality").value = speciality;

    document.getElementById("email_key").value = email;

    enableInputs(false);
}

function editDoctor() {
    if (!document.getElementById("email_key").value) {
        alert("Select a doctor first");
        return;
    }

    enableInputs(true);

    document.getElementById("email").disabled = true; // key stays locked
    document.getElementById("action").value = "update";
    document.getElementById("saveBtn").disabled = false;
}

function deleteDoctor() {
    if (!document.getElementById("email_key").value) {
        alert("Select a doctor first");
        return;
    }

    if (confirm("Are you sure?")) {
        document.getElementById("action").value = "delete";
        document.getElementById("doctorForm").submit();
    }
}
