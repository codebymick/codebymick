var gulp = require('gulp'),
    jshint = require('gulp-jshint'),
    sass = require('gulp-ruby-sass'),
    sourcemaps = require('gulp-sourcemaps'),
    webserver = require('gulp-webserver'),
    minifyHTML = require('gulp-minify-html'),
    htmlSources = ['input/*.html'];


gulp.task('js', function() {
  return gulp.src('output/js/myscript.js')
    .pipe(jshint('./.jshintrc'))
    .pipe(jshint.reporter('jshint-stylish'));
});

gulp.task('html', function() {
  gulp.src('input/*.html')
  .pipe(minifyHTML())
  .pipe(gulp.dest('output/'))
});


gulp.task('php', function() {
  gulp.src('input/*.php')
  .pipe(minifyHTML())
  .pipe(gulp.dest('output/'))
});

gulp.task('sass', function () {
    return sass('input/style.scss', {
      sourcemap: true,
      style: 'compressed'
    })
    .on('error', function (err) {
        console.error('Error!', err.message);
    })
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('output/css'));
});

gulp.task('watch', function() {
  gulp.watch('output/js/**/*', ['js']);
  gulp.watch(['input/**/*'], ['sass']);
  gulp.watch('input/*.html', ['html']);
  gulp.watch('input/*.php', ['php']);

});

gulp.task('webserver', function() {
    gulp.src('output/')
        .pipe(webserver({
            livereload: true,
            open: true
        }));
});

gulp.task('default', ['sass', 'html','watch', 'webserver']);
