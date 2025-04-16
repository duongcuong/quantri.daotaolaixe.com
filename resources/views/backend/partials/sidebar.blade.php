<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div class="text-center">
            {{-- <h4 class="logo-text">{{ setting('site_title', 'Starter') }}</h4> --}}
            <img src="{{ asset('/') }}backend/assets/images/logo.png" width="50" alt="">
        </div>
        <a href="javascript:;" class="ml-auto toggle-btn"> <i class="bx bx-menu"></i>
        </a>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <!--Home-->
        {{-- @if (Auth::user()->hasPermission('app.dashboard'))
        <li class="{{ Request::is('app/dashboard') ? 'mm-active' : '' }}">
            <a href="{{ route('app.dashboard') }}">
                <div class="parent-icon icon-color-1">
                    <i class="bx bx-home-alt"></i>
                </div>
                <div class="menu-title">Tổng quan</div>
            </a>
        </li>
        @endif --}}
        <!--End Home-->

        <!--Sales-->
        <li class="menu-label">Quản lý sales</li>
        {{-- @if (Auth::user()->hasPermission('admins.leads.index') ||
        Auth::user()->hasPermission('admins.leads.create')) --}}
        <li class="{{ Request::is('admin/leads/*') ? 'mm-active' : '' }}">
            <a href="{{ route('admins.leads.index') }}">
                <div class="parent-icon icon-color-11"><i class="bx bx-grid-vertical"></i>
                </div>
                <div class="menu-title">Quản lý Leads</div>
            </a>
        </li>
        {{-- @endif --}}
        <!--End Sales-->

        <li class="{{ Request::is('admin/calendars/index') ? 'mm-active' : '' }}">
            <a href="{{ route('admins.calendars.index') }}">
                <div class="parent-icon icon-color-11"><i class="bx bx-calendar-check"></i>
                </div>
                <div class="menu-title">Calendars</div>
            </a>
        </li>

        <li class="{{ Request::is('admin/sales/*') ? 'mm-active' : '' }}">
            <a href="{{ route('admins.sales.index') }}">
                <div class="parent-icon icon-color-5"><i class="bx bx-group"></i>
                </div>
                <div class="menu-title">Danh sách sale</div>
            </a>
        </li>

        @if (canAccess('admins.course-users.import'))
        <li class="{{ Request::is('admin/course-user/import') ? 'mm-active' : '' }}">
            <a href="{{ route('admins.course-user.import') }}">
                <div class="parent-icon icon-color-5"><i class="lni lni-cloud-upload"></i>
                </div>
                <div class="menu-title">Import</div>
            </a>
        </li>
        @endif

        @if (canAccess('admins.comments.index'))
        {{-- Bình luận --}}
        <li class="menu-label">Quản lý Bình luận</li>
        {{-- @if (Auth::user()->hasPermission('admins.comments.index') ||
        Auth::user()->hasPermission('admins.comments.create')) --}}
        <li class="{{ Request::is('admin/comments/*') ? 'mm-active' : '' }}">
            <a href="{{ route('admins.comments.index') }}">
                <div class="parent-icon icon-color-3"><i class="bx bx-conversation"></i>
                </div>
                <div class="menu-title">Quản lý bình luận</div>
            </a>
        </li>
        @endif

        {{-- Lịch thi sát hạch --}}
        <li class="menu-label">Lịch thi sát hạch</li>
        {{-- @if (Auth::user()->hasPermission('admins.comments.index') ||
        Auth::user()->hasPermission('admins.comments.create')) --}}
        <li class="{{ Request::is('admin/comments/*') ? 'mm-active' : '' }}">
            <a href="{{ route('admins.calendars.exam') }}">
                <div class="parent-icon icon-color-11"><i class="bx bx-calendar-check"></i>
                </div>
                <div class="menu-title">Lịch thi sát hạch</div>
            </a>
        </li>
        <li class="{{ Request::is('admin/exam-schedules/*') ? 'mm-active' : '' }}">
            <a href="{{ route('admins.exam-schedules.index') }}">
                <div class="parent-icon icon-color-12"><i class="bx bx-calendar-exclamation"></i>
                </div>
                <div class="menu-title">Kế hoạch thi các trường</div>
            </a>
        </li>

        <!--Giáo viên-->
        <li class="menu-label">Quản lý Giáo viên</li>
        {{-- @if (Auth::user()->hasPermission('admins.teachers.index') ||
        Auth::user()->hasPermission('admins.teachers.create')) --}}
        <li class="{{ Request::is('admin/teachers/*') ? 'mm-active' : '' }}">
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon icon-color-11"><i class="bx bx-group"></i>
                </div>
                <div class="menu-title">Quản lý Giáo viên</div>
            </a>
            <ul class="{{ Request::is('admin/teachers*') ? 'mm-show' : '' }}">
                {{-- @if (Auth::user()->hasPermission('admins.teachers.index')) --}}
                <li
                    class="{{ Request::is('admin/teachers') || Request::is('admin/teachers/*/edit') ? 'mm-active' : '' }}">
                    <a href="{{ route('admins.teachers.index') }}"><i class="bx bx-star"></i>Danh sách giáo viên</a>
                </li>
                {{-- @endif --}}

                @if(canAccess('admins.teachers.create'))
                <li class="{{ Request::is('admin/teachers/create') ? '' : '' }}">
                    <a href="{{ route('admins.teachers.create') }}"><i class="bx bx-star"></i>Thêm giáo viên</a>
                </li>
                @endif

                <li class="{{ Request::is('admin/calendars/learning') ? 'mm-active' : '' }}">
                    <a href="{{ route('admins.calendars.learning') }}"><i class="bx bx-calendar-exclamation"></i>Lịch làm việc giáo viên</a>
                </li>
            </ul>
        </li>
        {{-- @endif --}}
        <!--End Giáo viên-->

        <!--Giáo viên-->
        <li class="menu-label">Quản lý học viên</li>
        {{-- @if (Auth::user()->hasPermission('admins.teachers.index') ||
        Auth::user()->hasPermission('admins.teachers.create')) --}}
        <li class="{{ Request::is('admin/courses/*') ? 'mm-active' : '' }}">
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon icon-color-11"><i class="bx bx-user-plus"></i>
                </div>
                <div class="menu-title">Học viên</div>
            </a>
            <ul class="{{ Request::is('admin/courses*') ? 'mm-show' : '' }}">
                {{-- @if (Auth::user()->hasPermission('admins.courses.index')) --}}
                <li
                    class="{{ Request::is('admin/courses') || Request::is('admin/courses/create') || Request::is('admin/courses/*/edit') ? 'mm-active' : '' }}">
                    <a href="{{ route('admins.courses.index') }}"><i class="bx bx-star"></i>Danh sách khoá học</a>
                </li>
                {{-- @endif --}}

                <li
                    class="{{ Request::is('admin/users') || Request::is('admin/users/create') || Request::is('admin/users/*/edit') ? 'mm-active' : '' }}">
                    <a href="{{ route('admins.users.index') }}"><i class="bx bx-star"></i>Quản lý học viên</a>
                </li>

                <li class="{{ Request::is('admin/course-user/*') ? 'mm-active' : '' }}">
                    <a href="{{ route('admins.course-user.index') }}"><i class="bx bx-star"></i>Danh sách học viên -
                        Khoá học</a>
                </li>

                <li
                    class="{{ Request::is('admin/fees') || Request::is('admin/fees/create') || Request::is('admin/fees/*/edit') ? 'mm-active' : '' }}">
                    <a href="{{ route('admins.fees.index') }}"><i class="bx bx-star"></i>Lịch sử nộp tiền</a>
                </li>

                {{-- @if (Auth::user()->hasPermission('admins.teachers.create')) --}}
                {{-- <li class="{{ Request::is('admin/teachers/create') ? 'mm-active' : '' }}">
                    <a href="{{ route('admins.teachers.index') }}"><i class="bx bx-star"></i>Danh sách học viên</a>
                </li> --}}
                {{-- @endif --}}
            </ul>
        </li>
        {{-- @endif --}}
        <!--End Giáo viên-->

        <li class="menu-label">Quản lý chung</li>
        <li
            class="{{ Request::is('admin/exam-fields') || Request::is('admin/exam-fields/create') || Request::is('admin/exam-fields/*/edit') ? 'mm-active' : '' }}">
            <a href="{{ route('admins.exam-fields.index') }}">
                <div class="parent-icon icon-color-3">
                    <i class="bx bx-slider-alt"></i>
                </div>
                <div class="menu-title">Quản lý sân học và thi</div>
            </a>
        </li>

        <li
            class="{{ Request::is('admin/lead-sources') || Request::is('admin/lead-sources/create') || Request::is('admin/lead-sources/*/edit') ? 'mm-active' : '' }}">
            <a href="{{ route('admins.lead-sources.index') }}">
                <div class="parent-icon icon-color-4">
                    <i class="bx bx-shape-polygon"></i>
                </div>
                <div class="menu-title">Quản lý Lead source</div>
            </a>
        </li>

        <li
            class="{{ Request::is('admin/vehicles') || Request::is('admin/vehicles/create') || Request::is('admin/vehicles/*/edit') ? 'mm-active' : '' }}">
            <a href="{{ route('admins.vehicles.index') }}">
                <div class="parent-icon icon-color-2">
                    <i class="bx bx-car"></i>
                </div>
                <div class="menu-title">Quản lý xe</div>
            </a>
        </li>

        <li
            class="{{ Request::is('admin/vehicle-expenses') || Request::is('admin/vehicle-expenses/create') || Request::is('admin/vehicle-expenses/*/edit') ? 'mm-active' : '' }}">
            <a href="{{ route('admins.vehicle-expenses.index') }}">
                <div class="parent-icon icon-color-6">
                    <i class="bx bx-money"></i>
                </div>
                <div class="menu-title">Quản lý chi phí xe</div>
            </a>
        </li>

        <!--Security page-->
        <li class="menu-label">Bảo mật</li>
        {{-- @if (Auth::user()->hasPermission('admins.admins.index') ||
        Auth::user()->hasPermission('admins.admins.create')) --}}
        <li class="{{ Request::is('admin/admins/*') ? 'mm-active' : '' }}">
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon icon-color-4"><i class="bx bx-user"></i>
                </div>
                <div class="menu-title">Người dùng</div>
            </a>
            <ul class="{{ Request::is('admin/admins*') ? 'mm-show' : '' }}">
                {{-- @if (Auth::user()->hasPermission('admins.admins.create')) --}}
                <li
                    class="{{ Request::is('admin/admins') ? 'mm-active' : '' }}{{ Request::is('admin/admins/*/edit') ? 'mm-active' : '' }}">
                    <a href="{{ route('admins.admins.index') }}"><i class="bx bx-star"></i>Quản lý</a>
                </li>
                {{-- @endif --}}
                {{-- @if (Auth::user()->hasPermission('admins.admins.create')) --}}
                <li class="{{ Request::is('admin/admins/create/') ? 'mm-active' : '' }}">
                    <a href="{{ route('admins.admins.create') }}"><i class="bx bx-plus"></i>
                        Tạo mới
                    </a>
                </li>
                {{-- @endif --}}
            </ul>
        </li>
        {{-- @endif --}}

        <li class="{{ Request::is('admin/modules/*') ? 'mm-active' : '' }}">
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon icon-color-4"><i class="bx bx-user"></i>
                </div>
                <div class="menu-title">Quản lý Module</div>
            </a>
            <ul class="{{ Request::is('admin/modules*') ? 'mm-show' : '' }}">
                {{-- @if (Auth::user()->hasPermission('admins.modules.create')) --}}
                <li
                    class="{{ Request::is('admin/modules') ? 'mm-active' : '' }}{{ Request::is('admin/modules/*/edit') ? 'mm-active' : '' }}">
                    <a href="{{ route('admins.modules.index') }}"><i class="bx bx-star"></i>Quản lý</a>
                </li>
                {{-- @endif --}}
                {{-- @if (Auth::user()->hasPermission('admins.modules.create')) --}}
                <li class="{{ Request::is('admin/modules/create/') ? 'mm-active' : '' }}">
                    <a href="{{ route('admins.modules.create') }}"><i class="bx bx-plus"></i>
                        Tạo mới
                    </a>
                </li>
                {{-- @endif --}}
            </ul>
        </li>

        <li class="{{ Request::is('admin/permissions/*') ? 'mm-active' : '' }}">
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon icon-color-4"><i class="bx bx-user"></i>
                </div>
                <div class="menu-title">Quản lý Permission</div>
            </a>
            <ul class="{{ Request::is('admin/permissions*') ? 'mm-show' : '' }}">
                {{-- @if (Auth::user()->hasPermission('admins.permissions.create')) --}}
                <li
                    class="{{ Request::is('admin/permissions') ? 'mm-active' : '' }}{{ Request::is('admin/permissions/*/edit') ? 'mm-active' : '' }}">
                    <a href="{{ route('admins.permissions.index') }}"><i class="bx bx-star"></i>Quản lý</a>
                </li>
                {{-- @endif --}}
                {{-- @if (Auth::user()->hasPermission('admins.permissions.create')) --}}
                <li class="{{ Request::is('admin/permissions/create/') ? 'mm-active' : '' }}">
                    <a href="{{ route('admins.permissions.create') }}"><i class="bx bx-plus"></i>
                        Tạo mới
                    </a>
                </li>
                {{-- @endif --}}
            </ul>
        </li>

        {{-- @if (Auth::user()->hasPermission('admins.roles.index') ||
        Auth::user()->hasPermission('admins.roles.create')) --}}
        <li class="{{ Request::is('admin/roles/*') ? 'mm-active' : '' }}">
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon icon-color-5"><i class="bx bx-shield-quarter"></i>
                </div>
                <div class="menu-title">Vai trò</div>
            </a>
            <ul class="{{ Request::is('admin/roles*') ? 'mm-show' : '' }}">
                {{-- @if (Auth::user()->hasPermission('admins.roles.create')) --}}
                <li
                    class="{{ Request::is('admin/roles') ? 'mm-active' : '' }}{{ Request::is('admin/roles/*/edit') ? 'mm-active' : '' }}">
                    <a href="{{ route('admins.roles.index') }}"><i class="bx bx-star"></i>Quản lý</a>
                </li>
                {{-- @endif --}}
                {{-- @if (Auth::user()->hasPermission('admins.roles.create')) --}}
                <li class="{{ Request::is('admin/roles/create/') ? 'mm-active' : '' }}">
                    <a href="{{ route('admins.roles.create') }}"><i class="bx bx-plus"></i>
                        Thêm mới
                    </a>
                </li>
                {{-- @endif --}}
            </ul>
        </li>
        {{-- @endif --}}
        <!--End Security page-->

        <!--System-->
        <li class="menu-label">Hệ thống</li>

        <li class="{{ Request::is('admin/activity-logs/*') ? 'mm-active' : '' }}">
            <a href="{{ route('admins.activity-logs.index') }}">
                <div class="parent-icon icon-color-11"><i class="bx bx-history"></i>
                </div>
                <div class="menu-title">Log hệ thống</div>
            </a>
        </li>

        {{-- @if (Auth::user()->hasPermission('app.settings.general') ||
        Auth::user()->hasPermission('app.settings.appearance') ||
        Auth::user()->hasPermission('app.settings.database') ||
        Auth::user()->hasPermission('app.settings.mail') ||
        Auth::user()->hasPermission('app.socialite.mail')) --}}
        {{-- <li class="{{ Request::is('app/settings/*') ? 'mm-active' : '' }}">
            <a href="{{ route('app.settings.index') }}">
                <div class="parent-icon icon-color-7">
                    <i class="bx bx-cog"></i>
                </div>
                <div class="menu-title">Cài đặt</div>
            </a>
        </li> --}}
        {{-- @endif --}}
    </ul>
    <!--end navigation-->
</div>
