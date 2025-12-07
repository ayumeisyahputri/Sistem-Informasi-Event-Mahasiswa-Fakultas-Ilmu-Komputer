<h2>Tambah Mahasiswa</h2>
<form method="post" action="/mahasiswa/store">
    <label>Nama</label>
    <input type="text" name="nama" required>

    <label>NIM</label>
    <input type="text" name="nim" required>

    <label>Email</label>
    <input type="email" name="email">

    <label>Jurusan</label>
    <input type="text" name="jurusan">

    <label>Password</label>
    <input type="text" name="password">

    <label>Role</label>
    <select name="role">
        <option value="user">User</option>
        <option value="admin">Admin</option>
    </select>

    <button type="submit">Simpan</button>
</form>
