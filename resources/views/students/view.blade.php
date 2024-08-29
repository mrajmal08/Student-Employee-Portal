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
                <div class="my-3 ms-3 ">
                    <h4 class="student-detail">{{ $student->name }} ( {{ \Carbon\Carbon::parse($student->date_of_birth)->age  }} years | {{ $student->date_of_birth }} | {{ $student->gender == 1 ? 'Male' : 'Female' }} )</h4>
                </div>
                <div class="container-fluid datatable">
                    <table class="table table-borderless table-striped">
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
                                <th>Course:</th>
                                <td>{{ $student->courses->pluck('name')->implode(', ') }}</td>
                                <th>Previous CAS:</th>
                                <td>{{ $student->previous_cas }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Dependant:</th>
                                <td>{{ $student->dependants->pluck('name')->implode(', ') }}</td>
                                <th>Intake:</th>
                                <td>{{ $student->intake }}</td>
                                <th>Address:</th>
                                <td>{{ $student->address }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Work Experience:</th>
                                <td>
                                    {!! Str::words($student->work_experience, 2, ' <a href="#" class="text-success" data-bs-toggle="modal" data-bs-target="#work_experience">read more...</a>') !!}
                                </td>
                                <th>Academic History:</th>
                                <td>
                                    {!! Str::words($student->academic_history, 2, ' <a href="#" class="text-success" data-bs-toggle="modal" data-bs-target="#academic_history">read more...</a>') !!}
                                </td>
                                <th>Travel History:</th>
                                <td>
                                    {!! Str::words($student->travel_history, 2, ' <a href="#" class="text-success" data-bs-toggle="modal" data-bs-target="#travel_history">read more...</a>') !!}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Status:</th>
                                <td>{{ \App\Models\Status::where('id', $student->status_id)->value('name') }}</td>
                                <th scope="row">Extra Notes:</th>
                                <td>
                                    {!! Str::words($student->notes, 2, ' <a href="#" class="text-success" data-bs-toggle="modal" data-bs-target="#notes">read more...</a>') !!}

                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>



                <div class="modal fade" id="notes" tabindex="-1" aria-labelledby="officerNoteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="officerNoteModalLabel">Extra Notes</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                {{ $student->notes }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="travel_history" tabindex="-1" aria-labelledby="officerNoteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="officerNoteModalLabel">Travel History</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                {{ $student->travel_history }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="work_experience" tabindex="-1" aria-labelledby="officerNoteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="officerNoteModalLabel">Work Experience</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                {{ $student->work_experience }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="academic_history" tabindex="-1" aria-labelledby="officerNoteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="officerNoteModalLabel">Academic History</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                {{ $student->academic_history }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="panel">
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
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @foreach ([
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
    @endforeach

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
