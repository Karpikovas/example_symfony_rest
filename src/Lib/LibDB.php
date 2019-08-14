<?php


namespace App\Lib;



use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;


use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\DriverManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use PDO;

class LibDB
{
    private $params;
    private $connection;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    private function testInitConnection() {
        if (!$this->connection) {
            $dsn = "mysql:host={$this->params->get('DATABASE_HOST')};dbname={$this->params->get('DATABASE_NAME')}";
            $db = new PDO($dsn, $this->params->get('DATABASE_USER'), $this->params->get('DATABASE_PASSWORD'));
            $db->exec("set names utf8");
            $this->connection = $db;
        }
    }

    protected function prepareParam($param) {
        if (is_int($param)) {
            $type = PDO::PARAM_INT;
        } elseif (is_bool($param)) {
            $type = PDO::PARAM_BOOL;
        } else {
            $type = PDO::PARAM_STR;
        }
        return $type;
    }

    public function select(string $sql, array $params = []): array {
        $this->testInitConnection();
        $stmt = $this->connection->prepare($sql);
        foreach ($params as $key => $paramArray) {
            foreach ($paramArray as $param)
            {
                $stmt->bindParam($key + 1, $param, $this->prepareParam($param));
            }
        }
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $data;
    }

}
