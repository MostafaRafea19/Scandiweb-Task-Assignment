<?php

class DB
{
    public static function connect(): PDO
    {
        $connection = new PDO("mysql:host=ro2padgkirvcf55m.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;dbname=mp33mt50suwgvch2", "le4pqm7wwoqbo3rl", "m6yy7wq8d7fkvapa");
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
