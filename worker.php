<?php 
class Worker{
    var $pkid;// id from db
    var $email; //username
    var $password;// password

    //constructor בנאי
    function Worker( $cpkid, $cemail, $cpassword){
        $this->pkid = $cpkid; // id from db
        $this->email = $cemail;// email
        $this->password = $cpassword;// password
    }
}

?>