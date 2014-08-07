Encryptor
=========

PHP password encryption class. 

Allows for easy integration of the crypt function, using Blowfish and SHA-256 algorithms.

The class provides the unique salt and hash in a object variable for easy access to store in DB.

Included is the Decryptor class which takes the users password input and unique salt and returns the hash.

This allows you to check the hash from Decryptor with the hash from the initial encryption that you have stored to see if it is a match.

Example Use:

//Encryptor

$hash_enc = new Encryptor("mypassword",10,"BLOWFISH");

$hash = $hash_enc->hash;

$salt = $hash_enc->salt;

//Decryptor

$hash_dec = new Decryptor("mypassword",$salt);

$hash_compare = $hash_dec->result;
