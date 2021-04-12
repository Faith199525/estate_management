    <div data-scroll-to-active="true" class="main-menu menu-fixed menu-blue menu-accordion menu-shadow">
      <!-- main menu header-->
      <div class="main-menu-header">
        {{-- <input type="text" placeholder="Search" class="menu-search form-control round"/> --}}
      </div>
      <!-- / main menu header-->
      <!-- main menu content-->
      <div class="main-menu-content">
        <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
          <li class="{{Request::is('home') ? 'active' : ''}} nav-item"><a href="/home"><i class="icon-stack-2"></i><span data-i18n="nav.form_layouts.form_layout_basic" class="menu-title">Home</span></a>
          </li>
          <li class="{{Request::is('incidents') ? 'active' : ''}} nav-item"><a href="/incidents"><i class="icon-th-large"></i><span class="menu-title">Incident Reporting</span></a>
          </li>
          <li class="{{Request::is('visitors') ? 'active' : ''}} nav-item"><a href="/visitors"><i class="icon-slideshare"></i><span class="menu-title">Visitor Notifications</span></a>
          </li>
        @if (\Auth::user()->landlord)
          <li class=" nav-item"><a href="#"><i class="icon-head"></i><span class="menu-title">Landlord</span></a>
            <ul class="menu-content">
              <li class="{{Request::is('landlords-profile') ? 'active' : ''}}"><a href="/landlords-profile" class="menu-item">Landlord's Profile</a>
              </li>
              <li class="{{Request::is('properties') ? 'active' : ''}}"><a href="/properties" class="menu-item">View Properties</a>
              </li>
              <li class="{{Request::is('residents/invite') ? 'active' : ''}}"><a href="/residents/invite" class="menu-item">Invite Residents</a>
              </li>
            </ul>
          </li>
        @endif
        @if (\Auth::user()->residents->isNotEmpty())
          <li class=" nav-item"><a href="#"><i class="icon-ios-analytics"></i><span class="menu-title">Resident</span></a>
            <ul class="menu-content">
              <li class="{{Request::is('resident-profile') ? 'active' : ''}}"><a href="/resident-profile" class="menu-item">Your Resident Profile</a>
              </li>
            </ul>
          </li>
        @endif
        @if(settings('PAYMENT_ACTIVATED') == true)
          <li class="{{Request::is('dues') ? 'active' : ''}} nav-item"><a href="/dues"><i class="icon-wallet"></i><span class="menu-title">Dues & Payments</span></a>
          </li>
        @endif
        <li class="{{Request::is('staffs') ? 'active' : ''}} nav-item"><a href="/staffs"><i class="icon-users3"></i><span data-i18n="nav.form_layouts.form_layout_basic" class="menu-title">Your Staffs & Workers</span></a>
        </li>
        <li class="{{Request::is('guides') ? 'active' : ''}} nav-item"><a href="/guide"><i class="icon-paper"></i><span class="menu-title">Guide & Tutorials</span></a>
          </li>
        </ul>
      </div>
      <!-- /main menu content-->
      <!-- main menu footer-->
      <!-- include includes/menu-footer-->
      <!-- main menu footer-->
    </div>
