<?php

class DB
{
    public static function connect(): PDO
    {
        $connection = new PDO("mysql:host=c8u4r7fp8i8qaniw.chr7pe7iynqr.eu-west-1.rds.amazonaws.com;dbname=nx6traoz8zq8wz64", "zzq7loavdinefjmx", "uo40426q9xlvuh49");
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connection;
    }

    public static function query($query, $params = [])
    {
        $statement = self::connect()->prepare($query);
        $check = $statement->execute($params);

        if (explode(' ', $query)[0] == "SELECT") {
            return $statement->fetchAll();
        } else {
            return $check;
        }
    }
}
