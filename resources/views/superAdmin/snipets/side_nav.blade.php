    <div data-scroll-to-active="true" class="main-menu menu-fixed menu-blue menu-accordion menu-shadow">
      <!-- main menu header-->
      <div class="main-menu-header">
          {{--  <h3 style="color:white;">{{strtoupper(settings('APP_NAME', 'ERMS'))}}</h3>  --}}
        {{-- <input type="text" placeholder="Search" class="menu-search form-control round"/> --}}
      </div>
      <!-- / main menu header-->
      <!-- main menu content-->
      <div class="main-menu-content">
        <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
        @if (auth()->user()->hasPermission('view_admin'))
            <li class="{{Request::is('admin') ? 'active' : ''}} nav-item"><a href="/admin"><i class="icon-stack-2"></i><span class="menu-title">Home</span></a>
            </li>
        @endif
        @if (auth()->user()->hasPermission('view_visitor'))
            <li class="{{Request::is('admin/visitors') ? 'active' : ''}} nav-item"><a href="/central/estate"><i class="icon-slideshare"></i><span class="menu-title">Estates</span></a>
            </li>
        @endif
        @if (auth()->user()->hasPermission('view_incident'))
            <li class="{{Request::is('admin/incidents') ? 'active' : ''}} nav-item"><a href="/admin/incidents"><i class="icon-th-large"></i><span class="menu-title">Incidents</span></a>
            </li>
        @endif
        @if (auth()->user()->hasPermission('view_message') && settings('MESSAGING_ACTIVATED') == true)
          <li class="{{Request::is('admin/messages') ? 'active' : ''}} nav-item"><a href="/admin/messages"><i class="icon-mail6
            "></i><span class="menu-title">Messages</span></a>
          </li>
        @endif
        @if (auth()->user()->hasPermission('view_user_partial'))
            <li class="{{Request::is('admin/users') ? 'active' : ''}} nav-item"><a href="/admin/users"><i class="icon-users2"></i><span class="menu-title">Users</span></a>
            </li>
        @endif
        @if (auth()->user()->hasPermission('view_landlord'))
            <li class=" nav-item"><a href="/admin/landlords"><i class="icon-head"></i><span class="menu-title">Landlords</span></a>
            <ul class="menu-content">
                <li class="{{Request::is('admin/landlords') ? 'active' : ''}}"><a href="/admin/landlords" class="menu-item">View Landlords</a>
                </li>
                @if (auth()->user()->hasPermission('edit_landlord'))
                <li class="{{Request::is('admin/landlords/invite') ? 'active' : ''}}"><a href="/admin/landlords/invite" class="menu-item">Invite New Landlords</a>
                </li>
                @endif
            </ul>
            </li>
        @endif
        @if (auth()->user()->hasPermission('view_resident'))
            <li class=" nav-item"><a href="/admin/residents"><i class="icon-ios-analytics"></i><span class="menu-title">Residents</span></a>
            <ul class="menu-content">
                <li class="{{Request::is('admin/residents') ? 'active' : ''}}"><a href="/admin/residents" class="menu-item">View Residents</a>
                </li>
            </ul>
            @if (auth()->user()->hasPermission('edit_resident'))
            <ul class="menu-content">
                <li class="{{Request::is('admin/residents/add') ? 'active' : ''}}"><a href="/admin/residents/add" class="menu-item">Add Residents</a>
                </li>
            </ul>
            @endif
            @if (auth()->user()->hasPermission('view_resident_staff'))
            <ul class="menu-content">
                <li class="{{Request::is('admin/staffs') ? 'active' : ''}}"><a href="/admin/staffs" class="menu-item">Residents' Staffs</a>
                </li>
            </ul>
            @endif
            </li>
        @endif
        @if (auth()->user()->hasPermission('view_street'))
            <li class="{{Request::is('admin/streets') ? 'active' : ''}} nav-item"><a href="/admin/streets"><i class="icon-street-view"></i><span class="menu-title">Streets</span></a>
            </li>
        @endif
        @if (auth()->user()->hasPermission('view_due'))
            <li class="{{Request::is('admin/dues') ? 'active' : ''}} nav-item"><a href="/admin/dues"><i class="icon-wallet"></i><span class="menu-title">Dues</span></a>
            </li>
        @endif
        @if (auth()->user()->hasPermission('edit_payment'))
            <li class="{{Request::is('admin/payment/status') ? 'active' : ''}} nav-item"><a href="/admin/payment/status"><i class="icon-wallet"></i><span class="menu-title">Payment Status</span></a>
            </li>
        @endif
        @if (auth()->user()->hasPermission('view_payment'))
            @if (settings('PAYMENT_ACTIVATED') == true || settings('MANUAL_DUE_MANAGEMENT_ACTIVATED') == true)
            <li class="{{Request::is('admin/payments') ? 'active' : ''}} nav-item"><a href="/admin/payments"><i class="icon-money"></i><span class="menu-title">Payments</span></a>
            </li>
            @endif
        @endif
        @if (auth()->user()->hasPermission('view_settings'))
            <li class="{{Request::is('admin/settings') ? 'active' : ''}} nav-item"><a href="/admin/settings"><i class="icon-cog"></i><span class="menu-title">Settings</span></a>
            </li>
        @endif
        </ul>
      </div>
      <!-- /main menu content-->
      <!-- main menu footer-->
      <!-- include includes/menu-footer-->
      <!-- main menu footer-->
    </div>
