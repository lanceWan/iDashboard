<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('menus', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('pid')->default(0)->comment('菜单关系');
            $table->string('name')->default('')->comment('菜单名称');
            $table->string('icon')->default('')->comment('图标');
            $table->string('slug')->default('')->comment('菜单对应的权限');
            $table->string('url')->default('')->comment('菜单链接地址');
            $table->string('active')->default('')->comment('菜单高亮地址');
            $table->string('description')->default('')->comment('描述');
            $table->tinyInteger('sort')->default(0)->comment('排序');
            $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('menus');
	}

}
