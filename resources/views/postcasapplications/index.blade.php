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
                                <a role="button">Post Cas Application</a>
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
                        <a href="{{ route('postcas.create') }}" class="btn filter-btn float-end mb-2 me-2">
                            <span class="icon-plus">
                                +
                            </span>
                            Add Post Cas Application </a>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="panel">
                        <form method="GET" action="{{ route('postcas.index') }}">
                            <strong class="sub-title">Search Post Cas Application</strong>
                            <div class="collapse-div mb-3">
                                <div class="row extra-padding">
                                    <div class="col-md-3 col-sm-6 filter-item">
                                        <label class="label">Cas Number</label>
                                        <input type="text" name="cas_no" class="form-control" placeholder="">
                                    </div>
                                    <div class="col-md-3 col-sm-6 filter-item">
                                        <label class="label">Cas Obsolete Visa Granted Date</label>
                                        <input type="text" name="cas_date" class="form-control" placeholder="">
                                    </div>
                                    <div class="col-md-3 col-sm-6 filter-item">
                                        <label class="label">Date Of Home Office Reporting</label>
                                        <input type="text" name="reporting_date" class="form-control" placeholder="">
                                    </div>
                                    <div class="col-md-3 col-sm-6 filter-item">
                                        <label class="label">BRP Start Date</label>
                                        <input type="text" name="brp_start_date" class="form-control" placeholder="">
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
                                        <label class="label">BRP End Date</label>
                                        <input type="text" name="brp_end_date" class="form-control" placeholder="">
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
                    <!-- <table id="example" class="table table-bordered w-100"> -->
                    <table id="example" class="table table-bordered table-striped w-100 custom-datatable">

                        <thead class="text-center">
                            <tr>
                                <th>ID</th>
                                <th>Cas Number</th>
                                <th>Cas Date</th>
                                <th>Vignette Docs</th>
                                <th>vignette_stamp_doc</th>
                                <th>date_of_entry</th>
                                <th>after_vignette</th>
                                <th>before_vignette</th>
                                <th>student_notified</th>
                                <th>is_egates</th>
                                <th>e_ticket</th>
                                <th>brp_received</th>
                                <th>brp_error</th>
                                <th>reporting_date</th>
                                <th>brp_start_date</th>
                                <th>brp_end_date</th>
                                <th>sms_reporting_date</th>
                                <th>sms_screen_shot</th>
                                <th>brp_doc</th>
                                <th>brp_correction_note</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($postCas as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->cas_no }}</td>
                                <td>{{ $item->cas_date }}</td>
                                <td>
                                    <a data-bs-toggle="modal" data-bs-target="#docs{{ $item->id }}">
                                        <i class="bi bi-eye-fill" style="color: #03a853;"></i>
                                    </a>
                                </td>
                                <td>
                                    <a data-bs-toggle="modal" data-bs-target="#docs{{ $item->id }}">
                                        <i class="bi bi-eye-fill" style="color: #03a853;"></i>
                                    </a>
                                </td>
                                <td>{{ $item->date_of_entry }}</td>
                                <td>{{ $item->after_vignette }}</td>
                                <td>{{ $item->before_vignette }}</td>
                                <td>{{ $item->is_egates }}</td>
                                <td>
                                    <a data-bs-toggle="modal" data-bs-target="#docs{{ $item->id }}">
                                        <i class="bi bi-eye-fill" style="color: #03a853;"></i>
                                    </a>
                                </td>

                                <td>{{ $item->brp_received }}</td>
                                <td>{{ $item->brp_error }}</td>
                                <td>{{ $item->reporting_date }}</td>

                                <td>{{ $item->brp_start_date }}</td>
                                <td>{{ $item->brp_end_date }}</td>
                                <td>{{ $item->sms_reporting_date }}</td>
                                <td>
                                    <a data-bs-toggle="modal" data-bs-target="#docs{{ $item->id }}">
                                        <i class="bi bi-eye-fill" style="color: #03a853;"></i>
                                    </a>
                                </td>
                                <td>
                                    <a data-bs-toggle="modal" data-bs-target="#docs{{ $item->id }}">
                                        <i class="bi bi-eye-fill" style="color: #03a853;"></i>
                                    </a>
                                </td>
                                <td>
                                    <a data-bs-toggle="modal" data-bs-target="#docs{{ $item->id }}">
                                        <i class="bi bi-eye-fill" style="color: #03a853;"></i>
                                    </a>
                                </td>
                                <td>{{ $item->brp_correction_note }}</td>
                                <td class="ealign-items-center">
                                    <a href="{{ route('precas.edit', [$item->id]) }}" class="me-2">
                                        <i class="bi bi-pen"></i>
                                    </a>
                                    <form method="GET" action="{{ route('precas.delete', $item->id) }}" class="d-inline">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <a href="{{ route('precas.delete', $item->id) }}" class="show_confirm" data-toggle="tooltip" title="Delete">
                                            <i class="bi bi-x-lg text-danger" style="font-weight: bold;"></i>
                                        </a>
                                    </form>
                                </td>
                            </tr>

                            <div class="modal fade" id="docs{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel{{ $item->id }}">Interview Documents</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <ul>
                                                @foreach(explode(',', $item->vignette_doc) as $document)
                                                <li>{{ $document }} <a href="{{ asset('assets/PreCasApplicationDoc/' . $document) }}" target="_blank">view</a></li>
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

                title: `Are you sure you want to delete this Pre Can Application?`,
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
        });
    });
</script>


@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
@endpush
@endsection
