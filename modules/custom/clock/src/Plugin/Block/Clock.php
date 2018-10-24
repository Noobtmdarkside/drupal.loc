<?php
/**
 * @file
 * Contains \Drupal\clock\Plugin\Block\Clock.
 */

namespace Drupal\clock\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a My Block.
 * @Block(
 *   id = "clock",
 *   admin_label = @Translation("Tick-Tick"),
 * )
 */
class Clock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

    $build[] = [
      '#theme' => 'clock',
    ];
    $build['#attached']['library'][] = 'clock/clock';

    return $build;
  }

}