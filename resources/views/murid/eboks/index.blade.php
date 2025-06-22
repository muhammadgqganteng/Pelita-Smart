<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>PelitaSmart - Ebook Reader</title>
<style>
  /* Reset & base */
  * {
    margin: 0; padding: 0; box-sizing: border-box;
  }
  body, html {
    height: 100%;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f2f9ff;
    color: #222;
    overflow-x: hidden;
  }
  a {
    text-decoration: none;
    color: #007bff;
    cursor: pointer;
  }
  a:hover {
    text-decoration: underline;
  }

  /* Header */
  header {
    position: fixed;
    top: 0; left: 0; right: 0;
    height: 64px;
    background: linear-gradient(90deg, #1e3c72, #2a5298);
    color: white;
    display: flex;
    align-items: center;
    padding: 0 24px;
    font-weight: 700;
    font-size: 24px;
    z-index: 1000;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
  }

  /* Main layout */
  .container {
    display: flex;
    margin-top: 64px;
    height: calc(100vh - 64px);
  }

  /* Sidebar */
  .sidebar {
    width: 280px;
    background: white;
    box-shadow: 2px 0 5px rgba(0,0,0,0.08);
    overflow-y: auto;
    padding: 20px 16px;
    border-right: 1px solid #e1e7ec;
  }
  .sidebar h2 {
    font-size: 20px;
    margin-bottom: 16px;
    color: #1e3c72;
  }
  .chapter-list {
    list-style: none;
  }
  .chapter-list li {
    margin-bottom: 12px;
  }
  .chapter-list li a {
    display: block;
    padding: 10px 12px;
    border-radius: 6px;
    background: #f5faff;
    border: 1px solid transparent;
    transition: all 0.3s ease;
    font-weight: 600;
    color: #2a5298;
  }
  .chapter-list li a.active, .chapter-list li a:hover {
    background: #2a5298;
    color: white;
    border-color: #1e3c72;
  }

  /* Content area */
  .content-area {
    flex: 1;
    overflow-y: auto;
    padding: 40px 60px;
    position: relative;
    background: #fff;
  }

  /* Ebook title and meta */
  .ebook-title {
    font-size: 28px;
    font-weight: 800;
    margin-bottom: 4px;
    color: #1e3c72;
  }
  .ebook-subtitle {
    font-size: 16px;
    font-weight: 500;
    color: #555;
    margin-bottom: 24px;
  }

  /* Ebook content */
  .ebook-content {
    line-height: 1.65;
    font-size: 17px;
    color: #333;
  }

  /* Parallax backgrounds */
  .parallax-bg {
    position: fixed;
    top: 64px; /* below header */
    left: 0;
    width: 100%;
    height: 300px;
    background-image: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1470&q=80');
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    opacity: 0.12;
    pointer-events: none;
    z-index: 0;
    transform: translateY(0);
    transition: transform 0.1s linear;
  }

  /* Footer */
  footer {
    text-align: center;
    padding: 24px 12px;
    background: #f9fafb;
    font-size: 14px;
    color: #888;
  }

  /* Responsive */
  @media (max-width: 768px) {
    .container {
      flex-direction: column;
      height: auto;
    }
    .sidebar {
      width: 100%;
      height: auto;
      border-right: none;
      border-bottom: 1px solid #e1e7ec;
      padding: 12px 16px;
    }
    .content-area {
      padding: 20px 24px;
      height: auto;
    }
    .parallax-bg {
      display: none;
    }
  }
</style>
</head>
<body>
<header><a href="{{Route('murid.dashboard')}}" class="no-underline">PelitaSmart</a></header>
<div class="parallax-bg"></div>

<div class="container">
  <nav class="sidebar" aria-label="Chapters">
    <h2>Daftar Ebook</h2>
    <ul class="chapter-list" id="chapterList">
      <!-- Chapters loaded by JS -->
    </ul>
  </nav>

  <main class="content-area" tabindex="0" aria-live="polite" aria-atomic="true" id="contentArea" role="main" aria-label="Ebook Content">
    <h1 class="ebook-title" id="ebookTitle">Pilih Ebook</h1>
    <h3 class="ebook-subtitle" id="ebookSubtitle">Daftar Ebook akan tampil di sebelah kiri</h3>
    <article class="ebook-content" id="ebookContent">
      <p>Silakan pilih salah satu ebook dari daftar untuk mulai membaca.</p>
    </article>
  </main>
</div>

<footer>© 2024 PelitaSmart - Belajar Lebih Cerdas</footer>

<script>
  // Simulated ebook content data structure
  const ebooks = [
    {
      id: 'ebook1',
      title: 'Belajar Matematika Dasar',
      subtitle: 'Untuk Pelajar SMA dan SMK',
      chapters: [
        {
          chapterTitle: 'Pengantar Matematika',
          content: `<p>Matematika adalah ilmu yang mempelajari tentang angka, pola, dan hubungan. Pada bab ini kita akan mengenal konsep-konsep dasar matematika.</p>
          <p>Matematika sangat penting dalam kehidupan sehari-hari dan membantu kita dalam berpikir logis dan sistematis.</p>`
        },
        {
          chapterTitle: 'Aljabar dan Persamaan',
          content: `<p>Aljabar adalah bagian matematika yang menggunakan simbol dan huruf untuk mewakili bilangan dan operasi.</p>
          <p>Persamaan linear adalah jenis persamaan paling sederhana dalam aljabar.</p>`
        },
        {
          chapterTitle: 'Geometri Dasar',
          content: `<p>Geometri mempelajari bentuk, ukuran, dan posisi benda dalam ruang.</p>
          <p>Kita akan belajar tentang garis, sudut, dan bangun datar seperti segitiga dan persegi.</p>`
        }
      ]
    },
    {
      id: 'ebook2',
      title: 'Bahasa Inggris Pemula',
      subtitle: 'Meningkatkan Kemampuan Dasar Bahasa Inggris',
      chapters: [
        {
          chapterTitle: 'Pengantar Bahasa Inggris',
          content: `<p>Bahasa Inggris adalah bahasa internasional yang penting untuk komunikasi global.</p>
          <p>Pada bab ini kita akan mempelajari kosakata dan pengucapan dasar.</p>`
        },
        {
          chapterTitle: 'Grammar Dasar',
          content: `<p>Grammar adalah aturan dalam bahasa Inggris yang mengatur cara membentuk kalimat yang benar.</p>
          <p>Kita akan belajar tentang tense, kata benda, kata kerja, dan lainnya.</p>`
        },
        {
          chapterTitle: 'Percakapan Sehari-hari',
          content: `<p>Pelajari cara berbicara dalam situasi sehari-hari seperti menyapa, berbelanja, dan menanyakan arah.</p>`
        }
      ]
    }
  ];

  // DOM references
  const chapterListEl = document.getElementById('chapterList');
  const ebookTitleEl = document.getElementById('ebookTitle');
  const ebookSubtitleEl = document.getElementById('ebookSubtitle');
  const ebookContentEl = document.getElementById('ebookContent');
  const contentAreaEl = document.getElementById('contentArea');

  // Current state
  let currentEbookId = null;
  let currentChapterIndex = 0;

  // Populate ebook list with chapters underneath, using AJAX simulation (timeout)
  function loadEbookList() {
    chapterListEl.innerHTML = '';
    ebooks.forEach(ebook => {
      const ebookLi = document.createElement('li');
      ebookLi.style.marginBottom = '12px';

      const ebookTitleLink = document.createElement('a');
      ebookTitleLink.textContent = ebook.title;
      ebookTitleLink.href = '#';
      ebookTitleLink.setAttribute('data-ebook-id', ebook.id);
      ebookTitleLink.classList.add('ebook-link');
      ebookTitleLink.style.fontWeight = 'bold';

      // Click event loads first chapter from this ebook
      ebookTitleLink.addEventListener('click', ev => {
        ev.preventDefault();
        if(currentEbookId !== ebook.id){
          setActiveEbookItem(ebook.id);
          loadChapter(ebook.id, 0);
        }
      });

      ebookLi.appendChild(ebookTitleLink);

      // Chapter list under each ebook
      const chapterUl = document.createElement('ul');
      chapterUl.style.listStyle = 'disc';
      chapterUl.style.marginLeft = '20px';
      chapterUl.style.marginTop = '6px';

      ebook.chapters.forEach((chapter, idx) => {
        const chapLi = document.createElement('li');
        chapLi.style.marginTop = '6px';

        const chapLink = document.createElement('a');
        chapLink.href = '#';
        chapLink.textContent = chapter.chapterTitle;
        chapLink.setAttribute('data-ebook-id', ebook.id);
        chapLink.setAttribute('data-chapter-index', idx);
        chapLink.classList.add('chapter-link');

        chapLink.addEventListener('click', ev => {
          ev.preventDefault();
          setActiveEbookItem(ebook.id, idx);
          loadChapter(ebook.id, idx);
        });

        chapLi.appendChild(chapLink);
        chapterUl.appendChild(chapLi);
      });

      ebookLi.appendChild(chapterUl);
      chapterListEl.appendChild(ebookLi);
    });
  }

  // Set active styling for selected ebook and chapter
  function setActiveEbookItem(ebookId, chapterIndex = 0) {
    // Remove all active classes first
    document.querySelectorAll('.chapter-list a').forEach(a => {
      a.classList.remove('active');
    });
    // Activate ebook main title
    const mainLink = document.querySelector(`.chapter-list a.ebook-link[data-ebook-id="${ebookId}"]`);
    if(mainLink) mainLink.classList.add('active');
    // Activate chapter link
    if(chapterIndex !== null) {
      const chapLink = document.querySelector(`.chapter-list a.chapter-link[data-ebook-id="${ebookId}"][data-chapter-index="${chapterIndex}"]`);
      if(chapLink) chapLink.classList.add('active');
    }
  }

  // Simulate AJAX loading chapter content
  function loadChapter(ebookId, chapterIndex) {
    contentAreaEl.setAttribute('aria-busy', 'true');
    ebookTitleEl.textContent = 'Memuat...';
    ebookSubtitleEl.textContent = '';
    ebookContentEl.innerHTML = '<p>Memuat konten, tunggu sebentar...</p>';
    currentEbookId = ebookId;
    currentChapterIndex = chapterIndex;

    // Simulate network delay AJAX with setTimeout
    setTimeout(() => {
      const ebook = ebooks.find(e => e.id === ebookId);
      if(!ebook){
        ebookTitleEl.textContent = 'Ebook tidak ditemukan';
        ebookSubtitleEl.textContent = '';
        ebookContentEl.innerHTML = '<p>Maaf, ebook yang Anda minta tidak tersedia.</p>';
        contentAreaEl.setAttribute('aria-busy', 'false');
        return;
      }

      ebookTitleEl.textContent = ebook.title;
      ebookSubtitleEl.textContent = ebook.subtitle;

      const chapter = ebook.chapters[chapterIndex];
      if(!chapter) {
        ebookContentEl.innerHTML = '<p>Bab tidak ditemukan.</p>';
      } else {
        // Add chapter title and content
        ebookContentEl.innerHTML = `<h2 style="color: #2a5298; margin-bottom: 12px;">${chapter.chapterTitle}</h2>${chapter.content}`;
      }
      contentAreaEl.setAttribute('aria-busy', 'false');
      // Scroll content area to top on new content load
      contentAreaEl.scrollTop = 0;
    }, 600);
  }

  // Parallax background effect on scroll
  const parallaxBg = document.querySelector('.parallax-bg');
  const contentArea = document.querySelector('.content-area');

  contentArea.addEventListener('scroll', () => {
    // Translate parallax background vertically slower than scroll
    const scrollTop = contentArea.scrollTop;
    if(parallaxBg){
      parallaxBg.style.transform = `translateY(${scrollTop * 0.4}px)`;
    }
  });

  // Initialize
  loadEbookList();


  chapterListEl.addEventListener('keydown', ev => {
    const focusable = chapterListEl.querySelectorAll('a');
    const currentIndex = Array.prototype.indexOf.call(focusable, document.activeElement);
    
    let nextIndex = null;
    if(ev.key === 'ArrowDown') {
      nextIndex = (currentIndex+1) % focusable.length;
      ev.preventDefault();
      focusable[nextIndex].focus();
    } else if(ev.key === 'ArrowUp') {
      nextIndex = (currentIndex-1 + focusable.length) % focusable.length;
      ev.preventDefault();
      focusable[nextIndex].focus();
    }
  });
</script>
</body>
</html>

