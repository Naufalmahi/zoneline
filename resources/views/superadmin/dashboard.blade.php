<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Zoneline Super Admin Dashboard - Kelola seluruh platform SaaS UMKM dari satu tempat">
    <title>Super Admin — Zoneline</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <style>
        /* =============================================
           DESIGN SYSTEM — ZONELINE SUPER ADMIN
        ============================================= */
        :root {
            --bg-base:        #080c14;
            --bg-surface:     #0d1220;
            --bg-card:        #111827;
            --bg-card-hover:  #151f30;
            --border:         rgba(255,255,255,0.06);
            --border-glow:    rgba(99,102,241,0.3);

            --primary:        #6366f1;
            --primary-light:  #818cf8;
            --primary-dark:   #4f46e5;
            --primary-glow:   rgba(99,102,241,0.15);

            --accent-cyan:    #06b6d4;
            --accent-emerald: #10b981;
            --accent-amber:   #f59e0b;
            --accent-rose:    #f43f5e;
            --accent-violet:  #8b5cf6;

            --text-primary:   #f1f5f9;
            --text-secondary: #94a3b8;
            --text-muted:     #475569;

            --sidebar-w:      260px;
            --header-h:       68px;
            --radius:         14px;
            --radius-sm:      8px;
            --shadow-card:    0 4px 24px rgba(0,0,0,0.4);
            --transition:     0.22s cubic-bezier(0.4,0,0.2,1);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html { font-size: 15px; scroll-behavior: smooth; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-base);
            color: var(--text-primary);
            min-height: 100vh;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* =============================================
           SIDEBAR
        ============================================= */
        .sidebar {
            position: fixed;
            left: 0; top: 0; bottom: 0;
            width: var(--sidebar-w);
            background: var(--bg-surface);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            z-index: 100;
            transition: transform var(--transition);
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 22px 20px 18px;
            border-bottom: 1px solid var(--border);
        }

        .logo-icon {
            width: 38px; height: 38px;
            background: linear-gradient(135deg, var(--primary), var(--accent-cyan));
            border-radius: 10px;
            display: grid;
            place-items: center;
            font-size: 18px;
            font-weight: 800;
            color: #fff;
            letter-spacing: -1px;
            flex-shrink: 0;
            box-shadow: 0 0 20px rgba(99,102,241,0.4);
        }

        .logo-text {
            font-size: 1.15rem;
            font-weight: 800;
            background: linear-gradient(135deg, #fff 30%, var(--primary-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .logo-badge {
            font-size: 0.6rem;
            font-weight: 700;
            background: linear-gradient(90deg, var(--primary), var(--accent-cyan));
            color: #fff;
            padding: 2px 7px;
            border-radius: 20px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-top: 2px;
        }

        .sidebar-section {
            padding: 16px 14px 6px;
        }

        .sidebar-section-label {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: var(--text-muted);
            padding: 0 8px;
            margin-bottom: 6px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 10px 12px;
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: all var(--transition);
            color: var(--text-secondary);
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            position: relative;
            margin-bottom: 2px;
        }

        .nav-item:hover {
            background: rgba(255,255,255,0.05);
            color: var(--text-primary);
        }

        .nav-item.active {
            background: var(--primary-glow);
            color: var(--primary-light);
            border: 1px solid var(--border-glow);
        }

        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0; top: 20%; bottom: 20%;
            width: 3px;
            background: var(--primary);
            border-radius: 0 3px 3px 0;
        }

        .nav-icon {
            width: 20px; height: 20px;
            display: grid;
            place-items: center;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .nav-badge {
            margin-left: auto;
            font-size: 0.65rem;
            font-weight: 700;
            background: var(--primary);
            color: #fff;
            padding: 2px 7px;
            border-radius: 20px;
        }

        .nav-badge.green { background: var(--accent-emerald); }
        .nav-badge.amber { background: var(--accent-amber); color: #000; }

        .sidebar-footer {
            margin-top: auto;
            padding: 14px;
            border-top: 1px solid var(--border);
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: background var(--transition);
        }

        .admin-profile:hover { background: rgba(255,255,255,0.05); }

        .avatar {
            width: 34px; height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--accent-violet));
            display: grid;
            place-items: center;
            font-size: 0.8rem;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }

        .admin-info { flex: 1; min-width: 0; }
        .admin-name { font-size: 0.82rem; font-weight: 600; color: var(--text-primary); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .admin-role { font-size: 0.68rem; color: var(--text-muted); margin-top: 1px; }

        /* =============================================
           MAIN LAYOUT
        ============================================= */
        .main {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* =============================================
           HEADER / TOPBAR
        ============================================= */
        .topbar {
            height: var(--header-h);
            background: rgba(13, 18, 32, 0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            padding: 0 28px;
            gap: 16px;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .topbar-title {
            flex: 1;
        }

        .topbar-title h1 {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        .topbar-title p {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-top: 1px;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .search-bar {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--border);
            border-radius: 40px;
            padding: 8px 16px;
            transition: all var(--transition);
            cursor: text;
        }

        .search-bar:hover, .search-bar:focus-within {
            border-color: var(--border-glow);
            background: rgba(99,102,241,0.06);
        }

        .search-bar input {
            background: none;
            border: none;
            outline: none;
            font-family: inherit;
            font-size: 0.82rem;
            color: var(--text-primary);
            width: 180px;
        }

        .search-bar input::placeholder { color: var(--text-muted); }

        .icon-btn {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--border);
            display: grid;
            place-items: center;
            cursor: pointer;
            transition: all var(--transition);
            color: var(--text-secondary);
            font-size: 1rem;
            position: relative;
        }

        .icon-btn:hover {
            background: rgba(99,102,241,0.1);
            border-color: var(--border-glow);
            color: var(--primary-light);
        }

        .notif-dot {
            position: absolute;
            top: 6px; right: 6px;
            width: 8px; height: 8px;
            background: var(--accent-rose);
            border-radius: 50%;
            border: 2px solid var(--bg-surface);
        }

        .date-chip {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.78rem;
            color: var(--text-secondary);
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--border);
            padding: 7px 13px;
            border-radius: 30px;
        }

        /* =============================================
           PAGE CONTENT
        ============================================= */
        .page-content {
            padding: 26px 28px 40px;
            flex: 1;
        }

        /* =============================================
           METRIC CARDS
        ============================================= */
        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .metric-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 20px;
            position: relative;
            overflow: hidden;
            cursor: default;
            transition: all var(--transition);
        }

        .metric-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, var(--card-glow, rgba(99,102,241,0)) 0%, transparent 60%);
            opacity: 0;
            transition: opacity var(--transition);
        }

        .metric-card:hover {
            border-color: rgba(255,255,255,0.1);
            transform: translateY(-2px);
            box-shadow: var(--shadow-card);
        }

        .metric-card:hover::before { opacity: 1; }

        .metric-card.indigo { --card-glow: rgba(99,102,241,0.12); }
        .metric-card.cyan   { --card-glow: rgba(6,182,212,0.12); }
        .metric-card.emerald{ --card-glow: rgba(16,185,129,0.12); }
        .metric-card.amber  { --card-glow: rgba(245,158,11,0.12); }

        .metric-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 14px;
        }

        .metric-label {
            font-size: 0.78rem;
            font-weight: 500;
            color: var(--text-secondary);
            letter-spacing: 0.3px;
        }

        .metric-icon {
            width: 38px; height: 38px;
            border-radius: 10px;
            display: grid;
            place-items: center;
            font-size: 1.1rem;
        }

        .metric-icon.indigo  { background: rgba(99,102,241,0.15); color: var(--primary-light); }
        .metric-icon.cyan    { background: rgba(6,182,212,0.15);  color: var(--accent-cyan); }
        .metric-icon.emerald { background: rgba(16,185,129,0.15); color: var(--accent-emerald); }
        .metric-icon.amber   { background: rgba(245,158,11,0.15); color: var(--accent-amber); }

        .metric-value {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--text-primary);
            line-height: 1;
            letter-spacing: -0.5px;
        }

        .metric-sub {
            font-size: 0.72rem;
            color: var(--text-muted);
            margin-top: 4px;
        }

        .metric-change {
            display: inline-flex;
            align-items: center;
            gap: 3px;
            font-size: 0.72rem;
            font-weight: 600;
            margin-top: 10px;
            padding: 3px 8px;
            border-radius: 20px;
        }

        .metric-change.up    { background: rgba(16,185,129,0.12); color: var(--accent-emerald); }
        .metric-change.down  { background: rgba(244,63,94,0.12);  color: var(--accent-rose); }
        .metric-change.flat  { background: rgba(148,163,184,0.1); color: var(--text-secondary); }

        /* =============================================
           CHART SECTION
        ============================================= */
        .charts-grid {
            display: grid;
            grid-template-columns: 1.6fr 1fr;
            gap: 16px;
            margin-bottom: 24px;
        }

        .card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 22px;
            transition: border-color var(--transition);
        }

        .card:hover { border-color: rgba(255,255,255,0.09); }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        .card-subtitle {
            font-size: 0.72rem;
            color: var(--text-muted);
            margin-top: 2px;
        }

        .card-action-btn {
            font-size: 0.72rem;
            font-weight: 600;
            color: var(--primary-light);
            background: rgba(99,102,241,0.1);
            border: 1px solid rgba(99,102,241,0.2);
            padding: 5px 12px;
            border-radius: 20px;
            cursor: pointer;
            transition: all var(--transition);
            text-decoration: none;
        }

        .card-action-btn:hover {
            background: rgba(99,102,241,0.2);
            border-color: var(--primary);
        }

        .chart-container {
            position: relative;
            height: 220px;
        }

        /* =============================================
           DONUT / PIE CHART LEGEND
        ============================================= */
        .plan-legend {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 16px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .legend-dot {
            width: 10px; height: 10px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .legend-label {
            font-size: 0.8rem;
            color: var(--text-secondary);
            flex: 1;
        }

        .legend-value {
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        .legend-pct {
            font-size: 0.7rem;
            color: var(--text-muted);
            width: 34px;
            text-align: right;
        }

        /* =============================================
           BOTTOM GRID
        ============================================= */
        .bottom-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 16px;
        }

        /* =============================================
           TABLE
        ============================================= */
        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--text-muted);
            text-align: left;
            padding: 10px 14px;
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
        }

        tbody tr {
            transition: background var(--transition);
        }

        tbody tr:hover { background: rgba(255,255,255,0.025); }

        tbody td {
            padding: 13px 14px;
            font-size: 0.82rem;
            color: var(--text-secondary);
            border-bottom: 1px solid rgba(255,255,255,0.03);
            vertical-align: middle;
        }

        .tenant-name {
            font-weight: 600;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .tenant-avatar {
            width: 28px; height: 28px;
            border-radius: 7px;
            display: grid;
            place-items: center;
            font-size: 0.75rem;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 0.7rem;
            font-weight: 600;
            padding: 3px 9px;
            border-radius: 20px;
        }

        .status-badge::before {
            content: '';
            width: 6px; height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .status-badge.active   { background: rgba(16,185,129,0.12); color: var(--accent-emerald); }
        .status-badge.trial    { background: rgba(245,158,11,0.12); color: var(--accent-amber); }
        .status-badge.inactive { background: rgba(244,63,94,0.12);  color: var(--accent-rose); }

        .plan-tag {
            font-size: 0.68rem;
            font-weight: 600;
            padding: 3px 8px;
            border-radius: 6px;
        }

        .plan-tag.laundry   { background: rgba(99,102,241,0.12); color: var(--primary-light); }
        .plan-tag.barber    { background: rgba(6,182,212,0.12);  color: var(--accent-cyan); }
        .plan-tag.cafe      { background: rgba(245,158,11,0.12); color: var(--accent-amber); }

        /* =============================================
           ACTIVITY FEED
        ============================================= */
        .activity-list {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .activity-item {
            display: flex;
            gap: 12px;
            padding: 13px 0;
            border-bottom: 1px solid rgba(255,255,255,0.03);
            position: relative;
        }

        .activity-item:last-child { border-bottom: none; }

        .activity-icon {
            width: 32px; height: 32px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            font-size: 0.8rem;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .activity-icon.purple { background: rgba(139,92,246,0.15); color: var(--accent-violet); }
        .activity-icon.cyan   { background: rgba(6,182,212,0.15);  color: var(--accent-cyan); }
        .activity-icon.green  { background: rgba(16,185,129,0.15); color: var(--accent-emerald); }
        .activity-icon.amber  { background: rgba(245,158,11,0.15); color: var(--accent-amber); }
        .activity-icon.rose   { background: rgba(244,63,94,0.15);  color: var(--accent-rose); }

        .activity-text {
            flex: 1;
        }

        .activity-title {
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--text-primary);
            line-height: 1.4;
        }

        .activity-title span {
            font-weight: 700;
        }

        .activity-time {
            font-size: 0.7rem;
            color: var(--text-muted);
            margin-top: 2px;
        }

        /* =============================================
           REVENUE MINI BARS
        ============================================= */
        .mini-bars {
            display: flex;
            align-items: flex-end;
            gap: 4px;
            height: 48px;
            margin-top: auto;
        }

        .mini-bar {
            flex: 1;
            background: linear-gradient(to top, var(--primary), var(--accent-cyan));
            border-radius: 3px 3px 0 0;
            opacity: 0.6;
            transition: opacity var(--transition);
            min-height: 4px;
        }

        .mini-bar:hover { opacity: 1; }
        .mini-bar.peak  { opacity: 1; }

        /* =============================================
           PROGRESS BARS
        ============================================= */
        .progress-bar-wrap {
            background: rgba(255,255,255,0.05);
            border-radius: 100px;
            height: 5px;
            overflow: hidden;
        }

        .progress-bar-fill {
            height: 100%;
            border-radius: 100px;
            background: linear-gradient(90deg, var(--primary), var(--accent-cyan));
        }

        /* =============================================
           PLAN GROWTH CARD
        ============================================= */
        .plan-rows {
            display: flex;
            flex-direction: column;
            gap: 14px;
            margin-top: 4px;
        }

        .plan-row {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .plan-row-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .plan-row-name {
            font-size: 0.8rem;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .plan-row-count {
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        /* =============================================
           SCROLLBAR
        ============================================= */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.08); border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.14); }

        /* =============================================
           PULSE ANIMATION
        ============================================= */
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 0 0 rgba(99,102,241,0.4); }
            50%       { box-shadow: 0 0 0 8px rgba(99,102,241,0); }
        }

        @keyframes count-up {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .animate-in {
            animation: count-up 0.5s ease forwards;
        }

        @keyframes shimmer {
            0%   { background-position: -400px 0; }
            100% { background-position: 400px 0; }
        }

        /* =============================================
           LIVE INDICATOR
        ============================================= */
        .live-chip {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 0.65rem;
            font-weight: 700;
            color: var(--accent-emerald);
            background: rgba(16,185,129,0.1);
            border: 1px solid rgba(16,185,129,0.2);
            padding: 3px 9px;
            border-radius: 20px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .live-dot {
            width: 6px; height: 6px;
            background: var(--accent-emerald);
            border-radius: 50%;
            animation: pulse-glow 2s infinite;
        }

        /* =============================================
           TOOLTIP
        ============================================= */
        [data-tooltip] {
            position: relative;
        }

        [data-tooltip]::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 110%;
            left: 50%;
            transform: translateX(-50%);
            background: #1e293b;
            color: var(--text-primary);
            font-size: 0.7rem;
            padding: 5px 10px;
            border-radius: 6px;
            white-space: nowrap;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.2s;
            border: 1px solid var(--border);
        }

        [data-tooltip]:hover::after { opacity: 1; }

        /* =============================================
           RESPONSIVE
        ============================================= */
        @media (max-width: 1280px) {
            .metrics-grid { grid-template-columns: repeat(2, 1fr); }
            .charts-grid  { grid-template-columns: 1fr; }
            .bottom-grid  { grid-template-columns: 1fr; }
        }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .main    { margin-left: 0; }
            .metrics-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>

<body>

<!-- =============================================
     SIDEBAR
============================================= -->
<aside class="sidebar" id="sidebar">

    <!-- Logo -->
    <div class="sidebar-logo">
        <div class="logo-icon">Z</div>
        <div>
            <div class="logo-text">Zoneline</div>
            <div class="logo-badge">Super Admin</div>
        </div>
    </div>

    <!-- Overview -->
    <div class="sidebar-section">
        <div class="sidebar-section-label">Overview</div>
        <a href="#" class="nav-item active" id="nav-dashboard">
            <span class="nav-icon">📊</span>
            Dashboard
        </a>
        <a href="#" class="nav-item" id="nav-analytics">
            <span class="nav-icon">📈</span>
            Analytics
            <span class="nav-badge">Baru</span>
        </a>
        <a href="#" class="nav-item" id="nav-revenue">
            <span class="nav-icon">💰</span>
            Pendapatan
        </a>
    </div>

    <!-- Tenant Management -->
    <div class="sidebar-section">
        <div class="sidebar-section-label">Tenant</div>
        <a href="#" class="nav-item" id="nav-tenants">
            <span class="nav-icon">🏢</span>
            Semua Tenant
            <span class="nav-badge green">248</span>
        </a>
        <a href="#" class="nav-item" id="nav-laundry">
            <span class="nav-icon">👕</span>
            LaundryFlow
        </a>
        <a href="#" class="nav-item" id="nav-barber">
            <span class="nav-icon">✂️</span>
            BarberFlow
        </a>
        <a href="#" class="nav-item" id="nav-cafe">
            <span class="nav-icon">☕</span>
            CafeFlow
        </a>
    </div>

    <!-- Subscription -->
    <div class="sidebar-section">
        <div class="sidebar-section-label">Langganan</div>
        <a href="#" class="nav-item" id="nav-plans">
            <span class="nav-icon">💎</span>
            Paket & Harga
        </a>
        <a href="#" class="nav-item" id="nav-invoices">
            <span class="nav-icon">🧾</span>
            Invoice
            <span class="nav-badge amber">12</span>
        </a>
        <a href="#" class="nav-item" id="nav-churn">
            <span class="nav-icon">⚠️</span>
            Churn Risk
        </a>
    </div>

    <!-- System -->
    <div class="sidebar-section">
        <div class="sidebar-section-label">Sistem</div>
        <a href="#" class="nav-item" id="nav-users">
            <span class="nav-icon">👥</span>
            Pengguna
        </a>
        <a href="#" class="nav-item" id="nav-settings">
            <span class="nav-icon">⚙️</span>
            Pengaturan
        </a>
        <a href="#" class="nav-item" id="nav-logs">
            <span class="nav-icon">📋</span>
            Activity Log
        </a>
    </div>

    <!-- Admin Profile -->
    <div class="sidebar-footer">
        <div class="admin-profile">
            <div class="avatar">SA</div>
            <div class="admin-info">
                <div class="admin-name">Super Admin</div>
                <div class="admin-role">admin@zoneline.id</div>
            </div>
            <span style="color:var(--text-muted); font-size:1rem;">⋯</span>
        </div>
    </div>

</aside>

<!-- =============================================
     MAIN
============================================= -->
<div class="main">

    <!-- TOPBAR -->
    <header class="topbar">
        <div class="topbar-title">
            <h1>Dashboard</h1>
            <p>Selamat datang kembali — ringkasan platform hari ini</p>
        </div>

        <div class="topbar-actions">
            <!-- Search -->
            <div class="search-bar">
                <span style="color:var(--text-muted)">🔍</span>
                <input type="text" id="search-input" placeholder="Cari tenant, invoice...">
            </div>

            <!-- Date chip -->
            <div class="date-chip">
                📅
                <span id="today-date">26 Jul 2026</span>
            </div>

            <!-- Notification -->
            <button class="icon-btn" id="notif-btn" data-tooltip="Notifikasi" aria-label="Notifikasi">
                🔔
                <span class="notif-dot"></span>
            </button>

            <!-- Settings -->
            <button class="icon-btn" id="settings-btn" data-tooltip="Pengaturan" aria-label="Pengaturan">⚙️</button>
        </div>
    </header>

    <!-- PAGE CONTENT -->
    <main class="page-content">

        <!-- ==================
             METRIC CARDS
        ================== -->
        <div class="metrics-grid">

            <!-- Total Tenant -->
            <div class="metric-card indigo animate-in" style="animation-delay:0s">
                <div class="metric-header">
                    <div class="metric-label">Total Tenant Aktif</div>
                    <div class="metric-icon indigo">🏢</div>
                </div>
                <div class="metric-value" id="m-tenants">248</div>
                <div class="metric-sub">Dari 3 jenis layanan</div>
                <div class="metric-change up">▲ 12 tenant bulan ini</div>
            </div>

            <!-- MRR -->
            <div class="metric-card cyan animate-in" style="animation-delay:0.08s">
                <div class="metric-header">
                    <div class="metric-label">MRR (Pendapatan Bulanan)</div>
                    <div class="metric-icon cyan">💰</div>
                </div>
                <div class="metric-value" id="m-mrr">Rp<span>11,6jt</span></div>
                <div class="metric-sub">Monthly Recurring Revenue</div>
                <div class="metric-change up">▲ 8.4% vs bulan lalu</div>
            </div>

            <!-- Churn Rate -->
            <div class="metric-card emerald animate-in" style="animation-delay:0.16s">
                <div class="metric-header">
                    <div class="metric-label">Churn Rate</div>
                    <div class="metric-icon emerald">📉</div>
                </div>
                <div class="metric-value">2.1<span style="font-size:1rem;font-weight:500">%</span></div>
                <div class="metric-sub">Rendah dari target 5%</div>
                <div class="metric-change down">▼ 0.3% — bagus!</div>
            </div>

            <!-- Trial -->
            <div class="metric-card amber animate-in" style="animation-delay:0.24s">
                <div class="metric-header">
                    <div class="metric-label">Trial Aktif</div>
                    <div class="metric-icon amber">⏳</div>
                </div>
                <div class="metric-value">34</div>
                <div class="metric-sub">Berakhir dalam 7 hari</div>
                <div class="metric-change flat">→ 8 konversi minggu ini</div>
            </div>

        </div>

        <!-- ==================
             CHARTS ROW
        ================== -->
        <div class="charts-grid">

            <!-- Revenue Chart -->
            <div class="card">
                <div class="card-header">
                    <div>
                        <div class="card-title">Tren Pendapatan</div>
                        <div class="card-subtitle">6 bulan terakhir · dalam juta rupiah</div>
                    </div>
                    <div style="display:flex;align-items:center;gap:8px;">
                        <div class="live-chip">
                            <div class="live-dot"></div>
                            Live
                        </div>
                        <a href="#" class="card-action-btn">Lihat Detail</a>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>

            <!-- Plan Distribution Donut -->
            <div class="card">
                <div class="card-header">
                    <div>
                        <div class="card-title">Distribusi Paket</div>
                        <div class="card-subtitle">Per jenis layanan</div>
                    </div>
                </div>
                <div class="chart-container" style="height:160px;">
                    <canvas id="planChart"></canvas>
                </div>
                <div class="plan-legend">
                    <div class="legend-item">
                        <div class="legend-dot" style="background:#6366f1"></div>
                        <div class="legend-label">LaundryFlow</div>
                        <div class="legend-value">124</div>
                        <div class="legend-pct">50%</div>
                    </div>
                    <div class="legend-item">
                        <div class="legend-dot" style="background:#06b6d4"></div>
                        <div class="legend-label">BarberFlow</div>
                        <div class="legend-value">89</div>
                        <div class="legend-pct">36%</div>
                    </div>
                    <div class="legend-item">
                        <div class="legend-dot" style="background:#f59e0b"></div>
                        <div class="legend-label">CafeFlow</div>
                        <div class="legend-value">35</div>
                        <div class="legend-pct">14%</div>
                    </div>
                </div>
            </div>

        </div>

        <!-- ==================
             BOTTOM ROW
        ================== -->
        <div class="bottom-grid">

            <!-- Tenant Table -->
            <div class="card">
                <div class="card-header">
                    <div>
                        <div class="card-title">Tenant Terbaru</div>
                        <div class="card-subtitle">Daftar bisnis yang baru bergabung</div>
                    </div>
                    <a href="#" class="card-action-btn">Lihat Semua</a>
                </div>
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama Bisnis</th>
                                <th>Paket</th>
                                <th>Status</th>
                                <th>MRR</th>
                                <th>Bergabung</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="tenant-name">
                                        <div class="tenant-avatar" style="background:linear-gradient(135deg,#6366f1,#818cf8)">W</div>
                                        Wash & Go Laundry
                                    </div>
                                </td>
                                <td><span class="plan-tag laundry">LaundryFlow</span></td>
                                <td><span class="status-badge active">Aktif</span></td>
                                <td style="font-weight:600;color:var(--text-primary)">Rp 39rb</td>
                                <td>20 Jul 2026</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="tenant-name">
                                        <div class="tenant-avatar" style="background:linear-gradient(135deg,#06b6d4,#0891b2)">B</div>
                                        Barber King Studio
                                    </div>
                                </td>
                                <td><span class="plan-tag barber">BarberFlow</span></td>
                                <td><span class="status-badge active">Aktif</span></td>
                                <td style="font-weight:600;color:var(--text-primary)">Rp 49rb</td>
                                <td>18 Jul 2026</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="tenant-name">
                                        <div class="tenant-avatar" style="background:linear-gradient(135deg,#f59e0b,#d97706)">K</div>
                                        Kopi Kenangan BSD
                                    </div>
                                </td>
                                <td><span class="plan-tag cafe">CafeFlow</span></td>
                                <td><span class="status-badge trial">Trial</span></td>
                                <td style="color:var(--text-muted)">—</td>
                                <td>16 Jul 2026</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="tenant-name">
                                        <div class="tenant-avatar" style="background:linear-gradient(135deg,#6366f1,#8b5cf6)">F</div>
                                        Fresh Clean Laundry
                                    </div>
                                </td>
                                <td><span class="plan-tag laundry">LaundryFlow</span></td>
                                <td><span class="status-badge active">Aktif</span></td>
                                <td style="font-weight:600;color:var(--text-primary)">Rp 39rb</td>
                                <td>14 Jul 2026</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="tenant-name">
                                        <div class="tenant-avatar" style="background:linear-gradient(135deg,#06b6d4,#6366f1)">P</div>
                                        Pro Cut Barbershop
                                    </div>
                                </td>
                                <td><span class="plan-tag barber">BarberFlow</span></td>
                                <td><span class="status-badge inactive">Nonaktif</span></td>
                                <td style="color:var(--text-muted)">—</td>
                                <td>10 Jul 2026</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Right column: Activity + Plan Growth -->
            <div style="display:flex;flex-direction:column;gap:16px;">

                <!-- Activity Feed -->
                <div class="card">
                    <div class="card-header">
                        <div>
                            <div class="card-title">Aktivitas Terkini</div>
                            <div class="card-subtitle">Real-time platform events</div>
                        </div>
                        <div class="live-chip">
                            <div class="live-dot"></div>
                            Live
                        </div>
                    </div>
                    <div class="activity-list">
                        <div class="activity-item">
                            <div class="activity-icon purple">🎉</div>
                            <div class="activity-text">
                                <div class="activity-title"><span>Wash & Go</span> berlangganan LaundryFlow</div>
                                <div class="activity-time">2 menit lalu</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon green">💳</div>
                            <div class="activity-text">
                                <div class="activity-title">Pembayaran <span>Rp 49.000</span> dari BarberKing</div>
                                <div class="activity-time">15 menit lalu</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon cyan">👤</div>
                            <div class="activity-text">
                                <div class="activity-title"><span>Kopi Kenangan BSD</span> mulai trial 14 hari</div>
                                <div class="activity-time">1 jam lalu</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon amber">⚠️</div>
                            <div class="activity-text">
                                <div class="activity-title"><span>Pro Cut</span> — langganan hampir habis</div>
                                <div class="activity-time">3 jam lalu</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon rose">🔁</div>
                            <div class="activity-text">
                                <div class="activity-title">Auto-renewal gagal untuk <span>2 tenant</span></div>
                                <div class="activity-time">5 jam lalu</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Plan Growth -->
                <div class="card">
                    <div class="card-header">
                        <div>
                            <div class="card-title">Pertumbuhan Paket</div>
                            <div class="card-subtitle">Target vs aktual bulan ini</div>
                        </div>
                    </div>
                    <div class="plan-rows">
                        <div class="plan-row">
                            <div class="plan-row-header">
                                <span class="plan-row-name">👕 LaundryFlow</span>
                                <span class="plan-row-count">124 / 150</span>
                            </div>
                            <div class="progress-bar-wrap">
                                <div class="progress-bar-fill" style="width:82%;background:linear-gradient(90deg,#6366f1,#818cf8)"></div>
                            </div>
                        </div>
                        <div class="plan-row">
                            <div class="plan-row-header">
                                <span class="plan-row-name">✂️ BarberFlow</span>
                                <span class="plan-row-count">89 / 100</span>
                            </div>
                            <div class="progress-bar-wrap">
                                <div class="progress-bar-fill" style="width:89%;background:linear-gradient(90deg,#06b6d4,#0ea5e9)"></div>
                            </div>
                        </div>
                        <div class="plan-row">
                            <div class="plan-row-header">
                                <span class="plan-row-name">☕ CafeFlow</span>
                                <span class="plan-row-count">35 / 80</span>
                            </div>
                            <div class="progress-bar-wrap">
                                <div class="progress-bar-fill" style="width:44%;background:linear-gradient(90deg,#f59e0b,#fbbf24)"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </main>
</div>

<!-- =============================================
     JAVASCRIPT
============================================= -->
<script>
    // ── Dynamic Date ───────────────────────────────────
    const dateEl = document.getElementById('today-date');
    if (dateEl) {
        const now = new Date();
        dateEl.textContent = now.toLocaleDateString('id-ID', {
            day: 'numeric', month: 'short', year: 'numeric'
        });
    }

    // ── Revenue Chart ──────────────────────────────────
    const revCtx = document.getElementById('revenueChart').getContext('2d');

    const gradient = revCtx.createLinearGradient(0, 0, 0, 220);
    gradient.addColorStop(0, 'rgba(99,102,241,0.35)');
    gradient.addColorStop(1, 'rgba(99,102,241,0)');

    const gradient2 = revCtx.createLinearGradient(0, 0, 0, 220);
    gradient2.addColorStop(0, 'rgba(6,182,212,0.25)');
    gradient2.addColorStop(1, 'rgba(6,182,212,0)');

    new Chart(revCtx, {
        type: 'line',
        data: {
            labels: ['Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul'],
            datasets: [
                {
                    label: 'Total Pendapatan (jt)',
                    data: [6.2, 7.1, 8.0, 9.3, 10.4, 11.6],
                    borderColor: '#6366f1',
                    backgroundColor: gradient,
                    borderWidth: 2.5,
                    fill: true,
                    tension: 0.45,
                    pointBackgroundColor: '#6366f1',
                    pointRadius: 4,
                    pointHoverRadius: 7,
                },
                {
                    label: 'Target (jt)',
                    data: [7, 8, 9, 10, 11, 12],
                    borderColor: '#06b6d4',
                    backgroundColor: gradient2,
                    borderWidth: 2,
                    borderDash: [6, 4],
                    fill: true,
                    tension: 0.45,
                    pointRadius: 0,
                    pointHoverRadius: 5,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: { mode: 'index', intersect: false },
            plugins: {
                legend: {
                    labels: {
                        color: '#94a3b8',
                        font: { family: 'Plus Jakarta Sans', size: 11 },
                        boxWidth: 12,
                        padding: 16,
                    }
                },
                tooltip: {
                    backgroundColor: '#1e293b',
                    titleColor: '#f1f5f9',
                    bodyColor: '#94a3b8',
                    borderColor: 'rgba(255,255,255,0.08)',
                    borderWidth: 1,
                    padding: 12,
                    cornerRadius: 10,
                    callbacks: {
                        label: ctx => ` Rp ${ctx.raw}jt`
                    }
                }
            },
            scales: {
                x: {
                    grid: { color: 'rgba(255,255,255,0.04)', drawBorder: false },
                    ticks: { color: '#475569', font: { family: 'Plus Jakarta Sans', size: 11 } }
                },
                y: {
                    grid: { color: 'rgba(255,255,255,0.04)', drawBorder: false },
                    ticks: {
                        color: '#475569',
                        font: { family: 'Plus Jakarta Sans', size: 11 },
                        callback: v => `${v}jt`
                    }
                }
            }
        }
    });

    // ── Plan Donut Chart ───────────────────────────────
    const planCtx = document.getElementById('planChart').getContext('2d');

    new Chart(planCtx, {
        type: 'doughnut',
        data: {
            labels: ['LaundryFlow', 'BarberFlow', 'CafeFlow'],
            datasets: [{
                data: [124, 89, 35],
                backgroundColor: ['#6366f1', '#06b6d4', '#f59e0b'],
                hoverBackgroundColor: ['#818cf8', '#22d3ee', '#fbbf24'],
                borderColor: '#111827',
                borderWidth: 3,
                hoverBorderWidth: 4,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '72%',
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1e293b',
                    titleColor: '#f1f5f9',
                    bodyColor: '#94a3b8',
                    borderColor: 'rgba(255,255,255,0.08)',
                    borderWidth: 1,
                    padding: 10,
                    cornerRadius: 10,
                    callbacks: {
                        label: ctx => ` ${ctx.label}: ${ctx.raw} tenant`
                    }
                }
            }
        }
    });

    // ── Nav active state ───────────────────────────────
    document.querySelectorAll('.nav-item').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelectorAll('.nav-item').forEach(i => i.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // ── Simulate live activity feed ticker ─────────────
    const activities = [
        { icon: '🎉', cls: 'purple', title: '<span>Barokah Laundry</span> mulai berlangganan', time: 'Baru saja' },
        { icon: '💳', cls: 'green', title: 'Pembayaran <span>Rp 39.000</span> dari Fresh Clean', time: '1 menit lalu' },
        { icon: '👤', cls: 'cyan', title: '<span>Pangkas Bro</span> memperbarui profil', time: '2 menit lalu' },
        { icon: '⚠️', cls: 'amber', title: '<span>Kedai Senja</span> — trial berakhir besok', time: '4 menit lalu' },
        { icon: '🔁', cls: 'rose', title: 'Gagal renewal untuk <span>3 tenant</span>', time: '10 menit lalu' },
    ];

    let actIdx = 0;
    setInterval(() => {
        const list = document.querySelector('.activity-list');
        if (!list) return;

        const a = activities[actIdx % activities.length];
        actIdx++;

        const item = document.createElement('div');
        item.className = 'activity-item';
        item.style.opacity = '0';
        item.style.transform = 'translateY(-10px)';
        item.innerHTML = `
            <div class="activity-icon ${a.cls}">${a.icon}</div>
            <div class="activity-text">
                <div class="activity-title">${a.title}</div>
                <div class="activity-time">${a.time}</div>
            </div>
        `;

        list.insertBefore(item, list.firstChild);

        requestAnimationFrame(() => {
            item.style.transition = 'all 0.4s ease';
            item.style.opacity = '1';
            item.style.transform = 'translateY(0)';
        });

        // remove last item if > 6
        const items = list.querySelectorAll('.activity-item');
        if (items.length > 6) {
            const last = items[items.length - 1];
            last.style.transition = 'opacity 0.3s ease';
            last.style.opacity = '0';
            setTimeout(() => last.remove(), 300);
        }
    }, 7000);
</script>

</body>
</html>
