<?php

namespace Drupal\content_entity_example\Entity\Controller;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Link;
use Drupal\Core\Routing\UrlGeneratorInterface;
use Drupal\image\Entity\ImageStyle;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a list controller for content_entity_example_contact entity.
 *
 * @ingroup content_entity_example
 */
class ContactListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   *
   * We override ::render() so that we can add our own content above the table.
   * parent::render() is where EntityListBuilder creates the table using our
   * buildHeader() and buildRow() implementations.
   */
  public function render() {
    $build['description'] = [
      '#markup' => $this->t('Content Entity Example implements a Contacts model. These contacts are fieldable entities. You can manage the fields on the <a href="@adminlink">Contacts admin page</a>.', array(
        '@adminlink' => \Drupal::urlGenerator()
          ->generateFromRoute('content_entity_example.contact_settings'),
      )),
    ];

    $build += parent::render();
    return $build;
  }

  /**
   * {@inheritdoc}
   *
   * Building the header and content lines for the contact list.
   *
   * Calling the parent::buildHeader() adds a column for the possible actions
   * and inserts the 'edit' and 'delete' links as defined for the entity type.
   */
  public function buildHeader() {
    $header['id'] = $this->t('ID');
    $header['persimage'] = $this->t('Image(ID)');
    $header['department'] = $this->t('Department');
    $header['short_info'] = $this->t('Short info');
    $header['age'] = $this->t('Age');
    $header['name'] = $this->t('Name');
    $header['title'] = $this->t('Link ');

    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\content_entity_example\Entity\Contact */
    $department = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->load($entity->get('departmets')->target_id);

    $row['id'] = $entity->id();
    $row['persimage'] = $entity->get('persimage')->target_id;
    $row['department'] = $department->getName();
    $row['short_info'] = $entity->short_info->value;
    $row['age'] = $entity->age->value;
    $row['name'] = $entity->name->value;
    $row['title'] = Link::createFromRoute($entity->title->value, 'entity.content_entity_example_contact.canonical', ['content_entity_example_contact' => $entity->id()]);

//    kint($row['title']);
//    die();

    return $row + parent::buildRow($entity);
  }

}
?>
