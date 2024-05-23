function searchTable() {
    let input = document.getElementById("search").value.toLowerCase();
    let table = document.getElementById("tableV");
    let rows = table.rows;
  
    for (let i = 1; i < rows.length; i++) {
      let cells = rows[i].cells;
      let match = false;
  
      for (let j = 0; j < cells.length - 1; j++) {
        if (cells[j].innerText.toLowerCase().includes(input)) {
          match = true;
          break;
        }
      }
  
      if (match) {
        rows[i].style.display = "";
      } else {
        rows[i].style.display = "none";
      }
    }
  }