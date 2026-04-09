<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Readify - Membaca Lebih Menyenangkan</title>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">

        <style>
:root {
    --deep-forest:    #071A14;
    --dark-emerald:   #0A2619;
    --mid-green:      #0D3D26;
    --teal-green:     #0F5C3A;
    --bright-green:   #16A34A;
    --lime-accent:    #84CC16;
    --neon-lime:      #BEF264;
    --soft-mint:      #D1FAE5;
    --white:          #FFFFFF;
    --off-white:      #F0FDF4;
    --muted-text:     #86EFAC;

    --grad-hero:      linear-gradient(135deg, #071A14 0%, #0A2619 40%, #0D3D26 100%);
    --grad-card:      linear-gradient(145deg, #0D3D26, #0A2619);
    --grad-lime:      linear-gradient(135deg, #84CC16, #BEF264);
    --grad-emerald:   linear-gradient(135deg, #16A34A, #0F5C3A);
    --grad-section:   linear-gradient(180deg, #071A14 0%, #0A2619 100%);

    --glass-bg:       rgba(13, 61, 38, 0.45);
    --glass-border:   rgba(132, 204, 22, 0.2);

    --shadow-sm:      0 2px 8px rgba(0,0,0,0.3);
    --shadow-md:      0 8px 24px rgba(0,0,0,0.4);
    --shadow-lg:      0 16px 48px rgba(0,0,0,0.5);
    --shadow-glow:    0 0 30px rgba(132, 204, 22, 0.25);

    --r-sm:   8px;
    --r-md:   14px;
    --r-lg:   20px;
    --r-xl:   28px;
    --r-2xl:  40px;
    --r-pill: 999px;

    --transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
}

*, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
html { scroll-behavior: smooth; }

body {
    background: var(--deep-forest);
    color: var(--white);
    font-family: 'Plus Jakarta Sans', sans-serif;
    min-height: 100vh;
    overflow-x: hidden;
}

body::before {
    content: '';
    position: fixed;
    inset: 0;
    background-image: radial-gradient(circle, rgba(132,204,22,0.12) 1px, transparent 1px);
    background-size: 28px 28px;
    pointer-events: none;
    z-index: 0;
}

/*navbar*/
nav {
    position: fixed;
    top: 0; left: 0; right: 0;
    z-index: 1000;
    transition: var(--transition);
}

nav.scrolled {
    background: rgba(7, 26, 20, 0.92);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border-bottom: 1px solid var(--glass-border);
    box-shadow: 0 4px 24px rgba(0,0,0,0.4);
}

.nav-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 1.1rem 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo img { height: 44px; width: auto; }

.nav-menu {
    display: flex;
    gap: 2rem;
    align-items: center;
    list-style: none;
}

.nav-menu a {
    text-decoration: none;
    color: rgba(255,255,255,0.75);
    font-weight: 500;
    font-size: 0.95rem;
    letter-spacing: 0.02em;
    transition: var(--transition);
    position: relative;
    padding: 0.25rem 0;
}

.nav-menu a:not(.btn-login):hover { color: var(--neon-lime); }

.nav-menu a:not(.btn-login)::after {
    content: '';
    position: absolute;
    bottom: -2px; left: 0;
    width: 0; height: 1.5px;
    background: var(--lime-accent);
    transition: width 0.3s ease;
    border-radius: 2px;
}

.nav-menu a:not(.btn-login):hover::after { width: 100%; }

.btn-login {
    background: transparent;
    color: var(--white) !important;
    padding: 0.55rem 1.5rem;
    border-radius: var(--r-pill);
    border: 1.5px solid rgba(132,204,22,0.5);
    font-weight: 600;
    font-size: 0.9rem;
    transition: var(--transition);
}

.btn-login:hover {
    background: var(--lime-accent) !important;
    color: var(--deep-forest) !important;
    border-color: var(--lime-accent) !important;
    box-shadow: var(--shadow-glow);
    transform: translateY(-1px);
}

/*hero*/
.hero-wrapper {
    position: relative;
    overflow: hidden;
    min-height: 100vh;
    display: flex;
    align-items: center;
    padding-top: 80px;
    background: var(--grad-hero);
}

.hero-wrapper::before {
    content: '';
    position: absolute;
    top: -20%; right: -10%;
    width: 700px; height: 700px;
    background: radial-gradient(circle, rgba(22,163,74,0.18) 0%, transparent 70%);
    pointer-events: none;
    z-index: 1;
}

.hero-wrapper::after {
    content: '';
    position: absolute;
    bottom: -15%; left: -10%;
    width: 600px; height: 600px;
    background: radial-gradient(circle, rgba(132,204,22,0.1) 0%, transparent 70%);
    pointer-events: none;
    z-index: 1;
}

.hero {
    position: relative;
    z-index: 2;
    max-width: 1200px;
    margin: 0 auto;
    padding: 5rem 2rem 6rem;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
}

.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(132,204,22,0.12);
    border: 1px solid rgba(132,204,22,0.3);
    color: var(--neon-lime);
    padding: 0.4rem 1rem;
    border-radius: var(--r-pill);
    font-size: 0.8rem;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    margin-bottom: 1.5rem;
}

.hero-badge::before {
    content: '';
    width: 6px; height: 6px;
    border-radius: 50%;
    background: var(--lime-accent);
    box-shadow: 0 0 8px var(--lime-accent);
    animation: pulse-dot 2s ease-in-out infinite;
}

@keyframes pulse-dot {
    0%, 100% { opacity: 1; transform: scale(1); }
    50%       { opacity: 0.5; transform: scale(1.4); }
}

.hero-content h1 {
    font-size: clamp(2.4rem, 4vw, 3.8rem);
    font-weight: 800;
    line-height: 1.15;
    margin-bottom: 1.5rem;
    letter-spacing: -0.02em;
}

.hero-content h1 .highlight {
    background: var(--grad-lime);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hero-content p {
    color: rgba(255,255,255,0.6);
    font-size: 1.05rem;
    line-height: 1.75;
    margin-bottom: 2.5rem;
    max-width: 480px;
}

.hero-cta {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
    align-items: center;
}

.btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: var(--grad-lime);
    color: var(--deep-forest);
    padding: 0.9rem 2rem;
    border-radius: var(--r-pill);
    text-decoration: none;
    font-weight: 700;
    font-size: 1rem;
    transition: var(--transition);
    box-shadow: 0 4px 20px rgba(132,204,22,0.4);
}

.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 32px rgba(132,204,22,0.5);
}

.btn-primary .arrow {
    width: 22px; height: 22px;
    background: rgba(0,0,0,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
}

.btn-outline {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: transparent;
    color: rgba(255,255,255,0.8);
    padding: 0.9rem 2rem;
    border-radius: var(--r-pill);
    text-decoration: none;
    font-weight: 600;
    font-size: 1rem;
    border: 1.5px solid rgba(255,255,255,0.2);
    transition: var(--transition);
}

.btn-outline:hover {
    border-color: rgba(132,204,22,0.5);
    color: var(--neon-lime);
    transform: translateY(-2px);
}

.hero-brands {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-top: 3rem;
    flex-wrap: wrap;
}

.hero-brands span {
    font-size: 0.78rem;
    color: rgba(255,255,255,0.35);
    letter-spacing: 0.06em;
    text-transform: uppercase;
    font-weight: 500;
}

.brand-tag {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.08);
    color: rgba(255,255,255,0.45);
    padding: 0.3rem 0.85rem;
    border-radius: var(--r-pill);
    font-size: 0.78rem;
    font-weight: 600;
}

.hero-image {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
}

.hero-image::before {
    content: '';
    position: absolute;
    width: 320px; height: 320px;
    background: radial-gradient(circle, rgba(22,163,74,0.3) 0%, transparent 70%);
    border-radius: 50%;
    animation: glow-pulse 3s ease-in-out infinite;
}

@keyframes glow-pulse {
    0%, 100% { transform: scale(1); opacity: 0.7; }
    50%       { transform: scale(1.15); opacity: 1; }
}

.hero-image img {
    width: 100%;
    max-width: 340px;
    position: relative;
    z-index: 1;
    filter: drop-shadow(0 20px 40px rgba(22,163,74,0.4));
    animation: float 5s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50%       { transform: translateY(-18px); }
}

/*about*/
.about-section {
    background: var(--off-white);
    padding: 7rem 2rem;
    position: relative;
    overflow: hidden;
}

.about-section::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 4px;
    background: var(--grad-lime);
}

.about-container {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 5rem;
    align-items: center;
}

.section-label {
    display: inline-block;
    font-size: 0.78rem;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--bright-green);
    background: rgba(22,163,74,0.1);
    border: 1px solid rgba(22,163,74,0.25);
    padding: 0.3rem 0.9rem;
    border-radius: var(--r-pill);
    margin-bottom: 1.2rem;
}

.about-content h2 {
    font-size: clamp(1.8rem, 3vw, 2.6rem);
    font-weight: 800;
    color: var(--deep-forest);
    line-height: 1.2;
    margin-bottom: 1.25rem;
    letter-spacing: -0.02em;
}

.about-content p {
    color: #475569;
    line-height: 1.8;
    margin-bottom: 2rem;
    font-size: 1rem;
}

.about-features {
    display: flex;
    flex-direction: column;
    gap: 0.85rem;
    margin-bottom: 2.5rem;
}

.about-feature-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    color: #1E3A2F;
    font-weight: 600;
    font-size: 0.95rem;
}

