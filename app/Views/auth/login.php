<div class="login-container">
    <h3>Login Mahasiswa</h3>

    <form method="post" action="/loginProcess">
        <label>NIM</label>
        <input type="text" name="nim" required value="<?= esc($cookie_nim ?? '') ?>">

        <label>Password</label>
        <input type="password" name="password" required value="<?= esc($cookie_pass ?? '') ?>">

        <div class="remember-me">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Remember me</label>
        </div>

        <button type="submit">Login</button>
    </form>

    <p style="margin-top:10px; font-size:13px; color:#666;">
        Gunakan NIM & password yang ada di tabel <strong>mahasiswa</strong>.
    </p>
</div>
