<?php

function admin($rol){
    if($rol != 'admin'){
        return true;
    }else{
        return false;
    }
}
