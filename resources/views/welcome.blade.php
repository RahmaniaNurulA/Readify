<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Readify - Membaca Lebih Menyenangkan</title>
        
        <!-- Fonts -->
         <!-- Tambahkan di dalam tag <head> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <style>
:root {
    /* Primary Colors */
    --primary-purple: #667eea;
    --primary-dark-purple: #764ba2;
    --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    
    /* Text Colors */
    --text-dark: #1a202c;
    --text-medium: #2d3748;
    --text-light: #4a5568;
    --text-muted: #6c757d;
    --text-faq: #5a6c7d;
    --text-white: #ffffff;
    
    /* Background Colors */
    --bg-white: #ffffff;
    --bg-light: #f8f9fa;
    --bg-nav: rgba(255, 255, 255, 0.95);
    --bg-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    
    /* Accent Colors */
    --accent-light-purple: #f0f3ff;
    --accent-light-pink: #fef0ff;
    --accent-gradient: linear-gradient(135deg, #f0f3ff 0%, #fef0ff 100%);
    
    /* Shadow */
    --shadow-sm: 0 2px 20px rgba(0, 0, 0, 0.1);
    --shadow-md: 0 4px 20px rgba(0, 0, 0, 0.08);
    --shadow-md-hover: 0 6px 30px rgba(0, 0, 0, 0.25);
    --shadow-lg: 0 8px 30px rgba(0, 0, 0, 0.2);
    --shadow-xl: 0 12px 40px rgba(0, 0, 0, 0.3);
    --shadow-2xl: 0 20px 60px rgba(0, 0, 0, 0.3);
    --shadow-purple: 0 4px 15px rgba(102, 126, 234, 0.4);
    --shadow-purple-hover: 0 6px 20px rgba(102, 126, 234, 0.6);
    --shadow-card: 0 4px 20px rgba(0, 0, 0, 0.15);
    --shadow-feature: 0 4px 15px rgba(0, 102, 161, 0.2);
    --shadow-image: 0 20px 60px rgba(0, 0, 0, 0.15);
    --shadow-text: 0 4px 20px rgba(0, 0, 0, 0.2);
    --shadow-text-light: 0 2px 10px rgba(0, 0, 0, 0.2);
    
    /* Border Radius */
    --radius-sm: 8px;
    --radius-md: 12px;
    --radius-lg: 16px;
    --radius-xl: 25px;
    --radius-2xl: 40px;
    --radius-round: 50%;
    --radius-pill: 50px;
    
    /* Transitions */
    --transition: all 0.3s ease;
    --transition-fast: all 0.2s ease;
    
    /* Opacity */
    --opacity-high: 0.95;
    --opacity-medium: 0.9;
    
    /* Overlay */
    --overlay-light: rgba(255, 255, 255, 0.1);
    --overlay-white: rgba(255, 255, 255, 0.2);
    --overlay-border: rgba(255, 255, 255, 0.2);
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
    background: var(--bg-gradient);
    min-height: 100vh;
    overflow-x: hidden;
}

nav {
    backdrop-filter: blur(10px);
    padding: 1.2rem 0;
    position: sticky;
    top: 0;
    z-index: 100;
    transition: all 0.3s ease;
}

/* Navbar default (transparan) */
nav.transparent {
    background: transparent;
    box-shadow: none;
}

/* Navbar saat di-scroll (putih semi-transparan) */
nav.scrolled {
    background: rgba(255, 255, 255, 0.9);
    box-shadow: var(--shadow-sm);
}

.nav-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    text-decoration: none;
}

.logo-icon {
    width: 120px;
    height: 48px;
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
}

.nav-menu {
    display: flex;
    gap: 2.5rem;
    align-items: center;
    list-style: none;
}

.nav-menu a {
    text-decoration: none;
    color: var(--text-medium);
    font-weight: 500;
    font-size: 1.05rem;
    transition: var(--transition);
    position: relative;
}

.nav-menu a:hover {
    color: var(--text-faq);
}

.nav-menu a::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 0;
    width: 0;
    height: 2px;
    background: var(--primary-purple);
    transition: width 0.3s ease;
}

.nav-menu a:hover::after {
    width: 100%;
}

.btn-login {
    background: white;
    color: var(--text-white);
    padding: 0.75rem 2rem;
    border-radius: var(--radius-pill);
    text-decoration: none;
    font-weight: 600;
    transition: var(--transition);
    box-shadow: var(--shadow-purple);
}

