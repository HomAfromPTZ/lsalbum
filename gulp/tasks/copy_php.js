'use strict';

module.exports = function() {
	$.gulp.task('copy_php', function() {
		return $.gulp.src(['./source/php/*.php', './vendor/**/*'], { since: $.gulp.lastRun('copy_php') })
			.pipe($.gulp.dest($.config.root + '/php'));
	});
};
