const gulp         = require('gulp');
const path         = require('path');
const less         = require('gulp-less');
const autoprefixer = require('gulp-autoprefixer');
const minify       = require('gulp-minify-css');
const uglify       = require('gulp-uglify');
const concat       = require('gulp-concat');
const nodepath     = 'node_modules/';
const fs           = require('fs');

var config = JSON.parse(fs.readFileSync('./config.json')),
    assetsAPPCSS = new Array(),
    assetsAPPJS = new Array();

assetsAPPCSS.push(nodepath + 'bootstrap/dist/css/bootstrap.min.css');

if ( config.configuracion.assets.fontawesome == 1 ) {
    assetsAPPCSS.push(nodepath + '@fortawesome/fontawesome-free/css/all.min.css');
}
if (config.configuracion.revolution == 1) {
    assetsAPPCSS.push('./revolution/css/settings.css');
}
if (config.configuracion.assets.aos == 1) {
    assetsAPPCSS.push(nodepath + 'aos/dist/aos.css');
}
if (config.configuracion.assets.animate == 1) {
    assetsAPPCSS.push(nodepath + 'animate.css/animate.min.css');
}

if ( config.configuracion.assets.slick == 1 ) {
    assetsAPPCSS.push(nodepath + 'slick-carousel/slick/slick.css',
        nodepath + 'slick-carousel/slick/slick-theme.css');
    assetsAPPJS.push(nodepath + 'slick-carousel/slick/slick.min.js');
}
if ( config.configuracion.assets.matchHeight == 1 ) {
    assetsAPPJS.push(nodepath + 'jquery-match-height/dist/jquery.matchHeight-min.js');
}
if ( config.configuracion.particlesFooter == 1 ) {
    assetsAPPJS.push(nodepath + 'particles.js/particles.js');
}

/**
 * Genera el archivo principal de styles a partir de Less
 * File assets/less/*.less
 * Toma todos los .less de la carpeta
 */
gulp.task('styles', function () {
    gulp.src('./assets/less/*.less')
        .pipe(less({
            paths: [path.join(__dirname, 'less', 'includes')]
        }))
        .pipe(autoprefixer({
            browsers: ['last 3 versions']
        }))
        .pipe(minify())
        .pipe(gulp.dest('./dist/css'));
});

/**
 * Genera el archivo principal de scripts a partir de js
 * File assets/js/*.js
 * Toma todos los archivos .js de la carpeta
 */
gulp.task('scripts', function () {
    gulp.src('./assets/js/*.js')
        .pipe(concat('bundle.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./dist/js'));
});

/**
 * Genera archivo app.css de dependencias
 */
gulp.task('compile-css', function () {
    gulp.src(assetsAPPCSS)
    .pipe(concat('app.css'))
    .pipe(minify())
    .pipe(gulp.dest('./dist/css/'));
});

/**
 * Genera archivo app.js de dependencias
 */
gulp.task('compile-js', function () {
    gulp.src([
        nodepath + 'jquery/dist/jquery.min.js', 
        nodepath + 'aos/dist/aos.js'
    ])
    .pipe(concat('main.js'))
    .pipe(uglify())
    .pipe(gulp.dest('./dist/js/'));
    gulp.src([
        nodepath + 'bootstrap/dist/js/bootstrap.bundle.min.js'
    ])
        .pipe(concat('bootstrap.bundle.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./dist/js/'));
    gulp.src(assetsAPPJS)
    .pipe(concat('app.js'))
    .pipe(uglify())
    .pipe(gulp.dest('./dist/js/'));

    if (config.configuracion.revolution == 1) {
        gulp.src([
            './revolution/js/jquery.themepunch.tools.min.js',
            './revolution/js/jquery.themepunch.revolution.min.js',
            './revolution/js/extensions/revolution.extension.actions.min.js',
            './revolution/js/extensions/revolution.extension.carousel.min.js',
            './revolution/js/extensions/revolution.extension.kenburn.min.js',
            './revolution/js/extensions/revolution.extension.layeranimation.min.js',
            './revolution/js/extensions/revolution.extension.migration.min.js',
            './revolution/js/extensions/revolution.extension.navigation.min.js',
            './revolution/js/extensions/revolution.extension.parallax.min.js',
            './revolution/js/extensions/revolution.extension.slideanims.min.js',
            './revolution/js/extensions/revolution.extension.video.min.js'
        ])
        .pipe(concat('revolution.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./dist/js/'));
        gulp.src([
            './revolution/fonts/revicons/**'])
            .pipe(gulp.dest('dist/fonts/revicons/'));
    }
});


// Fonts
gulp.task('fonts', function () {
    if ( config.configuracion.assets.fontawesome == 1 ) {
        gulp.src([
            nodepath + '/@fortawesome/fontawesome-free/webfonts/**'])
            .pipe(gulp.dest('dist/webfonts/'));
    }
    if ( config.configuracion.assets.slick == 1 ) {
        gulp.src([
            nodepath + 'slick-carousel/slick/fonts/**'])
            .pipe(gulp.dest('dist/css/fonts/'));
        gulp.src([
            nodepath + 'slick-carousel/slick/ajax-loader.gif'])
            .pipe(gulp.dest('dist/css/'));
    }
});

/**
 * Watchs para archivos principales, no se checan dependencias
 */
gulp.task('watch', function(){
    gulp.watch('./assets/less/**', gulp.series('styles'));
    gulp.watch('./assets/js/**', gulp.series('scripts'));
});

/**
 * Genera archivos de arranque
 */
gulp.task('default', gulp.parallel('compile-css', 'styles', 'compile-js', 'scripts', 'fonts'));