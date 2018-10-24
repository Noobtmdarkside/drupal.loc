<?php

namespace Drupal\custom_entity\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Node\Entity\Node;
use Drupal\file\Entity\File;


/**
 * Implements basic class Form API
 *
 */
class CustomEntity extends FormBase {
  /**
  * {@inheritdoc}
  */
  public function getFormId() {
      return 'custom_entity';
    }
  /**
  * {@inheritdoc}
  */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['persondepartment'] = [
      '#type' => 'entity_autocomplete',
      '#target_type' => 'taxonomy_term',
      '#title' => 'Department',
      '#selection_settings' => [
        'target_bundles' => ['departmets'],
      ],
    ];
    $form['photo'] = array(
      '#title' => t('Photo'),
      '#type' => 'managed_file',
      '#description' => t('Only image files will be allowed.'),
      '#upload_location' => 'public://photos/',
      '#upload_validators'  => array(
        'file_validate_extensions' => array('png gif jpg jpeg'),
        'file_validate_size' => array(2*1024*1024),
      ),
      '#required' => false,
    );
    $form['title'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Title(Will be used as name)'),
      '#required' => true,
    );
    $form['text'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Body'),
      '#required' => true,
    );
    $form['age'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Age'),
      '#required' => false,
    );
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Create'),
    );
    return $form;
  }
  /**
  * {@inheritdoc}
  */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $logo = $form_state->getValue('photo');
    $file = File::load($logo[0]);
    $file->setPermanent();
    $file->save();
    $saved_image = $file;

    $title = $form_state -> getValue('title');
    $text = $form_state -> getValue('text');
    $age = $form_state -> getValue('age');
    $tax = $form_state -> getValue('persondepartment');

    $node = entity_create('node', array(
        'type' => 'personct',
        'field_person_image' => $saved_image,
        'title' => $title,
        'body' => $text,
        'field_person_age' => $age,
        'field_person_name' => $title,
        'field_person_tax_term' => $tax,
      )
    );
    $node->save();

    drupal_set_message('Your entity created successfully!', 'status');
  }
}