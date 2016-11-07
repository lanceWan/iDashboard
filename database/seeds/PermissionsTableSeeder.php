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
            'slug' => 'system.login',
            'description' => '登录后台权限'
        ]);
        Permission::create([
            'name' => '后台首页',
            'slug' => 'system.index',
            'description' => '后台首页'
        ]);
        //////////
        //系统管理//
        //////////
        Permission::create([
            'name' => '系统管理',
            'slug' => 'system.manage',
            'description' => '系统管理'
        ]);
        /**
         * 显示菜单列表
         */
        Permission::create([
            'name' => '显示菜单列表',
            'slug' => 'menu.list',
            'description' => '显示菜单列表'
        ]);
        /**
         * 创建菜单
         */
        Permission::create([
            'name' => '创建菜单',
            'slug' => 'menu.create',
            'description' => '创建菜单'
        ]);
        /**
         * 删除菜单
         */
        Permission::create([
            'name' => '删除菜单',
            'slug' => 'menu.destroy',
            'description' => '删除菜单'
        ]);
        /**
         * 修改菜单
         */
        Permission::create([
            'name' => '修改菜单',
            'slug' => 'menu.edit',
            'description' => '修改菜单'
        ]);
        /**
         * 查看菜单信息
         */
        Permission::create([
            'name' => '查看菜单',
            'slug' => 'menu.show',
            'description' => '查看菜单'
        ]);
        /////////////
        //角色管理 //
        ////////////
        /**
         * 显示角色列表
         */
        Permission::create([
            'name' => '显示角色列表',
            'slug' => 'role.list',
            'description' => '显示角色列表'
        ]);
        /**
         * 创建角色
         */
        Permission::create([
            'name' => '创建角色',
            'slug' => 'role.create',
            'description' => '创建角色'
        ]);
        /**
         * 删除角色
         */
        Permission::create([
            'name' => '删除角色',
            'slug' => 'role.destroy',
            'description' => '删除角色'
        ]);
        /**
         * 修改角色
         */
        Permission::create([
            'name' => '修改角色',
            'slug' => 'role.edit',
            'description' => '修改角色'
        ]);
        /**
         * 查看角色权限
         */
        Permission::create([
            'name' => '查看角色权限',
            'slug' => 'role.show',
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
            'slug' => 'permission.list',
            'description' => '显示权限列表'
        ]);
        /**
         * 创建权限
         */
        Permission::create([
            'name' => '创建权限',
            'slug' => 'permission.create',
            'description' => '创建权限'
        ]);
        /**
         * 删除权限
         */
        Permission::create([
            'name' => '删除权限',
            'slug' => 'permission.destroy',
            'description' => '删除权限'
        ]);
        /**
         * 修改权限
         */
        Permission::create([
            'name' => '修改权限',
            'slug' => 'permission.edit',
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
            'slug' => 'user.list',
            'description' => '显示用户列表'
        ]);
        /**
         * 创建用户
         */
        Permission::create([
            'name' => '创建用户',
            'slug' => 'user.create',
            'description' => '创建用户'
        ]);
        /**
         * 修改用户信息
         */
        Permission::create([
            'name' => '修改用户',
            'slug' => 'user.edit',
            'description' => '修改用户'
        ]);
        /**
         * 删除用户
         */
        Permission::create([
            'name' => '删除用户',
            'slug' => 'user.destroy',
            'description' => '删除用户'
        ]);
        /**
         * 查看用户信息
         */
        Permission::create([
            'name' => '查看用户信息',
            'slug' => 'user.show',
            'description' => '查看用户信息'
        ]);
        /**
         * 修改用户密码
         */
        Permission::create([
            'name' => '修改用户密码',
            'slug' => 'user.reset',
            'description' => '修改用户密码'
        ]);
        ////////
        //日志//
        ////////
        Permission::create([
            'name' => '日志管理',
            'slug' => 'log.list',
            'description' => '日志管理'
        ]);

        Permission::create([
            'name' => '删除日志',
            'slug' => 'log.destroy',
            'description' => '删除日志'
        ]);

        Permission::create([
            'name' => '查看日志',
            'slug' => 'log.show',
            'description' => '查看日志'
        ]);

        Permission::create([
            'name' => '下载日志',
            'slug' => 'log.download',
            'description' => '下载日志'
        ]);

        Permission::create([
            'name' => '筛选日志信息',
            'slug' => 'log.filter',
            'description' => '筛选日志信息'
        ]);
    }
}
