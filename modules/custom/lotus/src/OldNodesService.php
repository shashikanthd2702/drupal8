<?php

namespace Drupal\lotus;

use Drupal\Core\Entity\EntityTypeManager;

class OldNodesService {

  protected $entityTypeManager;

  public function __construct(EntityTypeManager $entity_type_manager) {
    $this->entityTypeManager = $entity_type_manager;
  }

  public function load() {
    $storage = $this->entityTypeManager->getStorage('node');
    $query = $storage->getQuery()
      ->condition('created', strtotime('-3 days'), '>');
    $nids = $query->execute();
    return $storage->loadMultiple($nids);
  }

}