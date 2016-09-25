<?php

/**
 * @file
 * template.php
 */

/**
 * Implements hook_form_alter().
 *
 * @param array $form
 * @param array $form_state
 * @param null  $form_id
 */
function username_bootstrap_subtheme_form_alter(array &$form, array &$form_state = array(), $form_id = NULL) {
  if ($form_id) {
    switch ($form_id) {
      // Adjust the search form's submit button with a custom theme function
      // which we use to change the button to a search icon.
      case 'search_form':
        // Implement a theme wrapper to add a submit button containing a search
        // icon directly after the input element.
        $form['basic']['keys']['#theme_wrappers'] = array('search_form_wrapper');
        break;
      case 'search_block_form':
        $form['search_block_form']['#theme_wrappers'] = array('search_form_wrapper');
        break;

      // Rewrite the topics filter on news pages to place the label inline.
      case 'views_exposed_form':
        // Are we showing the news listing form? These are the views form IDs.
        $views_forms_we_want_to_finagle = array(
          'views-exposed-form-news-page-news-home',
          'views-exposed-form-news-news-by-date',
        );

        if (in_array($form['#id'], $views_forms_we_want_to_finagle)) {
          // The form contains a drop-down select at $form['topics'], and the
          // options array is in ['#options']['All']. We want to change the
          // _value_ of the 'All' topics to read t('Topics').
          $form['topics']['#options']['All'] = t('Topics');
        }
        break;
    }
  }
}

/**
 * Theme function implementation for MYTHEME_search_form_wrapper.
 *
 * @param $variables
 *
 * @return string
 */
function username_bootstrap_subtheme_search_form_wrapper($variables) {
  $output = '<div class="input-group">';
  $output .= $variables['element']['#children'];
  $output .= '<span class="input-group-btn">';
  $output .= '<button type="submit" class="btn btn-default">';
// We can be sure that the font icons exist in CDN.
//  if (theme_get_setting('bootstrap_cdn')) {
  $output .= _bootstrap_icon('search');
//  }
//  else {
  $output .= ' <span class="hidden">' . t('Search') . '</span>';
//  }
  $output .= '</button>';
  $output .= '</span>';
  $output .= '</div>';
  return $output;
}

/**
 * Overrides theme_menu_link().
 *
 * Integrates Bootstrap plugin jquery.smartmenus.js with Drupal menu system.
 * This plugin handles multiple devices and inputs.
 * @see http://webmar.com.au/blog/drupal-bootstrap-3-multilevel-submenus-hover
 *
 * @param array $vars
 * @return string
 */
