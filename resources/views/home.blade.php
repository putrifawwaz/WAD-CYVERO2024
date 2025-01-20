@extends('layouts.app')

@section('content')
    <div class="overflow-hidden bg-white py-6 sm:py-6 mt-20">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div id="welcome-carousel" class="relative" data-carousel="static">
                <!-- Slide 1 -->
                <div class="block duration-700 ease-in-out" data-carousel-item>
                    <div class="mx-auto grid max-w-7xl grid-cols-1 gap-x-8 gap-y-16 sm:gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-2">
                        <div class="lg:pr-8 lg:pt-4">
                            <div class="lg:max-w-lg">
                                <h2 class="text-base font-bold leading-7 text-indigo-600 text-blue-600">Get to Know</h2>
                                <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">CYVERO HMSI!</p>
                                <p class="mt-6 text-lg leading-8 text-gray-600 mb-5">CYVERO (Cyan’s Event Project) memiliki tujuan untuk menjalin, menjaga, dan mempertahankan
                                    silaturahmi antar mahasiswa/i Program Studi S1 Sistem Informasi. Rangkaian CYVERO mencakup berbagai perlombaan, baik perlombaan akademik maupun non-akademik.
                                    Tujuannya agar mahasiswa/i tidak hanya berfokus pada bidang akademik, tetapi juga aktif dalam bidang non-akademik.</p>
                            </div>
                        </div>
                        <img src="{{ asset('photos/dashboard1.png') }}" alt="Dashboard-3" class="w-[550px] h-[550px] rounded-xl shadow-xl ring-1 ring-gray-400/10 object-cover">
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <div class="mx-auto grid max-w-7xl grid-cols-1 lg:grid-cols-2 gap-x-8 gap-y-16 sm:gap-y-20">
                        <!-- Image Section -->
                        <div class="flex justify-end">
                            <img src="{{ asset('photos/dashboard2.png') }}" alt="Dashboard-2"
                                 class="w-[550px] h-[550px] rounded-xl shadow-xl ring-1 ring-gray-400/10 object-cover">
                        </div>
                        <!-- Text Section -->
                        <div class="lg:max-w-lg">
                            <h2 class="text-base font-bold leading-7 text-indigo-600 text-blue-600">Who's Behind</h2>
                            <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">CYVERO?</p>
                            <p class="mt-6 text-lg leading-8 text-gray-600 mb-5">
                                CYVERO adalah sebuah inisiatif yang diinisiasi oleh Departemen Kemahasiswaan Himpunan Mahasiswa Sistem Informasi (HMSI).
                                Inisiatif ini hadir untuk menggabungkan dua program kerja yang sudah ada sebelumnya, yaitu INSYL dan SIFEST.
                                Dengan menggabungkan kedua program kerja ini, CYVERO diharapkan dapat membantu mahasiswa/i menemukan minat dan bakat mereka masing-masing
                                serta mempererat hubungan dan kebersamaan di antara mereka.</p>
                        </div>
                    </div>
                 </div>

                <!-- Carousel Indicators -->
                <div class="absolute bottom-5 left-1/2 z-30 flex -translate-x-1/2 space-x-3 mt-20">
                    <button type="button" class="w-3 h-3 rounded-full bg-blue-200" aria-current="true" data-carousel-slide-to="0"></button>
                    <button type="button" class="w-3 h-3 rounded-full bg-blue-200" aria-current="false" data-carousel-slide-to="1"></button>
                </div>

                <script>
                document.addEventListener("DOMContentLoaded", function () {
                    const carousel = document.querySelector("#welcome-carousel");
                    const items = carousel.querySelectorAll("[data-carousel-item]");
                    const indicators = carousel.querySelectorAll("[data-carousel-slide-to]");
                    let currentIndex = 0;
                    const totalSlides = items.length;

                    function showSlide(index) {
                        items.forEach((item, idx) => {
                            if (idx === index) {
                                item.classList.remove("hidden");
                            } else {
                                item.classList.add("hidden");
                            }
                        });

                        indicators.forEach((indicator, idx) => {
                            if (idx === index) {
                                indicator.classList.add("bg-blue-600");
                                indicator.setAttribute("aria-current", "true");
                            } else {
                                indicator.classList.remove("bg-blue-600");
                                indicator.setAttribute("aria-current", "false");
                            }
                        });
                    }

                    function nextSlide() {
                        currentIndex = (currentIndex + 1) % totalSlides;
                        showSlide(currentIndex);
                    }

                    function prevSlide() {
                        currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
                        showSlide(currentIndex);
                    }

                    // Initial setup
                    showSlide(currentIndex);

                    setInterval(nextSlide, 4000);

                    indicators.forEach((indicator, index) => {
                        indicator.addEventListener("click", () => {
                            currentIndex = index;
                            showSlide(currentIndex);
                        });
                    });
                });
                </script>
            </div>
        </div>

        <div class="overflow-hidden bg-white py-10 sm:py-12">

            <p class="text-3xl font-semibold tracking-tight text-blue-700 sm:text-4xl text-center mt-10 mb-10">Rangkaian CYVERO 2024</p>

            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                    <div class="w-full p-6 bg-blue-200 bg-opacity-5 rounded-lg shadow-md transform transition duration-500 hover:scale-105 opacity-0 translate-y-10 scroll-animate">
                        <h3 class="text-lg text-center font-semibold text-blue-700">ELVERO</h3>
                        <p class="mt-2 text-center text-gray-600">Elevate Event of CYVERO (ELVERO) adalah acara yang secara resmi menandai pembukaan rangkaian kegiatan CYVERO. ELVERO tidak hanya menjadi momen seremonial pembukaan, tetapi juga menjadi ajang untuk membangun semangat dan partisipasi bagi para peserta.</p>
                    </div>

                    <div class="w-full p-6 bg-blue-200 bg-opacity-5 rounded-lg shadow-md transform transition duration-500 hover:scale-105 opacity-0 translate-y-10 scroll-animate">
                        <h3 class="text-lg text-center font-semibold text-blue-700">STOVERO</h3>
                        <p class="mt-2 text-center text-gray-600">Sport Tournament of CYVERO (STOVERO) merupakan wadah bagi mahasiswa/i S1 Sistem Informasi  untuk menyalurkan minat dan bakat di bidang olahraga dan e-sports. Kegiatan ini bertujuan membangun solidaritas dan meningkatkan semangat sportivitas.</p>
                    </div>

                    <div class="w-full p-6 bg-blue-200 bg-opacity-5 rounded-lg shadow-md transform transition duration-500 hover:scale-105 opacity-0 translate-y-10 scroll-animate">
                        <h3 class="text-lg text-center font-semibold text-blue-700">MUSCOVERO</h3>
                        <p class="mt-2 text-center text-gray-600">Music Contest of CYVERO (MUSCOVERO) merupakan wadah bagi mahasiswa/i S1 Sistem Infromasi untuk mengekspresikan dan mengembangkan minat serta bakat mereka di bidang yang diselenggarakan dalam format perlombaan audisi.</p>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-6">

                <div class="col-span-1 flex justify-end">
                    <div class="w-2/3 p-6 bg-blue-200 bg-opacity-5 rounded-lg shadow-md transform transition duration-500 hover:scale-105 opacity-0 translate-y-10 scroll-animate">
                        <h3 class="text-lg text-center font-semibold text-blue-700">ACAVERO</h3>
                        <p class="mt-2 text-center text-gray-600">Academic Competition of CYVERO (ACAVERO) merupakan program kolaborasi antara CYVERO dengan Laboratorium S1 Sistem Informasi dengan tujuan menyediakan wadah bagi pelajar dan mahasiswa nasional untuk meningkatkan potensi mereka di bidang akademik. </p>
                    </div>
                </div>

                <div class="col-span-1 flex justify-start">
                    <div class="w-2/3 p-6 bg-blue-200 bg-opacity-5 rounded-lg shadow-md transform transition duration-500 hover:scale-105 opacity-0 translate-y-10 scroll-animate">
                        <h3 class="text-lg text-center font-semibold text-blue-700">FIDOVERO</h3>
                        <p class="mt-2 text-center text-gray-600">Final Day of CYVERO (FIDOVERO) diselenggarakan sebagai acara penutup yang memberikan simbolisasi berakhirnya rangkaian kegiatan CYVERO. Acara ini merupakan malam perayaan dan penghargaan kepada para peserta, pemenang, serta panitia yang telah berkontribusi.</p>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const scrollElements = document.querySelectorAll(".scroll-animate");

                const elementInView = (el, dividend = 1) => {
                    const elementTop = el.getBoundingClientRect().top;
                    return elementTop <= (window.innerHeight || document.documentElement.clientHeight) / dividend;
                };

                const displayScrollElement = (element) => {
                    element.classList.add("opacity-100", "translate-y-0");
                    element.classList.remove("opacity-0", "translate-y-10");
                };

                const handleScrollAnimation = () => {
                    scrollElements.forEach((el) => {
                        if (elementInView(el, 1.25)) {
                            displayScrollElement(el);
                        }
                    });
                };

                window.addEventListener("scroll", handleScrollAnimation);
            });
        </script>

        <div class="relative overflow-hidden ">
            <p class="text-3xl font-semibold tracking-tight text-blue-700 sm:text-4xl text-center mt-10 mb-10">Take a Look at CYVERO 2024</p>
                <div class="flex items-center">
                    <div id="gallery" class="flex space-x-4 overflow-hidden transition-transform duration-500 ease-in-out">
                        <img src="{{ asset('photos/D1.jpg') }}" alt="Image 1" class="w-[290px] h-[290px] object-cover aspect-square rounded-lg shadow-lg">
                        <img src="{{ asset('photos/D2.jpg') }}" alt="Image 2" class="w-[290px] h-[290px] object-cover aspect-square rounded-lg shadow-lg">
                        <img src="{{ asset('photos/D3.jpg') }}" alt="Image 3" class="w-[290px] h-[290px] object-cover aspect-square rounded-lg shadow-lg">
                        <img src="{{ asset('photos/D4.jpg') }}" alt="Image 4" class="w-[290px] h-[290px] object-cover aspect-square rounded-lg shadow-lg">
                    </div>
                <!-- Previous Button -->
                <button id="prevButton" class="absolute mt-12 left-2 top-1/2 transform -translate-y-1/2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-2 rounded-full"> &lt; </button>
                <!-- Next Button -->
                <button id="nextButton" class="absolute mt-12 right-2 top-1/2 transform -translate-y-1/2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-2 rounded-full"> &gt; </button>
            </div>
        </div>

        <script>
            const images = [
                [
                    "{{ asset('photos/D1.jpg') }}",
                    "{{ asset('photos/D2.jpg') }}",
                    "{{ asset('photos/D3.jpg') }}",
                    "{{ asset('photos/D4.jpg') }}"
                ],
                [
                    "{{ asset('photos/D5.jpg') }}",
                    "{{ asset('photos/D6.jpg') }}",
                    "{{ asset('photos/D7.jpg') }}",
                    "{{ asset('photos/D8.jpg') }}"
                ]
            ];

            let currentIndex = 0;

            document.getElementById('nextButton').addEventListener('click', function() {
                currentIndex = (currentIndex + 1) % images.length;
                updateGallery();
            });

            document.getElementById('prevButton').addEventListener('click', function() {
                currentIndex = (currentIndex - 1 + images.length) % images.length;
                updateGallery();
            });

            function updateGallery() {
                const gallery = document.getElementById('gallery');
                gallery.innerHTML = ''; // Clear current images

                images[currentIndex].forEach(src => {
                    const img = document.createElement('img');
                    img.src = src;
                    img.alt = 'Gallery Image';
                    img.className = 'w-[300px] h-[300px] object-cover aspect-square rounded-lg shadow-lg';
                    gallery.appendChild(img);
                });
            }
        </script>
    </div>
