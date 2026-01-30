<?php $this->extend('layout'); $this->section('content'); ?>
<div class="card">
<h2>Data Mata Kuliah</h2>
<div>
  <a role="button" href="/mata-kuliah/create">+ Tambah Mata Kuliah</a>
</div>
<form method="get">
  <input type="text" name="q" value="<?= esc($q) ?>" placeholder="Cari nama/kode mata kuliah..."/>
</form>
<table>
  <thead><tr><th>Nama</th><th>Kode</th><th>SKS</th><th>Aksi</th></tr></thead>
  <tbody>
  <?php foreach($matkul as $m): ?>
    <tr>
      <td><?= esc($m['nama_mk']) ?></td>
      <td><?= esc($m['kode_mk']) ?></td>
      <td><?= esc($m['sks']) ?></td>
      <td class="icon-actions">
        <a class="icon-btn edit" href="/mata-kuliah/edit/<?= $m['id_mk'] ?>"><i class="fa-solid fa-pen-to-square" aria-hidden="true"></i><span class="sr-only">Edit</span></a>
        <a class="icon-btn delete" href="/mata-kuliah/delete/<?= $m['id_mk'] ?>" onclick="return confirm('Hapus data?')"><i class="fa-solid fa-trash" aria-hidden="true"></i><span class="sr-only">Hapus</span></a>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
</div>
<?php $this->endSection(); ?>
