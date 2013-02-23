<?php

/**
 * Graphics utility functions to rotate images.
 */

namespace Sample;

/**
 * Class to product cropped or thumbnail images.
 */
class Graphics
{
    private $_file;
    private $_data;
    
    /**
     * Instantiate image.
     *
     * @param string $filepath Image filepath
     */
    public function __construct($filepath) 
    {
        if (file_exists($filepath)) {
            $file = file_get_contents($filepath);
            if ($this->_data = @imagecreatefromstring($file)) {
                // update internal info, force alpha channel support
                $this->_file = $filepath;
                imagesavealpha($this->_data, true);
            }
        }
    }

    /**
     * Generate cropped-to-fit image.
     *
     * @param int $width  Image width
     * @param int $height Image height
     *
     * @return Image data; null, otherwise
     */
    public function crop($width, $height) 
    {
        if (!$this->_data) {
            return null;
        }

        // get image dimensions
        $orig_width = imagesx($this->_data);
        $orig_height = imagesy($this->_data);
        $ratio = $orig_width / $orig_height;

        // adjust dimensions; retain aspect ratio
        $x = 0;
        $y = 0;
        $crop_width = $orig_width;
        $crop_height = $orig_height;

        if ($width / $ratio <= $height) {
            $crop_width = $orig_height * $width / $height;
            $x = ($orig_width - $crop_width) / 2;
        } else {
            $crop_height = $orig_width * $height / $width;
            $y = ($orig_height - $crop_height) / 2;
        }

        $this->_orient();
        return $this->_resample($x, $y, $width, $height, $crop_width, $crop_height);
    }

    /**
     * Generate resized image.
     *
     * @param int $width  Image width
     * @param int $height Image height
     *
     * @return Image data; null, otherwise
     */
    public function thumb($width, $height) 
    {
        if (!$this->_data) {
            return null;
        }

        // get image dimensions
        $orig_width = imagesx($this->_data);
        $orig_height = imagesy($this->_data);
        $ratio = $orig_width / $orig_height;

        // adjust dimensions; retain aspect ratio
        if ($width <= $orig_width && $height >=$width / $ratio) {
            $height = $width / $ratio;
        } elseif ($height <= $orig_height && $width >= $height * $ratio) {
            $width = $height * $ratio;
        } else {
            // retain size if dimensions exceed original image
            $width = $orig_width;
            $height = $orig_height;
        }

        $this->_orient();
        return $this->_resample(0, 0, $width, $height, $orig_width, $orig_height);
    }

    /**
     * Rotate and flip the image data.
     *
     * @return void
     */
    private function _orient()
    {
        if (!($exif = @exif_read_data($this->_file))) {
            // there was a problem ... we should probably log here
            return;
        }

        $o = (isset($exif['Orientation'])) ? $exif['Orientation'] : 0;
        $rotate = 0;
        $flip = false;
        switch ($o) {
        case 2: 
            $rotate = 0; 
            $flip = true; 
            break;
        case 3: 
            $rotate = 180;
            $flip = false;
            break;
        case 4: 
            $rotate = 180;
            $flip = true;
            break;
        case 5: 
            $rotate = 270;
            $flip = true;
            break;
        case 6: 
            $rotate = 270;
            $flip = false;
            break;
        case 7: 
            $rotate = 90;
            $flip = true;
            break;
        case 8: 
            $rotate = 90;
            $flip = false;
            break;
        case 1:
        default:
            break;
        }

        // now actually rotate or flip the image we have
        if ($rotate) {
            $this->_data = imagerotate($this->_data, $rotate, 0);
        }
        if ($flip) {
            $width = imagesx($this->_data);
            $height = imagesy($this->_data);

            $tmp = imagecreatetruecolor($width, $height);
            imagesavealpha($tmp, true);
            imagefill($tmp, 0, 0, IMG_COLOR_TRANSPARENT);
            imagecopyresampled(
                $tmp, $this->_data, 
                0, 0, $width - 1, 0, 
                $width, $height, -$width, $height
            );
            imagedestroy($this->_data);
            $this->_data = $tmp;
        }
    }

    /**
     * Output image data.
     *
     * @param int $src_x X-coordinate of source point
     * @param int $src_y Y-coordinate of source point
     * @param int $dst_w Destination width
     * @param int $dst_h Destination height
     * @param int $src_w Source width
     * @param int $src_h Source height
     *
     * @return Image data
     */
    private function _resample($src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h) 
    {
        if (!$this->_data) {
            return null;
        }

        // create a temporary image to work on
        $tmp = imagecreatetruecolor($dst_w, $dst_h);
        imagesavealpha($tmp, true);
        imagefill($tmp, 0, 0, IMG_COLOR_TRANSPARENT);

        // copy and resize
        imagecopyresampled(
            $tmp, $this->_data, 
            0, 0, $src_x, $src_y, 
            $dst_w, $dst_h, $src_w, $src_h
        );
        imagedestroy($this->_data);
        $this->_data = $tmp;

        // output the result
        ob_start();
        imagepng($this->_data);
        $image = ob_get_clean();

        return $image;
    }
}
