function cancelAppointmentAjax(id) {

    alert("Are you sure you want to cancel this appointment?");

    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../Controller/AjaxCancelRescheduleController.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("action=cancel&appointment_id=" + id);

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

function rescheduleAppointmentAjax(id, day, time) {

    if (day === "" || time === "") {
        alert("Please select day and time.");
        return;
    }

    alert("Are you sure you want to reschedule this appointment?");

    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../Controller/AjaxCancelRescheduleController.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(
        "action=reschedule&appointment_id=" + id +
        "&day=" + day + "&timeSlot=" + time
    );

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
