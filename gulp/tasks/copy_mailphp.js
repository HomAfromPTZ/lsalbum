'use strict';

module.exports = function() {
	$.gulp.task('copy_mailphp', function() {
		return $.gulp.src(['./source/mailphp/*.php', './composer_modules/**/*'], { since: $.gulp.lastRun('copy_mailphp') })
			.pipe($.gulp.dest($.config.root + '/mail'));
	});
};
