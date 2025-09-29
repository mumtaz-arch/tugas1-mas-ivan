@extends('layouts.app')

@push('styles')
@endpush

@section('title', 'Halaman Tambah User')
@section('header-title', 'Halaman Tambah User')


@section('content')
	<form action="{{ route('users.store') }}" method="POST">
		@csrf
		<div class="mb-3">
			<label for="name" class="form-label">Nama</label>
			<input type="text" class="form-control" id="name" name="name" required>
		</div>
		<div class="mb-3">
			<label for="email" class="form-label">Email</label>
			<input type="email" class="form-control" id="email" name="email		" required>
		</div>
		<div class="mb-3">
			<label for="password" class="form-label">Password</label>
			<input type="password" class="form-control" id="password" name="password" required>
		</div>
		<button type="submit" class="btn btn-primary">Simpan</button>
		<a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
	</form>
@endsection

@push('scripts')

@endpush