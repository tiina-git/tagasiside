<?php 
class Db {
    private $con;
    function __construct() {
        date_default_timezone_set('Europe/Tallinn');
        $this->con = new mysqli(DB_SERVER,DB_USER,DB_PASS, DB_NAME);
        if($this->con->connect_errno){
            echo "<strong>Viga andmebaasiga:</strong> ".$this->con->connect_errno;
        
        }else{
            mysqli_set_charset($this->con,"utf8");
            mysqli_query($this->con, "SET time_zone = '+02:00'");
        }
    }

    function dbQuery($sql){
        if($this->con){
            $res = mysqli_query($this->con, $sql);
            if($res == false){
                echo "<div>Vigane päring: " .htmlspecialchars($sql). "</div>";
                return false;
            }
            return $res;
        }
        return false;
    }

    function prepareQuery($sql, $types, $params) {
        if($this->con) {
            $stmt = $this->con->prepare($sql);
            if($stmt === false) {
                echo "<div>Vigane päring: " . htmlspecialchars($sql) . "</div>";
                return false;
            }
            $stmt->bind_param($types, ...$params);
            $result = $stmt->execute();
            $stmt->close();
            return $result;
        }
        return false;
    }

    function prepareGetArray($sql, $types = null, $params = []) {
        if($this->con) {
            $stmt = $this->con->prepare($sql);
            if($stmt === false) {
                echo "<div>Vigane päring: " . htmlspecialchars($sql) . "</div>";
                return false;
            }
            if($types && $params) {
                if($types && $params) {
                    $stmt->bind_param($types, ...$params);
                }
            }
            $stmt->execute();
            $result = $stmt->get_result();
            $data = [];
            while($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $stmt->close();
            return !empty($data) ? $data : false;
        }
        return false;
    }

    function dbGetArray($sql){
        $res = $this->dbQuery($sql);
        if($res!== false){
            $data = array();
            while($row=mysqli_fetch_assoc($res)){
                $data[] = $row;
            }
            return (!empty($data)) ? $data : false;
        }
        return false;
    }

    function getVar(string $name, ?string $method = null) {
        if($method === 'post'){
            return $_POST[$name] ?? null;

        }elseif($method === 'get'){
            return $_GET[$name] ?? null;
        }else {
            return $_POST[$name] ?? $_GET[$name] ?? null;
        }
    }

    function dbFix($var) {
        if(!$this->con || !($this->con instanceof mysqli)) {
            return 'NULL';
        }

        if (is_null($var)) {
            return 'NULL';
        }elseif (is_bool($var)){
            return $var ? '1' : '0';

        }elseif (is_numeric($var)){
            return $var;
        }else{
            return $this->con->real_escape_string($var);
        }
    }

    function show($array) {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }

    function htmlValue(string $name, array $source){
        if(isset($source[$name])){
            return 'value="'. htmlspecialchars($source[$name], ENT_QUOTES) .'"';
        }
        return '';
    }

    function htmlTextContent(string $name, array $source) : string {
        return isset($source[$name]) ? htmlspecialchars($source[$name], ENT_QUOTES): "";
    }

}
?>