module.exports = function( grunt ) {
	grunt.loadNpmTasks('grunt-serve');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks("grunt-contrib-compass");

    grunt.initConfig({
		serve: {
			options: {
				port: 9000
			}
		},

        watch: {
            sass: {
                files: ['app/sass/**/*.scss','app/**/*.html', 'app/js/**/*.js'],
                tasks: ['compass'],
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
        }
    });

    grunt.registerTask("watchApp",['watch'])
};