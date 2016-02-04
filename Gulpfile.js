var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var del = require('delete')

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
            './web/components/jquery/dist/jquery.min.js',
            './web/components/bootstrap-sass/assets/javascripts/bootstrap/*.js',
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

gulp.task('watch', function () {
    var onChange = function (event) {
        console.log('File '+event.path+' has been '+event.type);
    };
    gulp.watch('./src/FrontBundle/Resources/Public/sass/**/*.scss', ['clean_css', 'sass'])
        .on('change', onChange);
    gulp.watch('./src/FrontBundle/Resources/Public/js/**/*.js', ['clean_js', 'js'])
        .on('change', onChange);
});

gulp.task('default', function () {});
