var gulp = require('gulp');
var server = require('gulp-server-livereload');

gulp.task('serve', function() {
    gulp.src('web')
        .pipe(server({
            livereload: true,
            defaultFile: 'index.html',
            open: true,
            path: 'web'
        }));
});
