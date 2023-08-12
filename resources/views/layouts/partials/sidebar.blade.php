<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex flex-column justify-content-start align-items-stretch gap-2">
                <h4>{{ Auth::user()->nama }}</h4>
                <h6 class="text-secondary"><i class="bi bi-key me-2"></i> {{ Auth::user()->role }}</h6>
                <div class="theme-toggle d-flex gap-2 align-items-center">

                    <div class="form-check form-switch fs-6" style="display: none;">
                        <input class="form-check-input  me-0" type="checkbox" id="toggle-dark">
                        <label class="form-check-label"></label>
                    </div>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>



                @switch(Auth::user()->role)
                @case('admin')
                <li class="sidebar-item {{ Request::is('/') ? 'active' : '' }} ">
                    <a href="{{ route('index') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::is('transactions') ? 'active' : '' }} ">
                    <a href="{{ route('transactions.index') }}" class='sidebar-link'>
                        <i class="bi bi-basket3-fill"></i>
                        <span>Daftar Pendaftar Course</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::is('/instructor*') ? 'active' : '' }} ">
                    <a href="{{ route('instructor.index') }}" class='sidebar-link'>
                        <i class="bi bi-person-fill"></i>
                        <span>Instructor</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::is('/course*') ? 'active' : '' }} ">
                    <a href="{{ route('course.index') }}" class='sidebar-link'>
                        <i class="bi bi-book-fill"></i>
                        <span>Course</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::is('/qualification*') ? 'active' : '' }} ">
                    <a href="{{ route('qualification.index') }}" class='sidebar-link'>
                        <i class="bi bi-book-fill"></i>
                        <span>Qualification</span>
                    </a>
                </li>
                @break

                @case('user')
                <li class="sidebar-item {{ Request::is('users*') ? 'active' : '' }} ">
                <li class="sidebar-item {{ Request::is('transactions') ? 'active' : '' }} ">
                    <a href="{{ route('transactions.index') }}" class='sidebar-link'>
                        <i class="bi bi-basket3-fill"></i>
                        <span>Daftar Course Terdaftar</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::is('/course*') ? 'active' : '' }} ">
                    <a href="{{ route('course.index') }}" class='sidebar-link'>
                        <i class="bi bi-book-fill"></i>
                        <span>Course</span>
                    </a>
                </li>
                @break
                @endswitch
                <li class="sidebar-item ">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class='border-0 w-100 text-danger icon icon-left sidebar-link '>
                            <i class="bi bi-box-arrow-left text-danger"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </li>

            </ul>
        </div>
    </div>
</div>