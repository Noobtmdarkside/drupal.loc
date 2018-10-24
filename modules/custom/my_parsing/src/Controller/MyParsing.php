<?php

namespace Drupal\my_parsing\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;
use Drupal\Core\Link;
use Drupal\Component\Serialization\Json;

/**
 * Example module.
 */
class MyParsing extends ControllerBase {
  public function content($id) {
    $art_id = $id-1;
    $uri_to_site = "https://jsonplaceholder.typicode.com/posts/";
    $uri_to_post = $uri_to_site.$id;
    
  
    try {
      $resp_from_site = \Drupal::httpClient()->get($uri_to_post, array('headers' => array('Accept' => 'application/json')));
      $data_from_site = $resp_from_site->getBody();
      $rendered = Json::decode($data_from_site);

      $rows_block = [];
      $rows_block[$art_id] = [
        'userId' => $rendered['userId'],
        'id' => $rendered['id'],
        'title' => $rendered['title'],
        'body' => $rendered['body'],
      ];
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
        // kint($link1);
        // die();
      }
      catch (RequestException $build_article) {
        watchdog_exception('content', $build_article);
      }
        // if ART_ID <=0 then will open full list of articles
      if ($art_id<=0) {
        $uri = "https://jsonplaceholder.typicode.com/posts";
        try {
          $response = \Drupal::httpClient()->get($uri, array('headers' => array('Accept' => 'application/json')));
          $data = $response->getBody();
          if (empty($data)) {
              drupal_set_message('Empty response.');
          } 
          else{
            $rend = Json::decode($data);
            $rows = [];
            $n=0;
            foreach ($rend as $mass) {
            $n++;
              $rows[] = [
                'userId' => $mass['userId'],
                'id' => $mass['id'],
                'title' => $mass['title'],
                'body' => $mass['body'],
                'link' => $link = Link::fromTextAndUrl($mass['id'], Url::fromRoute('my_parsing.content', ['id' => $mass['id']]))
              ];
            }
            $header = [
              'userId' => t('User id'),
              'id' => t('Art ID'),
              'title' => t('Title'),
              'body' => t('Body'),
              'uri' => t('Link'),
            ];
            $build['table_pager'][] = [
              '#header' => $header,
              '#type' => 'table',
              '#rows' => $rows,
            ];
                // kint($rend);
                // die();
            $times = [
              '#theme' => 'my_parsing',
              '#header' => $header,
              '#rows' => $rows,
            ];

            return $times;
            kint($times);
            die();
          }
        }
        catch (RequestException $build) {
          watchdog_exception('my_parsing', $build);
        }
      } 
      else{
        return $build_article;
      }
    }
  }
