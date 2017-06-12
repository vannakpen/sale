<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if ( ! function_exists('status_string')){
   function status_string($status = 1){
       $ci =& get_instance();
       if($status == 1){
           return $ci->lang->line('lab_status_active');
       }else if($status == 0){
           return $ci->lang->line('lab_status_deactive');
       }else{
           return $status;
       }
   }
}

if ( ! function_exists('item_type_string')){
   function item_type_string($type = 1){
       $ci =& get_instance();
       if($type == 1){
           return $ci->lang->line('lab_inventories');
       }else if($type == 0){
           return $ci->lang->line('lab_services');
       }else{
           return $type;
       }
   }
}
