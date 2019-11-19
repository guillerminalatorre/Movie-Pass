<?php require_once(VIEWS_PATH . "navbar.php"); ?>
<div class="container-fluid mb-4">
    <div class="col-sm-12 col-lg-10 offset-sm-0 offset-lg-1 bg-dark-transparent rounded shadow p-sm-2 p-md-4">
        <?php require_once(VIEWS_PATH . "alert.php"); ?>
        <div class="text-white">
                <div class="row">
                    <div class="col-12">
                        <h3 class="border-bottom pb-2">Ingresa el nombre que deseas buscar:</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="btn-group input-group col-12 mb-2">
                        <input type="text" id="myInput" onkeyup="search()" class="form-control" placeholder="Buscar por nombre..">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
function search() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>