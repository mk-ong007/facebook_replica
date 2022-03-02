
<style type="text/css">
#circleImg{
  display: inline-block;
  background-color: black;
  color: white;
  padding: 0.5rem;
  font-family: sans-serif;
  border-radius: 0.3rem;
  cursor: pointer;
  margin-top: 1rem;
}

#imagePreview {
  border-radius: 50%;
}

</style>

<style type="text/css">

	@media (min-width: 576px) {
  #postDiv {
    width: 700px;
  }
}

	
</style>
 <div class="container-xxl ">
  <div class="card bg-dark text-light " >

    <div class="card-body text-center">

	  <div class="pb-2">
	  	<form enctype="multipart/form-data">
	  		 <img id="imagePreview" src="<?php echo isset($profileData['profile_pic'])?base_url()."src/uploads/profilePic/".$profileData['profile_pic']:'https://bit.ly/3g41HcM' ?>" alt="<?php echo $profileData['first_name'] ?>" width="128px" height="128px"> <br>
			<?php
				if($userData['id'] == $profileData['id']){?>
					<input type="file" name="profile_image" id="upload" hidden/>
					<input type="hidden" id="profileId" name="profileId" value="<?php echo $profileData['id'] ?>">
					<label id="circleImg" for="upload">Upload profile pic</label>
			<?php }
			?>
		</form>
	  </div>



		<div>      
			<h1 class="card-title pb-2"><?php echo ucfirst($profileData['first_name'])." ".ucfirst($profileData['last_name']);  ?></h1>
		</div>



     	<div class="mb-2 border-bottom border-secondary"></div>
      


     	<div class="justify-content-center d-flex">
     	<?php 
     	$user_frs_id = explode(",", $userData['friend_request_send_id']);
     	$userFRid = explode(",", $userData['friend_request_id']);
     	$userFid = explode(",", $userData['friends_id']);
     	//print_r($user_frs_id );  exit();

     	if($profileData['id'] == $userData['id']) 
     		{?>
     			<div class="p-2">
					<a class=" btn btn-secondary" data-bs-toggle="modal" data-bs-target="#editProfile"><i class="fas fa-edit p-1"></i>
					Edit Profile</a>
				</div>

			<?php
			}elseif (in_array($profileData['id'], $userFid)) {
			?>
				<div class="p-2 dropdown">
					<a style="width: 130px" href="#" class=" btn btn-info dropdown-toggle" id="friends" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fas fa-user-friends"></i> 
					Friends</a>
					<ul class="dropdown-menu" aria-labelledby="friends">
						<li><a href="<?php echo base_url('friend/unfriend/').$profileData['id'] ?>" class="dropdown-item" >Unfriend</a></li>
					</ul>
				</div>
				<div class="p-2">
					<a style="width: 130px" class=" btn btn-secondary messageBtn" data-bs-toggle="modal" data-bs-target="#messageOpen" ><i class="fab fa-facebook-messenger p-1"></i>Message</a>
				</div>
			<?php
			}elseif (in_array($profileData['id'], $user_frs_id)) {
			?>
				<div class="p-2 dropdown">
					<a style="width: 130px" href="#" class=" btn btn-primary dropdown-toggle" id="pending" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fas fa-clock"></i> 
					Pending</a>
					<ul class="dropdown-menu" aria-labelledby="pending">
					    <li><a href="<?php echo base_url('profile/cancel_friend_request/').$profileData['id'] ?>" class="dropdown-item" >Cancel Request</a></li>
					</ul>
				</div>
				<div class="p-2">
					<a style="width: 130px" class=" btn btn-secondary messageBtn" data-bs-toggle="modal" data-bs-target="#messageOpen" ><i class="fab fa-facebook-messenger p-1"></i>Message</a>
				</div>
     		<?php 
     		}else {
     				if(!in_array($profileData['id'], $userFRid) ){?>
		     			<div class="p-2">
							<a href="<?php echo base_url()."profile/send_friend_request/".$profileData['id']; ?>" class=" btn btn-primary"> <i class="fas fa-user"></i> 
							Add Friend</a>
						</div>
     			<?php }
     				else{?>
     					<div class="p-2 dropdown">
							<a style="width: 130px" href="#" class=" btn btn-info dropdown-toggle" id="confirm" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fas fa-plus"></i> 
							Confirm</a>
							<ul class="dropdown-menu" aria-labelledby="confirm">
								<li><a href="<?php echo base_url('friend/confirm_request/').$profileData['id'] ?>" class="dropdown-item" >Accept</a></li>
							    <li><a href="<?php echo base_url('friend/delete_request/').$profileData['id'] ?>" class="dropdown-item" >Delete</a></li>
							</ul>
						</div>
     			<?php }
     			?>

     			
				<div class="p-2">
					<a style="width: 130px" class=" btn btn-secondary messageBtn" data-bs-toggle="modal" data-bs-target="#messageOpen" ><i class="fab fa-facebook-messenger p-1"></i>Message</a>
				</div>
     	<?php }
     		?>
			
     	</div>

