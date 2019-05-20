const gulp = require('gulp');
const concat = require('gulp-concat');
const concatCss = require('gulp-concat-css');

const files = [
    './resources/js/*.js',
    './resources/css/*.css'
];

gulp.task('default', ['concat', 'concatCss'], () => {
    console.log("run task => default");
    gulp.watch(files, ['concat', 'concatCss']);
});

gulp.task('concat', () => {
    return gulp.src('./resources/js/*.js')
        .pipe(concat('all.js'))
        .pipe(gulp.dest('./public/js'));
});

gulp.task('concatCss', () => {
    return gulp.src('./resources/css/*.css')
        .pipe(concatCss('app.css'))
        .pipe(gulp.dest('./public/css'));
});