.feat-check {
    width: 22px; height: 22px;
    min-width: 22px;
    background: var(--grad-emerald);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.65rem;
}

.btn-read-more {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: var(--grad-emerald);
    color: var(--white);
    padding: 0.85rem 2rem;
    border-radius: var(--r-pill);
    text-decoration: none;
    font-weight: 700;
    transition: var(--transition);
    box-shadow: 0 4px 16px rgba(22,163,74,0.35);
}

.btn-read-more:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 28px rgba(22,163,74,0.45);
}

.about-illustration img {
    width: 100%;
    max-width: 500px;
    border-radius: var(--r-xl);
    box-shadow: var(--shadow-lg);
}

/* stats */
.stats-section {
    background: var(--grad-section);
    padding: 5rem 2rem;
    position: relative;
    overflow: hidden;
}

.stats-section::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image: radial-gradient(circle, rgba(132,204,22,0.08) 1px, transparent 1px);
    background-size: 32px 32px;
    pointer-events: none;
}

.stats-inner {
    position: relative;
    z-index: 1;
    max-width: 900px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    background: rgba(132,204,22,0.08);
    border-radius: var(--r-xl);
    border: 1px solid rgba(132,204,22,0.15);
    overflow: hidden;
}

.stat-item {
    text-align: center;
    padding: 3rem 2rem;
    background: var(--glass-bg);
    transition: var(--transition);
    position: relative;
}

