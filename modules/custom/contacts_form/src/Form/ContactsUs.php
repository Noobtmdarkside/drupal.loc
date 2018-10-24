<?php

namespace Drupal\contacts_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Node\Entity\Node;
use Drupal\Core\Url;
use Drupal\file\Entity\File;
use Drupal\file\FileUsage\DatabaseFileUsageBackend;

/**
 * Implements basic class Form API
 *
 */
class ContactsUs extends FormBase {
  /**
  * {@inheritdoc}
  */
  public function getFormId() {
      return 'contacts_form';
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
      '#placeholder' => $this->t('+3(XXX)XXX - XX - XX'),
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
    /* Fetch the array of the file stored temporarily in database */ 
    $logo = $form_state->getValue('logo');
    /* Load the object of the file by it's fid */ 
    $file = File::load($logo[0]);
    /* Set the status flag permanent of the file object */
    $file->setPermanent();
    /* Save the file in database */
    $file->save();
    $saved_image = $file;
    $sended_image = file_create_url($file->getFileUri());


    $image = $form_state->getValue('logo');
    $name = $form_state -> getValue('name');
    $company = $form_state -> getValue('company');
    $email = $form_state -> getValue('email');
    $phone = $form_state -> getValue('phone');
    $message = $form_state -> getValue('body');
      
    $newNode = Node::create(array(
        'type' => 'contact_us',
        'title' => $company,
        'field_image_contact' => $saved_image,
        'field_name_contact' => $name,
        'field_company_contact' => $company,
        'field_email_contact' => $email,
        'field_phone_contact' => $phone,
        'field_message_contact' => $message,

      ));
      $newNode->save();
      drupal_set_message('Your message created successfully!', 'status');
    
  }
}