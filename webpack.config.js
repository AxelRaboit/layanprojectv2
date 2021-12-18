const Encore = require('@symfony/webpack-encore');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
    // only needed for CDN's or sub-directory deploy
    //.setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if your JavaScript imports CSS.
     */
    .addEntry('app', './assets/js/app.js')

    .addEntry('login', './assets/js/security/login.js')

    .addEntry('homepage', './assets/js/home/homepage.js')
    .addEntry('contactCustomer', './assets/js/contact/contactCustomer.js')
    .addEntry('dashboardAdmin', './assets/js/admin/dashboardAdmin.js')
        
    .addEntry('societyNew', './assets/js/society/societyNew.js')
    .addEntry('societyModify', './assets/js/society/societyModify.js')
    .addEntry('societyIndex', './assets/js/society/societyIndex.js')
    .addEntry('societyShow', './assets/js/society/societyShow.js')
    
    .addEntry('itemNew', './assets/js/item/itemNew.js')
    .addEntry('itemModify', './assets/js/item/itemModify.js')
    .addEntry('itemIndex', './assets/js/item/itemIndex.js')
    .addEntry('itemShow', './assets/js/item/itemShow.js')
    
    .addEntry('dashboardUser', './assets/js/user/dashboardUser.js')
    .addEntry('adminUserNew', './assets/js/user/adminUserNew.js')
    .addEntry('adminUserModify', './assets/js/user/adminUserModify.js')
    .addEntry('adminUserIndex', './assets/js/user/adminUserIndex.js')
    .addEntry('adminUserShow', './assets/js/user/adminUserShow.js')
    .addEntry('adminUserChangePassword', './assets/js/user/adminUserChangePassword.js')
    .addEntry('adminUserChangeEmail', './assets/js/user/adminUserChangeEmail.js')
    .addEntry('adminUserChangeSociety', './assets/js/user/adminUserChangeSociety.js')

    .addEntry('customerNew', './assets/js/customer/customerNew.js')
    .addEntry('customerModify', './assets/js/customer/customerModify.js')
    .addEntry('customerIndex', './assets/js/customer/customerIndex.js')
    .addEntry('customerShow', './assets/js/customer/customerShow.js')


    // enables the Symfony UX Stimulus bridge (used in assets/bootstrap.js)
    .enableStimulusBridge('./assets/controllers.json')

    // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
    .splitEntryChunks()

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()

    /*
     * FEATURE CONFIG
     *
     * Enable & configure other features below. For a full
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    .configureBabel((config) => {
        config.plugins.push('@babel/plugin-proposal-class-properties');
    })

    // enables @babel/preset-env polyfills
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = 3;
    })

    // enables Sass/SCSS support
    .enableSassLoader()

    // uncomment if you use TypeScript
    //.enableTypeScriptLoader()

    // uncomment if you use React
    //.enableReactPreset()

    // uncomment to get integrity="..." attributes on your script & link tags
    // requires WebpackEncoreBundle 1.4 or higher
    //.enableIntegrityHashes(Encore.isProduction())

    // uncomment if you're having problems with a jQuery plugin
    //.autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();
