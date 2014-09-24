<?php
function directory_listing_strings($iterator){
        $temp = array(); $i=0;
        foreach($iterator as $name){
                if(($name!="./..") and ($name!="./.")){
                         $temp[$i] = "$name";
                         $i++;
                }
        }
        return $temp;
}
Function return_complete_listing($listing){
        $temp = array(); $i=0;
        if(is_array($listing)){
                foreach($listing as $crit){
                        if(is_dir($crit)){
                                $test = new RecursiveDirectoryIterator($crit);
                                $temp[$i] = return_complete_listing(directory_listing_strings($test));
                        }else{
                                $temp[$i] = $crit;
                        }
                }
        }
        return $temp;
}
function return_only_directories($listing){
        $temp = array(); $i=0;
        if(is_array($listing)){
                foreach($listing as $crit){
                        if(is_dir($crit)){
                                $temp[$i] = $crit;
                                $i++;
                        }
                }
        }
        return $temp;
}
function return_only_files($listing){
        $temp = array(); $i=0;
        if(is_array($listing)){
                foreach($listing as $crit){
                        if(is_file($crit)){
                                $temp[$i] = $crit;
                                $i++;
                        }
                }
        }
        return $temp;
}
function return_only_hashes($listing){
        $temp = array(); $i=0;
        if(is_array($listing)){
                foreach($listing as $crit){
                        if(is_file($crit)){
                                if(strpos($crit,".sha")){
                                        $temp[$i] = $crit;
                                        $i++;
                                }
                        }
                }
        }
        return $temp;
}
?>
