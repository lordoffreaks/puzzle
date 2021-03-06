'use strict';

module.exports = function (grunt) {

  // Time how long tasks take. Can help when optimizing build times
  require('time-grunt')(grunt);

  // Automatically load required grunt tasks
  require('jit-grunt')(grunt, {
    useminPrepare: 'grunt-usemin'
  });

  var globule = require('globule');

  // Configurable paths
  var config = {
    app: 'source',
    local: 'build_local',
    dist: 'www'
  };

  var symlink_files = globule.find("*.blade.php", {
    filter: function(filepath, options) {
      return filepath !== options.srcBase + '/index.blade.php';
    },
    srcBase: config.app
  });

  config.symlink_files = symlink_files.map(function(filepath){
    var name = filepath.replace('.blade.php', '');
    return {
      expand: true,
      overwrite: false,
      cwd: '<%= config.dist %>',
      src: ['css', 'js'],
      dest: '<%= config.dist %>/' + name,
      filter: 'isDirectory'
    }
  });

  config.useminPrepareFiles = globule.find("*.blade.php", {
    srcBase: config.app
  })
      .map(function(filepath){
        return '<%= config.local %>/' + filepath.replace('blade.php', 'html');
      });

  // Define the configuration for all the tasks
  grunt.initConfig({

    // Project settings
    config: config,

    exec: {
      jigsaw_build: {
        cmd: './vendor/bin/puzzle build'
      },
      unlink_local: {
        cmd: '[ -d <%= config.local %>/bower_components ] && [ -L <%= config.local %>/bower_components ] && unlink <%= config.local %>/bower_components || true'
      },
      symlink_local: {
        cmd: 'ln -s `pwd`/bower_components <%= config.local %>/bower_components'
      }
    },

    symlink: {
      expanded: {
        files: config.symlink_files
      }
    },

    // Watches files for changes and runs tasks based on the changed files
    watch: {
      bower: {
        files: ['bower.json'],
        tasks: ['wiredep']
      },
      gruntfile: {
        files: ['Gruntfile.js']
      },
      sass: {
        files: ['<%= config.app %>/_assets/sass/{,*/}*.{scss,sass}'],
        tasks: ['sass', 'postcss']
      },
      blade: {
        files: [
          '<%= config.app %>/{,*/}*.blade.php',
          '<%= config.app %>/_layouts/{,*/}*.blade.php'
        ],
        tasks: [
          'exec:jigsaw_build',
          'exec:symlink_local',
          'sass',
          'postcss'
        ]
      },
      styles: {
        files: ['<%= config.local %>/styles/{,*/}*.css'],
        tasks: ['newer:copy:styles', 'postcss']
      },
      js: {
        files: ['<%= config.app %>/js/{,*!/}*.js'],
        tasks: ['newer:copy:js']
      }
    },

    browserSync: {
      options: {
        watchTask: true
      },
      livereload: {
        options: {
          open: true,
          proxy: "www2.puzzle-demo.com",
          files: [
            '<%= config.local %>/{,*/}*.html',
            '<%= config.local %>/css/*.css',
            '<%= config.local %>/css/{,*/}*.css',
            '<%= config.local %>/js/{,*/}*.js',
            '<%= config.app %>/js/{,*/}*.js',
            '<%= config.app %>/images/{,*/}*'
          ]
        }
      },
      dist: {
        options: {
          open: true,
          proxy: "www2.puzzle-demo-dist.com"
        }
      }
    },

    // Empties folders to start fresh
    clean: {
      dist: {
        files: [{
          dot: true,
          src: [
            '<%= config.local%>/*',
            '<%= config.dist %>/*',
            '.tmp',
            '!<%= config.dist %>/.git*'
          ]
        }]
      },
      server: [
        '.tmp',
        '<%= config.local%>/css/*',
        '<%= config.local%>/images/*',
        '<%= config.local%>/js/*'
      ]
    },

    // Compiles Sass to CSS and generates necessary files if requested
    sass: {
      options: {
        sourceMap: true,
        sourceMapEmbed: true,
        sourceMapContents: true,
        includePaths: ['.']
      },
      dist: {
        files: [{
          expand: true,
          cwd: '<%= config.app %>/_assets/sass',
          src: ['*.{scss,sass}'],
          dest: '<%= config.local %>/css',
          ext: '.css'
        }]
      }
    },

    postcss: {
      options: {
        map: true,
        processors: [
          // Add vendor prefixed styles
          require('autoprefixer')({
            browsers: ['> 1%', 'last 2 versions', 'Firefox ESR']
          })
        ]
      },
      dist: {
        files: [{
          expand: true,
          cwd: '<%= config.local%>/css/',
          src: '{,*/}*.css',
          dest: '<%= config.local%>/css/'
        }]
      }
    },

    // Automatically inject Bower components into the HTML file
    wiredep: {
      app: {
        // src: ['<%= config.app %>/*.html'],
        src: ['<%= config.app %>/{,*/}*.blade.php'],
        exclude: ['bootstrap.js'],
        ignorePath: /^(\.\.\/)*\.\./
      },
      sass: {
        src: ['<%= config.app %>/_assets/sass/{,*/}*.{scss,sass}'],
        ignorePath: /^(\.\.\/)+/
      }
    },

    // Renames files for browser caching purposes
    filerev: {
      dist: {
        src: [
          '<%= config.dist %>/js/{,*/}*.js',
          '<%= config.dist %>/css/{,*/}*.css',
          '<%= config.dist %>/images/{,*/}*.*',
          '<%= config.dist %>/css/fonts/{,*/}*.*',
          '<%= config.dist %>/*.{ico,png}'
        ]
      }
    },

    // Reads HTML for usemin blocks to enable smart builds that automatically
    // concat, minify and revision files. Creates configurations in memory so
    // additional tasks can operate on them
    useminPrepare: {
      options: {
        dest: '<%= config.dist %>'
      },
      pages: {
        src: config.useminPrepareFiles
      }
    },

    // Performs rewrites based on rev and the useminPrepare configuration
    usemin: {
      options: {
        assetsDirs: [
          '<%= config.dist %>',
          '<%= config.dist %>/images',
          '<%= config.dist %>/css'
        ]
      },
      html: ['<%= config.dist %>/{,*/}*.html'],
      css: ['<%= config.dist %>/css/{,*/}*.css']
    },

    // The following *-min tasks produce minified files in the dist folder
    imagemin: {
      dist: {
        files: [{
          expand: true,
          cwd: '<%= config.local %>/images',
          src: '{,*/}*.{gif,jpeg,jpg,png}',
          dest: '<%= config.dist %>/images'
        }]
      }
    },

    svgmin: {
      dist: {
        files: [{
          expand: true,
          cwd: '<%= config.local %>/images',
          src: '{,*/}*.svg',
          dest: '<%= config.dist %>/images'
        }]
      }
    },

    htmlmin: {
      dist: {
        options: {
          collapseBooleanAttributes: true,
          collapseWhitespace: true,
          conservativeCollapse: true,
          removeAttributeQuotes: true,
          removeCommentsFromCDATA: true,
          removeEmptyAttributes: true,
          removeOptionalTags: true,
          // true would impact styles with attribute selectors
          removeRedundantAttributes: false,
          useShortDoctype: true
        },
        files: [{
          expand: true,
          cwd: '<%= config.dist %>',
          src: '{,*/}*.html',
          dest: '<%= config.dist %>'
        }]
      }
    },

    // By default, your `index.html`'s <!-- Usemin block --> will take care
    // of minification. These next options are pre-configured if you do not
    // wish to use the Usemin blocks.
    // cssmin: {
    //  dist: {
    //    files: {
    //      '<%= config.dist %>/css/main.css': [
    //        '.tmp/css/{,*!/}*.css',
    //        '<%= config.local %>/css/{,*!/}*.css'
    //      ]
    //    }
    //  }
    // },
    // uglify: {
    //  dist: {
    //    files: {
    //      '<%= config.dist %>/js/main.js': [
    //        '<%= config.local %>/js/!*.js'
    //      ],
    //      '<%= config.dist %>/js/vendors.js': [
    //        '<%= config.local %>/js/bower_components/{,*!/}*.js'
    //      ]
    //    }
    //  }
    // },
    // concat: {
    //   dist: {}
    // },

    // Copies remaining files to places other tasks can use
    copy: {
      dist: {
        files: [{
          expand: true,
          dot: true,
          cwd: '<%= config.local %>',
          dest: '<%= config.dist %>',
          src: [
            '*.{ico,png,txt}',
            '*.{php,phpc}',
            '*.{json}',
            'images/{,*/}*',
            'videos/{,*/}*',
            '{,*/}*.html',
            '{,*/}*.pdf',
            '{,*/}*.htaccess',
            'index.php',
            'css/*.css',
            'css/{,*/}*.css',
            'css/fonts/{,*/}*.*',
            '*.xml'
          ]
        }, {
          expand: true,
          dot: true,
          cwd: '.',
          src: 'bower_components/bootstrap-sass/assets/fonts/bootstrap/*',
          dest: '<%= config.dist %>'
        }]
      },
      bower: {
        files: [{
          expand: true,
          dot: true,
          cwd: '.',
          src: 'bower_components/**/*.*',
          dest: '<%= config.local %>'
        }]
      },
      server: {
        files: [{
          expand: true,
          dot: true,
          cwd: '<%= config.app %>',
          dest: '<%= config.local%>',
          src: [
            '{,*/}*.htaccess',
            'index.php'
          ]
        },{
          expand: true,
          dot: true,
          cwd: '<%= config.app %>/_assets',
          dest: '<%= config.local %>',
          src: [
            'images/**/*'
          ]
        }]
      },
      js: {
        files: [{
          expand: true,
          dot: true,
          cwd: '<%= config.app %>',
          dest: '<%= config.local %>',
          src: [
            'js/*.js',
            'js/{,*/}*.js'
          ]
        }]
      },
      static: {
        files: [{
          expand: true,
          dot: true,
          cwd: '.',
          dest: '<%= config.dist %>',
          src: [
            'google*.html',
            'robots.txt'
          ]
        }]
      }
    },

    // Generates a custom Modernizr build that includes only the tests you
    // reference in your app
    modernizr: {
      dist: {
        devFile: 'bower_components/modernizr/modernizr.js',
        outputFile: '<%= config.dist %>/scripts/vendor/modernizr.js',
        files: {
          src: [
            '<%= config.dist %>/js/{,*/}*.js',
            '<%= config.dist %>/css/{,*/}*.css',
            '!<%= config.dist %>/js/vendor/*'
          ]
        },
        uglify: true
      }
    },

    // Run some tasks in parallel to speed up build process
    concurrent: {
      server: [
        'sass'
      ],
      dist: [
        'sass',
        'imagemin',
        'svgmin'
      ]
    }
  });

  grunt.registerTask('serve', 'start the server and preview your app', function (target) {

    if (target === 'dist') {
      return grunt.task.run(['build', 'browserSync:dist']);
    }

    grunt.task.run([
      'exec:unlink_local',
      'clean:server',
      'wiredep',
      'exec:jigsaw_build',
      'copy:server',
      'exec:symlink_local',
      'concurrent:server',
      'postcss',
      'browserSync:livereload',
      'watch'
    ]);
  });

  grunt.registerTask('server', function (target) {
    grunt.log.warn('The `server` task has been deprecated. Use `grunt serve` to start a server.');
    grunt.task.run([target ? ('serve:' + target) : 'serve']);
  });

  grunt.registerTask('build', [
    'clean:dist',
    'wiredep',
    'exec:jigsaw_build',
    'concurrent:dist',
    'copy:server',
    'copy:bower',
    'copy:dist',
    'copy:static',
    'useminPrepare',
    'postcss',
    'concat',
    'uglify',
    'cssmin',
    'modernizr',
    'filerev',
    'usemin',
    'htmlmin',
    'symlink'
  ]);

  grunt.registerTask('default', [
    'build'
  ]);
};
