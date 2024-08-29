<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filterable Div-Based Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    @stack('css')
</head>

<body>

    <header id="header">
        <div class="container-fluid">
            <div class="row align-items-center">
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
                    <a class="d-inline-block logout-icon dropdown-item me-2" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-power"></i>
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
                    <li>
                        <a href="#!">Pre Application</a>
                        <ul class="navbar-dropdown">
                            <li>
                                <a href="{{ route('students.index') }}">Student List</a>
                            </li>
                            <li>
                                <a href="{{ route('students.create') }}">Add New Student</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#!">Pre CAS Application</a>
                        <ul class="navbar-dropdown">
                            <li>
                                <a href="{{ route('precas.index') }}">Application List</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#!">Post CAS Application</a>
                        <ul class="navbar-dropdown">
                            <li>
                                <a href="{{ route('postcas.index') }}">Application List</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#!">Recruitment Agent</a>
                        <ul class="navbar-dropdown">
                            <li>
                                <a href="{{ route('recruitments.index') }}">Agent List</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#!">Master</a>
                        <ul class="navbar-dropdown">
                            <li>
                                <a href="{{ route('user.index') }}">Users</a>
                            </li>
                            <li>
                                <a href="{{ route('courses.index') }}">Courses</a>
                            </li>
                            <li>
                                <a href="{{ route('dependants.index') }}">Dependants</a>
                            </li>
                            <li>
                                <a href="{{ route('status.index') }}">Status</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#!">Reports</a>
                        <ul class="navbar-dropdown">
                            <li>
                                <a href="#!">Student Report</a>
                            </li>
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