<div class="mx-auto" id="postDiv">
     		
     		<?php 

foreach ($userPost as $key => $value) {
	$likerId = array(null);
	$likerId = explode(",", $value->liker_id);
	?>


		<div class="card bg-secondary mb-3 text-start my-2" style="border-radius: 5% / 5%;">
		  <!-- <img src="..." class="card-img-top" alt="..."> -->
		  <div class="card-body">
		    <div class="card-title d-flex">
	  			<a  href="<?php echo base_url()."profile/index/".$value->writer_id ?>">
			  		<img class="border" style="border-radius: 50%" id="imagePreview" src="<?php echo !empty($value->writer_dp)?base_url()."src/uploads/profilePic/".$value->writer_dp:'https://bit.ly/3g41HcM' ?>" alt="<?php echo $value->writer_name ?>" width="42px" height="42px">
			  	</a>
			  	<div class="px-2">
			  		<a href="<?php echo base_url()."profile/index/".$value->writer_id ?>" class="my-0 text-light h6" style="text-decoration: none;"><?php echo $value->writer_name ?></a>
		  			<p class="card-text "><small class="created_at"><?php echo date('c',$value->created_at); ?></small></p>
			  	</div>
	  		</div>

		    <p class="card-text"><?php echo $value->post_content; ?></p>
		    <!-- <img class="img-fluid img-thumbnail"  src="<?php echo base_url('src/uploads/profilePic/0c3727685c0ed70e266f6fbedd11c668.jpg') ?>"> -->
		    <hr>
		    <div class="d-flex justify-content-center gap-2 ">
		    		<div class="">
		    			<input type="checkbox" class="btn-check like" id="<?php echo $value->id; ?>"  <?php echo in_array($userData['id'], $likerId)?"checked":""; ?>  autocomplete="off">
						<label class="btn like_label <?php echo in_array($userData['id'], $likerId)?'btn-dark text-danger':'btn-outline-dark' ?> " for="<?php echo $value->id; ?>"><i class="fas fa-heart p-1"></i><i class="like_num"><?php echo ($value->likes==0)?'':$value->likes; ?></i> Like</label>
		    		</div>
		    		<div class="">
		    			<a href="" style class="btn btn-dark "><i class="fas fa-comment p-1"></i> Comment</a>
		    		</div>
		    </div>
		  </div>
		</div>

<?php } ?>

     	</div>
			


    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="editProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit profile here</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="editForm" action="<?php echo base_url('profile/profile_edit/').$profileData['id'] ?>" method="POST">
	      <div class="modal-body">

	      	  <p id="formError" class=""></p>
	      	  <div class="mb-2">
			    <label for="first_name" class="form-label">First name</label>
			    <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $profileData['first_name'] ?>">
			  </div>
			  <div class="mb-2">
			    <label for="last_name" class="form-label">Last name</label>
			    <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $profileData['last_name'] ?>">
			  </div>
		      <div class="mb-2">
			    <label for="email_address" class="form-label">Email address</label>
			    <input type="email" class="form-control" id="email_address" name="email_address" value="<?php echo $profileData['email'] ?>" aria-describedby="emailHelp">
			  </div>
			  <div class="mb-2">
			    <label for="mobile_number" class="form-label">Mobile Number</label>
			    <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="<?php echo $profileData['mobile_number'] ?>" aria-describedby="mobileHelp">
			  </div>
			  <div class="mb-2">
			    <label for="dob" class="form-label">DOB</label>
			    <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $profileData['dob'] ?>" aria-describedby="dobHelp">
			  </div>
			  
			  
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Save changes</button>
	      </div>
      </form>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade " id="messageOpen" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-secondary">
      <div class="modal-header">
        <div class="modal-title d-flex" id="staticBackdropLabel">
	  			<a href="">
			  		<img class="border" style="border-radius: 50%" id="recieverPic" src="https://bit.ly/3g41HcM" alt="" width="42px" height="42px">
			  	</a>
			  	<div class="px-2">
			  		<a href="" class="my-0 text-light h6" id="recieverName" style="text-decoration: none;">Name here</a>
		  			<!-- <p class=""><small class="created_at"></small></p> -->
			  	</div>
		</div>
        <button type="button" class="btn-close" id="msgModelClose" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    <form id="message_form" autocomplete="off">
      <div class="modal-body" id="mainMsgBox" style="height: 400px; overflow-y: auto; scroll-behavior: ">
          <div class="align-middle" id = "messageBox" style="">
          	<!-- messages here -->
          	 <p class="text-center text-light ">say hello 👋...</p>
		  </div>
      </div>
      <div class="modal-footer input-group">
      	<input type="hidden" name="recieverId" id="recieverId">
		<input type="text" name="messsage" id="messsage" class="form-control" placeholder="Write your messsage here..">
        <button type="submit" class="btn btn-dark" id="sendMsg" > <i class=""></i> Send</button>
      </div>
    </form>
    </div>
  </div>
