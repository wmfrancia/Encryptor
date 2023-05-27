<?php

/*
Developed by wmfrancia | github.com/wmfrancia
Encryptor, is a simple class to securely and easily implement the crypt function. 
It allows for easy storing of salts and hash to your database all while keeping each completely unique to the user.
Currently Supports SHA256 and Blowfish 

*/

class Encryptor{
    
    public $hash;  //Completed Hash to store in DB for user
    public $salt; //Unique SALT to store in DB for user
    
    //Defaults to 10 rounds and Blowfish
    //(Password,Number of Rounds,Algorithm)
    function __construct($password,$rounds = 10,$type = "BLOWFISH") {
        
        $salt = $this->saltor($rounds,$type);
        $hash = $this->hashor($password,$salt);
        
        $this->hash = $hash;
        $this->salt = $salt;
        
    }
    function saltor($rnds,$type) {
        
        $rand_num = base64_encode(random_bytes(22));
        
        if($type == "SHA256") {
            
           $prefix = '$5$rounds='.$rnds.'$';
           
            
        }
        else {
            
            $rand_num = str_replace("+","o",$rand_num);  //fixes issue with '+' symbols and blowfish
            $prefix = '$2a$'.$rnds.'$';
           
        }
        
        $salt = $prefix.$rand_num."$";
        
        return $salt;
    
    }
    function hashor($password,$salt) {
        
        $hash = crypt($password,$salt);
        return $hash;
    
    }
}
class Decryptor{
    
    public $result;
    
    function __construct($input,$salt) {
        
        $this->result = crypt($input,$salt);
        
    }
    
}

?>
