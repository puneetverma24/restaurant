<?php


if ($_POST["label"]) {
    $label = $_POST["label"];
}
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);


//here we are not checking for dimension of image 


if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 200000)
&& in_array($extension, $allowedExts)) {
    if ($_FILES["file"]["error"] > 0) {
        echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    } else {
        //$filename = $label.$_FILES["file"]["name"];
        
        $name=time();
        
        $filename = $label. $name.".".$extension;   // file name --> puneet
         $fileThumb = "THU_". $name.".".$extension;   // file name --> puneet
        
        echo $fileThumb;
       
      //  echo "Upload: " .  $name . "<br>";
       //echo "Upload: " . $_FILES["file"]["name"] . "<br>";
         //echo "Type: " . $_FILES["file"]["type"] . "<br>";
        //echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
      //  echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

        if (file_exists("assets/upload/item_images/" . $filename)) {
            echo $filename . " already exists. ";
        } else {
        
        
        
         //xxxxxxxxxxxxxxx thumbnail      xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
           $image = new SimpleImage();
   $image->load($_FILES["file"]["tmp_name"]);
   $image->resize(100,100);
   $image->save("assets/upload/item_images/".$fileThumb);   
    
  
           
         //xxxxxxxxxxxxxxxx end of thumbnail 
        
        
        
            move_uploaded_file($_FILES["file"]["tmp_name"],"assets/upload/item_images/" . $filename);
           // echo "Stored in: " . "assets/upload/item_images/" . $filename;
           
          
          




           
           
           
           
        }
    }
} else {
    echo "Invalid file";
}



 
class SimpleImage {

   var $image;
   var $image_type;  
   
   

   function load($filename) {
 
      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
      if( $this->image_type == IMAGETYPE_JPEG ) {

         $this->image = imagecreatefromjpeg($filename);
      } elseif( $this->image_type == IMAGETYPE_GIF ) {

         $this->image = imagecreatefromgif($filename);
      } elseif( $this->image_type == IMAGETYPE_PNG ) {

         $this->image = imagecreatefrompng($filename);
      }
   }
   function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {

      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$filename,$compression);
      } elseif( $image_type == IMAGETYPE_GIF ) {

         imagegif($this->image,$filename);
      } elseif( $image_type == IMAGETYPE_PNG ) {

         imagepng($this->image,$filename);
      }
      if( $permissions != null) {

         chmod($filename,$permissions);
      }
   }
   function output($image_type=IMAGETYPE_JPEG) {

      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) {

         imagegif($this->image);
      } elseif( $image_type == IMAGETYPE_PNG ) {

         imagepng($this->image);
      }
   }
   function getWidth() {

      return imagesx($this->image);
   }
   function getHeight() {

      return imagesy($this->image);
   }
   function resizeToHeight($height) {

      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }

   function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
   }

   function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100;
      $this->resize($width,$height);
   }

   function resize($width,$height) {
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->image = $new_image;
   }      

}
// end of thumbnail





?>