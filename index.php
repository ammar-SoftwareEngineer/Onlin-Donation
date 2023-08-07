<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
        <!-- file css -->
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/all.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- fonts google -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
            rel="stylesheet">
    </head>

    <?php

    session_start();
    if(isset($_SESSION['user'])){
        header('location:profile.php');
        exit();
    }
    if(isset($_POST['submit'])){
     include 'conn-db.php';
       $password=filter_var($_POST['password'],FILTER_SANITIZE_STRING);
       $email=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
    
       $errors=[];
       
    
       // validate email
       if(empty($email)){
        $errors[]="يجب كتابة البريد الاكترونى";
       }
    
    
       // validate password
       if(empty($password)){
            $errors[]="يجب كتابة  كلمة المرور ";
       }
    
    
    
       // insert or errros 
       if(empty($errors)){
       
          // echo "check db";
    
        $stm="SELECT * FROM users WHERE email ='$email'";
        $q=$conn->prepare($stm);
        $q->execute();
        $data=$q->fetch();
        if(!$data){
           $errors[] = "خطأ فى تسجيل الدخول";
        }else{
            
             $password_hash=$data['password']; 
             
             if(!password_verify($password,$password_hash)){
                $errors[] = "خطأ فى تسجيل الدخول";
             }else{
                $_SESSION['user']=[
                    "name"=>$data['name'],
                    "email"=>$email,
                  ];
                header('location:profile.php');
    
             }
        }
         
        
       }
    }
    
    ?>
    
    
    
    

    <body>
        <div class="login-sign">
            <div class="login-page" id="signInBox">
                <div class="log">
                    <div class="row">
                        <div class="col-lg-6 d-flex justify-content-end order-lg-1">
                            <div class="img-sign">
                                <img class="img-fluid" src="images/sign.webp" alt="">
                                <p class="text-center text-capitalize">welcome</p>
                                <span class="text-center text-capitalize"> in website donation System</span>
                            </div>

                        </div>
                        <div class="col-lg-6 order-lg-0">
                            <!-- start header -->
                            <header>
                                <div class="container">
                                    <div class="nav-header d-flex justify-content-between align-items-center">
                                        <div class="logo">
                                            <img class="img-fluid" src="images/logo.png" alt="">
                                        </div>
                                        <div class="skip">
                                            <h4> <a href="landingPage.html">Skip</a> </h4>
                                        </div>
                                    </div>
                                </div>
                            </header>
                            <!-- end header -->
                            <!-- start login  -->
                            <div class="login">
                                <div class="container">
                                    <div class="header-login">
                                        <h2 class="text-center">Login</h2>
                                        <p class="text-center mb-5">Welcome to our site, please login</p>
                                    </div>
                                    <form action="landingPage.html" method="post">
                                    <?php 
                                    if(isset($errors)){
                                        if(!empty($errors)){
                                            foreach($errors as $msg){
                                                echo $msg . "<br>";
                                            }
                                        }
                                    }
                                     ?>
                                        <div class="forms mb-3">
                                            <label for="floatingInput" class="mb-2">Email</label>
                                            <input type="email" name="email" class="form-control" id="floatingInput"
                                                placeholder="name@example.com">
                                        </div>
                                        <div class="forms">
                                            <label for="floatingPassword" class="mb-2">Password</label>
                                            <input type="password" name="password" class="form-control" id="floatingPassword"
                                                placeholder="Password">
                                            <p class="mt-2 text-end">Froget to password?</p>
                                        </div>
                                        <input type="submit" name="submit" class="btn btn-success mt-3 button" value="Login">
                                    </form>
                                    <div class="create-account">
                                        <p class="text-center mt-4 text-capitalize">don’t have account? <span
                                                id="signUp">create
                                                account</span> </p>
                                    </div>
                                    <div
                                        class="or-links mt-5 d-flex justify-content-center align-items-center flex-column">
                                        <p class="text-capitalize text-center">or register Across</p>
                                        <div class="buttons-log">
                                            <button class="btn btn-info text-capitalize mb-3">
                                                <a href="https://www.facebook.com/" target="_blank">sign in with
                                                    facebook</a>
                                                <i class="fa-brands fa-facebook-f"></i>
                                            </button>
                                            <button class="btn btn-info text-capitalize">
                                                <a class="me-5 ms-3" href="https://myaccount.google.com/"
                                                    target="_blank">sign
                                                    in
                                                    with
                                                    google</a>
                                                <img src="images/Group 16.svg" alt="">
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end login -->
                            <!-- start footer -->
                            <footer>
                                <div class="container">
                                    <p class="text-center text-capitalize">online donation system <span>&copy;</span>
                                        2022
                                    </p>
                                </div>
                            </footer>
                        </div>
                        <!-- end footer -->
                    </div>
                </div>
            </div>
            <!-- ######################################################################### -->
            <!-- start sign up -->
            <div class="signup-page " id="signUpBox">
                <div class="row">
                    <div class="col-lg-6 d-flex justify-content-end order-lg-0">
                        <div class="img-sign">
                            <img class="img-fluid" src="images/sign.webp" alt="">
                            <p class="text-center text-capitalize">welcome</p>
                            <span class="text-center text-capitalize"> in website donation System</span>
                        </div>
                    </div>
                    <div class="col-lg-6 order-lg-1">
                        <!-- start header sign up -->
                        <header>
                            <div class="container">
                                <div class="nav-header d-flex justify-content-between align-items-center">
                                    <div class="logo">
                                        <img class="img-fluid" src="images/logo.png" alt="">

                                    </div>
                                    <div class="skip">
                                        <h4> <a href="landingPage.html">Skip</a> </h4>
                                    </div>
                                </div>
                            </div>
                        </header>
                        <!-- end header sign up-->
                        <!-- start sign up  -->
                        <div class="signup">
                            <div class="container">
                                <div class="header-signup">
                                    <h2 class="text-center">Create Account</h2>
                                    <p class="text-center mb-5">Welcome to our site, please create account</p>
                                </div>
                                <?php
                                        
                                
                                        if(isset($_SESSION['user'])){
                                            header('location:landingPage.html');
                                            exit();
                                        }
                                        if(isset($_POST['submit'])){
                                        include 'conn-db.php';
                                        $name=filter_var($_POST['name'],FILTER_SANITIZE_STRING);
                                        $password=filter_var($_POST['password'],FILTER_SANITIZE_STRING);
                                        $email=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);

                                        $errors=[];
                                        // validate name
                                        if(empty($name)){
                                            $errors[]="يجب كتابة الاسم";
                                        }elseif(strlen($name)>100){
                                            $errors[]="يجب ان لايكون الاسم اكبر من 100 حرف ";
                                        }

                                        // validate email
                                        if(empty($email)){
                                            $errors[]="يجب كتابة البريد الاكترونى";
                                        }elseif(filter_var($email,FILTER_VALIDATE_EMAIL)==false){
                                            $errors[]="البريد الاكترونى غير صالح";
                                        }

                                        $stm="SELECT email FROM users WHERE email ='$email'";
                                        $q=$conn->prepare($stm);
                                        $q->execute();
                                        $data=$q->fetch();

                                        if($data){
                                            $errors[]="البريد الاكترونى موجود بالفعل";
                                        }


                                        // validate password
                                        if(empty($password)){
                                                $errors[]="يجب كتابة  كلمة المرور ";
                                        }elseif(strlen($password)<6){
                                            $errors[]="يجب ان لايكون كلمة المرور  اقل  من 6 حرف ";
                                        }



                                        // insert or errros 
                                        if(empty($errors)){
                                            // echo "insert db";
                                            $password=password_hash($password,PASSWORD_DEFAULT);
                                            $stm="INSERT INTO users (name,email,password) VALUES ('$name','$email','$password')";
                                            $conn->prepare($stm)->execute();
                                            $_POST['name']='';
                                            $_POST['email']='';

                                            $_SESSION['user']=[
                                                "name"=>$name,
                                                "email"=>$email,
                                            ];
                                            header('location:profile.php');
                                        }
                                        }

                                        ?>



                                        <form action="landingPage.html" method="POST">
                                            <?php 
                                                if(isset($errors)){
                                                    if(!empty($errors)){
                                                        foreach($errors as $msg){
                                                            echo $msg . "<br>";
                                                        }
                                                    }
                                                }
                                            ?>
                                <form action="landingPage.html" method="post">
                                    <div class="row d-flex justify-content-center align-items-center flex-nowrap">
                                        <!-- first name -->
                                        <div class="col">
                                            <div class="forms first mb-3">
                                                <label for="floatingInput" class="mb-2">First Name</label>
                                                <input type="text" value="<?php if(isset($_POST['name'])){echo $_POST['name'];} ?>" name="name" class="form-control" placeholder="First name"
                                                    aria-label="First name">
                                            </div>
                                        </div>
                                        <!-- last name -->
                                        <div class="col">
                                            <div class=" forms last mb-3">
                                                <label for="floatingInput" class="mb-2">Last Name</label>
                                                <input type="text" value="<?php if(isset($_POST['name'])){echo $_POST['name'];} ?>" name="name" class="form-control" placeholder="Last name"
                                                    aria-label="Last name">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- email -->
                                    <div class="forms email mb-3">
                                        <label for="floatingInput" class="mb-2">Email</label>
                                        <input type="email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>" name="email" class="form-control" id="floatingInput"
                                            placeholder="name@example.com">
                                    </div>
                                    <!-- phone number -->
                                    <div class="forms phone mb-3">
                                        <label for="floatingInput" class="mb-2">Phone Number</label>
                                        <div class="inputs">
                                            <input type="text" class="form-control" value="+20"
                                                aria-label="Phone Number">
                                            <input type="text" class="form-control" aria-label="Phone Number"
                                                placeholder="0000000000">
                                        </div>
                                    </div>

                                    <div class="forms pass mb-3">
                                        <!-- create password -->
                                        <label for="floatingPassword" class="mb-2">Create Password</label>
                                        <input type="password" class="form-control" id="floatingPassword"
                                            placeholder="Enter Password">
                                    </div>
                                    <div class="forms pass2">
                                        <!-- confirm password -->
                                        <label for="floatingPassword" class="mb-2">Confirm Password</label>
                                        <input type="password" class="form-control" id="floatingPassword"
                                            placeholder="Enter Password">
                                    </div>
                                    <input type="submit" name="submit" class="btn btn-success mt-4 button" value="signUp">
                                </form>
                                <div class="login">
                                    <p id="signIn" class="text-center mt-4 text-capitalize">I am already a member </p>
                                </div>
                            </div>
                            <!-- end sign up -->
                            <!-- start footer -->
                            <footer>
                                <div class="container">
                                    <p class="text-center text-capitalize">online donation system <span>&copy;</span>
                                        2022
                                    </p>
                                </div>
                            </footer>
                        </div>
                        <!-- end footer -->
                    </div>
                </div>
            </div>
            <!-- end sign up page -->
        </div>
        <!-- #################################################### -->
        <!-- scripts js -->
        <script src="js/all.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/main.js"></script>
    </body>

</html>