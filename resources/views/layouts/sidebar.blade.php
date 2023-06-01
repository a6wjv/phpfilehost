 <!-- BEGIN: sidebar Menu-->
 <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto"><a class="navbar-brand" href="{{url('/')}}/dashboard"> <img src="#" style="width: 70px "alt=""></span>
                    <h2 class="brand-text"></h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="@if ((request()->is('dashboard'))) active @endif" class=" nav-item"><a class="d-flex align-items-center" href="{{url('/')}}/dashboard"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboards</span><span class="badge badge-light-warning rounded-pill ms-auto me-1">2</span></a></li>
            @if(\App\Models\RoleMenu::where('role_id',session()->get('user_role_id'))->first()!=NULL)
                @php
                $user_role_id= session()->get('user_role_id');
                $role_record =\App\Models\RoleMenu::where('role_id',$user_role_id)->first();
                $selected_menu = explode(",", $role_record->menu_id);
                @endphp 
                 
                @foreach ($sidebars as $mainmenu)
                {!!in_array($mainmenu->id, $selected_menu)?"
                    <li class='nav-item' class='@if ((request()->is($mainmenu->url))) active @endif' style=''>
                        <a class='d-flex align-items-center' href='$mainmenu->url'>
                            <i class='fa-solid fa-role'></i>
                            <span class='menu-title text-truncate'>
                                $mainmenu->menu_name
                            </span>
                        </a>
                ":""!!}
                
                 @php $data=\App\Models\Menu::where('parent_id',$mainmenu->id)->get();
                 @endphp
                 @if(count($data))
                 <ul class="menu-content">
                 @foreach ($data as $submenu)
                 <li class="@if ((request()->is('admin/addmanufacture'))) active @endif"><a class="d-flex align-items-center" href="{{url($submenu->url)}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg><span class="menu-item text-truncate" data-i18n="Shop">{{ $submenu->menu_name }}</span></a>
                 </li>
                 @endforeach
                 </ul>
                 @endif
                </li>

                @endforeach 
                @endif
          </ul>
    </div>
  </div>
   <!-- End: sidebar Menu-->