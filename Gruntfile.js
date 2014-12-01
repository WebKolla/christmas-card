module.exports = function( grunt ) {
	grunt.loadNpmTasks('grunt-serve');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks("grunt-contrib-compass");
    grunt.loadNpmTasks("grunt-contrib-cssmin");

    grunt.initConfig({
		serve: {
			options: {
				port: 9000
			}
		},

        watch: {
            sass: {
                files: ['app/sass/**/*.scss','app/**/*.html', 'app/js/**/*.js'],
                tasks: ['compass','cssmin'],
                options: {
                    livereload: true
                }
            }
        },

        compass: {
            dev: {
                options: {
                    config: 'Config.rb',
                    environment: 'development'
                }
            }
        },

        cssmin: {
            minify: {
                expand: true,
                cwd: 'app/css/',
                src: ['*.css', '*.css'],
                dest: 'app/css'
            }
        }
    });

    grunt.registerTask("watchApp",['watch'])
};