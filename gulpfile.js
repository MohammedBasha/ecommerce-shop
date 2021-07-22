var gulp         = require('gulp'),
    sass         = require('gulp-sass')(require('sass')),
    plumber      = require('gulp-plumber'),
    notify       = require('gulp-notify'),
    autoprefixer = require('gulp-autoprefixer'),
    cleanCSS     = require('gulp-clean-css'),
    rename       = require('gulp-rename'),
    livereload   = require('gulp-livereload');

var config = {
    srcAdmin: './admin/layout/css/admin.sass',
    destAdmin: './admin/layout/css/',
    srcFront: './layout/css/styles.sass',
    destFront: './layout/css/'
};

// Error message
var onError = function (err) {
    notify.onError({
        title   : 'Gulp',
        subtitle: 'Failure!',
        message : 'Error: <%= error.message %>',
        sound   : 'Beep'
    })(err);

    this.emit('end');
};

// Task: `styles-admin`.
gulp.task('styles-admin', function () {
    var stream = gulp
        .src(config.srcAdmin)
        .pipe(plumber({errorHandler: onError}))

        // output non-minified CSS file
        .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
        .pipe(autoprefixer())
        .pipe(gulp.dest(config.destAdmin))
        
        // output the minified version
        .pipe(cleanCSS({
            compatibility: 'ie7'
        }))
        .pipe(rename({ extname: '.min.css' }))
        .pipe(gulp.dest(config.destAdmin))
        .pipe(livereload());

    return stream
        .pipe( notify( { message: 'TASK: "styles" Completed! 💯', onLast: true } ) );
});

// Task: `styles-front`.
gulp.task('styles-front', function () {
    var stream = gulp
        .src(config.srcFront)
        .pipe(plumber({errorHandler: onError}))

        // output non-minified CSS file
        .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
        .pipe(autoprefixer())
        .pipe(gulp.dest(config.destFront))

        // output the minified version
        .pipe(cleanCSS({
            compatibility: 'ie7'
        }))
        .pipe(rename({ extname: '.min.css' }))
        .pipe(gulp.dest(config.destFront))
        .pipe(livereload());

    return stream
        .pipe( notify( { message: 'TASK: "styles" Completed! 💯', onLast: true } ) );
});

// Task: `watch`
gulp.task('watch', function() {
    livereload.listen();

    gulp.watch('./**/**/*.php').on('change', function(file) {
        livereload.reload(file);
    });

    gulp.watch('./**/**/*.js').on('change', function(file) {
        livereload.reload(file);
    });

    gulp.watch(config.srcAdmin, gulp.series('styles-admin'));
    gulp.watch(config.srcFront, gulp.series('styles-front'));
});

// Task: `default`
gulp.task('default', gulp.series('styles-admin', 'styles-front', 'watch'));