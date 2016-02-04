var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');

gulp.task('sass', function () {
    gulp.src('./src/FrontBundle/Resources/Public/sass/master.scss')
        .pipe(sass({sourceComments: 'map'}))
        .pipe(gulp.dest('./web/css/'));
});

gulp.task('js', function() {
    gulp.src([
            './src/FrontBundle/Resources/Public/js/**/*.js',
            './web/components/bootstrap-sass/assets/javascripts/bootstrap/*.js',
            './web/components/jquery/dist/jquery.js',
        ])
        .pipe(concat('scripts.js'))
        .pipe(gulp.dest('./web/js'));
});

gulp.task('watch', function () {
    var onChange = function (event) {
        console.log('File '+event.path+' has been '+event.type);
    };
    gulp.watch('./src/FrontBundle/Resources/Public/sass/**/*.scss', ['sass'])
        .on('change', onChange);
    gulp.watch('./src/FrontBundle/Resources/Public/js/**/*.js', ['js'])
        .on('change', onChange);
});

gulp.task('default', function () {});
