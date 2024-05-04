<?php

class add_to_stock{
    
    function addStock($fid,$qty='',$unit='',$price=''){
        $fid = trim($fid);
        if($fid != ''){
            $_SESSION['stock'][$fid]['qty']=$qty;
            $_SESSION['stock'][$fid]['unit']=$unit;
            $_SESSION['stock'][$fid]['price']=$price;
        }
    }

    function updateStockQt($fid,$qty,$unit=''){
        if(isset($_SESSION['stock'][$fid])){
            $_SESSION['stock'][$fid]['qty']=$qty;
            $_SESSION['stock'][$fid]['unit']=$unit;
        }
    }

    function updateStockUnit($fid,$unit){
        if(isset($_SESSION['stock'][$fid])){
            $_SESSION['stock'][$fid]['unit']=$unit;
        }
    }

    function updateStockPrice($fid,$price){
        if(isset($_SESSION['stock'][$fid])){
            $_SESSION['stock'][$fid]['price']=$price;
        }
    }

    function removeStock($fid){
        if(isset($_SESSION['stock'][$fid])){
            unset($_SESSION['stock'][$fid]);
        }
    }
    function emptyStock(){
        unset($_SESSION['stock']);
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