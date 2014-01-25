/*global Backbone */
var app = app || {};

(function () {
	'use strict';

	var Archive = Backbone.Collection.extend({
		model: app.Post
	});

	app.archive = new Archive();
})();