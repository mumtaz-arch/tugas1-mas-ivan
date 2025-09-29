@extends('layouts.app')

@push('styles')
@endpush

@section('title', 'Halaman User')
@section('header-title', 'Halaman User')


@section('content')
	<a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Tambah User</a>
	<table class="table table-bordered">
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Email</th>
			<th>Aksi</th>
		</tr>
		@forelse ($users as $user)
			<tr>
				<td>{{ $loop->iteration }}</td>
				<td>{{ $user->name }}</td>
				<td>{{ $user->email }}</td>
				<td>
					<a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
					<form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
						@csrf
						@method('DELETE')
						<button type="submit" class="btn btn-danger btn-sm">Hapus</button>
					</form>
			</tr>
		@empty
			<tr>
				<td colspan="3">Tidak ada data</td>
			</tr>
		@endforelse
	</table>
@endsection

@push('scripts')

@endpush