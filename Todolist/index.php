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
  <link rel="stylesheet" href="index.css">

  <style>
body {
    color: #666666;
    background: #dddddd;
    font-family: 'Poppins', sans-serif;
    font-weight: 400;
}

h1,
h2, 
h3, 
h4,
h5, 
h6 {
    color: #000000;
}

a {
    color: #666666;
    transition: .3s;
}

a:hover,
a:active,
a:focus {
    color: #0B5ED7;
    outline: none;
    text-decoration: none;
}

.btn:focus {
    box-shadow: none;
}

.wrapper {
    position: relative;
    width: 100%;
    max-width: 1480px;
    margin: 0 auto;
    background: #ffffff;
}

.back-to-top {
    position: fixed;
    display: none;
    background: #0B5ED7;
    color: #121518;
    width: 44px;
    height: 44px;
    text-align: center;
    line-height: 1;
    font-size: 22px;
    right: 15px;
    bottom: 15px;
    transition: background 0.5s;
    z-index: 9;
}

.back-to-top:hover {
    color: #0B5ED7;
    background: #121518;
}

.back-to-top i {
    padding-top: 10px;
}

.btn {
    transition: .3s;
}

.footer {
    position: relative;
    margin-top: 45px;
    padding-top: 90px;
    background: black;
    color: #ffffff;
}

.footer .footer-contact,
.footer .footer-link,
.footer .newsletter {
    position: relative;
    margin-bottom: 45px;
}

.footer h2 {
    position: relative;
    margin-bottom: 20px;
    padding-bottom: 10px;
    font-size: 20px;
    font-weight: 600;
    color: #0B5ED7;
}

.footer h2::after {
    position: absolute;
    content: "";
    width: 60px;
    height: 2px;
    left: 0;
    bottom: 0;
    background: #0B5ED7;
}

.footer .footer-link a {
    display: block;
    margin-bottom: 10px;
    color: #ffffff;
    transition: .3s;
    text-decoration: none;
}

.footer .footer-link a::before {
    position: relative;
    content: "\f105";
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    margin-right: 10px;
}

.footer .footer-link a:hover {
    color: #0B5ED7;
    letter-spacing: 1px;
}

.footer .footer-contact p i {
    width: 25px;
}

.footer .footer-social {
    position: relative;
    margin-top: 20px;
}

.footer .footer-social a {
    display: inline-block;
    width: 40px;
    height: 40px;
    padding: 7px 0;
    text-align: center;
    border: 1px solid rgba(256, 256, 256, .3);
    border-radius: 60px;
    transition: .3s;
}

.footer .footer-social a i {
    font-size: 15px;
    color: #ffffff;
}

.footer .footer-social a:hover {
    background: #0B5ED7;
    border-color: #0B5ED7;
}

.footer .footer-social a:hover i {
    color: black;
}

.footer .newsletter .form {
    position: relative;
    max-width: 400px;
    margin: 0 auto;
}

.footer .newsletter input {
    height: 50px;
    border: 2px solid #121518;
    border-radius: 0;
}

.footer .newsletter .btn {
    position: absolute;
    top: 5px;
    right: 5px;
    height: 40px;
    padding: 8px 10px;
    font-size: 14px;
    font-weight: 500;
    text-transform: uppercase;
    color: #0B5ED7;
    background: #121518;
    border-radius: 0;
    border: 2px solid #0B5ED7;
    transition: .3s;
}

.footer .newsletter .btn:hover {
    color: #121518;
    background: #0B5ED7;
}

.footer .footer-menu .f-menu {
    position: relative;
    padding: 15px 0;
    font-size: 0;
    text-align: center;
    border-top: 1px solid rgba(256, 256, 256, .1);
    border-bottom: 1px solid rgba(256, 256, 256, .1);
}

.footer .footer-menu .f-menu a {
    color: #ffffff;
    font-size: 16px;
    margin-right: 15px;
    padding-right: 15px;
    border-right: 1px solid rgba(255, 255, 255, .1);
}

.footer .footer-menu .f-menu a:hover {
    color: #0B5ED7;
}

.footer .footer-menu .f-menu a:last-child {
    margin-right: 0;
    padding-right: 0;
    border-right: none;
}


.footer .copyright {
    padding: 30px 15px;
}

.footer .copyright p {
    margin: 0;
    color: #ffffff;
}

.footer .copyright .col-md-6:last-child p {
    text-align: right;
}

