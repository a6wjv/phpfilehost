@extends('layouts.layout')
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0 mx-2">Student Form</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic File Browser start -->
                <section id="input-file-browser">
                    <div class="card">
                        @if (Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }} text-center fs-3">
                         {{ Session::get('message') }}</p>
                        @endif
                        <div class="card-body pt-1">
                            <!-- form -->
                            <form action="{{ $url }}" method="POST" enctype="multipart/form-data" class="fw-bolder"
                                id="insertStudent">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-4 mb-1">
                                        <label class="form-label" for="qrcode">First Name<sup class="text-danger f-size12">*</sup></label>
                                        <div class="form-password-toggle">
                                            <input class="form-control f-size14" type="text" id="first_name"
                                                value="{{ isset($studentDetails->f_name) ? $studentDetails->f_name : '' }}"
                                                name="first_name" placeholder="Ex : Mr.Anil" required/>
                                            @error('first_name')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 mb-1">
                                        <label class="form-label" for="last_name">Last Name<sup class="text-danger f-size12" >*</sup></label>
                                        <div class=" form-password-toggle">
                                            <input class="form-control" type="text" id="last_name" 
                                                value="{{ isset($studentDetails->l_name) ? $studentDetails->l_name : '' }}"
                                                name="last_name" placeholder="Ex : Kumar" required/>
                                            @error('last_name')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 mb-1">
                                        <label class="form-label" for="email">Email Address</label>
                                        <div class=" form-password-toggle">
                                            <input class="form-control" type="email" id="email"
                                                value="{{ isset($studentDetails->email) ? $studentDetails->email : '' }}"
                                                name="email" placeholder="Ex : ex@gmail.com" />
                                            @error('email')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-4 mb-1">
                                        <label class="form-label" for="mobile_self">Mobile(Self)<sup class="text-danger f-size12" >*</sup></label>
                                        <div class=" form-password-toggle">
                                            <input class="form-control" type="number" id="mobile_self"
                                                value="{{ isset($studentDetails->phone) ? $studentDetails->phone : '' }}"
                                                name="mobile_self" min="0" oninput="validity.valid||(value='');"
                                                maxlength="10" placeholder="Ex :  +98017********" required/>
                                            @error('mobile_self')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 mb-1">
                                        <label class="form-label" for="dob">DOB</label>
                                        <div class=" form-password-toggle">
                                            <input class="form-control flatpickr-input" type="date" id="dob"
                                                value="{{ isset($studentDetails->dob) ? $studentDetails->dob : '' }}"
                                                placeholder="DD-MM-YYYY" name="dob" />
                                            @error('dob')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 mb-1">
                                        <label class="form-label" for="mobile_parent">Mobile (Parents)</label>
                                        <div class=" form-password-toggle">
                                            <input class="form-control" type="number" id="mobile_parent"
                                                value="{{ isset($studentDetails->contact) ? $studentDetails->contact : '' }}"
                                                min="0" placeholder="Ex : +9856..." 
                                                 name="mobile_parent" />
                                            @error('mobile_parent')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-4 mb-1">
                                        <label class="form-label" for="mobile_self">Father Name<sup class="text-danger f-size12" >*</sup></label>
                                        <div class=" form-password-toggle">
                                            <input class="form-control" type="text" id="father_name"
                                                value="{{ isset($studentDetails->father_name) ? $studentDetails->father_name : '' }}"
                                                name="father_name" placeholder="Ex : Father Name" required/>
                                            @error('father_name')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 mb-1">
                                        <label class="form-label" for="mother_name">Mother Name</label>
                                        <div class=" form-password-toggle">
                                            <input class="form-control" type="text" id="mother_name"
                                                value="{{ isset($studentDetails->mother_name) ? $studentDetails->mother_name : '' }}"
                                                placeholder="Ex : Mother Name" name="mother_name"/>
                                            @error('mother_name')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 mb-1">
                                        <label class="form-label" for="category">Category</label>
                                        <select name="category" id="category" class="form-control">
                                            <option value="">---Select---</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category }}"
                                                    {{ isset($studentDetails->category) && $studentDetails->category == $category ? 'selected' : '' }}>
                                                    {{ $category }}</option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-4 mb-1">
                                        <label class="form-label" for="tenth_percentage">10th % & Board</label>
                                        <div class=" form-password-toggle">
                                            <input class="form-control" type="number" id="tenth_percentage"
                                                value="{{ isset($studentDetails->highschool) ? $studentDetails->highschool : '' }}"placeholder="Ex : Board"
                                                name="tenth_percentage" min="0"
                                                oninput="validity.valid||(value='');" />
                                            @error('tenth_percentage')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 mb-1">
                                        <label class="form-label" for="tweleve_percentage">12th % & Board</label>
                                        <div class=" form-password-toggle">
                                            <input class="form-control" type="text" id="tweleve_percentage"
                                                value="{{ isset($studentDetails->interediate) ? $studentDetails->interediate : '' }}"
                                                placeholder="Ex : Board" name="tweleve_percentage"  />
                                            @error('tweleve_percentage')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 mb-1">
                                        <label class="form-label" for="medium">Medium</label>
                                        <div class=" form-password-toggle">
                                            <select name="medium" id="medium" class="form-control" >
                                                <option value="">---Select---</option>
                                                @foreach ($mediums as $medium)
                                                    <option value="{{ $medium }}"
                                                        {{ isset($studentDetails->medium) && $studentDetails->medium == $medium ? 'selected' : '' }}>
                                                        {{ $medium }}</option>
                                                @endforeach
                                            </select>
                                            @error('medium')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-4 mb-1">
                                        <label class="form-label" for="course">Course</label>
                                        <div class=" form-password-toggle">
                                            <select name="course" id="course" class="form-control">
                                                <option value="">---Select---</option>
                                                @foreach ($courses as $course)
                                                    <option value="{{ $course }}"
                                                        {{ isset($studentDetails->course) && $studentDetails->course == $course ? 'selected' : '' }}>
                                                        {{ $course }}</option>
                                                @endforeach
                                            </select>
                                            @error('course')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 mb-1">
                                        <label class="form-label" for="course">Target Exam</label>
                                        <div class=" form-password-toggle">
                                            <select class="form-control" name="target_exam" >
                                                <option value="">---Select---</option>
                                                @foreach ($targetExams as $exam)
                                                    <option value="{{ $exam }}"
                                                        {{ isset($studentDetails->target_exam) && $studentDetails->target_exam == $exam ? 'selected' : '' }}>
                                                        {{ $exam }}</option>
                                                @endforeach
                                            </select>
                                            @error('course')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 mb-1">
                                        <label for="school">School</label>
                                        <div class=" form-password-toggle">
                                            <input type="text" name="school"
                                                value="{{ isset($studentDetails->school) ? $studentDetails->school : '' }}"
                                                class="form-control" id="school" placeholder="Ex : Student Memorial">
                                            @error('school')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-4 mb-1">
                                        <label for="district">District</label>
                                        <div class=" form-password-toggle">
                                            <input type="text" name="district"
                                                value="{{ isset($studentDetails->district) ? $studentDetails->district : '' }}"
                                                class="form-control" id="district" placeholder="Ex : LKO">
                                            @error('district')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 mb-1">
                                        <label for="tehsil">Tehsil</label>
                                        <div class=" form-password-toggle">
                                            <input type="text" name="tehsil" placeholder="Ex : LKO"
                                                value="{{ isset($studentDetails->tehsil) ? $studentDetails->tehsil : '' }}"
                                                class="form-control" id="tehsil" placeholder="Ex : Student Memorial">
                                            @error('tehsil')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 mb-1">
                                        <label for="interest">Interest</label>
                                        <div class=" form-password-toggle">
                                            <select class="form-control" name="interest" >
                                                <option value="">---Select---</option>
                                                @foreach ($interests as $interest)
                                                    <option value="{{ $interest }}"
                                                        {{ isset($studentDetails->interest) && $studentDetails->interest == $interest ? 'selected' : '' }}>
                                                        {{ $interest }}</option>
                                                @endforeach
                                            </select>
                                            @error('interest')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-4 mb-1">
                                        <label for="enquiry_date">Enquiry Date</label>
                                        <div class=" form-password-toggle">
                                            <input type="text" name="enquiry_date"
                                                value="{{ isset($studentDetails->enqdate) ? date('d-m-Y', strtotime($studentDetails->enqdate)) : Carbon\Carbon::today()->format('d-m-Y') }}"
                                                class="form-control" id="enquiry_date" placeholder="Ex : LKO">
                                            @error('enquiry_date')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 mb-1">
                                        <label for="source">Source</label>
                                        <div class=" form-password-toggle">
                                            <input type="text" name="source" 
                                                value="{{ isset($studentDetails->source) ? $studentDetails->source : '' }}"
                                                class="form-control" id="source" placeholder="Ex : source">
                                            @error('source')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 mb-1">
                                        <label for="reference">Reference</label>
                                        <div class=" form-password-toggle">
                                            <input type="text" name="reference" 
                                                value="{{ isset($studentDetails->reference) ? $studentDetails->reference : '' }}"
                                                class="form-control" id="reference" placeholder="Ex : Reference">
                                            @error('reference')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-4 mb-1">
                                        <label for="followup_date">Follow Up Date</label>
                                        <div class=" form-password-toggle">
                                            <input type="date" name="followup_date"
                                                value=""
                                                class="form-control flatpickr-input" id="followup_date"
                                                placeholder="DD-MM-YYYY">
                                            @error('followup_date')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 mb-1">
                                        <label for="status">Status</label>
                                        <div class=" form-password-toggle">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="inlineRadio1" value="Open"
                                                    {{ isset($studentDetails->status) && $studentDetails->status == 'Open' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio1">Open</label>
                                            </div>
                                            @if(auth()->user()->admin_role_id==1)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="inlineRadio1" value="Convert"
                                                    {{ isset($studentDetails->status) && $studentDetails->status == 'Convert' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio1">Convert</label>
                                            </div>
                                            @endif
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="inlineRadio1" value="Lost"
                                                    {{ isset($studentDetails->Lost) && $studentDetails->Lost == 'Convert' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio1">Lost</label>
                                            </div>
                                            @error('status')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    @if(auth()->user()->admin_role_id!=1)
                                    <div class="col-12 col-sm-6 col-md-4 mb-1">
                                        <label for="followup_date">Class</label>
                                        <div class=" form-password-toggle">
                                            <input type="text" name="class"
                                                value="{{ isset($studentDetails->class) ? $studentDetails->class : '' }}"
                                                class="form-control" id="class"
                                                placeholder="class">
                                            @error('class')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-8 mb-1">
                                        <label for="followup_date">Comment</label>
                                        <div class="form-password-toggle">
                                            <textarea name="comment" class="form-control" id="" cols="120" rows="5">{{ isset($followupDetails->comment) ? $followupDetails->comment : '' }}</textarea>
                                            @error('comment')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 @if(request()->is('student-insert-form')) d-block @else d-none @endif">
                                    <button type="reset" class="btn btn-outline-secondary mt-1">Discard</button>
                                    <button type="submit" form="insertStudent"
                                        class="btn btn-primary me-1 mt-1">Submit</button>
                                </div>
                                <div class="d-flex flex-column gap-1">
                                    <h3 class="card-title">Follow Up Details</h3>
                                    @foreach($followupDetails as $followup)
                                   <div class="card border border-info" style="width: 40rem; ">
                                    <div class="card-body">
                                  
                                      <h6 class="card-subtitle mb-1 text-body-secondary">Date-{{date('d-m-Y',strtotime($followup->followupdate))}}</h6>
                                      <p class="card-text">Comment - {{$followup->comment}}</p>
                                    </div>
                                  </div>
                                  @endforeach
                                </div>
                        </div>
                        {{-- Admin Form Start --}}
                        @isset($studentDetails)
                        @if(($studentDetails->status == 'Convert')  && (auth()->user()->admin_role_id==1))  
                        <div class="mt-4 fw-bolder">
                            <div>
                                <div class="row breadcrumbs-top ml-4">
                                    <div class="col-12">
                                        <h2 class="content-header-title float-start mb-0 mx-2">Admin Form</h2>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <section>
                                <div class="card">
                                    <div class="card-body pt-1">
                                        <div class="row">
                                            <div class="col-12 col-sm-6 col-md-4 mb-1">
                                                <label for="batch_id">Batch<sup class="text-danger f-size12">*</sup></label>
                                                <div class=" form-password-toggle">
                                                    <select class="form-control" name="batch_id" required>
                                                        <option value="">---Select---</option>
                                                        @if(isset($batches))
                                                        @foreach($batches as $batch)
                                                        <option  {{ isset($studentDetails->batch_id) && $studentDetails->batch_id == $batch->id ? 'selected' : '' }} value="{{$batch->id}}">{{$batch->name}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                    @error('batch_id')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-4 mb-1">
                                                <label for="id_number">ID Number</label>
                                                <input type="text" name="id_number" value="{{ isset($studentDetails->id_no) ? $studentDetails->id_no : '' }}"
                                                    class="form-control" id="id_number" placeholder="">
                                                @error('id_number')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-4 mb-1">
                                                <label for="first_installment_amount">First Instalment Amount<sup class="text-danger f-size12">*</sup></label>
                                                <input type="text" name="first_instalment_amount" value="{{ isset($studentDetails->fee_amt) ? $studentDetails->fee_amt : '' }}"
                                                    class="form-control" id="first_instalment_amount" placeholder="">
                                                @error('first_instalment_amount')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-sm-6 col-md-4 mb-1">
                                                <label for="first_instalment_date">First Instalment Date</label>
                                                <div class="form-password-toggle">
                                                    <input type="date" name="first_instalment_date" value="{{ isset($studentDetails->fee_date) ? date('Y-m-d',strtotime($studentDetails->fee_date)) : '' }}"
                                                        class="form-control flatpickr-input" id="first_instalment_date"
                                                        placeholder="DD-MM-YYYY">
                                                    @error('first_instalment_date')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-4 mb-1">
                                                <label for="fee_mode">Fee Mode<sup class="text-danger f-size12">*</sup></label>
                                                <div class="form-password-toggle">
                                                    <select class="form-control" name="fee_mode" id="fee_mode" required>
                                                        <option value="">-----Select----</option>
                                                        @if(isset($feeModes))
                                                        @foreach($feeModes as $feeMode)
                                                        <option value="{{$feeMode}}"  {{ isset($studentDetails->fee_mode) && $studentDetails->fee_mode == $feeMode ? 'selected' : '' }}>{{$feeMode}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                    @error('fee_mode')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-4 mb-1">
                                                <label for="second_installment_amount">Second Instalment Amount</label>
                                                <input type="number" name="second_instalment_amount" value="{{ isset($studentDetails->sec_i_amt) ? $studentDetails->sec_i_amt : '' }}"
                                                    class="form-control" id="second_instalment_amount" placeholder="">
                                                @error('second_instalment_amount')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-sm-6 col-md-4 mb-1">
                                                <label for="second_instalment_date">Second Instalment Date</label>
                                                <div class="form-password-toggle">
                                                    <input type="date" name="second_instalment_date" value="{{ isset($studentDetails->sec_i_date) ?  date('Y-m-d', strtotime($studentDetails->sec_i_date)) : '' }}" class="form-control flatpickr-input" id="second_instalment_date"
                                                        placeholder="DD-MM-YYYY">
                                                    @error('second_instalment_date')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-4 mb-1">
                                                <label for="third_instalment_amount">Third Instalment Amount</label>
                                                <input type="number" name="third_instalment_amount" value="{{ isset($studentDetails->third_i_amt) ? $studentDetails->third_i_amt : '' }}"
                                                    class="form-control" id="third_instalment_amount" placeholder="">
                                                @error('third_instalment_amount')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-4 mb-1">
                                                <label for="third_instalment_date">Third Instalment Date</label>
                                                <div class="form-password-toggle">
                                                    <input type="date" name="third_instalment_date" value="{{ isset($studentDetails->third_i_date) ?  date('Y-m-d', strtotime($studentDetails->third_i_date)) : '' }}"
                                                        class="form-control flatpickr-input" id="third_instalment_date"
                                                        placeholder="DD-MM-YYYY">
                                                    @error('third_instalment_date')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-sm-6 col-md-4 mb-1">
                                                <label for="discount">Discount</label>
                                                <input type="number" name="discount" value="{{ isset($studentDetails->discount) ?  $studentDetails->discount : '' }}"
                                                    class="form-control" id="discount" placeholder="">
                                                @error('discount')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        @endif @endif
                        @isset($studentDetails)
                        <div class="ps-2 pb-2">
                            <button type="reset" class="btn btn-outline-secondary mt-1">Discard</button>
                            <button type="submit" form="insertStudent"
                                class="btn btn-primary me-1 mt-1">Submit</button>
                        </div>
                        @endif
                        </form>
                        <!--/ form -->
                    </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->

@endsection
