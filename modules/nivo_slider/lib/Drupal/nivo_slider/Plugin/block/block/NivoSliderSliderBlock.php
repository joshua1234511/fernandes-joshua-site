<?php

/**
 * @file
 * Contains \Drupal\nivo_slider\Plugin\block\block\NivoSliderSliderBlock.
 */

namespace Drupal\nivo_slider\Plugin\block\block;

use Drupal\block\BlockBase;
use Drupal\Core\Annotation\Plugin;
use Drupal\Core\Annotation\Translation;
use Drupal\Component\Render\FormattableMarkup;
use Drupal\Component\Utility\Html;

/**
 * Provides a 'Slider' block.
 *
 * @Plugin(
 *   id = "nivo_slider_slider_block",
 *   admin_label = @Translation("Slider"),
 *   module = "nivo_slider"
 * )
 */
class NivoSliderSliderBlock extends BlockBase {

  /**
   * Overrides \Drupal\block\BlockBase::blockAccess().
   */
  public function blockAccess() {
    return user_access('access content');
  }

  /**
   * Implements \Drupal\block\BlockBase::build().
   */
  public function build() {
    // Get the current slider settings.
    $config = config('nivo_slider.settings');

    $build = [
      '#type' => 'markup',
      '#theme' => 'nivo_slider_wrapper',
      '#attached' => [
        'libraries_load' => [
          ['nivo-slider'],
        ],
        'js' => [
          [
            'data' => drupal_get_path('module', 'nivo_slider') . '/js/nivo_slider.js',
            'type' => 'file',
          ],
          [
            'data' => [
              'nivo_slider' => [
                'effect' => Html::escape($config->get('options.effect')),
                'slices' => (int) Html::escape($config->get('options.slices')),
                'boxCols' => (int) Html::escape($config->get('options.box_columns')),
                'boxRows' => (int) Html::escape($config->get('options.box_rows')),
                'animSpeed' => (int) Html::escape($config->get('options.animation_speed')),
                'pauseTime' => (int) Html::escape($config->get('options.pause_time')),
                'startSlide' => (int) Html::escape($config->get('options.start_slide')),
                'directionNav' => Html::escape($config->get('options.directional_navigation')) == 1 ? TRUE : FALSE,
                'controlNav' => Html::escape($config->get('options.control_navigation')) == 1 ? TRUE : FALSE,
                'controlNavThumbs' => Html::escape($config->get('options.control_nav_thumbs')) == 1 ? TRUE : FALSE,
                'pauseOnHover' => Html::escape($config->get('options.pause_on_hover')) == 1 ? TRUE : FALSE,
                'manualAdvance' => Html::escape($config->get('options.manual_advance')) == 1 ? TRUE : FALSE,
                'prevText' => Html::escape($config->get('options.previous_text')),
                'nextText' => Html::escape($config->get('options.next_text')),
                'randomStart' => Html::escape($config->get('options.random_start')) == 1 ? TRUE : FALSE,
              ],
            ],
            'type' => 'setting',
          ],
        ],
        'css' => [],
      ],
    ];

    // Collect all themes.
    $themes = module_invoke_all('nivo_slider_theme_info');

    // Allow theme information to be altered.
    drupal_alter('nivo_slider_theme_info', $themes);

    // Find the currently selected theme.
    $current_theme = $config->get('options.theme');

    // Get the current theme's settings.
    $theme = $themes[$current_theme];

    // Add the theme's resources.
    foreach (['js', 'css'] as $type) {
      if (!empty($theme['resources'][$type])) {
        foreach ($theme['resources'][$type] as $file_path) {
          $build['content']['#attached'][$type][] = $file_path;
        }
      }
    }

    return $build;
  }

}
