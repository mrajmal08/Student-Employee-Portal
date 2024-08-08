@extends('backend.layouts.app')
@push('css')
@endpush
@section('content')
    <section class="filters">
       <div class="main">
        <div class="main-container">
        <div class="container-fluid">
            <h1 class="page-head my-4">Dashboard</h1>

            <div class="container">
                <div class="row">
                    <div class="col-12 ps-lg-5 pe-lg-5">
                        <div class="row justify-content-center" matchHeight="card">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="card statsTour">
                                    <div class=" dashboard text-center demo-title">
                                        <h1>Few Stats</h1>
                                    </div>
                                    <div class="card-body ">
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <span class="badge bg-primary">25133</span>
                                                <a href="#">Students</a>
                                            </li>
                                            <li class="list-group-item">
                                                <span class="badge bg-success">1840</span>
                                                <a href="#">Recruitment Agent</a>
                                            </li>
                                            <li class="list-group-item">
                                                <span class="badge bg-info">0</span>
                                                <a href="#">Pre Applications</a>
                                            </li>
                                            <li class="list-group-item">
                                                <span class="badge bg-warning">21330</span>
                                                <a href="#">Cases in Process</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="card emailTour">
                                    <div class=" dashboard text-center">
                                        <h1>Emails</h1>
                                    </div>
                                    <div class="card-body tour-middle-content">
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <span class="badge bg-primary float-end">0</span>
                                                <a href="#">Total Emails</a>
                                            </li>
                                            <li class="list-group-item">
                                                <span class="badge bg-info float-end">0</span>
                                                <a href="#"> Read Emails</a>
                                            </li>
                                            <li class="list-group-item">
                                                <span class="badge bg-warning float-end">0</span>
                                                <a href="#">Unread Emails</a>
                                            </li>
                                            <li class="list-group-item">
                                                <span class="badge bg-success float-end">0</span>
                                                <a href="#">Sent Emails</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 align-self-center">
                                <div class="card userTour">
                                    <div class="dashboard text-center">
                                        <h1>Users</h1>
                                    </div>
                                    <div class="card-body tour-scroll">
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <span class="badge bg-primary float-end">276</span>
                                                <a href="#">No. of Students</a>
                                            </li>
                                            <li class="list-group-item">
                                                <span class="badge bg-info float-end">20</span>
                                                <a href="#">Admin</a>
                                            </li>
                                            <li class="list-group-item">
                                                <span class="badge bg-warning float-end">83</span>
                                                <a href="#">User Roles</a>
                                            </li>
                                            <li class="list-group-item">
                                                <span class="badge bg-success float-end">0</span>
                                                <a href="#">Courses</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        </div>
       </div>
        <!-- <hr class="line-bottom"> -->
        <div class="footer">

        </div>
    </section>

    <script>
        (function($) {
            $(function() {

                //  open and close nav
                $('#navbar-toggle').click(function() {
                    $('nav ul').slideToggle();
                });


                // Hamburger toggle
                $('#navbar-toggle').on('click', function() {
                    this.classList.toggle('active');
                });


                // If a link has a dropdown, add sub menu toggle.
                $('nav ul li a:not(:only-child)').click(function(e) {
                    $(this).siblings('.navbar-dropdown').slideToggle("slow");

                    // Close dropdown when select another dropdown
                    $('.navbar-dropdown').not($(this).siblings()).hide("slow");
                    e.stopPropagation();
                });


                // Click outside the dropdown will remove the dropdown class
                $('html').click(function() {
                    $('.navbar-dropdown').hide();
                });
            });
        })(jQuery);
    </script>

@push('js')
@endpush
@endsection
