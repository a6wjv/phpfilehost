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
                            <h2 class="content-header-title float-start mb-0">Menu Management</h2>
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
                                <!-- <div class="card-header border-bottom">
                                       <button id="addRoleButton" class="dt-button create-new btn btn-primary" data-bs-toggle="modal" data-bs-target="#large" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="modal" data-bs-target="#modals-slide-in">
                                          <span>
                                             <svg  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                             </svg>
                                             Add New Role
                                          </span>
                                       </button>
                                 </div> -->
                                <div class="card-datatable">
                                    <table class="datatables-ajax table table-responsive">
                                        <thead>
                                            <tr>
                                                <th>Sl.No.</th>
                                                <th>Roles</th>
                                                <th style="padding-left:250px">Menus</th>
                                                <th>Save</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $sl=1 @endphp
                                            @if (count($roles) > 0)
                                                @foreach ($roles as $role)
                                                    <tr>
                                                        <form action="{{ route('set-menu') }}" method="POST">
                                                            @csrf
                                                            <td>{{ $sl }}</td>
                                                            <td>{{ $role->name }}</td>
                                                            <td>
                                                                <input type="hidden" name="role_id"
                                                                    value="{{ $role->id }}">
                                                                <div class="row">
                                                                    @foreach ($menus as $menu)
                                                                        <div
                                                                            class="col-sm-6 col-md-6 mb-1 d-flex align-items-end">
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" id="Checkbox4"
                                                                                    value="{{ $menu->id }}"
                                                                                    name="menu_id[]"
                                                                                    @foreach ($roleMenus as $roleMenu)
                                                                                 @if ($roleMenu->role_id == $role->id)
                                                                                 @php $menuId = explode(',', $roleMenu->menu_id); @endphp
                                                                                    @foreach ($menuId as $value){{ $value == $menu->id  ? 'checked' : '' }} @endforeach
                                                                                 @endif
                                                                    @endforeach>
                                                                    <label class="form-check-label"
                                                                        for="Checkbox4">{{ $menu->menu_name }}</label>
                                                                </div>
                                </div>
                                @endforeach
                            </div>
                            </td>
                            @if (Illuminate\Support\Facades\Auth::user()->role_id != $role->id)
                                <td><button type="submit" id="setMenuButton" class="btn btn-primary"
                                        data-bs-dismiss="modal">Save</button></td>
                            @endif
                            </form>
                            </tr>
                            @php $sl++;@endphp
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
            </div>
        </div>
        </section>
    </div>
    </div>
    </div>
    <!-- END: Content-->
@endsection
