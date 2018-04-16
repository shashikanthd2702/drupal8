<?php

namespace Drupal\lotus\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Drupal\user\Entity\User;
/**
 * Class LotusController.
 *
 * @package Drupal\lotus\Controller
 */
class LotusController extends ControllerBase {

  /**
   * Hello.
   *
   * @return string
   *   Return Hello string.
   */
  public function hello($count,$second_count) {

    return [
      '#type' => 'markup',
      '#markup' => $this->t('You will get %count% discount If you purchase %second_count items!!', array('%count' => $count, '%second_count' => $second_count )),
    ];
}

public function content(){

		return array(
			'#theme' => 'lotus_template',
			'#test_var' => $this->t('Test value'),
			'#test_var2' => $this->t('Test value overridden'),
		);
}
  
  
 function create_new_user(){

  $user = User::create();

  //Mandatory settings
  $user->setPassword('admin123');
  $user->enforceIsNew();
  $user->setEmail('shashishaiva27@gmail.com');

  //This username must be unique and accept only a-Z,0-9, - _ @ .
  $user->setUsername('shashishaiva27'); 
  
  //add role to user
  $user->addRole('moderated');

  //Optional settings
  $language = 'en';
  $user->set("init", 'email');
  $user->set("langcode", $language);
  $user->set("preferred_langcode", $language);
  $user->set("preferred_admin_langcode", $language);
  $user->activate();

  //Save user
  $user->save();
  drupal_set_message("User with uid " . $user->id() . " saved!\n");
 return $this->redirect('<front>');
}


function update_user($uid = ''){
/* 	 Updating a user is a three step process:
 1) load the user object to change
 2) set property/field to new value
 3) Save the user object.
 */
/*  This example updates:
1) password
2) email
3) login
4) a plain text field. */

// $uid is the user id of the user user update
$user = \Drupal\user\Entity\User::load($uid);
//print_r($user); die;
// Example 1: password
		/* $user->setPassword($password); // string $password: The new unhashed password. */
// Don't for get to save the user, we'll do that at the very end of code.

// Example 2: email
		/* $user->setEmail($mail); // string $mail: The new email address of the user. */

// Example 3: username
$user->setUsername("shashikanthd2702"); // string $username: The new user name.

// Example 4: a plain text field
// Get a value to change. field_example_string_to_concatenate is the full machine name of the field.
		/* $long_string = $user->get('field_example_string_to_concatenate')->value;
		$long_string = $long_string . "qwerty"; */

// Set the field value new value.
		/* $user->set('field_example_string_to_concatenate', $long_string); */

// The crucial part! Save the $user object, else changes won't persist.
$user->save();

  drupal_set_message("User with uid " . $uid . " has been modified!\n");
 return $this->redirect('<front>');
// Congratulations you have updated a user!
}

function create_node() {
	$node = Node::create(['type' => 'article']);
$node->set('title', 'Lotus title');

//Body can now be an array with a value and a format.
//If body field exists.
$body = [
'value' => 'Lorem Ipsum Sample Text', 
'format' => 'basic_html',
];
$node->set('body', $body);
$node->set('uid', 1);
$node->status = 1;
$node->enforceIsNew();
$node->save();

drupal_set_message( "Node with nid " . $node->id() . " saved!\n");
 return $this->redirect('<front>');

}

function create_taxanomy() {
$new_term = \Drupal\taxonomy\Entity\Term::create([
          'vid' => 'lotus',
          'name' => 'lotus term name',
    ]);

$new_term->enforceIsNew();
$new_term->save();
drupal_set_message("Taxonomy term has beeen saved!\n");	
return $this->redirect('<front>');
}




/*-------------------End of class-----------------------*/

}