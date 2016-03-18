<?php
/**
 * Drupal database configuration file - local_databases.template.php
 *
 * @see /deployment-scripts/deployment-templates/local_databases.template.php
 *
 * This file will be renamed to "local_databases.php" and moved into the project
 * root when an automagic deployment takes place using the deploy.sh script
 * (which is located in the parent directory above this template).
 *
 * Note that the key of the configuration array maps to the MULTISITE_IDENTIFIER
 * constant, but this script is only intended for use where one project checkout
 * maps to one Drupal website; for security, performance, and to preserve the
 * general sanity of all developers concerned, we don't run Drupal multisites.
 *
 * An example of a populated array:
 *
 * $local_databases = array(
 *   'awesome-website' => array(
 *     'dev.awesome-website.greyheaddev.com' => array(
 *       'database' => 'awesome_website',
 *       'username' => 'awesome_website_user',
 *       'password' => 'awesome_website_password',
 *     ),
 *   ),
 * );
 *
 * Each database can specify the following keys; if not specified, the default
 * value (shown next to each key) will be used:
 *
 * database:  ''
 * username:  ''
 * password:  ''
 * host:      '127.0.0.1'
 * port:      ''
 * driver:    'mysql'
 * prefix:    ''
 *
 * By:   Alex Harries
 * Date: 16/06/2015
 */

$local_databases = array(
  '{{MULTISITE_IDENTIFIER}}' => array(
    '{{DOMAIN}}' => array(
      'database' => '{{DATABASENAME}}',
      'username' => '{{DATABASEUSERNAME}}',
      'password' => '{{DATABASEPASSWORD}}',
    ),
  ),
);
