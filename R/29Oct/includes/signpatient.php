<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Medic Assist</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css1/style.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <div class="id1">
            <div id="sticky-header" class="main-id1">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-4 col-lg-4">
                            <div class="logo">
                                <a href="../index.html">
                                    <img src="img/logo.jpg" alt="" width="80">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5" style="background-color:#ff6f00">
                            <div class="main-menu  d-none d-lg-block" id='sign'>
                                <nav>
                                    <ul id="navigation">
                                        <li><a href="../index.html">Home</a></li>
                                        <li><a href="../pharmacy.html">Pharmacy</a></li>
                                        <li><a href="../contact.html">Contact Us</a></li>
                                        <li><a href="#">Sign In <i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                <li><a href="signdoctor.php">Doctor</a></li    >
                                                <li><a href="signpatient.php">patient</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">Sign Up <i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                <li><a href="../docsignup.php">Doctor</a></li>
                                                <li><a href="../patsignup.php">patient</a></li>
                                            </ul>
                                        </li>

                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                            <div class="Appointment">
                                <div class="book_btn d-none d-lg-block">
                                    <a class="popup-with-form" href="signpatient.php">Get Started</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
      <div class="main">
        <section class="sign-in">
            <div class="container1">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="images/patient.jpg" alt="sing up image"></figure>
                        <b>Don't Have An Account?</b>
                        <a href="../patsignup.php" class="signup-image-link">Click here</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Sign In</h2>
                        <form name='patlogin' method="POST" class="register-form" id="login-form" onsubmit="return validator()">
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="patid" id="your_name" placeholder="Patient Id"/>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="patpwd" id="your_pass" placeholder="Password"/>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="login-submit" id="signin" class="form-submit" value="Log in"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <footer class="footer">
        <div class="footer_top">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-md-5 col-lg-5">
                        <div class="footer_widget">
                            <div class="footer_logo">
                                <a href="#">
                                    <img src="img/logo.jpg" alt="" width=80><br><br>
                                    <div class="medic">Medic Assist</div>
                                </a>
                            </div>
                            <p>
                                Developments in medical technology have long been confined to procedural or
                                pharmaceutical advances, while neglecting a most basic and essential component of
                                medicine: patient information management.
                            </p>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-2 col-lg-2"></div>
                    <div class="col-xl-2 col-md-2 col-lg-2">
                        <div class="footer_widget">
                            <h3 class="footer_title">
                                Links
                            </h3>
                            <ul>
                                <li><a href="../contact.html">Contact Us</a></li>
                                <li><a href="#sign">Login</a></li>
                                <li><a href='../pharmacy.html'>Pharmacy</a></li>
                                <li><a href="#sign"> Signup</a></li>

                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-3 col-lg-3">
                        <div class="footer_widget">
                            <h3 class="footer_title">
                                Address
                            </h3>
                            <p>
                                contact@medicassist.com
                                Bangalore 560066
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copy-right_text">
            <div class="container">
                <div class="footer_border"></div>
                <div class="row">
                    <div class="col-xl-12">
                        <p class="copy_right text-center">
                            Copyright &copy;
                            <script>document.write(new Date().getFullYear());</script> All rights reserved | Offered by FullStackWarriors</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script>
        function validator(){
            var main=document.forms['patlogin']
            var safe=/^[0-9a-zA-Z]+$/;
            if(!main['patid'].value.match(safe)){
                alert('Enter Valid PatientId')
            }
            else if(!main['patpwd'].value.match(safe)){
                alert("Enter Valid Password")
            }
            else{
                main.action="login.pat.php"
            }
        }
    </script>
</body>
</html>