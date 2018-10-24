<?php

namespace Drupal\my_custom\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Node\Entity\Node;
use Drupal\Core\Url;
/**
 * Provides route responses for the Example module.
 */
class Display extends ControllerBase {
  public function my_custom() {
    $query = \Drupal::database()->select('node_field_data', 'n');
    $query -> fields('n', array('nid', 'type', 'title', 'created', 'changed',));
    $query -> orderBy('n.created', 'DESC');
    $query -> range(0, 10);
    $output = $query -> execute() -> fetchAll();
       
    $rows = array();
    $n = 0;
    foreach ($output as $node) {
      $n++;
      $rows[] = array(
        'id' => $node->nid,
        'type' => $node->type,
        'title' => $node->title,
        'node/'.$node->nid,
        'created' => date('Y-m-d H:i:s',$node ->created),
        'changed' => date('Y-m-d H:i:s',$node ->changed),
      );   
    }
    $header = array(
      'nid' => t('Node id'),
      'type' => t('Node type'),
      'title' => t('Title'),
      'link' => t('Way to node'),
      'created' => t('Created'),
      'changed' => t('Last change'),
    );
    $build['table_pager'][] = array(
      '#header' => $header,
      '#type' => 'table',
      '#rows' => $rows,
      '#empty' => t('No records found!'),
    );
    return $build;
  }
}