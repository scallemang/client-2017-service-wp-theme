// Load plugins
var $        = require('gulp-load-plugins')(),
  browser  = require('browser-sync'),
  gulp     = require('gulp'),
  sequence = require('run-sequence'),
  sourcemaps = require('gulp-sourcemaps'),
  plugins = require('gulp-load-plugins')({ camelize: true }),
  lr = require('tiny-lr'),
  server = lr(),
  sass = require('gulp-ruby-sass');
  //critical   = require('gulp-critical'), https://github.com/addyosmani/critical

//Listen on this port
var PORT = 35729;

// File paths to various assets are defined here.
var PATHS = {
  sass: [
    'node_modules/simplegrid/simple-grid.scss',
    'sass/**/*.scss'
  ],
  css: [
    'node_modules/bootstrap/dist/css/bootstrap.css',
    'node_modules/bootstrap/dist/css/bootstrap-theme.css',
  ],
  plugins: [
    'node_modules/bowser/bowser.js',
    'node_modules/angular/angular.js',
    'node_modules/angular-ui-router/release/angular-ui-router.js',
    'node_modules/angular-bootstrap/ui-bootstrap.js',
  ],
  localjs: [
    'js/ControllerRegister.js'
  ],
  images: [
    'img/**/*'
  ]
};

//Sass Styles
gulp.task('sass', function () {
  return sass(PATHS.sass, {
      lineNumbers: true
    })
    .on('error', sass.logError)
    .pipe(gulp.dest('../dist/css'))
});

// Site Scripts
gulp.task('local-scripts', function() {
  return gulp.src(PATHS.localjs)
  // .pipe(plugins.jshint('.jshintrc'))
  .pipe(plugins.jshint.reporter('default'))
  .pipe(plugins.concat('main.js'))
  .pipe(gulp.dest('../dist/js'))
  .pipe(plugins.rename({ suffix: '.min' }))
  .pipe(plugins.uglify())
  .pipe(plugins.livereload(server));
  // .pipe(plugins.notify({ message: 'Local scripts task complete' }));
});

// Site Scripts
gulp.task('plugin-scripts', function() {
  return gulp.src(PATHS.plugins)
  .pipe(plugins.concat('plugins.js'))
  .pipe(gulp.dest('../dist/js'))
  .pipe(plugins.rename({ suffix: '.min' }))
  .pipe(plugins.uglify())
  .pipe(plugins.livereload(server));
  // .pipe(plugins.notify({ message: 'Local scripts task complete' }));
});

// Css
  gulp.task('css', function() {
    return gulp.src(PATHS.css)
    .pipe(gulp.dest('../dist/css'));
    // .pipe(plugins.notify({ message: 'Foundation task complete' }));
  });

// Images
gulp.task('images', function() {
  return gulp.src(PATHS.images)
  .pipe(plugins.cache(plugins.imagemin({ progressive: true })))
  .pipe(plugins.livereload(server))
  .pipe(gulp.dest('../dist/images'));
  // .pipe(plugins.notify({ message: 'Images task complete' }));
});

// Watch
gulp.task('watch', function() {

  // Spin up a server and watch the files
  server.listen(PORT, function (err) {
    if (err) {
      return console.log(err)
    };
    gulp.watch(PATHS.sass, ['sass']);
    gulp.watch([PATHS.localjs], ['local-scripts']);
    gulp.watch(PATHS.images, ['images']);
  });

});

// Default task
gulp.task('default', [
    'sass',
    'plugin-scripts',
    'local-scripts',
    'css',
    'images',
    'watch'
  ]
);