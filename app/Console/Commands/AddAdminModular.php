<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Composer;
use Illuminate\Filesystem\Filesystem;

/**
 * Class AddAdminModular
 * @package App\Console\Commands
 * @author 放水的星星
 * @time 2017年6月16日15:11:29
 */
class AddAdminModular extends Command
{
    /**
     * 控制台的命令名称
     *
     * @var string
     */
    protected $signature = 'make:modular {name}';

    /**
     * 控制台中命令描述
     *
     * @var string
     */
    protected $description = 'Create a new Modular';

    /**
     * 名称参数
     * @var string
     */
    protected $name;

    /**
     * 添加composer 自动加载方法
     * @var Composer
     */
    protected $composer;

    /**
     * 添加files文件使用
     * @var Filesystem
     */
    protected $files;

    /**
     * 控制器前缀路径
     * @var string
     */
    protected $controllerPath = 'admin/';

    /**
     * 模型前缀路径
     * @var string
     */
    protected $repositoryPath = 'Repositories/Contracts/';

    /**
     * Create a new command instance.
     * @param $composer
     * @return void
     */
    public function __construct(Filesystem $filesystem, Composer $composer)
    {
        parent::__construct();
        $this->files = $filesystem;
        $this->composer = $composer;
    }

    /**
     * 执行控制台命令.
     *
     * @return mixed
     */
    public function handle()
    {
        //获取名称参数

        $this->name = $this->argument('name');
        $this->writeController();
        $this->writeRepository();
        $this->writeBase();
        $this->composer->dumpAutoloads();
        $this->info('Modular created successfully.');

    }

    /**
     * 生成控制器文件
     */
    private function writeController(){
        $this->call('make:controller',[
            'name'=>$this->controllerPath.$this->name.'Controller',
            '--resource'=>true
        ]);
    }

    /**
     * 添加repository文件
     */
    private function writeRepository(){
        $this->call('make:repository',[
            'name'=>$this->name
        ]);
    }

    /**
     * 添加serve文件
     */
    private  function writeBase(){
        $this->files->put(app_path('Service'.DIRECTORY_SEPARATOR.'Admin'.DIRECTORY_SEPARATOR).$this->name.'Service.php',resource_path('stubs'.DIRECTORY_SEPARATOR.'Service').DIRECTORY_SEPARATOR.'service.stub');
        $this->files->put(resource_path('lang'.DIRECTORY_SEPARATOR.'zh'.DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR).$this->name.'.php','');
    }
}
