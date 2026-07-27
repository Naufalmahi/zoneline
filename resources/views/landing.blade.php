<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Zoneline — Platform SaaS all-in-one untuk UMKM Indonesia. Kelola laundry, barbershop, dan cafe dengan lebih mudah dan profesional.">
    <title>Zoneline — Digitalkan Bisnismu, Tingkatkan Omzetmu</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&display=swap" rel="stylesheet">

    <style>
        /* =============================================
           DESIGN TOKENS
        ============================================= */
        :root {
            --bg-base:       #06090f;
            --bg-surface:    #0b1120;
            --bg-card:       #0f1729;
            --bg-card-alt:   #121d33;

            --primary:       #6366f1;
            --primary-lt:    #818cf8;
            --primary-glow:  rgba(99,102,241,0.18);
            --primary-ring:  rgba(99,102,241,0.35);

            --cyan:          #06b6d4;
            --emerald:       #10b981;
            --amber:         #f59e0b;
            --rose:          #f43f5e;
            --violet:        #8b5cf6;

            --border:        rgba(255,255,255,0.07);
            --border-hover:  rgba(255,255,255,0.13);

            --text-1:        #f1f5f9;
            --text-2:        #94a3b8;
            --text-3:        #475569;

            --radius:        16px;
            --radius-sm:     10px;
            --radius-lg:     24px;
            --transition:    0.25s cubic-bezier(0.4,0,0.2,1);
            --shadow-glow:   0 0 60px rgba(99,102,241,0.15);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html { font-size: 16px; scroll-behavior: smooth; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-base);
            color: var(--text-1);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* ── Utility ─────────────────────────────── */
        .container {
            max-width: 1160px;
            margin: 0 auto;
            padding: 0 24px;
        }

        .gradient-text {
            background: linear-gradient(135deg, #fff 20%, var(--primary-lt) 60%, var(--cyan) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .gradient-text-warm {
            background: linear-gradient(135deg, var(--amber) 0%, var(--rose) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        img { display: block; max-width: 100%; }

        /* =============================================
           GRID NOISE / BACKGROUND
        ============================================= */
        .bg-grid {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            background-image:
                linear-gradient(rgba(99,102,241,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(99,102,241,0.03) 1px, transparent 1px);
            background-size: 48px 48px;
        }

        .bg-orb {
            position: fixed;
            border-radius: 50%;
            pointer-events: none;
            filter: blur(80px);
            z-index: 0;
        }

        .orb-1 {
            width: 600px; height: 600px;
            top: -200px; left: -200px;
            background: radial-gradient(circle, rgba(99,102,241,0.18) 0%, transparent 70%);
        }

        .orb-2 {
            width: 500px; height: 500px;
            bottom: 10%; right: -100px;
            background: radial-gradient(circle, rgba(6,182,212,0.12) 0%, transparent 70%);
        }

        .orb-3 {
            width: 400px; height: 400px;
            top: 50%; left: 30%;
            background: radial-gradient(circle, rgba(139,92,246,0.08) 0%, transparent 70%);
        }

        /* everything above bg */
        section, header, footer, nav { position: relative; z-index: 1; }

        /* =============================================
           NAVBAR
        ============================================= */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 200;
            padding: 0;
        }

        .navbar-inner {
            display: flex;
            align-items: center;
            height: 68px;
            gap: 32px;
            background: rgba(6,9,15,0.72);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border);
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            flex-shrink: 0;
        }

        .nav-logo-icon {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--primary), var(--cyan));
            border-radius: 9px;
            display: grid;
            place-items: center;
            font-size: 1rem;
            font-weight: 900;
            color: #fff;
            letter-spacing: -1px;
            box-shadow: 0 0 20px rgba(99,102,241,0.4);
        }

        .nav-logo-name {
            font-size: 1.15rem;
            font-weight: 800;
            background: linear-gradient(135deg, #fff, var(--primary-lt));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 4px;
            flex: 1;
        }

        .nav-link {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-2);
            text-decoration: none;
            padding: 7px 14px;
            border-radius: 8px;
            transition: all var(--transition);
        }

        .nav-link:hover {
            color: var(--text-1);
            background: rgba(255,255,255,0.05);
        }

        .nav-ctas {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-family: inherit;
            font-size: 0.88rem;
            font-weight: 700;
            padding: 10px 22px;
            border-radius: 100px;
            cursor: pointer;
            transition: all var(--transition);
            text-decoration: none;
            border: none;
            white-space: nowrap;
        }

        .btn-ghost {
            color: var(--text-2);
            background: transparent;
            border: 1px solid var(--border);
        }

        .btn-ghost:hover {
            color: var(--text-1);
            border-color: var(--border-hover);
            background: rgba(255,255,255,0.05);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-lt));
            color: #fff;
            box-shadow: 0 4px 20px rgba(99,102,241,0.35);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(99,102,241,0.5);
        }

        .btn-lg {
            font-size: 1rem;
            padding: 14px 32px;
        }

        .btn-xl {
            font-size: 1.05rem;
            padding: 16px 38px;
        }

        .btn-outline {
            background: transparent;
            color: var(--text-1);
            border: 1px solid var(--border-hover);
        }

        .btn-outline:hover {
            border-color: var(--primary-lt);
            color: var(--primary-lt);
            background: var(--primary-glow);
        }

        /* =============================================
           HERO
        ============================================= */
        .hero {
            padding: 100px 0 80px;
            text-align: center;
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--primary-lt);
            background: rgba(99,102,241,0.1);
            border: 1px solid rgba(99,102,241,0.25);
            padding: 6px 16px;
            border-radius: 100px;
            margin-bottom: 28px;
        }

        .hero-eyebrow-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: var(--primary-lt);
            animation: blink 2s infinite;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }

        .hero h1 {
            font-size: clamp(2.4rem, 6vw, 4.2rem);
            font-weight: 900;
            line-height: 1.08;
            letter-spacing: -1.5px;
            max-width: 820px;
            margin: 0 auto 24px;
        }

        .hero-desc {
            font-size: 1.1rem;
            color: var(--text-2);
            max-width: 540px;
            margin: 0 auto 40px;
            line-height: 1.7;
        }

        .hero-ctas {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 64px;
        }

        .hero-note {
            font-size: 0.78rem;
            color: var(--text-3);
            margin-top: 14px;
        }

        .hero-note span { color: var(--emerald); font-weight: 600; }

        /* ── Hero mock dashboard ─────────────────── */
        .hero-visual {
            position: relative;
            max-width: 960px;
            margin: 0 auto;
        }

        .hero-visual-glow {
            position: absolute;
            inset: -40px;
            background: radial-gradient(ellipse at 50% 40%, rgba(99,102,241,0.2) 0%, transparent 65%);
            pointer-events: none;
            z-index: 0;
        }

        .mock-window {
            background: var(--bg-card);
            border: 1px solid var(--border-hover);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: 0 40px 100px rgba(0,0,0,0.6), 0 0 0 1px rgba(255,255,255,0.04);
            position: relative;
            z-index: 1;
        }

        .mock-titlebar {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 14px 18px;
            background: rgba(0,0,0,0.3);
            border-bottom: 1px solid var(--border);
        }

        .mock-dot {
            width: 11px; height: 11px;
            border-radius: 50%;
        }

        .mock-dot-r { background: #ff5f57; }
        .mock-dot-y { background: #febc2e; }
        .mock-dot-g { background: #28c840; }

        .mock-url {
            flex: 1;
            display: flex;
            justify-content: center;
        }

        .mock-url-bar {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.72rem;
            color: var(--text-3);
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--border);
            padding: 5px 14px;
            border-radius: 20px;
            max-width: 260px;
        }

        .mock-url-bar span { color: var(--emerald); font-weight: 600; }

        .mock-body {
            display: grid;
            grid-template-columns: 220px 1fr;
            min-height: 360px;
        }

        .mock-sidebar {
            background: rgba(0,0,0,0.2);
            border-right: 1px solid var(--border);
            padding: 18px 14px;
        }

        .mock-sidebar-logo {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            padding: 0 6px;
        }

        .mslogo-icon {
            width: 28px; height: 28px;
            background: linear-gradient(135deg, var(--primary), var(--cyan));
            border-radius: 7px;
            display: grid;
            place-items: center;
            font-size: 0.7rem;
            font-weight: 900;
            color: #fff;
        }

        .mslogo-name {
            font-size: 0.8rem;
            font-weight: 800;
            color: var(--text-1);
        }

        .mock-nav-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 10px;
            border-radius: 7px;
            margin-bottom: 2px;
            font-size: 0.72rem;
            color: var(--text-3);
        }

        .mock-nav-item.active {
            background: var(--primary-glow);
            color: var(--primary-lt);
            border: 1px solid var(--primary-ring);
        }

        .mock-main { padding: 18px; }

        .mock-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-bottom: 14px;
        }

        .mock-stat {
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 12px;
        }

        .mock-stat-label { font-size: 0.6rem; color: var(--text-3); margin-bottom: 5px; }
        .mock-stat-val {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--text-1);
        }

        .mock-stat-badge {
            font-size: 0.55rem;
            font-weight: 700;
            color: var(--emerald);
            margin-top: 3px;
        }

        .mock-chart-area {
            background: rgba(255,255,255,0.02);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 12px;
            height: 130px;
            display: flex;
            align-items: flex-end;
            gap: 5px;
        }

        .mock-bar {
            flex: 1;
            border-radius: 3px 3px 0 0;
            min-height: 8px;
            background: linear-gradient(to top, var(--primary), var(--cyan));
            opacity: 0.6;
        }

        /* ── Floating badges ───────────────────────── */
        .hero-badge {
            position: absolute;
            background: var(--bg-card-alt);
            border: 1px solid var(--border-hover);
            border-radius: 12px;
            padding: 10px 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.5);
            animation: float 6s ease-in-out infinite;
            z-index: 10;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50%       { transform: translateY(-10px); }
        }

        .badge-left {
            left: -60px;
            top: 40%;
            animation-delay: -2s;
        }

        .badge-right {
            right: -50px;
            top: 25%;
            animation-delay: -4s;
        }

        .badge-bottom {
            bottom: -20px;
            left: 50%;
            transform: translateX(-50%);
            animation-delay: -1s;
        }

        .hero-badge-icon {
            width: 34px; height: 34px;
            border-radius: 9px;
            display: grid;
            place-items: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .hero-badge-text { }
        .hero-badge-label { font-size: 0.65rem; color: var(--text-3); }
        .hero-badge-val { font-size: 0.85rem; font-weight: 700; color: var(--text-1); }

        /* =============================================
           SOCIAL PROOF BAR
        ============================================= */
        .trust-bar {
            padding: 28px 0;
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
        }

        .trust-bar-inner {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 48px;
            flex-wrap: wrap;
        }

        .trust-stat {
            text-align: center;
        }

        .trust-stat-val {
            font-size: 1.6rem;
            font-weight: 900;
            color: var(--text-1);
            letter-spacing: -0.5px;
        }

        .trust-stat-label {
            font-size: 0.75rem;
            color: var(--text-3);
            margin-top: 2px;
        }

        .trust-divider {
            width: 1px;
            height: 36px;
            background: var(--border);
        }

        /* =============================================
           HOW IT WORKS
        ============================================= */
        .section {
            padding: 100px 0;
        }

        .section-eyebrow {
            display: inline-block;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: var(--primary-lt);
            margin-bottom: 14px;
        }

        .section-title {
            font-size: clamp(1.8rem, 4vw, 2.8rem);
            font-weight: 900;
            line-height: 1.12;
            letter-spacing: -0.8px;
            margin-bottom: 16px;
        }

        .section-desc {
            font-size: 1rem;
            color: var(--text-2);
            max-width: 500px;
            line-height: 1.7;
        }

        .section-header { margin-bottom: 60px; }

        /* ── Steps ─────────────────────────────────── */
        .steps-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .step-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 32px;
            position: relative;
            overflow: hidden;
            transition: all var(--transition);
        }

        .step-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, var(--step-glow, rgba(99,102,241,0)) 0%, transparent 70%);
            opacity: 0;
            transition: opacity var(--transition);
        }

        .step-card:hover {
            border-color: var(--border-hover);
            transform: translateY(-4px);
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }

        .step-card:hover::before { opacity: 1; }

        .step-card:nth-child(1) { --step-glow: rgba(99,102,241,0.1); }
        .step-card:nth-child(2) { --step-glow: rgba(6,182,212,0.1); }
        .step-card:nth-child(3) { --step-glow: rgba(16,185,129,0.1); }

        .step-num {
            font-size: 3.5rem;
            font-weight: 900;
            color: rgba(255,255,255,0.04);
            line-height: 1;
            margin-bottom: 20px;
            letter-spacing: -2px;
        }

        .step-icon {
            width: 48px; height: 48px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            font-size: 1.4rem;
            margin-bottom: 18px;
        }

        .step-title {
            font-size: 1.05rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .step-desc {
            font-size: 0.875rem;
            color: var(--text-2);
            line-height: 1.7;
        }

        .step-connector {
            position: absolute;
            right: -12px;
            top: 50%;
            transform: translateY(-50%);
            width: 24px;
            height: 2px;
            background: linear-gradient(90deg, var(--border-hover), transparent);
            z-index: 5;
        }

        /* =============================================
           PRODUCTS / FLOW CARDS
        ============================================= */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .product-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 32px;
            transition: all var(--transition);
            position: relative;
            overflow: hidden;
            cursor: default;
        }

        .product-card::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 3px;
            background: var(--prod-color, var(--primary));
            transform: scaleX(0);
            transition: transform var(--transition);
            transform-origin: left;
        }

        .product-card:hover {
            border-color: var(--prod-ring, rgba(99,102,241,0.3));
            transform: translateY(-5px);
            box-shadow: 0 24px 60px rgba(0,0,0,0.35);
        }

        .product-card:hover::after { transform: scaleX(1); }

        .product-card.laundry { --prod-color: linear-gradient(90deg,#6366f1,#818cf8); --prod-ring: rgba(99,102,241,0.35); }
        .product-card.barber  { --prod-color: linear-gradient(90deg,#06b6d4,#22d3ee); --prod-ring: rgba(6,182,212,0.35); }
        .product-card.cafe    { --prod-color: linear-gradient(90deg,#f59e0b,#fbbf24); --prod-ring: rgba(245,158,11,0.35); }

        .prod-emoji {
            font-size: 2.4rem;
            margin-bottom: 16px;
        }

        .prod-name {
            font-size: 1.3rem;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .prod-tagline {
            font-size: 0.82rem;
            color: var(--text-3);
            margin-bottom: 20px;
        }

        .prod-features {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 9px;
            margin-bottom: 28px;
        }

        .prod-features li {
            display: flex;
            align-items: center;
            gap: 9px;
            font-size: 0.85rem;
            color: var(--text-2);
        }

        .prod-features li::before {
            content: '✓';
            width: 18px; height: 18px;
            border-radius: 50%;
            background: rgba(16,185,129,0.15);
            color: var(--emerald);
            font-size: 0.65rem;
            font-weight: 700;
            display: grid;
            place-items: center;
            flex-shrink: 0;
        }

        .prod-price {
            font-size: 1.6rem;
            font-weight: 900;
            color: var(--text-1);
            letter-spacing: -0.5px;
        }

        .prod-price span {
            font-size: 0.82rem;
            font-weight: 400;
            color: var(--text-3);
        }

        .prod-cta {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 18px;
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text-2);
            text-decoration: none;
            transition: color var(--transition);
        }

        .prod-cta:hover { color: var(--text-1); }

        /* =============================================
           PRICING
        ============================================= */
        .pricing-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            max-width: 780px;
            margin: 0 auto;
        }

        .pricing-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 36px;
            position: relative;
            overflow: hidden;
            transition: all var(--transition);
        }

        .pricing-card.featured {
            border-color: var(--primary-ring);
            background: linear-gradient(145deg, rgba(99,102,241,0.06) 0%, var(--bg-card) 100%);
        }

        .pricing-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 24px 60px rgba(0,0,0,0.3);
        }

        .pricing-popular {
            position: absolute;
            top: 18px; right: 18px;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            color: #fff;
            background: linear-gradient(135deg, var(--primary), var(--cyan));
            padding: 4px 12px;
            border-radius: 100px;
        }

        .pricing-icon {
            font-size: 2rem;
            margin-bottom: 14px;
        }

        .pricing-name {
            font-size: 1.1rem;
            font-weight: 800;
            margin-bottom: 4px;
        }

        .pricing-target {
            font-size: 0.78rem;
            color: var(--text-3);
            margin-bottom: 22px;
        }

        .pricing-price {
            font-size: 2.2rem;
            font-weight: 900;
            letter-spacing: -1px;
            color: var(--text-1);
            margin-bottom: 4px;
        }

        .pricing-price .period {
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--text-3);
            letter-spacing: 0;
        }

        .pricing-save {
            font-size: 0.72rem;
            color: var(--emerald);
            font-weight: 600;
            margin-bottom: 24px;
        }

        .pricing-divider {
            height: 1px;
            background: var(--border);
            margin: 20px 0;
        }

        .pricing-features {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 11px;
            margin-bottom: 28px;
        }

        .pricing-features li {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 0.85rem;
            color: var(--text-2);
            line-height: 1.5;
        }

        .feat-check {
            width: 18px; height: 18px;
            border-radius: 50%;
            background: rgba(16,185,129,0.15);
            color: var(--emerald);
            font-size: 0.6rem;
            font-weight: 700;
            display: grid;
            place-items: center;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .feat-check.pro {
            background: rgba(99,102,241,0.15);
            color: var(--primary-lt);
        }

        .feat-lock {
            color: var(--text-3);
        }

        .pricing-btn {
            width: 100%;
            justify-content: center;
        }

        .pricing-note {
            text-align: center;
            font-size: 0.75rem;
            color: var(--text-3);
            margin-top: 24px;
        }

        .pricing-note span { color: var(--emerald); font-weight: 600; }

        /* =============================================
           TESTIMONIALS
        ============================================= */
        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        .testi-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 26px;
            transition: all var(--transition);
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .testi-card:hover {
            border-color: var(--border-hover);
            transform: translateY(-3px);
        }

        .testi-stars {
            display: flex;
            gap: 3px;
            color: var(--amber);
            font-size: 0.85rem;
        }

        .testi-quote {
            font-size: 0.875rem;
            color: var(--text-2);
            line-height: 1.7;
            font-style: italic;
            flex: 1;
        }

        .testi-quote strong { color: var(--text-1); font-style: normal; }

        .testi-author {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: auto;
        }

        .testi-avatar {
            width: 38px; height: 38px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            font-size: 0.95rem;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }

        .testi-name { font-size: 0.85rem; font-weight: 700; color: var(--text-1); }
        .testi-biz  { font-size: 0.72rem; color: var(--text-3); }

        /* =============================================
           FAQ
        ============================================= */
        .faq-list {
            max-width: 720px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .faq-item {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            overflow: hidden;
            transition: border-color var(--transition);
        }

        .faq-item:hover { border-color: var(--border-hover); }

        .faq-q {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 22px;
            cursor: pointer;
            font-size: 0.92rem;
            font-weight: 600;
            color: var(--text-1);
            user-select: none;
            gap: 12px;
        }

        .faq-arrow {
            font-size: 0.8rem;
            color: var(--text-3);
            transition: transform var(--transition);
            flex-shrink: 0;
        }

        .faq-item.open .faq-arrow { transform: rotate(180deg); }

        .faq-a {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease, padding 0.3s ease;
            font-size: 0.875rem;
            color: var(--text-2);
            line-height: 1.7;
            padding: 0 22px;
        }

        .faq-item.open .faq-a {
            max-height: 200px;
            padding: 0 22px 18px;
        }

        /* =============================================
           CTA BANNER
        ============================================= */
        .cta-banner {
            padding: 80px 0;
        }

        .cta-inner {
            background: linear-gradient(135deg, rgba(99,102,241,0.15) 0%, rgba(6,182,212,0.08) 100%);
            border: 1px solid rgba(99,102,241,0.25);
            border-radius: 28px;
            padding: 70px 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta-inner::before {
            content: '';
            position: absolute;
            top: -100px; left: 50%;
            transform: translateX(-50%);
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(99,102,241,0.2) 0%, transparent 65%);
            pointer-events: none;
        }

        .cta-title {
            font-size: clamp(1.8rem, 4vw, 2.8rem);
            font-weight: 900;
            line-height: 1.1;
            letter-spacing: -0.8px;
            margin-bottom: 16px;
        }

        .cta-desc {
            font-size: 1rem;
            color: var(--text-2);
            max-width: 440px;
            margin: 0 auto 36px;
            line-height: 1.7;
        }

        .cta-actions {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        /* =============================================
           FOOTER
        ============================================= */
        footer {
            border-top: 1px solid var(--border);
            padding: 56px 0 32px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.8fr 1fr 1fr 1fr;
            gap: 40px;
            margin-bottom: 48px;
        }

        .footer-brand {}

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 14px;
        }

        .footer-logo-icon {
            width: 34px; height: 34px;
            background: linear-gradient(135deg, var(--primary), var(--cyan));
            border-radius: 9px;
            display: grid;
            place-items: center;
            font-size: 0.9rem;
            font-weight: 900;
            color: #fff;
        }

        .footer-logo-name {
            font-size: 1.05rem;
            font-weight: 800;
            color: var(--text-1);
        }

        .footer-tagline {
            font-size: 0.82rem;
            color: var(--text-3);
            line-height: 1.7;
            max-width: 230px;
            margin-bottom: 18px;
        }

        .footer-socials {
            display: flex;
            gap: 8px;
        }

        .social-btn {
            width: 34px; height: 34px;
            border-radius: 8px;
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--border);
            display: grid;
            place-items: center;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all var(--transition);
            text-decoration: none;
            color: var(--text-3);
        }

        .social-btn:hover {
            background: rgba(255,255,255,0.08);
            border-color: var(--border-hover);
            color: var(--text-1);
        }

        .footer-col-title {
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--text-1);
            margin-bottom: 16px;
            letter-spacing: 0.3px;
        }

        .footer-links {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .footer-links a {
            font-size: 0.82rem;
            color: var(--text-3);
            text-decoration: none;
            transition: color var(--transition);
        }

        .footer-links a:hover { color: var(--text-1); }

        .footer-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 24px;
            border-top: 1px solid var(--border);
            flex-wrap: wrap;
            gap: 12px;
        }

        .footer-copy {
            font-size: 0.75rem;
            color: var(--text-3);
        }

        .footer-copy a { color: var(--primary-lt); text-decoration: none; }

        .footer-badges {
            display: flex;
            gap: 8px;
        }

        .footer-badge {
            font-size: 0.68rem;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 6px;
            border: 1px solid var(--border);
            color: var(--text-3);
        }

        /* =============================================
           ANIMATIONS / SCROLL REVEAL
        ============================================= */
        .reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 0.65s ease, transform 0.65s ease;
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .reveal-delay-1 { transition-delay: 0.1s; }
        .reveal-delay-2 { transition-delay: 0.2s; }
        .reveal-delay-3 { transition-delay: 0.3s; }

        /* =============================================
           SCROLLBAR
        ============================================= */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--bg-base); }
        ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.08); border-radius: 3px; }

        /* =============================================
           RESPONSIVE
        ============================================= */
        @media (max-width: 1024px) {
            .products-grid, .steps-grid, .testimonials-grid { grid-template-columns: 1fr 1fr; }
            .footer-grid { grid-template-columns: 1fr 1fr; }
            .badge-left, .badge-right { display: none; }
        }

        @media (max-width: 768px) {
            .hero { padding: 70px 0 60px; }
            .hero h1 { font-size: 2.2rem; }
            .products-grid, .steps-grid, .testimonials-grid { grid-template-columns: 1fr; }
            .pricing-grid { grid-template-columns: 1fr; }
            .footer-grid { grid-template-columns: 1fr; }
            .mock-body { grid-template-columns: 1fr; }
            .mock-sidebar { display: none; }
            .nav-links { display: none; }
        }
    </style>
