<!DOCTYPE html>
<html>
<head>
	<title>User Management</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div id="search">
					<form method="POST" action="/users">
						@csrf
						<label>Age</label>
						<select name="age">
							<option value=''>All</option>
							@if($users->isNotEmpty())
								@foreach($users as $user)
									<option value="{{ $user->age }}">{{ $user->age }}</option>
								@endforeach
							@endif
						</select>
						<label>Weight</label>
						<select name="weight">
							<option value=''>All</option>
							@if($users->isNotEmpty())
								@foreach($users as $user)
									<option value="{{ $user->weight }}">{{ $user->weight }}</option>
								@endforeach
							@endif
						</select>

						<input type="submit" name="search">
					</form>
				</div>
				<table class="table">
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Age</th>
						<th>Weight</th>
						<th>Detail</th>
					</tr>
					@if($users->isNotEmpty())
						@foreach($users as $user)
							<tr>
								<td>{{ $user->id }}</td>
								<td>{{ $user->name }}</td>
								<td>{{ $user->age }}</td>
								<td>{{ $user->weight }}</td>
								<td><a href="{{route('user-detail', $user->id)}}">Click</a></td>
							</tr>
						@endforeach
					@else
					<p>Khong co du lieu</p>
					@endif
				</table>				
			</div>
		</div>
	</div>

</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>