<?php



try {
  $dsn = "mysql:host=192.168.56.40;port=3306;dbname=site1";
  $db = new PDO($dsn,'site_user', 'qwe$123456');
} catch (PDOException $e) {
  echo 'Подключение не удалось: ' . $e->getMessage();
}

$stmt = $db->prepare('select * from table1');
$stmt->execute();
$items = $stmt->fetchAll();
print_r($items);
