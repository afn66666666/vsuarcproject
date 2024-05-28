<?php


final class Connection
{
	private static $instance = null;
	private $dto;
    /**
     * Подключение к базе данных и возврат экземпляра объекта \PDO
     * @return \PDO
     * @throws \Exception
     */
    public function connect()
    {
         
        return $this->pdo;
    }
 
    public static function get()
    {
       if (self::$instance === null) {
            self::$instance = new Connection();
        }

        return self::$instance;
    }

    protected function __construct()
    {
$params = parse_ini_file('database.ini');
        if ($params === false) {

            throw new Exception("Error reading database configuration file");
        }
        // подключение к базе данных postgresql
        $conStr = sprintf(
            "pgsql:host=%s;port=%d;dbname=%s;user=%s;password=%s",
            $params['host'],
            $params['port'],
            $params['database'],
            $params['user'],
            $params['password']
        );

        $this->pdo = new PDO($conStr);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}