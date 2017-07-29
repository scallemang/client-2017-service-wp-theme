// Load plugins
var $        = require('gulp-load-plugins')(),
  argv     = require('yargs').argv,
  browser  = require('browser-sync'),
  gulp     = require('gulp'),
  panini   = require('panini'),
  sequence = require('run-sequence'),
  sherpa   = require('style-sherpa'),
  //https://github.com/addyosmani/critical
  //critical   = require('gulp-critical'),
  sourcemaps = require('gulp-sourcemaps'),
  plugins = require('gulp-load-plugins')({ camelize: true }),
  lr = require('tiny-lr'),
  server = lr(),
  sass = require('gulp-ruby-sass');


// Check for --production flag
var isProduction = !!(argv.production);

// Port to use for the development server.
var PROXY = "libertyridge.dev/";

// File paths to various assets are defined here.
var PATHS = {
  sass: [
    'sass/**/*.scss',
    'sass/*.scss'
  ],
  vendorjs: [
  ],
  localjs: [
    'js/scripts.js'
  ],
  images: [
    'img/*'
  ]
};

//Sass Styles
gulp.task('styles', function () {
  return sass(PATHS.sass, {
      lineNumbers: true
    })
    .on('error', sass.logError)
    .pipe(gulp.dest('../assets/css'))
});

// Site Scripts
gulp.task('local-scripts', function() {
  return gulp.src(PATHS.localjs)
  .pipe(plugins.jshint('.jshintrc'))
  .pipe(plugins.jshint.reporter('default'))
  .pipe(plugins.concat('script.js'))
  .pipe(gulp.dest('../assets/js'))
  .pipe(plugins.rename({ suffix: '.min' }))
  .pipe(plugins.uglify())
  .pipe(plugins.livereload(server))
  .pipe(plugins.notify({ message: 'Local scripts task complete' }));
});

gulp.task('vendor-scripts', function() {
  return gulp.src(PATHS.vendorjs)
  .pipe(plugins.jshint('.jshintrc'))
  .pipe(plugins.jshint.reporter('default'))
  .pipe(plugins.concat('plugins.js'))
  .pipe(gulp.dest('../assets/js'))
  .pipe(plugins.rename({ suffix: '.min' }))
  .pipe(plugins.uglify())
  .pipe(plugins.livereload(server))
  .pipe(plugins.notify({ message: 'Local scripts task complete' }));
});

// Images
gulp.task('images', function() {
  return gulp.src(PATHS.images)
  .pipe(plugins.cache(plugins.imagemin({ progressive: true })))
  .pipe(plugins.livereload(server))
  .pipe(gulp.dest('../assets/img'))
  .pipe(plugins.notify({ message: 'Images task complete' }));
});

// Watch
gulp.task('watch', function() {

  // Spin up a server and watch the files
  server.listen(35729, function (err) {
    if (err) {
      return console.log(err)
    };
    gulp.watch(PATHS.sass, ['styles']);
    gulp.watch([PATHS.localjs], ['local-scripts']);
    gulp.watch(PATHS.images, ['images']);
  });

});

// Default task
gulp.task('default', [
    'styles',
    // 'vendor-scripts',
    'local-scripts',
    'images',
    'watch'
  ]
);