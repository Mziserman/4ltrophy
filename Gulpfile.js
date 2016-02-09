var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var del = require('delete');
var imagemin = require('gulp-imagemin');

gulp.task('sass', function () {
    gulp.src('./src/FrontBundle/Resources/Public/sass/master.scss')
        .pipe(sass({sourceComments: 'map'}))
        .pipe(gulp.dest('./web/css/'));
});

gulp.task('js', function() {
    del(['/web/js/*'], function(err) {
        if (err) throw err;
        console.log('done!');
    });

    gulp.src([
            './src/FrontBundle/Resources/Public/js/**/*.js',
        ])
        .pipe(concat('scripts.js'))
        .pipe(gulp.dest('./web/js'));
});

gulp.task('clean_css', function() {
    del(['/web/css/*'], function(err) {
        if (err) throw err;
        console.log('done!');
    });
});

gulp.task('clean_js', function() {
    del(['/web/js/*'], function(err) {
        if (err) throw err;
        console.log('done!');
    });
});

gulp.task('img', function() {
    return gulp.src('./src/FrontBundle/Resources/Public/images/*')
        .pipe(imagemin({ progressive: true }))
        .pipe(gulp.dest('./web/img'));
});

gulp.task('vendors', function() {
    return gulp.src('./src/FrontBundle/Resources/Public/vendors/**')
        .pipe(gulp.dest('./web/vendors'));
});

gulp.task('watch', function () {
    var onChange = function (event) {
        console.log('File '+event.path+' has been '+event.type);
    };
    gulp.watch('./src/FrontBundle/Resources/Public/sass/**/*.scss', ['clean_css', 'sass'])
        .on('change', onChange);
    gulp.watch('./src/FrontBundle/Resources/Public/js/**/*.js', ['clean_js', 'js'])
        .on('change', onChange);
});

gulp.task('video', function() {
    return gulp.src("./src/FrontBundle/Resources/Public/videos/**")
        .pipe(gulp.dest('./web/videos'));
});

gulp.task('default', ['js', 'sass', 'img', 'vendors']);
