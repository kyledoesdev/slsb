/**
 * Bootstrap application with essentials
 */
require('./bootstrap');

/**
 * Define global spacelampsix globals
 */
require('./spacelampsix');

/**
 * Boot Vue JS
 */
require('./vue-booter');

/**
 * TODO Find a way to dynamically load all routes for a file.
 */
require('./routes/_dashboard');
require('./routes/post/_edit');


/**
 * Require external packages
 */
require('./toast-ui-editor');
