<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="pt-4">
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="fa-solid fa-user-group me-2"></i>
                        <span class="hide-menu">Users</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{ url('/users') }}" class="sidebar-link">
                                <i class="fa-solid fa-address-book me-2"></i>
                                <span class="hide-menu">Users List</span>
                            </a>
                        </li>
                        @can('create-user')
                            <li class="sidebar-item">
                                <a href="{{ url('/users/create') }}" class="sidebar-link">
                                    <i class="fa-solid fa-user-plus me-2"></i>
                                    <span class="hide-menu">Add User</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="fa-solid fa-user-gear me-2"></i>
                        <span class="hide-menu">Roles</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{ url('/roles') }}" class="sidebar-link">
                                <i class="fa-solid fa-table-list me-2"></i>
                                <span class="hide-menu">Roles List</span>
                            </a>
                        </li>
                        @can('create-role')
                            <li class="sidebar-item">
                                <a href="{{ url('/roles/create') }}" class="sidebar-link">
                                    <i class="fa-solid fa-plus me-2"></i>
                                    <span class="hide-menu">Add Role</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
<!-- End Sidebar scroll-->
</aside>