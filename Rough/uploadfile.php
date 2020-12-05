<?php
$target_dir = "upload/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);    // request varaiable (like $_post['fileToUpload']),["name"] means will return name

// whenever we upload image, we get some temporary name for that file. 


$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    list($width, $height) = getimagesize($_FILES["fileToUpload"]["tmp_name"]);  //to get size of image
  
            echo "$width";
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    
    
    /*
    Index 0 and 1 contains respectively the width and the height of the image. 
    
    
    index 2 is one of the IMAGETYPE_XXX constants indicating the type of the image.

Index 3 is a text string with the correct height="yyy" width="xxx" string that can be used directly in an IMG tag.

mime is the correspondant MIME type of the image. This information can be used to deliver images with the correct HTTP Content-type header: 

 channels will be 3 for RGB pictures and 4 for CMYK pictures.

bits is the number of bits for each color.

For some image types, the presence of channels and bits values can be a bit confusing. As an example, GIF always uses 3 channels per pixel, but the number of bits per pixel cannot be calculated for an animated GIF with a global color table.

On failure, FALSE is returned. 


    
    */
    
    
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {  //returns size of the file (in bytes).
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
 
 
 
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}



// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {


// todo 
// here we can add thumbnail code 
//database

$image = new SimpleImage();
    $image->load($_FILES["fileToUpload"]["tmp_name"]);
    $image->resize(100,100);
    $image->save("upload/k.png");




$target_dir1 = "upload/";
$target_file1 = $target_dir1 . basename(time().".".$imageFileType );

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file1)) {  //tmp_name --> may be without extension
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}






//xxxxxxxxxxxxxxxxxxxxxx
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




?>