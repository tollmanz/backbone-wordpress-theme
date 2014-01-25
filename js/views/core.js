/*global Backbone, jQuery, _ */
var app = app || {};

(function ($) {
	'use strict';

	app.CoreView = Backbone.View.extend({
		el : function() {
			return document.getElementById( 'container' );
		},

		currentViews: {},

		events : {
			'click .zt-control' : 'initRouter'
		},

		initialize : function() {
			this.$posts = $( '#posts' );
			this.listenTo( app.archive, 'reset', this.addAll );
		},

		initRouter : function ( evt ) {
			evt.preventDefault();

			// Get the link
			var pathname = evt.target.pathname;

			// Trigger the router
			app.router.navigate( pathname, { trigger: true } );
		},

		addAll : function() {
			this.$posts.html( '' );
			app.archive.each( this.addOne, this );
		},

		addOne: function ( post ) {
			var view = new app.PostView( { model: post } );
			this.$posts.append( view.render().el );
		}
	});
})(jQuery);