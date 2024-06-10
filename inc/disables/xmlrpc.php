<?php
/**
 * Disable XMLRPC
 *
 * @package aquago
 */

add_filter( 'xmlrpc_enabled', '__return_false' );
