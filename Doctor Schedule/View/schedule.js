function addSchedule(){
    var form = document.getElementById('addScheduleForm');
    var fd = new FormData(form);
    fd.append('action', 'add');

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'schedule.php', true);
    xhr.onreadystatechange = function(){
        if (xhr.readyState==4 && xhr.status==200){
            try{
                console.log('Response:', xhr.responseText);
                var r = JSON.parse(xhr.responseText);
                if (r.success) location.reload(); else alert(r.message||'Failed');
            }catch(e){ alert('Invalid response: '+xhr.responseText); }
        }
    }
    xhr.send(fd);
}

function deleteSchedule(day, timeSlot){
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'schedule.php', true);
    xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xhr.onreadystatechange = function(){
        if (xhr.readyState==4 && xhr.status==200){
            try{ console.log('Response:', xhr.responseText); var r = JSON.parse(xhr.responseText); if (r.success) location.reload(); else alert(r.message||'Failed'); }catch(e){ alert('Invalid response: '+xhr.responseText); }
        }
    }
    xhr.send('action=delete&day='+encodeURIComponent(day)+'&timeSlot='+encodeURIComponent(timeSlot));
}

window.addSchedule = addSchedule;
window.deleteSchedule = deleteSchedule;

document.addEventListener('DOMContentLoaded', function(){
    var btn = document.querySelector('button[name="addSchedule"]');
    if (btn) {
        btn.removeAttribute('onclick'); 
        btn.addEventListener('click', addSchedule);
        console.log('Bound addSchedule to button');
    } else {
        console.log('Add Schedule button not found to bind');
    }
});
