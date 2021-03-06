<?php

/**
 * @file
 * Declare default themes included with the Nivo Slider jQuery plugin.
 */

/**
 * Implements hook_nivo_slider_theme_info().
 */
function nivo_slider_nivo_slider_theme_info() {
  // Find the path to the Nivo Slider jQuery plugin.
  $library_path = libraries_get_path('nivo-slider');

  return [
    'bar' => [
      'name' => t('Bar'),
      'description' => t('The bottom bar skin for the Nivo Slider.'),
      'thumb_support' => FALSE,
      'resources' => [
        'css' => [
          $library_path . '/themes/bar/bar.css',
        ],
      ],
    ],
    'dark' => [
      'name' => t('Dark'),
      'description' => t('A dark skin for the Nivo Slider.'),
      'thumb_support' => TRUE,
      'resources' => [
        'css' => [
          $library_path . '/themes/dark/dark.css',
        ],
      ],
    ],
    'default' => [
      'name' => t('Default'),
      'description' => t('The default skin for the Nivo Slider.'),
      'thumb_support' => TRUE,
      'resources' => [
        'css' => [
          $library_path . '/themes/default/default.css',
        ],
      ],
    ],
    'light' => [
      'name' => t('Light'),
      'description' => t('A light skin for the Nivo Slider.'),
      'thumb_support' => TRUE,
      'resources' => [
        'css' => [
          $library_path . '/themes/light/light.css',
        ],
      ],
    ],
  ];
}
