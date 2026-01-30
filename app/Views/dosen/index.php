<?php $this->extend('layout'); $this->section('content'); ?>
<div class="card">
<h2>Data Dosen</h2>
<div>
  <a role="button" href="/dosen/create">+ Tambah Dosen</a>
</div>
<form method="get">
  <input type="text" name="q" value="<?= esc($q) ?>" placeholder="Cari nama dosen..."/>
</form>
<table>
  <thead><tr><th>Nama</th><th>NIDN</th><th>Prodi</th><th>Aksi</th></tr></thead>
  <tbody>
  <?php foreach($dosen as $d): ?>
    <tr>
      <td><?= esc($d['nama_dosen']) ?></td>
      <td><?= esc($d['nidn']) ?></td>
      <td><?= esc($d['prodi']) ?></td>
      <td class="icon-actions">
        <a class="icon-btn edit" href="/dosen/edit/<?= $d['id_dosen'] ?>"><i class="fa-solid fa-pen-to-square" aria-hidden="true"></i><span class="sr-only">Edit</span></a>
        <a class="icon-btn delete" href="/dosen/delete/<?= $d['id_dosen'] ?>" onclick="return confirm('Hapus data?')"><i class="fa-solid fa-trash" aria-hidden="true"></i><span class="sr-only">Hapus</span></a>
        <a href="/dosen/mengajar/<?= $d['id_dosen'] ?>">Atur Mata Kuliah</a>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
</div>
<?php $this->endSection(); ?>
