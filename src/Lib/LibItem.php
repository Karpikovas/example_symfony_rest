<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13.08.2019
 * Time: 15:31
 */

namespace App\Lib;


class LibItem
{
  private $Db;

  public function __construct(LibDB $Db)
  {
    $this->Db = $Db;
  }

  public function getItemsList(): array
  {

    $items = $this->Db->select('SELECT * FROM item;');
    return $items;
  }

  public function getItemByID(int $itemID): array
  {
    $params = [
        $itemID
    ];
    $item = $this->Db->select('SELECT * FROM item WHERE id = ?;', $params);
    return $item;
  }

  public function addItem(string $name, string $secondName, string $patr, string $birthday)
  {
    $params = [
        $name,
        $secondName,
        $patr,
        $birthday
    ];
    $this->Db->exec('INSERT INTO item (name, secondname, patr, birthday) VALUES (?, ?, ?, ?);', $params);
  }

  public function deleteItemByID(int $itemID): void
  {
    $params = [
        $itemID
    ];
    $this->Db->exec('DELETE FROM item WHERE id = ?;', $params);
  }

  public function checkName(string $name): bool
  {
    if (!preg_match('/^[a-z]{5,20}$/', $name)) {
      return false;
    }
    return true;
  }

  public function checkSecondName(string $secondName): bool
  {
    if (!preg_match('/^[a-z]{5,20}$/', $secondName)) {
      return false;
    }
    return true;
  }

  public function checkPatr(string $patr): bool
  {
    if (!preg_match('/^[a-z]{5,20}$/', $patr)) {
      return false;
    }
    return true;
  }

  public function checkBirthday(string $birthday): bool
  {
    if (!strlen($birthday)) {
      return false;
    }
    return true;
  }
}
