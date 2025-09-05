<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('/AdminLTELogo.png') }}" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview {{ request()->segment(1) == 'dashboard' ? 'menu-open' : '' }}">
                    <a href="{{ url('admin/dashboard') }}"
                        class="nav-link {{ request()->segment(2) == 'dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li
                    class="nav-item has-treeview {{ request()->segment(1) == 'Active' || request()->is('Inactive') ? 'menu-open' : '' }}">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p> Members
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/members') }}/1"
                                class="nav-link {{ request()->is('plans') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Active</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/members') }}/2" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inactive</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-coins"></i>
                        <p> Incomes
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/spornser') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sponsor</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/global_rebirth') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Global Rebirth</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/upline_spornser') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Upline Sponsor</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/upgrade') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Upgrade</p>
                            </a>
                        </li>

                    </ul>
                </li>
                @if(auth()->user()->user_type_id == 1)
                <li
                    class="nav-item has-treeview {{ request()->segment(1) == 'users' || request()->is('usertype') ? 'menu-open' : '' }}">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p> Users
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/users') }}"
                                class="nav-link {{ request()->is('users') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/user_type') }}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User Type</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/wallet') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Wallet</p>
                    </a>
                </li>

                <li
                    class="nav-item has-treeview {{ request()->segment(1) == 'plans' || request()->is('backup') || request()->segment(1) == 'viewsalary' ? 'menu-open' : '' }}">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p> Settings
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('plans') }}"
                                class="nav-link {{ request()->is('plans') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Plan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('backup') }}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Backup</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                <li
                    class="nav-item has-treeview {{ request()->segment(1) == 'profile' || request()->is('changepassword') || request()->segment(1) == 'viewsalary' ? 'menu-open' : '' }}">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            {{ Auth::user()->name }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('changepassword') }}"
                                class="nav-link {{ request()->is('changepassword') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Change Password</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/logout') }}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>