.btn-login:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-purple-hover);
}

.hero {
    max-width: 1200px;
    margin: 0 auto;
    padding: 5rem 2rem;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
}

.hero-content h1 {
    font-size: 3.5rem;
    font-weight: 800;
    color: var(--text-white);
    line-height: 1.2;
    margin-bottom: 2rem;
    text-shadow: var(--shadow-text);
}

.btn-primary {
    background: var(--bg-white);
    color: var(--primary-purple);
    padding: 1rem 3rem;
    border-radius: var(--radius-pill);
    text-decoration: none;
    font-weight: 700;
    font-size: 1.25rem;
    display: inline-block;
    transition: var(--transition);
    box-shadow: var(--shadow-lg);
}

.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-xl);
}

.hero-image {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
}

.device-mockup {
    animation: pulse 2s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { 
        transform: scale(1); 
    }
    50% { 
        transform: scale(1.05); 
    }
}

.device-frame {
    width: 100%;
    height: auto;
    background: var(--primary-gradient);
    border-radius: var(--radius-2xl);
    padding: 20px;
    box-shadow: var(--shadow-2xl);
}

.device-screen {
    background: var(--bg-white);
    border-radius: var(--radius-xl);
    padding: 40px;
    position: relative;
    overflow: hidden;
}

.book-icon {
    width: 100%;
    max-width: 300px;
    margin: 0 auto;
    display: block;
}

.about-section {
    background: var(--bg-white);
    padding: 6rem 2rem;
}

.about-container {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
}

.about-content h2 {
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--text-dark);
    margin-bottom: 1.5rem;
}

.about-content p {
    color: var(--text-light);
    line-height: 1.8;
    margin-bottom: 2rem;
    font-size: 1.05rem;
}

.about-features {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-bottom: 2rem;
}

.about-feature-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    color: var(--text-medium);
    font-weight: 500;
}

.about-feature-item svg {
    flex-shrink: 0;
}

.btn-read-more {
    display: inline-block;
    background: var(--primary-gradient);
    color: var(--text-white);
    padding: 0.875rem 2.5rem;
    border-radius: var(--radius-pill);
    text-decoration: none;
    font-weight: 600;
    transition: var(--transition);
    box-shadow: var(--shadow-purple);
}

.btn-read-more:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-purple-hover);
}

.about-illustration {
    display: flex;
    justify-content: center;
    align-items: center;
}

.stats-section {
    padding: 80px 20px;
    position: relative;
    overflow: hidden;
}

.stats-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 20% 50%, var(--overlay-light) 0%, transparent 50%),
        radial-gradient(circle at 80% 50%, var(--overlay-light) 0%, transparent 50%);
    pointer-events: none;
}

.stats-container {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 60px;
    position: relative;
    z-index: 1;
}

.stat-item {
    text-align: center;
    color: var(--text-white);
    transform: translateY(0);
    transition: transform 0.3s ease;
}

.stat-item:hover {
    transform: translateY(-10px);
}

.stat-number {
    font-size: 72px;
    font-weight: 700;
    line-height: 1;
    margin-bottom: 16px;
    text-shadow: var(--shadow-text);
    font-family: 'Arial', sans-serif;
    letter-spacing: -2px;
}

.stat-label {
    font-size: 20px;
    font-weight: 300;
    opacity: var(--opacity-high);
    letter-spacing: 0.5px;
}

.features-section {
    padding: 100px 20px;
    background: var(--bg-white);
}

.features-container {
    max-width: 1400px;
    margin: 0 auto;
}

.features-title {
    font-size: 48px;
    font-weight: 700;
    color: var(--text-dark);
    text-align: center;
    margin-bottom: 20px;
}

.feature-underline {
    width: 120px;
    height: 4px;
    background: var(--primary-gradient);
    margin: 0 auto 10px;
    border-radius: 2px;
    margin-bottom: 60px;
}

.features-content {
    display: grid;
    grid-template-columns: 1fr 1.2fr 1fr;
    gap: 60px;
    align-items: center;
}

.features-left,
.features-right {
    display: flex;
    flex-direction: column;
    gap: 40px;
}

.feature-item {
    display: flex;
    gap: 20px;
    align-items: flex-start;
}

