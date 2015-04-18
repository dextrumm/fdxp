module.exports = function (grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        bowercopy: {
            options: {
                srcPrefix: 'bower_components'
            },
            scripts: {
                options: {
                  destPrefix: 'web/js'
                },
                files: {
                    'jquery.js': 'jquery/dist/jquery.js',
                    'bootstrap.js': 'bootstrap/dist/js/bootstrap.js',
                    'boostrap-fileinput.js': 'bootstrap-fileinput/js/fileinput.js'
                }
            },
            stylesheets: {
                options: {
                  destPrefix: 'web/css'
                },
                files: {
                    'bootstrap.css': 'bootstrap/dist/css/bootstrap.css',
                    'bootstrap-fileinput.css': 'bootstrap-fileinput/css/fileinput.css'

                }
            }
        },
        concat: {
            options: {
                stripBanners: true
            },
            css: {
                src: [
                    'web/css/bootstrap.css',
                    'web/css/bootstrap-fileinput.css',
                    'src/AppBundle/Resources/public/css/*.css'
                ],
                dest: 'web/css/bundled.css'
            },
            js : {
                src : [
                    'web/js/jquery.js',
                    'web/js/bootstrap.js',
                    'web/js/boostrap-fileinput.js'
                ],
                dest: 'web/js/bundled.js'
            }
        },
        cssmin : {
            bundled:{
                src: 'web/css/bundled.css',
                dest: 'web/css/bundled.min.css'
            }
        },
        uglify : {
            js: {
                files: {
                    'web/js/bundled.min.js': ['web/js/bundled.js']
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-bowercopy');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-uglify');

    grunt.registerTask('default', ['bowercopy', 'concat', 'cssmin', 'uglify']);
};