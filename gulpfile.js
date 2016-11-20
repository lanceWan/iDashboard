const elixir = require('laravel-elixir');
const path = require('path');
require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir(mix => {

	Elixir.webpack.mergeConfig({
        resolveLoader: {
            root: path.join(__dirname, 'node_modules'),
        },
        resolve: {
	        // require时省略的扩展名，如：require('module') 不需要module.js
	        extensions: ['.js', '.vue'],
	        // 别名，可以直接使用别名来代表设定的路径以及其他
	        alias: {
		      	js: path.join(__dirname, "./public/js"),
		      	css: path.join(__dirname, "./public/css"),
		      	vendor: path.join(__dirname, "./node_modules")
		    }
	    },
        module: {
            loaders: [
                {test: /\.css$/,loader: 'style!css'},
                {test: /\.(gif|jpg|png)\??.*$/, loader: 'url-loader?limit=8192&patterns/[hash:8].[name].[ext]'},
            ]
        }
    });

    mix.sass('style.scss')
    .scripts([
        'admin/inspinia.js'
    ],'public/js/all.js')
    .copy('resources/assets/css/patterns', 'public/css/patterns')
    .webpack('app.js');
});