</div>

   <!-- Option 1: Bootstrap Bundle with Popper -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
	$(document).ready(function () {
		let timer;
		var oldLength = 0;
		var msgScroll = false;
		$('#msgModelClose').click(function(){
			$('#messageBox').html("");
			$('#messageBox').html("<p class='text-center text-light'>say hello 👋...</p>");
			clearTimeout(timer);		
			oldLength = 0;
		});

		function dynamicMessages()
		{
			var userid = "<?php echo $userData['id'] ?>";
			$.ajax({
		      type: "POST",
		      url: "<?php echo base_url() ?>message/index",
		      data: {recieverId: $("#recieverId").val()},
		      encode: true,
		    }).done(function (data) {

		       var obj = jQuery.parseJSON(data);
		       //console.log(obj);
		       if(obj.length > oldLength)
		       {
		       	// console.log("hii");
		       	oldLength = obj.length;
		       	msgScroll = true;
		    	$('#messageBox').html("");

		       	$.each(obj, function(key,value) {
				  //console.log((value.created_at));
				  	if( value.sender_id == userid)
			      	{
			      		$('#messageBox').html($('#messageBox').html()+"<div class='text-end my-4'><span class='text-dark bg-light px-3 py-2' style='border-radius: 50px 0px 50px 20px '>"+ value.message +"</span></div>");
			      	}

			      	if( value.receiver_id == userid )
			      	{
			      		$('#messageBox').html($('#messageBox').html()+"<div class='text-start my-4'><span class='text-dark bg-light px-3 py-2' style='border-radius: 0px 50px 30px; '>"+ value.message +"</span></div>");
			      	}
				});
		       }
		       
			    timer = setTimeout(dynamicMessages, 500);

			    //$("#mainMsgBox").scrollTop($("#mainMsgBox").scrollHeight());
		    });


		    if(msgScroll)
		    {
				// console.log($('#mainMsgBox')[0].scrollHeight);
				$("#mainMsgBox").animate({ scrollTop: $('#mainMsgBox')[0].scrollHeight }, "fast");
		    	msgScroll = false;
		    }
		}


	  $("#message_form").submit(function (event) {
	  	
	    var formData = {
	      recieverId: $("#recieverId").val(),
	      messsage: $("#messsage").val(),
	    };

	    //console.log(formData);
	    $.ajax({
	      type: "POST",
	      url: "<?php echo base_url() ?>message/send_message",
	      data: formData,
	      encode: true,
	    }).done(function (data) {
	      //console.log(data);
	      $("#messsage").val('');
	      $('#messageBox').html('');
	  	  dynamicMessages();
	    });
	    event.preventDefault();
	  });

	$('.messageBtn').click(function(){

		var profileName = "<?php echo ucfirst($profileData['first_name']).' '.ucfirst($profileData['last_name']);  ?>";
		var profilePic = "<?php echo $profileData['profile_pic']?base_url().'src/uploads/profilePic/'.$profileData['profile_pic']:'https://bit.ly/3g41HcM'; ?>";
		var profileId = "<?php echo $profileData['id']; ?>";
	 	
	 	$('#recieverName').html(profileName);
	 	$('#recieverPic').prop( "src", profilePic);
	 	$('#recieverId').val(profileId);

	 	dynamicMessages();

		//console.log(parents);
	});

	});
	