</head>

<body>

<!-- Background decoration -->
<div class="bg-grid" aria-hidden="true"></div>
<div class="bg-orb orb-1" aria-hidden="true"></div>
<div class="bg-orb orb-2" aria-hidden="true"></div>
<div class="bg-orb orb-3" aria-hidden="true"></div>

<!-- =============================================
     NAVBAR
============================================= -->
<header class="navbar">
    <div class="container">
        <nav class="navbar-inner">
            <!-- Logo -->
            <a href="/" class="nav-logo" aria-label="Zoneline Home">
                <div class="nav-logo-icon" aria-hidden="true">Z</div>
                <span class="nav-logo-name">Zoneline</span>
            </a>

            <!-- Nav Links -->
            <div class="nav-links" role="navigation" aria-label="Navigasi utama">
                <a href="#cara-kerja"  class="nav-link">Cara Kerja</a>
                <a href="#produk"      class="nav-link">Produk</a>
                <a href="#harga"       class="nav-link">Harga</a>
                <a href="#testimoni"   class="nav-link">Testimoni</a>
                <a href="#faq"         class="nav-link">FAQ</a>
            </div>

            <!-- CTAs -->
            <div class="nav-ctas">
                <a href="/login"     class="btn btn-ghost" id="nav-login-btn">Masuk</a>
                <a href="/register"  class="btn btn-primary" id="nav-register-btn">Coba Gratis 14 Hari →</a>
            </div>
        </nav>
    </div>
