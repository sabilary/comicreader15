<?php
class Convert
{
    public $resize_width = 200;
    public $resize_height = 200;
    
    /*=============================================================*/
    // $this->convert->resizeImage($filename, $targetname, $location);
    /*=============================================================*/
	public function resizeImage($filename, $targetname, $location)
    {
		$extension = substr($filename, -3);
		switch($extension) {
			case 'gif':
				$image = @imagecreatefromgif($location . $filename);
				break;
			case 'jpg':
				$image = @imagecreatefromjpeg($location . $filename);
				break;
			case 'png':
				$image = @imagecreatefrompng($location . $filename);
				break;
		}
		if($image) {
			$width = imagesx($image);
			$height = imagesy($image);
			// medium
			if($width > $this->resize_width || $height > $this->resize_height) {
				$wr = $width/$this->resize_width;
				$hr = $height/$this->resize_height;
				if($wr > $hr) {
					$ratio = $wr;
				} else {
					$ratio = $hr;
				}
				$dest_w = (int) ($width/$ratio);
				$dest_h = (int) ($height/$ratio);
			} else {
				$dest_w = $width;
				$dest_h = $height;
			}
			$destImage = imagecreatetruecolor ($dest_w, $dest_h);
			imagecopyresampled($destImage, $image, 0, 0, 0, 0, $dest_w, $dest_h, $width, $height);
			imagejpeg($destImage, $location . $targetname, 85);
			if($filename != $targetname) {
				unlink($location . $filename);
			}
		} else {
			unlink($location . $filename);
		}
	}
    
    /*=============================================================*/
    // $this->convert->slug($str, $separator = '-', $lowercase = TRUE);
    /*=============================================================*/
    public function slug($str, $separator = '-', $lowercase = TRUE)
    {
        // Separators
        if ($separator == 'dash') {
            $separator = '-';
        }
        else if ($separator == 'underscore') {
            $separator = '_';
        }

        // Quote regular expression characters
        $q_separator = preg_quote($separator);

        $trans = array(
            '&.+?;'                     => '',
            '[^a-z0-9 _-]'              => '',
            '\s+'                       => $separator,
            '(' . $q_separator . ')+'   => $separator
        );

        // Strip HTML and PHP tags from a string
        $str = strip_tags($str);

        foreach ($trans as $key => $val) {
            // Perform a regular expression search and replace
            $str = preg_replace("#" . $key . "#i", $val, $str);
        }

        if ($lowercase === TRUE) {
            // Make a string lowercase
            $str = strtolower($str);
        }

        // Strip whitespace (or other characters) from the beginning and end of a string
        $trim = trim($str, $separator);
        return $trim;
    }
}