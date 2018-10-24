<?php

namespace Drupal\my_pars\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;
use Drupal\Core\Link;
use Drupal\Component\Serialization\Json;

/**
 * Example module.
 */
class MyPars extends ControllerBase {
  public function my_parse() {

    $uri = "https://jsonplaceholder.typicode.com/posts";
    try {
      $response = \Drupal::httpClient()->get($uri, array('headers' => array('Accept' => 'application/json')));
      $data = $response->getBody();
      if (empty($data)) {
        drupal_set_message('Empty response.');
      } else{
        $rend = Json::decode($data);
           // kint($rend);
           // die();

        $rows = [];
        $n=0;
        foreach ($rend as $mass) {
          $n++;
          $rows[] = [
            'userId' => $mass['userId'],
            'id' => $mass['id'],
            'title' => $mass['title'],
            'body' => $mass['body'],
            'uri' => $link = 'https://jsonplaceholder.typicode.com/posts/'.$mass['id']
          ];
        }
        $header = array(
          'userId' => t('User id'),
          'id' => t('Art ID'),
          'title' => t('Title'),
          'body' => t('Body'),
          'uri' => t('Link'),
        );
        $build['table_pager'][] = [
          '#header' => $header,
          '#type' => 'table',
          '#rows' => $rows,
        ];
       // return $build;
    // kint($rend);
    // die();
        $times = [
          '#theme' => 'my_parse',
          '#header' => $header,
          '#rows' => $rows,
        ];
        return $times;
      }
    }
    catch (RequestException $build) {
      watchdog_exception('my_parse', $build);
    }
  }
}