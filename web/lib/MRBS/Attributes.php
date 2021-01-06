<?php
namespace MRBS;


abstract class Attributes extends TableIterator
{

  // Returns an array of role names indexed by id.
  abstract public function getNames();


  // Converts an array of ids to an array of names
  public static function idsToNames(array $ids)
  {
    static $names;

    if (!isset($names))
    {
      $instance = new static();
      $names = $instance->getNames();
    }

    $result = array();

    foreach ($ids as $id)
    {
      if (isset($names[$id]))
      {
        $result[] = $names[$id];
      }
      else
      {
        trigger_error("Id $id does not exist");
      }
    }

    sort($result, SORT_LOCALE_STRING | SORT_FLAG_CASE);

    return $result;
  }
}