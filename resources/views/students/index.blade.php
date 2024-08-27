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
                                <a role="button">list</a>
                            <li class="breadcrumb-item">
                                <span>all</span>
                            </li>
                        </ul>
                    </breadcrumb>
                </div>
                <div class="row">
                    <div class="col-12">
                        <a href="{{ route('students.create') }}" class="btn filter-btn float-end mb-2 me-2">
                            <span class="icon-plus">
                                +
                            </span>
                            Add Student </a>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="panel">
                        <form method="GET" action="{{ route('students.index') }}">
                            <strong class="sub-title">Search Student</strong>
                            <div class="collapse-div mb-3">
                                <div class="row extra-padding">
                                    <div class="col-md-3 col-sm-6 filter-item">
                                        <label class="label">Student Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="">
                                    </div>
                                    <div class="col-md-3 col-sm-6 filter-item">
                                        <label class="label">Student Email Address</label>
                                        <input type="text" name="email" class="form-control" placeholder="">
                                    </div>
                                    <div class="col-md-3 col-sm-6 filter-item">
                                        <label class="label">Preferred Contact Details</label>
                                        <input type="text" name="phone_no" class="form-control" placeholder="">
                                    </div>
                                    <div class="col-md-3 col-sm-6 filter-item">
                                        <label class="label">Nationality</label>
                                        <input type="text" name="nationality" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="toggle-button" onclick="toggleFilters()">
                                    <span class="plus-icon">
                                        +
                                    </span>
                                </div>
                            </div>
                            <div id="collapsible-filters" class="hidden">
                                <div class="row">
                                    <div class="col-md-3 col-sm-6 filter-item">
                                        <label class="label">Passport Number</label>
                                        <input type="text" name="passport" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="search-filter-btn-group text-center mt-3">
                                    <button class="btn filter-btn">Filter</button>
                                    <button class="btn reset-btn ms-2">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="datatable my-4 table-responsive">
                    <table id="example" class="table table-bordered">
                        <thead class="text-center">
                            <tr>
                                <th>Student ID</th>
                                <th>Student Name</th>
                                <th>Student Email Address</th>
                                <th>Preferred Contact Details</th>
                                <th>Nationality</th>
                                <th>Passport Number</th>
                                <th>Dependants</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($students as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone_no }}</td>
                                <td>{{ $item->nationality }}</td>
                                <td>{{ $item->passport }}</td>
                                <td>
                                    <a data-bs-toggle="modal" data-bs-target="#dependants{{ $item->id }}">
                                        <i class="bi bi-eye-fill" style="color: #03a853;"></i>
                                    </a>
                                </td>
                                <td class="ealign-items-center">
                                    <a href="{{ route('students.view', [$item->id]) }}" class="me-2">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    <a href="{{ route('students.edit', [$item->id]) }}" class="me-2">
                                        <i class="bi bi-pen"></i>
                                    </a>
                                    <form method="GET" action="{{ route('students.delete', $item->id) }}" class="d-inline">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <a href="{{ route('students.delete', $item->id) }}" class="show_confirm" data-toggle="tooltip" title="Delete">
                                            <i class="bi bi-x-lg text-danger" style="font-weight: bold;"></i>
                                        </a>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="dependants{{ $item->id }}" tabindex="-1" aria-labelledby="dependantsLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="dependantsLabel{{ $item->id }}">Dependants of {{ $item->name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @if($item->dependants->isEmpty())
                                            <p>No dependants found.</p>
                                            @else
                                            <div class="row">
                                                <?php $count = 1; ?>
                                                @foreach ($item->dependants as $dependant)

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
                                                        <a href="{{ asset('assets/DependantDoc/' . $document) }}" target="_blank"><i class="bi bi-eye-fill" style="color: #03a853;"></i></a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="list-group-item">
                                                        <strong>Qualification Doc:</strong>
                                                        @foreach(explode(',', $dependant->qualification_doc) as $document)
                                                        <a href="{{ asset('assets/DependantDoc/' . $document) }}" target="_blank"><i class="bi bi-eye-fill" style="color: #03a853;"></i></a>
                                                        @endforeach
                                                        <br>
                                                        <strong>Pay Slip:</strong>
                                                        @foreach(explode(',', $dependant->pay_slip) as $document)
                                                        <a href="{{ asset('assets/DependantDoc/' . $document) }}" target="_blank"><i class="bi bi-eye-fill" style="color: #03a853;"></i></a>
                                                        @endforeach<br>
                                                        <strong>Employer Letter:</strong>
                                                        @foreach(explode(',', $dependant->employer_letter) as $document)
                                                        <a href="{{ asset('assets/DependantDoc/' . $document) }}" target="_blank"><i class="bi bi-eye-fill" style="color: #03a853;"></i></a>
                                                        @endforeach
                                                        <br>

                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="list-group-item">
                                                        <strong>Marriage Certificate:</strong>
                                                        @foreach(explode(',', $dependant->marriage_certificate) as $document)
                                                        <a href="{{ asset('assets/DependantDoc/' . $document) }}" target="_blank"><i class="bi bi-eye-fill" style="color: #03a853;"></i></a>
                                                        @endforeach<br>
                                                        <strong>Birth Certificate:</strong>
                                                        @foreach(explode(',', $dependant->birth_certificate) as $document)
                                                        <a href="{{ asset('assets/DependantDoc/' . $document) }}" target="_blank"><i class="bi bi-eye-fill" style="color: #03a853;"></i></a>
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

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- <hr class="line-bottom"> -->
    <div class="footer">

    </div>
</section>

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
            order: [[0, 'desc']],
        });

        $('#example tbody tr:first').css('font-weight', 'bold');

    });
</script>

@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
@endpush
@endsection
