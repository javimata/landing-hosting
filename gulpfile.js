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

gulp.task('styles', function () {
    gulp.src('./assets/less/*.less')
        .pipe(less({
            paths: [path.join(__dirname, 'less', 'includes')]
        }))
        .pipe(autoprefixer({
            browsers: ['last 3 versions']
        }))
        .pipe(minify())
        .pipe(gulp.dest('./dist/css'))
});

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

gulp.task('scripts', function () {
    gulp.src('./assets/js/*.js')
        .pipe(concat('bundle.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./dist/js'));
});

gulp.task('watch', function(){
    gulp.watch('./assets/less/**', gulp.series('styles'));
    gulp.watch('./assets/js/**', gulp.series('scripts'));
    // gulp.watch('./assets/js/**', gulp.series('concat'));

});

gulp.task('default', gulp.parallel('styles', 'scripts'));