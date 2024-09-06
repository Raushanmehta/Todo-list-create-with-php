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
  <!-- Edit modal -->
  <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
    Launch demo modal
  </button> -->

  <!--Edit Modal -->
  <!-- <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div> -->




  <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top p-3 px-5">
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
  </nav> -->

  <?php
  if ($insert) {
    echo  "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Holy guacamole!</strong> New record created successfully.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
  }
  ?>


  <!-- <section class="">
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
  </section> -->

  <!-- <section class=" h-screen">
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
    </div> -->
  </section>

  <section>
 <table class="nl-container" width="100%" border="0" cellpadding="0" cellspacing="0" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #e1f3f3;">
    <tbody>
        <tr>
            <td>
                <!-- Logo Section -->
                <table class="row row-1" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" style="background-position: center top;">
                    <tbody>
                        <tr>
                            <td>
                                <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" style="color: #000000; width: 100%; max-width: 685px;" width="685">
                                    <tbody>
                                        <tr>
                                            <td class="column column-1" width="100%" style="text-align: center; padding-top: 0px; padding-bottom: 0px;">
                                                <img class="icon" src="https://www.webnx.in/wp-content/uploads/2022/03/W-Logo-1.png" alt="" height="71" width="70" style="display: block; height: auto; margin: 0 auto; border: 0; margin-bottom: -30px; padding-top: 20px; max-width: 100%; width: auto;">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- Main Content Section -->
                <table class="row row-3" align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td>
                                <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" style="background-color: #ffffff; color: #000000; width: 100%; max-width: 685px;" width="685">
                                    <tbody>
                                        <tr>
                                            <td class="column column-1" width="100%" style="padding: 0 30px;">
                                                <div style="line-height: 1.5; padding-top: 20px;">
                                                    <b style="color: #555555; font-family: 'Trebuchet MS'; font-size: medium;">Dear %CustomerName%</b>,
                                                </div>
                                                <div style="line-height: 1.5; padding-top: 20px;">
                                                    <font color="#555555" face="Trebuchet MS">
                                                        We are writing to inform you that we have generated and sent an invoice for the services provided to you. We kindly request that you review the invoice at your earliest convenience and proceed with the payment.<br><br>
                                                        To facilitate the payment process, we have attached a copy of the invoice to this email. Please find the attachment labeled "%InvoiceNumber%" for your reference.
                                                    </font>
                                                </div>
                                                <div style="text-align: center; padding: 20px 0;">
                                                    <div style="padding: 0 15px; border-bottom: 1px solid #e8deb5;">
                                                        <h4 style="margin-bottom: 0;"><font face="Trebuchet MS">Invoice Amount</font></h4>
                                                        <h2 style="color: #d61916; margin-top: 10px;"><font face="Trebuchet MS">%Total%</font></h2>
                                                    </div>
                                                    <div style="padding: 25px 0;">
                                                        <div style="padding: 0 15px; border-bottom: 1px solid #e8deb5;">
                                                            <h4 style="margin-bottom: 0;"><font face="Trebuchet MS" color="#333333"><span style="font-weight: 400;">Thank you for your cooperation. We look forward to receiving your payment soon.</span></font></h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- Footer Section -->
                <table class="row row-4" align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td>
                                <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" style="color: #000000; width: 100%; max-width: 685px;" width="685">
                                    <tbody>
                                        <tr>
                                            <td class="column column-1" width="100%" style="padding: 5px 10px;">
                                                <div style="font-size: 12px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; color: #555555; line-height: 1.2; text-align: center;">
                                                    <p style="margin: 0; font-size: 14px;">Web Nx - Website Development Company</p>
                                                    <p style="margin: 0; font-size: 14px;">Contact Us: +91-777-777-7777, 777-777-7777</p>
                                                    <p style="margin: 0; font-size: 14px;"><a href="https://www.webnx.in" target="_blank" rel="noopener" style="color: #0068a5; text-decoration: underline;">www.webnx.in</a> | <a href="mailto:info@webnx.in" target="_blank" rel="noopener" style="color: #0068a5; text-decoration: underline;">info@webnx.in</a></p>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- Confidentiality Notice -->
                <table class="row row-5" align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td>
                                <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" style="color: #000000; width: 100%; max-width: 685px;" width="685">
                                    <tbody>
                                        <tr>
                                            <td class="column column-1" width="100%" style="padding: 5px 10px;">
                                                <div style="font-size: 12px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; color: #555555; line-height: 1.2; text-align: center;">
                                                    <p style="margin: 0; font-size: 14px;">Confidentiality Notice: This email and any attachments are confidential and may be legally privileged. If you have received this email in error, please delete it immediately and notify the sender.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>

<!-- Responsive Styles -->
<style type="text/css">
    @media only screen and (max-width: 600px) {
        table[class="row-content"] {
            width: 100% !important;
        }
        td[class="column"] {
            display: block;
            width: 100% !important;
        }
        img[class="icon"] {
            height: auto !important;
            width: 100% !important;
            max-width: 70px;
        }
        h2, h4, p {
            font-size: 16px !important;
        }
        td {
            padding: 10px !important;
        }
    }
</style>


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
        console.log("edit", e.target.parentNode.parentNode)
      });
    });
  </script>
</body>

</html>