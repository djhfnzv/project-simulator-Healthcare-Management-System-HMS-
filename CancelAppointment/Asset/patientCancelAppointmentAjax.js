function cancelAppointmentAjax(id) {

    alert("Your appointment will be cancelled now.");

    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../Controller/AjaxCancelAppointmentController.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("appointment_id=" + id);

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            let res = JSON.parse(this.responseText);

            alert(res.message);

            if (res.status === "success") {
                location.reload();
            }
        }
    }
}
