<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Librarie {

    function post_Editor($continut)
    {
        $continut = str_replace("'","\'",$continut);
        $continut = str_replace("stilebug=","style=",$continut);
        return $continut;
    }

    function clear_variable($value)
    {
        $value = preg_replace('#\s{2,}#',' ',$value);
        $value = str_replace("\t"," ", $value);
        $value = strip_tags($value);
        //$value = addslashes($value);

        $value = str_replace('"', "&#34;", $value);
        $value = str_replace("'", "&#39;", $value);
        $value = str_replace("\\", "&#92;", $value);
        $value = trim($value);

        return $value;
    }

    function clear_input($value)
    {
        $interzis = array("DROP", "TABLE", "JOIN", "SELECT", "INSERT", "UPDATE", "DELETE", "WHERE", "UNION", "FROM", "LIKE", "CONCAT", "LOAD_FILE", "BENCHMARK");
        $value    = str_replace($interzis, "", $value);
        $value    = str_replace('"', "&#34;", $value);
        $value    = str_replace("'", "&#39;", $value);
        $value    = trim($value);
        return $value;
    }

    function genereaza_link($string)
    {
        $string = trim($string);
        $string = strtolower($string);
        $string = preg_replace('/[^A-Za-z0-9_-]+/', '-', $string);
        $string = trim($string, '-');

        return $string;
    }

    function genereaza_camp($string)
    {
        $string = trim($string);
        $string = strtolower($string);
        $string = preg_replace('#_{2,}#', '_', $string);
        $string = preg_replace('/[^A-Za-z0-9_]+/', '_', $string);
        $string = trim($string, '_');

        return $string;
    }

    function limitare_caractere($input, $limita)
    {
        return (strlen($input) > $limita && $limita > 0)? substr($input, 0, $limita)."...":$input;
    }

    function impar($int)
    {
        return($int & 1);
    }

    function seo($id, $string)
    {
        if($id == 'title')
        {
            return $string;
        }

        else if($id == 'keywords')
        {
            $new_string = '';
            $string = explode(' ', $string);
            foreach ($string as $value)
            {
                $new_string .= $value.', ';
            }
            $new_string = substr($new_string, 0, -2);

            return $new_string;
        }

        else if($id == 'description')
        {
            return $string;
        }
    }

    function date_to_timestamp($datetime = NULL, $delimitator = '-')
    {
        if(empty($datetime))
        {
            return '';
        }
            else
        {
            $datetime = explode('@', $datetime);
            $date     = $datetime[0];
            $hours    = 0;
            $minutes  = 0;
            $seconds  = 0;

            if(isset($datetime[1]))
            {
                list($hours, $minutes) = explode(':', $datetime[1]);
            }

            list($day, $month, $year) = explode($delimitator, $date);

            return mktime((int)$hours, (int)$minutes, (int)$seconds, (int)$month, (int)$day, (int)$year);
        }
    }

    function format_numar($pret, $zecimale = 2, $default = ',00', $virgula = ',' , $punct = '.')
    {
        $format  = number_format(sprintf("%01.".$zecimale."f", $pret), $zecimale, $virgula, $punct);
        $explode = explode($virgula, $format);

        return (isset($explode[1]) && $explode[1] == 0)? $explode[0].$default:$format;
    }


    /**
     * Scaneaza director.
     *
     * getFilesFromDir()
     *
     * @access   public
     * @param    $dir directorul in care se face cautarea de fisiere
     *
     * @return   un array care contine toate fisierele din acel director aplicat recursiv
     */

    function getFilesFromDir($dir)
    {
        $files = array();
        if ($handle = opendir($dir)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != "..") {
                    if(is_dir($dir.'/'.$file)) {
                        $dir2 = $dir.'/'.$file;
                        $files[] = $this->getFilesFromDir($dir2);
                    }

                    else
                    {
                        $files[] = $dir.'/'.$file;
                    }
                }
            }
            closedir($handle);
        }

        return $this->flatten_array($files);
    }

    function flatten_array(array $a)
    {
        $i = 0;
        while ($i < count($a))
        {
            if (is_array($a[$i])) array_splice($a, $i, 1, $a[$i]); else $i++;
        }

        return $a;
    }

}

?>