<!DOCTYPE html>
<html>
<head>
	<title>User Management</title>
</head>
<body>
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
	<table>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Age</th>
			<th>Weight</th>
		</tr>
		@if($users->isNotEmpty())
			@foreach($users as $user)
				<tr>
					<td>{{ $user->id }}</td>
					<td>{{ $user->name }}</td>
					<td>{{ $user->age }}</td>
					<td>{{ $user->weight }}</td>
				</tr>
			@endforeach
		@else
		<p>Khong co du lieu</p>
		@endif
	</table>
</body>
</html>