</header>

<!-- =============================================
     HERO
============================================= -->
<section class="hero" id="hero">
    <div class="container">

        <!-- Eyebrow -->
        <div class="hero-eyebrow" aria-label="Platform baru untuk UMKM">
            <div class="hero-eyebrow-dot" aria-hidden="true"></div>
            Platform SaaS #1 untuk UMKM Indonesia
        </div>

        <!-- Headline -->
        <h1>
            Digitalkan Bisnismu,<br>
            <span class="gradient-text">Tingkatkan Omzetmu</span>
        </h1>

        <!-- Description -->
        <p class="hero-desc">
            Zoneline hadir untuk membantu laundry, barbershop, dan cafe kamu beroperasi lebih efisien, profesional, dan menguntungkan — tanpa ribet.
        </p>

        <!-- CTAs -->
        <div class="hero-ctas">
            <a href="/register" class="btn btn-primary btn-xl" id="hero-cta-primary">
                🚀 Mulai Gratis Sekarang
            </a>
            <a href="#produk" class="btn btn-outline btn-xl" id="hero-cta-secondary">
                Lihat Fitur ↓
            </a>
        </div>

        <p class="hero-note">
            <span>✓ Gratis 14 hari</span> &nbsp;·&nbsp; Tidak perlu kartu kredit &nbsp;·&nbsp; Batalkan kapan saja
        </p>

        <!-- Mock Dashboard Visual -->
        <div class="hero-visual" role="img" aria-label="Preview dashboard Zoneline">
            <div class="hero-visual-glow" aria-hidden="true"></div>

            <!-- Floating Badge Left -->
            <div class="hero-badge badge-left" aria-hidden="true">
                <div class="hero-badge-icon" style="background:rgba(16,185,129,0.15)">💰</div>
                <div class="hero-badge-text">
                    <div class="hero-badge-label">Omzet Bulan Ini</div>
                    <div class="hero-badge-val">Rp 4,2 juta</div>
                </div>
            </div>

            <!-- Floating Badge Right -->
            <div class="hero-badge badge-right" aria-hidden="true">
                <div class="hero-badge-icon" style="background:rgba(245,158,11,0.15)">⭐</div>
                <div class="hero-badge-text">
                    <div class="hero-badge-label">Rating Pelanggan</div>
                    <div class="hero-badge-val">4.9 / 5.0</div>
                </div>
            </div>

            <!-- Mock Window -->
            <div class="mock-window">
                <!-- Title bar -->
                <div class="mock-titlebar">
                    <div class="mock-dot mock-dot-r"></div>
                    <div class="mock-dot mock-dot-y"></div>
                    <div class="mock-dot mock-dot-g"></div>
                    <div class="mock-url">
                        <div class="mock-url-bar">
                            🔒 <span>app.</span>zoneline.id/laundry
                        </div>
                    </div>
                </div>

                <!-- App Body -->
                <div class="mock-body">
                    <!-- Sidebar -->
                    <div class="mock-sidebar">
                        <div class="mock-sidebar-logo">
                            <div class="mslogo-icon">Z</div>
                            <div class="mslogo-name">LaundryFlow</div>
                        </div>
                        <div class="mock-nav-item active">📊 Dashboard</div>
                        <div class="mock-nav-item">🧺 Pesanan</div>
                        <div class="mock-nav-item">👤 Pelanggan</div>
                        <div class="mock-nav-item">🧾 Nota</div>
                        <div class="mock-nav-item">📈 Laporan</div>
                    </div>

                    <!-- Main Content -->
                    <div class="mock-main">
                        <div class="mock-stats">
                            <div class="mock-stat">
                                <div class="mock-stat-label">Pesanan Hari Ini</div>
                                <div class="mock-stat-val">24</div>
                                <div class="mock-stat-badge">▲ 12%</div>
                            </div>
                            <div class="mock-stat">
                                <div class="mock-stat-label">Total Omzet</div>
                                <div class="mock-stat-val">Rp 480k</div>
                                <div class="mock-stat-badge">▲ 8%</div>
                            </div>
                            <div class="mock-stat">
                                <div class="mock-stat-label">Pelanggan Baru</div>
                                <div class="mock-stat-val">7</div>
                                <div class="mock-stat-badge">▲ 3</div>
                            </div>
                        </div>
                        <div class="mock-chart-area">
                            <div class="mock-bar" style="height:35%"></div>
                            <div class="mock-bar" style="height:55%"></div>
                            <div class="mock-bar" style="height:45%"></div>
                            <div class="mock-bar" style="height:70%"></div>
                            <div class="mock-bar" style="height:60%"></div>
                            <div class="mock-bar" style="height:85%"></div>
                            <div class="mock-bar" style="height:75%;opacity:1"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Floating Badge Bottom -->
            <div class="hero-badge badge-bottom" aria-hidden="true">
                <div class="hero-badge-icon" style="background:rgba(99,102,241,0.15)">✅</div>
                <div class="hero-badge-text">
                    <div class="hero-badge-label">Pesanan selesai</div>
                    <div class="hero-badge-val">Baju Budi — 3,2 kg — Rp 16.000</div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- =============================================
     TRUST BAR
