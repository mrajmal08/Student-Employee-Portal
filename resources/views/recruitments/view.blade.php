@extends('backend.layouts.app')
@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" />

@endpush
@section('content')
<section class="filters">
    <div class="main">
        <div class="main-container">
            <div id="main" class="my-4">
                <div class="my-3 ms-3">
                    <breadcrumb>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a role="button">Student</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a role="button">View</a>
                            <li class="breadcrumb-item">
                                <span>123</span>
                            </li>
                        </ul>
                    </breadcrumb>
                </div>
                <div class="my-3 ms-3 ">
                    <h4 class="student-detail">Student Name (23 year | 08/26/2000 | Male)</h4>
                </div>
                <div class="container-fluid datatable">
                    <table class="table table-borderless table-striped">
                        <tbody>
                            <tr>
                                <th scope="row">Email:</th>
                                <td>mark@gmail.com</td>
                                <th>Nationality:</th>
                                <td>Pakistan</td>
                                <th>Preferred Contact Number:</th>
                                <td>92304957473</td>
                            </tr>
                            <tr>
                                <th scope="row">Passport:</th>
                                <td>Pakistan</td>
                                <th>Course:</th>
                                <td>English, Math</td>
                                <th>Previous CAS:</th>
                                <td>test</td>
                            </tr>
                            <tr>
                                <th scope="row">Dependant:</th>
                                <td>Larry</td>
                                <th>Intake:</th>
                                <td>January</td>
                                <th>Address:</th>
                                <td>lahore airport road, deline garden</td>
                            </tr>
                            <tr>
                                <th scope="row">Work Experience:</th>
                                <td>Software Egnineer 4 year experience</td>
                                <th>Academic History:</th>
                                <td>Graduation in Software Engineering</td>
                                <th>Travel History:</th>
                                <td>Dubai, Sri Lanka</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="container-fluid">
                    <div class="panel">
                        <form method="GET" action="{{ route('students.index') }}">
                            <strong class="sub-title">Search Student</strong>
                            <div class="datatable my-4 table-responsive">
                                <table id="example" class="table table-bordered">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Work Doc</th>
                                            <th>Travel Doc</th>
                                            <th>Viki doc</th>
                                            <th>Other Doc</th>
                                            <th>Doc</th>
                                            <th>Doc</th>
                                            <th>Doc</th>
                                            <th>Doc</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <tr>
                                            <td>view</i></td>
                                            <td>view</i></td>
                                            <td>view</i></td>
                                            <td>view</i></td>
                                            <td>view</i></td>
                                            <td>view</i></td>
                                            <td>view</i></td>
                                            <td>view</i></td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <hr class="line-bottom"> -->
    <div class="footer">

    </div>
</section>

<div class="card border-0">
  <div class="card-header">

  </div>
  <div class="card-body">
    <h5 class="card-title"></h5>
    <p class="card-text"></p>
    <a href="#" class=""></a>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
    $('.show_confirm').click(function(event) {

        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();

        swal({

                title: `Are you sure you want to delete this Student?`,
                icon: "warning",
                buttons: true,
                dangerMode: true,

            })
            .then((willDelete) => {

                if (willDelete) {
                    form.submit();
                }
            });
    });
</script>
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
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            searching: false,
            "paging": false,
            order: [[0, 'desc']]

        });
    });
</script>

@push('js')
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
@endpush
@endsection