.feature-icon {
    width: 60px;
    height: 60px;
    min-width: 60px;
    background: var(--primary-purple);
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: var(--shadow-feature);
}

.feature-icon svg {
    width: 32px;
    height: 32px;
    color: var(--text-white);
}

.feature-text {
    flex: 1;
}

.feature-title {
    font-size: 22px;
    font-weight: 600;
    color: var(--text-medium);
    margin-bottom: 8px;
    line-height: 1.3;
}

.feature-description {
    font-size: 15px;
    color: var(--text-muted);
    line-height: 1.6;
    margin: 0;
}

.features-center {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

.dashboard-image {
    width: 100%;
    max-width: 700px;
    height: auto;
    filter: drop-shadow(var(--shadow-image));
    animation: float 6s ease-in-out infinite;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-20px);
    }
}

.steps-section {
    padding: 100px 20px;
}

.steps-container {
    max-width: 1200px;
    margin: 0 auto;
    text-align: center;
}

.steps-title {
    font-size: 48px;
    font-weight: 700;
    color: var(--text-white);
    margin-bottom: 16px;
    letter-spacing: 2px;
}

.steps-underline {
    width: 80px;
    height: 4px;
    background: var(--text-white);
    margin: 0 auto 32px;
    border-radius: 2px;
}

.steps-description {
    font-size: 18px;
    color: var(--text-white);
    line-height: 1.6;
    margin-bottom: 60px;
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
}

.steps-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 40px;
    margin-top: 60px;
}

.step-card {
    background: var(--bg-white);
    padding: 50px 30px;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-md);
    transition: var(--transition);
    position: relative;
}

.step-card:hover {
    transform: translateY(-10px);
    box-shadow: var(--shadow-card);
}

.step-icon-wrapper {
    width: 100px;
    height: 100px;
    margin: 0 auto 30px;
    background: var(--accent-gradient);
    border-radius: var(--radius-round);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: var(--transition);
}

.step-card:hover .step-icon-wrapper {
    transform: scale(1.1);
    background: var(--primary-gradient);
}

.step-icon {
    width: 50px;
    height: 50px;
    color: var(--primary-purple);
    transition: color 0.3s ease;
}

.step-card:hover .step-icon {
    color: var(--text-white);
}

.step-title {
    font-size: 28px;
    font-weight: 600;
    color: var(--text-medium);
    margin-bottom: 20px;
}

.step-description {
    font-size: 16px;
    color: var(--text-muted);
    line-height: 1.7;
}

.faq-section {
    background: var(--bg-white);
    padding: 100px 20px;
    position: relative;
    overflow: hidden;
}

.faq-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 20% 30%, var(--overlay-light) 0%, transparent 50%),
        radial-gradient(circle at 80% 70%, var(--overlay-light) 0%, transparent 50%);
    pointer-events: none;
}

.faq-container {
    max-width: 900px;
    margin: 0 auto;
    position: relative;
    z-index: 1;
}

.faq-title {
    font-size: 48px;
    font-weight: 700;
    color: var(--text-dark);
    text-align: center;
    margin-bottom: 16px;
    letter-spacing: 2px;
    text-shadow: var(--shadow-text-light);
}

.faq-underline {
    width: 80px;
    height: 4px;
    background: var(--text-white);
    margin: 0 auto 32px;
    border-radius: 2px;
}

.faq-description {
    font-size: 18px;
    color: var(--text-medium);
    text-align: center;
    line-height: 1.7;
    margin-bottom: 60px;
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
}

.faq-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.faq-item {
    background: var(--bg-white);
    border-radius: var(--radius-md);
    overflow: hidden;
    box-shadow: var(--shadow-card);
    transition: var(--transition);
}

.faq-item:hover {
    box-shadow: var(--shadow-md-hover);
}

.faq-question {
    width: 100%;
    padding: 28px 32px;
    display: flex;
    align-items: center;
    gap: 20px;
    background: var(--bg-white);
    border: none;
    cursor: pointer;
    transition: var(--transition);
    text-align: left;
}

.faq-question:hover {
    background: var(--bg-light);
}

.faq-icon {
    width: 32px;
    height: 32px;
    color: var(--primary-purple);
    flex-shrink: 0;
}

.faq-question-text {
    flex: 1;
    font-size: 20px;
    font-weight: 600;
    color: var(--text-medium);
}

