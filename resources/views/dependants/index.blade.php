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
                                <a role="button">Dependant</a>
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
                        <a href="{{ route('dependants.create') }}" class="btn filter-btn float-end mb-2 me-2">
                            <span class="icon-plus">
                                +
                            </span>
                            Add Dependant </a>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="panel">
                        <form method="GET" action="{{ route('dependants.index') }}">
                            <strong class="sub-title">Search Dependant</strong>
                            <div class="collapse-div mb-3">
                                <div class="row extra-padding">
                                    <div class="col-md-3 col-sm-6 filter-item">
                                        <label class="label">Name Of Dependant</label>
                                        <input type="text" name="name" class="form-control" placeholder="">
                                    </div>
                                    <div class="col-md-3 col-sm-6 filter-item">
                                        <label class="label">Nationality of Dependant</label>
                                        <input type="text" name="nationality" class="form-control" placeholder="">
                                    </div>
                                    <div class="col-md-3 col-sm-6 filter-item">
                                        <label class="label">Date Of Birth</label>
                                        <input type="text" name="date_of_birth" class="form-control" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="toggle-button" onclick="toggleFilters()">
                                <span class="plus-icon">
                                    +
                                </span>
                            </div>
                            <div id="collapsible-filters" class="hidden">
                                <div class="search-filter-btn-group text-center mt-3">
                                    <button class="btn filter-btn">Filter</button>
                                    <button class="btn reset-btn ms-2">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="datatable my-4 table-responsive">
                    <table id="example" class="table table-bordered table-striped w-100 custom-datatable">
                        <thead class="text-center">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Nationality</th>
                                <th>date_of_birth</th>
                                <th>travel_outside</th>
                                <th>travel_history</th>
                                <th>financial_doc</th>
                                <th>qualification_doc</th>
                                <th>pay_slip</th>
                                <th>employer_letter</th>
                                <th>marriage_certificate</th>
                                <th>birth_certificate</th>
                                <th>officer_note</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($dependants as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->nationality }}</td>
                                <td>{{ $item->date_of_birth }}</td>
                                <td>{{ $item->travel_outside }}</td>
                                <td>
                                    {!! Str::words($item->travel_history, 2, ' <a href="#" class="text-success" data-bs-toggle="modal" data-bs-target="#travelNoteModal-' . $item->id . '">read more...</a>') !!}
                                </td>

                                <td>
                                    <a data-bs-toggle="modal" data-bs-target="#financial_doc{{ $item->id }}">
                                        <i class="bi bi-eye-fill" style="color: #03a853;"></i>
                                    </a>
                                </td>
                                <td>
                                    <a data-bs-toggle="modal" data-bs-target="#qualification_doc{{ $item->id }}">
                                        <i class="bi bi-eye-fill" style="color: #03a853;"></i>
                                    </a>
                                </td>
                                <td>
                                    <a data-bs-toggle="modal" data-bs-target="#pay_slip{{ $item->id }}">
                                        <i class="bi bi-eye-fill" style="color: #03a853;"></i>
                                    </a>
                                </td>
                                <td>
                                    <a data-bs-toggle="modal" data-bs-target="#employer_letter{{ $item->id }}">
                                        <i class="bi bi-eye-fill" style="color: #03a853;"></i>
                                    </a>
                                </td>
                                <td>
                                    <a data-bs-toggle="modal" data-bs-target="#marriage_certificate{{ $item->id }}">
                                        <i class="bi bi-eye-fill" style="color: #03a853;"></i>
                                    </a>
                                </td>
                                <td>
                                    <a data-bs-toggle="modal" data-bs-target="#birth_certificate{{ $item->id }}">
                                        <i class="bi bi-eye-fill" style="color: #03a853;"></i>
                                    </a>
                                </td>
                                <td>
                                    {!! Str::words($item->officer_note, 2, ' <a href="#" class="text-success" data-bs-toggle="modal" data-bs-target="#officerNoteModal-' . $item->id . '">read more...</a>') !!}
                                </td>
                                <td class="ealign-items-center">
                                    <a href="{{ route('dependants.edit', [$item->id]) }}" class="me-2">
                                        <i class="bi bi-pen"></i>
                                    </a>
                                    <form method="GET" action="{{ route('dependants.delete', $item->id) }}" class="d-inline">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <a href="{{ route('dependants.delete', $item->id) }}" class="show_confirm" data-toggle="tooltip" title="Delete">
                                            <i class="bi bi-x-lg text-danger" style="font-weight: bold;"></i>
                                        </a>
                                    </form>
                                </td>
                            </tr>


                            <!-- Modal -->
                            <div class="modal fade" id="travelNoteModal-{{ $item->id }}" tabindex="-1" aria-labelledby="officerNoteModalLabel-{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="officerNoteModalLabel-{{ $item->id }}">Officer Note</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            {{ $item->travel_history }}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Modal -->
                            <div class="modal fade" id="officerNoteModal-{{ $item->id }}" tabindex="-1" aria-labelledby="officerNoteModalLabel-{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="officerNoteModalLabel-{{ $item->id }}">Officer Note</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            {{ $item->officer_note }}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Financail Document Modal -->
                            <div class="modal fade" id="financial_doc{{ $item->id }}" tabindex="-1" aria-labelledby="financial_doc{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="financial_doc{{ $item->id }}">Vignette Documents</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <ul>
                                                @foreach(explode(',', $item->financial_doc) as $document)
                                                @if(trim($document))
                                                <li>{{ $document }} <a href="{{ asset('assets/DependantDoc/' . $document) }}" target="_blank">view</a></li>
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
                            <!-- Qualification Document Modal -->
                            <div class="modal fade" id="qualification_doc{{ $item->id }}" tabindex="-1" aria-labelledby="qualification_doc{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="qualification_doc{{ $item->id }}">Vignette Documents</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <ul>
                                                @foreach(explode(',', $item->qualification_doc) as $document)
                                                @if(trim($document))

                                                <li>{{ $document }} <a href="{{ asset('assets/DependantDoc/' . $document) }}" target="_blank">view</a></li>
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
                            <!-- Pay Slip Document Modal -->
                            <div class="modal fade" id="pay_slip{{ $item->id }}" tabindex="-1" aria-labelledby="pay_slip{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="pay_slip{{ $item->id }}">Vignette Documents</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <ul>
                                                @foreach(explode(',', $item->pay_slip) as $document)
                                                @if(trim($document))

                                                <li>{{ $document }} <a href="{{ asset('assets/DependantDoc/' . $document) }}" target="_blank">view</a></li>
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
                            <!-- Employer Letter Document Modal -->
                            <div class="modal fade" id="employer_letter{{ $item->id }}" tabindex="-1" aria-labelledby="employer_letter{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="employer_letter{{ $item->id }}">Vignette Documents</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <ul>
                                                @foreach(explode(',', $item->employer_letter) as $document)
                                                @if(trim($document))

                                                <li>{{ $document }} <a href="{{ asset('assets/DependantDoc/' . $document) }}" target="_blank">view</a></li>
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
                            <!-- Marriage Certificate Document Modal -->
                            <div class="modal fade" id="marriage_certificate{{ $item->id }}" tabindex="-1" aria-labelledby="marriage_certificate{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="marriage_certificate{{ $item->id }}">Vignette Documents</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <ul>
                                                @foreach(explode(',', $item->marriage_certificate) as $document)
                                                @if(trim($document))
                                                <li>{{ $document }} <a href="{{ asset('assets/DependantDoc/' . $document) }}" target="_blank">view</a></li>
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
                            <!-- Qualification Document Modal -->
                            <div class="modal fade" id="birth_certificate{{ $item->id }}" tabindex="-1" aria-labelledby="birth_certificate{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="birth_certificate{{ $item->id }}">Vignette Documents</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <ul>
                                                @foreach(explode(',', $item->birth_certificate) as $document)
                                                @if(trim($document))
                                                <li>{{ $document }} <a href="{{ asset('assets/DependantDoc/' . $document) }}" target="_blank">view</a></li>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
    $('.show_confirm').click(function(event) {

        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();

        swal({

                title: `Are you sure you want to delete this dependant?`,
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
            "scrollX": true,
            order: [
                [0, 'desc']
            ]
        });
    });
</script>

@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
@endpush
@endsection
