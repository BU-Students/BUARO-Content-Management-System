$('textarea').each(function() {
    var simplemde = new SimpleMDE({
        element: this,
    });
    simplemde.render(); 
});
    
//Changes the radio button appearance and text
$('.dropdown-radio').find('input').change(function() {
  var dropdown = $(this).closest('.dropdown');
  var radioname = $(this).attr('name');
    var checked = 'input[name=' + radioname + ']:checked';
      
  //update the text
  var checkedtext = $(checked).closest('.dropdown-radio').text();
  dropdown.find('button').text( checkedtext );

  //retrieve the checked value, if needed in page 
  var thisvalue = dropdown.find( checked ).val();
});


//Functions to change the class of the dateevent in the add story/event
function chng(){
     document.getElementById("dateEvent1").className = 'show';
}
function chng1(){
     document.getElementById("dateEvent1").className = 'hidden';
}

//Functions to change the class of the dateevent in the edit button modal of stories
function chng2(val){
    var num = val;
    document.getElementById("dateEvent-"+num).className ="show";
}
function chng3(val){
    var num = val;
    console.log(num);
    document.getElementById("dateEvent-"+num).className = "hidden";
}

//Functions to change the class of the dateevent in the edit button modal of stories
function endis1(val){
  var num = val;
      if((document.getElementById("endis-"+num).disabled) == true){
            document.getElementById("endis-"+num).disabled = false;
      }
       else{
            document.getElementById("endis-"+num).disabled = true;   
       }
}
function endis2(val){
       var num = val;
       document.getElementById("endis-"+num).disabled = true;
}

    