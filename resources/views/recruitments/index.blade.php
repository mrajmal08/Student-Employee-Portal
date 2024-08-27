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
                                <a role="button">Recruitment Agent</a>
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
                        <a href="{{ route('recruitments.create') }}" class="btn filter-btn float-end mb-2 me-2">
                            <span class="icon-plus">
                                +
                            </span>
                            Add Recruitment Agent </a>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="panel">
                        <form method="GET" action="{{ route('recruitments.index') }}">
                            <strong class="sub-title">Search Recruitment Agent</strong>
                            <div class="collapse-div mb-3">
                                <div class="row extra-padding">
                                    <div class="col-md-3 col-sm-6 filter-item">
                                        <label class="label">Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="">
                                    </div>
                                    <div class="col-md-3 col-sm-6 filter-item">
                                        <label class="label">Company Register Number</label>
                                        <input type="text" name="company_register_number" class="form-control" placeholder="">
                                    </div>
                                    <div class="col-md-3 col-sm-6 filter-item">
                                        <label class="label">Date Of Registration</label>
                                        <input type="text" name="date_of_registration" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="toggle-button" onclick="toggleFilters()">
                                    <span class="plus-icon">
                                        +
                                    </span>
                                </div>
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
                                <th>Directors</th>
                                <th>Company Register Number</th>
                                <th>Date Of Registration</th>
                                <th>Payment Method</th>
                                <th>Account Name</th>
                                <th>Account Number</th>
                                <th>Institutions</th>
                                <th>Career History</th>
                                <th>Address In UK</th>
                                <th>Address If Not In UK</th>
                                <th>Compliance Check</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($recruitments as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->directors }}</td>
                                <td>{{ $item->company_register_number }}</td>
                                <td>{{ $item->date_of_registration }}</td>
                                <td>{{ $item->payment_method }}</td>
                                <td>{{ $item->account_name }}</td>
                                <td>{{ $item->account_number }}</td>
                                <td>{{ $item->institutions }}</td>
                                <td>{!! Str::words($item->career_history, 2, ' <a href="#" class="text-success" data-bs-toggle="modal" data-bs-target="#officerNoteModal-' . $item->id . '">read more...</a>') !!}</td>

                                <td>{{ $item->address_uk }}</td>
                                <td>{{ $item->address }}</td>
                                <td>{{ $item->compliance_check }}</td>

                                <td class="ealign-items-center">
                                    <a href="{{ route('recruitments.edit', [$item->id]) }}" class="me-2">
                                        <i class="bi bi-pen"></i>
                                    </a>
                                    <form method="GET" action="{{ route('recruitments.delete', $item->id) }}" class="d-inline">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <a href="{{ route('recruitments.delete', $item->id) }}" class="show_confirm" data-toggle="tooltip" title="Delete">
                                            <i class="bi bi-x-lg text-danger" style="font-weight: bold;"></i>
                                        </a>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="officerNoteModal-{{ $item->id }}" tabindex="-1" aria-labelledby="officerNoteModalLabel-{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="officerNoteModalLabel-{{ $item->id }}">Officer Note</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            {{ $item->career_history }}
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

                title: `Are you sure you want to delete this Recruitment?`,
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
            order: [[0, 'desc']]
        });
    });
</script>

@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
@endpush
@endsection
