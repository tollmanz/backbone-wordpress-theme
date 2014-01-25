/*global Backbone */
var app = app || {};

(function () {
	'use strict';

	var Router = Backbone.Router.extend({
		routes: {
			// Catch all routes; allows us to avoid representing all of WordPress' rewrites here
			'*notFound' : 'go',
			''          : 'go'
		},

		go: function ( pathname ) {
			var url = '/';

			if ( !_.isNull( pathname ) ) {
				url += pathname
			}

			// Add '/' to make sure URL is relative to the domain
			app.archive.url = url + '?zt-json=1';
			app.archive.fetch( { reset : true } );
		}
	});

	app.router = new Router();
	Backbone.history.start( {
		pushState: true,
		silent: true
	} );
})();