============================================= -->
<section class="trust-bar" aria-label="Statistik platform">
    <div class="container">
        <div class="trust-bar-inner">
            <div class="trust-stat">
                <div class="trust-stat-val">248+</div>
                <div class="trust-stat-label">UMKM Aktif</div>
            </div>
            <div class="trust-divider" aria-hidden="true"></div>
            <div class="trust-stat">
                <div class="trust-stat-val">12.000+</div>
                <div class="trust-stat-label">Pesanan Diproses</div>
            </div>
            <div class="trust-divider" aria-hidden="true"></div>
            <div class="trust-stat">
                <div class="trust-stat-val">Rp 1,2M+</div>
                <div class="trust-stat-label">Omzet Tenant</div>
            </div>
            <div class="trust-divider" aria-hidden="true"></div>
            <div class="trust-stat">
                <div class="trust-stat-val">4.9★</div>
                <div class="trust-stat-label">Rating Pengguna</div>
            </div>
            <div class="trust-divider" aria-hidden="true"></div>
            <div class="trust-stat">
                <div class="trust-stat-val">99.9%</div>
                <div class="trust-stat-label">Uptime</div>
            </div>
        </div>
    </div>
</section>

<!-- =============================================
     HOW IT WORKS
============================================= -->
<section class="section" id="cara-kerja" aria-labelledby="how-title">
    <div class="container">
        <div class="section-header reveal">
            <div class="section-eyebrow">Cara Kerja</div>
            <h2 class="section-title" id="how-title">
                Mulai dalam <span class="gradient-text">3 langkah mudah</span>
            </h2>
            <p class="section-desc">Tidak butuh keahlian teknis. Bisnis kamu bisa online dalam hitungan menit.</p>
        </div>

        <div class="steps-grid">
            <!-- Step 1 -->
            <div class="step-card reveal reveal-delay-1" style="position:relative;">
                <div class="step-num" aria-hidden="true">01</div>
                <div class="step-icon" style="background:rgba(99,102,241,0.12)">📝</div>
                <div class="step-title">Daftar & Pilih Paket</div>
                <p class="step-desc">Daftar gratis 14 hari, pilih paket sesuai jenis bisnismu — LaundryFlow, BarberFlow, atau CafeFlow.</p>
                <div class="step-connector" aria-hidden="true"></div>
            </div>

            <!-- Step 2 -->
            <div class="step-card reveal reveal-delay-2" style="position:relative;">
                <div class="step-num" aria-hidden="true">02</div>
                <div class="step-icon" style="background:rgba(6,182,212,0.12)">⚡</div>
                <div class="step-title">Setup & Kustomisasi</div>
                <p class="step-desc">Isi profil bisnis, tambahkan daftar layanan dan harga, undang karyawan. Selesai dalam 5 menit.</p>
                <div class="step-connector" aria-hidden="true"></div>
            </div>

            <!-- Step 3 -->
            <div class="step-card reveal reveal-delay-3">
                <div class="step-num" aria-hidden="true">03</div>
                <div class="step-icon" style="background:rgba(16,185,129,0.12)">🚀</div>
                <div class="step-title">Terima Pesanan & Kelola</div>
                <p class="step-desc">Mulai terima pesanan, lacak status, cetak nota, dan pantau omzet dari dashboard yang intuitif.</p>
            </div>
        </div>
    </div>
