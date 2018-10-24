<?php

namespace Drupal\my_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Node\Entity\Node;
use Drupal\Core\Url;

/**
 * Implements basic class Form API
 *
 */
class MyForm extends FormBase {
  /**
  * {@inheritdoc}
  */
  public function getFormId() {
      return 'my_form';
    }
  /**
  * {@inheritdoc}
  */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['title'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#required' => true,
    );
    $form['text'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Text'),
      '#required' => true,
    );
    $form['node_id'] = array(
      '#type' => 'number',
      '#title' => $this->t('Enter node ID'),
      '#required' => true,
    );
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Create'),
    );
    honeypot_add_form_protection($form, $form_state, array('honeypot', 'time_restriction'));
    return $form;
  }
  /**
  * {@inheritdoc}
  */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $title = $form_state -> getValue('title');
    $text = $form_state -> getValue('text');
    $node_id = $form_state -> getValue('node_id');
      
    $values = \Drupal::entityQuery('node') -> condition('nid', $node_id)->execute();
    $node_exists = !empty($values);
    $url = \Drupal\Core\Url::fromRoute('entity.node.canonical', ['node' => $node_id]);
        
    if ($node_exists  == $node_id) {
      $form_state -> setRedirectUrl($url);
    }
    else {
      $newNode = Node::create(array(
        'type' => 'article',
        'title' => $title,
        'body' => $text,
        'nid' => $node_id
      ));
      $newNode->save();
//      drupal_set_message('Your node created successfully!', 'status');
    }
  }
}