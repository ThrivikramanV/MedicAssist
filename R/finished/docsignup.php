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
        <section class="signup">
            <div class="container1">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form name="docsignup" class="register-form" onsubmit="return validator()" method="POST" id="register-form">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="fname" id="fname" placeholder="Your First Name" required/>
                            </div>
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="lname" id="lname" placeholder="Your Last Name" required/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="mail" id="email" placeholder="Your Email" required/>
                            </div>
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="phone" id="name" placeholder="Your PhoneNumber" maxlength="12" required/>
                            </div>
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="number" name="no_of_hospitals" placeholder="No Of Hospitals You Work At?" required/>
                            </div>
                            <div class="form-group">
                            Specializations<br>(Hold Ctrl To Select Multiple Options)
                            <select multiple class="form-control" required id="sel2" size="4" name="specs[]">
                <option value="Allergists" selected="selected">Allergists</option>
                <option value="Anesthesiologists">Anesthesiologists</option>
                <option value="Cardiologists">Cardiologists</option>
                <option value="Colon and Rectal Surgeons">Colon and Rectal Surgeons</option>
                <option value="Critical Care Medicine Specialists">Critical Care Medicine Specialists</option>
                <option value="Dermatologists">Dermatologists</option>
                <option value="Endocrinologists">Endocrinologists</option>
                <option value="Emergency Medicine Specialists">Emergency Medicine Specialists</option>
                <option value="Gastroenterologists">Gastroenterologists</option>
                <option value="Hematologists">Hematologists</option>
                <option value="Nephrologists">Nephrologists</option>
                <option value="Neurologists">Neurologists</option>
                <option value="Obstetricians and Gynecologists">Obstetricians and Gynecologists</option>
                <option value="Ophthalmologists">Ophthalmologists</option>
                <option value="Osteopaths">Osteopaths</option>
                <option value="Osteopaths">Pathologists</option>
                <option value="Radiologists">Radiologists</option>
                <option value="Rheumatologists">Rheumatologists</option>
                <option value="Urologists">Urologists</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                Enter Names Of Hospitals You Work At. Make Sure they Are Comma Separated
                                <textarea type="textarea" name="hospitals" id="inptext" required rows="5" cols="35"></textarea> 
                            </div>   
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pwd" id="pass" placeholder="Password" required/>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="pwd-repeat" id="re_pass" placeholder="Repeat your password" required/>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup-submit" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/banner2.jpg" alt="singup image"></figure>
                        <b>Already a Member?</b>
                        <a href="includes/signdoctor.php" class="signup-image-link">Click Here</a>
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
    </footer>
    <script>
        function validator(){
            var main=document.forms['docsignup']
            var safe=/^[0-9a-zA-Z]+$/;
            var validphone=/^[0-9]+$/;
            var safetext=/^[a-zA-Z0-9,]+$/;
            if(!main['fname'].value.match(safe)){
                alert('Enter Valid FirstName')
            }
            else if(!main['lname'].value.match(safe)){
                alert('Enter Valid LastName')
            }
            else if((main['pwd'].value).length<6){
                alert('Password Minimum Length Should Be 6')
            }
            else if(main['pwd'].value!==main['pwd-repeat'].value){
                alert("Passwords Don't Match")
            }
            else if(!main['phone'].value.match(validphone)){
                alert('Enter Valid PhoneNumber')
            }
            else if(!main['hospitals'].value.match(safetext)){
                alert("Please Check Your Hospitals Input")
            }
            else{
                main.action="includes/signup.doc.php"
            }
        }
    </script>
</body>
</html>