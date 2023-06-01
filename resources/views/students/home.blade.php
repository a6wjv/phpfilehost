@extends('layouts.layout')
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9  mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="">
                            <h2 class="content-header-title float-start mb-0 d-flex w-50 "><div> Students - </div> <div class="ms-1 bg-primary w-auto text-center text-white px-1 rounded">{{App\Models\User::count()}}</div></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="ajax-datatable">
                    <div class="row">
                        <div class="">
                            <div class="card">
                                @if (Session::has('message'))
                                    <p class="alert {{ Session::get('alert-class', 'alert-info') }} text-center fs-3">
                                     {{ Session::get('message') }}</p>
                                @endif
                                <form action="{{route('search-student')}}" method="get">
                                    @csrf
                                    <div class="card-header border-bottom">
                                        <div class="col-sm-3 px-1">
                                            <select class="form-control" id="category_id" name="category">
                                                <option value="" selected>---Select Category---</option>
                                                <option value="GENERAL">GENERAL</option>
                                                <option value="OBC">OBC</option>
                                                <option value="SC">SC</option>
                                                <option value="ST">ST</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-3 px-1">
                                            <select class="form-control" id="interest_id" name="interest">
                                                <option value="" selected>---Select Interest---</option>
                                                <option value="HIGH">HIGH</option>
                                                <option value="MEDIUM">MEDIUM</option>
                                                <option value="LOW">LOW</option>                                            
                                            </select>
                                        </div>
                                        <div class="col-sm-3 px-1">
                                            <select class="form-control" id="course_id" name="course">
                                                <option value="" selected>---Select Course---</option>
                                                <option  value="Drop">Drop</option>
                                                <option value="Crash">Crash</option>
                                                <option value="Foundation">Foundation</option>
                                                <option value="Regular">Regular</option>
                                                <option value="Capsule">Capsule</option>
                                            </select> 
                                        </div>
                                        <div class="col-sm-3 px-1">
                                            <select class="form-control" id="fee_mode" name="fee_mode">
                                                <option value="" selected>--- Fee Mode---</option>
                                                <option value="Cash">Cash</option>
                                                <option value="Online">Online</option>
                                                <option value="UPI">UPI</option>             
                                                <option value="UTR">UTR</option>             
                                                <option value="Cheque No">Cheque No</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4 px-1 py-1">
                                            <select class="form-control" id="batch_id" name="batch_id">
                                                <option value="" selected>--- Select Batch---</option>
                                                @foreach($batches as $batch)
                                                <option  {{ isset($studentDetails->batch_id) && $studentDetails->batch_id == $batch->id ? 'selected' : '' }} value="{{$batch->id}}">{{$batch->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-4 px-1">
                                            <select class="form-control" id="emp_name" name="emp_name" >
                                                <option value="" selected>--- Employee Name ---</option>
                                            @foreach ($employees as $employee)
                                                <option value="{{$employee->id}}">{{$employee->name}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-4 px-1">
                                            <select class="form-control" id="status_id" name="status">
                                                <option value="" selected>---Select Status---</option>
                                                <option value="Open">OPEN</option>
                                                <option value="Lost">LOST</option>
                                                <option value="Convert">CONVERT</option>                                            
                                            </select> 
                                        </div>
                                        <div class="col-sm-3 px-1">
                                            <label for="name">Enq. Date</label>
                                            <input class= "form-control flatpickr-input" type="date" id="enqdate" name="enqdate" placeholder="DD-MM-YYYY"> 
                                        </div>
                                        <div class="col-sm-3 px-1">
                                            <label for="name">Start Date</label>
                                              <input class= "form-control flatpickr-input" type="date" id="startdate" name="startdate" placeholder="DD-MM-YYYY">
                                        </div>
                                        <div class="col-sm-3 px-1">
                                            <label for="name">End Date</label>
                                            <input class= "form-control flatpickr-input" type="date" id="enddate" name="enddate" placeholder="DD-MM-YYYY">
                                        </div>
                                        <div class="col-sm-3 px-1">
                                            <label for="name">Follow Up Date</label>
                                            <input class= "form-control flatpickr-input" type="date" id="followupdate" name="followupdate" placeholder="DD-MM-YYYY" > 
                                        </div>
                                        <div class="col-sm-12 input-group px-1 py-1 ">
                                            <input type="text" class="form-control" name="search_student" placeholder="Search By Name or Phone number">
                                        </div>
                                        <div class="px-1">
                                            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i>&nbsp; Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            @if(auth()->user()->admin_role_id==1 || auth()->user()->admin_role_id==12)
            <div class="content-body">
                <section id="ajax-datatable">
                    <div class="row">
                        <div class="">
                            <div class="card">
                                {{-- @if (Session::has('message'))
                                    <p class="alert {{ Session::get('alert-class', 'alert-info') }} text-center fs-3">
                                     {{ Session::get('message') }}</p>
                                @endif --}}
                                <div class="card-header border-bottom">
                                    <a href="{{route('student-insert-form')}}" id="addStudent" class="create-new btn btn-primary" type="button">
                                        <span>
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                            </svg>
                                            Add New Student
                                        </span>
                                    </a>
                                    
                                    @if(isset($studentSearchResults) && isset($studentSearchResults[0]))
                                    @php
                                    $studentsID=[];
                                    foreach($studentSearchResults as $value){
                                     $studentsID[] = $value->id;
                                    }
                                   $arr= implode(',', $studentsID)
                                     @endphp
                                   <div class="bg-primary text-white px-2 py-0 fs-4 rounded">{{$totalStudents}} - @if($totalStudents<2) Record Found @else Record Found @endif </div>        
                                    <a href="{{ route('export-students-search-results',['id'=>$arr])}}" type="button" class="btn btn-success" data-bs-toggle="modal1" data-bs-target="#studentExportModalBySearchResults" >Export</a>
                                    @endif
                                    @if(!isset($studentSearchResults))
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#studentExportModal" >Export</button>
                                    @endif
                                </div>
                                <div class="card-datatable">
                                    <table class="datatables-ajax table table-responsive">
                                        @if(count($students)>0)
                                        <thead>
                                            <tr>
                                                <th>Sl.No.</th>
                                                <th>ENQUIRY DATE</th>
                                                <th>EMPLOYEE NAME</th>
                                                <th>NAME</th>
                                                <th>MOBILE</th>
                                                <th>STATUS</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($students as $key=>$student)
                                              <tr>
                                                <td>{{$students->firstItem() + $key}}</td>
                                                <td>{{date('d-m-Y',strtotime($student->enqdate))}}</td>
                                                <td>{{$student->user_name}}</td>
                                                <td>{{$student->f_name.' '.$student->l_name}}</td>
                                                <td>{{$student->phone}}</td>
                                                <td>{{$student->status}}</td>
                                                <td> <a class="btn btn-outline-warning" href="{{route('students-details',['studentId'=>$student->id])}}"><i class="fa fa-eye"></i></a>
                                                     <a class="btn btn-outline-success" href="{{route('edit-student-details',['studentId'=>$student->id])}}"><i class="fa fa-edit"></i></a>
                                                    @if(auth()->user()->admin_role_id==1)
                                                    <a class="btn btn-outline-danger" onclick="alert('Are you sure')" href="{{route('delete-student-details',['studentId'=>$student->id])}}" id="deleteEmployee"><i class="fa fa-trash"></i></a>@endif
                                                </td>
                                              </tr>
                                            @endforeach
                                            @else
                                              <tr>
                                                <img  class="mx-auto  d-block" src="{{asset('assets/img/NoRecordFound.jpg')}}" style="height:60px">
                                              </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                 
                                </div>
                            </div>
                            @if (count($students) > 0)
                                {{ $students->links('pagination::bootstrap-5') }}
                            @endif
                        </div>
                    </div>
                </section>
            </div>
            @endif
        </div>
    </div>
    <!-- END: Content-->

  
  <!-- Modal 1 Start-->
  <div class="modal fade" id="studentExportModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Export Student</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form  action="{{ route('export-student') }}" method="POST"  id="studentExportForm">
        @csrf
        
        <div class="modal-body">
            <p class="font-weight-bold">Select the dates to export Students between two dates</p>
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4 mb-1">
                    <label class="form-label" for="dob">From</label>
                    <div class="form-password-toggle">
                        <input class="form-control flatpickr-input" name="exportStudent_from" type="date" value="" placeholder="DD-MM-YYYY" required/>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 mb-1">
                    <label class="form-label" for="dob">To</label>
                    <div class="form-password-toggle">
                        <input class="form-control flatpickr-input" name="exportStudent_to" type="date" value="" placeholder="DD-MM-YYYY" required/>
                    </div>
                </div>
            </div>
            {{-- <div class="form-check">
                <input class="form-check-input" type="checkbox" name="export_all" value="1" id="exportAllstudents">
                <label class="form-check-label" for="exportAllstudents">
                  Export All Students
                </label>
              </div>
            </div> --}}
        
        <div>
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal" >Export In Excel</button>
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="pdfExportBtn">Export In PDF</button>
        </div>
       </form>
      </div>
    </div>
  </div>
  <!-- Modal 1 End-->
 
@endsection
