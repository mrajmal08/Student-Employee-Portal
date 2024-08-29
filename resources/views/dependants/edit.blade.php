@extends('backend.layouts.app')
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
                                <a role="button">Dependant</a>
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
                            <h4 class="user-role py-3">Update Dependant</h4>
                            <a href="{{ route('dependants.index') }}" class="close-btn">x</a>
                        </div>
                        <div class="search-user">
                            <div class="form-container">
                                <form method="POST" action="{{ route('dependants.update', [$dependant->id]) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row mt-3">
                                        <div class="form-group">
                                            <label class="label" for="name">Name of Dependant:<span style="color: red;">*</span></label>
                                            <input type="text" id="name" name="name" value="{{ $dependant->name }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="label" for="nationality">Nationality of Dependant:<span style="color: red;">*</span></label>
                                            <input type="text" id="nationality" name="nationality" value="{{ $dependant->nationality }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="label" for="date_of_birth">Date Of Birth:<span style="color: red;">*</span></label>
                                            <input type="date" id="date_of_birth" name="date_of_birth" value="{{ $dependant->date_of_birth }}">
                                        </div>
                                    </div>
                                    <div class="form-row mt-3">
                                        <div class="form-group">
                                            <label class="label">Have You Ever Traveled Outside Your Home Country:</label>
                                            <div class="radio-btn">
                                                <input type="radio" id="travel_outside_yes" name="travel_outside" value="yes" {{ $dependant->travel_outside == "yes" ? 'checked' : '' }}>
                                                <label class="label" for="yes">Yes</label>
                                                <input type="radio" id="travel_outside_no" name="travel_outside" value="no" {{ $dependant->travel_outside == "yes" ? 'checked' : '' }}>
                                                <label class="label" for="no">No</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                        </div>
                                        <div class="form-group">
                                        </div>
                                    </div>
                                    <div class="my-2">
                                        <h4 class="address">
                                            Travel History
                                        </h4>
                                    </div>

                                    <div class="form-row">
                                        <textarea class="form-control" name="travel_history" id="travel_history" rows="3">{{ $dependant->travel_history }}</textarea>
                                    </div>

                                    <div class="container-fluid mt-3" style="--bs-gutter-x: 0rem !important;">
                                        <div class="panel">
                                            <strong class="sub-title">Dependants Documents</strong>

                                            <div class="collapse-div mb-3">
                                                <div class="row extra-padding">
                                                    <div class="col-md-12 mt-1">
                                                        <label for="file1" class="pe-1 file-docs label">Financial Documents:</label>
                                                        <input type="file" id="file1" name="financial_doc[]" accept="application/pdf, image/png, image/jpeg, image/jpg, image/webp" class="file file_style form-control"
                                                            onchange="displayFileNames(this)" data-file-name="file-name1" multiple>
                                                        <label for="file1" class="custom-file-upload">
                                                            <i aria-hidden="true" class="fa fa-upload"></i> Upload Files
                                                        </label>
                                                        <span id="file-name1" class="ms-2 label file-names-display" style="word-break: break-all;">No Files Chosen.</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="collapse-div mb-3">
                                                <div class="row extra-padding">
                                                    <div class="col-md-12 mt-1">
                                                        <label for="file2" class="pe-1 file-docs label">Qualification Documents:</label>
                                                        <input type="file" id="file2" name="qualification_doc[]" accept="application/pdf, image/png, image/jpeg, image/jpg, image/webp" class="file file_style form-control"
                                                            onchange="displayFileNames(this)" data-file-name="file-name2" multiple>
                                                        <label for="file2" class="custom-file-upload">
                                                            <i aria-hidden="true" class="fa fa-upload"></i> Upload Files
                                                        </label>
                                                        <span id="file-name2" class="ms-2 label file-names-display" style="word-break: break-all;">No Files Chosen.</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="collapse-div mb-3">
                                                <div class="row extra-padding">
                                                    <div class="col-md-12 mt-1">
                                                        <label for="file3" class="pe-1 file-docs label">Pay Slips:</label>
                                                        <input type="file" id="file3" name="pay_slip[]" accept="application/pdf, image/png, image/jpeg, image/jpg, image/webp" class="file file_style form-control"
                                                            onchange="displayFileNames(this)" data-file-name="file-name3" multiple>
                                                        <label for="file3" class="custom-file-upload">
                                                            <i aria-hidden="true" class="fa fa-upload"></i> Upload Files
                                                        </label>
                                                        <span id="file-name3" class="ms-2 label file-names-display" style="word-break: break-all;">No Files Chosen.</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="collapse-div mb-3">
                                                <div class="row extra-padding">
                                                    <div class="col-md-12 mt-1">
                                                        <label for="file4" class="pe-1 file-docs label">Letter From Employer:</label>
                                                        <input type="file" id="file4" name="employer_letter[]" accept="application/pdf, image/png, image/jpeg, image/jpg, image/webp" class="file file_style form-control"
                                                            onchange="displayFileNames(this)" data-file-name="file-name4" multiple>
                                                        <label for="file4" class="custom-file-upload">
                                                            <i aria-hidden="true" class="fa fa-upload"></i> Upload Files
                                                        </label>
                                                        <span id="file-name4" class="ms-2 label file-names-display" style="word-break: break-all;">No Files Chosen.</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="collapse-div mb-3">
                                                <div class="row extra-padding">
                                                    <div class="col-md-12 mt-1">
                                                        <label for="file5" class="pe-1 file-docs label">Marriage Certificate For Spouse:</label>
                                                        <input type="file" id="file5" name="marriage_certificate[]" accept="application/pdf, image/png, image/jpeg, image/jpg, image/webp" class="file file_style form-control"
                                                            onchange="displayFileNames(this)" data-file-name="file-name5" multiple>
                                                        <label for="file5" class="custom-file-upload">
                                                            <i aria-hidden="true" class="fa fa-upload"></i> Upload Files
                                                        </label>
                                                        <span id="file-name5" class="ms-2 label file-names-display" style="word-break: break-all;">No Files Chosen.</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="collapse-div mb-3">
                                                <div class="row extra-padding">
                                                    <div class="col-md-12 mt-1">
                                                        <label for="file6" class="pe-1 file-docs label">Birth Certificate For Each Child:</label>
                                                        <input type="file" id="file6" name="birth_certificate[]" accept="application/pdf, image/png, image/jpeg, image/jpg, image/webp" class="file file_style form-control"
                                                            onchange="displayFileNames(this)" data-file-name="file-name6" multiple>
                                                        <label for="file6" class="custom-file-upload">
                                                            <i aria-hidden="true" class="fa fa-upload"></i> Upload Files
                                                        </label>
                                                        <span id="file-name6" class="ms-2 label file-names-display" style="word-break: break-all;">No Files Chosen.</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="my-2">
                                        <h4 class="address">
                                            Officer Note:
                                        </h4>
                                        <ul>
                                            <li>
                                                How much maintenance is the student (including dependants) required to show
                                            </li>
                                            <li>
                                                How many bank statements are being submitted
                                            </li>
                                            <li>
                                                Are the bank statements from one bank or different banks
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="form-row">
                                        <textarea class="form-control" name="officer_note" id="officer_note" rows="3">{{ $dependant->officer_note }}</textarea>
                                    </div>

                                    <div class=" text-center my-4">
                                        <button type="submit" class="btn filter-btn">Submit</button>
                                        <a href="{{ route('dependants.index') }}" type="submit" class="btn btn-cancel">Cancel</a>
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
    $(document).ready(function() {
        // Disable the fields on page load
        $('#travel_history').prop('disabled', true);

        // Enable fields when 'before_vignette_yes' is checked
        $('#travel_outside_yes').on('change', function() {
            if ($(this).is(':checked')) {
                $('#travel_history').prop('disabled', false);
            }
        });

        // Disable fields when 'before_vignette_no' is checked
        $('#travel_outside_no').on('change', function() {
            if ($(this).is(':checked')) {
                $('#travel_history').prop('disabled', true);
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

@push('js')
@endpush
@endsection
