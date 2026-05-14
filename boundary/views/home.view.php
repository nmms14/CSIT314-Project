<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avatar — Empower Causes That Matter</title>

    <style>
        * {
            box-sizing: border-box;
        }

        :root {
            --blue-900: #1e3a8a;
            --blue-700: #1d4ed8;
            --blue-600: #2563eb;
            --blue-500: #3b82f6;
            --blue-400: #60a5fa;
            --blue-100: #dbeafe;
            --blue-50: #eff6ff;
            --cream-50: #f8fafc;
            --cream-100: #f1f5f9;
            --cream-200: #e2e8f0;
            --cream-300: #cbd5e1;
            --cream-accent: #dbeafe;
            --ink: #0f172a;
            --muted: #475569;
            --soft: #64748b;
        }

        body {
            margin: 0;
            font-family: system-ui, -apple-system, "Segoe UI", sans-serif;
            color: var(--ink);
            background: var(--cream-50);
            line-height: 1.6;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        /* ---------- Navigation ---------- */
        .nav {
            position: sticky;
            top: 0;
            z-index: 50;
            background: #f8fafc;
            border-bottom: 1px solid #e5e7eb;
        }

        .nav-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 16px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 800;
            font-size: 1.15rem;
            color: var(--blue-900);
        }

        .brand-mark {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--blue-600), var(--blue-400));
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.25);
        }

        .nav-links {
            display: flex;
            gap: 28px;
            font-weight: 500;
            color: var(--muted);
        }

        .nav-links a:hover {
            color: var(--blue-700);
        }

        .nav-cta {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        /* ---------- Buttons ---------- */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 22px;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            border: 1px solid transparent;
            transition: all 0.2s ease;
            font: inherit;
            font-weight: 700;
        }

        .btn-primary {
            background: var(--blue-600);
            color: #fff;
            box-shadow: 0 8px 22px rgba(37, 99, 235, 0.3);
        }

        .btn-primary:hover {
            background: var(--blue-700);
            transform: translateY(-2px);
            box-shadow: 0 12px 26px rgba(29, 78, 216, 0.35);
        }

        .btn-ghost {
            background: var(--cream-100);
            color: var(--blue-900);
            border-color: var(--cream-300);
        }

        .btn-ghost:hover {
            background: var(--cream-200);
            transform: translateY(-2px);
        }

        .btn-outline {
            background: transparent;
            color: var(--blue-700);
            border-color: var(--blue-100);
        }

        .btn-outline:hover {
            background: var(--blue-50);
        }

        /* ---------- Hero ---------- */
        .hero {
            position: relative;
            overflow: hidden;
            padding: 80px 28px 100px;
            background:
                radial-gradient(800px 400px at 85% -10%, rgba(96, 165, 250, 0.18), transparent 70%),
                radial-gradient(600px 350px at 10% 110%, rgba(191, 219, 254, 0.55), transparent 70%),
                linear-gradient(180deg, var(--cream-50) 0%, var(--cream-100) 100%);
        }

        .hero-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1.05fr 0.95fr;
            gap: 60px;
            align-items: center;
        }

        .pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 14px;
            border-radius: 999px;
            background: var(--blue-50);
            color: var(--blue-700);
            font-size: 0.85rem;
            font-weight: 600;
            border: 1px solid var(--blue-100);
            margin-bottom: 24px;
        }

        .pill-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--blue-500);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.18);
        }

        .hero h1 {
            margin: 0 0 20px;
            font-size: clamp(2.2rem, 4.4vw, 3.4rem);
            line-height: 1.1;
            font-weight: 800;
            color: var(--blue-900);
            letter-spacing: -0.02em;
        }

        .hero h1 .highlight {
            background: linear-gradient(120deg, var(--blue-600), var(--blue-400));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .hero p.lead {
            font-size: 1.1rem;
            color: var(--muted);
            margin: 0 0 32px;
            max-width: 540px;
        }

        .hero-actions {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
        }

        .hero-stats {
            display: flex;
            gap: 36px;
            margin-top: 48px;
            padding-top: 28px;
            border-top: 1px dashed rgba(37, 99, 235, 0.18);
        }

        .stat-num {
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--blue-700);
            display: block;
        }

        .stat-label {
            color: var(--soft);
            font-size: 0.9rem;
        }

        /* ---------- Hero illustration card ---------- */
        .hero-art {
            position: relative;
            display: flex;
            justify-content: center;
        }

        .hero-card {
            width: 100%;
            max-width: 460px;
            background: #ffffff;
            border-radius: 24px;
            padding: 28px;
            border: 1px solid var(--cream-200);
            box-shadow: 0 30px 60px rgba(15, 23, 42, 0.10),
                0 8px 18px rgba(15, 23, 42, 0.05);
            position: relative;
            z-index: 2;
        }

        .hero-card-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
        }

        .hero-card-top .tag {
            background: var(--cream-accent);
            color: var(--blue-700);
            font-size: 0.78rem;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 999px;
            border: 1px solid var(--blue-100);
        }

        .hero-card-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--ink);
            margin: 6px 0 4px;
        }

        .hero-card-sub {
            color: var(--soft);
            font-size: 0.9rem;
            margin-bottom: 18px;
        }

        .progress-wrap {
            background: var(--blue-50);
            height: 10px;
            border-radius: 999px;
            overflow: hidden;
            margin-bottom: 10px;
        }

        .progress-bar {
            background: linear-gradient(90deg, var(--blue-600), var(--blue-400));
            height: 100%;
            width: 72%;
            border-radius: 999px;
        }

        .progress-meta {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
            color: var(--muted);
            margin-bottom: 18px;
        }

        .progress-meta b {
            color: var(--blue-700);
        }

        .donor-row {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 0;
            border-top: 1px solid #f1f5f9;
        }

        .donor-row:first-of-type {
            border-top: none;
        }

        .donor-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--blue-100), var(--cream-200));
            color: var(--blue-700);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.85rem;
            border: 1px solid #fff;
        }

        .donor-name {
            font-weight: 600;
            font-size: 0.92rem;
            color: var(--ink);
        }

        .donor-amount {
            margin-left: auto;
            color: var(--blue-700);
            font-weight: 700;
            font-size: 0.92rem;
        }

        .float-badge {
            position: absolute;
            background: #fff;
            border-radius: 16px;
            padding: 14px 16px;
            border: 1px solid var(--cream-200);
            box-shadow: 0 12px 28px rgba(15, 23, 42, 0.08);
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 600;
            color: var(--ink);
            font-size: 0.9rem;
        }

        .float-badge.top {
            top: -18px;
            left: -28px;
            z-index: 3;
        }

        .float-badge.bottom {
            bottom: -22px;
            right: -10px;
            z-index: 3;
        }

        .badge-icon {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        .badge-icon.blue {
            background: var(--blue-50);
            color: var(--blue-700);
        }

        .badge-icon.cream {
            background: var(--cream-accent);
            color: var(--blue-700);
        }

        /* ---------- Section base ---------- */
        section.block {
            padding: 90px 28px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-head {
            text-align: center;
            max-width: 720px;
            margin: 0 auto 56px;
        }

        .eyebrow {
            color: var(--blue-700);
            font-weight: 700;
            font-size: 0.85rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .section-head h2 {
            margin: 0 0 14px;
            font-size: clamp(1.7rem, 3vw, 2.3rem);
            color: var(--blue-900);
            font-weight: 800;
            letter-spacing: -0.01em;
        }

        .section-head p {
            margin: 0;
            color: var(--muted);
            font-size: 1.05rem;
        }

        /* ---------- Roles ---------- */
        .roles {
            background: linear-gradient(180deg, var(--cream-100) 0%, var(--cream-50) 100%);
        }

        .role-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .role-card {
            background: #fff;
            border-radius: 18px;
            padding: 26px 22px;
            border: 1px solid var(--cream-200);
            text-align: center;
            transition: all 0.25s ease;
        }

        .role-card:hover {
            transform: translateY(-4px);
            border-color: var(--blue-100);
            box-shadow: 0 18px 36px rgba(15, 23, 42, 0.08);
        }

        .role-avatar {
            width: 64px;
            height: 64px;
            margin: 0 auto 14px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--blue-100), var(--cream-200));
            color: var(--blue-700);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            font-weight: 700;
            border: 4px solid #fff;
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.12);
        }

        .role-card h4 {
            margin: 0 0 6px;
            font-size: 1.05rem;
            color: var(--blue-900);
        }

        .role-card p {
            margin: 0;
            color: var(--muted);
            font-size: 0.9rem;
        }

        /* ---------- How it works ---------- */
        .steps {
            background: #fff;
        }

        .step-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 26px;
            counter-reset: step;
        }

        .step {
            position: relative;
            background: var(--cream-50);
            border-radius: 18px;
            padding: 32px 26px 26px;
            border: 1px solid var(--cream-200);
        }

        .step::before {
            counter-increment: step;
            content: counter(step, decimal-leading-zero);
            position: absolute;
            top: -16px;
            left: 22px;
            background: linear-gradient(135deg, var(--blue-600), var(--blue-400));
            color: #fff;
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            box-shadow: 0 8px 18px rgba(37, 99, 235, 0.28);
        }

        .step h3 {
            margin: 8px 0 8px;
            font-size: 1.1rem;
            color: var(--blue-900);
        }

        .step p {
            margin: 0;
            color: var(--muted);
            font-size: 0.95rem;
        }

        /* ---------- CTA banner ---------- */
        .cta {
            padding: 80px 28px;
            background:
                radial-gradient(500px 250px at 80% 10%, rgba(191, 219, 254, 0.45), transparent 70%),
                linear-gradient(135deg, var(--blue-700), var(--blue-500));
            color: #fff;
        }

        .cta-inner {
            max-width: 1100px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
            flex-wrap: wrap;
        }

        .cta h2 {
            margin: 0 0 8px;
            font-size: clamp(1.6rem, 2.6vw, 2.1rem);
            font-weight: 800;
            letter-spacing: -0.01em;
        }

        .cta p {
            margin: 0;
            color: rgba(255, 255, 255, 0.85);
            max-width: 560px;
        }

        .cta .btn-primary {
            background: var(--cream-accent);
            color: var(--blue-900);
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.18);
        }

        .cta .btn-primary:hover {
            background: #bfdbfe;
        }

        .cta .btn-outline {
            color: #fff;
            border-color: rgba(255, 255, 255, 0.4);
            background: rgba(255, 255, 255, 0.06);
        }

        .cta .btn-outline:hover {
            background: rgba(255, 255, 255, 0.14);
        }

        /* ---------- Responsive ---------- */
        @media (max-width: 960px) {
            .hero-inner {
                grid-template-columns: 1fr;
            }

            .hero-art {
                order: -1;
            }

            .role-grid {
                grid-template-columns: 1fr 1fr;
            }

            .step-grid {
                grid-template-columns: 1fr;
            }

            .nav-links {
                display: none;
            }
        }

        @media (max-width: 560px) {
            .role-grid {
                grid-template-columns: 1fr;
            }

            .hero-stats {
                gap: 18px;
            }

            .float-badge.top {
                left: 10px;
            }

            .float-badge.bottom {
                right: 10px;
            }
        }
    </style>
