'use strict';
module.exports = function(grunt) {

  grunt.initConfig({
    jshint: {
      options: {
        jshintrc: '.jshintrc'
      },
      all: [
        'library/js/scripts.js',
        'vendor/bootstrap/js/*.js'
      ]
    },
    less: {
      dist: {
        files: {
          'library/dist/css/jutzu.css': [
              'vendor/animate.css/animate.css',
              'library/less/styles.less'
          ]
        },
        options: {
          compress: true,
          sourceMap: true,
          sourceMapFilename: 'library/dist/css/jutzu.css.map',
          sourceMapRootpath: '/wp-content/themes/sigami_base/' // If you name your theme something different you may need to change this
        }
      }
    },
    uglify: {
      dist: {
        files: {
          'library/dist/js/jutzu.min.js': [
            'vendor/bootstrap/dist/js/bootstrap.js',
            'vendor/wow/dist/wow.js',
            'library/js/*.js'
          ]
        },
        options: {
          sourceMap: 'library/dist/js/jutzu.min.js.map'
        }
      }
    },
    watch: {
      less: {
        files: [
          'vendor/bootstrap/less/*.less',
          'vendor/font-awesome/less/*.less',
          'library/less/*.less'
        ],
        tasks: ['less']
      },
      js: {
        files: [
          '<%= jshint.all %>'
        ],
        tasks: ['uglify']
      },
      livereload: {
        // Browser live reloading
        // https://github.com/gruntjs/grunt-contrib-watch#live-reloading
        options: {
          livereload: true
        },
        files: [
          'library/dist/css/jutzu.css',
          'library/js/*',
          'style.css',
          '*.php'
        ]
      }
    },
    clean: {
      dist: [
        'library/dist/css',
        'library/dist/js'
      ]
    }
  });

  // Load tasks
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-less');

  // Register tasks
  grunt.registerTask('default', [
    'clean',
    'less',
    'uglify',
  ]);

  grunt.registerTask('build', [
    'clean:dist',
    'less',
    'uglify',
  ]);

  grunt.registerTask('dev', [
    'watch'
  ]);

};
