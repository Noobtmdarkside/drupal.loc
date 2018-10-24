<?php

namespace Drupal\my_form\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Provides route responses for the Example module.
 */
class HelloWorldController extends ControllerBase {
  public function content() {
    return array(
      '#type' => 'markup',
      '#markup' => t('Hello world'),
    );
  }
}