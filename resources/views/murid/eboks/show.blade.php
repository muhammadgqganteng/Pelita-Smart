<x-app-layout>
    <x-slot name="title">Baca eBook - PelitaSmart</x-slot>

    <style>
        .parallax-bg {
            position: fixed;
            top: 64px;
            left: 0;
            width: 100%;
            height: 300px;
            background: url('https://images.unsplash.com/photo-1532012197267-da84d127e765?auto=format&fit=crop&w=1470&q=80') center/cover no-repeat fixed;
            opacity: 0.1;
            z-index: 0;
            pointer-events: none;
            transition: transform 0.1s ease-out;
        }
    </style>

    <div class="parallax-bg"></div>

    <div class="container-fluid" style="margin-top: 64px;">
        <div class="row">
            <!-- Sidebar -->
            <aside class="col-md-3 border-end bg-white p-3 overflow-auto" style="height: calc(100vh - 64px);">
                <h5 class="text-primary mb-3 fw-semibold">📚 Daftar Buku</h5>
                <ul id="ebook-list" class="list-unstyled"></ul>
            </aside>

            <!-- Main Content -->
            <main class="col-md-9 p-5" id="main-content" style="height: calc(100vh - 64px); overflow-y: auto;">
                <h2 id="ebook-title">Pilih Ebook</h2>
                <h6 id="ebook-subtitle" class="text-muted">Daftar bab tersedia di sebelah kiri</h6>
                <div id="ebook-content" class="mt-4 text-secondary">
                    <p>Silakan pilih bab dari eBook yang tersedia untuk mulai membaca.</p>
                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ebookList = document.getElementById('ebook-list');
            const ebookTitle = document.getElementById('ebook-title');
            const ebookSubtitle = document.getElementById('ebook-subtitle');
            const ebookContent = document.getElementById('ebook-content');
            const mainContent = document.getElementById('main-content');
            const parallaxBg = document.querySelector('.parallax-bg');

            fetch('/ebooks/structured')
                .then(res => res.json())
                .then(data => {
                    data.forEach(ebook => {
                        const bookItem = document.createElement('li');
                        bookItem.innerHTML = `
                            <div class="mb-2">
                                <a href="#" class="fw-bold text-dark" data-ebook="${ebook.id}">${ebook.title}</a>
                                <ul class="ps-3 mt-2">
                                    ${ebook.chapters.map((chapter, index) => `
                                        <li><a href="#" class="text-primary chapter-link" data-ebook="${ebook.id}" data-index="${index}">${chapter.title}</a></li>
                                    `).join('')}
                                </ul>
                            </div>
                        `;
                        ebookList.appendChild(bookItem);
                    });

                    document.querySelectorAll('.chapter-link').forEach(link => {
                        link.addEventListener('click', function (e) {
                            e.preventDefault();
                            const ebookId = this.dataset.ebook;
                            const chapterIndex = this.dataset.index;
                            const ebook = data.find(e => e.id == ebookId);
                            const chapter = ebook.chapters[chapterIndex];

                            ebookTitle.textContent = ebook.title;
                            ebookSubtitle.textContent = chapter.title;
                            ebookContent.innerHTML = `<p>${chapter.content}</p>`;
                            mainContent.scrollTop = 0;
                        });
                    });
                });

            mainContent.addEventListener('scroll', () => {
                if (parallaxBg) {
                    parallaxBg.style.transform = `translateY(${mainContent.scrollTop * 0.4}px)`;
                }
            });
        });
    </script>
</x-app-layout>
