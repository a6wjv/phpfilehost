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
                   <h2 class="content-header-title float-start mb-0">All Batches</h2>
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
                                  Add New Batch
                               </span>
                            </button>
                         <form action="">
                            <div class="form-group search">
                               <label for="search">Search Batch Name</label>
                               <input type="text" name="search" value="{{$search}}" id="search" class="form-control" placeholder="Search">
                               <a href="{{route('batch-list')}}" type="button" class="btn"><i class="fa fa-rotate-right"></i></a>
                            </div>
                         </form>
                      </div>
                      <div class="card-datatable overflow-auto">
                         <table class="datatables-ajax table table-responsive">
                            <thead>
                               <tr>
                                  <th>Sl.No.</th>
                                  <th>Batch Name</th>
                                  <th>Action</th>
                               </tr>
                            </thead>
                            <tbody>
                             @if(count($allBatches)>0)
                             @foreach($allBatches as $key=>$batch)
                               <tr>
                                  <td>{{$allBatches->firstItem() + $key}}</td>
                                  <td>{{$batch->name}}</td>
                                  <td class="d-flex">
                                    <a class="btn btn-outline-success" href="#" id="editBatch" data-bs-toggle="modal" data-bs-target="#large" data-batch-id="{{$batch->id}}"><i class="fa fa-edit"></i></a> 
                                    <a class="btn btn-outline-danger" href="{{route('delete-batch',['id'=>$batch->id])}}" id="deleteEmployee"><i class="fa fa-trash"></i></a>
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
                   @if(count($allBatches)>0)
                   {{ $allBatches->links('pagination::bootstrap-5') }}
                   @endif 
                </div>
             </div>
          </section>
       </div>
    </div>
 </div>
 <!-- END: Content-->

 <!-- MODAL -->
<div class="modal-size-lg d-inline-block" id="batchModal">
    <div class="modal fade text-start" id="large" tabindex="-1" aria-labelledby="myModalLabel17" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
             <div class="modal-header">
                <h4 class="modal-title" id="batchModalLabel">Add Batch</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <!--CARD -->
             <div class="content-body">
 
             <!-- Basic File Browser start -->
            <section id="input-file-browser">
                <div class="card">
                    <div class="card-body pt-1">
                        <!-- form -->
                        <form action="{{ route('insert-batch') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-12 mb-1">
                                    <label class="form-label" for="">Batch</label>
                                    <div class="input-group form-password-toggle ">
                                        <input class="form-control" type="text" id="batchName" value="" name="batchName" required/>
                                            @error('batchName')<small class="-mt-3 text-red-500">{{$message}}</small>@enderror
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
                <button type="submit" id ="batchModalButton" class="btn btn-primary">Add</button>
             </div>
         </form>
          </div>
       </div>
    </div>
 </div>
 <!--MODAL END--> 
@endsection
