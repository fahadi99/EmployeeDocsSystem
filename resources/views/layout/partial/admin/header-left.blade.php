<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
    <!--begin::Header Menu-->
    <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
        <!--begin::Header Nav-->
        <div class="menu-logo">
            <a href="{{route('home')}}" class="brand-logo">

            </a>
        </div>
        <ul class="menu-nav" >

            {{-- can is being used for permissions --}}
            @can('is_super_admin')
            <li class="menu-item menu-item-open  menu-item-submenu menu-item-rel menu-click" data-menu-toggle="click"
                aria-haspopup="true">
                <a href="{{route('documents.index')}}" class="menu-link menu-toggle">
                    <span class="menu-text">E Docs</span>
                    <i class="menu-arrow"></i>
                </a>
            </li>
            @endcan

            @can('is_super_admin')
            <li class="menu-item menu-item-open  menu-item-submenu menu-item-rel menu-click" data-menu-toggle="click"
                aria-haspopup="true">
                <a href="{{url('members')}}" class="menu-link menu-toggle">
                    <span class="menu-text">Employee</span>
                    <i class="menu-arrow"></i>
                </a>
            </li>
            @endcan

            @if(checkPersonPermission('survey-form-view-3-0'))
            <li class="menu-item menu-item-open  menu-item-submenu menu-item-rel menu-click" data-menu-toggle="click"
                aria-haspopup="true">
                <a href="{{route('survey.index')}}" class="menu-link menu-toggle">
                    <span class="menu-text">Survey</span>
                    <i class="menu-arrow"></i>
                </a>
            </li>
            @endif



            <!-- Settings -->
            <li class="menu-item menu-item-submenu"  data-menu-toggle="click" aria-haspopup="true">
                <a href="javascript:;" class="menu-link menu-toggle">
                    <span class="menu-text">Settings</span>
                    <i class="menu-arrow"></i>
                </a>


                <div class="menu-submenu menu-submenu-fixed menu-submenu-left" style="width:1000px; z-index: 100;" data-hor-direction="menu-submenu-left">
                    <div class="menu-subnav" >
                        <ul class="menu-content">
                            @if(checkPersonPermission('person-root-3-0'))
                                <li class="menu-item">
                                    <h3 class="menu-heading menu-toggle">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                            <span class="menu-text">Persons</span>
                                        <i class="menu-arrow"></i>
                                    </h3>
                                    <ul class="menu-inner">
                                        @if(checkPersonPermission('view-domain-3-0'))
                                            <li class="menu-item" aria-haspopup="true">
                                            <a href="{{route('domains.index')}}" class="menu-link">
                                                <span class="svg-icon menu-icon">
                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Clothes/Briefcase.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"></rect>
                                                            <path d="M5.84026576,8 L18.1597342,8 C19.1999115,8 20.0664437,8.79732479 20.1528258,9.83390904 L20.8194924,17.833909 C20.9112219,18.9346631 20.0932459,19.901362 18.9924919,19.9930915 C18.9372479,19.9976952 18.8818364,20 18.8264009,20 L5.1735991,20 C4.0690296,20 3.1735991,19.1045695 3.1735991,18 C3.1735991,17.9445645 3.17590391,17.889153 3.18050758,17.833909 L3.84717425,9.83390904 C3.93355627,8.79732479 4.80008849,8 5.84026576,8 Z M10.5,10 C10.2238576,10 10,10.2238576 10,10.5 L10,11.5 C10,11.7761424 10.2238576,12 10.5,12 L13.5,12 C13.7761424,12 14,11.7761424 14,11.5 L14,10.5 C14,10.2238576 13.7761424,10 13.5,10 L10.5,10 Z" fill="#000000"></path>
                                                            <path d="M10,8 L8,8 L8,7 C8,5.34314575 9.34314575,4 11,4 L13,4 C14.6568542,4 16,5.34314575 16,7 L16,8 L14,8 L14,7 C14,6.44771525 13.5522847,6 13,6 L11,6 C10.4477153,6 10,6.44771525 10,7 L10,8 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <span class="menu-text">Domains</span>
                                            </a>
                                        </li>
                                        @endif
                                        @if(checkPersonPermission('view-organization-3-0'))
                                            <li class="menu-item" aria-haspopup="true">
                                            <a href="{{url('organizations')}}" class="menu-link">
                                                                            <span class="svg-icon menu-icon">
                                                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Clothes/Crown.svg-->
                                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                                                        <path d="M11.2600599,5.81393408 L2,16 L22,16 L12.7399401,5.81393408 C12.3684331,5.40527646 11.7359848,5.37515988 11.3273272,5.7466668 C11.3038503,5.7680094 11.2814025,5.79045722 11.2600599,5.81393408 Z" fill="#000000" opacity="0.3"></path>
                                                                                        <path d="M12.0056789,15.7116802 L20.2805786,6.85290308 C20.6575758,6.44930487 21.2903735,6.42774054 21.6939717,6.8047378 C21.8964274,6.9938498 22.0113578,7.25847607 22.0113578,7.535517 L22.0113578,20 L16.0113578,20 L2,20 L2,7.535517 C2,7.25847607 2.11493033,6.9938498 2.31738608,6.8047378 C2.72098429,6.42774054 3.35378194,6.44930487 3.7307792,6.85290308 L12.0056789,15.7116802 Z" fill="#000000"></path>
                                                                                    </g>
                                                                                </svg>
                                                                                <!--end::Svg Icon-->
                                                                            </span>

                                                <span class="menu-text">Organizations</span>
                                            </a>
                                        </li>
                                        @endif
                                        @if(checkPersonPermission('view-designation-3-0'))
                                            <li class="menu-item" aria-haspopup="true">
                                            <a href="{{url('designations')}}" class="menu-link">
                                                                            <span class="svg-icon menu-icon">
                                                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Clothes/Crown.svg-->
                                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                                                        <path d="M11.2600599,5.81393408 L2,16 L22,16 L12.7399401,5.81393408 C12.3684331,5.40527646 11.7359848,5.37515988 11.3273272,5.7466668 C11.3038503,5.7680094 11.2814025,5.79045722 11.2600599,5.81393408 Z" fill="#000000" opacity="0.3"></path>
                                                                                        <path d="M12.0056789,15.7116802 L20.2805786,6.85290308 C20.6575758,6.44930487 21.2903735,6.42774054 21.6939717,6.8047378 C21.8964274,6.9938498 22.0113578,7.25847607 22.0113578,7.535517 L22.0113578,20 L16.0113578,20 L2,20 L2,7.535517 C2,7.25847607 2.11493033,6.9938498 2.31738608,6.8047378 C2.72098429,6.42774054 3.35378194,6.44930487 3.7307792,6.85290308 L12.0056789,15.7116802 Z" fill="#000000"></path>
                                                                                    </g>
                                                                                </svg>
                                                                                <!--end::Svg Icon-->
                                                                            </span>
                                                <span class="menu-text">Designations</span>
                                            </a>
                                        </li>
                                        @endif
                                        @if(checkPersonPermission('view-department-3-0'))
                                            <li class="menu-item" aria-haspopup="true">
                                            <a href="{{url('departments')}}" class="menu-link">
                                                                            <span class="svg-icon menu-icon">
                                                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Clothes/Crown.svg-->
                                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                                                        <path d="M11.2600599,5.81393408 L2,16 L22,16 L12.7399401,5.81393408 C12.3684331,5.40527646 11.7359848,5.37515988 11.3273272,5.7466668 C11.3038503,5.7680094 11.2814025,5.79045722 11.2600599,5.81393408 Z" fill="#000000" opacity="0.3"></path>
                                                                                        <path d="M12.0056789,15.7116802 L20.2805786,6.85290308 C20.6575758,6.44930487 21.2903735,6.42774054 21.6939717,6.8047378 C21.8964274,6.9938498 22.0113578,7.25847607 22.0113578,7.535517 L22.0113578,20 L16.0113578,20 L2,20 L2,7.535517 C2,7.25847607 2.11493033,6.9938498 2.31738608,6.8047378 C2.72098429,6.42774054 3.35378194,6.44930487 3.7307792,6.85290308 L12.0056789,15.7116802 Z" fill="#000000"></path>
                                                                                    </g>
                                                                                </svg>
                                                                                <!--end::Svg Icon-->
                                                                            </span>
                                                <span class="menu-text">Departments</span>
                                            </a>

                                        </li>
                                        @endif

                                      {{--  @if(checkPersonPermission('view-department_priority-3-0'))
                                        <li class="menu-item" aria-haspopup="true">
                                        <a href="{{url('categories')}}" class="menu-link">

                                            <span class="svg-icon menu-icon">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Clothes/Crown.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                        <path
                                                            d="M11.2600599,5.81393408 L2,16 L22,16 L12.7399401,5.81393408 C12.3684331,5.40527646 11.7359848,5.37515988 11.3273272,5.7466668 C11.3038503,5.7680094 11.2814025,5.79045722 11.2600599,5.81393408 Z"
                                                            fill="#000000" opacity="0.3"></path>
                                                        <path
                                                            d="M12.0056789,15.7116802 L20.2805786,6.85290308 C20.6575758,6.44930487 21.2903735,6.42774054 21.6939717,6.8047378 C21.8964274,6.9938498 22.0113578,7.25847607 22.0113578,7.535517 L22.0113578,20 L16.0113578,20 L2,20 L2,7.535517 C2,7.25847607 2.11493033,6.9938498 2.31738608,6.8047378 C2.72098429,6.42774054 3.35378194,6.44930487 3.7307792,6.85290308 L12.0056789,15.7116802 Z"
                                                            fill="#000000"></path>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <span class="menu-text">Categories</span>
                                        </a>
                                    </li>
                                    @endif --}}




                                </ul>
                            </li>
                            @endif
                            <li class="menu-item">
                                <h3 class="menu-heading menu-toggle">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Projects</span>
                                    <i class="menu-arrow"></i>
                                </h3>
                                <ul class="menu-inner">
                                    @if(checkPersonPermission('project-root-3-0'))
                                    @if(checkPersonPermission('view-project-3-0'))
                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="{{route('projects.index')}}" class="menu-link">
                                            <span class="svg-icon menu-icon">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Clothes/Briefcase.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                        <path
                                                            d="M5.84026576,8 L18.1597342,8 C19.1999115,8 20.0664437,8.79732479 20.1528258,9.83390904 L20.8194924,17.833909 C20.9112219,18.9346631 20.0932459,19.901362 18.9924919,19.9930915 C18.9372479,19.9976952 18.8818364,20 18.8264009,20 L5.1735991,20 C4.0690296,20 3.1735991,19.1045695 3.1735991,18 C3.1735991,17.9445645 3.17590391,17.889153 3.18050758,17.833909 L3.84717425,9.83390904 C3.93355627,8.79732479 4.80008849,8 5.84026576,8 Z M10.5,10 C10.2238576,10 10,10.2238576 10,10.5 L10,11.5 C10,11.7761424 10.2238576,12 10.5,12 L13.5,12 C13.7761424,12 14,11.7761424 14,11.5 L14,10.5 C14,10.2238576 13.7761424,10 13.5,10 L10.5,10 Z"
                                                            fill="#000000"></path>
                                                        <path
                                                            d="M10,8 L8,8 L8,7 C8,5.34314575 9.34314575,4 11,4 L13,4 C14.6568542,4 16,5.34314575 16,7 L16,8 L14,8 L14,7 C14,6.44771525 13.5522847,6 13,6 L11,6 C10.4477153,6 10,6.44771525 10,7 L10,8 Z"
                                                            fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <span class="menu-text">Projects</span>
                                        </a>
                                    </li>
                                    @endif
                                    {{-- @if(checkPersonPermission('view-project-type-3-0'))
                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="{{route('project-types.index')}}" class="menu-link">
                                            <span class="svg-icon menu-icon">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Clothes/Crown.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                        <path
                                                            d="M11.2600599,5.81393408 L2,16 L22,16 L12.7399401,5.81393408 C12.3684331,5.40527646 11.7359848,5.37515988 11.3273272,5.7466668 C11.3038503,5.7680094 11.2814025,5.79045722 11.2600599,5.81393408 Z"
                                                            fill="#000000" opacity="0.3"></path>
                                                        <path
                                                            d="M12.0056789,15.7116802 L20.2805786,6.85290308 C20.6575758,6.44930487 21.2903735,6.42774054 21.6939717,6.8047378 C21.8964274,6.9938498 22.0113578,7.25847607 22.0113578,7.535517 L22.0113578,20 L16.0113578,20 L2,20 L2,7.535517 C2,7.25847607 2.11493033,6.9938498 2.31738608,6.8047378 C2.72098429,6.42774054 3.35378194,6.44930487 3.7307792,6.85290308 L12.0056789,15.7116802 Z"
                                                            fill="#000000"></path>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <span class="menu-text">Project Types</span>
                                        </a>
                                    </li>
                                    @endif --}}
                                    @endif
                                    @can('is_super_admin')
                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="{{url('rights/types')}}" class="menu-link">
                                            <span class="svg-icon menu-icon">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Clothes/Crown.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                        <path
                                                            d="M11.2600599,5.81393408 L2,16 L22,16 L12.7399401,5.81393408 C12.3684331,5.40527646 11.7359848,5.37515988 11.3273272,5.7466668 C11.3038503,5.7680094 11.2814025,5.79045722 11.2600599,5.81393408 Z"
                                                            fill="#000000" opacity="0.3"></path>
                                                        <path
                                                            d="M12.0056789,15.7116802 L20.2805786,6.85290308 C20.6575758,6.44930487 21.2903735,6.42774054 21.6939717,6.8047378 C21.8964274,6.9938498 22.0113578,7.25847607 22.0113578,7.535517 L22.0113578,20 L16.0113578,20 L2,20 L2,7.535517 C2,7.25847607 2.11493033,6.9938498 2.31738608,6.8047378 C2.72098429,6.42774054 3.35378194,6.44930487 3.7307792,6.85290308 L12.0056789,15.7116802 Z"
                                                            fill="#000000"></path>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <span class="menu-text">Right Types</span>
                                        </a>
                                    </li>
                                    @endcan


                                    @can('is_super_admin')
                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="{{route('module.index')}}" class="menu-link">
                                                <span class="svg-icon menu-icon">
                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Clothes/Crown.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                            <path d="M11.2600599,5.81393408 L2,16 L22,16 L12.7399401,5.81393408 C12.3684331,5.40527646 11.7359848,5.37515988 11.3273272,5.7466668 C11.3038503,5.7680094 11.2814025,5.79045722 11.2600599,5.81393408 Z" fill="#000000" opacity="0.3"></path>
                                                            <path d="M12.0056789,15.7116802 L20.2805786,6.85290308 C20.6575758,6.44930487 21.2903735,6.42774054 21.6939717,6.8047378 C21.8964274,6.9938498 22.0113578,7.25847607 22.0113578,7.535517 L22.0113578,20 L16.0113578,20 L2,20 L2,7.535517 C2,7.25847607 2.11493033,6.9938498 2.31738608,6.8047378 C2.72098429,6.42774054 3.35378194,6.44930487 3.7307792,6.85290308 L12.0056789,15.7116802 Z" fill="#000000"></path>
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            <span class="menu-text">Modules</span>
                                        </a>
                                    </li>
                                @endcan


                                </ul>
                            </li>
                            <li class="menu-item">
                                <h3 class="menu-heading menu-toggle">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Survey</span>
                                    <i class="menu-arrow"></i>
                                </h3>
                                <ul class="menu-inner">
                                    @if(checkPersonPermission('survey-root-3-0'))
                                    @if(checkPersonPermission('view-person-tags-3-0'))
                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="{{route('person.tags.index')}}" class="menu-link">
                                            <span class="svg-icon menu-icon">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Clothes/Crown.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                        <path
                                                            d="M11.2600599,5.81393408 L2,16 L22,16 L12.7399401,5.81393408 C12.3684331,5.40527646 11.7359848,5.37515988 11.3273272,5.7466668 C11.3038503,5.7680094 11.2814025,5.79045722 11.2600599,5.81393408 Z"
                                                            fill="#000000" opacity="0.3"></path>
                                                        <path
                                                            d="M12.0056789,15.7116802 L20.2805786,6.85290308 C20.6575758,6.44930487 21.2903735,6.42774054 21.6939717,6.8047378 C21.8964274,6.9938498 22.0113578,7.25847607 22.0113578,7.535517 L22.0113578,20 L16.0113578,20 L2,20 L2,7.535517 C2,7.25847607 2.11493033,6.9938498 2.31738608,6.8047378 C2.72098429,6.42774054 3.35378194,6.44930487 3.7307792,6.85290308 L12.0056789,15.7116802 Z"
                                                            fill="#000000"></path>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <span class="menu-text">Person Tags</span>
                                        </a>
                                    </li>
                                    @endif

                                    @endif


                                </ul>
                            </li>

                                <li class="menu-item">
                                    <h3 class="menu-heading menu-toggle">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Document</span>
                                        <i class="menu-arrow"></i>
                                    </h3>
                                    <ul class="menu-inner">


                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="{{ route('document_categories.index') }}" class="menu-link">
                                                <span class="menu-text">Document Categories</span>
                                            </a>
                                        </li>


                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="{{ route('document_types.index') }}" class="menu-link">
                                                <span class="menu-text">Document Types</span>
                                            </a>
                                        </li>


                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="{{ route('document-statuses.index') }}" class="menu-link">
                                                <span class="menu-text">Document Statuses</span>
                                            </a>
                                        </li>


                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="{{ route('voting.index') }}" class="menu-link">
                                                <span class="menu-text">Document Voting</span>
                                            </a>
                                        </li>


                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="{{ route('document_priority.index') }}" class="menu-link">
                                                <span class="menu-text">Document Priority</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                            {{-- @if(checkPersonPermission('person-root-3-0'))

                            <li class="menu-item">
                                <h3 class="menu-heading menu-toggle">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>

                                        <span class="menu-text">Persons</span>
                                    <i class="menu-arrow"></i>
                                </h3>
                                <ul class="menu-inner">
                                    @if(checkPersonPermission('view-domain-3-0'))
                                        <li class="menu-item" aria-haspopup="true">
                                        <a href="{{route('domains.index')}}" class="menu-link">
                                            <span class="svg-icon menu-icon">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Clothes/Briefcase.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                        <path d="M5.84026576,8 L18.1597342,8 C19.1999115,8 20.0664437,8.79732479 20.1528258,9.83390904 L20.8194924,17.833909 C20.9112219,18.9346631 20.0932459,19.901362 18.9924919,19.9930915 C18.9372479,19.9976952 18.8818364,20 18.8264009,20 L5.1735991,20 C4.0690296,20 3.1735991,19.1045695 3.1735991,18 C3.1735991,17.9445645 3.17590391,17.889153 3.18050758,17.833909 L3.84717425,9.83390904 C3.93355627,8.79732479 4.80008849,8 5.84026576,8 Z M10.5,10 C10.2238576,10 10,10.2238576 10,10.5 L10,11.5 C10,11.7761424 10.2238576,12 10.5,12 L13.5,12 C13.7761424,12 14,11.7761424 14,11.5 L14,10.5 C14,10.2238576 13.7761424,10 13.5,10 L10.5,10 Z" fill="#000000"></path>
                                                        <path d="M10,8 L8,8 L8,7 C8,5.34314575 9.34314575,4 11,4 L13,4 C14.6568542,4 16,5.34314575 16,7 L16,8 L14,8 L14,7 C14,6.44771525 13.5522847,6 13,6 L11,6 C10.4477153,6 10,6.44771525 10,7 L10,8 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <span class="menu-text">Domains</span>
                                        </a>
                                    </li>
                                    @endif
                                    @if(checkPersonPermission('view-organization-3-0'))
                                        <li class="menu-item" aria-haspopup="true">
                                        <a href="{{url('organizations')}}" class="menu-link">
                                                                        <span class="svg-icon menu-icon">
                                                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Clothes/Crown.svg-->
                                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                                                    <path d="M11.2600599,5.81393408 L2,16 L22,16 L12.7399401,5.81393408 C12.3684331,5.40527646 11.7359848,5.37515988 11.3273272,5.7466668 C11.3038503,5.7680094 11.2814025,5.79045722 11.2600599,5.81393408 Z" fill="#000000" opacity="0.3"></path>
                                                                                    <path d="M12.0056789,15.7116802 L20.2805786,6.85290308 C20.6575758,6.44930487 21.2903735,6.42774054 21.6939717,6.8047378 C21.8964274,6.9938498 22.0113578,7.25847607 22.0113578,7.535517 L22.0113578,20 L16.0113578,20 L2,20 L2,7.535517 C2,7.25847607 2.11493033,6.9938498 2.31738608,6.8047378 C2.72098429,6.42774054 3.35378194,6.44930487 3.7307792,6.85290308 L12.0056789,15.7116802 Z" fill="#000000"></path>
                                                                                </g>
                                                                            </svg>
                                                                            <!--end::Svg Icon-->
                                                                        </span>
                                            <span class="menu-text">Organizations</span>
                                        </a>
                                    </li>
                                    @endif
                                    @if(checkPersonPermission('view-designation-3-0'))
                                        <li class="menu-item" aria-haspopup="true">
                                        <a href="{{url('designations')}}" class="menu-link">
                                                                        <span class="svg-icon menu-icon">
                                                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Clothes/Crown.svg-->
                                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                                                    <path d="M11.2600599,5.81393408 L2,16 L22,16 L12.7399401,5.81393408 C12.3684331,5.40527646 11.7359848,5.37515988 11.3273272,5.7466668 C11.3038503,5.7680094 11.2814025,5.79045722 11.2600599,5.81393408 Z" fill="#000000" opacity="0.3"></path>
                                                                                    <path d="M12.0056789,15.7116802 L20.2805786,6.85290308 C20.6575758,6.44930487 21.2903735,6.42774054 21.6939717,6.8047378 C21.8964274,6.9938498 22.0113578,7.25847607 22.0113578,7.535517 L22.0113578,20 L16.0113578,20 L2,20 L2,7.535517 C2,7.25847607 2.11493033,6.9938498 2.31738608,6.8047378 C2.72098429,6.42774054 3.35378194,6.44930487 3.7307792,6.85290308 L12.0056789,15.7116802 Z" fill="#000000"></path>
                                                                                </g>
                                                                            </svg>
                                                                            <!--end::Svg Icon-->
                                                                        </span>
                                            <span class="menu-text">Designations</span>
                                        </a>
                                    </li>
                                    @endif
                                    @if(checkPersonPermission('view-department-3-0'))
                                        <li class="menu-item" aria-haspopup="true">
                                        <a href="{{url('departments')}}" class="menu-link">
                                                                        <span class="svg-icon menu-icon">
                                                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Clothes/Crown.svg-->
                                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                                                    <path d="M11.2600599,5.81393408 L2,16 L22,16 L12.7399401,5.81393408 C12.3684331,5.40527646 11.7359848,5.37515988 11.3273272,5.7466668 C11.3038503,5.7680094 11.2814025,5.79045722 11.2600599,5.81393408 Z" fill="#000000" opacity="0.3"></path>
                                                                                    <path d="M12.0056789,15.7116802 L20.2805786,6.85290308 C20.6575758,6.44930487 21.2903735,6.42774054 21.6939717,6.8047378 C21.8964274,6.9938498 22.0113578,7.25847607 22.0113578,7.535517 L22.0113578,20 L16.0113578,20 L2,20 L2,7.535517 C2,7.25847607 2.11493033,6.9938498 2.31738608,6.8047378 C2.72098429,6.42774054 3.35378194,6.44930487 3.7307792,6.85290308 L12.0056789,15.7116802 Z" fill="#000000"></path>
                                                                                </g>
                                                                            </svg>
                                                                            <!--end::Svg Icon-->
                                                                        </span>
                                            <span class="menu-text">Departments</span>
                                        </a>

                                    </li>
                                    @endif
                                </ul>
                            </li>
                        @endif --}}
                            {{--  --}}




                            {{-- <li class="menu-item">
                                <h3 class="menu-heading menu-toggle">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Documents</span>
                                    <i class="menu-arrow"></i>
                                </h3>
                                <ul class="menu-inner">
                                    <!-- New Documents Subheadings -->
                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="{{ route('documents.shares.index') }}" class="menu-link">
                                            <span class="menu-text">Document Shares</span>
                                        </a>
                                    </li>
                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="{{ route('document.statuses.index') }}" class="menu-link">
                                            <span class="menu-text">Document Statuses</span>
                                        </a>
                                    </li>
                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="{{ route('document.types.logs.index') }}" class="menu-link">
                                            <span class="menu-text">Document Types Logs</span>
                                        </a>
                                    </li>
                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="{{ route('document.categories.index') }}" class="menu-link">
                                            <span class="menu-text">Document Categories</span>
                                        </a>
                                    </li>
                                </ul>
                            </li> --}}
{{-- ddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd --}}
                            {{-- <li class="menu-item">
                                <h3 class="menu-heading menu-toggle">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Documents</span>
                                    <i class="menu-arrow"></i>
                                </h3>
                                <ul class="menu-inner">
                                    <!-- New Documents Subheadings (with placeholder text) -->
                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="javascript:;" class="menu-link">
                                            <span class="menu-text">Document Shares</span>
                                        </a>
                                    </li>
                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="javascript:;" class="menu-link">
                                            <span class="menu-text">Document Statuses</span>
                                        </a>
                                    </li>
                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="javascript:;" class="menu-link">
                                            <span class="menu-text">Document Types Logs</span>
                                        </a>
                                    </li>
                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="javascript:;" class="menu-link">
                                            <span class="menu-text">Document Categories</span>
                                        </a>
                                    </li>
                                </ul>
                            </li> --}}
                            {{-- My Documents End --}}

                        </ul>
                    </div>
                </div>


            </li>


        </ul>
        <!--end::Header Nav-->
    </div>
    <!--end::Header Menu-->
</div>
