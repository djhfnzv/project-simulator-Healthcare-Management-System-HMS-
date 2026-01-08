function searchPatients(q){
    var qval = (typeof q === 'undefined' || q === null) ? (document.getElementById('q') ? document.getElementById('q').value : '') : q;
    var xhr = new XMLHttpRequest();
    xhr.open('POST','patientList.php',true);
    xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xhr.onreadystatechange = function(){
        if (xhr.readyState==4 && xhr.status==200){
            try{ var r = JSON.parse(xhr.responseText);
                if (r.success){
                    var html = '';
                    if (!r.patients || r.patients.length==0) html = '<p>No patients found.</p>';
                    else{
                        html = '<table id="schedule" border="1" cellpadding="10" width="100%"><tr><th>Patient Name</th></tr>';
                        for(var i=0;i<r.patients.length;i++) html += '<tr><td>'+r.patients[i]+'</td></tr>';
                        html += '</table>';
                    }
                    document.getElementById('patientResults').innerHTML = html;
                } else document.getElementById('patientResults').innerHTML = '<p>No patients found.</p>';
            }catch(e){
                console.error('Failed to parse JSON:', e, xhr.responseText);
                document.getElementById('patientResults').innerHTML = '<pre style="white-space:pre-wrap;">'+
                    (xhr.responseText || 'Invalid response') +
                    '</pre>';
            }
        }
    }
    xhr.send('q='+encodeURIComponent(qval) );
}

window.searchPatients = searchPatients;

document.addEventListener('DOMContentLoaded', function(){ if (typeof searchPatients === 'function') searchPatients(); });
