
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="icon" type="image/png" sizes="180x180" href="images/favicons/apple-touch-icon.png"> -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>src/css/style.css">

    <title>Meet My Friend - log in or sign up</title>

    <style type="text/css">
      @media (max-width: 768px) { 
          #header{
          /*display: none;*/
          }

          #set2{
              padding-bottom: 0px;
              padding-top: 30px;
              position: fixed;
              padding-left: 0px;
              margin: 0 0px;
          }
      }

       @media (min-width: 768px) { 

        #searchCard{
          width: 500px;
        }

       }
    </style>
  </head>
  <body>

      <div id="header" >
          <div class="card-body pb-2 pt-2">
             
            <form action="<?php echo base_url(); ?>login/authenticate" method="POST" class="  row row-cols-lg-auto">
                  <div class="col-lg-6">
                    <a href="<?php echo base_url() ?>" style="text-decoration:none"> 
                      <p class="text-primary mb-0 pb-0 fw-bolder h3"><b> Meet my friend</b></p> 
                    </a>
                  </div>
                   <div class="col-lg-2 ">
                   <input type="text" class="form-control" id="" name="loginEmailMobile" placeholder="Email or phone" required>
                  </div>
                  <div class="col-lg-2">
                    <input type="password" class="form-control" id="" name="loginPassword" placeholder="Password" required>
                  </div>
                   <button type="submit" name="login" class="btn btn-primary "><b>Log In</b></button>
            </form>
      
          </div>
      </div>
      
  



      <div class="container"> 
        <div class="row" id="set2">        
          <div class="col col-lg-6">

              <div class="" style="" id="searchCard">
              <div class="card-body">

                <h2 class="card-title">Find Your Account</h2>
                  <div class="border-top" style="margin: 20px 16px;" ></div>
                <div class="border border-danger border-1 p-2 pb-0 mb-2" hidden style="background-color: #ffebe8;">
                  <p class="fw-bolder pb-0 mb-0">Please fill in at least one field</p>
                  <p class="mb-1 fw-lighter">Fill in at least one field to search for your account</p>
                </div>

                <form >
                  <div class="text-danger text-center"><?php echo isset($_SESSION['message']) ? $_SESSION['message']:""; unset($_SESSION['message']); ?></div>

                  <p class="card-text">Please enter your email address or mobile number to search for your account.</p>

                  <div class="mb-3">
                    <input type="text" class="form-control" id="" name="search" placeholder="Mobile number" required>
                    <div class="text-danger"><?php echo isset($_SESSION['emailError']) ? $_SESSION['emailError']:"" ; unset($_SESSION['emailError']); ?></div>
                  </div>

                  <div class="border-top" style="margin: 20px 16px;" ></div>

                  <div class="text-end">
                   <button type="submit" name="login" class="btn" style="background-color: #e4e6eb;"><b>Cancel</b></button>
                   <button type="submit" name="login" class="btn btn-primary"><b>Search</b></button>
                  </div>

                </form>

              </div>

            </div>
          </div>
        </div>
      </div>


              


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url() ?>src/js/signup_validation.js"></script>


  </body>
</html>
