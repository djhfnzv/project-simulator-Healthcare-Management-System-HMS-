function enableInputs(enable = true) {
    document.querySelectorAll("#nurseForm input").forEach(el => {
        if (el.type !== "hidden") {
            el.disabled = !enable;
        }
    });
}

function clearInputs() {
    document.querySelectorAll("#patientForm input")
        .forEach(el => {
            if (el.type !== "hidden") el.value = "";
        });
}


function addpatient() {
    clearInputs();
    enableInputs(true);

    document.getElementById("action").value = "add";
    document.getElementById("saveBtn").disabled = false;
}

function selectpatient(name, age, dob, email, mobile) {
    document.getElementById("name").value = name;
    document.getElementById("age").value = age;
    document.getElementById("dob").value = dob;
    document.getElementById("email").value = email;
    document.getElementById("mobile").value = mobile;

    document.getElementById("password").value = "";
    document.getElementById("email_key").value = email;

    enableInputs(false); 
}

function editpatient() {
    if (!document.getElementById("email_key").value) {
        alert("Select a patient first");
        return;
    }

    enableInputs(true);

    document.getElementById("email").disabled = true;
    document.getElementById("action").value = "update";
    document.getElementById("saveBtn").disabled = false;
}

function deletepatient() {
    if (!document.getElementById("email_key").value) {
        alert("Select a patient first");
        return;
    }

    if (confirm("Are you sure?")) {
        document.getElementById("action").value = "delete";
        document.getElementById("patientForm").submit();
    }
}
