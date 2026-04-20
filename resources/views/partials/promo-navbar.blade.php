<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
  <title>LOKET Navbar | Centered & Blue Identity</title>
  <!-- Bootstrap 5 CSS + Icons + Google Fonts -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background: linear-gradient(145deg, #f0f4fa 0%, #e2e8f0 100%);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      font-family: 'Inter', sans-serif;
    }

    /* subtle preview card to showcase navbar (does not affect navbar design) */
    .page-preview {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem 1.5rem;
    }

    .info-card {
      background: rgba(255,255,255,0.85);
      backdrop-filter: blur(8px);
      border-radius: 2rem;
      padding: 1.5rem 2rem;
      max-width: 520px;
      text-align: center;
      box-shadow: 0 15px 35px rgba(0,0,0,0.08);
      border: 1px solid rgba(255,255,255,0.6);
    }

    /* ----- LOKET NAVBAR: CENTERED VERSION + PRIMARY BLUE #091d42 ----- */
    /* The picture shows a dark blue navigation with items aligned center (or near center).
       Original snippet had ms-auto (right aligned). To match picture "center alignment",
       we use justify-content-center on the collapse container, and remove ms-auto.
       Also brand on left, nav items in middle, but on larger screens items appear balanced.
       Many modern promo designs have brand left, nav links centered horizontally.
       We'll implement flex-grow approach: navbar-nav centered via margin auto, but brand stays left.
       To be faithful to the reference image (LOKET navbar looks like centered links), 
       we set .navbar-collapse justify-content-center, and .navbar-nav with auto margins. */
       
    .navbar-loket {
      background: #091d42 !important;  /* specified deep blue from prompt */
      border-bottom: 1px solid rgba(255, 255, 255, 0.12);
      padding-top: 0.75rem;
      padding-bottom: 0.75rem;
      font-family: 'Inter', sans-serif;
      box-shadow: 0 8px 20px rgba(0,0,0,0.12);
    }

    /* brand style: clean bold white with slight glow */
    .navbar-brand {
      font-size: 1.85rem;
      font-weight: 800;
      letter-spacing: -0.3px;
      color: white !important;
      text-shadow: 0 1px 2px rgba(0,0,0,0.1);
      transition: all 0.2s ease;
      white-space: nowrap;
    }

    .navbar-brand:hover {
      opacity: 0.92;
      transform: scale(1.01);
      color: white !important;
    }

    /* ----- CENTERING STRATEGY ----- 
       The picture shows main navigation items (Blog Home, LOKET X, LOKET Edu, etc.) 
       are horizontally centered within the navbar, while LOKET brand sits on left edge.
       Using flexbox: on large screens, we let the collapse container take remaining space
       and then use justify-content-center. Additionally .navbar-nav can have margin auto.
       To achieve perfect center alignment for nav links relative to the navbar's middle,
       we set .navbar-collapse to display flex, justify-content center, and .navbar-nav
       to have margin: 0 auto; but also brand stays left. However we also need to consider
       that brand occupies left space, so absolute center of nav items might shift slightly.
       Based on typical "centered navigation" pattern, we apply:
       .navbar > .container-fluid { position: relative; }
       .navbar-brand { position: relative; z-index: 2; }
       .navbar-collapse { justify-content: center; }
       .navbar-nav { gap: 0.25rem; }
       This provides balanced centered links on desktop. Mobile toggler remains right.
       Also matches the vibe from the promotional image "LOKET 12 Tahun" where menu items are
       symmetrically placed.
    */
    @media (min-width: 992px) {
      .navbar-loket .container-fluid {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: space-between;
      }
      /* centering nav items in the middle */
      .navbar-collapse {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        display: flex !important;
        justify-content: center;
        align-items: center;
        pointer-events: none; /* so brand and toggler remain clickable, but children need re-enable */
      }
      .navbar-collapse .navbar-nav {
        pointer-events: auto;
        background: transparent;
        margin: 0 auto;
        padding: 0;
        flex-direction: row;
        align-items: center;
        justify-content: center;
      }
      /* brand stays left, toggler hidden on large screens anyway, but we keep toggler hidden by default */
      .navbar-toggler {
        display: none;
      }
      /* ensure brand is above and clickable */
      .navbar-brand {
        position: relative;
        z-index: 3;
      }
      /* optional: if any right element appears later, but fine */
    }

    /* For tablets and smaller: standard mobile layout with collapse, brand left, toggler right, nav stacked */
    @media (max-width: 991.98px) {
      .navbar-collapse {
        margin-top: 1rem;
        background: rgba(9, 29, 66, 0.96);
        backdrop-filter: blur(12px);
        border-radius: 28px;
        padding: 0.75rem 1rem;
      }
      .navbar-nav .nav-item {
        margin: 0.2rem 0;
        text-align: center;
      }
      .navbar-nav .nav-link {
        text-align: center;
        justify-content: center;
        padding: 0.6rem 1rem;
      }
      .navbar-brand {
        font-size: 1.6rem;
      }
    }

    /* nav link styling – clean and modern, matches picture (white with slight transparency) */
    .navbar-nav .nav-link {
      font-weight: 600;
      font-size: 0.96rem;
      padding: 0.5rem 1rem;
      color: rgba(255, 255, 255, 0.85) !important;
      border-radius: 40px;
      transition: all 0.2s ease;
      letter-spacing: -0.2px;
      white-space: nowrap;
    }

    .navbar-nav .nav-link:hover {
      color: white !important;
      background: rgba(255, 255, 255, 0.15);
      transform: translateY(-1px);
    }

    .navbar-nav .nav-link:active {
      background: rgba(255, 255, 255, 0.25);
    }

    /* toggler button refined for blue background */
    .navbar-toggler {
      border: none;
      background-color: rgba(255, 255, 255, 0.2);
      padding: 0.45rem 0.75rem;
      border-radius: 12px;
    }

    .navbar-toggler:focus {
      box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.4);
      outline: none;
    }

    .navbar-toggler-icon {
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='white' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }

    .container-fluid {
      padding-left: 2rem;
      padding-right: 2rem;
    }

    /* subtle border glow at bottom as per modern style */
    .navbar-loket::after {
      content: '';
      position: absolute;
      bottom: -1px;
      left: 0;
      width: 100%;
      height: 1px;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.25), rgba(255,255,255,0.6), rgba(255,255,255,0.25), transparent);
      pointer-events: none;
    }

    /* sticky top adjustments */
    .sticky-top {
      position: sticky;
      top: 0;
      z-index: 1030;
    }

    /* additional polish: active/current simulation for visual (not required but adds fidelity) */
    .navbar-nav .nav-link:focus-visible {
      outline: none;
      background: rgba(255,255,255,0.1);
    }

    /* make sure navbar items are perfectly centered in large displays without overlapping brand */
    @media (min-width: 992px) {
      .navbar-loket .container-fluid {
        padding: 0 2rem;
      }
      /* ensure absolute positioning doesn't break clicking on nav items */
      .navbar-collapse {
        position: absolute;
        width: 100%;
      }
      .navbar-collapse .navbar-nav {
        background: transparent;
        gap: 0.2rem;
      }
      /* brand left, toggler hidden, but we don't have right elements so perfect center */
      .navbar-brand {
        margin-right: 0;
      }
    }
  </style>
