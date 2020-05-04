const mix = require('laravel-mix');
require('vuetifyjs-mix-extension');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.

 */



mix.webpackConfig({
        output: {
            chunkFilename: 'js/[name].bundle.js',
            publicPath: '/',
        },
        resolve: {
            extensions: ['.js', '.vue'],
            alias: {
                '@': __dirname + '/resources',
                '@img': __dirname + '/storage/app/public/images'
            }
        },
        module: {
            rules: [{
                    test: /\.pug$/,
                    oneOf: [{
                            resourceQuery: /^\?vue/,
                            use: ['pug-plain-loader']
                        },
                        {
                            use: ['raw-loader', 'pug-plain-loader']
                        }
                    ]
                },
                {
                    test: /\.js$/,
                    loader: 'babel-loader',
                    query: {
                        compact: false
                    }
                },
                {
                    test: /\.scss$/,
                    loader: 'sass-loader',
                },
            ]
        },
    }).js('resources/js/app.js', 'public/js')
    .vuetify('vuetify-loader')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps()
