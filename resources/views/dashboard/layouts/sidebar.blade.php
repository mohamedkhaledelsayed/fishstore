<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark" href="{{route('admin.home')}}">
                        <i class="mdi mdi-timer"></i>
                        <span class="hide-menu">@lang('admin.home')</span>
                    </a>
                </li>
                {{-- <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark" href="{{route('categories.index')}}">
                        <i class="fa fa-list-alt"></i>
                        <span class="hide-menu">@lang('admin.categories')</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="fa fa-list-alt"></i>
                        <span class="hide-menu">@lang('admin.main_category')</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        @foreach(get_main_cata() as $category)
                            <li class="sidebar-item">
                                <a href="{{admin('categories/').$category->id}}" class="sidebar-link">
                                    <i class="mdi mdi-account-box"></i>
                                    <span class="hide-menu"> {{$category->name}}</span>
                                </a>
                            </li>
                            @endforeach

                    </ul>
                </li> --}}
                {{-- <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark" href="{{route('vendors.index')}}">
                        <i class="mdi mdi-timer"></i>
                        <span class="hide-menu">@lang('admin.vendors')</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark" href="{{route('users.index')}}">
                        <i class="fas fa-users"></i>
                        <span class="hide-menu">@lang('admin.customers')</span>
                    </a>
                </li> --}}
                {{-- <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark" href="{{route('medical_information.index')}}">
                        <i class="fas fa-briefcase-medical"></i>
                        <span class="hide-menu">@lang('admin.medical_information')</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark" href="{{route('cities.index')}}">
                        <i class="mdi mdi-map-marker "></i>
                        <span class="hide-menu">@lang('admin.cities')</span>
                    </a>
                </li> --}}
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-account-multiple"></i>
                        <span class="hide-menu">@lang('admin.users_and_permission')</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{route('admin_users.index')}}" class="sidebar-link">
                                <i class="mdi mdi-account-box"></i>
                                <span class="hide-menu"> @lang('admin.users')</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{route('roles.index')}}" class="sidebar-link waves-effect waves-dark">
                                <i class="mdi mdi-account-network"></i>
                                <span class="hide-menu">@lang('admin.roles')</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark" href="{{route('settings.index')}}">
                        <i class="ti-settings"></i>
                        <span class="hide-menu">@lang('admin.settings')</span>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->

<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
