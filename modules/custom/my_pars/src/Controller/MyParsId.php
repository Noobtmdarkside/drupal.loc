<?php

namespace Drupal\my_pars\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;
use Drupal\Core\Link;
use Drupal\Component\Serialization\Json;

/**
 * Example module.
 */
class MyParsId extends ControllerBase {
  public function content($id) {

    $uri_to_site = "https://jsonplaceholder.typicode.com/posts";
    try {
      $art_id = $id - 1;
      $resp_from_site = \Drupal::httpClient()->get($uri_to_site, array('headers' => array('Accept' => 'application/json')));
      $data_from_site = $resp_from_site->getBody();
      $rendered = Json::decode($data_from_site);
      $rows_block = [];
          $rows_block[$art_id] = [
            'userId' => $rendered[$art_id]['userId'],
            'id' => $rendered[$art_id]['id'],
            'title' => $rendered[$art_id]['title'],
            'body' => $rendered[$art_id]['body'],
          ];
        // kint($rendered[$art_id]);
        // die();

        $header_block = [
          'userId' => t('User id'),
          'id' => t('Art ID'),
          'title' => t('Title'),
          'body' => t('Body'),
        ];
        $build_article['table_pager'][] = [
          '#header' => $header_block,
          '#type' => 'table',
          '#rows' => $rows_block,
        ];
        // kint($rendered[$art_id]);
        // die();
        return $build_article;
          
    }
    catch (RequestException $build_article) {
      watchdog_exception('content', $build_article);
    }
  }
}
