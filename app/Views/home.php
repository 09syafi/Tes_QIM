<?php $this->extend('layout'); $this->section('content'); ?>
<div class="card">
<h2>Daftar Dosen & Mata Kuliah Diampu</h2>
<form method="get">
  <input type="text" name="q" value="<?= esc($q) ?>" placeholder="Cari dosen atau mata kuliah..."/>
</form>
<table>
  <thead><tr><th>Dosen</th><th>NIDN</th><th>Prodi</th><th>Mata Kuliah</th></tr></thead>
  <tbody>
  <?php foreach($rows as $r): ?>
    <tr>
      <td><a href="/dosen/mengajar/<?= $r['id_dosen'] ?>"><?= esc($r['nama_dosen']) ?></a></td>
      <td><?= esc($r['nidn']) ?></td>
      <td><?= esc($r['prodi']) ?></td>
      <td>
        <?php if($r['matkul']): foreach(explode(';', $r['matkul']) as $mk): ?>
          <span class="badge"><?= esc(trim($mk)) ?></span>
        <?php endforeach; else: ?>
          <em class="muted">Belum ada</em>
        <?php endif; ?>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
</div>
<?php $this->endSection(); ?>
