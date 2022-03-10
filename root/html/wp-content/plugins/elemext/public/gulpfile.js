var gulp = require('gulp'),
  rename = require('gulp-rename'),
  uglify = require('gulp-uglify'),
  sassLint = require('gulp-sass-lint'),
  uglifycss = require('gulp-uglifycss'),
  sass = require('gulp-sass')(require('sass'));

gulp.task('minjs', function () {
  return gulp.src(['js/elemext.js'])
    .pipe(uglify())
    .pipe(rename({ suffix: '.min' }))
    .pipe(gulp.dest('js'));
});

gulp.task('sasslint', function () {
  return gulp.src('sass/**/*.s+(a|c)ss')
    .pipe(sassLint({
      options: {
        formatter: 'stylish',
        'merge-default-rules': false
      },
      rules: {
        'no-mergeable-selectors': 0,
        'attribute-quotes': 1,
        'url-quotes': 1
      }
    }))
    .pipe(sassLint.format())
    .pipe(sassLint.failOnError())
});

gulp.task('sass', function () {
  return gulp.src('./sass/**/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(rename('elemext.css'))
    .pipe(gulp.dest('css'));
});

gulp.task('mincss', function () {
  return gulp.src('css/elemext.css')
    .pipe(uglifycss({
      "uglyComments": true
    }))
    .pipe(rename('elemext.min.css'))
    .pipe(gulp.dest('css'));
});

gulp.task('style', gulp.series('sasslint', 'sass', 'mincss'));
gulp.task('build', gulp.series('style', 'minjs'));

gulp.task('watch-style', () => {
  gulp.watch('sass/**/*.scss', (done) => {
    gulp.series(['style'])(done);
  });
});

gulp.task('watch-js', () => {
  gulp.watch('js/elemext.js', (done) => {
    gulp.series(['minjs'])(done);
  });
});

gulp.task('watch', () => {
  gulp.watch(['sass/**/*.scss', 'js/elemext.js'], (done) => {
    gulp.series(['build'])(done);
  });
});
