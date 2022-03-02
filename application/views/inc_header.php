<?php
//$userData = $this->session->userdata('userData');
$noOfrequest  = array();
  if(!$userData['friend_request_id'] == "")
  {
    $noOfrequest = explode(",", $userData['friend_request_id']);
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="icon" type="image/png" sizes="180x180" href="images/favicons/apple-touch-icon.png"> -->

  <link rel="stylesheet" href="<?php echo base_url(); ?>src/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">


    <link rel="stylesheet" type="text/css" href="">

    <title>Meet My Friend - Dashboard</title>

<script type="text/javascript" src="https://momentjs.com/downloads/moment.js"></script>
<script>
    var is_header_messanger = false;
    var head_msg_parent = "";

</script>
    <style type="text/css">

      @media (min-width: 576px) {
          .mainItem {
            width: 100px;
          }
        }
      
    </style>
  </head>
  <body class="bg-dark">	
<header style="margin-bottom: 80px">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom border-light fixed-top">
      <div>
        <div id="google_translate_element"></div>

        <script type="text/javascript">
        function googleTranslateElementInit() {
          new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
        }
        </script>

    </div>

       <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo base_url() ?>">
          <img  src="<?php echo base_url() ?>src/images/favicons/apple-touch-icon.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
          Meet My Friend
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
<!--           <form class="d-flex bg-dark">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form> -->

          <ul class="navbar-nav text-center mx-auto mb-2 mb-lg-0 ">
            <li class="nav-item mainItem" >
              <a class="nav-link <?php echo ($currentPage == "home")?"border-bottom border-primary text-primary border-3":"" ?> " aria-current="page" href="<?php echo base_url() ?>"><i class="fas fa-home fa-2x"></i></a>
            </li>
            <li class="nav-item mainItem" >
              <a class="nav-link <?php echo ($currentPage == "friends")?"border-bottom border-primary text-primary border-3":"" ?>" href="<?php echo base_url() ?>friend"><i class="fas fa-users fa-2x"></i></a>
            </li>
            <li class="nav-item mainItem" >
              <a class="nav-link  <?php echo ($currentPage == "friend_requests")?"border-bottom border-primary text-primary border-3":"" ?>" href="<?php echo base_url() ?>friend/friend_requests"><i class="fas fa-user-plus fa-2x"></i><span class="badge bg-light text-dark"><?php echo (!count($noOfrequest) == 0)?count($noOfrequest):""; ?></span></a>
            </li>
            <li class="nav-item mainItem" >
              <a class="nav-link <?php echo ($currentPage == "user_friends")?"border-bottom border-primary text-primary border-3":"" ?>" href="<?php echo base_url() ?>friend/user_friends"><i class="fas fa-user-friends fa-2x"></i></a>
            </li>
          </ul>

          <ul class="navbar-nav mb-2 mb-lg-0 text-center">
            <li class="nav-item " >
              <a class="nav-link  <?php echo $currentPage == "profile".$userData['id']?"border-bottom border-primary text-primary border-3":"text-light" ?> " href="<?php echo base_url().'profile/index/'.$userData['id'] ?>"> 
                <img style="border-radius: 50%;" class="rounded-circle" width="36px" height="36px" src="<?php echo isset($userData['profile_pic'])?base_url()."src/uploads/profilePic/".$userData['profile_pic']:'https://bit.ly/3g41HcM' ?>" alt="<?php echo $userData['first_name'] ?>">
                <b ><?php echo $userData['first_name']; ?></b> </a>
            </li>
            <li class="nav-item  p-2" >
              <a class="nav-link  text-light" href="#"><i class="fas fa-ellipsis-v fa-1x"></i></a>
            </li>
            <li class="nav-item p-2 dropdown" id="headerMessanger" >
              <a class="nav-link text-light dropdown-toggle" id="messangerDropdown" data-bs-toggle="dropdown" aria-expanded="false"><i class="fab fa-facebook-messenger fa-1x"></i></a>

              <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-lg-end" aria-labelledby="messangerDropdown" id="msgReceived" style="height: 400px; width: 250px; overflow-y: auto;">
                
                        
                      
              </ul>

            </li>
            <li class="nav-item p-2" >
              <a class="nav-link text-light" href="#"><i class="fas fa-bell fa-1x"></i></a>
            </li>
            <li class="nav-item p-2 dropdown " >
              <a class="nav-link text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-sort-down fa-1x"></i></a>
              <ul class="dropdown-menu dropdown-menu-lg-end" >
                <li><a class="dropdown-item" href="<?php echo base_url() ?>login/logout">Log out</a></li>
              </ul>
            </li>
          </ul>


          
        </div>
      </div>
    </nav>
</header>

