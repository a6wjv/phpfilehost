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
                            <h2 class="content-header-title float-start mb-0">Upload File</h2>
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
                            <form action="{{ $url }}" method="POST"  enctype="multipart/form-data">
                                @csrf
                                <div class="row  fw-bold">
                                    <div class=" col-sm-4 col-md-4 offset-4 mb-1">
                                        <label class="form-label fs-5" for="userid">Enter Name Of File</label>
                                        <div class="input-group form-password-toggle ">
                                            <input class="form-control" type="text"  max-lenght="10"
                                                value="" required name="fileName"/>
                                        </div>
                                    </div>
                                    <div class=" col-sm-4 col-md-4 offset-4 mb-1">
                                        <label class="form-label fs-5" for="userpassword">Upload File Here</label>
                                        <div class="input-group form-password-toggle ">
                                            <input class="form-control" type="file" value=""
                                                name="file" required />
                                        </div>
                                    </div>
                                    <div class=" col-sm-4 col-md-4 offset-4 mb-1">
                                        <label class="form-label fs-5" for="userpassword">Password</label>
                                        <div class="input-group form-password-toggle ">
                                            <input class="form-control" type="text"  value=""
                                                name="password"  id="password" required />
                                        </div>
                                        <div class="d-flex justify-content-end mt-2 gap-4">
                                        <button type="button" class="btn btn-primary" onclick="genPassword()">Generate Password</button>
                                        <button type="button" class="btn btn-primary" onclick="copyPassword()">Copy</button>
                                      </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary mx-auto">Upload</button>
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
<script>
var password=document.getElementById("password");

function genPassword() {
   var chars = "0123456789abcdefghijklmnopqrstuvwxyz!@#$%^&*()ABCDEFGHIJKLMNOPQRSTUVWXYZ";
   var passwordLength = 12;
   var password = "";
for (var i = 0; i <= passwordLength; i++) {
  var randomNumber = Math.floor(Math.random() * chars.length);
  password += chars.substring(randomNumber, randomNumber +1);
 }
       document.getElementById("password").value = password;
}

function copyPassword() {
 var copyText = document.getElementById("password");
 copyText.select();
 document.execCommand("copy");  
}
</script>
   
@endsection
