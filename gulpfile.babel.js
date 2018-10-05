/**
 * Copyright 2018 ídeo SRL (@ideonetwork)
 * Released under the MIT license (http://mit-license.org)
 */

import gulp from 'gulp'
import gulpLoadPlugins from 'gulp-load-plugins'
import browserSync from 'browser-sync'
import notifier from 'node-notifier'
import runSequence from 'run-sequence'
import watchify from 'watchify'
import browserify from 'browserify'
import babelify from 'babelify'
import source from 'vinyl-source-stream'
import buffer from 'vinyl-buffer'
import assign from 'lodash.assign'
import {
  argv
} from 'yargs'

// Gulpfile settings.
// Update settings here.
// ***********************************************************
const nameTheme = 'wideo'
const distPath = `../${nameTheme}`
const proxy = 'http://localhost:8888'

// ***********************************************************

const $ = gulpLoadPlugins()
const customBrowserifyOpts = {
  entries: ['./src/js/main.js'],
  debug: argv.pretty,
  cache: {},
  packageCache: {},
  transform: [
    babelify.configure({
      presets: ['es2015'],
    }),
  ],
}
const babelifyOpts = assign({}, watchify.args, customBrowserifyOpts)
const babelifyObj = watchify(browserify(babelifyOpts))
babelifyObj.transform(babelify)

function styles() {
  return gulp.src('./src/css/**/*.scss')
    .pipe($.plumber())
    .pipe($.if(argv.pretty, $.sourcemaps.init()))
    .pipe(
      $.sass({
        precision: 10,
        includePaths: ['./src/css/**/*.scss'],
      }).on('error', $.sass.logError),
    )
    .pipe($.autoprefixer(['last 3 versions', 'ie >= 9', 'and_chr >= 2.3']))
    .pipe($.if(!argv.pretty, $.cssnano()))
    .pipe($.size({
      title: 'Styles'
    }))
    .pipe($.if(argv.pretty, $.sourcemaps.write('./')))
    .pipe(gulp.dest(`${distPath}/css`))
}

function scripts() {
  return babelifyObj.bundle()
    .on('error', (err) => {
      console.log(err.stack)
      notifier.notify({
        title: 'Errore di compilazione',
        message: err.message,
      })
    })
    .pipe(source('main.js'))
    .pipe(buffer())
    .pipe($.if(argv.pretty, $.sourcemaps.init({
      loadMaps: true
    })))
    .pipe($.if(!argv.pretty, $.uglify({
      preserveComments: 'some',
    })))
    .pipe($.if(argv.pretty, $.sourcemaps.write('./')))
    .pipe(gulp.dest(`${distPath}/js`))
    .pipe(browserSync.reload({
      stream: true
    }))
}

function img() {
  return gulp.src('./src/img/**/*')
    .pipe($.plumber())
    .pipe($.newer(`${distPath}/img`))
    .pipe($.imagemin({
      progressive: true,
      interlaced: true,
      multipass: true,
      svgoPlugins: [{
        removeViewBox: false,
        removeUselessStrokeAndFill: false,
        removeEmptyAttrs: true,
      }],
    }))
    .pipe($.size({
      title: 'img'
    }))
    .pipe(gulp.dest(`${distPath}/img`))
}

function copyTheme() {
  return gulp.src('./src/theme/**/*')
    .pipe(gulp.dest(`${distPath}/`))
}

function copyFonts() {
  return gulp.src('./src/fonts/**/*')
    .pipe(gulp.dest(`${distPath}/fonts`))
}

// Initialize tasks
gulp.task('help', $.taskListing)

gulp.task('styles', styles)
gulp.task('scripts', scripts)
gulp.task('img', img)
gulp.task('copyTheme', copyTheme)
gulp.task('copyFonts', copyFonts)

gulp.task('dev', () => {
  const startTime = Date.now()
  runSequence(['styles', 'scripts', 'img', 'copyTheme', 'copyFonts'], () => {
    console.log('\x1b[42m************************************\x1b[0m\n')
    console.log('\x1b[32m  Project ready for coding 😎\x1b[0m\n')
    console.log('\x1b[42m************************************\x1b[0m\n')
    console.log('[\x1b[32m\x1b[0m]', `All finished in \x1b[35m${Date.now() - startTime} ms`, '\x1b[0m\n')
    browserSync.init({
      proxy,
      notify: false,
      open: true,
    })

    if (argv.server) {
      gulp.watch(['./src/theme/**/*'], ['copyTheme', browserSync.reload])
    } else {
      gulp.watch(['./src/css/**/*.scss'], ['styles', browserSync.reload])
      gulp.watch(['./src/js/**/*.js'], ['scripts', browserSync.reload])
      gulp.watch(['./src/img/**/*'], ['img', browserSync.reload])
      gulp.watch(['./src/theme/**/*'], ['copyTheme', browserSync.reload])
      gulp.watch(['./src/fonts/**/*'], ['copyFonts', browserSync.reload])
    }
  })
})

gulp.task('build', () => {
  runSequence(['styles', 'scripts', 'img', 'copyTheme', 'copyFonts'])
})

gulp.task('default', () => {
  runSequence('dev', () => {})
})
