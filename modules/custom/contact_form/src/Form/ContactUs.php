<?php

namespace Drupal\contact_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;
use Drupal\file\FileUsage\DatabaseFileUsageBackend;

/**
 *  form.
 */
class ContactUs extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId()
  {
    return 'message';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['logo'] = array(
      '#title' => t('Картинка'),
      '#type' => 'managed_file',
      '#description' => t('Only image files will be allowed.'),
      '#upload_location' => 'public://photos/',
      '#upload_validators'  => array(
        'file_validate_extensions' => array('png gif jpg jpeg'),
        'file_validate_size' => array(2*1024*1024),
        ),
      '#required' => false,
    );
    $form['name'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Імя'),
      '#required' => true,
    );
    $form['company'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Компанія'),
      '#required' => false,
    );
    $form['email'] = array(
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#descriptions' => $this->t('this is a email field'),
      '#required' => false,
    );
    $form['phone'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Телефон'),
      '#required' => false,
    );
    $form['body'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Повідомлення'),
      '#required' => true,
    );
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Підтвердити'),
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $mailManager = \Drupal::service('plugin.manager.mail');
    $module = 'contact_form';
    $key = 'send_mail';
    $to = $form_state->getValue('email');
    
    /* Fetch the array of the file stored temporarily in database */ 
    $logo = $form_state->getValue('logo');
    /* Load the object of the file by it's fid */ 
    $file = File::load($logo[0]);
    /* Set the status flag permanent of the file object */
    $file->setPermanent();
    /* Save the file in database */
    $file->save();
    $saved_image = $file;

    $params['title'] = $form_state->getValue('company');
    $body = $form_state->getValue('body');
    $name = $form_state->getValue('name');
    $phone = $form_state->getValue('phone');
    $sended_image = file_create_url($file->getFileUri());
    
    $params['body'] = [
      'body' => $body,
      'name' => $name,
      'phone' => $phone,
      'sended_image' => $sended_image,
    ];
    $langcode = 'en';
    $send = true;

    $in_mail = $mailManager->mail($module, $key, $to, $langcode, $params, NULL, $send);
  // kint($file->getFileUri());
  // die();
  //   echo "<pre>"; 
  // var_dump($saved_image);
  // echo "</pre>"; 
    if (!$in_mail) {
      drupal_set_message(t('ERROR'), 'error');
    } 
    else {
       drupal_set_message(t('SUCCESS'));
    }
  }
}