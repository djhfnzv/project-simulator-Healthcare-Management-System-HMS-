function initList(role) {
    window.currentRole = role;
    window.formId = role.toLowerCase() + 'Form';
    window.tableClass = role.toLowerCase() + '-table';
    window.getEndpoint = '../Controller/getUsers.php?role=' + role;
    window.saveEndpoint = '../Controller/checkValidAll.php';
}

function enableInputs(enable = true) {
    document.querySelectorAll("#" + window.formId + " input").forEach(el => {
        if (el.type !== "hidden") el.disabled = !enable;
    });
}

function clearInputs() {
    document.querySelectorAll("#" + window.formId + " input").forEach(el => {
        if (el.type !== "hidden") el.value = "";
    });
}

function addItem() {
    clearInputs();
    enableInputs(true);
    document.getElementById("action").value = "add";
    document.getElementById("saveBtn").disabled = false;
}

function selectItem(name, age, dob, email, mobile) {
    document.getElementById("name").value = name;
    document.getElementById("age").value = age;
    document.getElementById("dob").value = dob;
    document.getElementById("email").value = email;
    document.getElementById("mobile").value = mobile;
    document.getElementById("email_key").value = email;
    enableInputs(false);
}

function editItem() {
    if (!document.getElementById("email_key").value) {
        alert("Select an item first");
        return;
    }
    enableInputs(true);
    document.getElementById("email").disabled = true;
    document.getElementById("action").value = "update";
    document.getElementById("saveBtn").disabled = false;
}

function deleteItem() {
    if (!document.getElementById("email_key").value) {
        alert("Select an item first");
        return;
    }
    if (confirm("Are you sure?")) {
        let formData = new FormData();
        formData.append('action', 'delete');
        formData.append('role', window.currentRole);
        formData.append('email_key', document.getElementById("email_key").value);
        ajaxSend(formData, 'delete');
    }
}

function saveItem() {
    console.log('saveItem called, currentRole:', window.currentRole, 'formId:', window.formId);
    let formData = new FormData(document.getElementById(window.formId));
    formData.append('role', window.currentRole);
    ajaxSend(formData, 'save');
}

function ajaxSend(formData, type) {
    console.log('ajaxSend called with type:', type);
    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', window.saveEndpoint, true);
    xhttp.send(formData);
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let response = JSON.parse(this.responseText);
            if (response.success) {
                document.getElementById('successMessage').innerHTML = response.message;
                refreshList();
                clearInputs();
                if (type === 'save') {
                    enableInputs(false);
                    document.getElementById("saveBtn").disabled = true;
                }
            } else {
                document.querySelectorAll('.error').forEach(el => el.innerHTML = '');
                if (response.errors) {
                    if (response.errors.name) document.getElementById('nameError').innerHTML = response.errors.name;
                    if (response.errors.age) document.getElementById('ageError').innerHTML = response.errors.age;
                    if (response.errors.dob) document.getElementById('dobError').innerHTML = response.errors.dob;
                    if (response.errors.email) document.getElementById('emailError').innerHTML = response.errors.email;
                    if (response.errors.password) document.getElementById('passwordError').innerHTML = response.errors.password;
                    if (response.errors.mobile) document.getElementById('mobileError').innerHTML = response.errors.mobile;
                } else {
                    alert(response.error);
                }
            }
        }
    };
}

function refreshList() {
    let xhttp = new XMLHttpRequest();
    xhttp.open('GET', window.getEndpoint, true);
    xhttp.send();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let items = JSON.parse(this.responseText);
            let tbody = document.querySelector('.' + window.tableClass + ' tbody');
            tbody.innerHTML = '';
            items.forEach(function(item) {
                let row = "<tr>" +
                    "<td>" + item.name + "</td>" +
                    "<td>" + item.age + "</td>" +
                    "<td>" + item.dob + "</td>" +
                    "<td>" + item.email + "</td>" +
                    "<td>" + item.password + "</td>" +
                    "<td>" + item.mobile + "</td>" +
                    "<td><button onclick='selectItem(\"" + item.name + "\", \"" + item.age + "\", \"" + item.dob + "\", \"" + item.email + "\", \"" + item.mobile + "\")'>Select</button></td>" +
                    "</tr>";
                tbody.innerHTML += row;
            });
        }
    };
}