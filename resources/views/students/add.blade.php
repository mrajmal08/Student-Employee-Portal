@extends('backend.layouts.app')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
<link href="{{ asset('assets/css/select.css') }}" rel="stylesheet" />
@push('css')
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
                                <span>Add</span>
                            </li>
                        </ul>
                    </breadcrumb>
                </div>
                <div class="user">
                    <div class="container">
                        <div class="user-header">
                            <h4 class="user-role py-3">Add Student</h4>
                            <a href="{{ route('students.index') }}" class="close-btn">x</a>
                        </div>
                        <div class="search-user">
                            <div class="form-container">
                                <div class="my-3">
                                    <span class="star-color">*</span><span class="label"> <i>Indicates required field</i></span>
                                </div>
                                <form method="POST" action="{{ route('students.add_student') }}">
                                    @csrf

                                    <div class="form-row mt-3">
                                        <div class="form-group">
                                            <label class="label" for="name">Student Name<span class="star-color">*</span></label>
                                            <input type="text" id="name" class="form-control" name="name">
                                        </div>
                                        <div class="form-group">
                                            <label class="label" for="email">Student Email Address<span class="star-color">*</span></label>
                                            <input type="email" name="email" class="form-control" id="email">
                                        </div>

                                        <div class="form-group">
                                            <label class="label" for="nationality">Nationality:<span class="star-color">*</span></label>
                                            <input type="text" name="nationality" class="form-control" id="nationality">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="label" for="phone_no">Preferred Contact Number:<span class="star-color">*</span></label>
                                            <input type="text" name="phone_no" class="form-control" id="phone_no">
                                        </div>
                                        <div class="form-group">
                                            <label class="label" for="phone_no">Date Of Birth:</label>
                                            <input type="date" name="date_of_birth" class="form-control" id="date_of_birth">
                                        </div>

                                        <div class="form-group">
                                            <label class="label">Gender:<span class="star-color">*</span></label>
                                            <div class="radio-btn">
                                                <input type="radio" id="male" name="gender" value="1">
                                                <label class="label" for="male">Male</label>
                                                <input type="radio" id="female" name="gender" value="2">
                                                <label class="label" for="female">Female</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">

                                        <div class="form-group">
                                            <label class="label" for="passport">Passport Number:</label>
                                            <input type="text" class="form-control" name="passport" id="text">
                                        </div>
                                        <div class="form-group">
                                            <label class="label">Status:<span class="star-color">*</span></label>
                                            <select name="status_id" id="status_id" class="form-control">
                                                <option disabled selected>--Select One--</option>
                                                @foreach ($status as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">

                                        </div>
                                    </div>

                                    <div class="form-row mt-3">
                                        <div class="form-group">
                                            <label class="label" for="address">Address Line 1:<span class="star-color">*</span></label>
                                            <input type="text" id="address" class="form-control" name="address">
                                        </div>
                                        <div class="form-group">
                                            <label class="label" for="address2">Address Line 2:</label>
                                            <input type="text" name="address2" class="form-control" id="address2">
                                        </div>

                                        <div class="form-group">
                                            <label class="label" for="middleName">City:<span class="star-color">*</span></label>
                                            <input type="text" name="city" class="form-control" id="city">
                                        </div>
                                    </div>
                                    <div class="form-row mt-3">
                                        <div class="form-group">
                                            <label class="label" for="county">County:</label>
                                            <input type="text" id="county" class="form-control" name="county">
                                        </div>
                                        <div class="form-group">
                                            <label class="label" for="post_code">Post Code:<span class="star-color">*</span></label>
                                            <input type="text" name="post_code" class="form-control" id="post_code">
                                        </div>

                                        <div class="form-group">

                                        </div>
                                    </div>
                                    <div class="form-buttons my-4">
                                        <button type="submit" class="btn filter-btn">Submit</button>
                                        <a href="{{ route('students.index') }}" type="submit" class="btn btn-cancel">Cancel</a>
                                    </div>
                                </form>
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
    $(document).ready(function() {
        $('#payment_method').on('change', function() {
            var selectedValue = $(this).val();
            if (selectedValue === 'Bank Account' || selectedValue === 'Paypal') {
                $('#account_name_group').show();
                $('#account_number_group').show();
            } else {
                $('#account_name_group').hide();
                $('#account_number_group').hide();
            }
        });

        // Initial check in case the page is loaded with a value selected
        $('#payment_method').trigger('change');
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

@endpush
@endsection
