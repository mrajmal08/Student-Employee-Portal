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
                                <a role="button">Students</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span>Update</span>
                            </li>
                        </ul>
                    </breadcrumb>
                </div>
                <div class="user">
                    <div class="container">
                        <div class="user-header">
                            <h4 class="user-role py-3">Update Student</h4>
                            <a href="{{ route('students.index') }}" class="close-btn">x</a>
                        </div>
                        <div class="search-user">
                            <div class="form-container">
                                <div class="my-3">
                                    <span class="star-color">*</span><span class="label"> <i>Indicates required field</i></span>
                                </div>

                                <form method="POST" action="{{ route('students.update_student', [$student->id]) }}">
                                    @csrf

                                    <div class="form-row mt-3">
                                        <div class="form-group">
                                            <label class="label" for="name">Student Name<span class="star-color">*</span></label>
                                            <input type="text" id="name" class="form-control" name="name" value="{{ $student->name }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="label" for="email">Student Email Address<span class="star-color">*</span></label>
                                            <input type="email" name="email" class="form-control" id="email" value="{{ $student->email }}">
                                        </div>

                                        <div class="form-group">
                                            <label class="label" for="nationality">Nationality:<span class="star-color">*</span></label>
                                            <input type="text" name="nationality" class="form-control" id="nationality" value="{{ $student->nationality }}">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="label" for="phone_no">Preferred Contact Number:<span class="star-color">*</span></label>
                                            <input type="text" name="phone_no" class="form-control" id="phone_no" value="{{ $student->phone_no }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="label" for="phone_no">Date Of Birth:</label>
                                            <input type="date" name="date_of_birth" class="form-control" id="date_of_birth" value="{{ $student->date_of_birth }}">
                                        </div>

                                        <div class="form-group">
                                        <label class="label">Gender:<span class="star-color">*</span></label>
                                            <div class="radio-btn">
                                                <input type="radio" id="male" name="gender" value="1" {{ $student->gender == 1 ? 'checked' : '' }}>
                                                <label class="label" for="male">Male</label>
                                                <input type="radio" id="female" name="gender" value="2" {{ $student->gender == 2 ? 'checked' : '' }}>
                                                <label class="label" for="female">Female</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">

                                        <div class="form-group">
                                            <label class="label" for="passport">Passport Number:</label>
                                            <input type="text" class="form-control" name="passport" id="text" value="{{ $student->passport }}">
                                        </div>
                                        <div class="form-group">
                                        <label class="label">Status:<span class="star-color">*</span></label>
                                            <select name="status_id" id="status_id" class="form-control">
                                                <option disabled {{ empty($student->status_id) ? 'selected' : '' }}>--Select One--</option>
                                                @foreach ($status as $item)
                                                <option value="{{ $item->id }}" {{ $student->status_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">

                                        </div>
                                    </div>

                                    <div class="form-row mt-3">
                                        <div class="form-group">
                                            <label class="label" for="address">Address Line 1:<span class="star-color">*</span></label>
                                            <input type="text" id="address" class="form-control" name="address" value="{{ $student->address }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="label" for="address2">Address Line 2:</label>
                                            <input type="text" name="address2" class="form-control" id="address2" value="{{ $student->address2 }}">
                                        </div>

                                        <div class="form-group">
                                            <label class="label" for="middleName">City:<span class="star-color">*</span></label>
                                            <input type="text" name="city" class="form-control" id="city" value="{{ $student->city }}">
                                        </div>
                                    </div>
                                    <div class="form-row mt-3">
                                        <div class="form-group">
                                            <label class="label" for="county">County:</label>
                                            <input type="text" id="county" class="form-control" name="county" value="{{ $student->county }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="label" for="post_code">Post Code:<span class="star-color">*</span></label>
                                            <input type="text" name="post_code" class="form-control" id="post_code" value="{{ $student->post_code }}">
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
    <div class="footer">
    </div>


    <!-- Modal -->
    <div class="modal fade" id="addAgent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form method="POST" action="{{ route('recruitments.insert') }}">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Recruitment Agent</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="my-3">
                            <span class="star-color">*</span><span class="label"> <i>Indicates required field</i></span>
                        </div>
                        <div class="form-row mt-3">
                            <div class="form-group">
                                <label class="label" for="name">Name Of Agent:<span class="star-color">*</span></label>
                                <input type="text" class="form-control" id="name" name="name">
                                <input type="hidden" class="form-control" id="name" value="stundet form" name="student_form">
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
                                <label class="label" for="payment_method_add">Payment Method:<span class="star-color">*</span></label>
                                <select id="payment_method_add" class="form-control" name="payment_method">
                                    <option default selected>--Select One--</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Bank Account">Bank Account</option>
                                    <option value="Paypal">Paypal</option>
                                </select>
                            </div>
                            <div class="form-group" id="account_name_group_add" style="display: none;">
                                <label class="label" for="account_name">Account Name:</label>
                                <input type="text" class="form-control" name="account_name" id="account_name">
                            </div>
                            <div class="form-group" id="account_number_group_add" style="display: none;">
                                <label class="label" for="account_number">Account Number:</label>
                                <input type="text" class="form-control" name="account_number" id="account_number">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="label" for="institutions">Institutions:</label>
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
                                Career History
                            </h4>
                        </div>
                        <div class="form-row">
                            <textarea class="form-control" name="career_history" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center w-100">
                        <button type="submit" class="btn filter-btn" data-bs-dismiss="modal">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


</section>


<script>
    $(document).ready(function() {
        // On dropdown selection change
        $('#agent_id').change(function() {
            // Get the selected option data
            var selectedOption = $(this).find('option:selected');
            var name = selectedOption.data('name');
            var directors = selectedOption.data('directors');
            var companyRegisterNumber = selectedOption.data('company-register-number');
            var dateOfRegistration = selectedOption.data('date-of-registration');
            var accountName = selectedOption.data('account-name');
            var accountNumber = selectedOption.data('account-number');
            var institutions = selectedOption.data('institutions');
            var careerHistory = selectedOption.data('career-history');
            var addressUK = selectedOption.data('address-uk');
            var address = selectedOption.data('address');
            var complianceCheck = selectedOption.data('compliance-check');
            var paymentMethod = selectedOption.data('payment-method');
            var agentId = selectedOption.val();

            // Update form fields with the selected data
            $('#name').val(name);
            $('#directors').val(directors);
            $('#company_register_number').val(companyRegisterNumber);
            $('#date_of_registration').val(dateOfRegistration);
            $('#account_name').val(accountName);
            $('#account_number').val(accountNumber);
            $('#institutions').val(institutions);
            $('#career_history').val(careerHistory);
            $('#address_uk').val(addressUK);
            $('#address').val(address);
            $('#agent_id_hidden').val(agentId);
            $('#payment_method').val(paymentMethod);


            if (complianceCheck === 'Yes') {
                $('#yes').prop('checked', true);
            } else if (complianceCheck === 'No') {
                $('#no').prop('checked', true);
            }

        });

        // Open Modal on Button Click
        $('#openModalBtn').click(function() {
            $('#exampleModal').modal('show');
        });
    });
</script>

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
        $('#payment_method').trigger('change');

        $('#payment_method_add').on('change', function() {
            var selectedValue = $(this).val();
            if (selectedValue === 'Bank Account' || selectedValue === 'Paypal') {
                $('#account_name_group_add').show();
                $('#account_number_group_add').show();
            } else {
                $('#account_name_group_add').hide();
                $('#account_number_group_add').hide();
            }
        });
        $('#payment_method_add').trigger('change');

    });
