<?php
/**
Plugin Name: Lightbox for Contact Form 7
Plugin URI: http://prettytheme.com/
Description: Shows Contact Form 7 in a fancy lightbox
Version: 0.1
Author: Shimion B.
Author URI: http://shimion.com/
License: GPLv2 or later
Text Domain: lightbox-for-contact-form-7
*/

define('cfl',__dir__.'/');
new cf7lightbox();
class cf7lightbox{
    public $ns;
    public $form_id;
    public $title;
    public $assets;
    public $data_type;
    public $id;
    
    public function __construct(){
        
       
          $this->assets = plugin_dir_url( __FILE__ ) . 'assets/';
		  $this->ns = 'cfl';
        $this->data_type = 'Inline';
        $this->ancor_text = 'Click The Form';
        wp_enqueue_style( 'fancybox.min', $this->assets . 'css/jquery.fancybox.min.css', array(), null, 'all' ); 
        wp_enqueue_script( 'fancybox.min', $this->assets . 'js/jquery.fancybox.min.js', array( 'jquery' ) , null);
         wp_enqueue_style( 'fancybox-style', $this->assets . 'css/fancybox-style.css', array(), null, 'all' );
          wp_enqueue_script( 'fancybox-script', $this->assets . 'js/fancybox-script.js', array( 'jquery', 'fancybox.min' ) , null); 
        
          add_shortcode('cf7lightbox', array($this, 'popup_contant_7'));
        
    }
    
        public function popup_contant_7($attr){
            $a = shortcode_atts(array('form_id'=>'', 'title'=>'', 'id' => ''), $attr);
            
            $this->form_id = !empty($a['form_id']) ? $a['form_id'] : '';
            $this->title = !empty($a['title']) ? $a['title'] : '';
             $this->ancor_text =  $this->title;
            $this->id = !empty($a['id']) ? $a['id'] : 'fancy_wapper_contact_form_7_'.$this->form_id;
            $this->data_type = !empty($a['data_type']) ? $a['data_type'] : 'Inline';
            $title = sprintf('<h3>%s</h3>', $this->title);
            return sprintf('<a data-fancybox data-src="#%s" href="javascript:;">%s</a><div id="%s" style="display: none;">%s%s</div>',  $this->id, $this->ancor_text, $this->id, $title, $this->form());
            

            
        }
    
    
    
    
    public function form(){
        return do_shortcode(' [contact-form-7 id="'.$this->form_id.'" title="'.$this->title.'"]');
    }
       
       
       

}