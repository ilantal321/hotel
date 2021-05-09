<?php 
class Room{
    var $pkid;
    var $state;
    var $gid;
    var $type;

    //constructor בנאי
    function Room( $id, $cstate, $cgpkid, $ctype){
        $this->pkid = $id; // room id from db
        $this->state = $cstate; // full or empty
        $this->gid = $cgpkid;// guest id
        $this->type = $ctype;// s,p,r
    }
}

?>