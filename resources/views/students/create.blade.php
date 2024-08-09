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
                                <span>Add</span>
                            </li>
                        </ul>
                    </breadcrumb>
                </div>
                <div class="user">
                    <div class="container">
                        <div class="user-header">
                            <h4 class="user-role py-3">Add Student</h4>
                            <button class="close-btn">x</button>
                        </div>
                        <div class="search-user">
                            <div class="form-container">
                                <div class="my-3">
                                    <span class="star-color">*</span><span class="label"> <i>Indicates required field</i></span>
                                </div>
                                <form method="POST" action="{{ route('students.insert') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row mt-3">
                                        <div class="form-group">
                                            <label class="label" for="firstName">Student Name<span class="star-color">*</span></label>
                                            <input type="text" id="firstName" class="form-control" name="name" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="label" for="email">Student Email Address<span class="star-color">*</span></label>
                                            <input type="email" name="email" class="form-control" id="email" required>
                                        </div>

                                        <div class="form-group">
                                            <label class="label" for="middleName">Home Address:<span class="star-color">*</span></label>
                                            <input type="text" name="address" class="form-control" id="address">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="label" for="email">Nationality:<span class="star-color">*</span></label>
                                            <input type="text" name="nationality" class="form-control" id="nationality" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="label" for="phone_no">Preferred Contact Number:<span class="star-color">*</span></label>
                                            <input type="text" name="phone_no" class="form-control" id="phone_no" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="label" for="phone_no">Date Of Birth:<span class="star-color">*</span></label>
                                            <input type="date" name="date_of_birth" class="form-control" id="date_of_birth" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="label">Gender:<span class="star-color">*</span></label>
                                            <div class="radio-btn">
                                                <input type="radio" id="male" name="gender" value="1" required>
                                                <label class="label" for="male">Male</label>
                                                <input type="radio" id="female" name="gender" value="2">
                                                <label class="label" for="female">Female</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="label" for="passport">Course Applied For:<span class="star-color">*</span></label>
                                            <select name="course_id[]" id="course-select" class="js-select2 form-control" multiple="multiple">
                                                @foreach ($courses as $item)
                                                <option value="{{ $item->id }}" data-badge>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="label">Intake:<span class="star-color">*</span></label>
                                            <select name="intake">
                                                <option disabled selected>--Select One--</option>
                                                <option value="January">January</option>
                                                <option value="February">February</option>
                                                <option value="March">March</option>
                                                <option value="April">April</option>
                                                <option value="May">May</option>
                                                <option value="June">June</option>
                                                <option value="July">July</option>
                                                <option value="August">August</option>
                                                <option value="September">September</option>
                                                <option value="October">October</option>
                                                <option value="November">November</option>
                                                <option value="December">December</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="label" for="passport">Passport Number:</label>
                                            <input type="text" class="form-control" name="passport" id="text" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="label" for="cas">Previous CAS:</label>
                                            <input type="text" class="form-control" name="previous_cas" id="text" required>
                                        </div>
                                        <div class="form-group">
                                        </div>
                                    </div>

                                    <div class="my-2">
                                        <h4 class="address">
                                            Academic History
                                        </h4>
                                    </div>

                                    <div class="form-row">
                                        <textarea class="form-control" name="academic_history" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>
                                    <div class="my-2">
                                        <h4 class="address">
                                            Work Experience
                                        </h4>
                                    </div>
                                    <div class="form-row">
                                        <textarea class="form-control" name="work_experience" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>
                                    <div class="my-2">
                                        <h4 class="address">
                                            Travel History
                                        </h4>
                                    </div>

                                    <div class="form-row">
                                        <textarea class="form-control" name="travel_history" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>

                                    <div class="my-2">
                                        <h4 class="address">
                                            Extra Notes
                                        </h4>
                                    </div>

                                    <div class="form-row">
                                        <textarea class="form-control" name="notes" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>

                                    <div class="form-row hide-row">
                                        <div class="form-group col-md-4">
                                            <label class="label">Traveling Alone:<span class="star-color">*</span></label>
                                            <div class="radio-btn">
                                                <input type="radio" id="traveling-yes" name="traveling" value="travelingYes" required>
                                                <label for="traveling-yes">Yes</label>
                                                <input type="radio" id="traveling-no" name="traveling" value="travelingNo">
                                                <label for="traveling-no">No</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row hide-row">
                                        <div class="form-group col-md-4">
                                            <label class="label">How Many Dependents:<span class="star-color">*</span></label>
                                            <input type="number" class="form-control" name="dependant_no" id="dependants-number" required>
                                        </div>
                                    </div>

                                    <div class="form-row hide-row">
                                        <div class="form-group col-md-4">
                                            <label class="label" for="passport">Dependents:<span class="star-color">*</span></label>
                                            <select name="dependant_id[]" class="js-select2" class="form-control" multiple="multiple" id="dependants-select">
                                                @foreach ($dependants as $item)
                                                <option value="{{ $item->id }}" data-badge>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Upload documents -->
                                    <div class="container-fluid mt-3">
                                        <div class="panel">
                                            <strong class="sub-title">Documents to be submitted as part of the visa application: </strong>
                                            <div class="collapse-div mb-3">
                                                <div class="row extra-padding">

                                                    <div class="col-md-12 mt-1">
                                                        <label for="file1" class="pe-1 file-docs label">Passport:</label>
                                                        <input type="file" id="file1" name="passport_doc" accept="application/pdf" class="file file_style form-control" onchange="displayFileName(this)" data-file-name="file-name1">
                                                        <label for="file1" class="custom-file-upload">
                                                            <i aria-hidden="true" class="fa fa-upload"></i> Upload a File
                                                        </label>
                                                        <span id="file-name1" class="ms-2 label" style="word-break: break-all;">No File Chosen.</span>
                                                    </div>

                                                    <div class="col-md-12 mt-3">
                                                        <label for="file2" class="pe-1 file-docs label">BRP:</label>
                                                        <input type="file" id="file2" name="brp_doc" accept="application/pdf" class="file file_style" onchange="displayFileName(this)" data-file-name="file-name2">
                                                        <label for="file2" class="custom-file-upload">
                                                            <i aria-hidden="true" class="fa fa-upload"></i> Upload a File
                                                        </label>
                                                        <span id="file-name2" class="ms-2 label" style="word-break: break-all;">No File Chosen.</span>
                                                    </div>

                                                    <div class="col-md-12 mt-3">
                                                        <label for="file3" class="pe-1 file-docs label">Financial Statement(How Many):</label>
                                                        <input type="file" id="file3" name="financial_statement_doc" accept="application/pdf" class="file file_style" onchange="displayFileName(this)" data-file-name="file-name3">
                                                        <label for="file3" class="custom-file-upload">
                                                            <i aria-hidden="true" class="fa fa-upload"></i> Upload a File
                                                        </label>
                                                        <span id="file-name3" class="ms-2 label" style="word-break: break-all;">No File Chosen.</span>
                                                    </div>

                                                    <div class="col-md-12 mt-3">
                                                        <label for="file4" class="pe-1 file-docs label">Qualifications:</label>
                                                        <input type="file" id="file4" name="qualification_doc" accept="application/pdf" class="file file_style" onchange="displayFileName(this)" data-file-name="file-name4">
                                                        <label for="file4" class="custom-file-upload">
                                                            <i aria-hidden="true" class="fa fa-upload"></i> Upload a File
                                                        </label>
                                                        <span id="file-name4" class="ms-2 label" style="word-break: break-all;">No File Chosen.</span>
                                                    </div>

                                                    <div class="col-md-12 mt-3">
                                                        <label for="file5" class="pe-1 file-docs label">English Language Certificates:</label>
                                                        <input type="file" id="file5" name="lang_doc" accept="application/pdf" class="file file_style" onchange="displayFileName(this)" data-file-name="file-name5">
                                                        <label for="file5" class="custom-file-upload">
                                                            <i aria-hidden="true" class="fa fa-upload"></i> Upload a File
                                                        </label>
                                                        <span id="file-name5" class="ms-2 label" style="word-break: break-all;">No File Chosen.</span>
                                                    </div>

                                                    <div class="col-md-12 mt-3">
                                                        <label for="file6" class="pe-1 file-docs label">Miscellaneous Docs:</label>
                                                        <input type="file" id="file6" name="miscellaneous_doc" accept="application/pdf" class="file file_style" onchange="displayFileName(this)" data-file-name="file-name6">
                                                        <label for="file6" class="custom-file-upload">
                                                            <i aria-hidden="true" class="fa fa-upload"></i> Upload a File
                                                        </label>
                                                        <span id="file-name6" class="ms-2 label" style="word-break: break-all;">No File Chosen.</span>
                                                    </div>

                                                    <div class="col-md-12 mt-3">
                                                        <label for="file7" class="pe-1 file-docs label">TB Certificate:</label>
                                                        <input type="file" id="file7" name="tb_certificate_doc" accept="application/pdf" class="file file_style" onchange="displayFileName(this)" data-file-name="file-name7">
                                                        <label for="file7" class="custom-file-upload">
                                                            <i aria-hidden="true" class="fa fa-upload"></i> Upload a File
                                                        </label>
                                                        <span id="file-name7" class="ms-2 label" style="word-break: break-all;">No File Chosen.</span>
                                                    </div>

                                                    <div class="col-md-12 mt-3">
                                                        <label for="file8" class="pe-1 file-docs label">Previous CAS(If Applicable):</label>
                                                        <input type="file" id="file8" name="previous_cas_doc" accept="application/pdf" class="file file_style" onchange="displayFileName(this)" data-file-name="file-name8">
                                                        <label for="file8" class="custom-file-upload">
                                                            <i aria-hidden="true" class="fa fa-upload"></i> Upload a File
                                                        </label>
                                                        <span id="file-name8" class="ms-2 label" style="word-break: break-all;">No File Chosen.</span>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-buttons my-4">
                                        <button type="submit" class="btn filter-btn">Submit</button>
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
</section>

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
    function displayFileName(input) {
        const fileNameId = input.getAttribute('data-file-name');
        const fileNameSpan = document.getElementById(fileNameId);

        if (input.files && input.files.length > 0) {
            fileNameSpan.textContent = input.files[0].name;
        } else {
            fileNameSpan.textContent = '';
        }
    }
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

@endpush
@endsection
