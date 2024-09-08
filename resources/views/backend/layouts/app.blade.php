<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maven Mind</title>
    <link rel="icon" href="{{ asset('assets/img/logo.svg') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    @stack('css')
</head>

<body>

    <header id="header">
        <div class="container-fluid">
            <div class="row align-items-center head-size">
                <!-- Logo Section -->
                <div class="col">
                    <a href="{{ route('home') }}" class="d-flex align-items-center">
                        <img src="{{ asset('assets/img/logo.svg') }}" alt="Logo" class="dash-logo">
                    </a>
                </div>

                <!-- Profile and Logout Section -->
                <div class="col text-end">
                    <div class="d-inline-block me-4 user-name">
                        <img src="{{ asset('assets/img/user.png') }}" class="profile-img me-2" alt="Profile Picture">
                        <span class="profile-name">{{ auth()->user() ? auth()->user()->name : 'Guest' }}</span>
                    </div>
                    <span class="bi bi-envelope-fill user-name me-3"></span>
                    <span class="bi bi-bell-fill user-name me-5"></span>

                    <a class="d-inline-block logout-icon dropdown-item me-3" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-power me-3"></i>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                </div>
            </div>
        </div>
    </header>

    <section class="navigation">
        <div class="nav-container">
            <nav>
                <div class="nav-mobile"><a id="navbar-toggle" href="#!"><span></span></a></div>
                <ul class="nav-list">
                    <li class="{{ request()->routeIs('students.index') || request()->routeIs('students.create') ? 'active' : '' }}">
                        <a href="#!" class="" style="align-items: center;">
                            <i class="bi bi-person-fill"></i>
                            <span style="margin-left: 5px;">Pre Application</span>
                        </a>
                        <ul class="navbar-dropdown">
                            <li>
                                <a href="{{ route('students.index') }}" class="{{ request()->routeIs('students.index') ? 'active' : '' }}">Student List</a>
                            </li>
                            <li>
                                <a href="{{ route('students.add') }}" class="{{ request()->routeIs('students.add') ? 'active' : '' }}">Add New Student</a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ request()->routeIs('precas.index') ? 'active' : '' }}">
                        <a href="#!" class="" style="align-items: center;">
                        <i class="bi bi-journal-richtext"></i>
                            <span style="margin-left: 5px;">Pre CAS Application</span>
                        </a>
                        <ul class="navbar-dropdown">
                            <li>
                                <a href="{{ route('precas.index') }}" class="{{ request()->routeIs('precas.index') ? 'active' : '' }}">Application List</a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ request()->routeIs('postcas.index') ? 'active' : '' }}">
                        <a href="#!" class="" style="align-items: center;">
                            <i class="bi bi-journal-richtext"></i>

                            <span style="margin-left: 5px;">Post CAS Application</span>
                        </a>
                        <ul class="navbar-dropdown">
                            <li>
                                <a href="{{ route('postcas.index') }}" class="{{ request()->routeIs('postcas.index') ? 'active' : '' }}">Application List</a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ request()->routeIs('recruitments.index') ? 'active' : '' }}">
                        <a href="#!" class="" style="align-items: center;">
                            <i class="bi bi-person-fill"></i>
                            <span style="margin-left: 5px;">Recruitment Agent</span>
                        </a>
                        <ul class="navbar-dropdown">
                            <li>
                                <a href="{{ route('recruitments.index') }}" class="{{ request()->routeIs('recruitments.index') ? 'active' : '' }}">Agent List</a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ request()->routeIs('recruitments.index') ? 'active' : '' }}">
                        <a href="#!" class="" style="align-items: center;">
                            <i class="bi bi-menu-button-wide-fill"></i>
                            <span style="margin-left: 5px;">Tasks</span>
                        </a>
                        <ul class="navbar-dropdown">
                            <li>
                                <a href="{{ route('task.index') }}" class="{{ request()->routeIs('task.index') ? 'active' : '' }}">My Tasks</a>
                            </li>
                            <li>
                                <a href="{{ route('task.index') }}" class="{{ request()->routeIs('task.index') ? 'active' : '' }}">Create Tasks</a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ request()->routeIs('user.index') || request()->routeIs('courses.index') || request()->routeIs('dependants.index') || request()->routeIs('status.index') ? 'active' : '' }}">
                        <a href="#!" class="" style="align-items: center;">
                            <i class="bi bi-list-ul"></i>
                            <span style="margin-left: 5px;">Master</span>
                        </a>
                        <ul class="navbar-dropdown">
                            <li>
                                <a href="{{ route('user.index') }}" class="{{ request()->routeIs('user.index') ? 'active' : '' }}">Users</a>
                            </li>
                            <li>
                                <a href="{{ route('courses.index') }}" class="{{ request()->routeIs('courses.index') ? 'active' : '' }}">Courses</a>
                            </li>
                            <li>
                                <a href="{{ route('dependants.index') }}" class="{{ request()->routeIs('dependants.index') ? 'active' : '' }}">Dependants</a>
                            </li>
                            <li>
                                <a href="{{ route('status.index') }}" class="{{ request()->routeIs('status.index') ? 'active' : '' }}">Status</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#!" class="" style="align-items: center;">
                            <i class="bi bi-list-ul"></i>
                            <span style="margin-left: 5px;">Reports</span>
                        </a>
                        <ul class="navbar-dropdown">
                            <li>
                                <a href="#!">Student Report</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </section>


    @yield('content')

    <script>
        function toggleFilters() {
            const collapsibleFilters = document.getElementById('collapsible-filters');
            const toggleButton = document.querySelector('.toggle-button');
            if (collapsibleFilters.classList.contains('hidden')) {
                collapsibleFilters.classList.remove('hidden');
                toggleButton.textContent = '-';
            } else {
                collapsibleFilters.classList.add('hidden');
                toggleButton.textContent = '+';
            }
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    @stack('js')
</body>

</html>
