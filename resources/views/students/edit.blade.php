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
                            <button class="close-btn">x</button>
                        </div>
                        <div class="search-user">
                            <div class="form-container">
                                <div class="my-3">
                                    <span class="star-color">*</span><span class="label"> <i>Indicates required field</i></span>
                                </div>
                                <form method="POST" action="{{ route('students.update', [$student->id]) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row mt-3">
                                        <div class="form-group">
                                            <label class="label" for="firstName">Student Name<span class="star-color">*</span></label>
                                            <input type="text" id="firstName" class="form-control" value="{{ $student->name }}" name="name">
                                        </div>
                                        <div class="form-group">
                                            <label class="label" for="email">Student Email Address<span class="star-color">*</span></label>
                                            <input type="email" name="email" class="form-control" value="{{ $student->email }}" id="email">
                                        </div>

                                        <div class="form-group">
                                            <label class="label" for="middleName">Home Address:<span class="star-color">*</span></label>
                                            <input type="text" name="address" value="{{ $student->address }}" class="form-control" id="address">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="label" for="nationality">Nationality:<span class="star-color">*</span></label>
                                            <input type="text" name="nationality" value="{{ $student->address }}" class="form-control" id="nationality">
                                        </div>
                                        <div class="form-group">
                                            <label class="label" for="phone_no">Preferred Contact Number:<span class="star-color">*</span></label>
                                            <input type="text" name="phone_no" value="{{ $student->phone_no }}" class="form-control" id="phone_no">
                                        </div>
                                        <div class="form-group">
                                            <label class="label" for="phone_no">Date Of Birth:<span class="star-color">*</span></label>
                                            <input type="date" name="date_of_birth" value="{{ $student->date_of_birth }}" class="form-control" id="date_of_birth">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="label">Gender:<span class="star-color">*</span></label>
                                            <div class="radio-btn">
                                            <input type="radio" id="male" name="gender" value="1" {{ $student->gender == 1 ? 'checked' : '' }}>
                                                <label class="label" for="male">Male</label>
                                                <input type="radio" id="female" name="gender" value="2" {{ $student->gender == 2 ? 'checked' : '' }}>
                                                <label class="label" for="female">Female</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="label" for="passport">Course Applied For:<span class="star-color">*</span></label>
                                            <select name="course_id[]" id="course-select" class="js-select2 form-control" multiple="multiple">
                                                @foreach ($courses as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ in_array($item->id, $selectedCourses) ? 'selected' : '' }}>
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                        <label class="label">Intake:<span class="star-color">*</span></label>
                                        <select name="intake" class="form-control">
                                            <option disabled>--Select One--</option>
                                            <option value="January" {{ $student->intake === 'January' ? 'selected' : '' }}>January</option>
                                            <option value="February" {{ $student->intake === 'February' ? 'selected' : '' }}>February</option>
                                            <option value="March" {{ $student->intake === 'March' ? 'selected' : '' }}>March</option>
                                            <option value="April" {{ $student->intake === 'April' ? 'selected' : '' }}>April</option>
                                            <option value="May" {{ $student->intake === 'May' ? 'selected' : '' }}>May</option>
                                            <option value="June" {{ $student->intake === 'June' ? 'selected' : '' }}>June</option>
                                            <option value="July" {{ $student->intake === 'July' ? 'selected' : '' }}>July</option>
                                            <option value="August" {{ $student->intake === 'August' ? 'selected' : '' }}>August</option>
                                            <option value="September" {{ $student->intake === 'September' ? 'selected' : '' }}>September</option>
                                            <option value="October" {{ $student->intake === 'October' ? 'selected' : '' }}>October</option>
                                            <option value="November" {{ $student->intake === 'November' ? 'selected' : '' }}>November</option>
                                            <option value="December" {{ $student->intake === 'December' ? 'selected' : '' }}>December</option>
                                        </select>
                                    </div>

                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="label" for="passport">Passport Number:</label>
                                            <input type="text" class="form-control" value="{{ $student->passport }}" name="passport" id="text">
                                        </div>
                                        <div class="form-group">
                                            <label class="label" for="cas">Previous CAS:</label>
                                            <input type="text" class="form-control" value="{{ $student->previous_cas }}" name="previous_cas" id="text">
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
                                        <textarea class="form-control" name="academic_history" id="exampleFormControlTextarea1" rows="3">{{ $student->academic_history }}</textarea>
                                    </div>
                                    <div class="my-2">
                                        <h4 class="address">
                                            Work Experience
                                        </h4>
                                    </div>
                                    <div class="form-row">
                                        <textarea class="form-control" name="work_experience" id="exampleFormControlTextarea1" rows="3">{{ $student->work_experience }}</textarea>
                                    </div>
                                    <div class="my-2">
                                        <h4 class="address">
                                            Travel History
                                        </h4>
                                    </div>

                                    <div class="form-row">
                                        <textarea class="form-control" name="travel_history" id="exampleFormControlTextarea1" rows="3">{{ $student->travel_history }}</textarea>
                                    </div>

                                    <div class="my-2">
                                        <h4 class="address">
                                            Extra Notes
                                        </h4>
                                    </div>

                                    <div class="form-row">
                                        <textarea class="form-control" name="notes" id="exampleFormControlTextarea1" rows="3">{{ $student->notes }}</textarea>
                                    </div>

                                    <div class="form-row hide-row">
                                        <div class="form-group col-md-4">
                                            <label class="label">Traveling Alone:<span class="star-color">*</span></label>
                                            <div class="radio-btn">
                                                <input type="radio" id="traveling-yes" name="traveling" value="travelingYes">
                                                <label for="traveling-yes">Yes</label>
                                                <input type="radio" id="traveling-no" name="traveling" value="travelingNo">
                                                <label for="traveling-no">No</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row hide-row">
                                        <div class="form-group col-md-4">
                                            <label class="label">How Many Dependents:</label>
                                            <input type="number" class="form-control" value="{{ $student->dependant_no }}" name="dependant_no" id="dependants-number">
                                        </div>
                                    </div>

                                    <div class="form-row hide-row">
                                        <div class="form-group col-md-4">
                                            <label class="label" for="passport">Dependents:<span class="star-color">*</span></label>
                                            <select name="dependant_id[]" class="js-select2" class="form-control" multiple="multiple" id="dependants-select">
                                                @foreach ($dependants as $item)
                                                <option value="{{ $item->id }}"
                                                        {{ in_array($item->id, $selectedDependants) ? 'selected' : '' }}>
                                                        {{ $item->name }}
                                                    </option>
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
                                                        <input type="file" id="file1" name="passport_doc[]" accept="application/pdf" class="file file_style form-control"
                                                            onchange="displayFileNames(this)" data-file-name="file-name1" multiple>
                                                        <label for="file1" class="custom-file-upload">
                                                            <i aria-hidden="true" class="fa fa-upload"></i> Upload Files
                                                        </label>
                                                        <span id="file-name1" class="ms-2 label file-names-display" style="word-break: break-all;">No Files Chosen.</span>
                                                    </div>

                                                    <div class="col-md-12 mt-3">
                                                        <label for="file2" class="pe-1 file-docs label">BRP:</label>
                                                        <input type="file" id="file2" name="brp_doc[]" accept="application/pdf" class="file file_style form-control"
                                                            onchange="displayFileNames(this)" data-file-name="file-name2" multiple>
                                                        <label for="file2" class="custom-file-upload">
                                                            <i aria-hidden="true" class="fa fa-upload"></i> Upload Files
                                                        </label>
                                                        <span id="file-name2" class="ms-2 label file-names-display" style="word-break: break-all;">No Files Chosen.</span>
                                                    </div>


                                                    <div class="col-md-12 mt-3">
                                                        <label for="file3" class="pe-1 file-docs label">Financial Statement(How Many):</label>
                                                        <input type="file" id="file3" name="financial_statement_doc[]" accept="application/pdf" class="file file_style form-control"
                                                            onchange="displayFileNames(this)" data-file-name="file-name3" multiple>
                                                        <label for="file3" class="custom-file-upload">
                                                            <i aria-hidden="true" class="fa fa-upload"></i> Upload a File
                                                        </label>
                                                        <span id="file-name3" class="ms-2 label file-names-display" style="word-break: break-all;">No File Chosen.</span>
                                                    </div>

                                                    <div class="col-md-12 mt-3">
                                                        <label for="file4" class="pe-1 file-docs label">Qualifications:</label>
                                                        <input type="file" id="file4" name="qualification_doc[]" accept="application/pdf" class="file file_style"
                                                            onchange="displayFileNames(this)" data-file-name="file-name4" multiple>
                                                        <label for="file4" class="custom-file-upload">
                                                            <i aria-hidden="true" class="fa fa-upload"></i> Upload a File
                                                        </label>
                                                        <span id="file-name4" class="ms-2 label file-names-display" style="word-break: break-all;">No File Chosen.</span>
                                                    </div>

                                                    <div class="col-md-12 mt-3">
                                                        <label for="file5" class="pe-1 file-docs label">English Language Certificates:</label>
                                                        <input type="file" id="file5" name="lang_doc[]" accept="application/pdf" class="file file_style"
                                                            onchange="displayFileNames(this)" data-file-name="file-name5" multiple>
                                                        <label for="file5" class="custom-file-upload">
                                                            <i aria-hidden="true" class="fa fa-upload"></i> Upload a File
                                                        </label>
                                                        <span id="file-name5" class="ms-2 label file-names-display" style="word-break: break-all;">No File Chosen.</span>
                                                    </div>

                                                    <div class="col-md-12 mt-3">
                                                        <label for="file6" class="pe-1 file-docs label">Miscellaneous Docs:</label>
                                                        <input type="file" id="file6" name="miscellaneous_doc[]" accept="application/pdf" class="file file_style"
                                                            onchange="displayFileNames(this)" data-file-name="file-name6" multiple>
                                                        <label for="file6" class="custom-file-upload">
                                                            <i aria-hidden="true" class="fa fa-upload"></i> Upload a File
                                                        </label>
                                                        <span id="file-name6" class="ms-2 label file-names-display" style="word-break: break-all;">No File Chosen.</span>
                                                    </div>

                                                    <div class="col-md-12 mt-3">
                                                        <label for="file7" class="pe-1 file-docs label">TB Certificate:</label>
                                                        <input type="file" id="file7" name="tb_certificate_doc[]" accept="application/pdf" class="file file_style"
                                                            onchange="displayFileNames(this)" data-file-name="file-name7" multiple>
                                                        <label for="file7" class="custom-file-upload">
                                                            <i aria-hidden="true" class="fa fa-upload"></i> Upload a File
                                                        </label>
                                                        <span id="file-name7" class="ms-2 label file-names-display" style="word-break: break-all;">No File Chosen.</span>
                                                    </div>

                                                    <div class="col-md-12 mt-3">
                                                        <label for="file8" class="pe-1 file-docs label">Previous CAS(If Applicable):</label>
                                                        <input type="file" id="file8" name="previous_cas_doc[]" accept="application/pdf" class="file file_style"
                                                            onchange="displayFileNames(this)" data-file-name="file-name8" multiple>
                                                        <label for="file8" class="custom-file-upload">
                                                            <i aria-hidden="true" class="fa fa-upload"></i> Upload a File
                                                        </label>
                                                        <span id="file-name8" class="ms-2 label file-names-display" style="word-break: break-all;">No File Chosen.</span>
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
    <!-- <hr class="line-bottom"> -->
    <div class="footer">

    </div>
</section>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
@endpush
@endsection