.stat-item:not(:last-child)::after {
    content: '';
    position: absolute;
    right: 0; top: 20%; bottom: 20%;
    width: 1px;
    background: rgba(132,204,22,0.15);
}

.stat-item:hover { background: rgba(13,61,38,0.7); }

.stat-number {
    font-size: 4.5rem;
    font-weight: 800;
    line-height: 1;
    background: var(--grad-lime);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-family: 'Space Mono', monospace;
    letter-spacing: -2px;
    margin-bottom: 0.75rem;
}

.stat-label {
    color: rgba(255,255,255,0.55);
    font-weight: 500;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    font-size: 0.82rem;
}

/* features */
.features-section {
    padding: 8rem 2rem;
    background: var(--off-white);
    position: relative;
}

.features-section::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 4px;
    background: var(--grad-lime);
}

.features-container { max-width: 1200px; margin: 0 auto; }

.section-header { text-align: center; margin-bottom: 5rem; }

.section-header h2 {
    font-size: clamp(2rem, 3.5vw, 3rem);
    font-weight: 800;
    color: var(--deep-forest);
    letter-spacing: -0.02em;
    margin-bottom: 1rem;
}

.section-header p {
    color: #64748B;
    font-size: 1.05rem;
    max-width: 520px;
    margin: 0 auto;
    line-height: 1.7;
}

.title-line {
    width: 60px; height: 4px;
    background: var(--grad-lime);
    border-radius: 2px;
    margin: 1rem auto 0;
}

.features-content {
    display: grid;
    grid-template-columns: 1fr 1.1fr 1fr;
    gap: 3rem;
    align-items: center;
}

