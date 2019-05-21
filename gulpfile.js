const gulp         = require('gulp');
const path         = require('path');
const less         = require('gulp-less');
const autoprefixer = require('gulp-autoprefixer');
const minify       = require('gulp-minify-css');
const uglify       = require('gulp-uglify');
const concat       = require('gulp-concat');
const nodepath     = 'node_modules/';

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
    gulp.src([
        './revolution/css/settings.css',
        nodepath + 'bootstrap/dist/css/bootstrap.min.css',
        nodepath + 'slick-carousel/slick/slick.css',
        nodepath + 'slick-carousel/slick/slick-theme.css',
        nodepath + '@fortawesome/fontawesome-free/css/all.min.css',
        nodepath + 'animate.css/animate.min.css',
        nodepath + 'aos/dist/aos.css',
        nodepath + '@fancyapps/fancybox/dist/jquery.fancybox.min.css'
    ])
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
        nodepath + 'bootstrap/dist/js/bootstrap.bundle.min.js',
        nodepath + 'jquery-match-height/dist/jquery.matchHeight-min.js',
        nodepath + 'slick-carousel/slick/slick.min.js',
        nodepath + '@fancyapps/fancybox/dist/jquery.fancybox.min.js',
        nodepath + 'particles.js/particles.js',
        nodepath + 'aos/dist/aos.js'
    ])
    .pipe(concat('app.js'))
    .pipe(uglify())
    .pipe(gulp.dest('./dist/js/'));
});

/**
 * Genera archivo app.js de dependencias
 */
gulp.task('compile-revolution', function () {
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
gulp.task('default', gulp.parallel('compile-css', 'styles', 'compile-js', 'compile-revolution', 'scripts'));