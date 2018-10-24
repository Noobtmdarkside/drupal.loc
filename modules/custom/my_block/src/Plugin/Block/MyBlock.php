<?php
/**
 * @file
 * Contains \Drupal\custom_block\Plugin\Block\MyBlock.
 */

namespace Drupal\my_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\user\Entity\User;

/**
 * Provides a My Block.
 *
 * @Block(
 *   id = "my_block",
 *   admin_label = @Translation("MyBlock1"),
 *   category = @Translation("time block")
 * )
 */
class MyBlock extends BlockBase
{
  /**
   * {@inheritdoc}
  */
  public function build() {
    $query = \Drupal::entityQuery('user');
    $query->condition('status', 1);
    $query->sort('access', 'ASC');
    $query->range(0, 3);
    $entity_ids = $query -> execute();
    $user_list = \Drupal::entityTypeManager()->getStorage('user')->loadMultiple($entity_ids);
          
    $rows = [];
    $n=0;
      foreach ($user_list as $allusers){
        $n++;
        $rows[] = [
          'onlinename' => $allusers -> get('name') ->value,
          'onlinetime' => date('H:i:s Y-m-d',$allusers->get('access')->value),
        ];
      }
    $header[] = [
      $onlinenameheader = t('Name'),
      $onlinetimeheader = t('Last loggin in'),
    ];
    $build['table_pager'][] = [  
      '#header' => $header,
      '#type' => 'table',
      '#rows' => $rows,
      '#empty' => t('No users found!'),
    ];
    $curr_data = \Drupal::time()->getCurrentTime();
    $user_data = \Drupal::currentUser()->getLastAccessedTime();
    $user_name = \Drupal::currentUser()->getUsername();       
      
    $time = [
      '#theme' => 'my_block',
      '#curr_data' => date('H:i:s Y-m-d', $curr_data),
      '#user_data' => date('H:i:s Y-m-d', $user_data),
      '#user_name' => $user_name,
      '#header' => $header,
      '#rows' => $rows,
      '#onlinenameheader' => $onlinenameheader,
      '#onlinetimeheader' => $onlinetimeheader,
    ];
    return $time;
  }
  /**
   * {@inheritdoc}
   */
  public function getCacheMaxAge() {
    return 0;
  }
}