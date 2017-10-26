module.exports = function (grunt) {
    'use strict';
    // load all grunt tasks
    require('time-grunt')(grunt);
    require('load-grunt-tasks')(grunt);
    //
    grunt.initConfig({
        watch: {
            options: {
                atBegin: true
            },
            sass: {
                files: ['scss/*.scss'],
                tasks: ['css']
            },
            js: {
                files: ['js/*.js', "Gruntfile.js"],
                tasks: 'js'
            }
        },
        clean: {
            dist: 'public/dist/'
        },
        sass: {
            options: {
                style: 'expanded',
                sourceMap: true
            },
            style: {
                files: {
                    'public/dist/css/style.css': 'scss/style.scss'
                }
            }
        },
        postcss: {
            options: {
                map: true,
                processors: [
                    require('autoprefixer')({
                        browsers: '> 0.5%'
                    })
                ]
            },
            dist: {
                src: 'public/dist/css/*.css'
            }
        },
        cssmin: {
            options: {
                shorthandCompacting: false,
                roundingPrecision: -1,
                sourceMap: true
            },
            style: {
                files: {
                    'public/dist/css/style.min.css': 'public/dist/css/style.css'
                }
            }
        },
        jshint: {
            options: {
                extract: 'auto'
            },
            html: ["js/app.js", "Gruntfile.js"]
        },
        concat: {
            options: {
                sourceMap: true
            },
            libraries: {
                src: [
                    'node_modules/jquery/dist/jquery.min.js',
                    'node_modules/popper.js/dist/umd/popper.min.js',
                    'node_modules/bootstrap/dist/js/bootstrap.min.js',
                    'node_modules/bootstrap-3-typeahead/bootstrap3-typeahead.min.js',
                    'js/highlight.pack.js'
                ],
                dest: 'public/dist/js/libraries.min.js'
            }
        },
        uglify: {
            options: {
                sourceMap: true,
                mangle: {
                    reserved: ['_paq']
                }
            },
            admin: {
                files: {
                    'public/dist/js/app.min.js': 'js/app.js'
                }
            }
        },
        copy: {
            frontend_libs: {
                files: [{
                    expand: true,
                    cwd: 'node_modules/font-awesome/',
                    src: 'fonts/*',
                    dest: 'public/dist/fonts/font-awesome',
                    flatten: true
                }]
            }
        }
    })
    ;
    grunt.registerTask('default', 'dist');
    grunt.registerTask('dist', ['clean:dist', 'css', 'js', 'copy']);
    grunt.registerTask('css', ['sass', 'postcss', 'cssmin']);
    grunt.registerTask('js', ['jshint', 'concat', 'uglify']);
};
