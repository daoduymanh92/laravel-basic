@if($users->isNotEmpty())
	<table class="table">
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Age</th>
			<th>Weight</th>
			<th>Detail</th>
			<th>Delete</th>
		</tr>
		@foreach($users as $user)
			<tr>
				<td>{{ $user->id }}</td>
				<td>{{ $user->name }}</td>
				<td>{{ $user->age }}</td>
				<td>{{ $user->weight }}</td>
				<td><a href="{{ route('user-detail', $user->id) }}">View</a></td>
				<td><button id="delete-user" value="{{ $user->id }}">Delete</button></td>
			</tr>
		@endforeach
	</table>
@else
	<div class="text-center">
		<p>User Not Found</p>
	</div>
@endif
