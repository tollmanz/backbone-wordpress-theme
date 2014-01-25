/*global Backbone, jQuery, _, wp */
var app = app || {};

(function ($) {
	'use strict';

	app.PostView = Backbone.View.extend({

		tagName : 'article',

		className : 'post',

		template : wp.template( 'zt-archive-body' ),

		render : function () {
			this.id = 'post-' + this.model.get('id');
			this.$el.html( this.template( this.model.toJSON() ) );
			return this;
		}

	});
})(jQuery);