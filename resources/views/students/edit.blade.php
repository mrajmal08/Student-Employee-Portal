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
                                <form method="POST" action="{{ route('students.update', [$student->id]) }}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-row mt-3">
                                        <div class="form-group col-md-3"></div>
                                        <div class="form-group col-md-6">
                                            <div class="panel">
                                                <strong class="sub-title"></strong>
                                                <div class="collapse-div mb-3">
                                                    <div class="d-flex flex-column align-items-center">
                                                        <label class="mb-2">Please Choose Preferred Method Of Contact:<span class="star-color">*</span></label>
                                                        <div class="d-flex justify-content-center">
                                                            <input type="radio" id="preferred_method_yes" name="preferred_method" value="direct" {{ $student->preferred_method == "direct" ? 'checked' : '' }}>
                                                            <label for="preferred_method_yes" class="mr-3">Direct</label>
                                                            <input type="radio" id="preferred_method_no" name="preferred_method" value="indirect" {{ $student->preferred_method == "indirect" ? 'checked' : '' }}>
                                                            <label for="preferred_method_no">Indirect</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3"></div>
                                    </div>


                                    <div class="form-row mt-3">
                                        <div class="form-group col-md-4">
                                            <label class="label">Recruitment Agent:</label>
                                            <select name="agent_id" id="agent_id" class="form-control">
                                                <option disabled selected>--Select One--</option>
                                                @if ($student->agent_id)
                                                <?php $recAgent = \App\Models\RecruitmentAgent::where('id', $student->agent_id)->first(); ?>
                                                <option value="{{ $student->agent_id }}" selected>
                                                    {{ $recAgent->name }}
                                                </option>
                                                @endif
                                                @foreach ($recruitmentAgent as $agent)
                                                <option value="{{ $agent->id }}"
                                                    data-name="{{ $agent->name }}"
                                                    data-directors="{{ $agent->directors }}"
                                                    data-company-register-number="{{ $agent->company_register_number }}"
                                                    data-date-of-registration="{{ $agent->date_of_registration }}"
                                                    data-account-name="{{ $agent->account_name }}"
                                                    data-account-number="{{ $agent->account_number }}"
                                                    data-institutions="{{ $agent->institutions }}"
                                                    data-career-history="{{ $agent->career_history }}"
                                                    data-address-uk="{{ $agent->address_uk }}"
                                                    data-address="{{ $agent->address }}"
                                                    data-compliance-check="{{ $agent->compliance_check }}"
                                                    data-payment-method="{{ $agent->payment_method }}">
                                                    {{ $agent->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-4 d-flex align-items-end">
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#addAgent" class="btn btn-agent yellow-color mr-2 btnHide">Add New Agent</button>
                                            <button type="button" id="openModalBtn" class="btn btn-agent grey-color btnHide">View/Edit</button>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <form method="POST" action="">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">View Recruitment Agent</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="my-3">
                                                            <span class="star-color">*</span><span class="label"> <i>Indicates required field</i></span>
                                                        </div>
                                                        <div class="form-row mt-3">
                                                            <div class="form-group">
                                                                <label class="label" for="name">Name Of Agent:<span class="star-color">*</span></label>
                                                                <input type="text" class="form-control" id="name" name="name" value="{{ $recAgent->name }}">
                                                                <input type="hidden" class="form-control" id="student_form" value="stundet form" name="student_form">
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="label" for="directors">List The Name Of All Your Directors:<span class="star-color">*</span></label>
                                                                <input type="text" class="form-control" name="directors" id="directors" value="{{ $recAgent->directors }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="label" for="company_register_number">Company Register Number:<span class="star-color">*</span></label>
                                                                <input type="text" class="form-control" name="company_register_number" id="company_register_number" value="{{ $recAgent->company_register_number }}">
                                                            </div>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="form-group col-md-4">
                                                                <label class="label" for="date_of_registration">Date Of Registration:<span class="star-color">*</span></label>
                                                                <input type="date" class="form-control" name="date_of_registration" id="date_of_registration" value="{{ $recAgent->date_of_registration }}">
                                                            </div>

                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-4">
                                                                <label class="label" for="payment_method">Payment Method:<span class="star-color">*</span></label>
                                                                <select id="payment_method" class="form-control" name="payment_method">
                                                                    <option default selected>--Select One--</option>
                                                                    <option value="" disabled>--Select One--</option>
                                                                    <option value="Cash" {{ $recAgent->payment_method == 'Cash' ? 'selected' : '' }}>Cash</option>
                                                                    <option value="Bank Account" {{ $recAgent->payment_method == 'Bank Account' ? 'selected' : '' }}>Bank Account</option>
                                                                    <option value="Paypal" {{ $recAgent->payment_method == 'Paypal' ? 'selected' : '' }}>Paypal</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group" id="account_name_group" style="display: none;">
                                                                <label class="label" for="account_name">Account Name:</label>
                                                                <input type="text" class="form-control" name="account_name" id="account_name" value="{{ $recAgent->account_name }}">
                                                            </div>
                                                            <div class="form-group" id="account_number_group" style="display: none;">
                                                                <label class="label" for="account_number">Account Number:</label>
                                                                <input type="text" class="form-control" name="account_number" id="account_number" value="{{ $recAgent->account_number }}">
                                                            </div>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="form-group">
                                                                <label class="label" for="institutions">Institutions:</label>
                                                                <input type="text" class="form-control" name="institutions" id="institutions" value="{{ $recAgent->institutions }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="label" for="address_uk">Address In UK:</label>
                                                                <input type="text" class="form-control" name="address_uk" id="address_uk" value="{{ $recAgent->address_uk }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="label" for="address">Address If Company Not In UK:</label>
                                                                <input type="text" class="form-control" name="address" id="address" value="{{ $recAgent->address }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-4">
                                                                <label class="label">Compliance Check:</label>
                                                                <div class="radio-btn">
                                                                    <input type="radio" id="yes" name="compliance_check" value="Yes" {{ $recAgent->compliance_check == "Yes" ? 'checked' : '' }}>
                                                                    <label class="label" for="yes">Yes</label>
                                                                    <input type="radio" id="no" name="compliance_check" value="No" {{ $recAgent->compliance_check == "No" ? 'checked' : '' }}>
                                                                    <label class="label" for="no">No</label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="my-2">
                                                            <h4 class="address">
                                                                Career History
                                                            </h4>
                                                        </div>
                                                        <div class="form-row">
                                                            <textarea class="form-control" name="career_history" id="career_history" rows="3">{{ $recAgent->career_history }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer d-flex justify-content-center w-100">
                                                        <button type="submit" class="btn filter-btn" data-bs-dismiss="modal">Submit</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row mt-3">
                                        <div class="form-group col-md-4">
                                            <label class="label" for="email">Referral</label>
                                            <input type="text" name="referral" class="form-control" value="{{ $student->referral }}" id="referral">
                                        </div>
                                    </div>
                                    <div class="form-row mt-3">
                                        <div class="form-group col-md-4">
                                            <label class="label" for="middleName">Other Stakeholder:</label>
                                            <input type="text" name="stakeholder" class="form-control" value="{{ $student->stakeholder }}" id="stakeholder">
                                        </div>
                                    </div>

                                    <div class="form-row mt-3">
                                        <div class="form-group">
                                            <label class="label" for="name">Student Name<span class="star-color">*</span></label>
                                            <input type="text" id="name" class="form-control" value="{{ $student->name }}" name="name">
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
                                            <select name="intake" id="intake_select" class="form-control">
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

                                    <div class="container-fluid mt-3">
                                        <div class="panel">
                                            <strong class="sub-title">Screener: </strong>
                                            <div class="collapse-div mb-3">
                                                <div class="row extra-padding">
                                                    <div class="form-row mt-3">
                                                        <div class="form-group">
                                                            <label class="label" for="get_student">Student:</span></label>
                                                            <input type="text" id="get_student" class="form-control" value="{{ $student->name }}" disabled>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="label" for="email">Intake:</span></label>
                                                            <input type="text" class="form-control" id="get_intake" value="{{ $student->intake }}" disabled>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="label" for="middleName">Screened By:</span></label>
                                                            <input type="text" name="screened_by" class="form-control" value="{{ $student->screened_by }}" id="screened_by">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-buttons my-4">
                                        <button type="submit" class="btn filter-btn">Submit</button>
                                        <a href="{{ route('students.index') }}" type="submit" class="btn btn-cancel">Create</a>
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

    <!-- Modal -->
    <div id="exampleModalView{{ $agent->id }}" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form method="" action="">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">View Recruitment Agent {{ $agent->name }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="my-3">
                            <span class="star-color">*</span><span class="label"> <i>Indicates required field</i></span>
                        </div>
                        <div class="form-row mt-3">
                            <div class="form-group">
                                <label class="label" for="name">Name Of Agent:<span class="star-color">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $agent->name }}">
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
