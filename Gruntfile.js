module.exports = function (grunt) {

    grunt.initConfig({
        clean: [
            'public/css',
            'public/js',
            'public/view'
        ],
        concat: {
            options: {
                separator: '\r\n'
            },
            dist: {
                src: [
                    'resources/assets/vendor/**/*.js',
                    'resources/assets/app/app.module.js',
                    'resources/assets/app/**/*.js'
                ],
                dest: 'public/js/scripts.js'
            }
        },
        uglify: {
            app: {
                files: {
                    'public/js/scripts.js': ['public/js/scripts.js']
                }
            }
        },
        concat_css: {
            all: {
                src: [
                    "resources/assets/vendor/**/*.css",
                    "resources/assets/css/**/*.css"
                ],
                dest: "public/css/style.css"
            }
        },
        cssmin: {
            target: {
                files: {
                    'public/css/style.css': ['public/css/style.css']
                }
            }
        },
        copy: {
            main: {
                files: [
                    {
                        expand: true,
                        cwd: 'resources/assets/app/',
                        src: ['**/*.html'],
                        dest: 'public/view/'
                    }
                ]
            },
            fonts: {
                files: [
                    {
                        expand: true,
                        cwd: 'resources/assets/vendor/',
                        flatten: true,
                        src: [
                            '**/*.eot',
                            '**/*.svg',
                            '**/*.ttf',
                            '**/*.woff',
                            '**/*.woff2'
                        ],
                        dest: 'public/fonts/'
                    }
                ]
            }
        },
        watch: {
            scripts: {
                files: ['resources/assets/app/**/*.js'],
                tasks: ['concat']
            },
            html: {
                files: ['resources/assets/app/**/*.html'],
                tasks: ['copy']
            },
            css: {
                files: 'resources/assets/css/**/*.css',
                tasks: ['concat_css']
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-concat-css');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-watch');


    grunt.registerTask('default', ['clean', 'concat', 'concat_css', 'copy', 'copy:fonts', 'watch']);
    grunt.registerTask('prod', ['clean', 'concat', 'uglify', 'concat_css', 'cssmin', 'copy', 'copy:fonts']);

};
