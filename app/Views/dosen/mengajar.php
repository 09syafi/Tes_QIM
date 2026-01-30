<?php $this->extend('layout'); $this->section('content'); ?>
<div class="card">
<h2>Atur Mata Kuliah Diampu: <?= esc($dosen['nama_dosen']) ?></h2>
<form method="post" action="/dosen/mengajar/<?= $dosen['id_dosen'] ?>/tambah">
  <label>Pilih Mata Kuliah
    <select name="id_mk">
      <?php foreach($matkul as $m): ?>
        <option value="<?= $m['id_mk'] ?>"><?= esc($m['nama_mk']) ?> (<?= esc($m['kode_mk']) ?>)</option>
      <?php endforeach; ?>
    </select>
  </label>
  <button type="submit">Tambah</button>
  <a role="button" class="secondary" href="/">Kembali</a>
</form>

<h3>Daftar Diampu</h3>
<table>
  <thead><tr><th>Nama MK</th><th>Kode</th><th>SKS</th><th>Aksi</th></tr></thead>
  <tbody>
  <?php foreach($ambil as $a): ?>
    <tr>
      <td><?= esc($a['nama_mk']) ?></td>
      <td><?= esc($a['kode_mk']) ?></td>
      <td><?= esc($a['sks']) ?></td>
      <td class="icon-actions"><a class="icon-btn delete" href="/dosen/mengajar/<?= $dosen['id_dosen'] ?>/hapus/<?= $a['id_dosen_mk'] ?>" onclick="return confirm('Hapus relasi?')"><i class="fa-solid fa-trash" aria-hidden="true"></i><span class="sr-only">Hapus</span></a></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
</div>
<?php $this->endSection(); ?>
