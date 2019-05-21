const gulp         = require('gulp');
const watch        = require('gulp-watch');
const path         = require('path');
const less         = require('gulp-less');
const autoprefixer = require('gulp-autoprefixer');
const minify       = require('gulp-minify-css');
const jshint       = require('gulp-jshint');
const stylish      = require('jshint-stylish');
const uglify       = require('gulp-uglify');
const concat       = require('gulp-concat');
const nodepath     = 'node_modules/';

/*
gulp.task('js', function () {
    gulp.src('./assets/js/*.js')
        .pipe(jshint())
        .pipe(jshint.reporter(stylish))
        .pipe(gulp.dest('./dist/js'));
});

gulp.task('concat', function () {
    gulp.src('./assets/js/*.js')
        .pipe(concat('bundle.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./dist/js'));
});
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

gulp.task('scripts', function () {
    gulp.src('./assets/js/*.js')
        .pipe(concat('bundle.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./dist/js'));
});

gulp.task('compile-css', function () {
    gulp.src([
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

/*
gulp.task('watch', function(){
    gulp.watch('./assets/less/**', gulp.series('styles'));
    gulp.watch('./assets/js/**', gulp.series('scripts'));
});
*/

gulp.task('default', gulp.parallel('compile-css', 'styles', 'compile-js', 'scripts'));