<?php
  // echo "<pre>";
  // print_r($user_data);
  // exit;
 //date_default_timezone_set("Asia/Kolkata");
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">User List </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Users List </li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-12">
            <div class="card">
              <div class="card-header">

              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table my-2" id="userdata_table">
                  <thead>
                    <tr>
                      <th style="width: 25px">#</th>
                      <th>User Name</th>
                      <th>Email Address</th>
                      <th>Mobile Number</th>
                      <th>DOB</th>
                      <th>Gender</th>
                      <th>Created At</th>
                      <th>Active/Inactive</th>
                    </tr>
                  </thead>
                  <tbody>

<?php 
$n=1;
foreach ($user_data as $key => $value) { ?>
                   <tr>
                      <td><?php echo $n; ?></td>
                      <td><?php echo $value->first_name." ".$value->last_name; ?></td>
                      <td><?php echo $value->email; ?></td>
                      <td><?php echo $value->mobile_number; ?></td>
                      <td><?php echo $value->dob; ?></td>
                      <td><?php echo $value->gender; ?></td>
                      <td class="created_at"><?php echo date('c',$value->created_at); ?></td>
                      <td><input class="status" id="<?php echo $value->id; ?>" type="checkbox" <?php echo ($value->status==1)?'checked':''; ?> data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger"></td>
                    </tr>
<?php $n++;} ?>


                  
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
      </div>

  </div>
</div>
  <!-- /.content-wrapper -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>


<script type="text/javascript" src="https://momentjs.com/downloads/moment.js"></script>

<!-- <script type="text/javascript" src="https://momentjs.com/downloads/moment-timezone-with-data.js"></script>
 -->
<script type="text/javascript">
$(document).ready(function(){

$('.created_at').each(function(){
  $date = $(this).html();

  $mydate =  moment.parseZone($date).local().format('lll');

  $(this).html($mydate);

});

$('#userdata_table').DataTable( {
      "pagingType": "first_last_numbers"
    } );

$('.status').change(function(){

  var userid = $(this).prop('id');

  if($(this).prop("checked") == true)
  {
    var checked = 1;
  }else{
    var checked = 0;
  }

  $.ajax({
    url  :"<?php echo base_url('admin/home/user_status_change') ?>",
    type : 'POST',
    data : {userid:userid,checked:checked},
    
  });


});

  
});
</script>
