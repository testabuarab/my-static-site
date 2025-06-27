
const path = require('path')

module.exports = {
    lintOnSave: process.env.NODE_ENV !== 'production',
    runtimeCompiler: true,
    filenameHashing: false,
    outputDir: 'assets/dist/cp',
    css: {
        extract: false
    },
    chainWebpack: config => {
        // delete default entry point 'app'
        config.entryPoints.delete("app").end();
        //delete default 'html' plugin - in case you don't want default index.html file
        //delete 'prefetch' and 'preload' plugins which are dependent on 'html' plugin
        config.plugins
        .delete("html")
        .delete("prefetch")
        .delete("preload");
    },
    configureWebpack: {
        entry: {
            cp: "./assets/src/cp.js"
        },
        output: {
            filename: "[name].js"
        },
        resolve: {
          alias: {
            vue: path.resolve('./node_modules/vue'),
            ThemesField: path.resolve(__dirname, '../../vendor/ryssbowh/craft-themes/vue/src/forms/Field.vue')
          }
        }
    }
}