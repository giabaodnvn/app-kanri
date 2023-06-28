<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->

        <li class="nav-item">
            <a href="{{ route('admin.admin-dashboard') }}" class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}"><i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p></a>
        </li>

{{--        <li class="nav-item {{Request::is('admin/users*') ? 'menu-open' : ''}}">--}}
{{--            <a href="#" class="nav-link {{Request::is('admin/users*') ? 'active' : ''}}">--}}
{{--                <i class="nav-icon fas fa-user"></i>--}}
{{--                <p>--}}
{{--                    Users--}}
{{--                    <i class="right fas fa-angle-left"></i>--}}
{{--                </p>--}}
{{--            </a>--}}
{{--            <ul class="nav nav-treeview">--}}
{{--                <li class="nav-item">--}}
{{--                    <a href="{{ route('admin.users.users-create') }}" class="nav-link {{ Request::is('admin/users/create') ? 'active' : '' }}">--}}
{{--                        <i class="far fa-circle nav-icon"></i>--}}
{{--                        <p>Add User</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a href="{{ route('admin.users.users-list') }}" class="nav-link {{ Request::is('admin/users') ? 'active' : '' }}">--}}
{{--                        <i class="far fa-circle nav-icon"></i>--}}
{{--                        <p>List Users</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </li>--}}

        <li class="nav-item {{Request::is('admin/pages*') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{Request::is('admin/pages*') ? 'active' : ''}}">
                <i class="nav-icon fas fa-book"></i>
                <p>
                    Pages
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.pages.pages-create') }}" class="nav-link {{ Request::is('admin/pages/create') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add Page</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.pages.pages-list') }}" class="nav-link {{ Request::is('admin/pages') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>List Pages</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item {{Request::is('admin/categories*') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{Request::is('admin/categories*') ? 'active' : ''}}">
                <i class="nav-icon fas fa-star-half-alt"></i>
            <p>
                Categories
                <i class="right fas fa-angle-left"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('admin.categories.categories-create') }}" class="nav-link {{ Request::is('admin/categories/create') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Category</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.categories.categories-list') }}" class="nav-link {{ Request::is('admin/categories') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>List Categories</p>
                </a>
            </li>
            </ul>
        </li>

        <li class="nav-item {{Request::is('admin/posts*') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{Request::is('admin/posts*') ? 'active' : ''}}">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                    Posts
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.posts.posts-create') }}" class="nav-link {{Request::is('admin/posts/create') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add Post</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.posts.posts-list') }}" class="nav-link {{Request::is('admin/posts') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>List Post</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item {{Request::is('admin/options*') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{ Request::is('admin/options*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Options
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.options.options-create') }}" class="nav-link {{ Request::is('admin/options/create') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add Option</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.options.options-list') }}" class="nav-link {{ Request::is('admin/options') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>List Options</p>
                    </a>
                </li>
            </ul>
        </li>

{{--        <li class="nav-item {{Request::is('admin/languages*') ? 'menu-open' : ''}}">--}}
{{--            <a href="#" class="nav-link {{Request::is('admin/languages*') ? 'active' : ''}}">--}}
{{--                <i class="nav-icon fas fa-tags"></i>--}}
{{--                <p>--}}
{{--                    Languages--}}
{{--                    <i class="right fas fa-angle-left"></i>--}}
{{--                </p>--}}
{{--            </a>--}}
{{--            <ul class="nav nav-treeview">--}}
{{--                <li class="nav-item">--}}
{{--                    <a href="{{ route('admin.languages.languages-create') }}" class="nav-link {{ Request::is('admin/languages/create') ? 'active' : '' }}">--}}
{{--                        <i class="far fa-circle nav-icon"></i>--}}
{{--                        <p>Add Language</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a href="{{ route('admin.languages.languages-list') }}" class="nav-link {{ Request::is('admin/languages') ? 'active' : '' }}">--}}
{{--                        <i class="far fa-circle nav-icon"></i>--}}
{{--                        <p>List Languages</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </li>--}}

        <li class="nav-item {{Request::is('admin/contacts*') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{Request::is('admin/contacts*') ? 'active' : ''}}">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                    Contacts
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.contacts.contacts-list') }}" class="nav-link {{ Request::is('admin/contacts') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>List Contacts</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-header">OTHER</li>
        <li class="nav-item">
            <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
                Logout
            </p>
            </a>
            <form id="logout-form" action="{{ route('admin.admin-logout') }}" method="POST" style="display:none;">
                @csrf
            </form>
        </li>
    </ul>
</nav>