</script>


	<script>

		function likeSolve(like)
			{	
				var postId = $(like).prop("id")
				if($(like).prop("checked") == true)
				{
					$(like).val(1);
				}else{
					$(like).val(0);
				}

				$.ajax({
					type:'POST',
					url : "<?php echo base_url('post/post_like') ?>",
					data: { postId: postId,
							like:   $(like).val() },
					success: function(data){
						// console.log(data);
						var like_num = $(like).next(".like_label").children(".like_num");
						if(data == "liked")
						{
							$(like).next(".like_label").addClass('btn-dark text-danger');
							like_num.html(Number(like_num.html())+1);

						}else if(data == "disliked")
						{
							$(like).next(".like_label").removeClass('btn-dark text-danger');
							$(like).next(".like_label").addClass('btn-outline-dark');
							if(like_num.html() == 1)
							{
								like_num.html("");
							}else{
								like_num.html(Number(like_num.html())-1);
							}
						}
					}
				});
			}

			$('.like').click(function(){
				likeSolve(this);
			});
			//likeSolve();

			$('.created_at').each(function(){
				$(this).html(moment.parseZone($(this).html()).local().calendar());
			});

		$("#editForm").submit(function(e){

			e.preventDefault();
			var form = $(this);
		    var url = form.attr('action');
		    
		    $.ajax({
		           type: "POST",
		           url: url,
		           data: form.serialize(), // serializes the form's elements.
		           success: function(data)
		           {
		           		if(data==1)
		           		{
		           			$('#formError').removeClass("alert-danger");
		           			$('#formError').addClass("alert-success");
		           			$('#formError').html("Profile updated successfully.");
		           		}
		           		else
		           		{
		           			$('#formError').removeClass("alert-success");
		           			$('#formError').addClass("alert-danger");
		           			$('#formError').html(data);
		           		}
		           }
		         });

		});

        function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();
		        reader.onload = function(e) {
		        	var uploadurl = "<?php echo base_url().'profile/profile_pic_update' ?>"; 

		            var fd = new FormData();
    			    var files = $('#upload')[0].files;

        
		            fd.append('profile_image',files[0]);
		            fd.append('id', $('#profileId').val());
				    $.ajax({
						url: uploadurl,
						type: "POST",
						cache: false,
		                contentType: false,
		                processData: false,
						data: fd,
			             success: function(response){
			             	console.log(response);
			                 if(response != 0){
			                    $("#imagePreview").attr("src",response); 
			                    $('#imagePreview').hide();
		          				$('#imagePreview').fadeIn(650);
			                 }else{
			                    alert('file not uploaded');
			                 }
			              },
					});

		          //  $('#imagePreview').attr("src", e.target.result);
		            
		        };
		        reader.readAsDataURL(input.files[0]);
		    }
		}
		$("#upload").change(function() {
		    readURL(this);
		});
    </script>

    <script type="text/javascript">
  $(document).ready(function(){
  	var toggleMessanger = false; 

    $('#headerMessanger').click(function(){
      
      if(toggleMessanger == false)
      {
      	$.ajax({
        type : 'POST',
        url  : "<?php echo base_url('message/headerMessanger') ?>",
        encode: true,
        }).done( function (data){

        	// console.log(data);
          var obj = jQuery.parseJSON(data);

          $.each(obj, function(key,value) {

          	$('#msgReceived').html($('#msgReceived').html()+"<li><div class='dropdown-item'><div class='d-flex'><a  href=''><img style='border-radius: 50%' id='' src="+ value.friend_dp +" alt='' width='42px' height='42px'></a><div class='px-2 text-start'><a style='text-decoration: none;' href='' class='my-0 text-light ' >"+ value.friend_name +"<br><small>"+ value.message +"</small></a></div></div><hr></div></li>");

          	
          });

        });
        toggleMessanger = true;
      }
      else{
      	$('#msgReceived').html("");
        toggleMessanger = false;
      }

      });

    });
</script>


  </body>
</html>


