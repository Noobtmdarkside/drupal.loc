<?php

namespace Drupal\my_join\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Node\Entity\Node;
use Drupal\Core\Url;
use Drupal\Core\Link;
/**
 * Provides route responses for the Example module.
 */
class Join extends ControllerBase {
  public function my_join() {
    $query = \Drupal::database() -> select('node_field_data', 'nfd');
    $query -> leftJoin('node__field_image_for_news', 'nfifns', 'nfd.nid = nfifns.entity_id');
    $query -> fields('nfd', array('type','title','nid','created','changed',));
    $query -> fields('nfifns', array('field_image_for_news_alt'));
    $query -> orderBy('nfd.created', 'DESC');
    $query -> range(0, 10);
    $result = $query -> execute() -> fetchAll();
       
    $rows = array();
    $n=0;
      foreach ($result as $node) {
        $n++;
        $rows[] = array(
          'id' => $node ->nid,
          'type' => $node ->type,
          'title' => $node ->title,
          'node/'.$node->nid,
          'created' => date('Y-m-d H:i:s',$node->created),
          'changed' => date('Y-m-d H:i:s',$node->changed),
          $link = Link::fromTextAndUrl($node ->field_image_for_news_alt, Url::fromRoute('entity.node.canonical', ['node' => $node ->nid])),
        );     
      }
    $header = array(
      'nid' => t('Node id'),
      'type' => t('Node type'),
      'title' => t('Title'),
      'link' => t('Path'),
      'created' => t('Created'),
      'changed' => t('Last change'),
      'uri' => t('Link'),
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