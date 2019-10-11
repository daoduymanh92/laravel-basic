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
					<a href="/new-user">Create a user</a>
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