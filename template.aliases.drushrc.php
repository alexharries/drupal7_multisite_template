<?php
/**
 * @file: {{MULTISITENAMENOHYPHENS}}.aliases.drushrc.php
 *
 *      Drush shortcutty goodness.
 */

/**
 * Local environment config.
 *
 * Since most developers' local environments differ slightly from the next code-
 * monkey's, you will probably want to duplicate the definitions below and
 * create your own version, e.g. $aliases['local-yourname'] = ...
 */
$aliases['local'] = array(
  // This is usually set to '@parent'.
  'parent' => '@parent',

  // This is the site alias you will use at the command line, for example if you
  // are going to do "drush @monkey-media.dev cc all", this should be
  // "monkey-media".
  'site' => '{{MULTISITENAMENOHYPHENS}}',

  // This is the variant of the site; e.g. in the above example, where we wrote
  // "drush @monkey-media.dev cc all", the variant is "dev". Typically, the
  // env will be one of local, dev, rc or live.
  'env' => 'local',

  // Absolute server path to the Drupal index.php file, without a trailing
  // slash, e.g. "/Volumes/Sites/4Com/drupal7/www".
  'root' => '{{LOCALBUILDPATH}}',

  // The URL that your site will be hosted at, without the http(s):// or a
  // trailing slash.
  'uri' => '{{LOCALSITEURI}}',

  // Turning off strict checking is usually helpful on older servers; set this
  // to '0' (including the quotes) to turn off, or '1' to turn on.
  'strict' => '0',
);

/**
 * Dev environment config.
 */
$aliases['dev'] = array(
  // This is usually set to '@parent'.
  'parent' => '@parent',

  // This is the site alias you will use at the command line, for example if you
  // are going to do "drush @monkey-media.dev cc all", this should be
  // "monkey-media".
  'site' => '{{MULTISITENAMENOHYPHENS}}',

  // This is the variant of the site; e.g. in the above example, where we wrote
  // "drush @monkey-media.dev cc all", the variant is "dev". Typically, the
  // env will be one of local, dev, rc or live.
  'env' => 'dev',

  // Absolute server path to the Drupal index.php file, without a trailing
  // slash, e.g. "/Volumes/Sites/4Com/drupal7/www".
  'root' => '{{DEVBUILDPATH}}',

  // The remote host, which will be called by drush as an SSH command, so if you
  // write "ssh monkey@server.data.com -p 12345" to ssh into this server, you
  // will enter "server.data.com" here.
  'remote-host' => '{{DEVREMOTEHOST}}',

  // This is the username you use to SSH into the server - this user needs to
  // be able to access the Drupal webroot (and make changes to the Drupal files,
  // if you want it to be able to do things like update modules, or do a git
  // pull). In the example above, remote-user is "monkey".
  'remote-user' => '{{DEVREMOTEUSER}}',

  // Any other SSH options you need should be added here; in the example above,
  // we specify a different port to connect via - "-p 2020", so we add that
  // here.
  'ssh-options' => '-p 65235',

  // The URL that your site will be hosted at, without the http(s):// or a
  // trailing slash.
  'uri' => '{{DEVSITEURI}}',

  // Turning off strict checking is usually helpful on older servers; set this
  // to '0' (including the quotes) to turn off, or '1' to turn on.
  'strict' => '0',
);

/**
 * Staging (RC) environment config.
 */
$aliases['staging'] = array(
  // This is usually set to '@parent'.
  'parent' => '@parent',

  // This is the site alias you will use at the command line, for example if you
  // are going to do "drush @monkey-media.staging cc all", this should be
  // "monkey-media".
  'site' => '{{STAGINGMULTISITENAMENOHYPHENS}}',

  // This is the variant of the site; e.g. in the above example, where we wrote
  // "drush @monkey-media.staging cc all", the variant is "staging". Typically, the
  // env will be one of local, dev, staging or live.
  'env' => 'staging',

  // Absolute server path to the Drupal index.php file, without a trailing
  // slash, e.g. "/Volumes/Sites/4Com/drupal7/www".
  'root' => '{{STAGINGBUILDPATH}}',

  // The remote host, which will be called by drush as an SSH command, so if you
  // write "ssh monkey@server.data.com -p 12345" to ssh into this server, you
  // will enter "server.data.com" here.
  'remote-host' => '{{STAGINGREMOTEHOST}}',

  // This is the username you use to SSH into the server - this user needs to
  // be able to access the Drupal webroot (and make changes to the Drupal files,
  // if you want it to be able to do things like update modules, or do a git
  // pull). In the example above, remote-user is "monkey".
  'remote-user' => '{{STAGINGREMOTEUSER}}',

  // Any other SSH options you need should be added here; in the example above,
  // we specify a different port to connect via - "-p 2020", so we add that
  // here.
  'ssh-options' => '-p 65235',

  // The URL that your site will be hosted at, without the http(s):// or a
  // trailing slash.
  'uri' => '{{STAGINGSITEURI}}',

  // Turning off strict checking is usually helpful on older servers; set this
  // to '0' (including the quotes) to turn off, or '1' to turn on.
  'strict' => '0',
);

/**
 * Live environment config.
 */
$aliases['live'] = array(
  // This is usually set to '@parent'.
  'parent' => '@parent',

  // This is the site alias you will use at the command line, for example if you
  // are going to do "drush @monkey-media.live cc all", this should be
  // "monkey-media".
  'site' => '{{LIVEMULTISITENAMENOHYPHENS}}',

  // This is the variant of the site; e.g. in the above example, where we wrote
  // "drush @monkey-media.staging cc all", the variant is "staging". Typically, the
  // env will be one of local, dev, staging or live.
  'env' => 'live',

  // Absolute server path to the Drupal index.php file, without a trailing
  // slash, e.g. "/Volumes/Sites/4Com/drupal7/www".
  'root' => '{{LIVEBUILDPATH}}',

  // The remote host, which will be called by drush as an SSH command, so if you
  // write "ssh monkey@server.data.com -p 12345" to ssh into this server, you
  // will enter "server.data.com" here.
  'remote-host' => '{{LIVEREMOTEHOST}}',

  // This is the username you use to SSH into the server - this user needs to
  // be able to access the Drupal webroot (and make changes to the Drupal files,
  // if you want it to be able to do things like update modules, or do a git
  // pull). In the example above, remote-user is "monkey".
  'remote-user' => '{{LIVEREMOTEUSER}}',

  // Any other SSH options you need should be added here; in the example above,
  // we specify a different port to connect via - "-p 2020", so we add that
  // here.
  'ssh-options' => '{{LIVESSHOPTIONS}}',

  // The URL that your site will be hosted at, without the http(s):// or a
  // trailing slash.
  'uri' => '{{LIVESITEURI}}',

  // Turning off strict checking is usually helpful on older servers; set this
  // to '0' (including the quotes) to turn off, or '1' to turn on.
  'strict' => '0',
);
