<?php
	//echo "<pre>"; print_r($userData); exit;
?>	
<style type="text/css">

	@media (min-width: 576px) {
	  #mainDiv {
		    width: 700px;
		  }
		}

	
</style>
  

  	<div class=" container text-center text-light mt-4" id="mainDiv">
  		<h1 class="p-4">Meet new friends</h1>
  		<table class="table  text-light  table-hover">
  			 <tbody>
 	<?php 
 		$userFRSid = explode(",", $userData['friend_request_send_id']);
 		$userFRid = explode(",", $userData['friend_request_id']);
 		
 		foreach ($allUsers as $key => $value) {
 			$profileFriendsId = explode(",", $value->friends_id);

 			if( !in_array($userData['id'], $profileFriendsId)&& !in_array($value->id, $userFRid) && !($userData['id']==$value->id) )
 			{
 			?>
 			
		 		<tr class="align-middle">
			      <td width="140px">
			      	<a href="<?php echo base_url()."profile/index/".$value->id ?>">
			      		<img style="border-radius: 50%" id="imagePreview" src="<?php echo isset($value->profile_pic)?base_url()."src/uploads/profilePic/".$value->profile_pic:'https://bit.ly/3g41HcM' ?>" alt="<?php echo $value->profile_pic ?>" width="64px" height="64px">
			      	</a>
			      </td>
			      <td class="text-start" id="<?php echo $value->id; ?>">
			      	<a href="<?php echo base_url()."profile/index/".$value->id ?>" class="text-light" style="text-decoration: none;">
			      		<?php echo $value->first_name." ".$value->last_name; ?>
			      	</a>
			      </td>
			      <td class="text-end">
			      	<div class=" row">
				      	<div class="p-2  text-right">
				      		<?php if( in_array($value->id, $userFRSid) ){ ?> 
				      			<div class="dropdown">
									<a style="width: 130px" href="#" class=" btn btn-primary dropdown-toggle" id="pending" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fas fa-clock"></i> 
									Pending</a>
									<ul class="dropdown-menu" aria-labelledby="pending">
									    <li><a href="<?php echo base_url('friend/cancel_friend_request/').$value->id ?>" class="dropdown-item" >Cancel Request</a></li>
									</ul>
								</div>
							<?php }
								  else{?>
								  <a style="width: 130px" href="<?php echo base_url()."friend/send_friend_request/".$value->id; ?>" class=" btn btn-primary"> <i class="fas fa-user-plus"></i> 
								Add Friend</a>
							<?php } ?>
						</div>
						<div class="p-2 ">
							<a style="width: 130px" class=" btn btn-secondary messageBtn" data-bs-toggle="modal" data-bs-target="#messageOpen"><i class="fab fa-facebook-messenger p-1"></i>Message</a>
						</div>
					</div>

			      </td>
			    </tr>


 	<?php }
 		$profileFriendsId = "";
 	}
 	 ?>
			 </tbody>
		</table>
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


  </body>
</html>

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
		       // console.log(obj.length);
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
	 	var parents = $(this).parents();

	 	friend_name = parents[3].children[1].children[0].innerText;
	 	friend_img = parents[3].children[0].children[0].children[0].currentSrc;
	 	friend_id  = parents[3].children[1].id;

	 	$('#recieverName').html(friend_name);
	 	$('#recieverPic').prop( "src", friend_img);
	 	$('#recieverId').val(friend_id);

	 	dynamicMessages();

		//console.log(parents);
	});

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