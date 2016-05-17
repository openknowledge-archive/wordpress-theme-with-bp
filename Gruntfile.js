module.exports = function(grunt) {
	grunt.initConfig({
		copy: {
			fonts: {
				files: [
					{
						expand: true,
						cwd: 'bower_components/font-awesome/fonts',
						src: ['**/*'],
						dest: 'assets/fonts'
					}
				]
			},
			js: {
				files: [
					{
						expand: true,
						cwd: 'bower_components',
						src: ['bootstrap/dist/js/bootstrap.min.js', 'jquery/dist/jquery.min.js'],
						dest: 'assets/js',
						flatten: true
					}
				]
			}
		},
		less: {
			style: {
				options: {
					cleancss: true,
					report: "min"
				},
				files: {
					"style.css": "assets/less/style.less"
				}
			}
		},
		watch: {
			php: {
				files: ['**/*.php'],
				tasks: [],
				options: {
					livereload: true
				}
			},
			js: {
				files: ['assets/js/**/*.js'],
				options: {
					livereload: true
				}
			},
			less: {
				files: ['assets/less/**/*.less'],
				tasks: ['less:style'],
				options: {
					livereload: true
				}
			}
		}
	});
	grunt.registerTask('build', ['copy', 'less:style']);
	grunt.registerTask('dev', ['build', 'watch']);
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	return grunt.loadNpmTasks('grunt-contrib-watch');
};
