<h1>Daftar Produk</h1>
<table width="100%" border="1" cellpadding="5" cellspacing="0">
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>Username</th>
    <th>Role</th>
</tr>

@foreach ($user as $users)
<tr>
    <td>{{ $users->id }}</td>
    <td>{{ $users->nama }}</td>
    <td>{{ $users->username }}</td>
    <td>{{ $users->role }}</td>
</tr>
@endforeach
</table>
