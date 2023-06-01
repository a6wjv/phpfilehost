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
                   <h2 class="content-header-title float-start mb-0">All Roles</h2>
                </div>
             </div>
          </div>
       </div>
       <div class="content-body">
          <section id="ajax-datatable">
             <div class="row">
                <div class="col-12">
                   <div class="card">
                    @if (Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }} text-center fs-3">
                     {{ Session::get('message') }}</p>
                    @endif
                      <div class="card-header border-bottom">
                            <button id="addEmployeeButton" class="dt-button create-new btn btn-primary" data-bs-toggle="modal" data-bs-target="#large" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="modal" data-bs-target="#employeeModal">
                               <span>
                                  <svg  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                                     <line x1="12" y1="5" x2="12" y2="19"></line>
                                     <line x1="5" y1="12" x2="19" y2="12"></line>
                                  </svg>
                                  Add New Role
                               </span>
                            </button>
                         <form action="">
                            <div class="form-group search">
                               <label for="search">Search Role Name</label>
                               <input type="text" name="search" value="{{$search}}" id="search" class="form-control" placeholder="Search">
                               <a href="{{route('role-list')}}" type="button" class="btn"><i class="fa fa-rotate-right"></i></a>
                            </div>
                         </form>
                      </div>
                      <div class="card-datatable overflow-auto">
                         <table class="datatables-ajax table table-responsive">
                            <thead>
                               <tr>
                                  <th>Sl.No.</th>
                                  <th>Role Name</th>
                                  <th>Action</th>
                               </tr>
                            </thead>
                            <tbody>
                             @if(count($allRoles)>0)
                             @foreach($allRoles as $key=>$role)
                               <tr>
                                  <td>{{$allRoles->firstItem() + $key}}</td>
                                  <td>{{$role->name}}</td>
                                  <td class="d-flex">
                                    <a class="btn btn-outline-success" href="#" id="editRole" data-bs-toggle="modal" data-bs-target="#large" data-role-id="{{$role->id}}" data-role-name="{{$role->name}}"><i class="fa fa-edit"></i></a> 
                                    <a class="btn btn-outline-danger" href="{{route('delete-role',['id'=>$role->id])}}" id="deleteRole"><i class="fa fa-trash"></i></a>
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
                   @if(count($allRoles)>0)
                   {{ $allRoles->links('pagination::bootstrap-5') }}
                   @endif 
                </div>
             </div>
          </section>
       </div>
    </div>
 </div>
 <!-- END: Content-->

 <!-- MODAL -->
<div class="modal-size-lg d-inline-block" id="roleModal">
    <div class="modal fade text-start" id="large" tabindex="-1" aria-labelledby="myModalLabel17" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
             <div class="modal-header">
                <h4 class="modal-title" id="roleModalLabel">Add Role</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <!--CARD -->
             <div class="content-body">
 
             <!-- Basic File Browser start -->
            <section id="input-file-browser">
                <div class="card">
                    <div class="card-body pt-1">
                        <!-- form -->
                        <form action="{{ route('insert-role') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-12 mb-1">
                                    <label class="form-label" for="roleName">Role</label>
                                    <div class="input-group form-password-toggle ">
                                        <input class="form-control" type="text" id="roleName" value="" name="roleName" required/>
                                            @error('roleName')<small class="-mt-3 text-red-500">{{$message}}</small>@enderror
                                    </div>
                                </div>
                            </div>
                    </div>
                
                    <!--/ form -->
                </div>
            </section>
         </div>
             <!--CARD END-->
             <div class="modal-footer">
                <button type="submit" id ="roleModalButton" class="btn btn-primary">Add</button>
             </div>
         </form>
          </div>
       </div>
    </div>
 </div>
 <!--MODAL END--> 
@endsection
