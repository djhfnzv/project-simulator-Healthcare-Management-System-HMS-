function fetchRecords(patientId){
    var patient = patientId || (document.getElementById('searchPatient') ? document.getElementById('searchPatient').value : '');
    var xhr = new XMLHttpRequest();
    xhr.open('POST','patientMedicalRecords.php',true);
    xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xhr.onreadystatechange = function(){
        if (xhr.readyState==4 && xhr.status==200){
            try{
                var r = JSON.parse(xhr.responseText);
                if (r.success){
                    var html = '';
                    if (!r.records || r.records.length==0) html = '<p>No records</p>'; else{
                        html = '<table border="1" cellpadding="10" width="100%"><tr><th>Patient Name</th><th>Appointment Time</th><th>Diagnosis</th><th>Treatment</th><th>Medication</th><th>Prescription Date</th></tr>';
                        for(var i=0;i<r.records.length;i++){
                            var row = r.records[i];
                            html += '<tr>'+
                                '<td>'+ (row.patientName||'-') +'</td>'+
                                '<td>'+ (row.timeSlot||'-') +'</td>'+
                                '<td>'+ (row.diagnosis||'-') +'</td>'+
                                '<td>'+ (row.treatment||'-') +'</td>'+
                                '<td>'+ (row.medication||'-') +'</td>'+
                                '<td>'+ (row.created_at||'-') +'</td>'+
                            '</tr>';
                        }
                        html += '</table>';
                    }
                    var container = document.querySelector('.content');
                    if (container) container.innerHTML = html;
                } else alert(r.message||'Failed');
            }catch(e){ alert('Invalid response'); }
        }
    }
    xhr.send('action=fetchRecords&patientName='+encodeURIComponent(patient));
}

window.fetchRecords = fetchRecords;
