<?php
// connect to database
$pdo = DB::connect();

class DB{

    public static function connect() {
        // database server information
        $db_server = '127.0.0.1';       // 127.0.0.1 로 하면 localhost 보다 훨씬 빠름 why??
        $db_dbname = 'crudboardsite';
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

        $query = trim($query);  // 맨 끝 공백 제거
        if(trim(explode(' ', $query)[0]) == "SELECT") { // "SELECT " 이러면 인식 안되므로 한번 더 trim
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