.faq-toggle {
    width: 24px;
    height: 24px;
    color: var(--primary-purple);
    flex-shrink: 0;
    transition: transform 0.3s ease;
}

.faq-item.active .faq-toggle {
    transform: rotate(180deg);
}

.faq-answer {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease, padding 0.3s ease;
    background: var(--bg-light);
}

.faq-item.active .faq-answer {
    max-height: 500px;
    padding: 0 32px 28px 84px;
}

.faq-answer p {
    font-size: 16px;
    color: var(--text-faq);
    line-height: 1.7;
    margin: 0;
}

.footer-container {
    color: var(--text-white);
    padding: 60px 20px 20px;
    margin-top: auto;
}

.footer-content {
    max-width: 1400px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1.5fr 1fr 1fr 1.5fr;
    gap: 50px;
    margin-bottom: 40px;
}

.footer-section h2 {
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 20px;
    letter-spacing: 1px;
}

.footer-section h3 {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 25px;
}

.footer-section p {
    line-height: 1.8;
    margin-bottom: 25px;
    opacity: var(--opacity-high);
}

.contact-info {
    line-height: 2;
}

.contact-info p {
    margin-bottom: 10px;
}

.contact-info strong {
    font-weight: 600;
}

.footer-links {
    list-style: none;
}

.footer-links li {
    margin-bottom: 15px;
}

.footer-links a {
    color: var(--text-white);
    text-decoration: none;
    display: flex;
    align-items: center;
    transition: var(--transition);
    opacity: var(--opacity-medium);
}

.footer-links a:hover {
    opacity: 1;
    transform: translateX(5px);
}

.footer-links a::before {
    content: '›';
    margin-right: 8px;
    font-size: 20px;
    font-weight: bold;
}

.advice-section {
    display: flex;
    flex-direction: column;
}

.advice-section p {
    margin-bottom: 20px;
}

.input-group {
    display: flex;
    gap: 10px;
}

.input-group input {
    flex: 1;
    padding: 15px 20px;
    border: none;
    border-radius: var(--radius-sm);
    font-size: 15px;
    outline: none;
}

.input-group button {
    padding: 15px 35px;
    background: var(--overlay-white);
    color: var(--text-white);
    border: 2px solid var(--text-white);
    border-radius: var(--radius-sm);
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
}

.input-group button:hover {
    background: var(--bg-white);
    color: var(--primary-dark-purple);
    transform: translateY(-2px);
}

.footer-bottom {
    max-width: 1400px;
    margin: 0 auto;
    width: 100%;
    padding-top: 30px;
    border-top: 1px solid var(--overlay-border);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.copyright {
    opacity: var(--opacity-medium);
}

.social-links {
    display: flex;
    gap: 15px;
}

.social-links a {
    width: 40px;
    height: 40px;
    background: var(--overlay-white);
    border-radius: var(--radius-round);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-white);
    text-decoration: none;
    transition: var(--transition);
}

.social-links a:hover {
    background: var(--bg-white);
    color: var(--primary-dark-purple);
    transform: translateY(-5px);
}

.scroll-top {
    width: 45px;
    height: 45px;
    background: var(--overlay-white);
    border-radius: var(--radius-round);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-white);
    cursor: pointer;
    transition: var(--transition);
    border: 2px solid var(--text-white);
}

.scroll-top:hover {
    background: var(--bg-white);
    color: var(--primary-dark-purple);
    transform: translateY(-5px);
}

/* Features Responsive */
@media (max-width: 1200px) {
    .features-content {
        grid-template-columns: 1fr;
        gap: 60px;
    }
    
    .features-left,
    .features-right {
        order: 2;
    }
    
    .features-center {
        order: 1;
    }
    
    .features-left,
    .features-right {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 30px;
    }
}

/* Footer Responsive */
@media (max-width: 1024px) {
    .footer-content {
        grid-template-columns: 1fr 1fr;
        gap: 40px;
    }
}

/* Steps Responsive */
@media (max-width: 968px) {
    .steps-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 30px;
    }
    
    .steps-title {
        font-size: 40px;
    }
}

