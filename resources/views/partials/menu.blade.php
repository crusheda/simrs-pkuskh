<div class="sidebar">
    <nav class="sidebar-nav">

        <ul class="nav">
            @can('users_manage')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-users nav-icon">

                        </i>
                        {{ trans('cruds.userManagement.title') }}
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-briefcase nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-user nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("admin.unit.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-group nav-icon">
        
                                </i>
                                Unit
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("it.dokter.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-user-md nav-icon">
        
                                </i>
                                Dokter
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("it.roleuser.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-drivers-license nav-icon">
        
                                </i>
                                Set User Role
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("it.user.activity") }}" class="nav-link">
                                <i class="fa-fw fas fa-eye nav-icon">
        
                                </i>
                                User Activity
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            {{-- <li class="nav-item">
                <a href="{{ route('auth.change_password') }}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-key">

                    </i>
                    Change password
                </a>
            </li> --}}
            {{-- <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li> --}}
        </ul>

    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>

