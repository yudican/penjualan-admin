<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('alert'))
{
    function alert($msg,$type='danger')
    {
      $alert = '<div class="alert alert-'.$type.'" role="alert">
                 '.$msg.'
                </div>';

      return $msg ? $alert : '';
    }   
}
if ( ! function_exists('error'))
{
    function error($msg)
    {
      $status = "";
      $status = $msg ? '<small class="text-danger">'.$msg.'</small>' : '';
      

      return $status;
    }   
}
if ( ! function_exists('error_border'))
{
    function error_border($error)
    {
      $result = "";
      $result = $error ? 'style="border: 1px solid red;"' : 'style="border: 1px solid green;"';
      return $result;
    }   
}