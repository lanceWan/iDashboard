<?php

use Illuminate\Database\Seeder;
use GeniusTS\Roles\Models\Permission;
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
            'slug' => 'admin.systems.login',
            'description' => '登录后台权限'
        ]);
        Permission::create([
            'name' => '后台首页',
            'slug' => 'admin.systems.index',
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
            'slug' => 'admin.systems.manage',
            'description' => '系统管理'
        ]);
        /**
         * 显示菜单列表
         */
        Permission::create([
            'name' => '显示菜单列表',
            'slug' => 'admin.menus.list',
            'description' => '显示菜单列表'
        ]);
        /**
         * 创建菜单
         */
        Permission::create([
            'name' => '创建菜单',
            'slug' => 'admin.menus.create',
            'description' => '创建菜单'
        ]);
        /**
         * 删除菜单
         */
        Permission::create([
            'name' => '删除菜单',
            'slug' => 'admin.menus.delete',
            'description' => '删除菜单'
        ]);
        /**
         * 修改菜单
         */
        Permission::create([
            'name' => '修改菜单',
            'slug' => 'admin.menus.edit',
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
            'slug' => 'admin.roles.list',
            'description' => '显示角色列表'
        ]);
        /**
         * 创建角色
         */
        Permission::create([
            'name' => '创建角色',
            'slug' => 'admin.roles.create',
            'description' => '创建角色'
        ]);
        /**
         * 删除角色
         */
        Permission::create([
            'name' => '删除角色',
            'slug' => 'admin.roles.delete',
            'description' => '删除角色'
        ]);
        /**
         * 修改角色
         */
        Permission::create([
            'name' => '修改角色',
            'slug' => 'admin.roles.edit',
            'description' => '修改角色'
        ]);
        /**
         * 查看角色权限
         */
        Permission::create([
            'name' => '查看角色权限',
            'slug' => 'admin.roles.show',
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
            'slug' => 'admin.permissions.list',
            'description' => '显示权限列表'
        ]);
        /**
         * 创建权限
         */
        Permission::create([
            'name' => '创建权限',
            'slug' => 'admin.permissions.create',
            'description' => '创建权限'
        ]);
        /**
         * 删除权限
         */
        Permission::create([
            'name' => '删除权限',
            'slug' => 'admin.permissions.delete',
            'description' => '删除权限'
        ]);
        /**
         * 修改权限
         */
        Permission::create([
            'name' => '修改权限',
            'slug' => 'admin.permissions.edit',
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
            'slug' => 'admin.users.list',
            'description' => '显示用户列表'
        ]);
        /**
         * 创建用户
         */
        Permission::create([
            'name' => '创建用户',
            'slug' => 'admin.users.create',
            'description' => '创建用户'
        ]);
        /**
         * 删除用户
         */
        Permission::create([
            'name' => '删除用户',
            'slug' => 'admin.users.delete',
            'description' => '删除用户'
        ]);
        /**
         * 查看用户信息
         */
        Permission::create([
            'name' => '查看用户信息',
            'slug' => 'admin.users.show',
            'description' => '查看用户信息'
        ]);
        /**
         * 修改用户密码
         */
        Permission::create([
            'name' => '修改用户密码',
            'slug' => 'admin.users.reset',
            'description' => '修改用户密码'
        ]);
    }
}
