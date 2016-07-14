'use strict';

module.exports = function() {
	$.gulp.task('js_process', function() {
		var sourcePath = $.path.app.src,
			bundles = $.path.app.bundles;

		var bundled = bundles.map(function(bundle){
			return $.browserify([sourcePath+bundle])
			.bundle()
			.pipe($.vinyl(bundle))
			.pipe($.buffer())
			.pipe($.gp.sourcemaps.init())
			.pipe($.gp.uglify())
			.pipe($.gp.sourcemaps.write())
			.pipe($.gulp.dest($.config.root + '/assets/js'));
		});

		return $.merge(bundled);
	})
};
