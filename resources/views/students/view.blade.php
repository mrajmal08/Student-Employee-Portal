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
                                <span>{{ $student->id }}</span>
                            </li>
                        </ul>
                    </breadcrumb>
                </div>

                <div class="container-fluid datatable">
                    <div class="row">
                        <!-- Image column -->
                        <div class="col-md-2">
                            <div class="image-holder">
                                <img src="{{ asset('assets/img/student.png') }}" class="img-fluid student_img">
                            </div>
                        </div>
                        <!-- Table content column -->
                        <div class="col-md-10">
                            <div class="my-3 ms-3 ">
                                <h4 class="student-detail">{{ $student->name }} ( {{ \Carbon\Carbon::parse($student->date_of_birth)->age  }} years | {{ $student->date_of_birth }} | {{ $student->gender == 1 ? 'Male' : 'Female' }} )</h4>
                            </div>
                            <table id="example" class="table table-striped w-100 custom-datatable">
                                <tbody>
                                    <tr>
                                        <th scope="row">Email:</th>
                                        <td>{{ $student->email }}</td>
                                        <th>Nationality:</th>
                                        <td>{{ $student->nationality }}</td>
                                        <th>Preferred Contact Number:</th>
                                        <td>{{ $student->phone_no }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Passport:</th>
                                        <td>{{ $student->passport }}</td>
                                        <th>Address:</th>
                                        <td>{{ $student->address }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Passport:</th>
                                        <td>{{ $student->passport }}</td>
                                        <th>Address:</th>
                                        <td>{{ $student->address }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Passport:</th>
                                        <td>{{ $student->passport }}</td>
                                        <th>Address:</th>
                                        <td>{{ $student->address }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-12">
                        <a href="{{ route('students.create') }}" class="btn filter-btn  mb-4 mt-4 ms-3">
                            <span class="icon-plus">
                                +
                            </span>
                            Add New Case </a>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="panel student_view">
                        <form method="GET" action="{{ route('students.index') }}">
                            <strong class="sub-title">Search Student</strong>
                            <div class="datatable my-4 table-responsive">

                                <table id="example" class="table table-bordered">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Passport Documents</th>
                                            <th>BRP Documents</th>
                                            <th>Financial Statement Documents</th>
                                            <th>Qualification Documents</th>
                                            <th>English Language Certificates</th>
                                            <th>Miscellaneous Documents</th>
                                            <th>TB Certificate</th>
                                            <th>Previous CAS Documents</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <tr>
                                            <td>2333</td>
                                            <td>2333</td>
                                            <td>2333</td>
                                            <td>2333</td>
                                            <td>2333</td>
                                            <td>2333</td>
                                            <td>2333</td>
                                            <td>2333</td>
                                        </tr>
                                    </tbody>
                                </table>


                                <!-- <table id="example" class="table table-bordered">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Passport Documents</th>
                                            <th>BRP Documents</th>
                                            <th>Financial Statement Documents</th>
                                            <th>Qualification Documents</th>
                                            <th>English Language Certificates</th>
                                            <th>Miscellaneous Documents</th>
                                            <th>TB Certificate</th>
                                            <th>Previous CAS Documents</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <tr>
                                            @foreach ([
                                            'passport_doc' => 'Passport',
                                            'brp_doc' => 'BRP',
                                            'financial_statement_doc' => 'Financial Statement',
                                            'qualification_doc' => 'Qualification',
                                            'lang_doc' => 'Language',
                                            'miscellaneous_doc' => 'Miscellaneous',
                                            'tb_certificate_doc' => 'TB Certificate',
                                            'previous_cas_doc' => 'Previous CAS'
                                            ] as $docType => $docTitle)
                                            <td>
                                                <a data-bs-toggle="modal" data-bs-target="#{{ $docType }}">view</a>
                                            </td>
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table> -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <!-- @foreach ([
    'passport_doc' => 'Passport Documents',
    'brp_doc' => 'BRP Documents',
    'financial_statement_doc' => 'Financial Statement Documents',
    'qualification_doc' => 'Qualification Documents',
    'lang_doc' => 'Language Documents',
    'miscellaneous_doc' => 'Miscellaneous Documents',
    'tb_certificate_doc' => 'TB Certificate Documents',
    'previous_cas_doc' => 'Previous CAS Documents'
    ] as $docType => $docTitle)
    <div class="modal fade" id="{{ $docType }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $docType }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel{{ $docType }}">{{ $docTitle }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul>
                        @foreach(explode(',', $student->$docType) as $document)
                        @if(trim($document))
                        <li>{{ $document }} <a href="{{ asset('assets/studentFiles/' . $document) }}" target="_blank">view</a></li>
                        @else
                        <li>No Files.</li>
                        @endif
                        @endforeach
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach -->

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

@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
@endpush
@endsection