</section>

<!-- =============================================
     PRODUCTS
============================================= -->
<section class="section" id="produk" style="padding-top:0" aria-labelledby="products-title">
    <div class="container">
        <div class="section-header reveal" style="text-align:center;">
            <div class="section-eyebrow">Produk Kami</div>
            <h2 class="section-title" id="products-title">
                Solusi untuk setiap <span class="gradient-text">jenis UMKM</span>
            </h2>
            <p class="section-desc" style="margin: 0 auto;">Masing-masing dibuat khusus, bukan solusi generik yang dipaksakan.</p>
        </div>

        <div class="products-grid">

            <!-- LaundryFlow -->
            <div class="product-card laundry reveal reveal-delay-1">
                <div class="prod-emoji" aria-hidden="true">👕</div>
                <div class="prod-name">LaundryFlow</div>
                <div class="prod-tagline">Manajemen laundry all-in-one</div>
                <ul class="prod-features" aria-label="Fitur LaundryFlow">
                    <li>Input pelanggan & berat cucian</li>
                    <li>Harga otomatis per kilogram</li>
                    <li>Tracking status: Cuci → Kering → Setrika → Selesai</li>
                    <li>Cetak nota termal & digital</li>
                    <li>Dashboard omzet harian/bulanan</li>
                    <li>Notifikasi WA otomatis ke pelanggan</li>
                </ul>
                <div class="prod-price">Rp 39.000 <span>/ bulan</span></div>
                <a href="/register?plan=laundry" class="prod-cta" id="cta-laundry">
                    Mulai LaundryFlow →
                </a>
            </div>

            <!-- BarberFlow -->
            <div class="product-card barber reveal reveal-delay-2">
                <div class="prod-emoji" aria-hidden="true">✂️</div>
                <div class="prod-name">BarberFlow</div>
                <div class="prod-tagline">Booking & antrian barbershop modern</div>
                <ul class="prod-features" aria-label="Fitur BarberFlow">
                    <li>Booking online oleh pelanggan</li>
                    <li>Pilih barber favorit & jam preferred</li>
                    <li>Manajemen antrian real-time</li>
                    <li>Jadwal shift barber</li>
                    <li>Laporan pendapatan per barber</li>
                    <li>Reminder otomatis via WhatsApp</li>
                </ul>
                <div class="prod-price">Rp 49.000 <span>/ bulan</span></div>
                <a href="/register?plan=barber" class="prod-cta" id="cta-barber">
                    Mulai BarberFlow →
                </a>
            </div>

            <!-- CafeFlow -->
            <div class="product-card cafe reveal reveal-delay-3">
                <div class="prod-emoji" aria-hidden="true">☕</div>
                <div class="prod-name">CafeFlow</div>
                <div class="prod-tagline">POS & manajemen pesanan cafe</div>
                <ul class="prod-features" aria-label="Fitur CafeFlow">
                    <li>Point of Sale (POS) kasir digital</li>
                    <li>Menu digital dengan QR code</li>
                    <li>Manajemen meja & pesanan</li>
                    <li>Stok bahan baku otomatis</li>
                    <li>Laporan penjualan per menu</li>
                    <li>Integrasi printer kasir</li>
                </ul>
                <div class="prod-price">Segera <span>Hadir</span></div>
                <a href="#" class="prod-cta" id="cta-cafe" style="opacity:0.5;cursor:not-allowed">
                    Coming Soon ⏳
                </a>
            </div>

        </div>
    </div>
