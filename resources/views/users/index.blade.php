<!DOCTYPE html>
<html>
<head>
	<title>User Management</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<div class="container-fluid">

		<div class="row">
			<div class="col-lg-12">
				<div>
					<!-- Button trigger modal -->
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create-user-modal">
					  Create a user
					</button>
				</div>
				<div id="success-delete"></div>
				<div id="search">
					<form method="POST" action="/users">
						@csrf
						<label>Age</label>
						<select name="age">
							<option value=''>All</option>
						</select>
						<label>Weight</label>
						<select name="weight">
							<option value=''>All</option>
						</select>

						<input type="submit" name="search">
					</form>
				</div>				
			</div>
			<!-- print table here -->
			<div class="col-lg-12" id="user-table">
				
			</div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="create-user-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Create a user</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
			<form id="create-user-form">
				<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Name</label>
				  <input type="text" class="form-control" id="new_name" placeholder="Name" name="name" value="">
				</div>
				<div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">Email</label>
				  <input type="email" class="form-control" id="new_email" placeholder="Email" name="email" >
				</div>
				<div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">Age</label>
				  <input type="number" class="form-control" id="new_age" placeholder="Age" name="age" value="" min="5" max="100">
				</div>
				<div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">Weight</label>
				  <input type="number" class="form-control" id="new_weight" placeholder="Weight" name="weight" value="">
				</div>
			</form>
	      </div>
	      <div class="modal-footer" id="new-user-form">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary" id="create_user">Submit</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- update modal -->
	<div class="modal fade" id="update-user-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Create a user</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
			<form id="update-user-form">
				<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Name</label>
				  <input type="text" class="form-control" id="update_name" placeholder="Name" name="name" value="">
				</div>
				<div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">Email</label>
				  <input type="email" class="form-control" id="update_email" placeholder="Email" name="email" >
				</div>
				<div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">Age</label>
				  <input type="number" class="form-control" id="update_age" placeholder="Age" name="age" value="" min="5" max="100">
				</div>
				<div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">Weight</label>
				  <input type="number" class="form-control" id="update_weight" placeholder="Weight" name="weight" value="">
				</div>
				<input type="hidden" class="form-control" id="update_id" name="id" value="">
			</form>
	      </div>
	      <div class="modal-footer" id="update-submit-form">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary" id="update_user">Submit</button>
	      </div>
	    </div>
	  </div>
	</div>


</body>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});
		// load when render
		loadUserTable();

	})
	/* su dung .on click jquery */
	$('#user-table').on('click','#delete-user',function(e){
		e.preventDefault();
		var id = $(this).val();// lay id cua user
		$.ajax({
			url: '/delete-user',
			type: 'POST',
			data: {
				id: id
			}
		
		})
		.done(function(response) {
			alert('Ban xoa thanh cong');
			loadUserTable();
		})
		.fail(function(response) {
		});
	});

	// create new user
	$('#new-user-form').on('click', '#create_user', function(e) {
		e.preventDefault();
		var name = $('#new_name').val();
		var email = $('#new_email').val();
		var age = $('#new_age').val();
		var weight = $('#new_weight').val();

		var data = {
			'name' : name,
			'email' : email,
			'age' : age,
			'weight' : weight
		};

		$.ajax({
			url: '/new-user',
			type: 'POST',
			data: data
		}).done(function(response) {
			alert(response.msg);
			$('#create-user-modal').modal('hide');
			$('#create-user-form')[0].reset();
			loadUserTable();
		}).fail(function(error) {
			alert('error');
		});
	});
	// post/update a user
	$('#update-submit-form').on('click', '#update_user', function(e) {
		e.preventDefault();
		var name = $('#update_name').val();
		var email = $('#update_email').val();
		var age = $('#update_age').val();
		var weight = $('#update_weight').val();
		var id = $('#update_id').val();

		var data = {
			'name' : name,
			'email' : email,
			'age' : age,
			'weight' : weight,
			'id' : id
		};

		$.ajax({
			url: '/user',
			type: 'POST',
			data: data
		}).done(function(response) {
			$('#update-user-modal').modal('hide');
			$('#update-user-form')[0].reset();
			loadUserTable();
		}).fail(function(error) {
			alert('error');
		});
	});
	//update user
	$('#user-table').on('click', '#view-detail', function(e) {
		e.preventDefault();
		var id = $(this).closest('tr').attr('uid'); // table row ID
		$.ajax({
			url: '/user/' + id,
			type: 'GET',
			data: {}
		}).done(function(response) {
			var user = response.user;
			$('#update_name').val(user.name);
			$('#update_age').val(user.age);
			$('#update_weight').val(user.weight);
			$('#update_id').val(user.id);

			// open modal
			$('#update-user-modal').modal('show');
			console.log(user);
		}).fail(function(error) {

		});
 
	});

	function loadUserTable() {
		$.ajax({
			url: '/user-table',
			type: 'GET',
			data : {},
		}).done(function(response){
			// console.log(response);
			$('#user-table').html(response.view);
		}).fail(function(error) {
			console.log(error);
		});
	}
</script>

</html>