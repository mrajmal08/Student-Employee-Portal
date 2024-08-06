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
            <div class="header-flex">
                <div class="header-hold">
                    <a href="{{ route('home') }}" class="logo">
                        <img src="{{ asset('assets/img/img.png') }}">
                    </a>
                </div>

                <div class="profile">
                    <img src="{{ asset('assets/img/user.png') }}" class="profile-img" alt="Profile Picture">
                    <span class="profile-name">SuperAdmin</span>
                </div>

                <div class="nav-icon">
                    <i class="bi bi-power  ms-5 my-5"></i>
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
                        <a href="#!">Students</a>
                        <ul class="navbar-dropdown">
                            <li>
                                <a href="{{ route('students.index') }}">Student List</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#!">Recruitment Agent</a>
                        <ul class="navbar-dropdown">
                            <li>
                                <a href="#!">Agent List</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#!">Pre Application</a>
                        <ul class="navbar-dropdown">
                            <li>
                                <a href="#!">Application List</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#!">Master</a>
                        <ul class="navbar-dropdown">
                            <li>
                                <a href="#!">Users</a>
                            </li>
                            <li>
                                <a href="{{ route('courses.index') }}">Courses</a>
                            </li>
                            <li>
                                <a href="#!">User Roles</a>
                            </li>
                            <li>
                                <a href="#!">Dependants</a>
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


