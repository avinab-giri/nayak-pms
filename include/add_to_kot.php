<?php

class add_to_kot{
    
    function addkot($kpid,$qty,$note=''){
        $kpid = trim($kpid);
        if($kpid != ''){
            $_SESSION['kot'][$kpid]['qty']=$qty;
            $_SESSION['kot'][$kpid]['note']=$note;
        }
 
    }

    function updateKotQt($kpid,$qty){
        if(isset($_SESSION['kot'][$kpid])){
            $_SESSION['kot'][$kpid]['qty']=$qty;
        }
    }

    function removekot($kpid){
        if(isset($_SESSION['kot'][$kpid])){
            unset($_SESSION['kot'][$kpid]);
        }
    }
    function emptyKot(){
        unset($_SESSION['kot']);
    }
    function checkInDateUpdate($date,$date2,$key=''){
        $_SESSION['checkIn'] = $date;
        $_SESSION['checkout'] = $date2;

        foreach($_SESSION['room'] as $key => $val){
            $_SESSION['room'][$key]['checkIn'] = $date;
            $_SESSION['room'][$key]['checkout'] = $date2;
        }

        
    }
    function totalroom(){
        if(isset($_SESSION['room'])){
            return count($_SESSION['room']);
        }else{
            return 0;
        }
    }
}



?>