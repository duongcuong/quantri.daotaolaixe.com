<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;
use App\Models\Permission;

class ModulePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Danh sách các module và các action tương ứng
        $modules = [
            'Quản lý Leads' => [
                'Danh sách' => 'admins.leads.index',
                'Thêm' => 'admins.leads.create',
                'Sửa' => 'admins.leads.edit',
                'Xóa' => 'admins.leads.destroy',
                'Xem' => 'admins.leads.show',
            ],
            'Quản lý Calendar' => [
                'Danh sách' => 'admins.calendars.index',
                'Thêm' => 'admins.calendars.create',
                'Sửa' => 'admins.calendars.edit',
                'Xóa' => 'admins.calendars.destroy',
                'Xét duyệt' => 'admins.calendars.approval',
                'Xem' => 'admins.calendars.show',
            ],
            'Quản lý Sale' => [
                'Danh sách' => 'admins.sales.index',
                'Thêm' => 'admins.sales.create',
                'Sửa' => 'admins.sales.edit',
                'Xóa' => 'admins.sales.destroy',
                'Xem' => 'admins.sales.show',
            ],
            'Quản lý import' => [
                'Danh sách' => 'admins.course-user.import',
            ],
            'Quản lý bình luận' => [
                'Danh sách' => 'admins.comments.index',
                'Thêm' => 'admins.comments.create',
                'Sửa' => 'admins.comments.edit',
                'Xóa' => 'admins.comments.destroy',
                'Xem' => 'admins.comments.show',
            ],
            'Quản lý lịch thi sát hạch' => [
                'Danh sách' => 'admins.calendars.exam'
            ],
            'Quản lý kế hoạch các trường thi' => [
                'Danh sách' => 'admins.exam-schedules.index',
                'Thêm' => 'admins.exam-schedules.create',
                'Sửa' => 'admins.exam-schedules.edit',
                'Xóa' => 'admins.exam-schedules.destroy',
                'Xem' => 'admins.exam-schedules.show',
            ],
            'Quản lý Giáo viên' => [
                'Danh sách' => 'admins.teachers.index',
                'Thêm' => 'admins.teachers.create',
                'Sửa' => 'admins.teachers.edit',
                'Xóa' => 'admins.teachers.destroy',
                'Xem' => 'admins.teachers.show',
            ],
            'Quản lý lịch làm việc giáo viên' => [
                'Danh sách' => 'admins.calendar.learning',
            ],
            'Quản lý học viên' => [
                'Danh sách' => 'admins.users.index',
                'Thêm' => 'admins.users.create',
                'Sửa' => 'admins.users.edit',
                'Xóa' => 'admins.users.destroy',
                'Xem' => 'admins.users.show',
            ],
            'Quản lý khoá học' => [
                'Danh sách' => 'admins.courses.index',
                'Thêm' => 'admins.courses.create',
                'Sửa' => 'admins.courses.edit',
                'Xóa' => 'admins.courses.destroy',
                'Xem' => 'admins.courses.show',
            ],
            'Quản lý Danh sách học viên - Khoá học' => [
                'Danh sách' => 'admins.course-user.index',
                'Thêm' => 'admins.course-user.create',
                'Sửa' => 'admins.course-user.edit',
                'Xóa' => 'admins.course-user.destroy',
                'Xem' => 'admins.course-user.show',
            ],
            'Quản lý nộp tiền' => [
                'Danh sách' => 'admins.fees.index',
                'Thêm' => 'admins.fees.create',
                'Sửa' => 'admins.fees.edit',
                'Xóa' => 'admins.fees.destroy',
                'Xem' => 'admins.fees.show',
            ],
            'Quản lý sân học và thi' => [
                'Danh sách' => 'admins.exam-fields.index',
                'Thêm' => 'admins.exam-fields.create',
                'Sửa' => 'admins.exam-fields.edit',
                'Xóa' => 'admins.exam-fields.destroy',
                'Xem' => 'admins.exam-fields.show',
            ],
            'Quản lý Leadsource' => [
                'Danh sách' => 'admins.lead-sources.index',
                'Thêm' => 'admins.lead-sources.create',
                'Sửa' => 'admins.lead-sources.edit',
                'Xóa' => 'admins.lead-sources.destroy',
                'Xem' => 'admins.lead-sources.show',
            ],
            'Quản lý xe' => [
                'Danh sách' => 'admins.vehicles.index',
                'Thêm' => 'admins.vehicles.create',
                'Sửa' => 'admins.vehicles.edit',
                'Xóa' => 'admins.vehicles.destroy',
                'Xem' => 'admins.vehicles.show',
            ],
            'Quản lý chi phí xe' => [
                'Danh sách' => 'admins.vehicle-expenses.index',
                'Thêm' => 'admins.vehicle-expenses.create',
                'Sửa' => 'admins.vehicle-expenses.edit',
                'Xóa' => 'admins.vehicle-expenses.destroy',
                'Xem' => 'admins.vehicle-expenses.show',
            ],
            'Quản lý thành viên' => [
                'Danh sách' => 'admins.admins.index',
                'Thêm' => 'admins.admins.create',
                'Sửa' => 'admins.admins.edit',
                'Xóa' => 'admins.admins.destroy',
                'Xem' => 'admins.admins.show',
            ],
            'Quản lý vai trò' => [
                'Danh sách' => 'admins.roles.index',
                'Thêm' => 'admins.roles.create',
                'Sửa' => 'admins.roles.edit',
                'Xóa' => 'admins.roles.destroy',
                'Xem' => 'admins.roles.show',
            ],
            'Quản lý quyền' => [
                'Danh sách' => 'admins.permissions.index',
                'Thêm' => 'admins.permissions.create',
                'Sửa' => 'admins.permissions.edit',
                'Xóa' => 'admins.permissions.destroy',
                'Xem' => 'admins.permissions.show',
            ],
            'Quản lý module' => [
                'Danh sách' => 'admins.modules.index',
                'Thêm' => 'admins.modules.create',
                'Sửa' => 'admins.modules.edit',
                'Xóa' => 'admins.modules.destroy',
                'Xem' => 'admins.modules.show',
            ],
            'Log hệ thống' => [
                'Danh sách' => 'admins.activity-logs.index',
            ],
        ];

        // Tạo module và permission
        foreach ($modules as $moduleName => $permissions) {
            $module = Module::updateOrCreate(['name' => $moduleName]);

            foreach ($permissions as $permissionName => $permissionSlug) {
                Permission::updateOrCreate([
                    'module_id' => $module->id,
                    'name' => $permissionName,
                    'slug' => $permissionSlug,
                ]);
            }
        }
    }
}
