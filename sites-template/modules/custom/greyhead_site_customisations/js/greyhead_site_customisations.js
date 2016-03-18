/**
 * @file: greyhead_site_customisations.js
 *
 * Little JS nips and tucks go in here.
 */

var Drupal = Drupal || {};

(function($, Drupal){
  "use strict";

  ///**
  // * If we're on an admin page, get the height of the admin toolbar and set the
  // * body's top margin accordingly.
  // */
  //Drupal.behaviors.greyheadCorrectBodyMarginForAdminMenu = {
  //  attach: function(context, settings) {
  //    if ($('body', context).hasClass('admin-menu')) {
  //      console.log('Setting body top-margin to ' + $('#admin-menu').height() + 'px.');
  //
  //      $('body', context).attr('style', 'margin-top: ' + $('#admin-menu').height() + 'px !important');
  //    }
  //  }
  //};
})(jQuery, Drupal);
