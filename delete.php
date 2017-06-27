<?php
    $con = mysql_connect('localhost','root','8876');
     
    $id = $_GET['id'];
    mysql_select_db('mail');
    mysql_query("set names utf8");    
   
    if(mysql_query("DELETE FROM `information` WHERE `id` = '$id'")){
        echo "<script>
                if(window.confirm('删除?'))
                {  
                    return true;
                }else{
                    return false;
                }

                history.back();
                </script>";
    }
?>