/* General Tablet/Mobile */
@media (max-width: 768px) {
    /* Navigation */
    .nav-menu {
        display: none;
    }

    /* Hero */
    .hero {
        grid-template-columns: 1fr;
        padding: 3rem 1.5rem;
        text-align: center;
    }

    .hero-content h1 {
        font-size: 2.5rem;
    }

    .hero-image {
        order: -1;
    }

    .device-mockup {
        max-width: 350px;
    }

    /* About */
    .about-container {
        grid-template-columns: 1fr;
        gap: 3rem;
    }

    .about-illustration {
        order: -1;
    }

    /* Features */
    .features-section {
        padding: 60px 20px;
    }
    
    .features-title {
        font-size: 36px;
        margin-bottom: 50px;
    }
    
    .features-left,
    .features-right {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .feature-icon {
        width: 50px;
        height: 50px;
        min-width: 50px;
    }
    
    .feature-icon svg {
        width: 28px;
        height: 28px;
    }
    
    .feature-title {
        font-size: 18px;
    }
    
    .feature-description {
        font-size: 14px;
    }

    /* FAQ */
    .faq-section {
        padding: 60px 20px;
    }
    
    .faq-title {
        font-size: 32px;
    }
    
    .faq-description {
        font-size: 16px;
        margin-bottom: 40px;
    }
    
    .faq-question {
        padding: 20px 20px;
        gap: 15px;
    }
    
    .faq-icon {
        width: 28px;
        height: 28px;
    }
    
    .faq-question-text {
        font-size: 17px;
    }
    
    .faq-item.active .faq-answer {
        padding: 0 20px 20px 63px;
    }
    
    .faq-answer p {
        font-size: 15px;
    }

    /* Footer */
    .footer-content {
        grid-template-columns: 1fr;
        gap: 30px;
    }

    .footer-bottom {
        flex-direction: column;
        gap: 20px;
        text-align: center;
    }
}

/* Small Mobile */
@media (max-width: 576px) {
    .steps-section {
        padding: 60px 20px;
    }
    
    .steps-grid {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .steps-title {
        font-size: 36px;
    }
    
    .steps-description {
        font-size: 16px;
    }
    
    .step-card {
        padding: 40px 25px;
    }
}
        </style>
    </head>
    <body>
        <!-- Navigation -->
        <nav>
            <div class="nav-container">
                <a href="#home" class="logo">
                    <img src="{{ asset('images/logo.png') }}" alt="Readify Logo" style="width: 120px; height: 48px;">
                </a>
                
                <ul class="nav-menu">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#step">Step</a></li>
                    <li><a href="#faq">FAQ</a></li>
                    <li><a href="#login" class="btn-login">Login</a></li>
                </ul>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="hero" id="home">
            <div class="hero-content">
                <h1>Membaca Lebih Menyenangkan Dengan Readify</h1>
                <a href="#" class="btn-primary">Ayo Baca</a>
            </div>
            
            <div class="hero-image">
                <div class="device-mockup">
                    <div class="device-frame">
                        <div class="device-screen">
                            <img src="{{ asset('images/book-illustration.png') }}" alt="Readify App Illustration" class="book-icon" style="width: 100%; max-width: 300px; margin: 0 auto; display: block;">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section class="about-section" id="about">
            <div class="about-container">
                <div class="about-content">
                    <h2>About Us</h2>
                    <p>Readify adalah perpustakaan digital yang memudahkan Anda menjelajahi dunia literasi. Dari buku baru, Readify menjadi solusi bagi para pencinta buku, pembelajar, dan siapa saja yang ingin memperluas pengetahuan.</p>
                    
                    <div class="about-features">
                        <div class="about-feature-item">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="#667eea">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                            </svg>
                            <span>Koleksi Beragam</span>
                        </div>
                        <div class="about-feature-item">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="#667eea">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                            </svg>
                            <span>Akses Cepat</span>
                        </div>
                        <div class="about-feature-item">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="#667eea">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                            </svg>
                            <span>Mendukung Peminjaman</span>
                        </div>
                    </div>
                    
                    <a href="#" class="btn-read-more">Read More</a>
                </div>
                
                <div class="about-illustration">
                    <img src="{{ asset('images/about-illustration.png') }}" alt="About Readify" style="width: 100%; max-width: 500px;">
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="stats-section">
            <div class="stats-container">
                <div class="stat-item">
                    <div class="stat-number" data-target="15">0</div>
                    <div class="stat-label">Buku</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number" data-target="5">0</div>
                    <div class="stat-label">Kategori</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number" data-target="20">0</div>
                    <div class="stat-label">Anggota</div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
<section class="features-section" id="features">
    <div class="features-container">
        <h2 class="features-title">Features</h2>
        <div class="feature-underline"></div>
        
        <div class="features-content">
            <!-- Left Features -->
            <div class="features-left">
                <!-- Feature 1 -->
                <div class="feature-item">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <div class="feature-text">
                        <h3 class="feature-title">Dashboard Analitik</h3>
                        <p class="feature-description">Untuk reporting behaviour pembaca yang mudah & lengkap</p>
                    </div>
                </div>
                
                <!-- Feature 2 -->
                <div class="feature-item">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div class="feature-text">
                        <h3 class="feature-title">Manajemen Buku</h3>
                        <p class="feature-description">Kelola koleksi buku digital dengan mudah dan terorganisir</p>
                    </div>
                </div>
            </div>
            
            <!-- Center Image -->
            <div class="features-center">
                <img src="{{ asset('images/dashboard-mockup.png') }}" alt="Dashboard Preview" class="dashboard-image">
            </div>
            
            <!-- Right Features -->
            <div class="features-right">
                <!-- Feature 3 -->
                <div class="feature-item">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div class="feature-text">
                        <h3 class="feature-title">Tambahan Fitur Sesuai Request</h3>
                        <p class="feature-description">Customisasi fitur sesuai kebutuhan perpustakaan Anda</p>
                    </div>
                </div>
                
                <!-- Feature 4 -->
                <div class="feature-item">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div class="feature-text">
                        <h3 class="feature-title">Pinjam Buku</h3>
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
        <h2 class="steps-title">STEP</h2>
        <div class="steps-underline"></div>
        <p class="steps-description">
            Tertarik membaca buku dan meminjam di Readify? Berikut adalah 3 langkah mudah untuk meminjam buku di Readify
        </p>
        
        <div class="steps-grid">
            <!-- Step 1: Login -->
            <div class="step-card">
                <div class="step-icon-wrapper">
                    <svg class="step-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <h3 class="step-title">Login</h3>
                <p class="step-description">
                    Login ke akun Readify menggunakan username dan password yang telah terdaftar
                </p>
            </div>
            
            <!-- Step 2: Lihat Buku -->
            <div class="step-card">
                <div class="step-icon-wrapper">
                    <svg class="step-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <h3 class="step-title">Lihat Buku</h3>
                <p class="step-description">
                    Lihat daftar buku yang tersedia langsung dari Website Readify
                </p>
            </div>
            
            <!-- Step 3: Pinjam -->
            <div class="step-card">
                <div class="step-icon-wrapper">
                    <svg class="step-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="step-title">Pinjam</h3>
                <p class="step-description">
                    Lalu ambil buku yang ingin kamu pinjam dan nikmati bacaanmu
                </p>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section" id="faq">
    <div class="faq-container">
        <h2 class="faq-title">FREQUENTLY ASKED QUESTIONS</h2>
        <div class="faq-underline"></div>
        <p class="faq-description">
            Punya pertanyaan seputar Readify? Temukan jawabannya di sini! Kami telah merangkum pertanyaan yang sering diajukan untuk membantu Anda memahami layanan perpustakaan digital kami dengan lebih baik.
        </p>
        
        <div class="faq-list">
            <!-- FAQ Item 1 -->
            <div class="faq-item active">
                <button class="faq-question">
                    <svg class="faq-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="faq-question-text">Apa itu Readify?</span>
                    <svg class="faq-toggle" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                    </svg>
                </button>
                <div class="faq-answer">
                    <p>Readify adalah sebuah perpustakaan digital yang menyediakan akses ke berbagai koleksi buku dari berbagai genre. Kami memungkinkan pembaca untuk membaca secara digital dan menikmati kebebasan literasi di mana saja.</p>
                </div>
            </div>
            
            <!-- FAQ Item 2 -->
            <div class="faq-item">
                <button class="faq-question">
                    <svg class="faq-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="faq-question-text">Bagaimana cara mendaftar menjadi anggota?</span>
                    <svg class="faq-toggle" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="faq-answer">
                    <p>Untuk mendaftar menjadi anggota Readify, kunjungi halaman pendaftaran di website kami, isi formulir dengan data diri yang valid seperti nama lengkap, email, dan nomor telepon. Setelah mendaftar, Anda akan menerima email konfirmasi untuk mengaktifkan akun Anda.</p>
                </div>
            </div>
            
            <!-- FAQ Item 3 -->
            <div class="faq-item">
                <button class="faq-question">
                    <svg class="faq-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="faq-question-text">Apakah ada biaya layanan untuk menggunakan Readify?</span>
                    <svg class="faq-toggle" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="faq-answer">
                    <p>Readify menawarkan layanan gratis untuk koleksi buku dasar. Namun, untuk mengakses koleksi premium dan fitur eksklusif lainnya, tersedia paket berlangganan dengan harga terjangkau yang dapat disesuaikan dengan kebutuhan Anda.</p>
                </div>
            </div>
            
            <!-- FAQ Item 4 -->
            <div class="faq-item">
                <button class="faq-question">
                    <svg class="faq-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="faq-question-text">Buku yang diakses dalam bentuk digital atau fisik?</span>
                    <svg class="faq-toggle" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="faq-answer">
                    <p>Semua buku di Readify tersedia dalam bentuk digital. Anda dapat mengakses dan membaca koleksi buku kami melalui website atau aplikasi mobile kapan saja dan di mana saja menggunakan perangkat Anda.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="footer-container">
        <div class="footer-content">
            <div class="footer-section">
                <h2>Readify</h2>
                <p>Terima kasih telah berkunjung! Temukan lebih banyak informasi menarik dan ikuti kami di perjalanan kami.</p>
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
                    <li><a href="#about">About us</a></li>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#step">Step</a></li>
                    <li><a href="#faq">FAQ</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Our Services</h3>
                <ul class="footer-links">
                    <li><a href="#web-design">Web Design</a></li>
                    <li><a href="#web-dev">Web Development</a></li>
                    <li><a href="#product">Product Management</a></li>
                    <li><a href="#marketing">Marketing</a></li>
                    <li><a href="#graphic">Graphic Design</a></li>
                </ul>
            </div>

            <div class="footer-section advice-section">
                <h3>Advice Us</h3>
                <p>Kirimkan saran dan kritik anda kepada kami.</p>
                <div class="input-group">
                    <input type="text" placeholder="Masukkan pesan Anda...">
                    <button type="button">Send</button>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="copyright">
                © Copyright <strong>Readify</strong>. All Rights Reserved
            </div>
            <div class="social-links">
                <a href="#twitter" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="#facebook" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#instagram" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#skype" aria-label="Skype"><i class="fab fa-skype"></i></a>
                <a href="#linkedin" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <div class="scroll-top" onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
                <i class="fas fa-arrow-up"></i>
            </div>
        </div>
    </footer>

<script>
        // FAQ Toggle Functionality
document.addEventListener('DOMContentLoaded', function() {
    const faqItems = document.querySelectorAll('.faq-item');
    
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        
        question.addEventListener('click', () => {
            // Cek apakah item yang diklik sedang aktif
            const isActive = item.classList.contains('active');
            
            // Tutup semua FAQ items
            faqItems.forEach(otherItem => {
                otherItem.classList.remove('active');
            });
            
            // Jika item sebelumnya tidak aktif, buka item yang diklik
            if (!isActive) {
                item.classList.add('active');
            }
        });
    });
});

        // Counter Animation (dari sebelumnya)
        function animateCounter() {
            const counters = document.querySelectorAll('.stat-number');
            
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                const duration = 2000;
                const increment = target / (duration / 16);
                let current = 0;
                
                const updateCounter = () => {
                    current += increment;
                    
                    if (current < target) {
                        counter.textContent = Math.floor(current);
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target;
                    }
                };
                
                updateCounter();
            });
        }

        const observerOptions = {
            threshold: 0.5,
            rootMargin: '0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter();
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        const statsSection = document.querySelector('.stats-section');
        if (statsSection) {
            observer.observe(statsSection);
        }

        // Ambil elemen navbar
const nav = document.querySelector('nav');

// Tambahkan class 'transparent' saat halaman dimuat
nav.classList.add('transparent');

// Fungsi untuk mengubah navbar saat scroll
window.addEventListener('scroll', function() {
    if (window.scrollY > 50) {
        // Jika scroll lebih dari 50px
        nav.classList.remove('transparent');
        nav.classList.add('scrolled');
    } else {
        // Jika di posisi atas
        nav.classList.remove('scrolled');
        nav.classList.add('transparent');
    }
});
    </script>
    </body>
</html>