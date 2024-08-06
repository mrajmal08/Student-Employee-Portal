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
                                <form method="POST" action="{{ route('students.insert') }}">
                                    @csrf
                                    <div class="form-row mt-3">
                                        <div class="form-group">
                                            <label class="label" for="firstName">First Name <span>*</span></label>
                                            <input type="text" id="firstName" name="first_name" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="label" for="middleName">Last Name</label>
                                            <input type="text" name="last_name" id="last_name">
                                        </div>
                                        <div class="form-group">
                                            <label class="label" for="email">Email <span>*</span></label>
                                            <input type="email" name="email" id="email" required>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="label" for="email">Nationality <span>*</span></label>
                                            <input type="text" name="nationality" id="nationality" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="label" for="phone_no">Preferred Contact Number <span>*</span></label>
                                            <input type="text" name="phone_no" id="phone_no" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="label" for="phone_no">Date Of Birth <span>*</span></label>
                                            <input type="date" name="date_of_birth" id="date_of_birth" required>
                                        </div>

                                    </div>

                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="label" for="passport">Passport</label>
                                            <input type="text" name="passport" id="text" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="label" for="passport">Course</label>
                                            <select>
                                                <option disabled selected>--Select One--</option>
                                                <option>English</option>
                                                <option>Math</option>
                                                <option>Science</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="label">Gender <span>*</span></label>
                                            <div class="radio-btn">
                                                <input type="radio" id="male" name="gender" value="1" required>
                                                <label class="label" for="male">Male</label>
                                                <input type="radio" id="female" name="gender" value="2">
                                                <label class="label" for="female">Female</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="label" for="cas">Previous CAS</label>
                                            <input type="text" name="previous_cas" id="text" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="label" for="passport">Dependants</label>
                                            <select name="dependant">
                                                <option disabled selected>--Select One--</option>
                                                <option>dependant 1</option>
                                                <option>dependant 2</option>
                                                <option>dependant 3</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="label">Intake <span>*</span></label>
                                            <select name="intake">
                                                <option disabled selected>--Select One--</option>
                                                <option>Jan</option>
                                                <option>Feb</option>
                                                <option>March ...</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="my-2">
                                        <h4 class="address">
                                            Address
                                        </h4>
                                    </div>

                                    <div class="form-row">
                                        <textarea class="form-control" name="address" id="exampleFormControlTextarea1" rows="3"></textarea>
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
                                            Academic History
                                        </h4>
                                    </div>

                                    <div class="form-row">
                                        <textarea class="form-control" name="academic_history" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>
                                    <div class="my-2">
                                        <h4 class="address">
                                            Travel History
                                        </h4>
                                    </div>

                                    <div class="form-row">
                                        <textarea class="form-control" name="travel_history" id="exampleFormControlTextarea1" rows="3"></textarea>
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
