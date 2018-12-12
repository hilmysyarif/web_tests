<div class="jumbotron mt-4">
  <p class="lead">Here a lists of users.</p>
  <hr class="my-4">
  <span class="text-muted">
  	<b>Menu :</b>
  </span>
  <p class="lead pt-2">
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
	  Create User
	</button>
  </p>
  <div class="table-responsive">
  		<div id="alert-form"></div>
	  	<table class="table table-condensed">
		    <thead>
		      <tr>
		        <th>Username</th>
		        <th>E-mail</th>
		        <th>Image</th>
		      </tr>
		    </thead>
		    <tbody>

				<?php if( ! empty($users)){ // Jika data pada database tidak sama dengan empty (alias ada datanya)
				  foreach($users as $data){ // Lakukan looping pada variabel gambar dari controller
				    echo "<tr>";
				    echo "<td>".$data->username."</td>";
				    echo "<td>".$data->email."</td>";
				    echo "<td><img src='".base_url("assets/images/".$data->image)."' width='100' height='100'></td>";
				    echo "</tr>";
				  }
				}else{ // Jika data tidak ada
				  echo "<tr><td colspan='5'>Data tidak ada</td></tr>";
				} ?>

		    </tbody>
  		</table>
</div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create new user</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="user-create" action="/api/user" method="post" enctype="multipart/form-data" class="form-horizontal">
        	<div class="flex">
			 <!--- For username ---->
		        <div class="col-sm-12">
					<div class="flex">

					 <div class="col-xs-8">
					     <input type="text" name="username" id="username" placeholder="Enter your Username" class="form-control required" required>
						</div>
					</div>
				</div>
				 	
		     <!-----For email---->
				<div class="col-sm-12">
					<div class="flex pt-3">

					 	<div class="col-xs-8">
					     	<input type="text" name="email" id="email" placeholder="Enter your E-mail" class="form-control required" required>
						</div>
					</div>
				</div>
			 <!-----For Image---->
				<div class="col-sm-12">
					<div class="flex pt-3">

					 	<div class="col-xs-8">
					     	<input type="file" name="file" id="file" class="form-control required" />
						</div>
					</div>
				</div>

			 <!-----For Note---->
				<div class="col-sm-12">
					<div class="flex pt-3">

					 	<div class="col-xs-8">
					     	<textarea type="text" name="note" id="note" class="form-control required" readonly>Note</textarea>
						</div>
					</div>
				</div>

			</div>	 

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="javascript:void(0);" class="btn btn-send btn-primary">Save changes</a>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

	$('#username').bind("keyup", function() {


	    $.ajax({
	           type: "GET",
	           url: "api/user",
	           data: {username: $('#username').val()},
	           success: function(output){
	           		if(output.status == false){
	           	  		$('#note').val('TRUE');
	           	  	}else{
	           	  	 	$('#note').val('FALSE');
	           	  	
	           		}
	           }
	    });
	});

	$(document).ready(function(){
	    $('.btn-send').click(function(e){
	        e.preventDefault(); 
	             $.ajax({
	                 url:'<?php echo base_url();?>api/user',
	                 type:"post",
	                 data:new FormData($("#user-create")[0]),
	                 processData:false,
	                 contentType:false,
	                 cache:false,
	                 async:false
	             });
                $("#alert-form").html('Successfully create user!'); 
                $("#alert-form").addClass("alert alert-success");
                $( "#exampleModal" ).modal( 'hide' );


	        });
	 });
</script>