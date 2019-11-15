<?php

class User extends Db_object {

  protected static $db_table = 'users';
  protected static $db_table_field = array('username', 'password', 'first_name','last_name','user_image');
  public $id;
  public $username;
  public $password;
  public $first_name;
  public $last_name;
  public $user_image;
  public $upload_directory = "images";
  public $image_placeholder = "https://via.placeholder.com/150/0000FF/808080 ?Text=Digital.com

  C/O https://placeholder.com/";
  

  public function image_path_and_placeholder() {
    return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory.DS.$this->user_image;  //images/['user_image'];
  }

  // file upload korar jonno function
  public function set_file($file){
    if(empty($file) || !$file || !is_array($file)) {
      $this->errors[] = "There was no file uploaded here";
      return false;

    }elseif ($file['error'] != 0) {
      $this->errors[] = $this->upload_errors_array[$file['error']];
      return false;

    }else {
      $this->user_image = basename($file['name']);
			$this->tmp_path = $file['tmp_name'];
			$this->type = $file['type'];
			$this->size = $file['size'];
     
    }
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



  public function save_user_and_image() {
    
    if($this->id){
      $target_path =  SITE_ROOT.DS.'admin'.DS.$this->upload_directory.DS.$this->user_image;
      if(move_uploaded_file(isset($this->tmp_path), $target_path)) {
        unset($this->tmp_path);
      }
      return $this->update();
    }else{
      if(!empty($this->errors)){
        return false;

      } if(empty($this->user_image) || empty($this->tmp_path)) {
        $this->errors[] = "the file is not available";
          return false;
      }

      $target_path =  SITE_ROOT.DS.'admin'.DS.$this->upload_directory.DS.$this->user_image;

      if(move_uploaded_file($this->tmp_path, $target_path)) {
        if($this->create()) {
          unset($this->tmp_path);
          return true;
        }
      }else {
        $this->errors[] = "The file directory doesnot have write f permission";
        return false;
      }
    }
  }


  
  public static function verify_user($username, $password) {
    global $database;

    $username = $database->escape_string($username);
    $password = $database->escape_string($password);

    $sql = "SELECT * FROM " . static::$db_table . " WHERE ";
    $sql .= "username = '{$username}' ";
    $sql .= "AND password = '{$password}' ";
    $sql .= "LIMIT 1";

    $the_result_array = static::find_by_query($sql);
    return !empty($the_result_array) ? array_shift($the_result_array) : false;
  }

}

?>