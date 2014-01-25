/*global Backbone */
var app = app || {};

(function () {
	'use strict';

	app.Post = Backbone.Model.extend({

		defaults: {
			id: '',
			title: '',
			content: ''
		}

	});
})();