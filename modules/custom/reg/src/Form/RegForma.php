<?php

namespace Drupal\reg\Form;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Ajax\RedirectCommand;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\user\Entity\User;

/**
 * @property  userAuth
 */
class RegForma extends FormBase {

  /**
   * @return string
   */
  public function getFormId() {
    return 'form registration';
  }

  /**
   * @param array $form
   * @param FormStateInterface $form_state
   * @return array|void
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['name'] = [
      '#type' => 'textfield',
      '#required' => true,
      '#title' => t('First Name (will be used as nickname)'),
    ];
    $form['surname'] = [
      '#type' => 'textfield',
      '#required' => true,
      '#title' => t('Second Name'),
    ];
    $form['email'] = [
      '#type' => 'email',
      '#required' => TRUE,
      '#title' => t('E-Mail'),
    ];
    $form['pass'] = [
      '#type' => 'password',
      '#required' => TRUE,
      '#title' => t('Password'),
      '#size' => 20,
    ];
    $form['confirm'] = [
      '#type' => 'password',
      '#required' => TRUE,
      '#title' => t('Confirm'),
      '#size' => 20,
    ];
    $form['system_messages'] = [
      '#markup' => '<div id="form-registration-system-messages"></div>',
      '#weight' => -100,
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => t('Sign up'),
      '#ajax' => [
        'callback' => '::saveRegistration',
        'event' => 'click',
        'progress' => [
          'type' => 'throbber',
        ],
      ],
    ];

    return $form;
  }
  /**
   * @param array $form
   * @param FormStateInterface $form_state
   * @return AjaxResponse
   */
  public function saveRegistration(array &$form, FormStateInterface $form_state) {

    $name = $form_state->getValue('name');
    $surname = $form_state->getValue('surname');
    $email = $form_state->getValue('email');
    $pass = $form_state->getValue('pass');
    $confirm = $form_state->getValue('confirm');

    $registration_response = new AjaxResponse();

    $query_name = \Drupal::database()->select('users_field_data', 'ufd');
    $is_name = (bool)$query_name
      ->condition('ufd.name', $name)
      ->countQuery()
      ->execute()
      ->fetchField();

    $query_email = \Drupal::database()->select('users_field_data', 'ufd');
    $is_email = (bool)$query_email
      ->condition('ufd.mail', $email)
      ->countQuery()
      ->execute()
      ->fetchField();

    if ($is_name) {
      drupal_set_message(t("User name already exist."), 'error');
    } elseif ($is_email) {
      drupal_set_message(t("E-mail already exists."), 'error');
    } elseif ($pass!=$confirm) {
      drupal_set_message(t("Your password not match."), 'error');
    } elseif (strlen($pass) < 6) {
      drupal_set_message(t("Password must contain 6 letters."), 'error');

    } elseif (!preg_match('@[A-Z]@', $pass)) {
      drupal_set_message(t("The password must have Upper case."), 'error');
    } else {
      $user = User::create([
        'type' => 'user',
        'name' => $name,
        'field_surname' => $surname,
        'mail' => $email,
        'init' => $email,
        'pass' => $pass,
      ]);
      $user->activate();
      $user->save();

      $registration_response->addCommand(new RedirectCommand(Url::fromRoute('<front>')->toString()));
      drupal_set_message(t("User successfully registered."), 'status');
    }
    $message = [
      '#theme' => 'status_messages',
      '#message_list' => drupal_get_messages(),
      '#status_headings' => [
        'status' => t('Status message'),
        'error' => t('Error message'),
      ],
    ];
    $messages = \Drupal::service('renderer')->render($message);
    $registration_response->addCommand(new HtmlCommand('#form-registration-system-messages', $messages));

    return $registration_response;
  }
  /**
   * @param array $form
   * @param FormStateInterface $form_state
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

  }
}