function updateStatus(appointmentId, status) {
    var xhttp = new XMLHttpRequest();
    
    xhttp.open('POST', 'appointment.php', true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send('action=update_status&appointmentId=' + encodeURIComponent(appointmentId) + '&status=' + encodeURIComponent(status));
    xhttp.onreadystatechange = function (){
        if (this.readyState == 4 && this.status == 200) {
            try {
                var res = JSON.parse(this.responseText);
                if (res.success) {
                    var rows = document.querySelectorAll('tr[data-appointment]');
                    for (var i=0;i<rows.length;i++){
                        if (rows[i].getAttribute('data-appointment') == appointmentId) {
                            var sc = rows[i].querySelector('.status-cell');
                            if (sc) sc.innerHTML = res.status;
                            break;
                        }
                    }
                } else {
                    alert(res.message || 'Update failed');
                }
            } catch (e) { alert('Invalid response from server'); }
        }
    }
}

window.updateStatus = updateStatus;
