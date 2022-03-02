<?php

$month_names = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");

$todayDate = date('d');
$todayMonth = date('M');
$todayYear = date('Y');


?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="icon" type="image/png" sizes="180x180" href="images/favicons/apple-touch-icon.png"> -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>src/css/style.css">

    <title>Meet My Friend - log in or sign up</title>

    <style type="text/css">

      @media (min-width: 576px) {
        #nameLable {
            padding: 80px 16px;
        }    

        #description{
          font-size: 20px;
        }

        #mmf{
          font-size: 60px;
        }

        #loginCard{
          width: 396px;
        }
      }

      @media (max-width: 576px){
        #mmf{
          font-size: 35px;
        }

        #loginCard{
          width: 295px;
        }

      }

      .lang_changer{
           position:absolute;
           top:0;
           right:0;
           padding: 20px;
           text-align: center;
      }
    </style>
      
  </head>
  <body>
      <div class="lang_changer">
        <h6><?=$this->lang->line('changeLang')?></h6>
        <select id="lang_changer">
          <?php $selected = $this->session->userdata('language'); ?>
          <option value="english" <?=($selected=='english')?'selected':''?> ><?=$this->lang->line('english')?></option>
          <option value="hindi" <?=($selected=='hindi')?'selected':''?> ><?=$this->lang->line('hindi')?></option>
        </select>
      </div>

      <div class="container"> 
        <div class="row" id="set1">
          <div class="col col-lg-6 col-xs-12 col-sm-12" id="nameLable">
            <p class="text-primary mb-1 " id="mmf" ><b> <?=$this->lang->line('title')?> </b></p> 
            <p class="text-dark" id="description"> <?=$this->lang->line('subTitle')?> </p>
          </div>
          <div class="col col-lg-6 col-xs-12 col-sm-12">

              <div class="" style="" id="loginCard">
              <div class="card-body">

                <form action="<?php echo base_url(); ?>login/authenticate" method="POST" autocomplete="off">
                    <?php
                        if(!empty( $this->session->flashdata('msg')))
                        {
                            echo '<div class="text-center alert alert-danger" >'.$this->session->flashdata('msg').'</div>';
                        }
                    ?>
                  <div class="mb-3">
                    <input type="text" class="form-control" id="loginEmailMobile" name="loginEmailMobile" placeholder="<?=$this->lang->line('emailPlaceholder')?>" required>
                    <?php echo '<div   class="text-danger " >'.form_error('email').'</div>'; ?>
                  </div>
                  <div class="mb-3">
                    <input type="password" class="form-control" id="loginPassword" name="loginPassword" placeholder="<?=$this->lang->line('passPlaceholder')?>" required>
                    <?php echo '<div   class="text-danger " >'.form_error('password').'</div>'; ?>        
                  </div>

                  <div class="d-grid gap-2">
                   <button type="submit" name="login" class="btn btn-primary btn-lg"><b><?=$this->lang->line('login')?></b></button>
                  </div>
                  <div class="text-center text-primary" style="margin: 16px 0px 16px 0px;">
                    <a href="<?php echo base_url().'login/forget_identify' ?>" style="text-decoration:none"><?=$this->lang->line('forgetPass')?></a>
                  </div>
                  <div class="border-top" style="margin: 20px 16px;" ></div>

                </form>

                <div class="text-center" style="margin: 15px 16px;" >
                   <button type="submit" style="background-color: #42b72a;" class="btn btn-lg text-light" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> <b><?=$this->lang->line('createNewAccount')?></b></button>
                </div>

              </div>

            </div>
          </div>
        </div>
      </div>


      <!-- Sign Up model -->

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <div class="modal-title" id="staticBackdropLabel">
              <h2 class="m-0"><b>Sign Up</b></h2>
              It's quick and easy.
            </div>
            
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
           <p class="text-center" id="message"></p>
            <form class="row g-3" id="signup_form">
              <div class="col-md-6">
                <input type="text"  class="form-control" id="signupFirstname" placeholder="First name" required>
                <p class="text-danger m-0 p-0" id="fname_error"></p>
              </div>
              <div class="col-md-6">
                <input type="text" class="form-control" id="signupSurname" placeholder="Surname" required>
                <p class="text-danger m-0 p-0" id="lname_error"></p>                
              </div>
              <div class="col-12">
                <input type="text" class="form-control" id="signupEmailMobileNo" placeholder="Mobile number or email address" required>
                <p class="text-danger m-0 p-0" id="email_mobile_error"></p>
              </div>
              <div class="col-12">
                <input type="password" class="form-control" id="signupPassword" placeholder="New password" required>
                <p class="text-danger m-0 p-0" id="password_error"></p>             
              </div>

              <label>Date of birth</label>
              <div class="col-md-4 mt-0">
                <select id="day" class="form-select dob">
                   <?php 
                      $mDate=1; 
                      while($mDate<32){ ?>
                  <option value="<?php echo $mDate ?>" <?php if($todayDate==$mDate) {echo "selected";} ?> ><?php echo $mDate?></option>
                    <?php  $mDate++; } ?>
                </select>
              </div>
              <div class="col-md-4 mt-0">
                <select id="month" class="form-select dob">
                 <?php foreach($month_names as $month){ ?>
                    <option value="<?php echo($month) ?>" <?php echo $month==$todayMonth ? "selected" : "" ?> ><?php echo $month; ?></option>
                    <?php }?>
                </select>
              </div>
              <div class="col-md-4 mt-0">
                <select id="year" class="form-select dob">
                  <?php 
                    $year=1905;
                    while($year<=$todayYear)
                      { ?>
                        <option value="<?php echo $todayYear ?>"  ?> <?php echo $todayYear ?> </option>    
                        <?php
                        $todayYear--; } ?>

                </select>
              </div>

              <label>Gender</label>

              <div class="col-md-4 d-flex mt-0 border border-2  p-1 ms-2 me-2" style="width: 145px"> 
                <label class="form-check-label ms-3 me-4" for="female">
                    Female
                </label>
                <div class="form-check">
                  <input class="form-check-input gender" name="gender" type="radio" id="female" value="Female">
                </div>
              </div>

              <div class="col-md-4 d-flex mt-0 border border-2 p-1 ms-2 me-2" style="width: 145px"> 
                <label class="form-check-label ms-3 me-4" for="male">
                    Male
                </label>
                <div class="form-check ">
                  <input class="form-check-input gender" name="gender" type="radio" id="male" value="Male">
                </div>
              </div>

              <div class="col-md-4 d-flex mt-0 border border-2 p-1 ms-2 " style="width: 145px"> 
                <label class="form-check-label ms-3 me-4" for="custom">
                    Custom
                </label>
                <div class="form-check">
                  <input class="form-check-input gender" name="gender" type="radio" id="custom" value="Custom">
                </div>
              </div>

              <div class="col-12 m-0">
                <p class="text-danger" id="gender_error"></p>    
              </div>

              <div class="col-12" id="selectPronoun" hidden>
                <select id="pronoun" class="form-select">
                  <option selected value="" disabled="1">Select your pronoun</option>
                  <option value="1">She: "Wish her a happy birthday!"</option>
                  <option value="2">He: "Wish him a happy birthday!"</option>
                  <option value="6">They: "Wish them a happy birthday!"</option>
                </select>
                <div class="form-text">Your pronoun is visible to everyone.</div>
              </div>

              


              <div class="col-12" id="genderOptional" hidden>
                <input type="text" class="form-control " id="" placeholder="Gender (optional)">
              </div>
            
            </form>

          <div class="text-center mt-4 ">
            <button type="button" name="signup" id="signup" class="btn text-light ps-5 pe-5" style="background-color: #00a400; "><b>Sign Up</b></button>
          </div>
          </div>
          
        </div>
      </div>
    </div>



    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url(); ?>src/js/signup_validation.js"></script>

    <script type="text/javascript">
      
      $(document).on('change', '#lang_changer', function(){
        var lang = $(this).val();
        // alert(lang);

        $.ajax('<?=base_url('Login/set_language')?>', {
            type: 'POST',  // http method
            data: { lang: lang },  // data to submit
            success: function (data, status, xhr) {
                // alert('status: ' + status + ', data: ' + data);
                location.reload();
            },
            error: function (jqXhr, textStatus, errorMessage) {
                    // aLast('Error' + errorMessage);
            }
        });

      });

    </script>

  </body>
</html>