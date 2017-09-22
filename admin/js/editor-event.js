function chng2_event(val){
      var num = val;
      document.getElementById("event-dateEvent-"+num).className ="show";
}

function chng3_event(val){
      var num = val;
      document.getElementById("event-dateEvent-"+num).className = "hidden";
}


function endis1_event(val){
      var num = val;
      if((document.getElementById("endis-event-"+num).disabled) == true){
            document.getElementById("endis-event-"+num).disabled = false;
      }
      else{
            document.getElementById("endis-event-"+num).disabled = true;   
      }
}

function endis2_event(val){
      var num = val;
      document.getElementById("endis-event-"+num).disabled = true;
}