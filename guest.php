<?php 
class Guest{
    var $pkid;// id from db
    var $id;// user id
    var $email; //username
    var $password;// password
    var $charge;// charge form hotel
    var $pnumber;// phone number
    var $roomnumber;// room number

    //constructor בנאי
    function Guest( $cpkid, $cid, $cemail, $cpassword, $ccharge, $cpnumber, $croomnumber){
        $this->pkid = $cpkid; // id from db
        $this->id = $cid; // id
        $this->email = $cemail;// email
        $this->password = $cpassword;// password
        $this->charge = $ccharge; // money
        $this->pnumber = $cpnumber; // phone number to contect
        $this->roomnumber = $croomnumber;// guest id
    }
}

?>