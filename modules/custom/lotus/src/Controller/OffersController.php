<?php

namespace Drupal\lotus\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
/**
 * Class OffersController.
 *
 * @package Drupal\lotus\Controller
 */
class OffersController extends ControllerBase {

  /**
   * Hello.
   *
   * @return string
   *   Return Hello string.
   */
  public function hello($count,$second_count) {

$node = Node::create(['type' => 'article']);
$node->set('title', 'Lotus title');

//Body can now be an array with a value and a format.
//If body field exists.
$body = [
'value' => 'YOUR_BODY_TEXT', 
'format' => 'basic_html',
];
$node->set('body', $body);
$node->set('uid', 1);
$node->status = 1;
$node->enforceIsNew();
$node->save();
$new_term = \Drupal\taxonomy\Entity\Term::create([
          'vid' => 'lotus',
          'name' => 'lotus term name',
    ]);

$new_term->enforceIsNew();
$new_term->save();
drupal_set_message("Taxonomy term has beeen saved!\n");
drupal_set_message( "Node with nid " . $node->id() . " saved!\n");

    return [
      '#type' => 'markup',
      '#markup' => $this->t('You will get %count% discount!!', array('%count' => $second_count)),
    ];
  }
  
}