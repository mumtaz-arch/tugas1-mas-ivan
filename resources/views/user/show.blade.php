@extends('layouts.app')

@push('styles')
@endpush

@section('title', 'Halaman Show')
@section('header-title', 'Halaman Show')


@section('content')
	<div class="card">
		<div class="card-header">
			<h3 class="card-title">Detail User</h3>
		</div>
		<div class="card-body">
			<div class="mb-3 text-center">
				@if($user->photo)
					<img src="{{ asset('photos/' . $user->photo) }}" alt="User Photo" class="img-thumbnail" style="max-width: 150px;">
				@else
					<img src="{{ asset('photos/default.png') }}" alt="Default Photo" class="img-thumbnail" style="max-width: 150px;">
				@endif
			</div>
			<table class="table table-bordered">
				<tr>
					<th>Username</th>
					<td>{{ $user->username }}</td>
				</tr>
				<tr>
					<th>Name</th>
					<td>{{ $user->name }}</td>
				</tr>
				<tr>
					<th>Email</th>
					<td>{{ $user->email }}</td>
				</tr>
			</table>
			<a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">Kembali</a>
		</div>
	</div>
@endsection

@push('scripts')

@endpush