</section>

<!-- =============================================
     PRICING
============================================= -->
<section class="section" id="harga" aria-labelledby="pricing-title">
    <div class="container">
        <div class="section-header reveal" style="text-align:center">
            <div class="section-eyebrow">Harga</div>
            <h2 class="section-title" id="pricing-title">
                Transparan, tanpa <span class="gradient-text-warm">biaya tersembunyi</span>
            </h2>
            <p class="section-desc" style="margin:0 auto">Pilih paket yang sesuai. Upgrade atau downgrade kapan saja.</p>
        </div>

        <div class="pricing-grid reveal">

            <!-- LaundryFlow -->
            <div class="pricing-card featured">
                <div class="pricing-popular" aria-label="Paling populer">⭐ Populer</div>
                <div class="pricing-icon" aria-hidden="true">👕</div>
                <div class="pricing-name">LaundryFlow</div>
                <div class="pricing-target">Untuk bisnis laundry</div>
                <div class="pricing-price">Rp 39.000 <span class="period">/ bulan</span></div>
                <div class="pricing-save">Hemat Rp 78.000 jika bayar tahunan</div>
                <div class="pricing-divider" aria-hidden="true"></div>
                <ul class="pricing-features" aria-label="Fitur LaundryFlow">
                    <li><div class="feat-check" aria-hidden="true">✓</div> Input pelanggan tak terbatas</li>
                    <li><div class="feat-check" aria-hidden="true">✓</div> Tracking status otomatis</li>
                    <li><div class="feat-check" aria-hidden="true">✓</div> Cetak nota digital & termal</li>
                    <li><div class="feat-check" aria-hidden="true">✓</div> Dashboard omzet real-time</li>
                    <li><div class="feat-check pro" aria-hidden="true">★</div> Notifikasi WhatsApp otomatis</li>
                    <li><div class="feat-check pro" aria-hidden="true">★</div> Laporan bulanan PDF</li>
                    <li><div class="feat-check pro" aria-hidden="true">★</div> Multi user (3 akun)</li>
                    <li><div class="feat-check pro" aria-hidden="true">★</div> Backup cloud otomatis</li>
                </ul>
                <a href="/register?plan=laundry" class="btn btn-primary pricing-btn" id="pricing-laundry-btn">
                    Coba Gratis 14 Hari →
                </a>
            </div>

            <!-- BarberFlow -->
            <div class="pricing-card">
                <div class="pricing-icon" aria-hidden="true">✂️</div>
                <div class="pricing-name">BarberFlow</div>
                <div class="pricing-target">Untuk barbershop & salon</div>
                <div class="pricing-price">Rp 49.000 <span class="period">/ bulan</span></div>
                <div class="pricing-save">Hemat Rp 98.000 jika bayar tahunan</div>
                <div class="pricing-divider" aria-hidden="true"></div>
                <ul class="pricing-features" aria-label="Fitur BarberFlow">
                    <li><div class="feat-check" aria-hidden="true">✓</div> Booking online pelanggan</li>
                    <li><div class="feat-check" aria-hidden="true">✓</div> Pilih barber & jam favorit</li>
                    <li><div class="feat-check" aria-hidden="true">✓</div> Manajemen antrian real-time</li>
                    <li><div class="feat-check" aria-hidden="true">✓</div> Jadwal shift barber</li>
                    <li><div class="feat-check pro" aria-hidden="true">★</div> Reminder WA ke pelanggan</li>
                    <li><div class="feat-check pro" aria-hidden="true">★</div> Laporan pendapatan per barber</li>
                    <li><div class="feat-check pro" aria-hidden="true">★</div> Multi user (5 akun)</li>
                    <li><div class="feat-check pro" aria-hidden="true">★</div> Backup cloud otomatis</li>
                </ul>
                <a href="/register?plan=barber" class="btn btn-outline pricing-btn" id="pricing-barber-btn">
                    Coba Gratis 14 Hari →
                </a>
            </div>

        </div>

        <p class="pricing-note">
            ★ = Fitur Premium &nbsp;·&nbsp;
            <span>Gratis 14 hari</span> untuk semua paket &nbsp;·&nbsp;
            Tidak perlu kartu kredit
        </p>
    </div>
