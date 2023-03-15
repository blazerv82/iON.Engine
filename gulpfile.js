const projectName = "iON.Engine";

const gulp = require('gulp');
const browserSync = require('browser-sync').create();

// Watch all src files, compile and live reload
function dev() {
    browserSync.init({
        browser: "firefox",
        proxy: `https://localhost:443/root/projects/${projectName}/src/root/`
    });
    
    // ** is for all files recursivly
    gulp.watch('./src/**/*.html').on('change',browserSync.reload);
    gulp.watch('./src/**/*.css').on('change',browserSync.reload);
    gulp.watch('./src/**/*.php').on('change',browserSync.reload);
    gulp.watch('./src/**/*.js').on('change', browserSync.reload);
}

exports.dev = dev;