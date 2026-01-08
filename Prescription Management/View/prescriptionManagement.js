function savePrescription(){
    var form = document.getElementById('prescriptionForm');
    var fd = new FormData(form);
    fd.append('action','savePrescription');

    var xhr = new XMLHttpRequest();
    xhr.open('POST','prescriptionManagement.php',true);
    xhr.onreadystatechange = function(){
        if (xhr.readyState==4 && xhr.status==200){
            try{
                var r = JSON.parse(xhr.responseText);
                if (r.success){ alert('Saved'); location.reload(); } else alert(r.message||'Failed');
            }catch(e){
                alert('Invalid response: '+xhr.responseText);
            }
        }
    }
    xhr.send(fd);
}

window.savePrescription = savePrescription;
