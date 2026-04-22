<header class="topbar">
  <div class="topbar-inner">
    <div class="logo"><a href="{{ route('home') }}">LOKET</a></div>
    <nav class="menu">
      <a href="{{ route('blog.home') }}">Blog Home</a>
      <a href="{{ route('pages.loket-x') }}">LOKET X</a>
      <a href="{{ route('pages.loket-edu') }}">LOKET Edu</a>
      <a href="{{ route('pages.loket-news') }}">LOKET News</a>
      <a href="{{ route('pages.loket-screen') }}">LOKET Screen</a>
      <a href="{{ route('pages.loket-wiki') }}">LOKET Wiki</a>
      <a href="{{ route('pages.loket-event') }}">LOKET Event</a>
    </nav>
  </div>
</header>

<style>
   .topbar {
      background: #12244d;
      color: #fff;
      position: sticky;
      top: 0;
      z-index: 20;
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }
    .topbar-inner {
      max-width: 1200px;
      margin: 0 auto;
      padding: 14px 18px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 12px;
    }
    .logo { font-weight: 800; font-size: 24px; letter-spacing: 0.3px; }
    .menu { display: flex; gap: 16px; font-size: 13px; flex-wrap: wrap; }
    .menu a { color: #dce7ff; text-decoration: none; }
    .menu a:hover { color: #fff; }
    .hero {
      background: #12244d;
    }
</style>