function username_bootstrap_subtheme_menu_link(array $vars) {
  $element = $vars['element'];
  $sub_menu = '';

  if ($element['#below']) {
    // Prevent dropdown functions from being added to management menu so it
    // does not affect the navbar module.
    if (($element['#original_link']['menu_name'] == 'management') && (module_exists('navbar'))) {
      $sub_menu = drupal_render($element['#below']);
    }
    //Here we need to change from ==1 to >=1 to allow for multilevel submenus
    elseif ((!empty($element['#original_link']['depth'])) && ($element['#original_link']['depth'] >= 1)) {
      // Add our own wrapper.
      unset($element['#below']['#theme_wrappers']);
      $sub_menu = '<ul class="dropdown-menu">' . drupal_render($element['#below']) . '</ul>';
      // Generate as standard dropdown.
      //$element['#title'] .= ' <span class="caret"></span>'; Smartmenus plugin add's caret
      $element['#attributes']['class'][] = 'dropdown';
      $element['#localized_options']['html'] = TRUE;

      // Set dropdown trigger element to # to prevent inadvertant page loading
      // when a submenu link is clicked.
      $element['#localized_options']['attributes']['data-target'] = '#';
      $element['#localized_options']['attributes']['class'][] = 'dropdown-toggle';
      //comment element bellow if you want your parent menu links to be "clickable"
      //$element['#localized_options']['attributes']['data-toggle'] = 'dropdown';
    }
  }
  // On primary navigation menu, class 'active' is not set on active menu item.
  // @see https://drupal.org/node/1896674
  if (($element['#href'] == $_GET['q'] || ($element['#href'] == '<front>' && drupal_is_front_page())) && (empty($element['#localized_options']['language']))) {
    $element['#attributes']['class'][] = 'active';
  }

  // Additionally identify the menu links so they can be themed
  $link_id = preg_replace('@[^a-z0-9_]+@', '-', strtolower($element['#title']));
  $element['#attributes']['class'][] = $link_id;

  $wrap_start = '<div class="vcenter">';
  $wrap_end = is_array($element['#theme']) && in_array('menu_link__menu_block__1', $element['#theme']) ? '<span class="glyphicon glyphicon-chevron-right"></span></div>' : '</div>';

  //$title = '<div class="vcenter">' . . '</div>';
  $element['#localized_options']['html'] = TRUE;

  $output = l($wrap_start . $element['#title'] . $wrap_end, $element['#href'], $element['#localized_options']);


  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

/**
 * Bootstrap theme wrapper function for the primary menu links.
 *
 * Modified to include the menu name for themeing.
 *
 * @param array $vars
 * @return string
 */
function username_bootstrap_subtheme_menu_tree__primary(&$vars) {
  return '<ul class="menu nav navbar-nav primary">' . $vars['tree'] . '</ul>';
}

/**
 * Implements hook_preprocess_image_style().
 *
 * Add in our img-responsive class to all images.
 *
 * @param $vars
 */
function username_bootstrap_subtheme_preprocess_image_style(&$vars) {
  $vars['attributes']['class'][] = 'img-responsive';
}

/**
 * Implements hook_preprocess_node().
 *
 * Add the correct date format to the submitted.
 *
 * @param $variables
 */
function username_bootstrap_subtheme_preprocess_node(&$variables) {
  // Convenience variables rock.
  $node = &$variables['node'];

  /**
   * Add template suggestions for the node templating system: this adds template
   * suggestions such as:
   *
   * node--landing-page--teaser.tpl.php
   * node--landing-page--full.tpl.php
   */
  $variables['theme_hook_suggestions'][] = 'node__' . $node->type . '__' . $variables['view_mode'];

  $variables['submitted'] = format_date($variables['revision_timestamp'], 'date_only');
}

/**
 * Implements hook_preprocess_page().
 *
 * @see page.tpl.php
 *
 * @param $variables
 */
function username_bootstrap_subtheme_preprocess_page(&$variables) {
  // We have changed the class from col-sm-x to col-md-x so they collapse on
  // tablet.
  if (drupal_is_front_page()) {
    $variables['content_column_class'] = ' class="col-md-12"';
  }
  else {
    if (!empty($variables['page']['sidebar_first']) && !empty($variables['page']['sidebar_second'])) {
      $variables['content_column_class'] = ' class="col-md-6"';
    }
    elseif (!empty($variables['page']['sidebar_first']) || !empty($variables['page']['sidebar_second'])) {
      $variables['content_column_class'] = ' class="col-md-9"';
    }
    else {
      $variables['content_column_class'] = ' class="col-md-12"';
    }
  }

  // Reference $node directly for simplesness. ;)
  if (isset($variables['node'])) {
    $node = &$variables['node'];
  }

  // Set some empty variables so we don't get undefined variable errorage.
  $variables['icon'] = $variables['brand_colour'] = '';

  // Add a number of template suggestions based on node type and nid.
  // Code from https://www.drupal.org/node/1142800#comment-4433994
  // Do we have a node?
  if (isset($node)) {
    // Reference suggestions cuz it's very long.
    $suggestions = &$variables['theme_hook_suggestions'];

    // Get path arguments.
    $args = arg();

    // Remove first argument of "node".
    unset($args[0]);

    // Set type.
    $type = "page__type_{$node->type}";

    // Bring it all together.
    $suggestions = array_merge(
      $suggestions,
      array($type),
      theme_get_suggestions($args, $type)
    );

    // if the url is: 'http://domain.com/node/123/edit'
    // and node type is 'blog'..
    //
    // This will be the suggestions:
    //
    // - page__node
    // - page__node__%
    // - page__node__123
    // - page__node__edit
    // - page__type_blog
    // - page__type_blog__%
    // - page__type_blog__123
    // - page__type_blog__edit
    //
    // Which connects to these templates:
    //
    // - page--node.tpl.php
    // - page--node--%.tpl.php
    // - page--node--123.tpl.php
    // - page--node--edit.tpl.php
    // - page--type-blog.tpl.php          << this is what you want.
    // - page--type-blog--%.tpl.php
    // - page--type-blog--123.tpl.php
    // - page--type-blog--edit.tpl.php
    //
    // Latter items take precedence.

    // If we're on the homepage or a landing page, unset and hide the sidebars,
    // and reset the css on the main page content to 12 columns.
    if (($node->type == 'homepage') || ($node->type == 'landing_page')) {
      // We're displaying a homepage or landing page:
      hide($variables['page']['sidebar_first']);
      hide($variables['page']['sidebar_second']);
      $variables['content_column_class'] = ' class="col-sm-12"';
    }
  }

  // Override the primary nav set by Bootstrap - we use menu_tree_all_data()
  // instead of menu_tree() so that we can get all menu links, not just the
  // expanded items in the current path.
  if ($variables['primary_nav'] && isset($variables['main_menu'])) {
    // Build links.
    $primary_nav_unprocessed = menu_tree_all_data(variable_get('menu_main_links_source', 'main-menu'));

    // Add the active path to the tree - see
    // https://api.drupal.org/comment/50288#comment-50288
    if (function_exists('menu_tree_add_active_path') && is_array($primary_nav_unprocessed)) {
      menu_tree_add_active_path($primary_nav_unprocessed);
    }

    $variables['primary_nav'] = menu_tree_output($primary_nav_unprocessed);

    // Provide default theme wrapper function.
    $variables['primary_nav']['#theme_wrappers'] = array('menu_tree__primary');
  }

  // Remove the "container" class from the navbar classes so the header can
  // expand to full width.
  $index = array_search('container', $variables['navbar_classes_array']);
  if (!($index === FALSE)) {
//    unset($variables['navbar_classes_array'][$index]);
    $variables['navbar_classes_array'][$index] = 'container-fluid';
  }

  $variables['navbar_classes'] = implode(' ', $variables['navbar_classes_array']);
  
  // Add fonts to the page.
  drupal_add_html_head_link(array(
    'rel' => 'stylesheet',
    'href' => '//fonts.googleapis.com/css?family=Della+Respira|Raleway:400,400i,700,700i|Tangerine',
    'type' => 'text/css'
  ));
}

/**
 * Implements hook_preprocess_html().
 *
 * @param $variables
 */
function username_bootstrap_subtheme_preprocess_html(&$variables) {
  $favicon = url(path_to_theme() . '/images/favicons/favicon.ico');
  $type = theme_get_setting('favicon_mimetype');
  drupal_add_html_head_link(array(
    'rel' => 'shortcut icon',
    'href' => $favicon,
    'type' => $type,
  ));

  // Add favicons.
  greyhead_customisations_add_favicons(path_to_theme() . '/images/favicons', array(57, 72, 76));

  // Check if the classes array exists and append our new class.
  if (!array_key_exists('classes_array', $variables)) {
    $variables['classes_array'] = array();
  }

  if (!is_array($variables['classes_array'])) {
    $variables['classes_array'] = (array) $variables['classes_array'];
  }

  // Add the page URL as a class to the body tag, so we can target pages by
  // their URLs.
  $variables['classes_array'][] = 'path-' . greyhead_customisations_get_class_from_url(drupal_get_path_alias($_GET['q']));
}
