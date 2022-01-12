<!-- BEGIN: Navbar-->
@php
    $user = \App\Models\User::where('id', \Illuminate\Support\Facades\Auth::user()->id)->first();
@endphp
<div class="navbar navbar-fixed">
    <nav
        class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-dark gradient-45deg-indigo-purple no-shadow">
        <div class="nav-wrapper">
            <ul class="navbar-list right">
                <li class="dropdown-language"><a class="waves-effect waves-block waves-light translation-button"
                                                 href="#" data-target="translation-dropdown"><span
                            class="flag-icon flag-icon-tr"></span></a></li>
                <li class="hide-on-med-and-down"><a class="waves-effect waves-block waves-light toggle-fullscreen"
                                                    href="javascript:void(0);"><i class="material-icons">settings_overscan</i></a>
                </li>
                <li><a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);"
                       data-target="profile-dropdown"><span class="avatar-status avatar-online"><img
                                src="{{isset($user->photo) ? asset('storage/images/user-profile/'.$user->photo) : ''}}" alt="avatar"><i></i></span></a>
                </li>
            </ul>
            <!-- translation-button-->
            <ul class="dropdown-content" id="translation-dropdown">
                <li class="dropdown-item"><a class="grey-text text-darken-1" href="{{url('lang/tr')}}"
                                             data-language="tr"><i
                            class="flag-icon flag-icon-tr"></i> {{__('locale.Turkish')}}</a></li>
                <li class="dropdown-item"><a class="grey-text text-darken-1" href="{{url('lang/en')}}"
                                             data-language="en"><i
                            class="flag-icon flag-icon-gb"></i> {{__('locale.English')}}</a></li>
            </ul>

            <!-- user-dropdown-->
            <ul class="dropdown-content" id="profile-dropdown">
                <li><a class="grey-text text-darken-1" href="{{route('admin.my-profile.index')}}"><i class="material-icons">person_outline</i>
                        {{__('locale.My Profile')}}</a></li>
                <li class="divider"></li>
                <li><a class="grey-text text-darken-1" href="{{ route('logout') }}" onclick="event.preventDefault();   document.getElementById('logout-form').submit();">
                        <i class="material-icons">keyboard_tab</i>
                        {{ __('locale.Logout') }}
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </a></li>
            </ul>
        </div>
    </nav>
</div>

<!-- END: Navbar-->
