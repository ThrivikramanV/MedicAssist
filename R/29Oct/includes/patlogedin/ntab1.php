<?php
if(isset($_POST['sign-in'])){
  echo sprintf('
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" type="text/css" href="pstyle.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

  <header>
    <div class="id1">
      <div id="sticky-header" class="main-id1">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-xl-4 col-lg-3">
              <div class="logo">
                <a href="index.html">
                  <img src="logo.jpg" alt="" width="80">
                </a>
              </div>
            </div>
            <div class="col-xl-4 col-lg-5">
              <div class="main-menu  d-none d-lg-block">
                <nav>
                  <ul id="navigation">
                    <li><a class="active" href="index.html">Home</a></li>
                    <li><a href="#">Pharmacy</a></li>
                    <li><a href="contact.html">Contact Us</a></li>
                  </ul>
                </nav>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3" style="font-size: 18px;">
              Hi <span id="patname"></span>! <br> Patient ID: <span id="patid">%s</span>
            </div>
            <div class="col-xl-1 col-lg-1 d-none d-lg-block">
              <div class="Appointment">
                <div class="book_btn d-none d-lg-block">
                  <a href="#">Logout</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <div id="tabmenu">
    <button class="tab" id="red" onclick="location.href=\'ntab1.php\'">Medical Records</button>
    <button class="tab" id="green" onclick="location.href=\'ntab2.php\'">Appointments</button>
    <button class="tab" id="blue" onclick="location.href=\'ntab3.php\'">Doctor\'s Prescriptions</button>
  </div>

  <span id="colorbar"></span>

  <div class="sidenav">

    <span class="navHead">Reports</span>

    <div class="opts">
      Upload
      <form id="upload" method="post" enctype="multipart/form-data" action="">
        <input type="file" id="fileupload">
      </form>
    </div>
    <br>
    <div class="opts" id="remove">
      Remove
    </div>
    <br>
    <div class="opts" id="download">
      Download
    </div>

  </div>

  <div class="doclisthead">
    <div class="file">File</div>
    <div class="time">Time of upload</div>
    <div class="doclistheadline"></div>
    <br>
  </div>

  <div class="doclist"></div>

  <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
  <script type="text/javascript" src="paction.js"></script>
</body>

</html>',$_POST['patid']);
}
?>