</section>

<!-- =============================================
     TESTIMONIALS
============================================= -->
<section class="section" id="testimoni" style="padding-top:0" aria-labelledby="testi-title">
    <div class="container">
        <div class="section-header reveal" style="text-align:center">
            <div class="section-eyebrow">Testimoni</div>
            <h2 class="section-title" id="testi-title">
                Dipercaya ratusan <span class="gradient-text">UMKM Indonesia</span>
            </h2>
        </div>

        <div class="testimonials-grid">

            <div class="testi-card reveal reveal-delay-1">
                <div class="testi-stars" aria-label="5 bintang">★★★★★</div>
                <p class="testi-quote">
                    "Sebelum Zoneline, saya catat pesanan di buku manual. Sekarang semua digital, <strong>omzet naik 30%</strong> karena tidak ada pesanan yang ketinggalan."
                </p>
                <div class="testi-author">
                    <div class="testi-avatar" style="background:linear-gradient(135deg,#6366f1,#818cf8)" aria-hidden="true">S</div>
                    <div>
                        <div class="testi-name">Sari Dewi</div>
                        <div class="testi-biz">👕 Fresh & Clean Laundry, Bekasi</div>
                    </div>
                </div>
            </div>

            <div class="testi-card reveal reveal-delay-2">
                <div class="testi-stars" aria-label="5 bintang">★★★★★</div>
                <p class="testi-quote">
                    "Fitur booking online BarberFlow bikin pelanggan bisa antre dari rumah. <strong>Tidak ada lagi pelanggan nunggu lama</strong> dan komplain!"
                </p>
                <div class="testi-author">
                    <div class="testi-avatar" style="background:linear-gradient(135deg,#06b6d4,#0ea5e9)" aria-hidden="true">R</div>
                    <div>
                        <div class="testi-name">Rizky Pratama</div>
                        <div class="testi-biz">✂️ Barber King Studio, Tangerang</div>
                    </div>
                </div>
            </div>

            <div class="testi-card reveal reveal-delay-3">
                <div class="testi-stars" aria-label="5 bintang">★★★★★</div>
                <p class="testi-quote">
                    "Notifikasi WA otomatis ke pelanggan itu killer feature! <strong>Repeat order naik drastis</strong> karena pelanggan diingatkan kalau cucian sudah selesai."
                </p>
                <div class="testi-author">
                    <div class="testi-avatar" style="background:linear-gradient(135deg,#10b981,#059669)" aria-hidden="true">A</div>
                    <div>
                        <div class="testi-name">Ani Rahayu</div>
                        <div class="testi-biz">👕 Wash Express, Depok</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- =============================================
     FAQ
============================================= -->
<section class="section" id="faq" style="padding-top:0" aria-labelledby="faq-title">
    <div class="container">
        <div class="section-header reveal" style="text-align:center">
            <div class="section-eyebrow">FAQ</div>
            <h2 class="section-title" id="faq-title">
                Pertanyaan yang <span class="gradient-text">sering ditanya</span>
            </h2>
        </div>

        <div class="faq-list reveal" role="list">

            <div class="faq-item" role="listitem">
                <div class="faq-q" id="faq-q-1" aria-expanded="false" aria-controls="faq-a-1" tabindex="0" role="button">
                    Apakah ada biaya setup atau biaya tersembunyi?
                    <span class="faq-arrow" aria-hidden="true">▼</span>
                </div>
                <div class="faq-a" id="faq-a-1" role="region" aria-labelledby="faq-q-1">
                    Tidak ada! Zoneline 100% transparan. Kamu hanya bayar biaya langganan bulanan. Tidak ada biaya setup, tidak ada komisi dari pesanan, dan tidak ada biaya tersembunyi apapun.
                </div>
            </div>

            <div class="faq-item" role="listitem">
                <div class="faq-q" id="faq-q-2" aria-expanded="false" aria-controls="faq-a-2" tabindex="0" role="button">
                    Bisa diakses dari HP?
                    <span class="faq-arrow" aria-hidden="true">▼</span>
                </div>
                <div class="faq-a" id="faq-a-2" role="region" aria-labelledby="faq-q-2">
                    Ya! Zoneline adalah aplikasi web yang responsif, artinya bisa diakses dari HP, tablet, maupun laptop dengan tampilan yang optimal. Tidak perlu download apapun.
                </div>
            </div>

            <div class="faq-item" role="listitem">
                <div class="faq-q" id="faq-q-3" aria-expanded="false" aria-controls="faq-a-3" tabindex="0" role="button">
                    Apa yang terjadi setelah trial 14 hari berakhir?
                    <span class="faq-arrow" aria-hidden="true">▼</span>
                </div>
                <div class="faq-a" id="faq-a-3" role="region" aria-labelledby="faq-q-3">
                    Setelah trial berakhir, kamu bisa memilih untuk berlangganan berbayar. Data kamu aman dan tidak akan dihapus. Kami akan mengingatkan kamu 3 hari sebelum trial berakhir.
                </div>
            </div>

            <div class="faq-item" role="listitem">
                <div class="faq-q" id="faq-q-4" aria-expanded="false" aria-controls="faq-a-4" tabindex="0" role="button">
                    Bagaimana cara cetak nota? Butuh printer khusus?
                    <span class="faq-arrow" aria-hidden="true">▼</span>
                </div>
                <div class="faq-a" id="faq-a-4" role="region" aria-labelledby="faq-q-4">
                    Nota bisa dicetak ke printer termal (58mm/80mm) untuk nota fisik, atau bisa dikirim langsung sebagai gambar via WhatsApp ke pelanggan. Nota digital tidak butuh printer sama sekali.
                </div>
            </div>

            <div class="faq-item" role="listitem">
                <div class="faq-q" id="faq-q-5" aria-expanded="false" aria-controls="faq-a-5" tabindex="0" role="button">
                    Apakah data saya aman?
                    <span class="faq-arrow" aria-hidden="true">▼</span>
                </div>
                <div class="faq-a" id="faq-a-5" role="region" aria-labelledby="faq-q-5">
                    Sangat aman. Semua data dienkripsi dan disimpan di server Indonesia. Paket premium mendapat backup cloud otomatis setiap hari. Kamu juga bisa export data kapan saja.
                </div>
            </div>

        </div>
    </div>