.features-left, .features-right {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.feature-item {
    display: flex;
    gap: 1.1rem;
    align-items: flex-start;
    padding: 1.4rem;
    border-radius: var(--r-lg);
    border: 1px solid rgba(22,163,74,0.12);
    background: rgba(255,255,255,0.7);
    transition: var(--transition);
}

.feature-item:hover {
    border-color: rgba(22,163,74,0.3);
    background: white;
    box-shadow: 0 8px 30px rgba(22,163,74,0.1);
    transform: translateY(-3px);
}

.feature-icon {
    width: 52px; height: 52px;
    min-width: 52px;
    background: var(--grad-emerald);
    border-radius: var(--r-md);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    box-shadow: 0 4px 14px rgba(22,163,74,0.35);
    transition: var(--transition);
}

.feature-item:hover .feature-icon { background: var(--grad-lime); }

.feature-icon svg {
    width: 26px; height: 26px;
    color: white;
    transition: color 0.3s;
}

.feature-item:hover .feature-icon svg { color: var(--deep-forest); }

.feature-title {
    font-size: 1rem;
    font-weight: 700;
    color: var(--deep-forest);
    margin-bottom: 0.4rem;
}

.feature-description {
    font-size: 0.88rem;
    color: #64748B;
    line-height: 1.6;
}

.features-center { display: flex; justify-content: center; }

.dashboard-image {
    width: 100%;
    max-width: 360px;
    filter: drop-shadow(0 20px 40px rgba(0,0,0,0.25));
    animation: float 6s ease-in-out infinite;
}

/* steps */
.steps-section {
    padding: 8rem 2rem;
    background: var(--grad-section);
    position: relative;
    overflow: hidden;
}

.steps-section::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image: radial-gradient(circle, rgba(132,204,22,0.07) 1px, transparent 1px);
    background-size: 32px 32px;
}

.steps-container { max-width: 1100px; margin: 0 auto; position: relative; z-index: 1; }

.steps-header { text-align: center; margin-bottom: 4.5rem; }

.steps-header h2 {
    font-size: clamp(2rem, 3.5vw, 3rem);
    font-weight: 800;
    color: var(--white);
    letter-spacing: -0.02em;
    margin-bottom: 1rem;
}

.steps-header p {
    color: rgba(255,255,255,0.55);
    font-size: 1rem;
    max-width: 520px;
    margin: 0 auto;
    line-height: 1.75;
}

.steps-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2rem;
    position: relative;
}

.steps-grid::before {
    content: '';
    position: absolute;
    top: 50px;
    left: calc(16.66% + 25px);
    right: calc(16.66% + 25px);
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(132,204,22,0.3), rgba(132,204,22,0.3), transparent);
    z-index: 0;
}

.step-card {
    background: var(--glass-bg);
    border: 1px solid rgba(132,204,22,0.12);
    border-radius: var(--r-xl);
    padding: 2.5rem 2rem;
    text-align: center;
    transition: var(--transition);
    position: relative;
    z-index: 1;
    backdrop-filter: blur(10px);
}

.step-card:hover {
    border-color: rgba(132,204,22,0.35);
    background: rgba(13,61,38,0.6);
    transform: translateY(-8px);
    box-shadow: 0 20px 50px rgba(0,0,0,0.4), 0 0 30px rgba(132,204,22,0.1);
}

.step-number {
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 0.12em;
    color: var(--lime-accent);
    text-transform: uppercase;
    margin-bottom: 1.5rem;
    font-family: 'Space Mono', monospace;
}

.step-icon-wrapper {
    width: 88px; height: 88px;
    margin: 0 auto 1.75rem;
    background: rgba(132,204,22,0.1);
    border: 1px solid rgba(132,204,22,0.2);
    border-radius: var(--r-xl);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: var(--transition);
}

.step-card:hover .step-icon-wrapper {
    background: var(--grad-lime);
    border-color: transparent;
    box-shadow: 0 8px 24px rgba(132,204,22,0.4);
}

.step-icon {
    width: 42px; height: 42px;
    color: var(--lime-accent);
    transition: color 0.3s;
}

.step-card:hover .step-icon { color: var(--deep-forest); }

.step-title {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--white);
    margin-bottom: 0.85rem;
}

.step-description {
    font-size: 0.9rem;
    color: rgba(255,255,255,0.5);
    line-height: 1.7;
}

/* faq */
.faq-section {
    background: var(--off-white);
    padding: 8rem 2rem;
    position: relative;
}

.faq-section::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 4px;
    background: var(--grad-lime);
}

.faq-container { max-width: 780px; margin: 0 auto; }

.faq-header { text-align: center; margin-bottom: 4rem; }

.faq-header h2 {
    font-size: clamp(1.8rem, 3vw, 2.6rem);
    font-weight: 800;
    color: var(--deep-forest);
    letter-spacing: -0.02em;
    margin-bottom: 1rem;
}

