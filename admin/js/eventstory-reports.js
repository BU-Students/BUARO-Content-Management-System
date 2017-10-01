//Code for sorting tables courtesy of Christian
function sortAdminTable(header, n) {
  var theaders = document.getElementById("admin-table-headers").children;
  for(var i = 0; i < theaders.length; ++i)
    theaders[i].classList.remove("active");
  header.classList.add("active");

  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("admin-table-body");
  switching = true;

  //set the sorting direction to ascending
  dir = "asc";

  //loop until no switching has been done
  while (switching) {
    switching = false;
    rows = table.getElementsByTagName("tr");
    //loop through all table rows (except the first, which contains table headers)
    for (i = 0; i < (rows.length - 1); i++) {
      shouldSwitch = false;

      //get the two elements to compare, the current row and the next
      x = rows[i].getElementsByTagName("td")[n];
      y = rows[i + 1].getElementsByTagName("td")[n];
      //check if the two rows should switch place, based on the direction, "asc" or "desc"
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      }
      else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      }
    }

    if(shouldSwitch) {
      //if a switch has been marked, make the switch and mark that a switch has been made
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;

      //increase this count by 1 each time a switch is done
      switchcount++;
    }
    else {
      //If no switching has been done and the direction is "asc", set the direction to "desc" and run the while loop again
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}