</head>

<body>

    <!-- Navigation -->
    <header class="nav">
        <div class="nav-inner">
            <a href="home.php" class="brand">
                <span class="brand-mark">Avatar</span>
            </a>
            <nav class="nav-links">
                <a href="#roles">Who It's For</a>
                <a href="#how">How It Works</a>
            </nav>
            <div class="nav-cta">
                <a href="index.php" class="btn btn-outline">Login</a>
            </div>
        </div>
    </header>

    <!-- Hero -->
    <section class="hero">
        <div class="hero-inner">
            <div>
                <span class="pill">
                    <span class="pill-dot"></span>
                    Trusted fundraising, made simple
                </span>
                <h1>
                    Raise funds for the causes <br>
                    <span class="highlight">that move you forward.</span>
                </h1>
                <p class="lead">
                    Avatar connects fundraisers, donees, and donors on one secure platform.
                    Launch campaigns, track progress, and turn generosity into real impact —
                    all in a few clicks.
                </p>
                <div class="hero-actions">
                    <a href="index.php" class="btn btn-primary">Get Started</a>
                    <a href="#how" class="btn btn-ghost">See How It Works</a>
                </div>

                <div class="hero-stats">
                    <div>
                        <span class="stat-num">12k+</span>
                        <span class="stat-label">Active campaigns</span>
                    </div>
                    <div>
                        <span class="stat-num">$8.4M</span>
                        <span class="stat-label">Funds raised</span>
                    </div>
                    <div>
                        <span class="stat-num">98%</span>
                        <span class="stat-label">Donor satisfaction</span>
                    </div>
                </div>
            </div>

            <div class="hero-art">
                <div class="hero-card">
                    <div class="hero-card-top">
                        <span class="tag">Featured</span>
                        <span style="color: var(--soft); font-size: 0.85rem;">Ends in 14 days</span>
                    </div>
                    <div class="hero-card-title">Clean Water for Riverside</div>
                    <div class="hero-card-sub">A community wellbeing initiative</div>

                    <div class="progress-wrap">
                        <div class="progress-bar"></div>
                    </div>
                    <div class="progress-meta">
                        <span><b>$36,200</b> raised</span>
                        <span>of $50,000</span>
                    </div>

                    <div class="donor-row">
                        <div class="donor-avatar">AL</div>
                        <span class="donor-name">Amelia L.</span>
                        <span class="donor-amount">+ $250</span>
                    </div>
                    <div class="donor-row">
                        <div class="donor-avatar">JK</div>
                        <span class="donor-name">Jordan K.</span>
                        <span class="donor-amount">+ $80</span>
                    </div>
                    <div class="donor-row">
                        <div class="donor-avatar">MC</div>
                        <span class="donor-name">Mei C.</span>
                        <span class="donor-amount">+ $500</span>
                    </div>
                </div>

                <div class="float-badge top">
                    <div class="badge-icon blue">📈</div>
                    <div>
                        <div>Goal 72% met</div>
                        <div style="color: var(--soft); font-weight: 500; font-size: 0.8rem;">Trending up this week</div>
                    </div>
                </div>

                <div class="float-badge bottom">
                    <div class="badge-icon cream">💛</div>
                    <div>
                        <div>3,140 donors</div>
                        <div style="color: var(--soft); font-weight: 500; font-size: 0.8rem;">Joining the cause</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Roles -->
    <section class="block roles" id="roles">
        <div class="container">
            <div class="section-head">
                <div class="eyebrow">Who It's For</div>
                <h2>One platform, four purposeful roles</h2>
                <p>Every member of the FundRaise community has the right tools for the job.</p>
            </div>

            <div class="role-grid">
                <div class="role-card">
                    <div class="role-avatar">PM</div>
                    <h4>Platform Manager</h4>
                    <p>Curate categories, oversee operations, and generate reports.</p>
                </div>
                <div class="role-card">
                    <div class="role-avatar">UA</div>
                    <h4>User Admin</h4>
                    <p>Manage accounts and profiles to keep the community trustworthy.</p>
                </div>
                <div class="role-card">
                    <div class="role-avatar">FR</div>
                    <h4>Fundraiser</h4>
                    <p>Create and update activities for the causes that need your voice.</p>
                </div>
                <div class="role-card">
                    <div class="role-avatar">DN</div>
                    <h4>Donee</h4>
                    <p>Discover, support, and follow campaigns that resonate with you.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How it works -->
    <section class="block steps" id="how">
        <div class="container">
            <div class="section-head">
                <div class="eyebrow">How It Works</div>
                <h2>From idea to impact in three steps</h2>
                <p>A clear path that respects your time and your supporters'.</p>
            </div>

            <div class="step-grid">
                <div class="step">
                    <h3>Create your account</h3>
                    <p>Sign in to the right portal — Platform Manager, Admin, Fundraiser, or Donee.</p>
                </div>
                <div class="step">
                    <h3>Launch a campaign</h3>
                    <p>Pick a category, describe the cause, and set your goal in a guided flow.</p>
                </div>
                <div class="step">
                    <h3>Grow with insights</h3>
                    <p>Watch progress in real time and act on built-in reports and analytics.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta">
        <div class="cta-inner">
            <div>
                <h2>Ready to make generosity go further?</h2>
                <p>Join the community using FundRaise to power transparent, accountable, and impactful campaigns.</p>
            </div>
            <div style="display:flex; gap:12px; flex-wrap:wrap;">
                <a href="index.php" class="btn btn-primary">Login to Continue</a>
                <a href="#how" class="btn btn-outline">Learn More</a>
            </div>
        </div>
    </section>

</body>

</html>
