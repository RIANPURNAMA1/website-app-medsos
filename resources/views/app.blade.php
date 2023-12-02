<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Medsos App</title>
    <!-- Tautan CDN untuk Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    {{-- font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;600;700&family=Roboto:ital,wght@0,100;0,300;0,400;0,700;1,100;1,300;1,500&display=swap"
        rel="stylesheet">
    {{-- css --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    {{-- boostrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div>
        <nav class="navbar navbar-expand-lg ">
            <div class="container">
                <a class="navbar-brand" href="/">Ms Apps</a>
                {{-- button  --}}
                <button class="navbar-toggler nav-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class=""><i class="bi bi-list text-light fs-1"></i></span>
                 </button>
            {{-- button  --}}
                {{-- profile --}}
                <div class="profile-image-container-nav">
                    @if (Auth::user()->image)
                        <img src="{{ asset('uploads/' . Auth::user()->image) }}"
                            alt="Gambar Profil" class=" nav-link image-profile img-thumbnail rounded-circle nav-item" style="width: 50px; height:50px;">
                    @else
                        <!-- Tampilkan gambar default jika pengguna tidak memiliki gambar profil -->
                        <img src="https://lh3.googleusercontent.com/proxy/esjjzRYoXlhgNYXqU8Gf_3lu6V-eONTnymkLzdwQ6F6z0MWAqIwIpqgq_lk4caRIZF_0Uqb5U8NWNrJcaeTuCjp7xZlpL48JDx-qzAXSTh00AVVqBoT7MJ0259pik9mnQ1LldFLfHZUGDGY=w1200-h630-p-k-no-nu" class="rounded-circle" alt="" style="width: 50px; height:50px;">

                        @endif
                    </div>
                    {{-- profile --}}
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <form class="d-flex search nav-link" action="/post/search" role="search" method="GET">
                                @csrf
                                <button class="btn btn-search" type="submit">Search</button>
                                <input class="form-control ms-2" type="search" placeholder="Search" name="search" aria-label="Search">
                            </form>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{Request::is('post') ? 'active' : ''}}" href="/post">Postingan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{Request::is('/') ? 'active' : ''}}" aria-current="page" href="/">Beranda</a>
                        </li>
                        <li class="nav-item dropdown d-flex">
                            <div class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <a>
                                    {{ Auth::user()->name }}
                                </a>
                            </div>
                            {{-- profile image --}}
                            <div class="profile-image-container">
                                @if (Auth::user()->image)
                                    <img src="{{ asset('uploads/' . Auth::user()->image) }}"
                                        alt="Gambar Profil" class=" nav-link image-profile img-thumbnail rounded-circle nav-item" style="width: 50px; height:50px;">
                                @else
                                    <!-- Tampilkan gambar default jika pengguna tidak memiliki gambar profil -->
                                    <img src="https://lh3.googleusercontent.com/proxy/esjjzRYoXlhgNYXqU8Gf_3lu6V-eONTnymkLzdwQ6F6z0MWAqIwIpqgq_lk4caRIZF_0Uqb5U8NWNrJcaeTuCjp7xZlpL48JDx-qzAXSTh00AVVqBoT7MJ0259pik9mnQ1LldFLfHZUGDGY=w1200-h630-p-k-no-nu" class="rounded-circle" alt="" style="width: 50px; height:50px;">

                                @endif
                            </div>

                            <ul class="dropdown-menu">
                                @auth
                                    <li><a class="dropdown-item" href="/logout">Logout</a></li>
                                    <li><a class="dropdown-item" href="/post/update-setting/{{Auth::user()->id}}">Setting Profile</a></li>
                                @endauth
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        {{-- navbar --}}
        {{-- navbar --}}

        {{-- isi --}}
        <div class="container body-app">
            @yield('app')
        </div>
        {{-- isi --}}
    </div>
    <!-- Footer -->
    <div class="">
        <footer class="footer  text-center">
            <div class="container">
                <span class="text-footer">-- &copy; 2023 Rian Purnama Dev. All rights reserved -- </span>
            </div>
        </footer>
    </div>
    <!-- End Footer -->
    <!-- Add this script tag to your HTML file -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var imageContainers = document.querySelectorAll(".image-container");
            var previewOverlay = document.querySelector(".preview-overlay");

            imageContainers.forEach(function (container) {
                container.addEventListener("click", function () {
                    // Clone the clicked image and append it to the overlay
                    var clonedImage = container.querySelector(".preview-image").cloneNode(true);
                    previewOverlay.innerHTML = ""; // Clear previous content
                    previewOverlay.appendChild(clonedImage);
                    previewOverlay.style.display = "flex";
                });
            });

            previewOverlay.addEventListener("click", function () {
                // Hide the overlay when clicked outside the image
                previewOverlay.style.display = "none";
            });
        });

        var imageBeranda = document.querySelector('.image-beranda');
        var imageBerandaPref = document.querySelector('.image-beranda-pref');
        var cardImagePref = document.querySelector('.card-image-pref');
        imageBeranda.addEventListener('click', function(){
        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