</section>

<!-- =============================================
     CTA BANNER
============================================= -->
<section class="cta-banner" aria-labelledby="cta-title">
    <div class="container">
        <div class="cta-inner reveal">
            <div class="hero-eyebrow" style="margin-bottom:20px">
                <div class="hero-eyebrow-dot"></div>
                Tidak ada risiko — gratis 14 hari
            </div>
            <h2 class="cta-title" id="cta-title">
                Siap digitalkan<br>
                <span class="gradient-text">bisnis kamu sekarang?</span>
            </h2>
            <p class="cta-desc">
                Bergabunglah bersama 248+ UMKM yang sudah merasakan manfaat Zoneline. Mulai gratis, tidak perlu kartu kredit.
            </p>
            <div class="cta-actions">
                <a href="/register" class="btn btn-primary btn-xl" id="cta-final-btn">
                    🚀 Daftar Gratis Sekarang
                </a>
                <a href="https://wa.me/6281234567890" class="btn btn-outline btn-xl" id="cta-wa-btn" target="_blank" rel="noopener">
                    💬 Chat via WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

<!-- =============================================
     FOOTER
============================================= -->
<footer>
    <div class="container">
        <div class="footer-grid">

            <!-- Brand -->
            <div class="footer-brand">
                <div class="footer-logo">
                    <div class="footer-logo-icon" aria-hidden="true">Z</div>
                    <span class="footer-logo-name">Zoneline</span>
                </div>
                <p class="footer-tagline">
                    Platform SaaS all-in-one untuk UMKM Indonesia. Digitalkan bisnismu, tingkatkan omzetmu.
                </p>
                <div class="footer-socials" aria-label="Media sosial">
                    <a href="#" class="social-btn" aria-label="Instagram">📸</a>
                    <a href="#" class="social-btn" aria-label="TikTok">🎵</a>
                    <a href="#" class="social-btn" aria-label="Twitter/X">✖️</a>
                    <a href="#" class="social-btn" aria-label="WhatsApp">💬</a>
                </div>
            </div>

            <!-- Produk -->
            <div>
                <div class="footer-col-title">Produk</div>
                <ul class="footer-links">
                    <li><a href="#produk">LaundryFlow</a></li>
                    <li><a href="#produk">BarberFlow</a></li>
                    <li><a href="#produk">CafeFlow</a></li>
                    <li><a href="#harga">Harga</a></li>
                </ul>
            </div>

            <!-- Perusahaan -->
            <div>
                <div class="footer-col-title">Perusahaan</div>
                <ul class="footer-links">
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Karir</a></li>
                    <li><a href="#">Pers</a></li>
                </ul>
            </div>

            <!-- Bantuan -->
            <div>
                <div class="footer-col-title">Bantuan</div>
                <ul class="footer-links">
                    <li><a href="#">Dokumentasi</a></li>
                    <li><a href="#">Pusat Bantuan</a></li>
                    <li><a href="#">Status Sistem</a></li>
                    <li><a href="#">Hubungi Kami</a></li>
                </ul>
            </div>

        </div>

        <!-- Bottom Bar -->
        <div class="footer-bottom">
            <div class="footer-copy">
                © 2026 <a href="/">Zoneline</a>. Dibuat dengan ❤️ untuk UMKM Indonesia.
                &nbsp;·&nbsp; <a href="#">Privasi</a> &nbsp;·&nbsp; <a href="#">Syarat & Ketentuan</a>
            </div>
            <div class="footer-badges" aria-label="Keamanan">
                <span class="footer-badge">🔒 SSL</span>
                <span class="footer-badge">🇮🇩 Server Indonesia</span>
                <span class="footer-badge">✅ GDPR Ready</span>
            </div>
        </div>
    </div>
</footer>

<!-- =============================================
     JAVASCRIPT
============================================= -->
<script>
    // ── Scroll Reveal ──────────────────────────────
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                revealObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

    document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

    // ── FAQ Accordion ──────────────────────────────
    document.querySelectorAll('.faq-q').forEach(btn => {
        btn.addEventListener('click', () => {
            const item = btn.closest('.faq-item');
            const isOpen = item.classList.contains('open');

            // close all
            document.querySelectorAll('.faq-item').forEach(i => {
                i.classList.remove('open');
                i.querySelector('.faq-q').setAttribute('aria-expanded', 'false');
            });

            // open clicked if was closed
            if (!isOpen) {
                item.classList.add('open');
                btn.setAttribute('aria-expanded', 'true');
            }
        });

        // keyboard support
        btn.addEventListener('keydown', e => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                btn.click();
            }
        });
    });

    // ── Smooth anchor scroll ───────────────────────
    document.querySelectorAll('a[href^="#"]').forEach(link => {
        link.addEventListener('click', e => {
            const target = document.querySelector(link.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // ── Navbar background on scroll ───────────────
    const navbar = document.querySelector('.navbar-inner');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 60) {
            navbar.style.background = 'rgba(6,9,15,0.95)';
        } else {
            navbar.style.background = 'rgba(6,9,15,0.72)';
        }
    }, { passive: true });

    // ── Animate mock bars on hero ──────────────────
    const mockBars = document.querySelectorAll('.mock-bar');
    const heights = [35, 55, 45, 70, 60, 85, 75];
    let barFrame = 0;
    setInterval(() => {
        barFrame++;
        mockBars.forEach((bar, i) => {
            const h = heights[(i + barFrame) % heights.length];
            bar.style.height = h + '%';
        });
    }, 2000);

    // ── Ticker: hero floating badges mini animation
    const badges = document.querySelectorAll('.hero-badge');
    badges.forEach((badge, i) => {
        badge.style.animationDelay = `${-i * 2}s`;
    });
</script>

</body>
</html>
