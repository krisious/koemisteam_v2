<html>
    <style>
        /* Fix the sidebar position */
        .fixed-topbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 9999;
        }

        span {
            color: #7690C3;
        }
        .active {
            display: inline-block;
            font-weight: bold;
            border-bottom: 3px solid #7690C3;
            color: #7690C3;
            padding-bottom: 15px;
        }
        
    </style>
</html>

<nav class="flex items-center text-lg fixed-topbar bg-[#FAFAF6] p-4 drop-shadow-[0_2px_40px_rgba(107,114,158,1)]">
    <a class="flex items-center ml-8 mr-auto" href="/">
        <div class="mr-3">
            <img src="{{ asset('/logo.png') }}" alt="Koemis" width="65em">
        </div>
    </a>
        
    <ul class="flex mx-auto">
        <li class="mx-10 {{ request()->routeIs('landing.*') ? 'active' : '' }} hover:border-b-3 border-[#7690C3] rounded px-2 py-1 transition-colors duration-200">
            <a href="{{ route('landing.index') }}">
                <i class="fas fa-home mr-1" style="color: #7690C3;"></i>
                <span>Home</span>
            </a>
        </li>
        
        <li class="mx-10 {{ request()->routeIs('blog.*') ? 'active' : '' }} hover:border-b-3 border-[#7690C3] rounded px-2 py-1 transition-colors duration-200">
            <a href="{{ route('blog.index') }}">
                <i class="fa-solid fa-book-open-reader mr-1" style="color: #7690C3;"></i>
                <span>Blog</span>
            </a>
        </li>

        <li class="mx-10 {{ request()->routeIs('project.*') ? 'active' : '' }} hover:border-b-3 border-[#7690C3] rounded px-2 py-1 transition-colors duration-200">
            <a href="{{ route('project.index') }}">
                <i class="fa-solid fa-diagram-project mr-1" style="color: #7690C3;"></i>
                <span>Project</span>
            </a>
        </li>

        <li class="mx-10 {{ request()->routeIs('member.*') ? 'active' : '' }} hover:border-b-3 border-[#7690C3] rounded px-2 py-1 transition-colors duration-200">
            <a href="{{ route('member.index') }}">
                <i class="fa-solid fa-user-group mr-1" style="color: #7690C3;"></i>
                <span>Member</span>
            </a>
        </li>
    </ul>

    <a class="flex items-center ml-auto mr-8" href="/">
        <span>Login</span>
        <i class="fa-solid fa-user ml-2" style="color: #7690C3;"></i>
    </a>

</nav>
