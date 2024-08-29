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
                                <a role="button">User</a>
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
                        <a href="{{ route('user.create') }}" class="btn filter-btn float-end mb-2 me-2">
                            <span class="icon-plus">
                                +
                            </span>
                            Add User </a>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="panel">
                        <form method="GET" action="{{ route('user.index') }}">
                            <strong class="sub-title">Search User</strong>
                            <div class="collapse-div mb-3">
                                <div class="row extra-padding">
                                    <div class="col-md-3 col-sm-6 filter-item">
                                        <label class="label">Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="">
                                    </div>
                                    <div class="col-md-3 col-sm-6 filter-item">
                                        <label class="label">Email</label>
                                        <input type="text" name="email" class="form-control" placeholder="">
                                    </div>
                                    <div class="col-md-3 col-sm-6 filter-item">
                                        <label class="label">Phone Number</label>
                                        <input type="text" name="phone_no" class="form-control" placeholder="">
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
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($users as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone_no }}</td>
                                <td>{{ $item->role_id }}</td>

                                <td class="align-items-center">
                                    @if($item->role_id != 1)
                                    <a href="{{ route('user.edit', [$item->id]) }}" class="me-2">
                                        <i class="bi bi-pen"></i>
                                    </a>
                                    <form method="GET" action="{{ route('user.delete', $item->id) }}" class="d-inline">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <a href="{{ route('user.delete', $item->id) }}" class="show_confirm" data-toggle="tooltip" title="Delete">
                                            <i class="bi bi-x-lg text-danger" style="font-weight: bold;"></i>
                                        </a>
                                    </form>
                                    @endif
                                </td>
                            </tr>

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

                title: `Are you sure you want to delete this User?`,
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
