'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var cssnano = require('gulp-cssnano'); // minimizza CSS @link https://www.npmjs.com/package/gulp-cssnano
var uglify  = require('gulp-uglify'); // minimizza i files JS @link https://github.com/terinjokes/gulp-uglify
var concat  = require('gulp-concat'); // concatenatore di files @link https://github.com/contra/gulp-concat
var postcss = require("gulp-postcss");
var autoprefixer = require("autoprefixer");
var notify       = require('gulp-notify');

//sass.compiler = require('node-sass');

//SASS///
gulp.task('styles', function () {
  return gulp.src('scss/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(cssnano())
    .pipe(gulp.dest('../public/css'))
    .pipe(notify({
		message: 'CSS prodotto!',
		onLast: true,
		sound: 'Pop'
		})
	);
});

//JS///
gulp.task('js_scripts', function () {
  return gulp.src('js/*.js')
    .pipe(uglify())
    .pipe(gulp.dest('../public/js'))
    .pipe(notify({
		message: 'JS prodotto!',
		onLast: true,
		sound: 'Pop'
		})
  );
});

//TASK WATCH SCRITTO PER LA VERSIONE 4 DI GULP.JS (NEL 3 SI SCRIVE COSI['styles'] e senza gulp.series)
gulp.task('watch', function () {
  gulp.watch('scss/**/*.scss', gulp.series('styles'));
  gulp.watch('js/**/*.js', gulp.series('js_scripts'));
});

//TASK PER LANCIARE AUTOMATICAMENTE CON SOLO il comando GULP tutti i task in versione GULP 4 con gulp.parallel
gulp.task('default', gulp.parallel('styles','js_scripts','watch'));
