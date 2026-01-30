<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= esc($title ?? 'CI4 Dosen & Matkul'); ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root{
      --purple-600:#6c2bd9;
      --purple-700:#5b21b6;
      --purple-800:#4c1d95;
      --purple-50:#f5f3ff;
      --bg:#ffffff;
      --text:#1f2937;
      --muted:#6b7280;
      --border:#e5e7eb;
      --radius:14px;
      --shadow:0 10px 30px rgba(17,24,39,.08);
    }
    *{box-sizing:border-box}
    html,body{height:100%;margin:0}
    body{
      font-family:'Inter',system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,Cantarell,'Helvetica Neue',Arial,'Noto Sans',sans-serif;
      color:var(--text);
      background:var(--bg);
      display:flex;
      min-height:100vh;
      overflow-x:hidden;
    }
    /* Sidebar */
    .sidebar{
      width:260px; min-width:260px;
      background:linear-gradient(180deg,var(--purple-700),var(--purple-600));
      color:#fff;
      display:flex; flex-direction:column;
      padding:24px 18px;
      position:sticky; top:0; height:100vh;
      box-shadow:inset 0 0 0 1px rgba(255,255,255,.06);
    }
    .brand{display:flex; align-items:center; gap:10px; margin-bottom:18px;}
    .brand .logo{
      width:38px; height:38px; border-radius:12px;
      background:rgba(255,255,255,.18);
      display:grid; place-items:center; font-weight:800; letter-spacing:.5px;
      box-shadow:0 4px 18px rgba(0,0,0,.08);
    }
    .brand .title{font-weight:700; font-size:1.05rem; letter-spacing:.2px}

    .side-search{margin:8px 0 18px}
    .side-search input{
      width:100%; padding:10px 12px; border:none; outline:none;
      border-radius:10px; background:rgba(255,255,255,.14); color:#fff;
    }
    .side-search input::placeholder{color:rgba(255,255,255,.7)}

    nav.side-nav{display:flex; flex-direction:column; gap:6px; margin-top:8px}
    .side-link{
      display:flex; align-items:center; gap:10px;
      padding:10px 12px; border-radius:10px; color:#fff; text-decoration:none;
      transition:.18s ease background, .18s ease transform;
    }
    .side-link:hover{background:rgba(255,255,255,.12); transform:translateX(2px)}
    .side-link.active{background:rgba(255,255,255,.22)}

    .spacer{flex:1}
    .sidebar small{opacity:.8}

    /* Main */
    .main{
      flex:1; display:flex; flex-direction:column;
      min-width:0; /* fix overflow issues */
    }
    .topbar{
      position:sticky; top:0; backdrop-filter:saturate(140%) blur(6px);
      background:rgba(255,255,255,.8);
      border-bottom:1px solid var(--border);
      padding:12px 24px; display:flex; align-items:center; justify-content:space-between;
      z-index:5;
    }
    .topbar .page-title{font-size:1rem; font-weight:600}
    .content{
      padding:24px;
      max-width:1100px;
    }
    /* Cards & tables */
    .card{
      background:#fff; border:1px solid var(--border); border-radius:var(--radius);
      box-shadow:var(--shadow); padding:18px 18px;
    }
    .muted{color:var(--muted);}
    table{width:100%; border-collapse:separate; border-spacing:0; overflow:hidden; border-radius:12px; border:1px solid var(--border)}
    th,td{padding:12px 12px; border-bottom:1px solid var(--border); text-align:left}
    thead th{background:var(--purple-50); font-weight:600}
    tbody tr:last-child td{border-bottom:none}
    .badge{padding:.25rem .5rem; border-radius:.5rem; background:var(--purple-50); display:inline-block}

    /* Buttons & inputs */
    a[role="button"], button{
      background:var(--purple-600); color:#fff; border:none; padding:10px 14px; border-radius:10px;
      text-decoration:none; display:inline-block; cursor:pointer; font-weight:600;
      box-shadow:0 6px 18px rgba(108,43,217,.25);
      transition:.2s transform cubic-bezier(.2,.8,.2,1), .2s opacity;
    }
    a[role="button"].secondary, button.secondary{
      background:#fff; color:var(--purple-700); border:1px solid var(--purple-200,#d6bcfa);
      box-shadow:none;
    }
    a[role="button"]:hover, button:hover{transform:translateY(-1px)}
    input, select{
      width:100%; padding:10px 12px; border-radius:10px; border:1px solid var(--border); outline:none;
      background:#fff;
    }
    label{display:block; margin-bottom:12px; font-weight:600}
    form{display:grid; gap:12px;}

    /* Responsive */
    @media (max-width: 920px){
      .sidebar{position:fixed; left:-270px; transition:left .25s ease}
      .sidebar.open{left:0}
      .main{margin-left:0}
      .topbar button.menu{display:inline-flex}
    }
    @media (min-width: 921px){
      .topbar button.menu{display:none}
    }
  </style>
  <script>
    function toggleSidebar(){
      const sb = document.querySelector('.sidebar');
      sb.classList.toggle('open');
    }
    function setActiveLink(){
      const path = location.pathname.replace(/\/$/,'') || '/';
      document.querySelectorAll('.side-link').forEach(a=>{
        if(a.getAttribute('href')===path){ a.classList.add('active'); }
      });
    }
    document.addEventListener('DOMContentLoaded', setActiveLink);
  </script>

  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" referrerpolicy="no-referrer"/>
  <style>
    .icon-actions{ display:flex; gap:8px; align-items:center; }
    .icon-btn{
      display:inline-flex; align-items:center; justify-content:center;
      width:34px; height:34px; border-radius:999px;
      background:#f3f4f6; border:1px solid #e5e7eb;
      text-decoration:none;
      box-shadow:var(--shadow-sm);
    }
    .icon-btn:hover{ background:#e5e7eb; }
    .icon-btn.edit{ color:#1f2937; }
    .icon-btn.delete{ color:#b91c1c; }
    .sr-only{ position:absolute; width:1px; height:1px; padding:0; margin:-1px; overflow:hidden; clip:rect(0,0,0,0); white-space:nowrap; border:0; }
  </style>

</head>
<body>
  <aside class="sidebar">
    <div class="brand">
      <div class="logo">SI</div>
      <div class="title">DOSEN</div>
    </div>
    <div class="side-search">
      <form action="/" method="get">
        <input name="q" placeholder="Cari cepat..." value="<?= esc($q ?? '') ?>">
      </form>
    </div>
    <nav class="side-nav">
      <a class="side-link" href="/">🏠 Beranda</a>
      <a class="side-link" href="/dosen">👩‍🏫 Dosen</a>
      <a class="side-link" href="/mata-kuliah">📘 Mata Kuliah</a>
    </nav>
    <div class="spacer"></div>
    <small>© <?= date('Y') ?> • CI4 Moh.Syafiuddin_009</small>
  </aside>

  <section class="main">
    <div class="topbar">
      <button class="menu" onclick="toggleSidebar()">☰</button>
      <div class="page-title"><?= esc($title ?? 'SISTEM INFORMASI DOSEN SEDERHANA'); ?></div>
      <div></div>
    </div>
    <div class="content">
      <?php if (session()->getFlashdata('message')): ?>
        <div class="card" style="margin-bottom:16px; border-left:4px solid var(--purple-600)">
          <?= esc(session()->getFlashdata('message')) ?>
        </div>
      <?php endif; ?>
      <?php if (session()->getFlashdata('errors')): ?>
        <div class="card" style="margin-bottom:16px; border-left:4px solid #ef4444">
          <?php foreach((array) session()->getFlashdata('errors') as $e): ?>
            <div><?= esc($e) ?></div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
      <?= $this->renderSection('content') ?>
      <div style="height:24px"></div>
    </div>
  </section>
</body>
</html>
