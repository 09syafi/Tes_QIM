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

<h2>Tambah Mata Kuliah</h2>
<form method="post" action="/mata-kuliah/store">
  <label>Nama MK <input type="text" name="nama_mk" value="<?= old('nama_mk') ?>"></label>
  <label>Kode MK <input type="text" name="kode_mk" value="<?= old('kode_mk') ?>"></label>
  <label>SKS <input type="number" name="sks" value="<?= old('sks') ?>"></label>
  <button type="submit">Simpan</button>
  <a role="button" class="secondary" href="/mata-kuliah">Batal</a>
</form>
</div>
<?php $this->endSection(); ?>
