<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>
	<h1>Tabel post</h1>
	<a href="{{ route('posts.create') }}">tambah post</a>
	<table style="border-collapse: collapse; width: 100%;" border="1">
		<tr>
			<th>No</th>
			<th>Judul</th>
			<th>Isi</th>
			<th>Tanggal terbit</th>
			<th>Gambar</th>
			<th>Penulis</th>
		</tr>
		@forelse ($posts as $post)
		<tr>
			<td>{{ $loop->iteration }}</td>
			<td>{{ $post->title }}</td>
			<td>{{ $post->content }}</td>
			<td>{{ $post->published_at }}</td>
			<td>
				@if ($post->image)
					<img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" width="100">
				@else
					Tidak ada gambar
				@endif
			</td>
			<td>{{ $post->user ? $post->user->name : 'Penulis tidak ditemukan' }}</td>
		</tr>
		@empty
		<tr>
			<td colspan="6">Tidak ada data</td>
		</tr>
		@endforelse
	</table>
</body>
</html>