@endsection

    {{-- <div class="bg-blue-600 footer py-4">
        <div class="max-w-7xl mx-auto px-6 flex flex-col sm:flex-row justify-between items-center text-white">
            <div class="flex items-center space-x-4">
                <a href="https://www.instagram.com/cyverohmsi" target="_blank" class="flex items-center">
                    <span>Instagram: @cyverohmsi</span>
                    <svg class="w-6 h-6 text-white ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path fill="currentColor" fill-rule="evenodd" d="M3 8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8Zm5-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8Zm7.597 2.214a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2h-.01a1 1 0 0 1-1-1ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-5 3a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z" clip-rule="evenodd"/>
                    </svg>
                </a>
                <a href="https://www.instagram.com/depart.kamsis" target="_blank" class="flex items-center">
                    <span>Instagram: @depart.kamsis</span>
                    <svg class="w-6 h-6 text-white ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path fill="currentColor" fill-rule="evenodd" d="M3 8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8Zm5-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8Zm7.597 2.214a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2h-.01a1 1 0 0 1-1-1ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-5 3a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z" clip-rule="evenodd"/>
                    </svg>
                </a>
            </div>
            <div class="flex items-center space-x-4 mt-4 sm:mt-0">
                <a href="mailto:hi.cyvero@gmail.com" class="flex items-center">
                    <span>Email: hi.cyvero@gmail.com</span>
                    <svg class="w-6 h-6 text-white ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16v-5.5A3.5 3.5 0 0 0 7.5 7m3.5 9H4v-5.5A3.5 3.5 0 0 1 7.5 7m3.5 9v4M7.5 7H14m0 0V4h2.5M14 7v3m-3.5 6H20v-6a3 3 0 0 0-3-3m-2 9v4m-8-6.5h1"/>
                    </svg>
                </a>
                <a href="mailto:kamsishmsi2023@gmail.com" class="flex items-center">
                    <span>Email: kamsishmsi2023@gmail.com</span>
                    <svg class="w-6 h-6 text-white ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16v-5.5A3.5 3.5 0 0 0 7.5 7m3.5 9H4v-5.5A3.5 3.5 0 0 1 7.5 7m3.5 9v4M7.5 7H14m0 0V4h2.5M14 7v3m-3.5 6H20v-6a3 3 0 0 0-3-3m-2 9v4m-8-6.5h1"/>
                    </svg>
                </a>
            </div>
        </div>
    </div> --}}
