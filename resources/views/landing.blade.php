<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>PelitaSmart - Platform CBT Pendidikan</title>
    <style>
        /* Reset & base */
        * {
            margin: 0; padding: 0; box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            background: #f7f9fc;
            line-height: 1.6;
            overflow-x: hidden;
        }
        a {
            text-decoration: none;
            color: inherit;
        }
        img {
            max-width: 100%;
            display: block;
        }
        /* Header */
        header {
            position: fixed;
            top: 0; left: 0; width: 100%;
            background: rgba(255,255,255,0.95);
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            z-index: 1000;
            backdrop-filter: saturate(180%) blur(10px);
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 60px;
        }
        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: #1a73e8;
            letter-spacing: 2px;
            user-select: none;
        }
        .nav-links {
            display: flex;
            gap: 25px;
        }
        .nav-links a {
            font-weight: 600;
            color: #555;
            transition: color 0.3s ease;
            padding: 6px 0;
            position: relative;
        }
        .nav-links a::after {
            content: '';
            display: block;
            width: 0;
            height: 2px;
            background: #1a73e8;
            transition: width 0.3s;
            position: absolute;
            bottom: -4px;
            left: 0;
        }
        .nav-links a:hover {
            color: #1a73e8;
        }
        .nav-links a:hover::after {
            width: 100%;
        }
        /* Hero Section */
        #hero {
            position: relative;
            height: 90vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            overflow: hidden;
        }
        #hero::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: url('https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=1470&q=80');
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            filter: brightness(0.45);
            z-index: -1;
            transform: translateZ(0);
        }
        #hero .content {
            max-width: 700px;
            padding: 0 15px;
        }
        #hero h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 20px;
            text-shadow: 0 4px 8px rgba(0,0,0,0.4);
        }
        #hero p {
            font-size: 1.4rem;
            margin-bottom: 30px;
            font-weight: 600;
            text-shadow: 0 3px 6px rgba(0,0,0,0.3);
        }
        #hero button {
            background: #1a73e8;
            border: none;
            padding: 15px 50px;
            font-size: 1.1rem;
            font-weight: 700;
            color: white;
            border-radius: 40px;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(26,115,232,0.5);
            transition: background-color 0.3s ease;
        }
        #hero button:hover {
            background-color: #155ab6;
        }
        /* Features Section */
        #features {
            padding: 70px 0 40px;
            background: white;
        }
        #features .title {
            text-align: center;
            font-size: 2.7rem;
            font-weight: 800;
            color: #1a73e8;
            margin-bottom: 50px;
        }
        .features-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
            max-width: 1100px;
            margin: 0 auto;
        }
        .feature {
            background: #f0f4f9;
            border-radius: 15px;
            padding: 30px;
            flex: 1 1 280px;
            max-width: 320px;
            text-align: center;
            box-shadow: 0 8px 20px rgba(26,115,232,0.15);
            transition: transform 0.3s ease;
        }
        .feature:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 25px rgba(26,115,232,0.25);
        }
        .feature svg {
            width: 64px;
            height: 64px;
            stroke: #1a73e8;
            margin-bottom: 20px;
        }
        .feature h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: #1a73e8;
            font-weight: 700;
        }
        .feature p {
            font-size: 1rem;
            color: #555;
            font-weight: 600;
            line-height: 1.4;
        }
        /* Testimonials Section - loaded dynamically by AJAX */
        #testimonials {
            padding: 60px 0;
            background: #e9f0fb;
        }
        #testimonials .container {
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
        }
        #testimonials h2 {
            font-size: 2.5rem;
            font-weight: 800;
            color: #1a73e8;
            margin-bottom: 40px;
        }
        .testimonial-item {
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 30px;
            margin-bottom: 25px;
            font-style: italic;
            color: #444;
            position: relative;
        }
        .testimonial-item::before {
            content: "“";
            font-size: 3.5rem;
            color: #1a73e8;
            position: absolute;
            top: 10px;
            left: 20px;
        }
        .testimonial-author {
            font-weight: 700;
            margin-top: 15px;
            color: #1a73e8;
            text-transform: uppercase;
            font-size: 0.9rem;
        }
        /* Footer */
        footer {
            background: #132f4c;
            color: white;
            text-align: center;
            padding: 30px 10px;
            font-size: 0.9rem;
            margin-top: 40px;
        }
        footer a {
            color: #66a3ff;
        }
        .nav-toggle {
    display: none;
    flex-direction: column;
    cursor: pointer;
}

.nav-toggle span {
    height: 3px;
    width: 25px;
    background: #1a73e8;
    margin: 4px 0;
    transition: 0.3s;
}

.nav-links {
    display: flex;
}

@media (max-width: 768px) {
    .nav-links {
        display: none;
        flex-direction: column;
        width: 100%;
        background: white;
        position: absolute;
        top: 60px; /* Sesuaikan dengan tinggi header */
        left: 0;
        z-index: 999;
    }

    .nav-links.active {
        display: flex;
    }

    .nav-toggle {
        display: flex;
    }
}

        /* Responsive */
        @media (max-width: 768px) {
            #hero h1 {
                font-size: 2.4rem;
            }
            #hero p {
                font-size: 1.1rem;
            }
            .features-grid {
                flex-direction: column;
                max-width: 100%;
                padding: 0 15px;
            }
        }
    </style>
