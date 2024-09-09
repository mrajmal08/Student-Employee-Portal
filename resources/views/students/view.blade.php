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
                        <div class="col-md-2">
                            <div class="image-holder">
                                <img src="{{ asset('assets/img/student.png') }}" class="img-fluid student_img">
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="my-3">
                                <h3 class="student-detail">{{ $student->name }} ( {{ \Carbon\Carbon::parse($student->date_of_birth)->age  }} years | {{ $student->date_of_birth }} | {{ $student->gender == 1 ? 'Male' : 'Female' }} )</h3>
                            </div>
                            <table id="" class="table table-striped w-100 custom-datatable">
                                <tbody>
                                    <tr>
                                        <th>Address Line 1:</th>
                                        <td>{{ $student->address }}</td>
                                        <th>Address Line 2:</th>
                                        <td>{{ $student->address2 }}</td>
                                        <th>City:</th>
                                        <td>{{ $student->city }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">County:</th>
                                        <td>{{ $student->county }}</td>
                                        <th>Post Code:</th>
                                        <td>{{ $student->post_code }}</td>
                                        <th>Preferred Contact No:</th>
                                        <td>{{ $student->phone_no }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Passport:</th>
                                        <td>{{ $student->passport }}</td>
                                        <th>Nationality:</th>
                                        <td>{{ $student->nationality }}</td>
                                        <th>DOB:</th>
                                        <td>{{ $student->date_of_birth }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Email:</th>
                                        <td>{{ $student->email }}</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <a href="" class="btn filter-btn  mb-4 mt-4 ms-3">
                            <span class="icon-plus">
                                +
                            </span>
                            Add New Case </a>
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="panel student_view">
                        <strong class="sub-title">Search Student</strong>
                        <div class="datatable my-4 table-responsive">

                            <table id="example" class="table table-bordered">
                                <thead class="text-center">
                                    <tr>
                                        <th>Student Id</th>
                                        <th>Student Name</th>
                                        <th>Course Applied For</th>
                                        <th>Intake</th>
                                        <th>Dependants</th>
                                        <th>Traveling Alone</th>
                                        <th>Recruitment Agent</th>
                                        <th>Method Of Contact</th>
                                        <th>Verifier</th>
                                        <th>Created By</th>
                                        <th>Updated By</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr>
                                        <td><a href="{{ route('students.create', [$student->id]) }}">{{ $student->id }}</a></td>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ \App\Models\Course::where('id', $student->course_id)->value('name') }}</td>
                                        <td>{{ $student->intake }}</td>
                                        <td><a data-bs-toggle="modal" data-bs-target="#dependants{{ $student->id }}">
                                                <i class="bi bi-eye-fill" style="color: #03a853;"></i>
                                            </a></td>
                                        <td>{{ $student->traveling_alone }}</td>
                                        <td>{{ \App\Models\RecruitmentAgent::where('id', $student->agent_id)->value('name') }}</td>
                                        <td>{{ $student->preferred_method }}</td>
                                        <td>{{ $student->screened_by }}</td>
                                        <td>{{ \app\Models\User::where('id', $student->created_by)->value('name') }} <br>{{ $student->created_at->format('Y-m-d') }}</td>
                                        <td>{{ \app\Models\User::where('id', $student->created_by)->value('name') }} <br>{{ $student->created_at->format('Y-m-d') }}</td>
                                    </tr>

                                </tbody>
                            </table>


                            <!-- Modal -->
                            <div class="modal fade" id="dependants{{ $student->id }}" tabindex="-1" aria-labelledby="dependantsLabel{{ $student->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="dependantsLabel{{ $student->id }}">Dependants of {{ $student->name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @if($student->dependants->isEmpty())
                                            <p>No dependants found.</p>
                                            @else
                                            <div class="row">
                                                <?php $count = 1; ?>
                                                @foreach ($student->dependants as $dependant)

                                                <div class="dependant-heading mb-2">Dependant {{ $count }}</div>
                                                <div class="col-md-3">
                                                    <div class="list-group-item">
                                                        <strong>Name:</strong> <strong class="label">{{ $dependant->name }}</strong><br>
                                                        <strong>Nationality:</strong> <strong class="label"> {{ $dependant->nationality }}</strong><br>
                                                        <strong>Date of Birth:</strong> <strong class="label"> {{ $dependant->date_of_birth }}</strong><br>

                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="list-group-item">
                                                        <strong>Travel Outside:</strong> <strong class="label">{{ $dependant->travel_outside }}</strong><br>
                                                        <strong>Travel History:</strong> <strong class="label">{{ $dependant->travel_history }}</strong><br>
                                                        <strong>Financial Docs:</strong>

                                                        @foreach(explode(',', $dependant->financial_doc) as $document)
                                                        @if(trim($document))

                                                        <a href="{{ asset('assets/DependantDoc/' . $document) }}" target="_blank"><i class="bi bi-eye-fill" style="color: #03a853;"></i></a>
                                                        @else
                                                        <a style="color: red; font-size:small; pointer-events: none;">No Files.</a>
                                                        @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="list-group-item">
                                                        <strong>Qualification Doc:</strong>
                                                        @foreach(explode(',', $dependant->qualification_doc) as $document)
                                                        @if(trim($document))

                                                        <a href="{{ asset('assets/DependantDoc/' . $document) }}" target="_blank"><i class="bi bi-eye-fill" style="color: #03a853;"></i></a>
                                                        @else
                                                        <a style="color: red; font-size:small; pointer-events: none;">No Files.</a>
                                                        @endif
                                                        @endforeach
                                                        <br>
                                                        <strong>Pay Slip:</strong>
                                                        @foreach(explode(',', $dependant->pay_slip) as $document)
                                                        @if(trim($document))

                                                        <a href="{{ asset('assets/DependantDoc/' . $document) }}" target="_blank"><i class="bi bi-eye-fill" style="color: #03a853;"></i></a>
                                                        @else
                                                        <a style="color: red; font-size:small; pointer-events: none;">No Files.</a>
                                                        @endif
                                                        @endforeach<br>
                                                        <strong>Employer Letter:</strong>
                                                        @foreach(explode(',', $dependant->employer_letter) as $document)
                                                        @if(trim($document))

                                                        <a href="{{ asset('assets/DependantDoc/' . $document) }}" target="_blank"><i class="bi bi-eye-fill" style="color: #03a853;"></i></a>
                                                        @else
                                                        <a style="color: red; font-size:small; pointer-events: none;">No Files.</a>
                                                        @endif
                                                        @endforeach
                                                        <br>

                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="list-group-item">
                                                        <strong>Marriage Certificate:</strong>
                                                        @foreach(explode(',', $dependant->marriage_certificate) as $document)
                                                        @if(trim($document))

                                                        <a href="{{ asset('assets/DependantDoc/' . $document) }}" target="_blank"><i class="bi bi-eye-fill" style="color: #03a853;"></i></a>
                                                        @else
                                                        <a style="color: red; font-size:small; pointer-events: none;">No Files.</a>
                                                        @endif
                                                        @endforeach<br>
                                                        <strong>Birth Certificate:</strong>
                                                        @foreach(explode(',', $dependant->birth_certificate) as $document)
                                                        @if(trim($document))

                                                        <a href="{{ asset('assets/DependantDoc/' . $document) }}" target="_blank"><i class="bi bi-eye-fill" style="color: #03a853;"></i></a>
                                                        @else
                                                        <a style="color: red; font-size:small; pointer-events: none;">No Files.</a>
                                                        @endif
                                                        @endforeach<br>

                                                        <strong>Officer Note:</strong>
                                                        <span class="short-text">
                                                            {!! Str::words($dependant->officer_note, 2) !!}
                                                        </span>
                                                        <span class="full-text" style="display: none;">
                                                            {{ $dependant->officer_note }}
                                                        </span>
                                                        <a href="#" class="text-success read-more-toggle" data-target="#officerNote-{{ $dependant->id }}">read more...</a>
                                                        <br>
                                                    </div>
                                                </div>
                                                <?php $count++; ?>
                                                @endforeach
                                            </div>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                        <!-- </form> -->
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
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.read-more-toggle').forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                var target = document.querySelector(link.getAttribute('data-target'));
                var shortText = link.previousElementSibling.previousElementSibling;
                var fullText = link.previousElementSibling;

                if (fullText.style.display === 'none') {
                    fullText.style.display = 'inline';
                    shortText.style.display = 'none';
                    link.textContent = 'read less';
                } else {
                    fullText.style.display = 'none';
                    shortText.style.display = 'inline';
                    link.textContent = 'read more...';
                }
            });
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
            order: [
                [0, 'desc']
            ],
            "bLengthChange": false,
        });
    });
</script>

@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
@endpush
@endsection
