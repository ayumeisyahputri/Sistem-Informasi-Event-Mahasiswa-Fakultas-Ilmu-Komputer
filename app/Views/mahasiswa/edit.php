<h2>Edit Mahasiswa</h2>
<form method="post" action="/mahasiswa/update/<?= $mhs['id_mahasiswa'] ?>">
    <label>Nama</label>
    <input type="text" name="nama" value="<?= esc($mhs['nama']) ?>">

    <label>NIM</label>
    <input type="text" name="nim" value="<?= esc($mhs['nim']) ?>">

    <label>Email</label>
    <input type="email" name="email" value="<?= esc($mhs['email']) ?>">

    <label>Jurusan</label>
    <input type="text" name="jurusan" value="<?= esc($mhs['jurusan']) ?>">

    <label>Password</label>
    <input type="text" name="password" value="<?= esc($mhs['password']) ?>">

    <label>Role</label>
    <select name="role">
        <option value="user" <?= ($mhs['role'] ?? 'user') == 'user' ? 'selected' : '' ?>>User</option>
        <option value="admin" <?= ($mhs['role'] ?? '') == 'admin' ? 'selected' : '' ?>>Admin</option>
    </select>

    <button type="submit">Update</button>
</form>
