<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Medic Assist</title>
    <link rel="stylesheet" href="fonts/material-icon/css1/material-design-iconic-font.min.css">
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
                                <a href="index.html">
                                    <img src="images/logo.jpg" alt="" width="80">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5" style="background-color:#ff6f00">
                            <div class="main-menu  d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a href="index.html">Home</a></li>
                                        <li><a href="pharmacy.html">Pharmacy</a></li>
                                        <li><a href="contact.html">Contact Us</a></li>
                                        <li><a href="#">Sign In <i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                <li><a href="includes/signdoctor.php">Doctor</a></li>
                                                <li><a href="includes/signpatient.php">patient</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">Sign Up <i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                <li><a href="docsignup.php">Doctor</a></li>
                                                <li><a href="patsignup.php">patient</a></li>
                                            </ul>
                                        </li>

                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                            <div class="Appointment">
                                <div class="book_btn d-none d-lg-block">
                                    <a class="popup-with-form" href="includes/signpatient.php">Get Started</a>
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
                        <figure><img src="images/patient.jpg" alt="signup image" style="width:330px;height:279px;background-size:cover;"></figure>
                        <b>Already A Member?</b>
                        <a href="includes/signpatient.php" class="signup-image-link">Click here</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Sign Up</h2>
                        <form name='patsignup' method="POST" class="register-form" id="login-form" onsubmit="return validator()">
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="fname" id="your_name" placeholder="Your FirstName" required />
                            </div>
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="lname" id="your_name" placeholder="Your LastName" required/>
                            </div>
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="email" name="mail" id="your_name" placeholder="Your Email" required/>
                            </div>
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="phone" id="your_name" placeholder="Your PhoneNumber" required/>
                            </div>
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="city" id="your_name" placeholder="Your City" required/>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pwd" id="your_pass" placeholder="Password" required/>
                            </div>
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="password" name="pwd-repeat" id="your_name" placeholder="Repeat Your Password" required/>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup-submit" id="signup" class="form-submit" value="Register"/>
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
                                    <img src="images/logo.jpg" alt="" width=80><br><br>
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
                                Useful Links
                            </h3>
                            <ul>
                                <li><a href="contact.html">Contact Us</a></li>
                                <li><a href="#">Login</a></li>
                                <li><a href='pharmacy.html'>Pharmacy</a></li>
                                <li><a href="#"> Signup</a></li>

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
    </footer>    <script>
        function validator(){
            var main=document.forms['patsignup']
            var safe=/^[0-9a-zA-Z]+$/;
            var validphone=/^[0-9]+$/;
            if(!main['fname'].value.match(safe)){
                alert('Enter Valid FirstName')
            }
            else if(!main['lname'].value.match(safe)){
                alert('Enter Valid LastName')
            }
            else if(!main['city'].value.match(safe)){
                alert('Enter Valid City')
            }
            else if(main['pwd'].value!==main['pwd-repeat'].value){
                alert("Passwords Don't Match")
            }
            else if(!main['phone'].value.match(validphone)){
                alert('Enter Valid PhoneNumber')
            }
            else if(main['phone'].value.length<10){
                alert('Enter Valid PhoneNumber')
            }
            else if(main['pwd'].value.length<5){
                alert('Password Length Should Be A Minimum Of 6 Characters')
            }
            else{
                main.action="includes/signup.pat.php"
            }
        }
    </script>
</body>
</html>