* WordPress (see starter package)
	* style.CSS
	* index.php
	* functions.php
		* js templating
		* enqueue scripts
	* json.php
	* json-posts.php
	* _archive-body.php
* Structure (see starter package)
	* Use a nice directory structure for the scripts
* app.js
	* Main file to "start" the app
	* Contains an initial function that sets up our top level events
  
	```js
	/*global jQuery */
	var app = app || {};
	
	jQuery(function () {
		'use strict';
	
		new app.CoreView();
	});
	```  	
* /views/core.js
	* Contains the top level events that initiate the app
		* After the page loads, what can the user do
	* In this sample app, the main events are the links in the "sidebar"
	
	```js
	/*global Backbone, jQuery, _ */
	var app = app || {};
	
	(function ($) {
		'use strict';
	
		app.CoreView = Backbone.View.extend({
			el : function() {
				return document.getElementById( 'container' );
			},
	
			events : {
				'click .zt-control' : 'initRouter'
			},
	
			initRouter : function ( evt ) {
				evt.preventDefault();
			}
		});
	})(jQuery);	
	```
	
* Follow the events
	* Backbone.js is event driven
	* Set up the initial events and follow the life of that event
	
	* In **/views/core.js**, in `initRouter`, add:
	
	```js
	// Get the link
	var pathname = evt.target.pathname;
	
	// Trigger the router
	app.router.navigate( pathname, { trigger: true } ); 
	```
	
* /routers/router.js
	* Allows for connecting client-side events, tied to specific URLs, to actions and events.
	
	```js
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

			}
		});
	})();
	``` 
	
	* In **/routers/router.js**, initialize the router and start history
	
	```
	app.router = new Router();
	Backbone.history.start( {
		pushState: true,
		silent: true
	} );
	```
	
	* We need to complete the `go` method, but before doing so, we need to add our collection
	
* /collections/archive.js
	* Set of models
	* Allows you to hold a group of models and apply "array-like" functions to them
	
	```js
	/*global Backbone */
	var app = app || {};
	
	(function () {
		'use strict';
		
		var Archive = Backbone.Collection.extend({
			model: app.Post
		});
		
		app.archive = new Archive();
	})();
	```
	
	* Oh boy, now we need to create our model
	
* /models/post.js
	* Contains data and logic for a specific object in the app
	
	```js
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
	```
	
* Back to the router
	* To refresh, we click the link, `initRouter` is executed, which calls `app.router.navigate( pathname );`
	* The catchall route is matched and `app.router.go` is executed
	* In **/routers/router.js**, `go`, update the collection URL and fetch from server
	
	```js
	var url = '/';
	
	if ( !_.isNull( pathname ) ) {
		url += pathname
	}
	
	// Add '/' to make sure URL is relative to the domain
	app.archive.url = url + '?zt-json=1';
	app.archive.fetch( { reset : true } );	
	```
	
* Listen for the `archive` reset event in the core view
	* Because we want to keep logic related to the core view in the one file, we can set up a listener in the core view to trigger actions when the archive collection is reset
	* In **/views/core.js**, add:
	
	```js
	initialize : function() {
		this.$posts = $( '#posts' );
		this.listenTo( app.archive, 'reset', this.addAll );
	}, 
	```
	
	* Note that `initialize` is called when `app.CoreView` is executed (e.g., `var app = new app.CoreView();`)
		* This caches the `#posts` element and sets up the listener
	* On `reset`, `addAll` is executed. In **/views/core.js**, add:
	
	```js
	addAll : function() {
		this.$posts.html( '' );
		app.archive.each( this.addOne, this );
	},
	
	addOne: function ( post ) {
		var view = new app.PostView( { model: post } );
		this.$posts.append( view.render().el );
	}
	```
	
* /views/post.js
	
	```js
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
	```
	
	
	
