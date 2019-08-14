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
        $params[] = [
            $itemID
        ];
        $item = $this->Db->select('SELECT * FROM item WHERE id = ?;', $params);
//        $db = Db::getConnection();
//        $sql = $db->prepare('SELECT * FROM item WHERE id = :id');
//        $sql->bindParam(':id', $itemID, PDO::PARAM_INT);
//
//
//        $i = 0;
//        $sql->execute();
//        $item = array();
//        while ($row = $sql->fetch())
//        {
//            $item[$i]['id'] = $row['id'];
//            $item[$i]['name'] = $row['name'];
//            $item[$i]['secondname'] = $row['secondname'];
//            $item[$i]['patr'] = $row['patr'];
//            $item[$i]['birthday'] = $row['birthday'];
//            $i++;
//        }

        return $item;
    }
}
