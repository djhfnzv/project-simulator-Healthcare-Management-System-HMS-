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
    document.getElementById("email").disabled = true;
    document.getElementById("action").value = "update";
    document.getElementById("saveBtn").disabled = false;
}

function deleteDoctor() {
    if (!document.getElementById("email_key").value) {
        alert("Select a doctor first");
        return;
    }
    if (confirm("Are you sure you want to delete this doctor?")) {
        let formData = new FormData();
        formData.append('action', 'delete');
        formData.append('email_key', document.getElementById("email_key").value);
        
        let xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../Controller/checkValidDoctor.php', true);
        xhttp.send(formData);
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let response = JSON.parse(this.responseText);
                if (response.success) {
                    document.getElementById('successMessage').innerHTML = response.message;
                    refreshDoctorList(); // Refresh table
                    clearInputs();
                } else {
                    alert(response.error);
                }
            }
        };
    }
}

function saveDoctor() {
    let formData = new FormData(document.getElementById('doctorForm'));
    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', '../Controller/checkValidDoctor.php', true);
    xhttp.send(formData);
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let response = JSON.parse(this.responseText);
            if (response.success) {
                document.getElementById('successMessage').innerHTML = response.message;
                refreshDoctorList(); // Refresh table
                clearInputs();
                enableInputs(false);
                document.getElementById("saveBtn").disabled = true;
            } else {
                // Clear previous errors
                document.querySelectorAll('.error').forEach(el => el.innerHTML = '');
                // Display errors
                if (response.errors.name) document.getElementById('nameError').innerHTML = response.errors.name;
                if (response.errors.age) document.getElementById('ageError').innerHTML = response.errors.age;
                if (response.errors.dob) document.getElementById('dobError').innerHTML = response.errors.dob;
                if (response.errors.email) document.getElementById('emailError').innerHTML = response.errors.email;
                if (response.errors.password) document.getElementById('passwordError').innerHTML = response.errors.password;
                if (response.errors.mobile) document.getElementById('mobileError').innerHTML = response.errors.mobile;
                if (response.errors.speciality) document.getElementById('specialityError').innerHTML = response.errors.speciality;
            }
        }
    };
}

function refreshDoctorList() {
    let xhttp = new XMLHttpRequest();
    xhttp.open('GET', '../Controller/getDoctors.php', true);
    xhttp.send();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let doctors = JSON.parse(this.responseText);
            let tbody = document.querySelector('.doctor-table tbody');
            tbody.innerHTML = '';
            doctors.forEach(function(doc) {
                let row = "<tr>" +
                    "<td>" + doc.name + "</td>" +
                    "<td>" + doc.age + "</td>" +
                    "<td>" + doc.dob + "</td>" +
                    "<td>" + doc.email + "</td>" +
                    "<td>" + doc.password + "</td>" +
                    "<td>" + doc.mobile + "</td>" +
                    "<td>" + doc.speciality + "</td>" +
                    "<td><button onclick='selectDoctor(\"" + doc.name + "\", \"" + doc.age + "\", \"" + doc.dob + "\", \"" + doc.email + "\", \"" + doc.mobile + "\", \"" + doc.speciality + "\")'>Select</button></td>" +
                    "</tr>";
                tbody.innerHTML += row;
            });
        }
    };
}
