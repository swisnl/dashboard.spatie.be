const { mix } = require('laravel-mix');

mix
    .setPublicPath('public_html/')

    .js('resources/assets/js/app.js', 'public_html/js')
    .sass('resources/assets/css/app.css', 'public_html/css')

	.version()

    .options({
        processCssUrls: false,
    })

    .webpackConfig({
        module: {
            rules: [
                // With the `import-glob-loader` we can use globs in our import
                // statements in css.
                {
                    test: /\.css/,
                    loader: 'import-glob-loader',
                    enforce: 'pre',
                },
            ],
        },
    });
