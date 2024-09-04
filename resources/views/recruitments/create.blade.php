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
                                <a role="button">Recruitment</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a role="button">Agent</a>
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
                            <h4 class="user-role py-3">Add Recruitment</h4>
                            <a href="{{ route('recruitments.index') }}" class="close-btn">x</a>
                        </div>
                        <div class="search-user">
                            <div class="form-container">
                                <div class="my-3">
                                    <span class="star-color">*</span><span class="label"> <i>Indicates required field</i></span>
                                </div>
                                <form method="POST" action="{{ route('recruitments.insert') }}">
                                    @csrf
                                    <div class="form-row mt-3">
                                        <div class="form-group">
                                            <label class="label" for="name">Name Of Agent:<span class="star-color">*</span></label>
                                            <input type="text" class="form-control" id="name" name="name">
                                        </div>
                                        <div class="form-group">
                                            <label class="label" for="directors">List The Name Of All Your Directors:<span class="star-color">*</span></label>
                                            <input type="text" class="form-control" name="directors" id="directors">
                                        </div>
                                        <div class="form-group">
                                            <label class="label" for="company_register_number">Company Register Number:<span class="star-color">*</span></label>
                                            <input type="text" class="form-control" name="company_register_number" id="company_register_number">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label class="label" for="date_of_registration">Date Of Registration:<span class="star-color">*</span></label>
                                            <input type="date" class="form-control" name="date_of_registration" id="date_of_registration">
                                        </div>

                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label class="label" for="payment_method">Payment Method:<span class="star-color">*</span></label>
                                            <select id="payment_method" class="form-control" name="payment_method">
                                                <option default selected>--Select One--</option>
                                                <option value="Cash">Cash</option>
                                                <option value="Bank Account">Bank Account</option>
                                                <option value="Paypal">Paypal</option>
                                            </select>
                                        </div>
                                        <div class="form-group" id="account_name_group" style="display: none;">
                                            <label class="label" for="account_name">Account Name:</label>
                                            <input type="text" class="form-control" name="account_name" id="account_name">
                                        </div>
                                        <div class="form-group" id="account_number_group" style="display: none;">
                                            <label class="label" for="account_number">Account Number:</label>
                                            <input type="text" class="form-control" name="account_number" id="account_number">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="label" for="institutions">Institutions You Have Worked With So Far:</label>
                                            <input type="text" class="form-control" name="institutions" id="institutions">
                                        </div>
                                        <div class="form-group">
                                            <label class="label" for="career_history">Career History:</label>
                                            <input type="text" class="form-control" name="career_history" id="career_history">
                                        </div>

                                        <div class="form-group">
                                            <label class="label" for="address_uk">Address In UK:</label>
                                            <input type="text" class="form-control" name="address_uk" id="address_uk">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="label" for="address">Address If Company Not In UK:</label>
                                            <input type="text" class="form-control" name="address" id="address">
                                        </div>
                                        <div class="form-group">
                                            <label class="label">Compliance Check:</label>
                                            <div class="radio-btn">
                                                <input type="radio" id="yes" name="compliance_check" value="Yes">
                                                <label class="label" for="yes">Yes</label>
                                                <input type="radio" id="no" name="compliance_check" value="No">
                                                <label class="label" for="no">No</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                        </div>
                                    </div>

                                    <div class="my-2">
                                        <h4 class="address">
                                            How Many Students Recruited To Date:
                                        </h4>
                                    </div>
                                    <div class="form-row">
                                        <textarea class="form-control" name="career_history" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>
                                    <div class="form-buttons my-4">
                                        <button type="submit" class="btn filter-btn">Submit</button>
                                        <a href="{{ route('recruitments.index') }}" type="submit" class="btn btn-cancel">Cancel</a>
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