.faq-header p { color: #64748B; font-size: 1rem; line-height: 1.75; }

.faq-list { display: flex; flex-direction: column; gap: 1rem; }

.faq-item {
    background: white;
    border: 1.5px solid rgba(22,163,74,0.12);
    border-radius: var(--r-lg);
    overflow: hidden;
    transition: var(--transition);
    box-shadow: var(--shadow-sm);
}

.faq-item:hover { border-color: rgba(22,163,74,0.3); }
.faq-item.active { border-color: rgba(22,163,74,0.4); box-shadow: 0 6px 24px rgba(22,163,74,0.12); }

.faq-question {
    width: 100%;
    padding: 1.4rem 1.75rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    background: transparent;
    border: none;
    cursor: pointer;
    text-align: left;
    transition: var(--transition);
}

.faq-icon { width: 28px; height: 28px; color: var(--bright-green); flex-shrink: 0; }

.faq-question-text {
    flex: 1;
    font-size: 1rem;
    font-weight: 600;
    color: var(--deep-forest);
    line-height: 1.4;
}

.faq-toggle {
    width: 32px; height: 32px;
    min-width: 32px;
    background: rgba(22,163,74,0.08);
    border-radius: var(--r-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--bright-green);
    transition: var(--transition);
}

.faq-item.active .faq-toggle {
    background: var(--bright-green);
    color: white;
    transform: rotate(180deg);
}

.faq-toggle svg { width: 16px; height: 16px; }

.faq-answer { max-height: 0; overflow: hidden; transition: max-height 0.35s ease, padding 0.35s ease; }
.faq-item.active .faq-answer { max-height: 300px; padding: 0 1.75rem 1.5rem 4rem; }
.faq-answer p { font-size: 0.95rem; color: #64748B; line-height: 1.75; }

/* footer */
footer {
    background: var(--deep-forest);
    border-top: 1px solid rgba(132,204,22,0.1);
    padding: 5rem 2rem 2rem;
    position: relative;
}

footer::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image: radial-gradient(circle, rgba(132,204,22,0.05) 1px, transparent 1px);
    background-size: 28px 28px;
    pointer-events: none;
}

.footer-content {
    max-width: 1200px;
    margin: 0 auto;
    position: relative;
    z-index: 1;
    display: grid;
    grid-template-columns: 1.6fr 1fr 1fr 1.4fr;
    gap: 4rem;
    margin-bottom: 4rem;
}

.footer-section h2 {
    font-size: 1.5rem;
    font-weight: 800;
    background: var(--grad-lime);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 1rem;
}

.footer-section h3 {
    font-size: 0.85rem;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: rgba(255,255,255,0.45);
    margin-bottom: 1.5rem;
}

.footer-section p {
    color: rgba(255,255,255,0.45);
    line-height: 1.75;
    font-size: 0.9rem;
    margin-bottom: 1.25rem;
}

.contact-info p {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 0.6rem;
    color: rgba(255,255,255,0.4);
    font-size: 0.88rem;
}

.contact-info strong { color: rgba(255,255,255,0.7); font-weight: 600; min-width: 55px; }

.footer-links { list-style: none; display: flex; flex-direction: column; gap: 0.7rem; }

.footer-links a {
    color: rgba(255,255,255,0.45);
    text-decoration: none;
    font-size: 0.9rem;
    transition: var(--transition);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.footer-links a:hover { color: var(--neon-lime); transform: translateX(4px); }
.footer-links a::before { content: '→'; font-size: 0.75rem; opacity: 0.5; transition: opacity 0.3s; }
.footer-links a:hover::before { opacity: 1; }

.input-group { display: flex; gap: 0.6rem; margin-top: 0.5rem; }

.input-group input {
    flex: 1;
    padding: 0.75rem 1rem;
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(132,204,22,0.15);
    border-radius: var(--r-md);
    color: white;
    font-size: 0.88rem;
    outline: none;
    transition: var(--transition);
    font-family: inherit;
}

.input-group input::placeholder { color: rgba(255,255,255,0.3); }
.input-group input:focus { border-color: rgba(132,204,22,0.4); background: rgba(132,204,22,0.05); }

.input-group button {
    padding: 0.75rem 1.2rem;
    background: var(--grad-lime);
    color: var(--deep-forest);
    border: none;
    border-radius: var(--r-md);
    font-size: 0.88rem;
    font-weight: 700;
    cursor: pointer;
    transition: var(--transition);
    font-family: inherit;
    white-space: nowrap;
}

.input-group button:hover { transform: translateY(-2px); box-shadow: 0 4px 16px rgba(132,204,22,0.4); }

.footer-bottom {
    max-width: 1200px;
    margin: 0 auto;
    padding-top: 2rem;
    border-top: 1px solid rgba(255,255,255,0.06);
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
    z-index: 1;
    flex-wrap: wrap;
    gap: 1.5rem;
}

.copyright { color: rgba(255,255,255,0.3); font-size: 0.85rem; }
.copyright strong { color: rgba(255,255,255,0.6); }

.social-links { display: flex; gap: 0.75rem; }

.social-links a {
    width: 38px; height: 38px;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: var(--r-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    color: rgba(255,255,255,0.4);
    text-decoration: none;
    font-size: 0.85rem;
    transition: var(--transition);
}

.social-links a:hover {
    background: var(--lime-accent);
    border-color: var(--lime-accent);
    color: var(--deep-forest);
    transform: translateY(-3px);
}

.scroll-top {
    width: 38px; height: 38px;
    background: rgba(132,204,22,0.1);
    border: 1px solid rgba(132,204,22,0.25);
    border-radius: var(--r-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--lime-accent);
    cursor: pointer;
    transition: var(--transition);
    font-size: 0.85rem;
}

.scroll-top:hover { background: var(--lime-accent); color: var(--deep-forest); transform: translateY(-3px); }

@media (max-width: 1024px) {
    .features-content { grid-template-columns: 1fr; gap: 3rem; }
    .features-center { order: -1; }
    .footer-content { grid-template-columns: 1fr 1fr; gap: 3rem; }
}

@media (max-width: 768px) {
    .nav-menu { display: none; }
    .hero { grid-template-columns: 1fr; padding: 3rem 1.5rem 4rem; text-align: center; }
    .hero-content p { margin: 0 auto 2.5rem; }
    .hero-cta { justify-content: center; }
    .hero-brands { justify-content: center; }
    .hero-image { order: -1; }
    .about-container { grid-template-columns: 1fr; }
    .about-illustration { order: -1; }
    .stats-inner { grid-template-columns: 1fr; }
    .stat-item::after { display: none; }
    .steps-grid { grid-template-columns: 1fr; }
    .steps-grid::before { display: none; }
    .footer-content { grid-template-columns: 1fr; gap: 2.5rem; }
    .footer-bottom { flex-direction: column; align-items: flex-start; }
}
        </style>
    </head>
    <body>
        <!-- Navigation -->
        <nav>
            <div class="nav-container">
                <a href="#home" class="logo">
                    <img src="{{ asset('images/logoR.png') }}" alt="Readify Logo">
                </a>
                <ul class="nav-menu">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#step">Step</a></li>
                    <li><a href="#faq">FAQ</a></li>
                    
    @auth
        {{-- Jika sudah login, tampilkan tombol Dashboard & Logout --}}
        <li><a href="{{ Auth::user()->isAdmin() ? route('admin.dashboard') : route('user.dashboard') }}" class="btn-login">Dashboard</a></li>
        <li>
            <form method="POST" action="{{ route('logout') }}" style="display:inline">
                @csrf
                <button type="submit" class="btn-login" style="cursor:pointer; border:none; font-family:inherit; font-size:inherit;">
                    Logout
                </button>
            </form>
        </li>
    @else
        {{-- Jika belum login, tampilkan Sign In --}}
        <li><a href="{{ route('login') }}" class="btn-login">Sign In</a></li>
    @endauth
</ul>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="hero-wrapper" id="home">
            <div class="hero">
                <div class="hero-content">
                    <div class="hero-badge">Platform Terpercaya</div>
                    <h1>Membaca Lebih Menyenangkan Dengan <span class="highlight">Readify</span></h1>
                    <p>Perpustakaan digital modern yang memudahkan Anda menjelajahi dunia literasi. Akses ribuan buku kapan saja, di mana saja.</p>
                    <div class="hero-cta">
                        @auth
    <a href="{{ Auth::user()->isAdmin() ? route('admin.dashboard') : route('user.dashboard') }}" class="btn-primary">
        Ayo Baca <span class="arrow">→</span>
    </a>
@else
    <a href="{{ route('login') }}" class="btn-primary">
        Ayo Baca <span class="arrow">→</span>
    </a>
@endauth
                        <a href="#about" class="btn-outline">Pelajari Lebih</a>
                    </div>
                </div>
                <div class="hero-image">
                    <img src="{{ asset('images/ikonR.png') }}" alt="Readify App">
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section class="about-section" id="about">
            <div class="about-container">
                <div class="about-content">
                    <span class="section-label">About Us</span>
                    <h2>Semua Kebutuhan Baca dalam Satu Platform</h2>
                    <p>Readify adalah perpustakaan digital yang memudahkan Anda menjelajahi dunia literasi. Dari buku baru hingga klasik, Readify menjadi solusi bagi para pencinta buku dan pelajar.</p>
                    <div class="about-features">
                        <div class="about-feature-item">
                            <span class="feat-check">✓</span>
                            <span>Koleksi Buku Beragam dari Berbagai Genre</span>
                        </div>
                        <div class="about-feature-item">
                            <span class="feat-check">✓</span>
                            <span>Akses Cepat & Mudah Kapan Saja</span>
                        </div>
                        <div class="about-feature-item">
                            <span class="feat-check">✓</span>
                            <span>Sistem Peminjaman Digital Terintegrasi</span>
                        </div>
                    </div>
                    <a href="{{ route('login') }}" class="btn-read-more">Read More →</a>
                </div>
                <div class="about-illustration">
                    <img src="{{ asset('images/about-illustration.png') }}" alt="About Readify">
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="stats-section">
            <div class="stats-inner">
                <div class="stat-item">
                    <div class="stat-number" data-target="15">0</div>
                    <div class="stat-label">Koleksi Buku</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number" data-target="5">0</div>
                    <div class="stat-label">Kategori</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number" data-target="20">0</div>
                    <div class="stat-label">Anggota Aktif</div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="features-section" id="features">
            <div class="features-container">
                <div class="section-header">
                    <span class="section-label">Features</span>
                    <h2>Fitur Lengkap untuk Pengalaman Terbaik</h2>
                    <p>Semua yang Anda butuhkan untuk mengelola dan menikmati koleksi buku digital</p>
                    <div class="title-line"></div>
                </div>
                <div class="features-content">
                    <div class="features-left">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                            <div class="feature-text">
                                <h3 class="feature-title">Dashboard Analitik</h3>
                                <p class="feature-description">Reporting behaviour pembaca yang mudah dan lengkap</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div class="feature-text">
                                <h3 class="feature-title">Manajemen Buku</h3>
                                <p class="feature-description">Kelola koleksi buku digital dengan mudah dan terorganisir</p>
                            </div>
                        </div>
                    </div>
                    <div class="features-center">
                        <img src="{{ asset('images/dashboard-mockup.png') }}" alt="Dashboard Preview" class="dashboard-image">
                    </div>
                    <div class="features-right">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div class="feature-text">
                                <h3 class="feature-title">Fitur Kustom Request</h3>
                                <p class="feature-description">Customisasi fitur sesuai kebutuhan perpustakaan Anda</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <div class="feature-text">
                                <h3 class="feature-title">Pinjam Buku Digital</h3>
                                <p class="feature-description">Sistem peminjaman digital yang praktis dan efisien</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Steps Section -->
        <section class="steps-section" id="step">
            <div class="steps-container">
                <div class="steps-header">
                    <span class="section-label">How It Works</span>
                    <h2>3 Langkah Mudah Mulai Membaca</h2>
                    <p>Tertarik membaca dan meminjam di Readify? Ikuti langkah mudah berikut ini</p>
                </div>
                <div class="steps-grid">
                    <div class="step-card">
                        <div class="step-number">Step 01</div>
                        <div class="step-icon-wrapper">
                            <svg class="step-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h3 class="step-title">Login</h3>
                        <p class="step-description">Login ke akun Readify menggunakan username dan password yang telah terdaftar</p>
                    </div>
                    <div class="step-card">
                        <div class="step-number">Step 02</div>
                        <div class="step-icon-wrapper">
                            <svg class="step-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h3 class="step-title">Lihat Buku</h3>
                        <p class="step-description">Jelajahi daftar buku yang tersedia langsung dari platform Readify</p>
                    </div>
                    <div class="step-card">
                        <div class="step-number">Step 03</div>
                        <div class="step-icon-wrapper">
                            <svg class="step-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="step-title">Pinjam & Baca</h3>
                        <p class="step-description">Ambil buku yang ingin kamu pinjam dan nikmati pengalaman membaca</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="faq-section" id="faq">
            <div class="faq-container">
                <div class="faq-header">
                    <span class="section-label">FAQ</span>
                    <h2>Pertanyaan yang Sering Ditanyakan</h2>
                    <p>Temukan jawaban atas pertanyaan umum seputar layanan perpustakaan digital Readify</p>
                    <div class="title-line"></div>
                </div>
                <div class="faq-list">
                    <div class="faq-item active">
                        <button class="faq-question">
                            <svg class="faq-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span class="faq-question-text">Apa itu Readify?</span>
                            <div class="faq-toggle"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg></div>
                        </button>
                        <div class="faq-answer"><p>Readify adalah perpustakaan digital yang menyediakan akses ke berbagai koleksi buku dari berbagai genre. Kami memungkinkan pembaca untuk membaca secara digital dan menikmati kebebasan literasi di mana saja.</p></div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">
                            <svg class="faq-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span class="faq-question-text">Bagaimana cara mendaftar menjadi anggota?</span>
                            <div class="faq-toggle"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg></div>
                        </button>
                        <div class="faq-answer"><p>Kunjungi halaman pendaftaran, isi formulir dengan data diri yang valid seperti nama lengkap, email, dan nomor telepon. Setelah mendaftar, Anda akan menerima email konfirmasi untuk mengaktifkan akun.</p></div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">
                            <svg class="faq-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span class="faq-question-text">Apakah ada biaya untuk menggunakan Readify?</span>
                            <div class="faq-toggle"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg></div>
                        </button>
                        <div class="faq-answer"><p>Readify menawarkan layanan gratis untuk koleksi buku dasar. Untuk koleksi premium dan fitur eksklusif, tersedia paket berlangganan dengan harga terjangkau.</p></div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">
                            <svg class="faq-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span class="faq-question-text">Buku tersedia dalam bentuk digital atau fisik?</span>
                            <div class="faq-toggle"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg></div>
                        </button>
                        <div class="faq-answer"><p>Semua buku di Readify tersedia dalam bentuk digital. Anda dapat mengakses koleksi kami melalui website atau aplikasi mobile kapan saja dan di mana saja.</p></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer>
            <div class="footer-content">
                <div class="footer-section">
                    <h2>Readify</h2>
                    <p>Platform perpustakaan digital modern yang memudahkan Anda menjelajahi dunia literasi kapan saja.</p>
                    <div class="contact-info">
                        <p><strong>Address:</strong> Jawa Tengah, Indonesia</p>
                        <p><strong>Phone:</strong> +62 87888057165</p>
                        <p><strong>Email:</strong> readify@gmail.com</p>
                    </div>
                </div>
                <div class="footer-section">
                    <h3>Useful Links</h3>
                    <ul class="footer-links">
                        <li><a href="#home">Home</a></li>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#features">Features</a></li>
                        <li><a href="#step">Step</a></li>
                        <li><a href="#faq">FAQ</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Our Services</h3>
                    <ul class="footer-links">
                        <li><a href="#">Digital Library</a></li>
                        <li><a href="#">Book Management</a></li>
                        <li><a href="#">Loan System</a></li>
                        <li><a href="#">Analytics</a></li>
                        <li><a href="#">Custom Features</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Saran & Kritik</h3>
                    <p>Kirimkan saran dan kritik Anda untuk membantu kami berkembang.</p>
                    <div class="input-group">
                        <input type="text" placeholder="Tulis pesan Anda...">
                        <button type="button">Kirim</button>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="copyright">© Copyright <strong>Readify</strong>. All Rights Reserved</div>
                <div class="social-links">
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <div class="scroll-top" onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
                    <i class="fas fa-arrow-up"></i>
                </div>
            </div>
        </footer>

        <script>
        document.addEventListener('DOMContentLoaded', function () {
            // FAQ Toggle
            const faqItems = document.querySelectorAll('.faq-item');
            faqItems.forEach(item => {
                item.querySelector('.faq-question').addEventListener('click', () => {
                    const isActive = item.classList.contains('active');
                    faqItems.forEach(i => i.classList.remove('active'));
                    if (!isActive) item.classList.add('active');
                });
            });

            // Counter animation
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        document.querySelectorAll('.stat-number').forEach(counter => {
                            const target = parseInt(counter.getAttribute('data-target'));
                            let current = 0;
                            const step = target / 80;
                            const timer = setInterval(() => {
                                current += step;
                                if (current >= target) {
                                    counter.textContent = target;
                                    clearInterval(timer);
                                } else {
                                    counter.textContent = Math.floor(current);
                                }
                            }, 25);
                        });
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            const statsSection = document.querySelector('.stats-section');
            if (statsSection) observer.observe(statsSection);

            // Navbar scroll
            const nav = document.querySelector('nav');
            window.addEventListener('scroll', () => {
                nav.classList.toggle('scrolled', window.scrollY > 60);
            });
        });
        </script>
    </body>
</html>