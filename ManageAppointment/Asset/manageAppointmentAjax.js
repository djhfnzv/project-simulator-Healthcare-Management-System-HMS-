function loadDoctorsAjax() {

    let speciality = document.getElementById("speciality").value;

    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../Controller/AjaxManageDoctorController.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("speciality=" + speciality);

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            let doctors = JSON.parse(this.responseText);
            let doctorSelect = document.getElementById("doctor");

            doctorSelect.innerHTML =
                '<option value="">Select Doctor</option>';

            for (let i = 0; i < doctors.length; i++) {
                let opt = document.createElement("option");
                opt.value = doctors[i].doctorName;
                opt.innerHTML = doctors[i].doctorName;
                doctorSelect.appendChild(opt);
            }
        }
    }
}
