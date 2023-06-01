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
                   <h2 class="content-header-title float-start mb-0">All Employees</h2>
                </div>
             </div>
          </div>
       </div>
       <div class="content-body">
          <section id="ajax-datatable">
             <div class="row">
                <div class="col-12">
                   <div class="card">
                     @if(Session::has('message'))
                     <p class="alert {{ Session::get('alert-class', 'alert-info') }} text-center fs-3" >{{ Session::get('message') }}</p>
                     @endif
                     @error('email')<h3 class="alert {{ Session::get('alert-class', 'alert-danger') }} text-center fs-3">{{$message}}</h3>@enderror
                     @error('mobile')<h3 class="alert {{ Session::get('alert-class', 'alert-danger') }} text-center fs-3">The Mobile Number Has Already Been Taken</h3>@enderror
                      <div class="card-header border-bottom">
                            <button id="addEmployeeButton" class="dt-button create-new btn btn-primary" data-bs-toggle="modal" data-bs-target="#large" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="modal" data-bs-target="#employeeModal">
                               <span>
                                  <svg  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                                     <line x1="12" y1="5" x2="12" y2="19"></line>
                                     <line x1="5" y1="12" x2="19" y2="12"></line>
                                  </svg>
                                  Add New Employee
                               </span>
                            </button>
                         <form action="">
                            <div class="form-group search">
                               <label for="search">Search Employee Name</label>
                               <input type="text" name="search-employee" value="{{ $search }}" id="search-employee" class="form-control" placeholder="Search">
                               <a href="{{route('employee')}}" type="button" class="btn"><i class="fa fa-rotate-right"></i></a>
                            </div>
                         </form>
                      </div>
                      <div class="card-datatable overflow-auto">
                         <table class="datatables-ajax table table-responsive">
                            <thead>
                               <tr>
                                  <th>Sl.No.</th>
                                  <th>Name</th>
                                  <th>Mobile</th>
                                  <th>Role</th>
                                  <th>Action</th>
                               </tr>
                            </thead>
                            <tbody>
                             @if(count($employees)>0)
                             @foreach($employees as $key=>$employee)
                               <tr>
                                  <td>{{$employees->firstItem() + $key}}</td>
                                  <td class="">{{$employee->name}}<span class="bg-primary w-auto text-white rounded float-end p4px">{{count($employee->getStudents)}}</span></td>
                                  <td>{{$employee->phone}}</td>
                                  <td>{{$employee->role->name}}</td>
                                  <td class="d-flex">
                                @if($employee->role->name == 'Master Admin')
                                    @if(Auth::guard('admin')->user()->role->name == 'Master Admin')
                                    <a class="btn btn-outline-success" href="#" id="editEmployee" data-bs-toggle="modal" data-bs-target="#large" data-employee-id="{{$employee->id}}"><i class="fa fa-edit"></i></a>
                                    @else
                                        <button class="btn btn-outline-primary">Admin Only</button>
                                    @endif  
                                @else
                                    <a class="btn btn-outline-success" href="#" id="editEmployee" data-bs-toggle="modal" data-bs-target="#large" data-employee-id="{{$employee->id}}"><i class="fa fa-edit"></i></a>
                                    <a class="btn btn-outline-danger" href="delete-employee/{{$employee->id}}" id="deleteEmployee"><i class="fa fa-trash"></i></a>
                                @endif  
                                  </td>
                               </tr>
                             @endforeach
                             @else
                               <tr>
                                 <td colspan="8" class="text-center">No Data Found</td>
                               </tr>
                             @endif
                            </tbody>
                         </table>
                      </div>
                   </div>
                   @if(count($employees)>0)
                   {{ $employees->links('pagination::bootstrap-5') }}
                   @endif 
                </div>
             </div>
          </section>
       </div>
    </div>
 </div>
 <!-- END: Content-->

 <!-- MODAL -->
<div class="modal-size-lg d-inline-block" id="employeeModal">
    <div class="modal fade text-start" id="large" tabindex="-1" aria-labelledby="myModalLabel17" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
             <div class="modal-header">
                <h4 class="modal-title" id="employeeModalLabel">Add Employee</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <!--CARD -->
             <div class="content-body">
 
             <!-- Basic File Browser start -->
            <section id="input-file-browser">
                <div class="card">
                    <div class="card-body pt-1">
                        <!-- form -->
                        <form action="{{ route('insert-employee') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-6 mb-1">
                                    <label class="form-label" for="">Name<sup class="text-danger f-size12">*</sup></label>
                                    <div class="input-group form-password-toggle ">
                                        <input class="form-control" type="text" id="employeeName"
                                            value=""
                                            name="name" required/>
                                            @error('name')<small class="-mt-3 text-red-500">{{$message}}</small>@enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 mb-1">
                                    <label class="form-label" for="">Mobile Number<sup class="text-danger f-size12">*</sup></label>
                                    <div class="input-group form-password-toggle ">
                                        <input class="form-control" type="number" id="employeeMobile" min="10"  max-lenght="10"
                                            value=""
                                            name="phone" required/>
                                    </div>
                                    @error('mobile')<small class="-mt-3 text-red-500">{{$message}}</small>@enderror
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-12 col-sm-6 col-md-6 mb-1">
                                <label class="form-label" for=""> E-mail <sup class="text-danger f-size12">*</sup></label>
                                <div class="input-group form-password-toggle ">
                                    <input class="form-control" type="email" id="employeeEmail"
                                        value=""
                                        name="email"  required/>
                                </div>
                                @error('password')<small class="-mt-3 text-red-500">{{$message}}</small>@enderror
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 mb-1"  id="passwordInput">
                                <label class="form-label" for="">Password</label>
                                <div class="input-group form-password-toggle ">
                                <input class="form-control" type="password" id="employeePassword" 
                                        value=""
                                        name="password"/>
                                </div>
                                @error('password')<small class="-mt-3 text-red-500">{{$message}}</small>@enderror
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-6 mb-1">
                                    <label class="form-label" for="">Roles<sup class="text-danger f-size12">*</sup></label>
                                    <select class="form-select" id="employeeRole" name="admin_role_id" required >
                                        <option value="">Select</option>
                                      @foreach ($admin_roles as $admin_role)
                                        <option value="{{$admin_role->id}}">{{$admin_role->name}}</option>
                                      @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 mb-1">
                                    <label class="form-label" for="">Photo</label>
                                    <div class="input-group form-password-toggle ">
                                        <input class="form-control" type="file" id="employeePhoto"
                                            name="image"   />
                                    </div>
                                    @error('photo')<small class="-mt-3 text-red-500">{{$message}}</small>@enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-6 mb-1">
                                    <div id="employeeDocuments"></div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 mb-1">
                                    <div id="employeeImage"></div>
                                </div>
                            </div>
                    </div>
                
                    <!--/ form -->
                </div>
            </section>
         </div>
             <!--CARD END-->
             <div class="modal-footer">
                <button type="submit" id ="employeeModalButton" class="btn btn-primary">Add</button>
             </div>
         </form>
          </div>
       </div>
    </div>
 </div>
 <!--MODAL END--> 
@endsection
