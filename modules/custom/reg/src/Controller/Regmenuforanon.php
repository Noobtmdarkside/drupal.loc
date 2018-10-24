<?php

namespace Drupal\reg\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Provides route responses for the Example module.
 */
class Regmenuforanon {
  public function Menu() {
    $form_login = \Drupal::formBuilder()->getForm('Drupal\reg\Form\LogForma');
    $form_registration = \Drupal::formBuilder()->getForm('Drupal\reg\Form\RegForma');
    $build[] = [
      '#theme' => 'reg',
      '#form_login' => $form_login,
      '#form_registration' => $form_registration,
    ];
    $build['#attached']['library'][] = 'core/drupal.dialog.ajax';
    $build['#attached']['library'][] = 'reg/reg';

    return $build;

  }
}