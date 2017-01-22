const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

const path = require('path');
require('laravel-elixir-webpack-official');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {
    Elixir.webpack.mergeConfig({
        resolveLoader: {
            root: path.join(__dirname, 'node_modules'),
        },
        module: {
            loaders: [
                {
                    test: /\.css$/,
                    loader: 'style!css'
                }
            ]
        }
    });

    mix.sass('app.scss')
       .webpack('app.js');
});