.footer .copyright p a {
    color: #0B5ED7;
    font-weight: 500;
    letter-spacing: 1px;
}

.footer .copyright p a:hover {
    color: #ffffff;
}

@media (max-width: 768px) {
    .footer .copyright p,
    .footer .copyright .col-md-6:last-child p {
        margin: 5px 0;
        text-align: center;
    }
}


  </style>

  <title>To doList</title>
</head>

<body>
   
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit this note</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/LearnPhp/Todolist/index.php" method="POST">
          <div class="form-group">
            <label for="title" class="">Note title</label>
            <input type="text" class="form-control" id="titleEdit" name="titleEdit" style="height: 40px" />
          </div>
          <div class="form-group mb-3">
            <label for="description">Note Description</label>
            <textarea class="form-control" placeholder="Adding your notes description" id="descriptionEdit" name="descriptionEdit" style="height: 100px" rows="3"></textarea>
          </div>
          <button type="submit" class="btn btn-primary mb-3">Save changes</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
  <div class="container p-3 px-lg-5">
    <h2>Add Notes</h2>
    <form action="/LearnPhp/Todolist/index.php" method="post">
      <div class="row">
        <div class="form-group col-12">
          <label for="title" class="">Note title</label>
          <input type="text" class="form-control" id="title" name="title" style="height: 40px" />
        </div>
        <div class="form-group col-12 mb-3">
          <label for="description"> Note Description</label>
          <textarea class="form-control" placeholder="Adding your notes description" id="description" name="description" style="height: 100px" rows="3"></textarea>
        </div>
      </div>
      <button type="submit" class="btn btn-primary mb-3">Add Note</button>
    </form>
  </div>
</section>

<section class="h-screen">
  <div class="container px-2 px-lg-5">
    <div class="table-responsive">
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
            <td class='text-truncate' style='max-width: 150px;'>" . $row['description'] . "</td>
            <td><button class='edit btn btn-primary btn-sm '>Edit</button> <button class='delete btn btn-danger btn-sm '>Delete</button></td>
            </tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</section>



  <section>
  <div class="footer wow fadeIn" data-wow-delay="0.3s">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <div class="footer-contact">
                                <h2>Office Contact</h2>
                                <p><i class="fa fa-map-marker-alt"></i>INDIA </p>
                                <p><i class="fa fa-phone-alt"></i>+915989559</p>
                                <p><i class="fa fa-envelope"></i>example@gmail.com</p>
                                <div class="footer-social">
                                    <a href=""><i class="fab fa-twitter"></i></a>
                                    <a href=""><i class="fab fa-facebook-f"></i></a>
                                    <a href=""><i class="fab fa-youtube"></i></a>
                                    <a href=""><i class="fab fa-instagram"></i></a>
                                    <a href=""><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="footer-link">
                                <h2>Ours Services</h2>
                                <a href="">web Development</a>
                                <a href="">App development</a>
                                <a href="">Web Design</a>
                                <a href="">LoGo Design</a>
                                <a href="">WordPress</a>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="footer-link">
                                <h2>Useful Pages</h2>
                                <a href="">About Us</a>
                                <a href="">Contact Us</a>
                                <a href="">Our Team</a>
                                <a href="">Projects</a>
                                <a href="">Testimonial</a>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="newsletter">
                                <h2>Newsletter</h2>
                                <p>
                                    Or kuch janna ho to dm karo contact kare ge
                                </p>
                                <div class="form">
                                    <input class="form-control" placeholder="Email here">
                                    <button class="btn">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="container copyright">
                    <div class="row">
                        <div class="col-md-6">
                            <p>&copy; <a href="#">PHp</a> All Right Reserved.</p>
                        </div>
                        <div class="col-md-6">
                            <p>Designed By <a href="#">Raushan mehta</a></p>
                        </div>
                    </div>
                </div>
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
    $(document).ready(function () {
        $('#myTable').DataTable();
    });

    let edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
        element.addEventListener('click', (e) => {
            console.log("edit clicked");
            tr = e.target.parentNode.parentNode;
            title = tr.getElementsByTagName("td")[0].innerText;
            description = tr.getElementsByTagName("td")[1].innerText;
            console.log(title, description);
            document.getElementById('titleEdit').value = title;
            document.getElementById('descriptionEdit').value = description;
            $('#editModal').modal('toggle');
        });
    });
</script>


</body>

</html>