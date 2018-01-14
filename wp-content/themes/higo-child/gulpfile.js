//
// Gulpfile setup
//
// @since 1.0.0
// @authors Charline Couchot
// @package CC2017
//

'use strict'

// Definir Gulp et plugins non-gulp
var gulp = require('gulp');
var autoprefixer = require('autoprefixer');
var browserSync = require('browser-sync');

// Inclure les plugins
var plugins = require("gulp-load-plugins")();

// Chemins de configuration
var scssFiles = './assets/css/scss/**/*.scss',
    jsFiles   = './assets/js/**/*.js',
    imgFiles  = './assets/images/raw/**/*.{jpg,gif,png,svg}';

// Chemins de destination
var cssDest  = './',
    scssDest = './assets/css/scss',
    jsDest   = './assets/js',
    imgDest  = './assets/images',
    fontDest = './assets/fonts';


// GESTION DES DEPENDANCES NPM
gulp.task('dependencies', function() {
  const filterCss = plugins.filter(['**/*.css', '!**/*.min.css', '!**/docs/**/*', '!**/src/**/*', '!**/*demos.css'], {restore: true});
  const filterFont = plugins.filter(['**/*.{eot,woff,ttf,svg}'], {restore: true});

  gulp.src(plugins.npmFiles(), { base:'./node_modules/' })
    .pipe(filterCss)
    .pipe(plugins.rename({dirname: ''}))
    .pipe(gulp.dest(scssDest + '/plugins'))
    .pipe(filterCss.restore)
    .pipe(filterFont)
    .pipe(plugins.rename({dirname: ''}))
    .pipe(gulp.dest(fontDest));

  gulp.src(plugins.npmFiles(), { base:'./node_modules/' })
    .pipe(plugins.filter(['**/*.min.js']))
    .pipe(plugins.rename({dirname: ''}))
    .pipe(gulp.dest(jsDest + '/plugins'));
});

// COMPILATION SASS
gulp.task('css', function () {
  gulp.src('./assets/css/scss/style.scss')
    .pipe(plugins.sourcemaps.init())
		.pipe(plugins.sass().on('error', plugins.sass.logError))
		.pipe(plugins.sourcemaps.write({includeContent: false}))
		.pipe(plugins.sourcemaps.init({loadMaps: true}))
		.pipe(plugins.postcss([autoprefixer]))
		.pipe(plugins.sourcemaps.write('.'))
		.pipe(gulp.dest(cssDest))
		.pipe(plugins.filter('**/*.css'))
		.pipe(plugins.groupCssMediaQueries())
		.pipe(gulp.dest(cssDest));

    gulp.src('./assets/css/scss/editor.scss')
      .pipe(plugins.sourcemaps.init())
  		.pipe(plugins.sass().on('error', plugins.sass.logError))
  		.pipe(plugins.sourcemaps.write({includeContent: false}))
  		.pipe(plugins.sourcemaps.init({loadMaps: true}))
  		.pipe(plugins.postcss([autoprefixer]))
  		.pipe(plugins.sourcemaps.write('.'))
  		.pipe(gulp.dest('./assets/css'))
  		.pipe(plugins.filter('**/*.css'))
  		.pipe(plugins.groupCssMediaQueries())
  		.pipe(gulp.dest('./assets/css'));
});

// CUSTOM SCRIPTS
gulp.task('js', function() {
  const scriptsFilter = plugins.filter(['scripts.js'], {restore: true});

  return gulp.src(jsFiles)
    .pipe(scriptsFilter)
    .pipe(plugins.jshint('./.jshintrc'))
    .pipe(plugins.jshint.reporter('jshint-stylish'))
    .pipe(scriptsFilter.restore)
    .pipe(plugins.filter(['**/*.js', '!**/vendor/*.js', '!**/ie/*', '!**/scripts.min.js']))
    .pipe(plugins.order([
			'**/plugins/*',
			'**/*'
		]))
		.pipe(plugins.concat('scripts.min.js'))
    //.pipe(plugins.uglify())
    //.on('error', function (err) { plugins.util.log(plugins.util.colors.red('[Error]'), err.toString()); })
		.pipe(gulp.dest(jsDest));
});

// IMAGES
gulp.task('images', function () {
  // Add the newer pipe to pass through newer images only
  return gulp.src([imgFiles])
    .pipe(plugins.newer('./assets/images/'))
    .pipe(plugins.rimraf({force: true}))
    .pipe(plugins.imagemin({optimizationLevel: 7,progressive: true,interlaced: true}))
    .pipe(gulp.dest(imgDest))
    .pipe(plugins.notify({message: 'Images optimisées',onLast: true}));
});


// TÂCHE PAR DEFAUT
gulp.task('default', ['dependencies', 'css', 'js', 'images'], function () {
    gulp.watch('./assets/images/**/*', ['images']);
    gulp.watch('./assets/css/scss/**/*.scss', ['css']);
    gulp.watch(['./assets/js/**/*.js', '!./assets/js/scripts.min.js'], ['js']);
});
