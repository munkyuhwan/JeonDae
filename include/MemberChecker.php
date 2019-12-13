<?php

class MemberChecker
{

    var $gconnet;
    function __construct($gconnet)
    {
        $this -> gconnet = $gconnet;
    }

    function checkMember() {

        $checkMem = $_SESSION['user_access_idx'];


        if ($checkMem == "" || $checkMem == null  ) {
            return false;
        }else {
            $memberCheckQuery = "SELECT idx FROM member_info WHERE idx=($checkMem)";
            $memberCheckResult = mysqli_query($this->gconnet, $memberCheckQuery);
            $memberCheckRow = mysqli_fetch_assoc($memberCheckResult);

            if ($memberCheckRow) {
                return true;
            }else {
                session_unset();
                unset($_SESSION);
                return false;
            }

        }

    }

}

?>