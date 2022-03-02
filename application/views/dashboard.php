<style type="text/css">

	@media (min-width: 576px) {
  #dashboardDiv {
    width: 700px;
  }
  #postInput{
  	
  }
}

	
</style>

 <div class="container text-center" id="dashboardDiv">	
  	<div class="text-light my-4">
	  	<div class="input-group input-group-lg ">
	  		<a href="<?php echo base_url()."profile/index/".$userData['id'] ?>">
		  		<img class="border" style="border-radius: 50%" id="imagePreview" src="<?php echo isset($userData['profile_pic'])?base_url()."src/uploads/profilePic/".$userData['profile_pic']:'https://bit.ly/3g41HcM' ?>" alt="<?php echo $userData['first_name'] ?>" width="64px" height="64px">
		  	</a>
		  <input style="border-radius: 5% / 50%;" type="text" id="postInput" class="mx-1 form-control" aria-label="Sizing example input" placeholder="What's on your mind, <?php echo $userData['first_name']?>?" data-bs-toggle="modal" data-bs-target="#writePost" readonly>
		</div>
	</div> 
	 <?php
        if(!empty( $this->session->flashdata('msg')))
        {
            echo '<div class="flashMsg text-center alert alert-success" >'.$this->session->flashdata('msg').'</div>';
        }
    ?>
	<div class="text-light ">

<?php 

foreach ($posts as $key => $value) {
	$likerId = array(null);
	$likerId = explode(",", $value->liker_id);
	?>


		<div class="card bg-secondary bg-gradient mb-3 text-start my-2" style="border-radius: 5% / 5%;">
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
		    			<button class="btn btn-dark btnComment"><i class="fas fa-comment p-1"></i> Comment</button>
		    		</div>
		    </div>
		    
		    <div class="all_comments" style="background-image: linear-gradient(to right, rgba(255,0,0,0), rgba(0,0,0,255)); border-radius: 5%;" hidden>
		    	<hr>
		    	<div class="d-flex justify-content-center">
		  			<a  href="<?php echo base_url()."profile/index/".$value->writer_id ?>">
				  		<img class="border" style="border-radius: 50%" id="imagePreview" src="<?php echo !empty($value->writer_dp)?base_url()."src/uploads/profilePic/".$value->writer_dp:'https://bit.ly/3g41HcM' ?>" alt="<?php echo $value->writer_name ?>" width="36px" height="36px">
				  	</a>
				  	<div class="px-2">
				  		<a href="<?php echo base_url()."profile/index/".$value->writer_id ?>" class="my-0 text-light " style="text-decoration: none;"><?php echo $value->writer_name ?></a>
			  			<p class="card-text mb-2"><small>Such a nice post.</small></p>
				  	</div>
		  		</div>
		  		<form class="commentForm" action="<?php echo base_url('post/write_comment') ?>">
			  		<div class="d-flex">
			  			<input type="hidden" name="post_id" value="<?php echo $value->id ?>">
			  			<input type="hidden" name="author_id" value="<?php echo $userData['id'] ?>">
			  			<input type="text" class="form-control content" name="content" placeholder="Write a comment..."  required>
			  			<button type="submit" class="btn btn-dark"><i class="fas fa-arrow-left"></i></button>
			  		</div>
		  		</form>
		    </div>
		  </div>
		</div>

<?php } ?>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="writePost" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title " id="exampleModalLabel">Create Post</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

	  		<div class="d-flex">
	  			<a href="<?php echo base_url()."profile/index/".$userData['id'] ?>">
			  		<img style="border-radius: 50%" id="imagePreview" src="<?php echo isset($userData['profile_pic'])?base_url()."src/uploads/profilePic/".$userData['profile_pic']:'https://bit.ly/3g41HcM' ?>" alt="<?php echo $userData['first_name'] ?>" width="36px" height="36px">
			  	</a>
			  	<h6 class="p-2"><?php echo $userData['first_name']." ".$userData['last_name'] ?></h6>
	  		</div>
	  		<form action="<?php echo base_url()."post/write_post/".$userData['id'] ?>" method="post" enctype="multipart/form-data">
		  		<div class="my-2">
				  <textarea class="form-control" style="border-width: 0px; height: 150px" name="postContent" id="postContent" placeholder="What's on your mind, <?php echo $userData['first_name']?>?" id="floatingTextarea2" ></textarea>

				  <div class="mt-2" style="position: relative;">
				 	  <button type="button" id="imageClose" class="btn-close bg-secondary" style="right:4px; top:4px; position: absolute;"  aria-label="Close" hidden></button>
					  <img class="img-fluid img-thumbnail" id="postImagePreview">
				  </div>

				  <input type="file" name="postPhoto" id="postPhoto" hidden/>
				  <label id="" class="btn btn-outline-primary my-2" for="postPhoto">Add Photo</label>
				</div>
	        	
		      <div class="d-grid gap-2">
		        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
		        <button type="submit" id="submitPost" class="btn btn-primary" disabled>Post</button>
		      </div>
		    </form>
      </div>
    </div>
  </div>
</div>

   <!-- Option 1: Bootstrap Bundle with Popper -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script type="text/javascript">
  	$(document).ready(function(){
  		var toggleHidden = false;

  		$('.btnComment').click(function(){ 			
  			if(toggleHidden == false ){
  				$(this).closest('.card-body').find('.all_comments').removeAttr('hidden'); 
  				toggleHidden = true;
  			}else{
  				$(this).closest('.card-body').find('.all_comments').attr('hidden',true); 
  				toggleHidden = false;
  			}
  		});

  	});

    $(".commentForm").on("submit", function(event){
        event.preventDefault();
			  url = $(this).attr('action');

        var formValues= $(this).serialize();
 				$('.content').val("");

        $.post(url, formValues, function(data){
            // Display the returned data in browser

            console.log(data);
        });



    });

  </script>

	<script type="text/javascript">
		$(document).ready(function(){

		  $('#imageClose').click(function(){
		    $('#imageClose').attr('hidden',true);
			$('#submitPost').attr("disabled",true);
		  	$('#postImagePreview').attr("src", "");
		  	$("#postPhoto").val('');

		  });

	      function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();
		        reader.onload = function(e) {
		           $('#imageClose').removeAttr('hidden');
					$('#submitPost').removeAttr("disabled");
		           $('#postImagePreview').attr("src", e.target.result);
		        };
		        reader.readAsDataURL(input.files[0]);
		    }
		}
		$("#postPhoto").change(function() {
		    readURL(this);
		});

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

			 $(".flashMsg").delay(3000).slideUp("slow");

			$('#postContent').keyup(function(){
				//console.log($(this).val());
				if($(this).val())
				{
					$('#submitPost').removeAttr("disabled");
				}else{
					$('#submitPost').attr("disabled",true);
				}
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


  </body>
</html>

