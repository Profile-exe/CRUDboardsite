<?php
// connect to database
$pdo = DB::connect();

class DB{

    public static function connect() {
        // database server information
        $db_server = '127.0.0.1';       // 127.0.0.1 로 하면 졸라빠름 왜지 ??
        $db_dbname = 'opentutorials';
        $db_username = 'root';
        $db_password = '111111';

        try {
            $pdo = new PDO('mysql:host='.$db_server.';dbname='.$db_dbname.';charset=utf8;', $db_username, $db_password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;
        } catch(PDOException $e) {
            echo "Database connection failed.";
        }
        return null;
    }

    public static function query($query, $params = array()) {
        $statement = self::connect()->prepare($query);
        $statement->execute($params);
        $errorinfo = $statement->errorInfo();

        if(explode(' ', $query)[0] == "SELECT") {
            return $statement->fetchAll();
        } else {
            echo $errorinfo[2];
            return $statement->rowCount();
        }
    }

    public static function getRowCount($table) {
        $statement = self::connect()->prepare('SELECT * FROM ' . $table);
        $statement->execute();
        $result = $statement->fetchAll();
        return $statement->rowCount();
    }

    public static function getFilteredRowCount($query) {
        $statement = self::connect()->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        return $statement->rowCount();
    }
}
?>