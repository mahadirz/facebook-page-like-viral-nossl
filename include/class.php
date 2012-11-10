<?php
class functionAdd
{
    function write_php_ini($array, $file)
    {
        $res = array();
        foreach ($array as $key => $val) {
            if (is_array($val)) {
                $res[] = "[$key]";
                foreach ($val as $skey => $sval)
                    $res[] = "$skey = " . (is_numeric($sval) ? $sval : '"' . $sval . '"');
            } else
                $res[] = "$key = " . (is_numeric($val) ? $val : '"' . $val . '"');
        }
        $this->safefilerewrite($file, implode("\r\n", $res));
    }

    function safefilerewrite($fileName, $dataToSave)
    {
        if ($fp = fopen($fileName, 'w')) {
            $startTime = microtime();
            do {
                $canWrite = flock($fp, LOCK_EX);
                // If lock not obtained sleep for 0 - 100 milliseconds, to avoid collision and CPU load
                if (!$canWrite)
                    usleep(round(rand(0, 100) * 1000));
            } while ((!$canWrite) and ((microtime() - $startTime) < 1000));

            //file was locked so now we can store information
            if ($canWrite) {
                fwrite($fp, $dataToSave);
                flock($fp, LOCK_UN);
            }
            fclose($fp);
        }
    }

    function random_template($min, $max)
    {
        $random_number = rand($min, $max);
        $img_extension = 'jpg'; //change here according to your image extension
        return 'template' . $random_number . '.' . $img_extension;
    }


    function curDirURL()
    {
        $pageURL = 'http';
        if ($_SERVER["HTTPS"] == "on") {
            $pageURL .= "s";
        }
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
            $ifindex = strrpos($pageURL, "index.php");
            if ($ifindex != FALSE)
                $dirname = dirname($pageURL);
            else
                $dirname = $pageURL;
        }
        return $dirname;
    }

    function createimg($url)
    {
        if (exif_imagetype($url) == IMAGETYPE_JPEG) {
            return imagecreatefromjpeg($url);
        }
        if (exif_imagetype($url) == IMAGETYPE_PNG) {
            return imagecreatefrompng($url);
        }
        if (exif_imagetype($url) == IMAGETYPE_GIF) {
            return imagecreatefromgif($url);
        }
    }
    function getredirect($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $header = "Location: ";
        $pos    = strpos($response, $header);
        $pos += strlen($header);
        return substr($response, $pos, strpos($response, "\r\n", $pos) - $pos);
    }

    function CenterText($text, $txtsize, $txtfont, $sizebox)
    {
        $box        = @ImageTTFBBox($txtsize, 0, $txtfont, $text);
        $textwidth  = abs($box[4] - $box[0]);
        $x_finalpos = $sizebox - ($textwidth / 2);
        return $x_finalpos;
    }
}