</head>
<body>
<header>
    <div class="container">
        <nav>
    <div class="logo">PelitaSmart</div>
    <div class="nav-toggle" id="nav-toggle">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <div class="nav-links" id="nav-links">
        <a href="#hero">Home</a>
        <a href="#features">Features</a>
        <a href="#testimonials">Testimonials</a>
        <a href="#footer">Contact</a>
    </div>
</nav>

    </div>
</header>

<section id="hero" aria-label="Hero Section">
    <div class="content" tabindex="0">
        <h1>Membangun Masa Depan dengan Pendidikan Terbaik</h1>
        <p>PelitaSmart, platform Computer Based Test (CBT) interaktif dan terpercaya untuk pendidikan masa kini.</p>
        <button id="startBtn" aria-label="Get Started with PelitaSmart"><a href={{route('register')}}>Mulai Sekarang</a></button>
    </div>
</section>

<section id="features" aria-label="Fitur PelitaSmart">
    <div class="container">
        <h2 class="title">Fitur Utama Kami</h2>
        <div class="features-grid">
            <div class="feature" tabindex="0" role="region" aria-label="Fitur Ujian Interaktif">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2-8v8a2 2 0 002 2h2m-8-10H7a2 2 0 00-2 2v10a2 2 0 002 2h3"></path>
                </svg>
                <h3>Ujian Interaktif</h3>
                <p>Mengikuti ujian berbasis komputer yang responsif dan mudah digunakan.</p>
            </div>
            <div class="feature" tabindex="0" role="region" aria-label="Fitur Pembelajaran Terintegrasi">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 20l9-5-9-5-9 5 9 5z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 12v8"></path>
                </svg>
                <h3>Pembelajaran Terintegrasi</h3>
                <p>Materi pembelajaran lengkap yang bisa diakses kapan saja dan di mana saja.</p>
            </div>
            <div class="feature" tabindex="0" role="region" aria-label="Fitur Pelacakan Perkembangan">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
                    <circle cx="12" cy="12" r="10" stroke-linecap="round" stroke-linejoin="round"></circle>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12l4 4 8-8"></path>
                </svg>
                <h3>Pelacakan Perkembangan</h3>
                <p>Memantau kemajuan belajar dan hasil ujian secara real-time.</p>
            </div>
        </div>
    </div>
</section>

<section id="testimonials" aria-label="Testimoni Pengguna">
    <div class="container">
        <h2>Testimoni Pengguna</h2>
        <div id="testimonial-container" role="list" aria-live="polite" aria-atomic="true" tabindex="0">
            <p>Memuat testimoni...</p>
        </div>
    </div>
</section>

<footer id="footer" role="contentinfo">
    <p>© 2024 PelitaSmart. Semua hak cipta dilindungi.</p>
    <p>Kontak: <a href="mailto:muhammad.160209@gmail.com">info@pelitasmart.com</a> | 
        <a href="https://twitter.com/pelitasmart" target="_blank" rel="noopener">Twitter</a> | 
        <a href="https://facebook.com/pelitasmart" target="_blank" rel="noopener">Facebook</a>
    </p>
</footer>

<script>
    // Smooth scroll for nav links
    document.querySelectorAll('.nav-links a').forEach(link => {
        link.addEventListener('click', e => {
            e.preventDefault();
            const targetId = link.getAttribute('href').slice(1);
            const target = document.getElementById(targetId);
            if(target){
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    // Parallax effect for hero background (optional subtle movement)
    window.addEventListener('scroll', () => {
        const hero = document.getElementById('hero');
        let offset = window.pageYOffset;
        hero.style.backgroundPositionY = -(offset * 0.3) + "px";
    });

    // AJAX to load testimonials dynamically
    function loadTestimonials() {
        // Simulate AJAX by loading from a static array after a delay
        const testimonials = [
            {
                text: "PelitaSmart sangat membantu saya mempersiapkan ujian dengan efektif dan mudah dipahami.",
                author: "Anisa, Siswa SMA"
            },
            {
                text: "Platform ini lengkap dan user-friendly, membuat belajar online jadi menyenangkan.",
                author: "Budi, Guru Matematika"
            },
            {
                text: "Dengan PelitaSmart, proses pembelajaran jadi lebih terstruktur dan terukur.",
                author: "Sari, Orang Tua Murid"
            }
        ];
        return new Promise(resolve => {
            setTimeout(() => resolve(testimonials), 1200);
        });
    }

    async function displayTestimonials() {
        const container = document.getElementById('testimonial-container');
        try {
            const testimonials = await loadTestimonials();
            container.innerHTML = '';
            testimonials.forEach(testi => {
                const item = document.createElement('div');
                item.classList.add('testimonial-item');
                item.setAttribute('role', 'listitem');
                item.innerHTML = `
                    <p>${testi.text}</p>
                    <div class="testimonial-author">${testi.author}</div>
                `;
                container.appendChild(item);
            });
        } catch (error) {
            container.innerHTML = '<p>Gagal memuat testimoni. Silakan coba lagi nanti.</p>';
        }
    }
    displayTestimonials();

    // Button scroll to features section
    document.getElementById('startBtn').addEventListener('click', () => {
        document.getElementById('features').scrollIntoView({behavior: 'smooth'});
    });

    document.getElementById('nav-toggle').addEventListener('click', () => {
    const navLinks = document.getElementById('nav-links');
    navLinks.classList.toggle('active');
});

</script>
</body>
</html>