</head>
<body>

  <!-- ========== LOKET NAVBAR - CENTERED + DARK BLUE #091d42 ========== -->
  <!-- 
    Based on image reference: LOKET brand on left, navigation items (Blog Home, LOKET X, LOKET Edu, LOKET News, LOKET Screen, LOKET Wiki, LOKET Event) 
    are horizontally centered on desktop. Mobile view uses hamburger. Background uses #091d42 (rich royal blue). 
    I've implemented a clean centered nav via absolute centering technique, making links perfectly in the middle of the navbar.
    The picture shows similar "LOKET 12 Tahun" style, but we replicate only navbar.
    Also includes sticky-top, shadow, hover effects.
  -->

  <nav class="navbar navbar-expand-lg navbar-dark navbar-loket sticky-top shadow-sm">
    <div class="container-fluid px-4">
      <!-- Brand LOKET (exactly as in reference) -->
      <a class="navbar-brand fw-bold" href="home">LOKET</a>

      <!-- Mobile toggler button -->
      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#promoNavbarCentered" aria-controls="promoNavbarCentered" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Navigation links collapse container -->
      <div class="collapse navbar-collapse" id="promoNavbarCentered">
        <ul class="navbar-nav align-items-center gap-lg-2">
          <li class="nav-item">
            <a class="nav-link" href="bloghome">Blog Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="loket-x">LOKET X</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="loket-edu">LOKET Edu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="loket-news">LOKET News</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="loket-screen">LOKET Screen</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="loket-wiki">LOKET Wiki</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="loket-event">LOKET Event</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>



  <!-- Bootstrap JS bundle for responsive toggler -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  
  <!-- Ensure that on window resize, absolute centering does not cause issues with overlapping brand on very small large screens? 
       But the absolute position method works perfectly because brand has higher z-index, navbar-collapse is behind? 
       Actually pointer-events: none on .navbar-collapse but children re-enable pointer-events: auto makes nav clickable.
       Meanwhile brand remains clickable due to higher z-index. All good. -->
</body>
</html>