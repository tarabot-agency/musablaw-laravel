<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow shadow" data-scroll-to-active="true">
    <div class="navbar-header mb-1 mt-2">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand ">
                    <div class="brand-logo d-flex align-items-center ">
                        <img width="180px" height="70px" style="margin-left: 60px"
                            src="{{ asset('images/settings/' . Setting('navbar_logo')) }}" />
                        <h2 class="brand-text text-light mb-0"></h2>
                    </div>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
                        class="bx bx-x d-block d-xl-none font-medium-4 warning toggle-icon"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="">
            <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="bx bx-home-alt"></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboard">{{ __('app.dashboard') }}</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('*slider*') ? 'active' : '' }}">
                <a href="{{ route('sliders.index') }}">
                    <i class='bx bx-slideshow'></i>
                    <span class="menu-title text-truncate" data-i18n="Email">{{ __('app.slider') }}</span>
                </a>
            </li>

            <li class="nav-item {{ Request::is('*/about_us') ? 'active' : '' }} has-submenu">
                <a href="javascript:void(0);">
                    <i class="bx bx-info-square mr-25 align-middle"></i>
                    <span class="menu-title text-truncate" data-i18n="Email">{{ __('app.about_us') }}</span>
                </a>
                <ul class="submenu">
                    <li class="nav-item {{ Request::is('*/about_us') ? 'active' : '' }}">
                        <a href="{{ route('page.show', 'about_us') }}">
                            <span class="menu-title text-truncate" data-i18n="Email">{{ __('app.about_us') }}</span>
                        </a>
                    </li>

                    <li class="nav-item {{ Request::is('*/our_mission') ? 'active' : '' }}">
                        <a href="{{ route('page.show', 'our_mission') }}">
                            <span class="menu-title text-truncate">{{ __('app.our_mission') }}</span>
                        </a>
                    </li>

                    <li class="nav-item {{ Request::is('*/our_vision') ? 'active' : '' }}">
                        <a href="{{ route('page.show', 'our_vision') }}">
                            <span class="menu-title text-truncate">{{ __('app.our_vision') }}</span>
                        </a>
                    </li>


                    <li class="nav-item {{ Request::is('*/our_targets') ? 'active' : '' }}">
                        <a href="{{ route('page.show', 'our_targets') }}">
                            <span class="menu-title text-truncate">{{ __('app.our_targets') }}</span>
                        </a>
                    </li>


                    <li class="nav-item {{ Request::is('*/professional_career') ? 'active' : '' }}">
                        <a href="{{ route('page.show', 'professional_career') }}">
                            <span class="menu-title text-truncate">{{ __('app.professional_career') }}</span>
                        </a>
                    </li>

                    <li class="nav-item {{ Request::is('admin/certificate*') ? 'active' : '' }}">
                        <a href="{{ route('certificates.index') }}">
                            <span class="menu-title text-truncate">{{ __('app.certificates') }}</span>
                        </a>
                    </li>

                    <li class="nav-item {{ Request::is('admin/experience*') ? 'active' : '' }}">
                        <a href="{{ route('experiences.index') }}">
                            <span class="menu-title text-truncate">{{ __('app.experiences') }}</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="nav-item {{ Request::is('*our-services*') ? 'active' : '' }}">
                <a href="{{ route('our-services.index') }}">
                    <i class='bx bx-briefcase'></i>
                    <span class="menu-title text-truncate" data-i18n="Email">{{ __('app.our_services') }}</span>
                </a>
            </li>

            {{-- <li class="nav-item {{ Request::is('*project*') ? 'active' : '' }}">
                <a href="{{ route('projects.index') }}">
                    <i class='bx bx-buildings'></i>
                    <span class="menu-title text-truncate" data-i18n="Email">{{ __('app.our_projects') }}</span>
                </a>
            </li> --}}


            <li class="nav-item {{ Request::is('*partener*') ? 'active' : '' }}">
                <a href="{{ route('parteners.index') }}">
                    <i class='bx bxs-user-check'></i>
                    <span class="menu-title text-truncate" data-i18n="Email">{{ __('app.our_parteners') }}</span>
                </a>
            </li>

            <li class="nav-item {{ Request::is('*article*') ? 'active' : '' }}">
                <a href="{{ route('articles.index') }}">
                    <i class='bx bx-book-open'></i>
                    <span class="menu-title text-truncate" data-i18n="Email">{{ __('app.articles') }}</span>
                </a>
            </li>

            <li class="nav-item {{ Request::is('*contact-us*') ? 'active' : '' }}">
                <a href="{{ route('contact-us.index') }}">
                    <i class='bx bx-envelope'></i>
                    <span class="menu-title text-truncate" data-i18n="Email">{{ __('app.contact_us') }}</span>
                </a>
            </li>

            <li class="nav-item {{ Request::is('admin/setting') ? 'active' : '' }} has-submenu">
                <a href="javascript:void(0);">
                    <i class="bx bx-cog mr-25 align-middle"></i>
                    <span class="menu-title text-truncate" data-i18n="Email">{{ __('app.settings') }}</span>
                </a>


                <ul class="submenu">
                    <li class="nav-item {{ Request::is('admin/admins*') ? 'active' : '' }}">
                        <a href="{{ route('admins.index') }}">
                            <span class="menu-title text-truncate" data-i18n="Email">{{ __('app.admins') }}</span>
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('admin/admin/*') ? 'active' : '' }}">
                        <a href="{{ route('admins.show', Auth::guard('admin')->user()->id) }}">
                            <span class="menu-title text-truncate">{{ __('app.profile') }}</span>
                        </a>
                    </li>
                    @if (Auth::guard('admin')->user()->id == 1)
                        <li class="nav-item {{ Request::is('admin/general-setting*') ? 'active' : '' }}">
                            <a href="{{ route('settings.general') }}">
                                <span class="menu-title text-truncate">{{ __('app.general_settings') }}</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.logout') }}">
                    <i class="bx bx-arrow-back"></i>
                    <span class="menu-title text-truncate" data-i18n="Email">{{ __('app.logout') }}</span>
                </a>
            </li>
        </ul>
    </div>
</div>
