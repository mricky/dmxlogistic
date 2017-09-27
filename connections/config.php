<?php



define("GALLERIES","galleries");

function base_url($url="")

{

    return "http://sim.dmxlogistic.com/".$url;

}

function upload_image_gallery($f_tmp, $f_target)

{

    #echo'<pre>oOo:: ';print_r(is_uploaded_file($_FILES['imagefile']['tmp_name']));echo'</pre>';

    #return FALSE;

    

    if(move_uploaded_file($f_tmp, $f_target))

    {

        return true;

    }

    

    return FALSE;

    

       

}

/* 

 * To change this license header, choose License Headers in Project Properties.

 * To change this template file, choose Tools | Templates

 * and open the template in the editor.

 */



