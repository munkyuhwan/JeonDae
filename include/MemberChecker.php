<?php

class MemberChecker
{

    var $gconnet;
    function __construct($gconnet)
    {
        $this -> gconnet = $gconnet;
    }

    function checkMember() {

        $memberIdx= $_SESSION['user_access_idx'];
        $checkResponse = true;
        if ($memberIdx != "") {
            $memberCheckResult = "SELECT idx FROM member_info WHERE idx=" . $memberIdx;
            $memberCheckResult = mysqli_query($this->gconnet, $memberCheckResult);
            if ($memberCheckResult) {
                $checkResponse = true;
            }else {
                $checkResponse = false;
            }
        }else {
            $checkResponse = false;
        }

        return $checkResponse;

    }


}






?>