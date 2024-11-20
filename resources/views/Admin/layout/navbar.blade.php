<nav class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top menu-shadow shadow">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
                <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav">
                        <li class="nav-item mobile-menu d-xl-none mr-auto"><a
                                class="nav-link nav-menu-main menu-toggle hidden-xs" href="javascript:void(0);"><i
                                    class="ficon bx bx-menu"></i></a></li>
                    </ul>
                </div>
                @php
                    $website_language = Setting('website_language');
                @endphp

                <ul class="nav navbar-nav float-right">
                    @if ($website_language == 'both')
                        <li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link"
                                id="dropdown-flag" href="javascript:void(0);" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                @if (app()->getLocale() == 'en')
                                    <i class="flag-icon flag-icon-us"></i>
                                    <span class="selected-language">{{ __('app.english') }}</span>
                            </a>
                        @elseif(app()->getLocale() == 'ar')
                            <i class="flag-icon flag-icon-eg"></i>
                            <span class="selected-language">{{ __('app.arabic') }}</span></a>
                        @else
                            <i class="flag-icon flag-icon-us"></i>
                            <span class="selected-language">{{ __('app.english') }}</span>
                    @endif
                    <div class="dropdown-menu" aria-labelledby="dropdown-flag">
                        <input type="hidden" name="language" value="en">
                        <a class="dropdown-item" href="{{ route('switch-language', 'en') }}"><i
                                class="flag-icon flag-icon-us mr-50"></i>
                            {{ __('app.english') }}</a>
                        <input type="hidden" name="language" value="ar">
                        <a class="dropdown-item" href="{{ route('switch-language', 'ar') }}"><i
                                class="flag-icon flag-icon-eg mr-50"></i>
                            {{ __('app.arabic') }}</a>
                    </div>
                    </li>
                    @endif
                    <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i
                                class="ficon bx bx-fullscreen"></i></a></li>
                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link"
                            href="javascript:void(0);" data-toggle="dropdown">
                            <div class="user-nav d-sm-flex d-none"><span class="user-name"
                                    id="admin-name">{{ Auth::guard('admin')->user()->name }}</span><span
                                    class="user-status text-muted">{{ Auth::guard('admin')->user()->phone }}</span>
                            </div><span>
                                @if (Auth::guard('admin')->user()->image)
                                    <img src="{{ Auth::guard('admin')->user()->image }}" width="40" height="40"
                                        style="border-radius: 50%" />
                                @else
                                    <div id="profileImage"></div>
                                @endif
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right pb-0">
                            <a class="dropdown-item"
                                href="{{ route('admins.show', Auth::guard('admin')->user()->id) }}"><i
                                    class="bx bx-user mr-50"></i>{{ __('app.profile') }}</a>

                            <div class="dropdown-divider mb-0"></div><a class="dropdown-item"
                                href="{{ route('admin.logout') }}"><i class="bx bx-power-off mr-50"></i>
                                {{ __('app.logout') }}</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
