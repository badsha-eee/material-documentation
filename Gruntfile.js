module.exports = function (grunt) {
    // load all grunt tasks matching the ['grunt-*', '@*/grunt-*'] patterns
    require('load-grunt-tasks')(grunt);

    grunt.initConfig({
      less:{
        //compile all less files to css
        'style.css': 'style/*.less'
      },

      wiredep: {
            app: {
              src: ['index.html']
            }
      },

      watch: {
          options: {
            livereload: true,
          },
          less: {
            files: ['style/*.less'],
            tasks: ['less', /*'autoprefixer'*/],
          },
      },

      express: {
        server: {
          options: {
            port: 9000,
            bases: ['.'],
            livereload: true,
          }
        }
      }
    });
    grunt.registerTask('default', ['express', 'watch', 'less']);
}