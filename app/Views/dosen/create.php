<?php $this->extend('layout'); $this->section('content'); ?>
<div class="card">

<?php if (session('errors')): ?>
  <div class="alert" role="alert" style="color:#b91c1c; background:#fee2e2; border:1px solid #fecaca; padding:10px; margin-bottom:12px; border-radius:10px;">
    <ul style="margin:0; padding-left:18px;">
      <?php foreach (session('errors') as $e): ?>
        <li><?= esc($e) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<h2>Tambah Dosen</h2>
<form method="post" action="/dosen/store">
  <label>Nama Dosen <input type="text" name="nama_dosen" value="<?= old('nama_dosen') ?>"></label>
  <label>NIDN <input type="text" name="nidn" value="<?= old('nidn') ?>"></label>
  <label>Prodi <input type="text" name="prodi" value="<?= old('prodi') ?>"></label>
  <button type="submit">Simpan</button>
  <a role="button" class="secondary" href="/dosen">Batal</a>
</form>
</div>
<?php $this->endSection(); ?>
