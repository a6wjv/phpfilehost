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
                            <h2 class="content-header-title float-start mb-0">All Files</h2>
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
                                    <form action="">
                                        <div class="form-group search">
                                            <label for="search">Search File Name</label>
                                            <input type="text" name="search" value="{{ $search }}" id="search"
                                                class="form-control" placeholder="Search">
                                            <a href="{{ route('files-list') }}" type="button" class="btn"><i
                                                    class="fa fa-rotate-right"></i></a>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-datatable overflow-auto">
                                    <table class="datatables-ajax table table-responsive">
                                        <thead>
                                            <tr>
                                                <th>Sl.No.</th>
                                                <th>File Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($allFiles) > 0)
                                                @foreach ($allFiles as $key => $file)
                                                    <tr>
                                                        <td>{{ $allFiles->firstItem() + $key }}</td>
                                                        <td>{{ $file->name }}</td>
                                                        <td class="d-flex space-between">
                                                            <button class="btn btn-outline-warning displayFileBtn me-2"
                                                                data-bs-toggle="modal" data-bs-target="#large2"
                                                                data-file="{{ $file->file }}"
                                                                data-file-password="{{ $file->password }}"><i
                                                                    class="fa fa-eye"></i></button>
                                                            <a class="btn btn-outline-success editFileBtn me-2"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#large1"href="#"
                                                                data-file-name="{{ $file->name }}"
                                                                data-file-password="{{ $file->password }}"
                                                                data-file-id="{{ $file->id }}"
                                                                data-file="{{ $file->file }}"><i
                                                                    class="fa fa-edit"></i></a>
                                                                    <button class="btn btn-primary copyFileLinkBtn" >Copy File Link</button>
                                                                    @php 
                                                                    
                                                                    @endphp
                                                     <input type="text" value="{{route('file-password-validation',['fileId'=>Crypt::encrypt($file->id)])}}"  class="fileLink d-none">
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
                            @if (count($allFiles) > 0)
                                {{ $allFiles->links('pagination::bootstrap-5') }}
                            @endif
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <!-- File Edit MODAL -->
    <div class="modal-size-lg d-inline-block">
        <div class="modal fade text-start" id="large1" tabindex="-1" aria-labelledby="myModalLabel17"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="ModalLabel">Edit File Name & Password </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!--CARD -->
                    <div class="content-body">

                        <!-- Basic File Browser start -->
                        <section id="input-file-browser">
                            <div class="card">
                                <div class="card-body pt-1">
                                    <!-- form -->
                                    <form action="" id="editFileForm" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12 col-sm-6 col-md-6 mb-1">
                                                <label for="fileName" class="form-label fs-5">New File Name</label>
                                                <div class="input-group form-password-toggle ">
                                                    <input class="form-control" type="text" id="fileName" value=""
                                                        name="fileName" required />
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-6 mb-1">
                                                <label for="filePassword" class="form-label fs-5">New File Password</label>
                                                <div class="input-group form-password-toggle ">
                                                    <input class="form-control" type="text" id="filePassword"
                                                        name="filePassword" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-sm-6 col-md-6 mb-1">
                                                <label class="form-label fs-5" for="userpassword">Update File Here</label>
                                                <div class="input-group form-password-toggle ">
                                                    <input class="form-control " type="file" value=""
                                                        name="file" />
                                                    <input class="form-control " type="hidden" value=""
                                                        id="uploadFileInput" name="hiddenFile" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                </div>

                                <!--/ form -->
                            </div>
                        </section>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--MODAL END-->
    <!-- File Display MODAL -->
    <div class="modal-size-lg d-inline-block">
        <div class="modal fade text-start" id="large2" tabindex="-1" aria-labelledby="myModalLabel17"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="ModalLabel">Your File</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!--CARD -->
                    <div class="content-body">

                        <!-- Basic File Browser start -->
                        <section id="input-file-browser">
                            <div class="card">
                                <div class="card-body pt-1">
                                    <!-- form -->
                                    <div>
                                        <object class="d-block m-auto w-50 h-100" data=""
                                            id="fileDisplay"></object>
                                    </div>
                                </div>
                                <!--/ form -->
                            </div>
                        </section>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- File Display MODAL-->

    <script>
        //   document.getElementById('showfilePasswordBtn').addEventListener("click", function() {
        //       document.getElementById('passwordInput').value = this.getAttribute('data-file-password');
        //   });


        const displayFileBtns = document.querySelectorAll('.displayFileBtn');
        // Attach event listener to each button
        displayFileBtns.forEach(function(displayFileBtn) {
            displayFileBtn.addEventListener('click', function() {
                let fileName = this.getAttribute("data-file");
                document.getElementById('fileDisplay').setAttribute("data",
                    `{{ asset('assets/UploadedFiles/${fileName}') }}`);
            });
        });

        const editFileBtns = document.querySelectorAll('.editFileBtn');
        // Attach event listener to each button
        editFileBtns.forEach(function(editFileBtn) {
            editFileBtn.addEventListener('click', function() {
                let fileName = this.getAttribute("data-file-name");
                let filePassword = this.getAttribute("data-file-password");
                let Id = this.getAttribute("data-file-id");
                let file = this.getAttribute("data-file");
                document.getElementById('fileName').value = fileName;
                document.getElementById('filePassword').value = filePassword;
                document.getElementById('uploadFileInput').value = file;
                document.getElementById('editFileForm').setAttribute("action",
                    `{{ url('update-file/${Id}') }}`);
            });
        });

        // copy file link

        const copyFileLinkBtns = document.querySelectorAll('.copyFileLinkBtn');
        // Attach event listener to each button
        copyFileLinkBtns.forEach(function(copyFileLinkBtn) {
            copyFileLinkBtn.addEventListener('click', function() {
                let fileLink = this.nextElementSibling.value;
                console.log(fileLink);
                navigator.clipboard.writeText(fileLink);
            });
        });
        function copyFileLink(e) {
            var fileLink = document.getElementById("fileLink").value;
             console.log(e);
            fileLink.select();
            document.execCommand("copy");
        }
    </script>
@endsection
