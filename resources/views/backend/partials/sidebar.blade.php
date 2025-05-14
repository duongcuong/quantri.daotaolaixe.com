<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div class="text-center">
            <img src="{{ asset('/') }}backend/assets/images/logo.png" width="50" alt="">
        </div>
        <a href="javascript:;" class="ml-auto toggle-btn"> <i class="bx bx-menu"></i>
        </a>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">

        <!--Sales-->
        <li class="menu-label">Quản lý sales</li>
        <li class="{{ Request::is('admin/leads/*') ? 'mm-active' : '' }}">
            <a href="{{ route('admins.leads.index') }}" class="reset-search-action">
                <div class="parent-icon icon-color-11"><i class="bx bx-grid-vertical"></i>
                </div>
                <div class="menu-title">Quản lý Leads</div>
            </a>
        </li>
        <!--End Sales-->

        <li class="{{ Request::is('admin/calendars/index') ? 'mm-active' : '' }}">
            <a href="{{ route('admins.calendars.index') }}" class="reset-search-action">
                <div class="parent-icon icon-color-11"><i class="bx bx-calendar-check"></i>
                </div>
                <div class="menu-title">Calendars</div>
            </a>
        </li>

        <li class="{{ Request::is('admin/sales/*') ? 'mm-active' : '' }}">
            <a href="{{ route('admins.sales.index') }}" class="reset-search-action">
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
        <li class="menu-label">Quản lý Bình luận</li>
        <li class="{{ Request::is('admin/comments/*') ? 'mm-active' : '' }}">
            <a href="{{ route('admins.comments.index') }}" class="reset-search-action">
                <div class="parent-icon icon-color-3"><i class="bx bx-conversation"></i>
                </div>
                <div class="menu-title">Quản lý bình luận</div>
            </a>
        </li>
        @endif

        {{-- Lịch thi sát hạch --}}
        <li class="menu-label">Lịch thi sát hạch Ô TÔ</li>
        <li class="{{ Request::is('admin/calendars/exam-date') || Request::is('admin/calendars/exam') ? 'mm-active' : '' }}">
            <a href="{{ route('admins.calendars.exam-date') }}" class="reset-search-action">
                <div class="parent-icon icon-color-11"><i class="bx bx-calendar-check"></i>
                </div>
                <div class="menu-title">Lịch thi sát hạch</div>
            </a>
        </li>
        <li class="{{ Request::is('admin/calendars/exam-edu-date') || Request::is('admin/calendars/exam-edu') ? 'mm-active' : '' }}">
            <a href="{{ route('admins.calendars.exam-edu-date') }}" class="reset-search-action">
                <div class="parent-icon icon-color-11"><i class="bx bx-calendar-check"></i>
                </div>
                <div class="menu-title">Lịch thi tốt nghiệp</div>
            </a>
        </li>
        <li class="{{ Request::is('admin/calendars/lt-date') || Request::is('admin/calendars/lt') ? 'mm-active' : '' }}">
            <a href="{{ route('admins.calendars.lt-date') }}" class="reset-search-action">
                <div class="parent-icon icon-color-11"><i class="bx bx-calendar-check"></i>
                </div>
                <div class="menu-title">Lịch thi hết môn lý thuyết</div>
            </a>
        </li>
        <li class="{{ Request::is('admin/calendars/th-date') || Request::is('admin/calendars/th') ? 'mm-active' : '' }}">
            <a href="{{ route('admins.calendars.th-date') }}" class="reset-search-action">
                <div class="parent-icon icon-color-11"><i class="bx bx-calendar-check"></i>
                </div>
                <div class="menu-title">Lịch thi hết môn thực hành</div>
            </a>
        </li>
        <li class="{{ Request::is('admin/exam-schedules/*') ? 'mm-active' : '' }}">
            <a href="{{ route('admins.exam-schedules.index') }}" class="reset-search-action">
                <div class="parent-icon icon-color-12"><i class="bx bx-calendar-exclamation"></i>
                </div>
                <div class="menu-title">Kế hoạch thi các trường</div>
            </a>
        </li>

        <!--Giáo viên-->
        <li class="menu-label">Quản lý Giáo viên</li>
        @if (canAccess('admins.teachers.create'))
        <li class="{{ Request::is('admin/teachers/create') ? 'mm-active' : '' }}">
            <a href="{{ route('admins.teachers.create') }}" class="reset-search-action">
                <div class="parent-icon icon-color-11"><i class="bx bx-group"></i>
                </div>
                <div class="menu-title">Thêm giáo viên</div>
            </a>
        </li>
        @endif
        <li class="{{ Request::is('admin/teachers/*') ? 'mm-active' : '' }}">
            <a href="{{ route('admins.teachers.index') }}" class="reset-search-action">
                <div class="parent-icon icon-color-11"><i class="bx bx-group"></i>
                </div>
                <div class="menu-title">Danh sách giáo viên</div>
            </a>
        </li>

        <li class="{{ Request::is('admin/calendars/learning-date') || Request::is('admin/calendars/learning') ? 'mm-active' : '' }}">
            <a href="{{ route('admins.calendars.learning-date') }}" class="reset-search-action">
                <div class="parent-icon icon-color-11"><i class="bx bx-calendar-exclamation"></i>
                </div>
                <div class="menu-title">Lịch làm việc giáo viên</div>
            </a>
        </li>
        <!--End Giáo viên-->

        <!--Giáo viên-->
        <li class="menu-label">Quản lý học viên</li>
        <li class="{{ Request::is('admin/courses/*') ? 'mm-active' : '' }}">
            <a href="{{ route('admins.courses.index') }}" class="reset-search-action">
                <div class="parent-icon icon-color-11"><i class="bx bx-shape-polygon"></i>
                </div>
                <div class="menu-title">Danh sách khoá học</div>
            </a>
        </li>
        <li class="{{ Request::is('admin/users/*') ? 'mm-active' : '' }}">
            <a href="{{ route('admins.users.index') }}" class="reset-search-action">
                <div class="parent-icon icon-color-11"><i class="bx bx-user"></i>
                </div>
                <div class="menu-title">Quản lý học viên</div>
            </a>
        </li>
        <li class="{{ Request::is('admin/course-user/*') ? 'mm-active' : '' }}">
            <a href="{{ route('admins.course-user.index') }}" class="reset-search-action">
                <div class="parent-icon icon-color-11"><i class="bx bx-shield-alt"></i>
                </div>
                <div class="menu-title">Danh sách học viên - Khoá học</div>
            </a>
        </li>
        <li class="{{ Request::is('admin/fees/*') ? 'mm-active' : '' }}">
            <a href="{{ route('admins.fees.index') }}" class="reset-search-action">
                <div class="parent-icon icon-color-11"><i class="bx bx-money"></i>
                </div>
                <div class="menu-title">Lịch sử nộp tiền</div>
            </a>
        </li>

        @if(canAccess('admins.exam-fields.index') ||
        canAccess('admins.lead-sources.index') ||
        canAccess('admins.vehicles.index') ||
        canAccess('admins.vehicle-expenses.index'))
        <li class="menu-label">Quản lý chung</li>
        @endif

        @if(canAccess('admins.exam-fields.index'))
        <li
            class="{{ Request::is('admin/exam-fields') || Request::is('admin/exam-fields/create') || Request::is('admin/exam-fields/*/edit') ? 'mm-active' : '' }}">
            <a href="{{ route('admins.exam-fields.index') }}" class="reset-search-action">
                <div class="parent-icon icon-color-3">
                    <i class="bx bx-slider-alt"></i>
                </div>
                <div class="menu-title">Quản lý sân học và thi</div>
            </a>
        </li>
        @endif

        @if(canAccess('admins.lead-sources.index'))
        <li
            class="{{ Request::is('admin/lead-sources') || Request::is('admin/lead-sources/create') || Request::is('admin/lead-sources/*/edit') ? 'mm-active' : '' }}">
            <a href="{{ route('admins.lead-sources.index') }}" class="reset-search-action">
                <div class="parent-icon icon-color-4">
                    <i class="bx bx-shape-polygon"></i>
                </div>
                <div class="menu-title">Quản lý Lead source</div>
            </a>
        </li>
        @endif

        @if (canAccess('admins.vehicles.index'))
        <li
            class="{{ Request::is('admin/vehicles') || Request::is('admin/vehicles/create') || Request::is('admin/vehicles/*/edit') ? 'mm-active' : '' }}">
            <a href="{{ route('admins.vehicles.index') }}" class="reset-search-action">
                <div class="parent-icon icon-color-2">
                    <i class="bx bx-car"></i>
                </div>
                <div class="menu-title">Quản lý xe</div>
            </a>
        </li>
        @endif

        @if(canAccess('admins.vehicle-expenses.index'))
        <li
            class="{{ Request::is('admin/vehicle-expenses') || Request::is('admin/vehicle-expenses/create') || Request::is('admin/vehicle-expenses/*/edit') ? 'mm-active' : '' }}">
            <a href="{{ route('admins.vehicle-expenses.index') }}" class="reset-search-action">
                <div class="parent-icon icon-color-6">
                    <i class="bx bx-money"></i>
                </div>
                <div class="menu-title">Quản lý chi phí xe</div>
            </a>
        </li>
        @endif


        <!--Security page-->
        @if(canAccess('admins.admins.index') ||
        canAccess('admins.modules.index') ||
        canAccess('admins.permissions.index') ||
        canAccess('admins.roles.index'))
        <li class="menu-label">Bảo mật</li>
        @endif
        @if(canAccess('admins.admins.index'))
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
        @endif

        @if(canAccess('admins.modules.index'))
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
        @endif

        @if (canAccess('admins.permissions.index'))
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
        @endif

        @if (canAccess('admins.roles.index'))
        <li class="{{ Request::is('admin/roles/*') ? 'mm-active' : '' }}">
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon icon-color-5"><i class="bx bx-shield-quarter"></i>
                </div>
                <div class="menu-title">Vai trò</div>
            </a>
            <ul class="{{ Request::is('admin/roles*') ? 'mm-show' : '' }}">
                <li
                    class="{{ Request::is('admin/roles') ? 'mm-active' : '' }}{{ Request::is('admin/roles/*/edit') ? 'mm-active' : '' }}">
                    <a href="{{ route('admins.roles.index') }}"><i class="bx bx-star"></i>Quản lý</a>
                </li>
                <li class="{{ Request::is('admin/roles/create/') ? 'mm-active' : '' }}">
                    <a href="{{ route('admins.roles.create') }}"><i class="bx bx-plus"></i>
                        Thêm mới
                    </a>
                </li>
            </ul>
        </li>
        @endif

        <!--System-->
        @if (canAccess('admins.activity-logs.index'))
        <li class="menu-label">Hệ thống</li>

        <li class="{{ Request::is('admin/activity-logs/*') ? 'mm-active' : '' }}">
            <a href="{{ route('admins.activity-logs.index') }}">
                <div class="parent-icon icon-color-11"><i class="bx bx-history"></i>
                </div>
                <div class="menu-title">Log hệ thống</div>
            </a>
        </li>
        @endif

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
