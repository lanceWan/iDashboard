<?php
use Illuminate\Database\Seeder;
use App\Models\Permission;
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //////////////////
        ///登录后台权限 //
        /////////////////
        Permission::create([
            'name' => '登录后台权限',
            'slug' => 'admin.system.login',
            'description' => '登录后台权限'
        ]);
        Permission::create([
            'name' => '后台首页',
            'slug' => 'admin.system.index',
            'description' => '后台首页'
        ]);
        Permission::create([
            'name' => '显示日志总览',
            'slug' => 'admin.logs.all',
            'description' => '显示日志总览'
        ]);
        Permission::create([
            'name' => '显示日志列表',
            'slug' => 'admin.logs.list',
            'description' => '显示日志列表'
        ]);
        //////////
        //系统管理//
        //////////
        Permission::create([
            'name' => '系统管理',
            'slug' => 'admin.system.manage',
            'description' => '系统管理'
        ]);
        /**
         * 显示菜单列表
         */
        Permission::create([
            'name' => '显示菜单列表',
            'slug' => 'admin.menu.list',
            'description' => '显示菜单列表'
        ]);
        /**
         * 创建菜单
         */
        Permission::create([
            'name' => '创建菜单',
            'slug' => 'admin.menu.create',
            'description' => '创建菜单'
        ]);
        /**
         * 删除菜单
         */
        Permission::create([
            'name' => '删除菜单',
            'slug' => 'admin.menu.destroy',
            'description' => '删除菜单'
        ]);
        /**
         * 修改菜单
         */
        Permission::create([
            'name' => '修改菜单',
            'slug' => 'admin.menu.edit',
            'description' => '修改菜单'
        ]);
        /////////////
        //角色管理 //
        ////////////
        /**
         * 显示角色列表
         */
        Permission::create([
            'name' => '显示角色列表',
            'slug' => 'admin.role.list',
            'description' => '显示角色列表'
        ]);
        /**
         * 创建角色
         */
        Permission::create([
            'name' => '创建角色',
            'slug' => 'admin.role.create',
            'description' => '创建角色'
        ]);
        /**
         * 删除角色
         */
        Permission::create([
            'name' => '删除角色',
            'slug' => 'admin.role.destroy',
            'description' => '删除角色'
        ]);
        /**
         * 修改角色
         */
        Permission::create([
            'name' => '修改角色',
            'slug' => 'admin.role.edit',
            'description' => '修改角色'
        ]);
        /**
         * 查看角色权限
         */
        Permission::create([
            'name' => '查看角色权限',
            'slug' => 'admin.role.show',
            'description' => '查看角色权限'
        ]);
        /////////////
        //权限管理 //
        ////////////
        /**
         * 显示权限列表
         */
        Permission::create([
            'name' => '显示权限列表',
            'slug' => 'admin.permission.list',
            'description' => '显示权限列表'
        ]);
        /**
         * 创建权限
         */
        Permission::create([
            'name' => '创建权限',
            'slug' => 'admin.permission.create',
            'description' => '创建权限'
        ]);
        /**
         * 删除权限
         */
        Permission::create([
            'name' => '删除权限',
            'slug' => 'admin.permission.destroy',
            'description' => '删除权限'
        ]);
        /**
         * 修改权限
         */
        Permission::create([
            'name' => '修改权限',
            'slug' => 'admin.permission.edit',
            'description' => '修改权限'
        ]);
        /////////////
        //用户管理 //
        ////////////
        /**
         * 显示用户列表
         */
        Permission::create([
            'name' => '显示用户列表',
            'slug' => 'admin.user.list',
            'description' => '显示用户列表'
        ]);
        /**
         * 创建用户
         */
        Permission::create([
            'name' => '创建用户',
            'slug' => 'admin.user.create',
            'description' => '创建用户'
        ]);
        /**
         * 删除用户
         */
        Permission::create([
            'name' => '删除用户',
            'slug' => 'admin.user.destroy',
            'description' => '删除用户'
        ]);
        /**
         * 查看用户信息
         */
        Permission::create([
            'name' => '查看用户信息',
            'slug' => 'admin.user.show',
            'description' => '查看用户信息'
        ]);
        /**
         * 修改用户密码
         */
        Permission::create([
            'name' => '修改用户密码',
            'slug' => 'admin.user.reset',
            'description' => '修改用户密码'
        ]);
    }
}
