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
            'library/less/styles.less'
          ]
        },
        options: {
          compress: true,
          // LESS source map
          // To enable, set sourceMap to true and update sourceMapRootpath based on your install
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
            'library/js/*.js'
          ]
          // Consider adding bootstrap js files here to consolidate your browser requests
        },
        options: {
          // JS source map: to enable, uncomment the lines below and update sourceMappingURL based on your install
          sourceMap: 'library/dist/js/jutzu.min.js.map',
          // sourceMappingURL: '/app/themes/roots/assets/js/scripts.min.js.map'
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
