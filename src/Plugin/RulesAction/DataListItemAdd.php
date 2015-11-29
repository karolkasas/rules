<?php

/**
 * @file
 * Contains \Drupal\rules\Plugin\RulesAction\DataListItemAdd.
 */

namespace Drupal\rules\Plugin\RulesAction;

use Drupal\rules\Core\RulesActionBase;

/**
 * Provides an 'Add list item' action.
 *
 * @RulesAction(
 *   id = "rules_list_item_add",
 *   label = @Translation("Add list item"),
 *   category = @Translation("Data"),
 *   context = {
 *     "list" = @ContextDefinition("list",
 *       label = @Translation("List"),
 *       description = @Translation("The data list, to which an item is to be added.")
 *     ),
 *     "item" = @ContextDefinition("any",
 *       label = @Translation("Item"),
 *       description = @Translation("Item to add.")
 *     ),
 *     "unique" = @ContextDefinition("boolean",
 *       label = @Translation("Enforce uniqueness"),
 *       description = @Translation("Only add the item to the list if it is not yet contained."),
 *       required = FALSE
 *     ),
 *     "pos" = @ContextDefinition("string",
 *       label = @Translation("Insert position"),
 *       description = @Translation("Position to insert the item."),
 *       required = FALSE
 *     )
 *   }
 * )
 *
 * @todo: Add access callback information from Drupal 7?
 * @todo: set ContextDefinition restriction
 */
class DataListItemAdd extends RulesActionBase {

  /**
   * Executes the Plugin.
   *
   * @param array $list
   *   An array to add an item to.
   * @param mixed $item
   *   An item which is being added to the array.
   * @param bool $unique
   *   A boolean value which indicates if the item should be updated if it is
   *   already in the list array.
   * @param string $pos
   *   Position in array where the item is being added.
   */
  protected function doExecute($list, $item, $unique, $pos) {
    $position = ($pos ? $pos : 'end');
    // Optionally, only add the list item if it is not yet contained.
    if (!((bool) $unique && in_array($item, $list))) {
      if ($position === 'start') {
        array_unshift($list, $item);
      }
      else {
        $list[] = $item;
      }
    }
    $this->setContextValue('list', $list);
  }

}
