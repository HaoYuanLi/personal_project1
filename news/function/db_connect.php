<?php
/**
 * Db_connect 連接資料庫
 * @author Hao-Yuang Li
 * @version 1.02
 */
class Db_connect {
    private $address;
    private $username;
    private $password;
    private $database;
    public $dbh;

    function __construct()
    {

    }

    private function database_connect($address, $username, $password, $database)
    {
        $this->address = $address;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        try
        {
            $dbh = new PDO("mysql:host=".$this->address.";charset=utf8mb4;dbname=".$this->database, $this->username, $this->password);
            //$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);//Suggested to uncomment on production websites
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//Suggested to comment on production websites
            $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
            $this->dbh = $dbh;
        }
        catch(PDOException $e)
        {
            //show error
            die('<p class="bg-danger">'.$e->getMessage().'</p>');
        }
    }

    protected function set_database($address, $username, $password, $database)
    {
        $this->database_connect($address, $username, $password, $database);
    }

    public function __destruct()
    {
        $this->dbh = NULL;
    }
}
?>
