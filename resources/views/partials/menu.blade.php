
<div class="sidebar-wrapper">
    <div class="sidebar-header">
        <div class="d-flex justify-content-between">
            <div class="logo">
                <a href="#">
                    <h3 class="mt-3 page-heading">
                        <a href=""><img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo"></a>
                    </h3>
                </a>
            </div>
            <div class="toggler">
                <a href="#" class="sidebar-hide d-xl-none d-block">
                    <i class="bi bi-x bi-middle"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="sidebar-menu">
        <ul class="menu">

            <li class="sidebar-item {{ (request()->is('home')) ? 'active' : '' }} ">
                <a href="{{ route('home') }}" class='sidebar-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span class="fw-bold">Tableau de bord</span>
                </a>
            </li>

            @can('user_management_access')
            <li class="sidebar-item has-sub {{ (request()->is('admin/usermanagement*')) ? 'active' : '' }}">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-people-fill"></i>
                    <span class="fw-bold">User Management  </span>
                </a>
                <ul class="submenu ">

                    @can('permission_access')
                    <li class="submenu-item {{ (request()->is('admin/usermanagement/permissions*')) ? 'active' : '' }}">
                        <a href="{{ route("permissions.index") }}" class="{{ request()->is('admin/usermanagement/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">Permissions</a>
                    </li>
                    @endcan
                    @can('role_access')
                    <li class="submenu-item {{ (request()->is('admin/usermanagement/roles*')) ? 'active' : '' }}">
                        <a href="{{ route("roles.index") }}" class="{{ request()->is('admin/usermanagement/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">Rôles</a>
                    </li>
                    @endcan

                    @can('user_access')
                    <li class="submenu-item {{ (request()->is('admin/usermanagement/users*')) ? 'active' : '' }}">
                        <a href="{{ route("users.index") }}" class="{{ request()->is('admin/usermanagement/users') || request()->is('admin/users/*') ? 'active' : '' }}">Users</a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan

            {{-- @can('category_access') --}}
            <li class="sidebar-item {{ (request()->is('admin/management/categories')) || request()->is('admin/management/categories/*') ? 'active' : '' }} ">
                <a href="{{ route('categories.index') }}" class='sidebar-link'>
                    <i class="bi bi-bookmark-fill"></i>
                    <span class="fw-bold">Catégories</span>
                </a>
            </li>
            {{-- @endcan --}}

            {{-- @can('service_access') --}}
            <li class="sidebar-item {{ (request()->is('admin/management/services')) || request()->is('admin/management/services/*') ? 'active' : '' }} ">
                <a href="{{ route('services.index') }}" class='sidebar-link'>
                    <i class="bi bi-tag-fill"></i>
                    <span class="fw-bold">Services</span>
                </a>
            </li>
            {{-- @endcan --}}

            {{-- @can('client_access') --}}
            <li class="sidebar-item {{ (request()->is('admin/management/clients')) || request()->is('admin/management/clients/*') ? 'active' : '' }} ">
                <a href="{{ route('clients.index') }}" class='sidebar-link'>
                    <i class="bi bi-people-fill"></i>
                    <span class="fw-bold">Clients</span>
                </a>
            </li>
            {{-- @endcan --}}

            {{-- @can('factures_access') --}}
            <li class="sidebar-item {{ (request()->is('admin/management/factures')) || request()->is('admin/management/factures/*') ? 'active' : '' }} ">
                <a href="{{ route('factures.index') }}" class='sidebar-link'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facture-detailed-fill" viewBox="0 0 16 16">
                        <path d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6V4.5Zm4 1a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5Zm0 5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5ZM4 8a1 1 0 0 0 1 1h6a1 1 0 1 0 0-2H5a1 1 0 0 0-1 1Z"/>
                    </svg>
                    <span class="fw-bold">Factures</span>
                </a>
            </li>
            {{-- @endcan --}}

            @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                {{-- @can('profile_password_edit') --}}
                <li class="sidebar-item {{ (request()->is('profile/password*')) ? 'active' : '' }}">
                    <a href="{{ route('profile.password.edit') }}" class="sidebar-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" >
                        <i class="bi bi-key-fill"></i>
                        <span class="fw-bold">Modifier Mot de passe</span>
                    </a>
                </li>
                {{-- @endcan --}}
            @endif

            <li class="sidebar-item ">
                <a class="sidebar-link btn" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                    <i class="bi bi-door-closed-fill"></i>
                    <span class="fw-bold">Déconnexion</span>
                </a>
            </li>


        </ul>
    </div>
    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>

</div>
