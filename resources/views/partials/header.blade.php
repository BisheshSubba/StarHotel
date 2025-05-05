<header class="head">
    <div class="logo">
        <a href="{{ route('account.home') }}"><img src="{{ asset('images/Elevate.jpg') }}" alt="Logo"></a>
    </div>

    <div class="hamburger-menu">
        <input type="checkbox" id="menu-toggle">
        <label for="menu-toggle" class="menu-icon">
            <div class="nav-icon"></div>
            <div class="nav-icon"></div>
            <div class="nav-icon"></div>
        </label>

        <div class="menus">
            <a href="{{ route('account.room') }}" class="menu">ROOMS</a>
            <a href="{{ route('services') }}" class="menu">SERVICES</a>
            <a href="{{ route('gallery') }}" class="menu">GALLERY</a>
            <a href="{{ route('abouts') }}" class="menu">ABOUT US</a>

            <a class="menu" href="#" id="currencyDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                CURRENCY
            </a>
            <ul class="dropdown-menu border-0 shadow bsb-zoomIn" aria-labelledby="currencyDropdown">
                <li><a class="dropdown-item" href="{{ route('set-currency', 'NPR') }}">NPR</a></li>
                <li><a class="dropdown-item" href="{{ route('set-currency', 'USD') }}">USD</a></li>
            </ul>

            @guest
            <a href="{{ route('account.login') }}" class="menu">LOGIN</a>
            @endguest

            @auth
            <a class="menu" href="#!" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                PROFILE
            </a>
            <ul class="dropdown-menu border-0 shadow bsb-zoomIn" aria-labelledby="accountDropdown">
                <li>
                    <a class="dropdown-item" href="{{ route('profileshow') }}">Hello, {{ Auth::user()->name }}</a>
                    <a class="dropdown-item" href="{{ route('user.booking', Auth::user()->name) }}">BOOKING</a>
                    <a class="dropdown-item" href="{{ route('account.logout') }}">LOGOUT</a>
                </li>
            </ul>
            @endauth
        </div>
    </div>
</header>
<script>
let lastScrollTop = 0; 
const header = document.querySelector('.head');

window.addEventListener('scroll', function() {
    let currentScroll = window.pageYOffset || document.documentElement.scrollTop;

    if (currentScroll > lastScrollTop) {
        header.classList.add('hidden');
    } else {
        header.classList.remove('hidden');
    }
    lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
});

</script>