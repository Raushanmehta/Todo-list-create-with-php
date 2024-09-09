<?php
$insert = false;
$serverName = "localhost";
$userName = "root";
$password = "";
$database = "demo";


$connection = mysqli_connect($serverName, $userName, $password, $database);
if (!$connection) {
  die("Sorry database not connected!" . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $title = $_POST['title'];
  $description = $_POST['description'];

  $sql = "INSERT INTO `notes` (`title`, `description`) VALUES ('$title', '$description')";
  $result = mysqli_query($connection, $sql);

  if (!$result) {

    echo "Error: " . $sql . "<br>" . mysqli_error($connection);
  } else {
    $insert = true;
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
    crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

  <title>To doList</title>
</head>

<body>
   
   <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit this note</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <span aria-hidden="true">$times;</span>
        </div>
        <div class="modal-body">
        <form action="/LearnPhp/Todolist/index.php" method="POST">
        <div class="form-group">
          <label for="title" class="">Note title</label>
          <input
            type="text"
            class="form-control"
            id="titleEdit"
            name="titleEdit"
            style="height: 40px" />
        </div>

        <div class="form-group mb-3">
          <label for="description"> Note Description</label>
          <textarea
            class="form-control"
            placeholder="Adding your notes description"
            id="descriptionEdit"
            name="descriptionEdit"
            style="height: 100px"
            rows="3">
          </textarea>
        </div>
        <button type="submit" class="btn btn-primary mb-3">Add Note</button>
      </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div> 




   <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top p-3 px-5">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">PHP</a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Service</a>
          </li>
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle"
              href="#"
              id="navbarDropdown"
              role="button"
              data-bs-toggle="dropdown"
              aria-expanded="false">
              Dropdown
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">About</a></li>
              <li><a class="dropdown-item" href="#">Blog</a></li>
              <li>
                <hr class="dropdown-divider" />
              </li>
              <li><a class="dropdown-item" href="#">Portfolio</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a
              class="nav-link disabled"
              href="#"
              tabindex="-1"
              aria-disabled="true">Contact</a>
          </li>
        </ul>
        <form class="d-flex">
          <input
            class="form-control me-2"
            type="search"
            placeholder="Search"
            aria-label="Search" />
          <button class="btn btn-outline-success" type="submit">
            Search
          </button>
        </form>
      </div>
    </div>
  </nav> 

  <?php
  if ($insert) {
    echo  "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Holy guacamole!</strong> New record created successfully.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
  }
  ?>


   <section class="">
    <div class="container p-3 px-5 ">
      <h2>Add Notes</h2>
      <form action="/LearnPhp/Todolist/index.php" method="post">
        <div class="form-group">
          <label for="title" class="">Note title</label>
          <input
            type="text"
            class="form-control"
            id="title"
            name="title"
            style="height: 40px" />
        </div>

        <div class="form-group mb-3">
          <label for="description"> Note Description</label>
          <textarea
            class="form-control"
            placeholder="Adding your notes description"
            id="description"
            name="description"
            style="height: 100px"
            rows="3">
          </textarea>
        </div>
        <button type="submit" class="btn btn-primary mb-3">Add Note</button>
      </form>
    </div>
  </section> 

   <section class=" h-screen">
    <div class="container px-5 ">


      <table class="table table-dark table-striped" id="myTable">
        <thead>
          <tr>
            <th scope="col">S No</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>

        <tbody>
          <?php
          $sql = "SELECT * FROM `notes`";
          $result = mysqli_query($connection, $sql);
          $sno = 0;
          while ($row = mysqli_fetch_assoc($result)) {
            $sno = $sno + 1;
            echo "<tr>
            <th scope='row'>" . $sno . "</th>
            <td>" . $row['title'] . "</td>
            <td>" . $row['description'] . "</td>
            <td><button class='edit btn btn-primary btn-sm '>Edit</button> <button class='delete btn btn-danger btn-sm '>Delete</button></td>
            </tr>";
          }
          ?>
        </tbody>
      </table>
    </div> 
  </section>

 
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
    crossorigin="anonymous"></script>

  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#myTable').DataTable();
    });
  </script>

  <script>
    let edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener('click', (e) => {
        console.log("edit", );
          tr = e.target.parentNode.parentNode;
          title = tr.getElenmentByTagName("td")[0].innerText;
          description = tr.getElenmentByTagName("td")[1].innerText;
          console.log(title, description);
          titleEdit.value = title;
          descriptionEdit.value = description;
          $('#editModal').modal('toggle');
        
      });
    });
  </script>
</body>

</html>