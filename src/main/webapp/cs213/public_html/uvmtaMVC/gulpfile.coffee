gulp         = require 'gulp'
gutil        = require 'gulp-util'
changed      = require 'gulp-changed'
accord       = require 'gulp-accord'
autoprefixer = require 'gulp-autoprefixer'
axis         = require 'axis-css'
rupture      = require 'rupture'
nib          = require 'nib'
jeet         = require 'jeet'
axis         = require 'axis'
jshint       = require 'gulp-jshint'
concat       = require 'gulp-concat'
imagemin     = require 'gulp-imagemin'
notify       = require 'gulp-notify'
plumber      = require 'gulp-plumber'
stripDebug   = require 'gulp-strip-debug'
uglify       = require 'gulp-uglify'
livereload   = require 'gulp-livereload'
jade         = require 'gulp-jade'
rename       = require 'gulp-rename'
sftp         = require 'gulp-sftp'
changed      = require 'gulp-changed'
stylus       = (opts) -> accord 'stylus', opts

src = 
   html:    '../uvmta/*.html'
   jade:    'src/jade/*.jade'
   js:      'src/scripts/*.js'
   stylus:  'src/stylus/*.styl'
   coffee:  'src/coffee/*.coffee'
   img:     'src/images/*'
   vendor:  'src/vendor/*' 


dest = 
   html:    "../uvmta/"
   css:     "css/"
   js:      "js/"
   img:     "img/"
   php:     "../uvmta/"

onError = (err) -> console.log err;


gulp.task 'jade', (event) -> 
   gulp.src src.jade
   .pipe jade
      pretty: true
   .pipe gulp.dest dest.html


gulp.task 'images', ->
   gulp.src src.img
   .pipe changed dest.img
   .pipe imagemin 
   .pipe gulp.dest dest.img
   .pipe notify
      message: 'Images task complete'
 

gulp.task 'jshint', ->
   gulp.src src.js
   .pipe jshint()
   .pipe jshint.reporter 'default'
   .pipe notify
      message: 'JS Hinting task complete'


gulp.task 'scripts', ->
   gulp.src [src.js, src.vendor]
   .pipe changed dest.js
   .pipe concat 'app.min.js'
   #.pipe uglify()
   .pipe gulp.dest dest.js

gulp.task 'styles', ->
   gulp.src src.stylus
   .pipe changed dest.css,
      extension: '.css'
   .pipe stylus
      use: [
         nib()
         jeet()
         rupture()
         axis()
      ]
      import:['src/stylus/imports/*']
   .pipe rename
      extname: '.css'
   .pipe autoprefixer()
   .pipe gulp.dest dest.css
   .pipe sftp
      host: '157.201.194.222',
      user: 'jolleyboy',
      key: '~/.ssh/id_rsa'
      port: '215',
      remotePath: '/home/ercanbracks/public_html/uvmtaMVC/css/'
#   .pipe livereload()
#   .pipe notify
#      message: 'Styles task complete'

gulp.task 'watch', ->
   gulp.watch src.stylus, ['styles'] 
   gulp.watch src.js, ['scripts', 'jshint']
   gulp.watch src.img, ['images']
   gulp.watch src.jade, ['jade']
gulp.task 'default', ['jade', 'styles', 'watch']
