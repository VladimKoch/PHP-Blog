<?php

/**
 * Formát času
 */

 function formatDate($date){
    return date ('F j, Y, g:j a', strtotime($date));
 }


 /**
  * Kratší text
  */

  function shortenText($text, $chars=200){
    $text = $text . " ";
    $text = substr($text, 0, $chars);
    $text = substr($text, 0, strrpos($text,' '));
    $text = $text . "...";

    return $text;

  };



  ?>