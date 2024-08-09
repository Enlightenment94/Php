<?php

class StringOp{   
    public function cut($str, $startStr, $endStr){
        $startPos = strpos($str, $startStr);
        $endPos = strpos($str, $endStr);
        if(($startPos - $endPos) == 1){
            echo "non characeter between";
        }
        $startStrLen = strlen($startStr);
        //echo $startPos . "</br>";
        //echo $endPos . "</br>";
        $res = substr($str, $startPos + $startStrLen, $endPos - $startPos - $startStrLen);
        return $res;
    }

    public function split2($str, $startStr, $endStr){
        $splitArr = array();
        $startStrLen = strlen($startStr);
        $endStrLen = strlen($endStr);

        for(;;){
            $startPos = strpos($str, $startStr);
            $endPos = strpos($str, $endStr);
/*
            echo "startStr " . $startStr . "</br>";
            echo "endStr " . $endStr . "</br>";
            echo $str . "</br>";
            echo $startPos . "</br>";
            echo $endPos . "<br></br>";
*/
            if($endPos == false){
                    return $splitArr;
            }

            if(($startPos - $endPos) == 1){
                echo "non characeter between";
                return "";
            }

            $res = substr($str, $startPos + $startStrLen, $endPos - $startPos - $startStrLen);    
            array_push($splitArr, $res);

            $str = substr($str, $endPos + $endStrLen);
            $startPos = "";
            $endPos = "";
        }
        
        return $splitArr;
    }
}