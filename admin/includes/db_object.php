<?php

  class Db_object {

    public $upload_errors_array = array(
      UPLOAD_ERR_OK          => "There is no error",
      UPLOAD_ERR_INI_SIZE    => "The uploaded file exceeds",
      UPLOAD_ERR_FORM_SIZE   => "The uploaded file exceeds the MAX_FILE_SIZE",
      UPLOAD_ERR_PARTIAL     => "The uploaded file was only partially uploaded",
      UPLOAD_ERR_NO_FILE     => "No file was uploaded",
      UPLOAD_ERR_NO_TMP_DIR  => "Missing a temporary folder",
      UPLOAD_ERR_CANT_WRITE  => "Failed to write file to disk",
      UPLOAD_ERR_EXTENSION   => "A PHP extension stopped the file upload"
    );
    
    //protected static $db_table = 'users';


    public static function find_all(){
      return static::find_by_query("SELECT * FROM " . static::$db_table);
    }
  
    
    // object return kore
    public static function find_by_id($id){
      global $database;
      
      $result_set_array = static::find_by_query("SELECT * FROM " . static::$db_table . " WHERE id = {$id} LIMIT 1");
      
      return !empty($result_set_array) ? array_shift($result_set_array) : false;
    }


    public static function find_by_query($sql) {
      global $database;
  
      $result_set = $database->query($sql);
      
      if(empty($result_set)) { return false; };

      $the_object_array = array();
      
      while($row = mysqli_fetch_array($result_set)){
        $the_object_array[] = static::instantation($row);
      }
  
      return $the_object_array;
    }


    public static function instantation($the_record){

      // late static binding
      $calling_class = get_called_class();
      $the_object = new $calling_class;
      
      // $the_object->id =  $found_user ["id"];
      // $the_object->username =  $found_user["username"];
      // $the_object->password =  $found_user["password"];
      // $the_object->first_name =  $found_user["first_name"];
      // $the_object->last_name =  $found_user["last_name"];
      
      foreach($the_record as $the_attribute => $value) {
        if($the_object->has_the_attribute($the_attribute)){
          $the_object->$the_attribute = $value;
        }
      }
  
      return $the_object;
    }
  

    public function has_the_attribute($the_attribute){
      $object_properties = get_object_vars($this);
      return array_key_exists($the_attribute, $object_properties);
    }




    //pull all properties
    protected function properties(){
      // return get_object_vars($this);
      $properties = array();
      foreach(static::$db_table_field as $db_field) {
        if(property_exists($this, $db_field)) {
          $properties[$db_field] = $this->$db_field;
        }
      }
      return $properties;
    }


    // clean 
    protected function clean_properties() {
      global $database;
      $clean_properties = array();

      foreach($this->properties() as $key => $value) {
        $clean_properties[$key] = $database->escape_string($value);
      }
      return $clean_properties;
    }


    public function save() {
      return isset($this->id) ? $this->update() : $this->create();
    }


    //create
    public function create() {
      global $database;
      $properties = $this->clean_properties();

      unset($properties['id']); //ekhane clear? na 

      $sql = "INSERT INTO " .static::$db_table . " (". implode(",", array_keys($properties))  .")";
      $sql .= " VALUES ('". implode("','", array_values($properties)) . "')";

      if($database->query($sql)) {
        $this->id = $database->the_insert_id();
        return true;
      }else {
        return false;
      }
    }


    // update
    public function update(){
      global $database;
      $properties = $this->clean_properties();

      $properties_pair = array();
      
      foreach($properties as $key => $value){
        $properties_pair[] = "$key = '$value'";
      }


      // *** bujte hobe
      $sql = "UPDATE " .static::$db_table. " SET ";
      $sql .= implode(", ", $properties_pair)." ";
      $sql .= "WHERE id =" . $database->escape_string($this->id);
      
      $database->query($sql);

      dd(mysql_client_encoding($database->connection));
      return (mysqli_affected_rows($database->connection)) ? true : false;
    }


    //delete
    public function delete(){
      global $database;

      $sql = "DELETE FROM " .static::$db_table. " ";
      $sql .= "WHERE id= " .$database->escape_string($this->id);
      
      $database->query($sql);
      return (mysqli_affected_rows($database->connection) === 1) ? true : false;
    }


    public static function count_all(){
      global $database;

      $sql = "SELECT COUNT(*) FROM ". static::$db_table;
      $result_set = $database->query($sql);
      $row = mysqli_fetch_array($result_set);
      return array_shift($row);
    }

  }


?>