</script>


<script>
    $(document).ready(function() {

        $('#preferred_method_yes').prop('checked', true);
        $('#preferred_method_no').prop('disabled', false);
        $('#agent_id').prop('disabled', true);
        $('#referral').prop('disabled', true);
        $('#stakeholder').prop('disabled', true);
        $('.btnHide').prop('disabled', true);

        $('#preferred_method_yes').on('change', function() {
            if ($(this).is(':checked')) {
                $('#preferred_method_no').prop('disabled', false);
                $('#agent_id').prop('disabled', true);
                $('#referral').prop('disabled', true);
                $('#stakeholder').prop('disabled', true);
                $('.btnHide').prop('disabled', true);
            }
        });

        $('#preferred_method_no').on('change', function() {
            if ($(this).is(':checked')) {
                $('#preferred_method_no').prop('disabled', false);
                $('#agent_id').prop('disabled', false);
                $('#referral').prop('disabled', false);
                $('#stakeholder').prop('disabled', false);
                $('.btnHide').prop('disabled', false);
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#name').on('input', function() {
            $('#get_student').val($(this).val());
        });
    });
    $('#intake_select').on('change', function() {
        $('#get_intake').val($(this).val());
    });
</script>

<script>
    function displayFileNames(input) {
        const fileNameId = input.getAttribute('data-file-name');
        const fileNameSpan = document.getElementById(fileNameId);
        if (input.files && input.files.length > 0) {
            const fileNames = Array.from(input.files).map(file => file.name).join(' || ');
            fileNameSpan.textContent = fileNames;
        } else {
            fileNameSpan.textContent = 'No Files Chosen.';
        }
    }
</script>

<script>
    (function($) {
        $(function() {

            //  open and close nav
            $('#navbar-toggle').click(function() {
                $('nav ul').slideToggle();
            });

            $('#navbar-toggle').on('click', function() {
                this.classList.toggle('active');
            });

            $('nav ul li a:not(:only-child)').click(function(e) {
                $(this).siblings('.navbar-dropdown').slideToggle("slow");

                $('.navbar-dropdown').not($(this).siblings()).hide("slow");
                e.stopPropagation();
            });

            $('html').click(function() {
                $('.navbar-dropdown').hide();
            });
        });
    })(jQuery);
</script>

<script>
    $(document).ready(function() {
        $('#course-select').on('change', function() {
            const selectedOptions = $(this).find(':selected');
            const selectedValues = selectedOptions.map(function() {
                return $(this).text();
            }).get();

            const containsGraduation = selectedValues.some(value => value.toLowerCase().includes('graduation'));
            if (containsGraduation) {
                $('.hide-row').hide();
            } else {
                $('.hide-row').show();
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Function to enable or disable fields based on radio button selection
        function toggleFields(enable) {
            if (enable) {
                $('#dependants-number').prop('disabled', false).removeClass('disabled-field');
                $('#dependants-select').prop('disabled', false).removeClass('disabled-field');
            } else {
                $('#dependants-number').prop('disabled', true).addClass('disabled-field');
                $('#dependants-select').prop('disabled', true).addClass('disabled-field');
            }
        }

        toggleFields(false);
        $('input[name="traveling"]').change(function() {
            if ($(this).val() === 'travelingYes') {
                toggleFields(true);
            } else {
                toggleFields(false);
            }
        });
    });
</script>

@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
@endpush
@endsection
