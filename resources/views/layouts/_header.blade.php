<html>
<style>
    .fixed-topbar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 9999;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .navbar-transparent {
        background-color: transparent;
        box-shadow: none;
    }

    .navbar-solid {
        background-color: #FAFAF6;
        box-shadow: 0 2px 40px rgba(107, 114, 158, 1);
    }

    span {
        color: #7690C3;
    }

    nav ul li {
        display: inline-block;
        padding-bottom: 0px;
        border-bottom: 3px solid transparent; /* supaya semua item punya tinggi sama */
    }

    nav ul li.active {
        font-weight: bold;
        border-bottom-color: #7690C3; /* hanya ubah warna border saat aktif */
        color: #7690C3;
    }
</style>
</html>

<nav id="mainNavbar"
    class="flex items-center text-lg fixed-topbar navbar-transparent p-4">
    <a class="flex items-center ml-8 mr-auto" href="/">
        <div class="mr-3">
            <img src="{{ asset('/logo.png') }}" alt="Koemis" width="65em">
        </div>
    </a>

    <ul class="flex mx-auto">
        <li class="mx-10 {{ request()->routeIs('landing.*') ? 'active' : '' }}">
            <a href="{{ route('landing.index') }}">
                <i class="fas fa-home mr-1" style="color: #7690C3;"></i>
                <span>Home</span>
            </a>
        </li>

        <li class="mx-10 {{ request()->routeIs('blog.*') ? 'active' : '' }}">
            <a href="{{ route('blog.index') }}">
                <i class="fa-solid fa-book-open-reader mr-1" style="color: #7690C3;"></i>
                <span>Blog</span>
            </a>
        </li>

        <li class="mx-10 {{ request()->routeIs('project.*') ? 'active' : '' }}">
            <a href="{{ route('project.index') }}">
                <i class="fa-solid fa-diagram-project mr-1" style="color: #7690C3;"></i>
                <span>Project</span>
            </a>
        </li>

        <li class="mx-10 {{ request()->routeIs('member.*') ? 'active' : '' }}">
            <a href="{{ route('member.index') }}">
                <i class="fa-solid fa-user-group mr-1" style="color: #7690C3;"></i>
                <span>Member</span>
            </a>
        </li>
    </ul>

    <a class="flex items-center ml-auto mr-8" href="{{ url(config('filament.path') ?? 'admin') }}" target="_blank">
        <span>Login</span>
        <i class="fa-solid fa-user ml-2" style="color: #7690C3;"></i>
    </a>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const navbar = document.getElementById("mainNavbar");

        function updateNavbar() {
            if (window.scrollY > 0) {
                navbar.classList.remove("navbar-transparent");
                navbar.classList.add("navbar-solid");
            } else {
                navbar.classList.remove("navbar-solid");
                navbar.classList.add("navbar-transparent");
            }
        }

        // Cek saat load
        updateNavbar();

        // Cek saat scroll
        window.addEventListener("scroll", updateNavbar);
    });
</script>
