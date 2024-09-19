@extends('backend.layouts.app')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" />

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined">
<link rel="stylesheet" href="{{ asset('assets/css/fileUpload.css') }}">

<link href="{{ asset('assets/css/select.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/case.css') }}" rel="stylesheet" />
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
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
                                                            <option disabled selected>--Select One--</option>
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
                                                        <input type="text" class="form-control" name="address" value="{{ $student->address }}">
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
                                                                data-id="{{ $agent->id }}"
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



                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl">
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">View Recruitment Agent</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST" action="{{ route('recruitments_agent.update') }}">
                                                     @csrf
                                                                <div class="my-3">
                                                                    <span class="star-color">*</span><span class="label"> <i>Indicates required field</i></span>
                                                                </div>

                                                                <div class="form-row mt-3">
                                                                    <div class="form-group">
                                                                        <label class="label" for="name">Name Of Agent:<span class="star-color">*</span></label>
                                                                        <input type="text" class="form-control" id="name" name="name">
                                                                        <input type="hidden" class="form-control" id="student_form" value="stundet form" name="student_form">
                                                                        <input type="hidden" class="form-control" id="agent"  name="id">
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
                                                                <div class="modal-footer d-flex justify-content-center w-100">
                                                                <button type="submit" class="btn filter-btn" data-bs-dismiss="modal">Edit</button>
                                                            </div>
                                                            </div>

                                                 </form>
                                                        </div>
                                                    </div>
                                                </div>


                        <!-- Documents Information -->
                        <div class="tab-pane fade" id="pills-docs" role="tabpanel" aria-labelledby="pills-docs-tab" tabindex="0">



                            <?php
                            $passportDocCount = 0;
                            $brpDocCount = 0;
                            $financialStatementDocCount = 0;
                            $qualificationDocCount = 0;
                            $langDocCount = 0;
                            $miscellaneousDocCount = 0;
                            $tbCertificateDocCount = 0;
                            $previousCasDocCount = 0;

                            $student->media->each(function ($media) use (
                                &$passportDocCount,
                                &$brpDocCount,
                                &$financialStatementDocCount,
                                &$qualificationDocCount,
                                &$langDocCount,
                                &$miscellaneousDocCount,
                                &$tbCertificateDocCount,
                                &$previousCasDocCount
                            ) {
                                if (!empty($media->passport_doc)) {
                                    $passportDocCount++;
                                }
                                if (!empty($media->brp_doc)) {
                                    $brpDocCount++;
                                }
                                if (!empty($media->financial_statement_doc)) {
                                    $financialStatementDocCount++;
                                }
                                if (!empty($media->qualification_doc)) {
                                    $qualificationDocCount++;
                                }
                                if (!empty($media->lang_doc)) {
                                    $langDocCount++;
                                }
                                if (!empty($media->miscellaneous_doc)) {
                                    $miscellaneousDocCount++;
                                }
                                if (!empty($media->tb_certificate_doc)) {
                                    $tbCertificateDocCount++;
                                }
                                if (!empty($media->previous_cas_doc)) {
                                    $previousCasDocCount++;
                                }
                            });
                            ?>



                            <div class="user pt-4">

                                <div class="row">
                                    <div class="col-md-6 text-right p-0">

                                        <div class="doc-div">
                                            <div class="doc-btn">
                                                <span class="float-left mr-3 passport">Passport</span> <span class="float-left mr-3 passport">|</span> <span class="float-left passport">{{ $passportDocCount }}</span>
                                                <button class="btn btn-primary btn-collapse" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                    +
                                                </button>
                                            </div>
                                            <div class="collapse" id="collapseExample">
                                                <div class="p-2">
                                                    <div class="datatable table-responsive">
                                                        <table id="example" class="table table-bordered w-100 custom-datatable">
                                                            <thead class="text-center">
                                                                <tr>
                                                                    <th>Doc Name</th>
                                                                    <th>Created At</th>
                                                                    <th>Created By</th>
                                                                    <th>Updated By</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="text-center">
                                                                @foreach ($student->media as $media)
                                                                @if ($media->passport_doc)
                                                                <tr>
                                                                <td>
                                                                <span  data-bs-toggle="tooltip" data-bs-placement="right" title="{{ $media->passport_doc }}">
                                                                    {{ Str::limit(str_replace('.pdf', '', $media->passport_doc), 20, '...') }}
                                                                </span>
                                                                </td>
                                                                    <td>{{ $media->created_at }}</td>
                                                                    <td>{{ \app\Models\User::where('id', $media->created_by)->value('name') }}</td>
                                                                    <td>{{ \app\Models\User::where('id', $media->updated_by)->value('name') }}</td>
                                                                    <td class="ealign-items-center">
                                                                        <a href="javascript:void(0);" class="me-2 menulink" data-file="{{ asset('assets/studentFiles/' . $media->passport_doc) }}">
                                                                            <i class="bi bi-eye-fill mr-2" style="color: #03a853;"></i>
                                                                        </a>
                                                                        <a href="{{ asset('assets/studentFiles/' . $media->passport_doc) }}" download="{{ $media->passport_doc }}">
                                                                            <i class="fa fa-download mr-2" style="color: #03a853;"></i>
                                                                        </a>
                                                                        <form method="GET" action="{{ route('media.delete', $media->id) }}" class="d-inline">
                                                                            @csrf
                                                                            <input name="_method" type="hidden" value="DELETE">
                                                                            <a href="{{ route('media.delete', $media->id) }}" class="show_confirm" data-toggle="tooltip" title="Delete">
                                                                                <i class="bi bi-x-lg text-danger" style="font-weight: bold;"></i>
                                                                            </a>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                                @endif
                                                                @endforeach

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="doc-div mt-3">
                                            <div class="doc-btn">
                                                <span class="float-left mr-3 passport">BRP</span> <span class="float-left mr-3 passport">|</span> <span class="float-left passport">{{ $brpDocCount }}</span>
                                                <button class="btn btn-primary btn-collapse" type="button" data-bs-toggle="collapse" data-bs-target="#brp" aria-expanded="false" aria-controls="brp">
                                                    +
                                                </button>
                                            </div>
                                            <div class="collapse" id="brp">
                                                <div class="p-2">
                                                    <div class="datatable table-responsive">
                                                        <table id="example1" class="table table-bordered">
                                                            <thead class="text-center">
                                                                <tr>
                                                                    <th>Doc Name</th>
                                                                    <th>Created At</th>
                                                                    <th>Created By</th>
                                                                    <th>Updated By</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="text-center">
                                                                @foreach ($student->media as $media)
                                                                @if ($media->brp_doc)
                                                                <tr>
                                                                <td>
                                                                <span  data-bs-toggle="tooltip" data-bs-placement="right" title="{{ $media->brp_doc }}">
                                                                    {{ Str::limit(str_replace('.pdf', '', $media->brp_doc), 20, '...') }}
                                                                </span>
                                                               </td>
                                                                    <td>{{ $media->created_at }}</td>
                                                                    <td>{{ \app\Models\User::where('id', $media->created_by)->value('name') }}</td>
                                                                    <td>{{ \app\Models\User::where('id', $media->updated_by)->value('name') }}</td>
                                                                    <td class="ealign-items-center">
                                                                        <a href="javascript:void(0);" class="me-2 menulink" data-file="{{ asset('assets/studentFiles/' . $media->brp_doc) }}">
                                                                            <i class="bi bi-eye-fill mr-2" style="color: #03a853;"></i>
                                                                        </a>
                                                                        <a href="{{ asset('assets/studentFiles/' . $media->brp_doc) }}" download="{{ $media->brp_doc }}">
                                                                            <i class="fa fa-download mr-2" style="color: #03a853;"></i>
                                                                        </a>
                                                                        <form method="GET" action="{{ route('media.delete', $media->id) }}" class="d-inline">
                                                                            @csrf
                                                                            <input name="_method" type="hidden" value="DELETE">
                                                                            <a href="{{ route('media.delete', $media->id) }}" class="show_confirm" data-toggle="tooltip" title="Delete">
                                                                                <i class="bi bi-x-lg text-danger" style="font-weight: bold;"></i>
                                                                            </a>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                                @endif
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="doc-div mt-3">
                                            <div class="doc-btn">
                                                <span class="float-left mr-3 passport">Financial Statement (How Many)</span> <span class="float-left mr-3 passport">|</span> <span class="float-left passport">{{ $financialStatementDocCount }}</span>
                                                <button class="btn btn-primary btn-collapse" type="button" data-bs-toggle="collapse" data-bs-target="#financial" aria-expanded="false" aria-controls="financial">
                                                    +
                                                </button>
                                            </div>
                                            <div class="collapse" id="financial">
                                                <div class="p-2">
                                                    <div class="datatable table-responsive">
                                                        <table id="example2" class="table table-bordered">
                                                            <thead class="text-center">
                                                                <tr>
                                                                    <th>Doc Name</th>
                                                                    <th>Created At</th>
                                                                    <th>Created By</th>
                                                                    <th>Updated By</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="text-center">
                                                                @foreach ($student->media as $media)
                                                                @if ($media->financial_statement_doc)
                                                                <tr>
                                                                <td>
                                                                <span  data-bs-toggle="tooltip" data-bs-placement="right" title="{{ $media->financial_statement_doc }}">
                                                                    {{ Str::limit(str_replace('.pdf', '', $media->financial_statement_doc), 20, '...') }}
                                                                </span>
                                                                </td>
                                                                    <td>{{ $media->created_at }}</td>
                                                                    <td>{{ \app\Models\User::where('id', $media->created_by)->value('name') }}</td>
                                                                    <td>{{ \app\Models\User::where('id', $media->updated_by)->value('name') }}</td>
                                                                    <td class="ealign-items-center">
                                                                        <a href="javascript:void(0);" class="me-2 menulink" data-file="{{ asset('assets/studentFiles/' . $media->financial_statement_doc) }}">
                                                                            <i class="bi bi-eye-fill mr-2" style="color: #03a853;"></i>
                                                                        </a>
                                                                        <a href="{{ asset('assets/studentFiles/' . $media->financial_statement_doc) }}" download="{{ $media->financial_statement_doc }}">
                                                                            <i class="fa fa-download mr-2" style="color: #03a853;"></i>
                                                                        </a>
                                                                        <form method="GET" action="{{ route('media.delete', $media->id) }}" class="d-inline">
                                                                            @csrf
                                                                            <input name="_method" type="hidden" value="DELETE">
                                                                            <a href="{{ route('media.delete', $media->id) }}" class="show_confirm" data-toggle="tooltip" title="Delete">
                                                                                <i class="bi bi-x-lg text-danger" style="font-weight: bold;"></i>
                                                                            </a>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                                @endif
                                                                @endforeach

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="doc-div mt-3">
                                            <div class="doc-btn">
                                                <span class="float-left mr-3 passport">Qualification</span> <span class="float-left mr-3 passport">|</span> <span class="float-left passport">{{ $qualificationDocCount }}</span>
                                                <button class="btn btn-primary btn-collapse" type="button" data-bs-toggle="collapse" data-bs-target="#qualification" aria-expanded="false" aria-controls="qualification">
                                                    +
                                                </button>
                                            </div>
                                            <div class="collapse" id="qualification">
                                                <div class="p-2">
                                                    <div class="datatable table-responsive">
                                                        <table id="example3" class="table table-bordered">
                                                            <thead class="text-center">
                                                                <tr>
                                                                    <th>Doc Name</th>
                                                                    <th>Created At</th>
                                                                    <th>Created By</th>
                                                                    <th>Updated By</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="text-center">
                                                                @foreach ($student->media as $media)
                                                                @if ($media->qualification_doc)
                                                                <tr>
                                                                <td>
                                                                <span  data-bs-toggle="tooltip" data-bs-placement="right" title="{{ $media->qualification_doc }}">
                                                                    {{ Str::limit(str_replace('.pdf', '', $media->qualification_doc), 20, '...') }}
                                                                </span>
                                                                </td>
                                                                    <td>{{ $media->created_at }}</td>
                                                                    <td>{{ \app\Models\User::where('id', $media->created_by)->value('name') }}</td>
                                                                    <td>{{ \app\Models\User::where('id', $media->updated_by)->value('name') }}</td>
                                                                    <td class="ealign-items-center">
                                                                        <a href="javascript:void(0);" class="me-2 menulink" data-file="{{ asset('assets/studentFiles/' . $media->qualification_doc) }}">
                                                                            <i class="bi bi-eye-fill mr-2" style="color: #03a853;"></i>
                                                                        </a>
                                                                        <a href="{{ asset('assets/studentFiles/' . $media->qualification_doc) }}" download="{{ $media->qualification_doc }}">
                                                                            <i class="fa fa-download mr-2" style="color: #03a853;"></i>
                                                                        </a>
                                                                        <form method="GET" action="{{ route('media.delete', $media->id) }}" class="d-inline">
                                                                            @csrf
                                                                            <input name="_method" type="hidden" value="DELETE">
                                                                            <a href="{{ route('media.delete', $media->id) }}" class="show_confirm" data-toggle="tooltip" title="Delete">
                                                                                <i class="bi bi-x-lg text-danger" style="font-weight: bold;"></i>
                                                                            </a>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                                @endif
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="doc-div mt-3">
                                            <div class="doc-btn">
                                                <span class="float-left mr-3 passport">Language</span> <span class="float-left mr-3 passport">|</span> <span class="float-left passport">{{ $langDocCount }}</span>
                                                <button class="btn btn-primary btn-collapse" type="button" data-bs-toggle="collapse" data-bs-target="#language" aria-expanded="false" aria-controls="language">
                                                    +
                                                </button>
                                            </div>
                                            <div class="collapse" id="language">
                                                <div class="p-2">
                                                    <div class="datatable table-responsive">
                                                        <table id="example4" class="table table-bordered">
                                                            <thead class="text-center">
                                                                <tr>
                                                                    <th>Doc Name</th>
                                                                    <th>Created At</th>
                                                                    <th>Created By</th>
                                                                    <th>Updated By</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="text-center">
                                                                @foreach ($student->media as $media)
                                                                @if ($media->lang_doc)
                                                                <tr>
                                                                <td>
                                                                <span data-bs-toggle="tooltip" data-bs-placement="right" title="{{ $media->lang_doc }}">
                                                                    {{ Str::limit(str_replace('.pdf', '', $media->lang_doc), 20, '...') }}
                                                                </span>
                                                                </td>
                                                                    <td>{{ $media->created_at }}</td>
                                                                    <td>{{ \app\Models\User::where('id', $media->created_by)->value('name') }}</td>
                                                                    <td>{{ \app\Models\User::where('id', $media->updated_by)->value('name') }}</td>
                                                                    <td class="ealign-items-center">
                                                                        <a href="javascript:void(0);" class="me-2 menulink" data-file="{{ asset('assets/studentFiles/' . $media->lang_doc) }}">
                                                                            <i class="bi bi-eye-fill mr-2" style="color: #03a853;"></i>
                                                                        </a>
                                                                        <a href="{{ asset('assets/studentFiles/' . $media->lang_doc) }}" download="{{ $media->lang_doc }}">
                                                                            <i class="fa fa-download mr-2" style="color: #03a853;"></i>
                                                                        </a>
                                                                        <form method="GET" action="{{ route('media.delete', $item->id) }}" class="d-inline">
                                                                            @csrf
                                                                            <input name="_method" type="hidden" value="DELETE">
                                                                            <a href="{{ route('media.delete', $media->id) }}" class="show_confirm" data-toggle="tooltip" title="Delete">
                                                                                <i class="bi bi-x-lg text-danger" style="font-weight: bold;"></i>
                                                                            </a>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                                @endif
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="doc-div mt-3">
                                            <div class="doc-btn">
                                                <span class="float-left mr-3 passport">Miscellaneous</span> <span class="float-left mr-3 passport">|</span> <span class="float-left passport">{{ $miscellaneousDocCount }}</span>
                                                <button class="btn btn-primary btn-collapse" type="button" data-bs-toggle="collapse" data-bs-target="#miscellaneous" aria-expanded="false" aria-controls="miscellaneous">
                                                    +
                                                </button>
                                            </div>
                                            <div class="collapse" id="miscellaneous">
                                                <div class="p-2">
                                                    <div class="datatable table-responsive">
                                                        <table id="example5" class="table table-bordered">
                                                            <thead class="text-center">
                                                                <tr>
                                                                    <th>Doc Name</th>
                                                                    <th>Created At</th>
                                                                    <th>Created By</th>
                                                                    <th>Updated By</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="text-center">
                                                                @foreach ($student->media as $media)
                                                                @if ($media->miscellaneous_doc)
                                                                <tr>
                                                                <td>
                                                                <span  data-bs-toggle="tooltip" data-bs-placement="right" title="{{ $media->miscellaneous_doc }}">
                                                                    {{ Str::limit(str_replace('.pdf', '', $media->miscellaneous_doc), 20, '...') }}
                                                                </span>
                                                                </td>
                                                                    <td>{{ $media->created_at }}</td>
                                                                    <td>{{ \app\Models\User::where('id', $media->created_by)->value('name') }}</td>
                                                                    <td>{{ \app\Models\User::where('id', $media->updated_by)->value('name') }}</td>
                                                                    <td class="ealign-items-center">
                                                                        <a href="javascript:void(0);" class="me-2 menulink" data-file="{{ asset('assets/studentFiles/' . $media->miscellaneous_doc) }}">
                                                                            <i class="bi bi-eye-fill mr-2" style="color: #03a853;"></i>
                                                                        </a>
                                                                        <a href="{{ asset('assets/studentFiles/' . $media->miscellaneous_doc) }}" download="{{ $media->miscellaneous_doc }}">
                                                                            <i class="fa fa-download mr-2" style="color: #03a853;"></i>
                                                                        </a>
                                                                        <form method="GET" action="{{ route('media.delete', $media->id) }}" class="d-inline">
                                                                            @csrf
                                                                            <input name="_method" type="hidden" value="DELETE">
                                                                            <a href="{{ route('media.delete', $media->id) }}" class="show_confirm" data-toggle="tooltip" title="Delete">
                                                                                <i class="bi bi-x-lg text-danger" style="font-weight: bold;"></i>
                                                                            </a>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                                @endif
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="doc-div mt-3">
                                            <div class="doc-btn">
                                                <span class="float-left mr-3 passport">TB Certificate</span> <span class="float-left mr-3 passport">|</span> <span class="float-left passport">{{ $tbCertificateDocCount }}</span>
                                                <button class="btn btn-primary btn-collapse" type="button" data-bs-toggle="collapse" data-bs-target="#tb_certificate" aria-expanded="false" aria-controls="tb_certificate">
                                                    +
                                                </button>
                                            </div>
                                            <div class="collapse" id="tb_certificate">
                                                <div class="p-2">
                                                    <div class="datatable table-responsive">
                                                        <table id="example6" class="table table-bordered">
                                                            <thead class="text-center">
                                                                <tr>
                                                                    <th>Doc Name</th>
                                                                    <th>Created At</th>
                                                                    <th>Created By</th>
                                                                    <th>Updated By</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="text-center">
                                                                @foreach ($student->media as $media)
                                                                @if ($media->tb_certificate_doc)
                                                                <tr>
                                                                <td>
                                                                <span  data-bs-toggle="tooltip" data-bs-placement="right" title="{{ $media->tb_certificate_doc }}">
                                                                    {{ Str::limit(str_replace('.pdf', '', $media->tb_certificate_doc), 20, '...') }}
                                                                </span>
                                                                </td>
                                                                    <td>{{ $media->created_at }}</td>
                                                                    <td>{{ \app\Models\User::where('id', $media->created_by)->value('name') }}</td>
                                                                    <td>{{ \app\Models\User::where('id', $media->updated_by)->value('name') }}</td>
                                                                    <td class="ealign-items-center">
                                                                        <a href="javascript:void(0);" class="me-2 menulink" data-file="{{ asset('assets/studentFiles/' . $media->tb_certificate_doc) }}">
                                                                            <i class="bi bi-eye-fill mr-2" style="color: #03a853;"></i>
                                                                        </a>
                                                                        <a href="{{ asset('assets/studentFiles/' . $media->tb_certificate_doc) }}" download="{{ $media->tb_certificate_doc }}">
                                                                            <i class="fa fa-download mr-2" style="color: #03a853;"></i>
                                                                        </a>
                                                                        <form method="GET" action="{{ route('media.delete', $media->id) }}" class="d-inline">
                                                                            @csrf
                                                                            <input name="_method" type="hidden" value="DELETE">
                                                                            <a href="{{ route('media.delete', $media->id) }}" class="show_confirm" data-toggle="tooltip" title="Delete">
                                                                                <i class="bi bi-x-lg text-danger" style="font-weight: bold;"></i>
                                                                            </a>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                                @endif
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="doc-div mt-3">
                                            <div class="doc-btn">
                                                <span class="float-left mr-3 passport">Previous Cas</span> <span class="float-left mr-3 passport">|</span> <span class="float-left passport">{{ $previousCasDocCount }}</span>
                                                <button class="btn btn-primary btn-collapse" type="button" data-bs-toggle="collapse" data-bs-target="#previous_cas" aria-expanded="false" aria-controls="previous_cas">
                                                    +
                                                </button>
                                            </div>
                                            <div class="collapse" id="previous_cas">
                                                <div class="p-2">
                                                    <div class="datatable table-responsive">
                                                        <table id="example7" class="table table-bordered">
                                                            <thead class="text-center">
                                                                <tr>
                                                                    <th>Doc Name</th>
                                                                    <th>Created At</th>
                                                                    <th>Created By</th>
                                                                    <th>Updated By</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="text-center">
                                                                @foreach ($student->media as $media)
                                                                @if ($media->previous_cas_doc)
                                                                <tr>
                                                                <td>
                                                                <span  data-bs-toggle="tooltip" data-bs-placement="right" title="{{ $media->previous_cas_doc }}">
                                                                    {{ Str::limit(str_replace('.pdf', '', $media->previous_cas_doc), 20, '...') }}
                                                                </span>
                                                                </td>
                                                                    <td>{{ $media->created_at }}</td>
                                                                    <td>{{ \app\Models\User::where('id', $media->created_by)->value('name') }}</td>
                                                                    <td>{{ \app\Models\User::where('id', $media->updated_by)->value('name') }}</td>
                                                                    <td class="ealign-items-center">
                                                                        <a href="javascript:void(0);" class="me-2 menulink" data-file="{{ asset('assets/studentFiles/' . $media->previous_cas_doc) }}">
                                                                            <i class="bi bi-eye-fill mr-2" style="color: #03a853;"></i>
                                                                        </a>
                                                                        <a href="{{ asset('assets/studentFiles/' . $media->previous_cas_doc) }}" download="{{ $media->previous_cas_doc }}">
                                                                            <i class="fa fa-download mr-2" style="color: #03a853;"></i>
                                                                        </a>
                                                                        <form method="GET" action="{{ route('media.delete', $media->id) }}" class="d-inline">
                                                                            @csrf
                                                                            <input name="_method" type="hidden" value="DELETE">
                                                                            <a href="{{ route('media.delete', $media->id) }}" class="show_confirm" data-toggle="tooltip" title="Delete">
                                                                                <i class="bi bi-x-lg text-danger" style="font-weight: bold;"></i>
                                                                            </a>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                                @endif
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-buttons p-5">
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#addDocuments" class="btn btn-lg filter-btn">Upload</button>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12 pe-0">
                                        <div class="position-fixed2 border" style="position: sticky; top: 20px; z-index: 1000;">
                                            <div class="input-group border-radius-bottom mb-0" style="background: #7d7979;">
                                                <div class="col-6">
                                                    <h3 class="mb-0">Preview</h3>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <button type="button" aria-label="Close" class="close"  id="resetBtn">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="container-fluid mt-2">
                                                <div class="preview-border text-center">
                                                    <iframe type="application/pdf" id="bgFrame" src="{{ asset('assets/img/doc_background_img.png') }}" frameborder="0" style="width: 100%; height: 600px;"></iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                        <!-- Verifier Information -->
                        <div class="tab-pane fade" id="pills-verifier" role="tabpanel" aria-labelledby="pills-verifier-tab" tabindex="0">

                            <div class="user pt-4">
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

                        <!-- View All Information -->
                        <div class="tab-pane fade" id="pills-view" role="tabpanel" aria-labelledby="pills-view-tab" tabindex="0">

                            <div class="user" style="border: 1px solid #ccc; border-radius: 5px">
                                <div class="">
                                    <div class="user-header header-title">
                                        <h4 class="py-3">View All Info</h4>
                                        <a href="{{ route('students.index') }}" class="close-btn"></a>
                                    </div>

                                    <div class="container">
                                        <div class="user pt-4">
                                            <div class="user-header header-title">
                                                <h4 class="py-3">Case Information</h4>
                                                <a href="{{ route('students.index') }}" class="close-btn"></a>
                                            </div>
                                            <div class="search-user remove-border">
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
                                            <div class="user-header header-title">
                                                <h4 class="py-3">Student</h4>
                                                <a href="{{ route('students.index') }}" class="close-btn"></a>
                                            </div>

                                            <div class="search-user remove-border">
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
                                                            <input type="text" name="phone_no" class="form-control" value="{{ $student->phone_no }}" disabled>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="label" for="phone_no">Date Of Birth:</label>
                                                            <input type="date" name="date_of_birth" class="form-control" value="{{ $student->date_of_birth }}" disabled>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="label">Gender:<span class="star-color">*</span></label>
                                                            <div class="radio-btn">
                                                                <input type="radio" name="gender" value="1" {{ $student->gender == 1 ? 'checked' : '' }} disabled>
                                                                <label class="label" for="male">Male</label>
                                                                <input type="radio" name="gender" value="2" {{ $student->gender == 2 ? 'checked' : '' }} disabled>
                                                                <label class="label" for="female">Female</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-row">

                                                        <div class="form-group">
                                                            <label class="label" for="passport">Passport Number:</label>
                                                            <input type="text" class="form-control" name="passport" value="{{ $student->passport }}" disabled>
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
                                                            <input type="text" class="form-control" name="address" value="{{ $student->address }}" disabled>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="label" for="address2">Address Line 2:</label>
                                                            <input type="text" name="address2" class="form-control" value="{{ $student->address2 }}" disabled>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="label" for="middleName">City:<span class="star-color">*</span></label>
                                                            <input type="text" name="city" class="form-control" value="{{ $student->city }}" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-3">
                                                        <div class="form-group">
                                                            <label class="label" for="county">County:</label>
                                                            <input type="text" class="form-control" name="county" value="{{ $student->county }}" disabled>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="label" for="post_code">Post Code:<span class="star-color">*</span></label>
                                                            <input type="text" name="post_code" class="form-control" value="{{ $student->post_code }}" disabled>
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
                                            <div class="user-header header-title">
                                                <h4 class="py-3">Dependants</h4>
                                                <a href="{{ route('students.index') }}" class="close-btn"></a>
                                            </div>
                                            <div class="search-user remove-border">
                                                <div class="container">
                                                    <div class="my-3">
                                                        <span class="star-color"></span><span class="label"><br> <i></i></span>
                                                    </div>
                                                    <div class="form-row hide-row">
                                                        <div class="form-group col-md-4">
                                                            <label class="label">Traveling Alone:<span class="star-color">*</span></label>
                                                            <div class="radio-btn">
                                                                <input type="radio" name="traveling_alone" value="Yes" {{ $student->traveling_alone == "Yes" ? 'checked' : '' }} disabled>
                                                                <label for="traveling-yes">Yes</label>
                                                                <input type="radio" name="traveling_alone" value="No" {{ $student->traveling_alone == "No" ? 'checked' : '' }} disabled>
                                                                <label for="traveling-no">No</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-row hide-row">
                                                        <div class="form-group col-md-4">
                                                            <label class="label">How Many Dependents:</span></label>
                                                            <input type="number" class="form-control" name="dependant_no" value="{{ $student->dependant_no }}" disabled>
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
                                            <div class="user-header header-title">
                                                <h4 class="py-3">Previous Information</h4>
                                                <a href="{{ route('students.index') }}" class="close-btn"></a>
                                            </div>
                                            <div class="search-user remove-border">
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
                                                        <textarea class="form-control" name="academic_history" rows="3" disabled>{{$student->academic_history}}</textarea>
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
                                            <div class="user-header header-title">
                                                <h4 class="py-3">Referrer Information</h4>
                                                <a href="{{ route('students.index') }}" class="close-btn"></a>
                                            </div>
                                            <div class="search-user remove-border">
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
                                            <div class="user-header header-title">
                                                <h4 class="py-3">Verifier</h4>
                                                <a href="{{ route('students.index') }}" class="close-btn"></a>
                                            </div>
                                            <div class="search-user remove-border">
                                                <div class="container">
                                                    <div class="my-3">
                                                        <span class="star-color"></span><span class="label"><br> <i></i></span>
                                                    </div>
                                                    <div class="container-fluid mt-3 mb-3">
                                                        <div class="panel">
                                                            <strong class="sub-title">Verifier:</strong>
                                                            <div class="collapse-div mb-3">
                                                                <div class="row extra-padding">
                                                                    <div class="form-row mt-3">
                                                                        <div class="form-group">
                                                                            <label class="label" for="get_student">Student:</span></label>
                                                                            <input type="text" class="form-control" value="{{ $student->name }}" disabled>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="label" for="email">Intake:</span></label>
                                                                            <input type="text" class="form-control" value="{{ $student->intake }}" disabled>
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
                        <h1 class="modal-title fs-5">Add Recruitment Agent</h1>
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
                                <input type="text" class="form-control" name="address">
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
    <div class="modal fade" id="addDocuments" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form method="POST" action="{{ route('students.update' , [$student->id]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Upload Documents</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="my-3">
                        </div>
                        <div class="form-row">
                            <div class="form-group ">
                                <label class="label" for="documents">Choose Document Type:<span class="star-color">*</span></label>
                                <select id="document" class="form-control" name="documents_type" required>
                                    <option default disabled selected>Select Document Type</option>
                                    <option value="passport_doc">Passport</option>
                                    <option value="brp_doc">BRP</option>
                                    <option value="financial_statement_doc">Financial Statement</option>
                                    <option value="qualification_doc">Qualification Doc</option>
                                    <option value="lang_doc">language Doc</option>
                                    <option value="miscellaneous_doc">Miscellaneous</option>
                                    <option value="tb_certificate_doc">TB Certificate</option>
                                    <option value="previous_cas_doc">Previous CAS</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group ">
                                <label class="label" for="documents">Upload Documents:<span class="star-color">*</span></label>
                                <input type="hidden" class="form-control" name="files" value="files" />
                                <div id="fileUpload"></div>
                            </div>
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


