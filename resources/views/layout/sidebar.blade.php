<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
        <!-- nav bar -->
        <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="/">
                <img height="40" width="40" src="{{ asset('/assets/images/logo.png') }}">
            </a>
        </div>

        <p class="text-muted nav-heading mt-4 mb-1">
            <span>Portal</span>
        </p>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('order.index') }}">
                    <i class="fe fe-user fe-16"></i>
                    <span class="ml-3 item-text">Order</span>
                </a>
            </li>
        </ul>
        @if(Auth::user()->role == 'admin')
        <p class="text-muted nav-heading mt-4 mb-1">
            <span>Administrator</span>
        </p>

        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('master.index') }}">
                    <i class="fe fe-book-open fe-16"></i>
                    <span class="ml-3 item-text">Master Parameter</span>
                </a>
            </li>
        </ul>
        @endif

    </nav>
</aside>
