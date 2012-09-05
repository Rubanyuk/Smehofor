<?php
class veriWord extends CI_Controller {
    /* path to font directory*/
    var $dir_font;
    /* path to background image directory*/
    var $dir_noise;
    var $word       = ""; 
    var $im_width   = 0;
    var $im_height  = 0;
    
	function index()
	{
        $this->load->library('session');
        $this->dir_font   = $_SERVER['DOCUMENT_ROOT']."/images/ttf/";
    /* path to background image directory*/
        $this->dir_noise  = $_SERVER['DOCUMENT_ROOT']."/images/noises/"; 

        $this->set_veriword();
        
        $this->im_width         = 312;
        $this->im_height        = 138;      
        
        $this->output_image();
        $this->destroy_image();          

	}
    
    function set_veriword() {   
        /* create session variable for verification, 
           you may change the session variable name */
        $this->word             = $this->pick_word(); 
        $this->session->set_userdata(array('veriword'=>$this->word));  

    }

    function output_image() {
        /* output the image as jpeg */  
        $this->draw_image();
        header("Content-type: image/jpeg");
        imagejpeg($this->im);
    }

    function pick_word() 
	{
	
$base='ABCDEFGHKLMNOPQRSTWXYZabcdefghjkmnpqrstwxyz123456789';
$max=strlen($base)-1;
$vcode='';
for ($i = 0; $i <= 2; $i++)
	$vcode.=$base{mt_rand(0,$max)};
return $vcode;

    }   

    function draw_text() {        
        $dir = dir($this->dir_font);
        $fontstmp = array();
        while (false !== ($file = $dir->read())) {
            if(substr($file, -4) == '.ttf') {
                $fontstmp[] = $this->dir_font.$file;
            }
        }
        $dir->close();
        $text_font = (string) $fontstmp[array_rand($fontstmp)];

        /* angle for text inclination */
        $text_angle = rand(-9,9);
        /* initial text size */
        $text_size  = 25;
        /* calculate text width and height */
        $box        = imagettfbbox ( $text_size, $text_angle, $text_font, $this->word);
        $text_width = $box[2]-$box[0]; //text width
        $text_height= $box[5]-$box[3]; //text height

        /* adjust text size */
        $text_size  = round((15 * $this->im_width)/$text_width);  

        /* recalculate text width and height */
        $box        = imagettfbbox ( $text_size, $text_angle, $text_font, $this->word);
        $text_width = $box[2]-$box[0]; //text width
        $text_height= $box[5]-$box[3]; //text height

        /* calculate center position of text */
        $text_x         = ($this->im_width - $text_width)/2;
        $text_y         = ($this->im_height - $text_height)/2;
        
        /* create canvas for text drawing */
        $im_text        = imagecreate ($this->im_width, $this->im_height); 
        $bg_color       = imagecolorallocate ($im_text, 100, 100, 100); 

        /* pick color for text */
        $text_color     = imagecolorallocate ($im_text, 0,0,0);

        /* draw text into canvas */
        imagettftext    (   $im_text,
                            $text_size,
                            $text_angle,
                            $text_x,
                            $text_y,
                            $text_color, 
                            $text_font, 
                            $this->word);

        /* remove background color */
        imagecolortransparent($im_text, $bg_color);
        return $im_text;
        imagedestroy($im_text); 
    }


    function draw_image() {
        
        /* pick one background image randomly from image directory */
        $img_file       = $this->dir_noise."noise".rand(1,4).".jpg";

        /* create "noise" background image from your image stock*/
        $noise_img      = @imagecreatefromjpeg ($img_file);
        $noise_width    = imagesx($noise_img); 
        $noise_height   = imagesy($noise_img); 
        
        /* resize the background image to fit the size of image output */
        $this->im       = imagecreatetruecolor($this->im_width,$this->im_height); 
        imagecopyresampled ($this->im, 
                            $noise_img, 
                            0, 0, 0, 0, 
                            $this->im_width, 
                            $this->im_height, 
                            $noise_width, 
                            $noise_height);

        /* put text image into background image */
        imagecopymerge (    $this->im, 
                            $this->draw_text(), 
                            0, 0, 0, 0, 
                            $this->im_width, 
                            $this->im_height, 
                            60 );

        return $this->im;
    }

    function destroy_image() {

        imagedestroy($this->im);

    }        
}
?>