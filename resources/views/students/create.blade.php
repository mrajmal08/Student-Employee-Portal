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
                <div class="my-3 ms-0">
                    <breadcrumb>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a role="button">Students</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a>Edit</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span>{{ $student->id }}</span>
                            </li>
                        </ul>
                    </breadcrumb>
                    <div class="float-right">
                        Student Name: <a href="{{ route('students.view', [$student->id]) }}" style="color: #2fa953;">{{ $student->name }}</a>
                    </div>
                </div>

                <div class="media user-info-case title-bar mt-3 d-flex"><img alt="patient-profile" src="https://nasir.ovadadme.org/assets/images/avatar.jpg" class="user-img">
                    <div class="media-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="mt-4">
                                    <span class="font-500">{{ $student->name }}</span>
                                    <small>
                                        <span>(</span>
                                        {{ \Carbon\Carbon::parse($student->date_of_birth)->age  }} years Old <span class="line-space">|</span>
                                        <span> DOB: {{ $student->date_of_birth }}</span>
                                        <span class="line-space">|</span>
                                        {{ $student->gender == 1 ? 'Male' : 'Female'  }} <span>)</span>
                                    </small><span class="font-style"> Nationality:</span>
                                    <span class="font-style-description"> {{ $student->nationality }} </span>
                                    <span class="font-style">Passport No:</span>
                                    <span class="font-style-description description ps-1">{{ $student->passport }}</span>
                                </h5>
                            </div>
                            <div class="col-md-12 mt-2">
                                <ul>
                                    <li><i class="fa fa-phone ms-1" style="font-size: 14px;"></i><span> {{ $student->phone_no }}</span></li>
                                    <li><i class="fa fa-map-marker ms-1" style="font-size: 14px;"></i>
                                        <span class="font-style-description">{{ $student->address }}, {{ $student->address2 }}, {{ $student->city }}, {{ $student->county }}, {{ $student->post_code }}</span>
                                    </li>
                                    <li><i class="bi bi-envelope-fill" style="font-size: 15px; top: 2px; position: relative;"></i><span> {{ $student->email }} </span></li>
                                    <li><i class="fa fa-pencil-square ms-1" style="font-size: 14px;"></i><span class="font-style-description description"> {{ $student->previous_cas }}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="">
                    <ul class="nav nav-pills mb-3 " id="pills-tab" role="tablist">
                        <li class="nav-item pr-3" role="presentation">
                            <button class="nav-link active" id="pills-case-tab" data-bs-toggle="pill" data-bs-target="#pills-case" type="button" role="tab" aria-controls="pills-case" aria-selected="true">Case</button>
                        </li>
                        <li class="nav-item pr-3" role="presentation">
                            <button class="nav-link" id="pills-studentInfo-tab" data-bs-toggle="pill" data-bs-target="#pills-studentInfo" type="button" role="tab" aria-controls="pills-studentInfo" aria-selected="false">Student Info</button>
                        </li>
                        <li class="nav-item pr-3" role="presentation">
                            <button class="nav-link" id="pills-dependant-tab" data-bs-toggle="pill" data-bs-target="#pills-dependant" type="button" role="tab" aria-controls="pills-dependant" aria-selected="false">Dependants</button>
                        </li>
                        <li class="nav-item pr-3" role="presentation">
                            <button class="nav-link" id="pills-previous-tab" data-bs-toggle="pill" data-bs-target="#pills-previous" type="button" role="tab" aria-controls="pills-previous" aria-selected="false">Previous Info</button>
                        </li>
                        <li class="nav-item pr-3" role="presentation">
                            <button class="nav-link" id="pills-referrer-tab" data-bs-toggle="pill" data-bs-target="#pills-referrer" type="button" role="tab" aria-controls="pills-referrer" aria-selected="false">Referrer</button>
                        </li>
                        <li class="nav-item pr-3" role="presentation">
                            <button class="nav-link" id="pills-docs-tab" data-bs-toggle="pill" data-bs-target="#pills-docs" type="button" role="tab" aria-controls="pills-docs" aria-selected="false">Docs</button>
                        </li>
                        <li class="nav-item pr-3" role="presentation">
                            <button class="nav-link" id="pills-verifier-tab" data-bs-toggle="pill" data-bs-target="#pills-verifier" type="button" role="tab" aria-controls="pills-verifier" aria-selected="false">Verifier</button>
                        </li>
                        <li class="nav-item pr-3" role="presentation">
                            <button class="nav-link" id="pills-view-tab" data-bs-toggle="pill" data-bs-target="#pills-view" type="button" role="tab" aria-controls="pills-view" aria-selected="false">View All</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">


                        <!-- Case Information -->
                        <div class="tab-pane fade show active" id="pills-case" role="tabpanel" aria-labelledby="pills-case-tab" tabindex="0">

                            <div class="user pt-4">
                                <div class="">
                                    <div class="user-header">
                                        <h4 class="user-role py-3">Case Information</h4>
                                        <a href="{{ route('students.index') }}" class="close-btn"></a>
                                    </div>
                                    <div class="search-user">
                                        <div class="container">
                                            <div class="my-3">
                                                <span class="star-color"></span><span class="label"><br> <i></i></span>
                                            </div>
                                            <form method="POST" action="{{ route('students.update' , [$student->id]) }}" enctype="multipart/form-data">
                                                @csrf

                                                <div class="form-row">

                                                    <div class="form-group">
                                                        <label class="label" for="passport">Course Applied For:<span class="star-color">*</span></label>
                                                        <select name="course_id" id="course-select" class="form-control">
                                                            <option disabled {{ empty($student->course_id) ? 'selected' : '' }}>--Select One--</option>
                                                            @foreach ($courses as $item)
                                                            <option value="{{ $item->id }}" {{ $student->course_id == $item->id ? 'selected' : '' }}>
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

                                                <div class="form-row justify-content-center">
                                                    <div class="form-group col-md-6">
                                                        <label class="label" for="cas">Previous CAS:</label>
                                                        <input type="text" class="form-control" name="previous_cas" id="text" value="{{ $student->previous_cas }}">
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

                        <!-- Student Information -->
                        <div class="tab-pane fade" id="pills-studentInfo" role="tabpanel" aria-labelledby="pills-studentInfo-tab" tabindex="0">

                            <div class="user pt-4">
                                <div class="">
                                    <div class="user-header">
                                        <h4 class="user-role py-3">Student</h4>
                                        <a href="{{ route('students.index') }}" class="close-btn"></a>
                                    </div>
                                    <div class="search-user">
                                        <div class="container">
                                            <div class="my-3">
                                                <span class="star-color"></span><span class="label"><br> <i></i></span>
                                            </div>
                                            <form method="POST" action="{{ route('students.update_student', [$student->id]) }}">
                                                @csrf

                                                <div class="form-row mt-3">
                                                    <div class="form-group">
                                                        <label class="label" for="name">Student Name<span class="star-color">*</span></label>
                                                        <input type="text" id="student_name" class="form-control" name="name" value="{{ $student->name }}">
                                                        <input type="hidden" id="tab" class="form-control" name="tab" value="tab">
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

                        <!-- Dependant Information -->
                        <div class="tab-pane fade" id="pills-dependant" role="tabpanel" aria-labelledby="pills-dependant-tab" tabindex="0">

                            <div class="user pt-4">
                                <div class="">
                                    <div class="user-header">
                                        <h4 class="user-role py-3">Dependants</h4>
                                        <a href="{{ route('students.index') }}" class="close-btn"></a>
                                    </div>
                                    <div class="search-user">
                                        <div class="container">
                                            <div class="my-3">
                                                <span class="star-color"></span><span class="label"><br> <i></i></span>
                                            </div>
                                            <form method="POST" action="{{ route('students.update' , [$student->id]) }}" enctype="multipart/form-data">
                                                @csrf

                                                <div class="form-row hide-row">
                                                    <div class="form-group col-md-4">
                                                        <label class="label">Traveling Alone:<span class="star-color">*</span></label>
                                                        <div class="radio-btn">
                                                            <input type="radio" id="traveling-yes" name="traveling_alone" value="Yes" {{ $student->traveling_alone == "Yes" ? 'checked' : '' }}>
                                                            <label for="traveling-yes">Yes</label>
                                                            <input type="radio" id="traveling-no" name="traveling_alone" value="No" {{ $student->traveling_alone == "No" ? 'checked' : '' }}>
                                                            <label for="traveling-no">No</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-row hide-row">
                                                    <div class="form-group col-md-4">
                                                        <label class="label">How Many Dependents:</span></label>
                                                        <input type="number" class="form-control" name="dependant_no" id="dependants-number" value="{{ $student->dependant_no }}">
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
                                                <div class="form-buttons my-4">
                                                    <button type="submit" class="btn filter-btn">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Previous Information -->
                        <div class="tab-pane fade" id="pills-previous" role="tabpanel" aria-labelledby="pills-previous-tab" tabindex="0">

                            <div class="user pt-4">
                                <div class="">
                                    <div class="user-header">
                                        <h4 class="user-role py-3">Previous Information</h4>
                                        <a href="{{ route('students.index') }}" class="close-btn"></a>
                                    </div>
                                    <div class="search-user">
                                        <div class="container">
                                            <div class="my-3">
                                                <span class="star-color"></span><span class="label"><br> <i></i></span>
                                            </div>
                                            <form method="POST" action="{{ route('students.update' , [$student->id]) }}">
                                                @csrf

                                                <div class="my-2">
                                                    <h4 class="address">
                                                        Academic History
                                                    </h4>
                                                </div>

                                                <div class="form-row">
                                                    <textarea class="form-control" name="academic_history" id="exampleFormControlTextarea1" rows="3">{{$student->academic_history}}</textarea>
                                                </div>
                                                <div class="my-2">
                                                    <h4 class="address">
                                                        Work Experience
                                                    </h4>
                                                </div>
                                                <div class="form-row">
                                                    <textarea class="form-control" name="work_experience" id="exampleFormControlTextarea1" rows="3">{{$student->work_experience}}</textarea>
                                                </div>
                                                <div class="my-2">
                                                    <h4 class="address">
                                                        Travel History
                                                    </h4>
                                                </div>

                                                <div class="form-row">
                                                    <textarea class="form-control" name="travel_history" id="exampleFormControlTextarea1" rows="3">{{$student->travel_history}}</textarea>
                                                </div>

                                                <div class="my-2">
                                                    <h4 class="address">
                                                        Extra Notes
                                                    </h4>
                                                </div>

                                                <div class="form-row">
                                                    <textarea class="form-control" name="notes" id="exampleFormControlTextarea1" rows="3">{{$student->notes}}</textarea>
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

                        <!-- Referrer Information -->
                        <div class="tab-pane fade" id="pills-referrer" role="tabpanel" aria-labelledby="pills-referrer-tab" tabindex="0">

                            <div class="user pt-4">
                                <div class="">
                                    <div class="user-header">
                                        <h4 class="user-role py-3">Referrer Information</h4>
                                        <a href="{{ route('students.index') }}" class="close-btn"></a>
                                    </div>
                                    <div class="search-user">
                                        <div class="container">
                                            <div class="my-3">
                                                <span class="star-color"></span><span class="label"><br> <i></i></span>
                                            </div>
                                            <form method="POST" action="{{ route('students.update' , [$student->id]) }}">
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
                                                                        <input type="radio" id="preferred_method_yes" name="preferred_method" value="direct">
                                                                        <label for="preferred_method_yes" class="mr-3">Direct</label>
                                                                        <input type="radio" id="preferred_method_no" name="preferred_method" value="indirect">
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
                                                                        <input type="text" class="form-control" id="name" name="name">
                                                                        <input type="hidden" class="form-control" id="student_form" value="stundet form" name="student_form">
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
                                                                        <label class="label" for="address_uk">Address In UK:</label>
                                                                        <input type="text" class="form-control" name="address_uk" id="address_uk">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="label" for="address">Address If Company Not In UK:</label>
                                                                        <input type="text" class="form-control" name="address" id="address">
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-4">
                                                                        <label class="label">Compliance Check:</label>
                                                                        <div class="radio-btn">
                                                                            <input type="radio" id="yes" name="compliance_check" value="Yes">
                                                                            <label class="label" for="yes">Yes</label>
                                                                            <input type="radio" id="no" name="compliance_check" value="No">
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
                                                                    <textarea class="form-control" name="career_history" id="career_history" rows="3"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer d-flex justify-content-center w-100">
                                                                <button type="submit" class="btn filter-btn" data-bs-dismiss="modal">Submit</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-row mt-3">
                                                    <div class="form-group col-md-4">
                                                        <label class="label" for="email">Referral</label>
                                                        <input type="text" name="referral" class="form-control" id="referral" value="{{ $student->referral }}">
                                                    </div>
                                                </div>
                                                <div class="form-row mt-3">
                                                    <div class="form-group col-md-4">
                                                        <label class="label" for="middleName">Other Stakeholder:</label>
                                                        <input type="text" name="stakeholder" class="form-control" id="stakeholder" value="{{ $student->stakeholder }}">
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

                        <!-- Documents Information -->
                        <div class="tab-pane fade" id="pills-docs" role="tabpanel" aria-labelledby="pills-docs-tab" tabindex="0">

                            <div class="user pt-4">
                                <div class="">
                                    <div class="user-header">
                                        <h4 class="user-role py-3">Documents</h4>
                                        <a href="{{ route('students.index') }}" class="close-btn"></a>
                                    </div>
                                    <div class="search-user">
                                        <div class="container">
                                            <div class="my-3">
                                                <span class="star-color"></span><span class="label"><br> <i></i></span>
                                            </div>
                                            <form method="POST" action="{{ route('students.insert') }}" enctype="multipart/form-data">
                                                @csrf

                                                <div class="container-fluid mt-3">
                                                    <div class="panel">
                                                        <strong class="sub-title">Documents to be submitted as part of the visa application: </strong>
                                                        <div class="collapse-div mb-3">
                                                            <div class="row extra-padding">

                                                                <div class="col-md-12 mt-1">
                                                                    <label for="file1" class="pe-1 file-docs label">Passport:</label>
                                                                    <input type="file" id="file1" name="passport_doc[]" accept="application/pdf, image/png, image/jpeg, image/jpg, image/webp" class="file file_style form-control"
                                                                        onchange="displayFileNames(this)" data-file-name="file-name1" multiple>
                                                                    <label for="file1" class="custom-file-upload">
                                                                        <i aria-hidden="true" class="fa fa-upload"></i> Upload Files
                                                                    </label>
                                                                    <span id="file-name1" class="ms-2 label file-names-display" style="word-break: break-all;">No Files Chosen.</span>
                                                                </div>

                                                                <div class="col-md-12 mt-3">
                                                                    <label for="file2" class="pe-1 file-docs label">BRP:</label>
                                                                    <input type="file" id="file2" name="brp_doc[]" accept="application/pdf, image/png, image/jpeg, image/jpg, image/webp" class="file file_style form-control"
                                                                        onchange="displayFileNames(this)" data-file-name="file-name2" multiple>
                                                                    <label for="file2" class="custom-file-upload">
                                                                        <i aria-hidden="true" class="fa fa-upload"></i> Upload Files
                                                                    </label>
                                                                    <span id="file-name2" class="ms-2 label file-names-display" style="word-break: break-all;">No Files Chosen.</span>
                                                                </div>


                                                                <div class="col-md-12 mt-3">
                                                                    <label for="file3" class="pe-1 file-docs label">Financial Statement(How Many):</label>
                                                                    <input type="file" id="file3" name="financial_statement_doc[]" accept="application/pdf, image/png, image/jpeg, image/jpg, image/webp" class="file file_style form-control"
                                                                        onchange="displayFileNames(this)" data-file-name="file-name3" multiple>
                                                                    <label for="file3" class="custom-file-upload">
                                                                        <i aria-hidden="true" class="fa fa-upload"></i> Upload a File
                                                                    </label>
                                                                    <span id="file-name3" class="ms-2 label file-names-display" style="word-break: break-all;">No File Chosen.</span>
                                                                </div>

                                                                <div class="col-md-12 mt-3">
                                                                    <label for="file4" class="pe-1 file-docs label">Qualifications:</label>
                                                                    <input type="file" id="file4" name="qualification_doc[]" accept="application/pdf, image/png, image/jpeg, image/jpg, image/webp" class="file file_style"
                                                                        onchange="displayFileNames(this)" data-file-name="file-name4" multiple>
                                                                    <label for="file4" class="custom-file-upload">
                                                                        <i aria-hidden="true" class="fa fa-upload"></i> Upload a File
                                                                    </label>
                                                                    <span id="file-name4" class="ms-2 label file-names-display" style="word-break: break-all;">No File Chosen.</span>
                                                                </div>

                                                                <div class="col-md-12 mt-3">
                                                                    <label for="file5" class="pe-1 file-docs label">English Language Certificates:</label>
                                                                    <input type="file" id="file5" name="lang_doc[]" accept="application/pdf, image/png, image/jpeg, image/jpg, image/webp" class="file file_style"
                                                                        onchange="displayFileNames(this)" data-file-name="file-name5" multiple>
                                                                    <label for="file5" class="custom-file-upload">
                                                                        <i aria-hidden="true" class="fa fa-upload"></i> Upload a File
                                                                    </label>
                                                                    <span id="file-name5" class="ms-2 label file-names-display" style="word-break: break-all;">No File Chosen.</span>
                                                                </div>

                                                                <div class="col-md-12 mt-3">
                                                                    <label for="file6" class="pe-1 file-docs label">Miscellaneous Docs:</label>
                                                                    <input type="file" id="file6" name="miscellaneous_doc[]" accept="application/pdf, image/png, image/jpeg, image/jpg, image/webp" class="file file_style"
                                                                        onchange="displayFileNames(this)" data-file-name="file-name6" multiple>
                                                                    <label for="file6" class="custom-file-upload">
                                                                        <i aria-hidden="true" class="fa fa-upload"></i> Upload a File
                                                                    </label>
                                                                    <span id="file-name6" class="ms-2 label file-names-display" style="word-break: break-all;">No File Chosen.</span>
                                                                </div>

                                                                <div class="col-md-12 mt-3">
                                                                    <label for="file7" class="pe-1 file-docs label">TB Certificate:</label>
                                                                    <input type="file" id="file7" name="tb_certificate_doc[]" accept="application/pdf, image/png, image/jpeg, image/jpg, image/webp" class="file file_style"
                                                                        onchange="displayFileNames(this)" data-file-name="file-name7" multiple>
                                                                    <label for="file7" class="custom-file-upload">
                                                                        <i aria-hidden="true" class="fa fa-upload"></i> Upload a File
                                                                    </label>
                                                                    <span id="file-name7" class="ms-2 label file-names-display" style="word-break: break-all;">No File Chosen.</span>
                                                                </div>

                                                                <div class="col-md-12 mt-3">
                                                                    <label for="file8" class="pe-1 file-docs label">Previous CAS(If Applicable):</label>
                                                                    <input type="file" id="file8" name="previous_cas_doc[]" accept="application/pdf, image/png, image/jpeg, image/jpg, image/webp" class="file file_style"
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

                        <!-- Verifier Information -->
                        <div class="tab-pane fade" id="pills-verifier" role="tabpanel" aria-labelledby="pills-verifier-tab" tabindex="0">

                            <div class="user pt-4">
                                <div class="">
                                    <div class="user-header">
                                        <h4 class="user-role py-3">Verifier</h4>
                                        <a href="{{ route('students.index') }}" class="close-btn"></a>
                                    </div>
                                    <div class="search-user">
                                        <div class="container">
                                            <div class="my-3">
                                                <span class="star-color"></span><span class="label"><br> <i></i></span>
                                            </div>
                                            <form method="POST" action="{{ route('students.update', [$student->id]) }}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="container-fluid mt-3">
                                                    <div class="panel">
                                                        <strong class="sub-title">Verifier:</strong>
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
                                                                        <input type="text" name="screened_by" class="form-control" id="screened_by" value="{{ $student->screened_by }}">
                                                                    </div>
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

                        <!-- View All Information -->
                        <div class="tab-pane fade" id="pills-view" role="tabpanel" aria-labelledby="pills-view-tab" tabindex="0">

                            <div class="user pt-4">
                                <div class="">
                                    <div class="user-header text-center">
                                        <h4 class="py-3">View All Info</h4>
                                        <a href="{{ route('students.index') }}" class="close-btn"></a>
                                    </div>


                                    <div class="container">
                                        <div class="user pt-4">
                                            <div class="user-header">
                                                <h4 class="py-3">Case Information</h4>
                                                <a href="{{ route('students.index') }}" class="close-btn"></a>
                                            </div>
                                            <div class="search-user">
                                                <div class="container">
                                                    <div class="my-3">
                                                        <span class="star-color"></span><span class="label"><br> <i></i></span>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group">
                                                            <label class="label" for="passport">Course Applied For:<span class="star-color">*</span></label>
                                                            <input type="text" class="form-control" name="course_id" value="{{ \App\Models\Course::where('id', $student->course_id)->value('name') }}" disabled>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="label">Intake:<span class="star-color">*</span></label>
                                                            <input type="text" class="form-control" name="intake_select" value="{{ $student->intake }}" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="form-row justify-content-center">
                                                        <div class="form-group col-md-6">
                                                            <label class="label" for="cas">Previous CAS:</label>
                                                            <input type="text" class="form-control" name="previous_cas" value="{{ $student->previous_cas }}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="container">
                                        <div class="user pt-4">
                                            <div class="user-header">
                                                <h4 class="py-3">Student</h4>
                                                <a href="{{ route('students.index') }}" class="close-btn"></a>
                                            </div>

                                            <div class="search-user">
                                                <div class="container">
                                                    <div class="my-3">
                                                        <span class="star-color"></span><span class="label"><br> <i></i></span>
                                                    </div>

                                                    <div class="form-row mt-3">
                                                        <div class="form-group">
                                                            <label class="label" for="name">Student Name<span class="star-color">*</span></label>
                                                            <input type="text" class="form-control" name="name" value="{{ $student->name }}" disabled>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="label" for="email">Student Email Address<span class="star-color">*</span></label>
                                                            <input type="email" name="email" class="form-control" value="{{ $student->email }}" disabled>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="label" for="nationality">Nationality:<span class="star-color">*</span></label>
                                                            <input type="text" name="nationality" class="form-control" value="{{ $student->nationality }}" disabled>
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="form-group">
                                                            <label class="label" for="phone_no">Preferred Contact Number:<span class="star-color">*</span></label>
                                                            <input type="text" name="phone_no" class="form-control"  value="{{ $student->phone_no }}" disabled>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="label" for="phone_no">Date Of Birth:</label>
                                                            <input type="date" name="date_of_birth" class="form-control" value="{{ $student->date_of_birth }}" disabled>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="label">Gender:<span class="star-color">*</span></label>
                                                            <div class="radio-btn">
                                                                <input type="radio"  name="gender" value="1" {{ $student->gender == 1 ? 'checked' : '' }} disabled>
                                                                <label class="label" for="male">Male</label>
                                                                <input type="radio"  name="gender" value="2" {{ $student->gender == 2 ? 'checked' : '' }} disabled>
                                                                <label class="label" for="female">Female</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-row">

                                                        <div class="form-group">
                                                            <label class="label" for="passport">Passport Number:</label>
                                                            <input type="text" class="form-control" name="passport"  value="{{ $student->passport }}" disabled>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="label">Status:<span class="star-color">*</span></label>
                                                            <input type="text" class="form-control" name="course_id" value="{{ \App\Models\Status::where('id', $student->status_id)->value('name') }}" disabled>
                                                        </div>
                                                        <div class="form-group">

                                                        </div>
                                                    </div>

                                                    <div class="form-row mt-3">
                                                        <div class="form-group">
                                                            <label class="label" for="address">Address Line 1:<span class="star-color">*</span></label>
                                                            <input type="text"  class="form-control" name="address" value="{{ $student->address }}" disabled>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="label" for="address2">Address Line 2:</label>
                                                            <input type="text" name="address2" class="form-control" value="{{ $student->address2 }}" disabled>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="label" for="middleName">City:<span class="star-color">*</span></label>
                                                            <input type="text" name="city" class="form-control"  value="{{ $student->city }}" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        <div class="form-group">
                                                            <label class="label" for="county">County:</label>
                                                            <input type="text"  class="form-control" name="county" value="{{ $student->county }}" disabled>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="label" for="post_code">Post Code:<span class="star-color">*</span></label>
                                                            <input type="text" name="post_code" class="form-control"  value="{{ $student->post_code }}" disabled>
                                                        </div>

                                                        <div class="form-group">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="container">
                                        <div class="user pt-4">
                                            <div class="user-header">
                                                <h4 class="py-3">Dependants</h4>
                                                <a href="{{ route('students.index') }}" class="close-btn"></a>
                                            </div>
                                            <div class="search-user">
                                                <div class="container">
                                                    <div class="my-3">
                                                        <span class="star-color"></span><span class="label"><br> <i></i></span>
                                                    </div>
                                                    <div class="form-row hide-row">
                                                        <div class="form-group col-md-4">
                                                            <label class="label">Traveling Alone:<span class="star-color">*</span></label>
                                                            <div class="radio-btn">
                                                                <input type="radio"  name="traveling_alone" value="Yes" {{ $student->traveling_alone == "Yes" ? 'checked' : '' }} disabled>
                                                                <label for="traveling-yes">Yes</label>
                                                                <input type="radio"  name="traveling_alone" value="No" {{ $student->traveling_alone == "No" ? 'checked' : '' }} disabled>
                                                                <label for="traveling-no">No</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-row hide-row">
                                                        <div class="form-group col-md-4">
                                                            <label class="label">How Many Dependents:</span></label>
                                                            <input type="number" class="form-control" name="dependant_no"  value="{{ $student->dependant_no }}" disabled>
                                                        </div>
                                                    </div>

                                                    <div class="form-row hide-row">
                                                        <div class="form-group col-md-4">
                                                            <label class="label" for="passport">Dependents:<span class="star-color">*</span></label>
                                                            <select name="dependant_id[]" class="js-select2" class="form-control" multiple="multiple" disabled>
                                                                @foreach ($dependants as $item)
                                                                <option value="{{ $item->id }}"
                                                                    {{ in_array($item->id, $selectedDependants) ? 'selected' : '' }}>
                                                                    {{ $item->name }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="container">
                                        <div class="user pt-4">
                                            <div class="user-header">
                                                <h4 class="py-3">Previous Information</h4>
                                                <a href="{{ route('students.index') }}" class="close-btn"></a>
                                            </div>
                                            <div class="search-user">
                                                <div class="container">
                                                    <div class="my-3">
                                                        <span class="star-color"></span><span class="label"><br> <i></i></span>
                                                    </div>

                                                    <div class="my-2">
                                                        <h4 class="address">
                                                            Academic History
                                                        </h4>
                                                    </div>

                                                    <div class="form-row">
                                                        <textarea class="form-control" name="academic_history"  rows="3" disabled>{{$student->academic_history}}</textarea>
                                                    </div>
                                                    <div class="my-2">
                                                        <h4 class="address">
                                                            Work Experience
                                                        </h4>
                                                    </div>
                                                    <div class="form-row">
                                                        <textarea class="form-control" name="work_experience" rows="3" disabled>{{$student->work_experience}}</textarea>
                                                    </div>
                                                    <div class="my-2">
                                                        <h4 class="address">
                                                            Travel History
                                                        </h4>
                                                    </div>

                                                    <div class="form-row">
                                                        <textarea class="form-control" name="travel_history" rows="3" disabled>{{$student->travel_history}}</textarea>
                                                    </div>

                                                    <div class="my-2">
                                                        <h4 class="address">
                                                            Extra Notes
                                                        </h4>
                                                    </div>

                                                    <div class="form-row">
                                                        <textarea class="form-control" name="notes" rows="3" disabled>{{$student->notes}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="container">
                                        <div class="user pt-4">
                                            <div class="user-header">
                                                <h4 class="py-3">Referrer Information</h4>
                                                <a href="{{ route('students.index') }}" class="close-btn"></a>
                                            </div>
                                            <div class="search-user">
                                                <div class="container">
                                                    <div class="my-3">
                                                        <span class="star-color"></span><span class="label"><br> <i></i></span>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        <div class="form-group col-md-3"></div>
                                                        <div class="form-group col-md-6">
                                                            <div class="panel">
                                                                <strong class="sub-title"></strong>
                                                                <div class="collapse-div mb-3">
                                                                    <div class="d-flex flex-column align-items-center">
                                                                        <label class="mb-2">Please Choose Preferred Method Of Contact:<span class="star-color">*</span></label>
                                                                        <div class="d-flex justify-content-center">
                                                                            <input type="radio" name="preferred_method" value="direct" {{ $student->preferred_method == "direct" ? 'checked' : '' }} disabled>
                                                                            <label for="preferred_method_yes" class="mr-3">Direct</label>
                                                                            <input type="radio" name="preferred_method" value="indirect" {{ $student->preferred_method == "indirect" ? 'checked' : '' }} disabled>
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
                                                            <input type="text" name="agent_id" value="{{ \App\Models\RecruitmentAgent::where('id', $student->agent_id)->value('name') }}" disabled>

                                                            </select>
                                                        </div>


                                                    </div>

                                                    <div class="form-row mt-3">
                                                        <div class="form-group col-md-4">
                                                            <label class="label" for="email">Referral</label>
                                                            <input type="text" name="referral" class="form-control" value="{{ $student->referral }}" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        <div class="form-group col-md-4">
                                                            <label class="label" for="middleName">Other Stakeholder:</label>
                                                            <input type="text" name="stakeholder" class="form-control" value="{{ $student->stakeholder }}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="container">
                                        <div class="user pt-4">
                                            <div class="user-header">
                                                <h4 class="py-3">Verifier</h4>
                                                <a href="{{ route('students.index') }}" class="close-btn"></a>
                                            </div>
                                            <div class="search-user">
                                                <div class="container">
                                                    <div class="my-3">
                                                        <span class="star-color"></span><span class="label"><br> <i></i></span>
                                                    </div>
                                                    <div class="container-fluid mt-3">
                                                        <div class="panel">
                                                            <strong class="sub-title">Verifier:</strong>
                                                            <div class="collapse-div mb-3">
                                                                <div class="row extra-padding">
                                                                    <div class="form-row mt-3">
                                                                        <div class="form-group">
                                                                            <label class="label" for="get_student">Student:</span></label>
                                                                            <input type="text"  class="form-control" value="{{ $student->name }}" disabled>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="label" for="email">Intake:</span></label>
                                                                            <input type="text" class="form-control"  value="{{ $student->intake }}" disabled>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label class="label" for="middleName">Screened By:</span></label>
                                                                            <input type="text" name="screened_by" class="form-control" value="{{ $student->screened_by }}" disabled>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
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
                        <h1 class="modal-title fs-5" >Add Recruitment Agent</h1>
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
                                <label class="label" for="payment_method">Payment Method add:<span class="star-color">*</span></label>
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
        $('input[name="traveling_alone"]').change(function() {
            if ($(this).val() === 'Yes') {
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
