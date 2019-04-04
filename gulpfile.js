var project_location  = 'www';

require('es6-promise').polyfill();

var gulp          = require('gulp'),
    sass          = require('gulp-sass'),
    less          = require('gulp-less'),
    cleanCSS      = require('gulp-clean-css'),
    clean         = require('gulp-clean'),
    rtlcss        = require('gulp-rtlcss'),
    autoprefixer  = require('gulp-autoprefixer'),
    plumber       = require('gulp-plumber'),
    gutil         = require('gulp-util'),
    rename        = require('gulp-rename'),
    concat        = require('gulp-concat'),
    uglify        = require('gulp-uglify'),
    svgSprite     = require('gulp-svg-sprite'),
    imagemin      = require('gulp-imagemin'),
    browserSync   = require('browser-sync').create(),
    zip           = require('gulp-zip'),
    header        = require('gulp-header'),
    del           = require('del');

var svgConfig = {
  mode: {
    symbol: {
      inline: true,
      prefix: ".svg %s-svg",
    }
  },
  shape: {
    id: {
      generator: function(name, file) {
        var svg_id = 'svg-' + name;
        return svg_id.replace(/\.[^/.]+$/, "");
      }
    }
  }
};

var onError = function( err ) {
  console.log('An error occurred:', gutil.colors.magenta(err.message));
  gutil.beep();
  // this.emit('end');
};

// Grab the package.json file for the version
var getPackageJson = function () {
  var fs = require('fs');

  return JSON.parse(fs.readFileSync( 'package.json', 'utf8'));
};
//
gulp.task('css', function() {
  gulp.src([
          './' + project_location + '/assets/css/*.css',
          './node_modules/material-components-web/dist/material-components-web.min.css',
      ])
      .pipe(cleanCSS())
      .pipe(gulp.dest('./' + project_location + '/dist/css/'));
});
// Sass
gulp.task('sass', function() {
  return gulp.src('./' + project_location + '/assets/sass/**/style.scss')
  .pipe(plumber({ errorHandler: onError }))
  .pipe(sass())
  .pipe(autoprefixer())
  .pipe(gulp.dest('./' + project_location + '/dist/css/'))
  .pipe(rtlcss())                     // Convert to RTL
  .pipe(rename({ basename: 'rtl' }))  // Rename to rtl.css
  .pipe(gulp.dest('./' + project_location + '/dist/css/'));             // Output RTL stylesheets (rtl.css)
});

// Less
gulp.task('less', function(){
    return gulp.src('./' + project_location + '/assets/less/**/style.less')
        .pipe(less())
        .pipe(autoprefixer())
        .pipe(gulp.dest('./' + project_location + '/dist/css/'))
        .pipe(rtlcss())                     // Convert to RTL
        .pipe(rename({ basename: 'rtl' }))  // Rename to rtl.css
        .pipe(gulp.dest('./' + project_location + '/dist/css/'));  
});
//Javascript
gulp.task('js', function() {
  return gulp.src([
  './node_modules/jquery/dist/jquery.min.js',
  './node_modules/material-components-web/dist/material-components-web.min.js',
  './node_modules/responsive-tabs/js/jquery.responsiveTabs.min.js',
  './' + project_location + '/assets/js/*.js'
  ])
  .pipe(concat('app.js'))
  .pipe(rename({suffix: '.min'}))
  .pipe(uglify())
  .pipe(gulp.dest('./' + project_location + '/dist/js'));
});

//Sigma
gulp.task('sigma', function() {
  return gulp.src([
    './' + project_location + '/assets/js/sigma/sigma.min.js',
    './' + project_location + '/assets/js/sigma/sigma.parsers.json.min.js',
    './' + project_location + '/assets/js/sigma/sigma.layout.forceAtlas2.min.js',
  ])
  .pipe(concat('sigma.js'))
  .pipe(rename({suffix: '.min'}))
  // .pipe(uglify())
  .pipe(gulp.dest('./' + project_location + '/dist/js'));
});

// Images
gulp.task('images', function() {
  return gulp.src('./' + project_location + '/assets/images/*')
  .pipe(plumber({ errorHandler: onError }))
  .pipe(imagemin({ optimizationLevel: 7, progressive: true }))
  .pipe(gulp.dest('./' + project_location + '/dist/images'));
});

gulp.task('fonts', function() {
  return gulp.src('./' + project_location + '/assets/fonts/*')
  .pipe(gulp.dest('./' + project_location + '/dist/fonts'));
});

gulp.task('svg', function() {

  gulp.src('./' + project_location + '/assets/svg/*.svg')
  .pipe(svgSprite(svgConfig))
  .pipe(gulp.dest('./' + project_location + '/assets'));

});

// Watch
gulp.task('watch', function() {
  //   browserSync.init({
  //     proxy: {
  //       target: '192.168.99.100',
  //       ws: true,
  //       proxyReq: [
  //         function(proxyReq) {
  //           proxyReq.setHeader('Access-Control-Allow-Origin', '*');
  //         }
  //       ]
  //     }
  // });
  gulp.watch('./' + project_location + '/assets/sass/**/*.scss', ['sass']);
  gulp.watch('./' + project_location + '/assets/less/**/*.less', ['less']);
  gulp.watch('./' + project_location + '/assets/js/*.js', ['js']);
  gulp.watch('./' + project_location + '/assets/images/src/*', ['images']);
  gulp.watch('./' + project_location + '/assets/fonts/*', ['fonts']);
  gulp.watch('./' + project_location + '/assets/svg/*', ['svg']);
});


gulp.task('build', ['svg', 'sass', 'less', 'images', 'fonts', 'js','css']);
gulp.task('default', ['build', 'watch']);