<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>

<script type="text/javascript">
    $('.show_confirm').click(function(event) {

        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();

        swal({

                title: `Are you sure you want to delete this Media File?`,
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
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>

<script>
    $(document).ready(function() {
        $('#resetBtn').click(function() {
            // Reset the iframe source to the original background image
            $('#bgFrame').attr('src', '{{ asset("assets/img/doc_background_img.png") }}');
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('.menulink').on('click', function() {
            var fileUrl = $(this).data('file');

            $('#bgFrame').attr('src', fileUrl);
        });
    });
</script>

<script>
        $(document).ready(function () {
            $("#fileUpload").fileUpload();
        });
    </script>

<script async src="https://www.googletagmanager.com/gtag/js?id=G-1VDDWMRSTH"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-1VDDWMRSTH');
</script>
<script>
try {
  fetch(new Request("https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js", { method: 'HEAD', mode: 'no-cors' })).then(function(response) {
    return true;
  }).catch(function(e) {
    var carbonScript = document.createElement("script");
    carbonScript.src = "//cdn.carbonads.com/carbon.js?serve=CK7DKKQU&placement=wwwjqueryscriptnet";
    carbonScript.id = "_carbonads_js";
    document.getElementById("carbon-block").appendChild(carbonScript);
  });
} catch (error) {
  console.log(error);
}
</script>
<script>
    try {
        fetch(new Request("https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js", {
            method: 'HEAD',
            mode: 'no-cors'
        })).then(function(response) {
            return true;
        }).catch(function(e) {
            var carbonScript = document.createElement("script");
            carbonScript.src = "//cdn.carbonads.com/carbon.js?serve=CK7DKKQU&placement=wwwjqueryscriptnet";
            carbonScript.id = "_carbonads_js";
            document.getElementById("carbon-block").appendChild(carbonScript);
        });
    } catch (error) {
        console.log(error);
    }
</script>


<script>
    $(document).ready(function() {
        // On dropdown selection change
        $('#agent_id').change(function() {
            // Get the selected option data
            var selectedOption = $(this).find('option:selected');

            var id = selectedOption.data('id');
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
            $('#agent').val(id);
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

<script>
    $(document).ready(function() {
        $('#example').DataTable({
            searching: false,
            paging: true,
            lengthChange: false,
        });

        $('#example1').DataTable({
            searching: false,
            paging: true,
            lengthChange: false,
        });

        $('#example2').DataTable({
            searching: false,
            paging: true,
            lengthChange: false,
        });
        $('#example3').DataTable({
            searching: false,
            paging: true,
            lengthChange: false,
        });
        $('#example4').DataTable({
            searching: false,
            paging: true,
            lengthChange: false,
        });
        $('#example5').DataTable({
            searching: false,
            paging: true,
            lengthChange: false,
        });
        $('#example6').DataTable({
            searching: false,
            paging: true,
            lengthChange: false,
        });
        $('#example7').DataTable({
            searching: false,
            paging: true,
            lengthChange: false,
        });
    });
</script>


@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/js/fileUpload.js') }}"></script>


@endpush
@endsection
