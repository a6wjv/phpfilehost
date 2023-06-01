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
                            <h2 class="content-header-title float-start mb-0">Update Your Profile Password</h2>
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
                            <form action="{{ $url }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class=" col-sm-6 col-md-6 mb-1">
                                        <label class="form-label" for="userid">User Id</label>
                                        <div class="input-group form-password-toggle ">
                                            <input class="form-control" type="email" id="userid" max-lenght="10"
                                                value="{{ isset($userdata) ? $userdata->email : '' }}" name="userid"
                                                required />
                                        </div>
                                    </div>
                                    <div class=" col-sm-6 col-md-6 mb-1">
                                        <label class="form-label" for="userpassword">Password</label>
                                        <div class="input-group form-password-toggle ">
                                            <input class="form-control" type="password" id="userpassword" value=""
                                                name="userpassword" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class=" col-sm-6 col-md-6 mb-1">
                                        <label class="form-label" for="userid">Name</label>
                                        <div class="input-group form-password-toggle ">
                                            <input class="form-control" type="text"  max-lenght="10"
                                                value="{{ isset($userdata) ? $userdata->name: '' }}" name="name"
                                                required />
                                        </div>
                                    </div>
                                    <div class=" col-sm-6 col-md-6 mb-1">
                                        <label class="form-label" for="userpassword">Profile Picture</label>
                                        <div class="input-group form-password-toggle ">
                                            <input class="form-control" type="file" 
                                                name="profilePicture" />
                                                <input type="hidden" name="userImage" type="file" value="{{ isset($userdata) ? $userdata->image: '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--/ form -->
            </div>
            </section>
        </div>
        <!--CARD END-->

    </div>
    </div>
    </div>
    <!-- END: Content-->

    {{-- <!-- MODAL -->
<div class="modal-size-lg d-inline-block" id="LeadModal">
   <div class="modal fade text-start" id="large" tabindex="-1" aria-labelledby="myModalLabel17" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="myModalLabel17">Enter Your Lead Details</h4>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!--CARD -->
            <div class="content-body">

           
         </div>
      </div>
   </div>
</div>
<!--MODAL END-->   --}}
@endsection
