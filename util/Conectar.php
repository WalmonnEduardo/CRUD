<?php
require_once(__DIR__."/../config/config.php");
class Conectar
{
    private static string $host = DB_HOST;
    private static string $name = DB_NAME;
    private static string $user = DB_USER;
    private static string $pass = DB_PASS;
    private static ?PDO $conn = null;

    public static function getConexao()
    {
        if(self::$conn == null)
        {
            try
            {
                $opcoes = array(//Define o charset da conexão
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                    //Define o tipo do erro como exceção 
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    //Define o tipo do retorno das consultas como array associativo
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);

                //Cria a conexão...
                $strConn = "mysql:host=" . self::$host . ";dbname=" . self::$name;
                self::$conn = new PDO($strConn, self::$user, self::$pass , $opcoes);
            }
            catch(PDOException $e)
            {
                echo "Erro ao conectar na base de dados.<br>";
                print_r($e);
            }
        }
        return self::$conn;
    }
}
?>