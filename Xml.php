<?php

require_once(__DIR__ . '/../str/StringOp.php');

class Xml{
    public $bpPath;
    public $mainStartTag;
    public $mainEndTag;

    public function __construct($bpPath, $mainStartTag, $mainEndTag){
        $this->bpPath = $bpPath;
        $this->mainStartTag = $mainStartTag;
        $this->mainEndTag = $mainEndTag;
    }

    public function getRecordXmlSlow($bpXmlName, $startTag, $into, $endTag){
        $xmlString = file_get_contents($this->bpPath . $bpXmlName);
        $strOp = new StringOp();
        $counter = 0;
        $arr = $strOp->split2($xmlString, $this->mainStartTag, $this->mainEndTag);
        foreach ($arr as $el) {
            $res = $strOp->cut($el, $startTag, $endTag);
            if($res == $into){
                break;
            }
            $counter++;
        }

        if($counter >= count($arr)){
            echo "<pre>";
            echo $arr[$counter - 1 ];
            echo "</pre>";
            return -1;
        }else{
            return $arr[$counter];
        }
    }

    public function getRecordXmlFast($bpXml, $startTag, $into, $endTag){
        $xmlString = file_get_contents($this->bpPath . $bpXml);
        $startIndex = strpos($xmlString, $startTag . $into . $endTag);

        if ($startIndex !== false) {
            $startRecordIndex = strrpos(substr($xmlString, 0, $startIndex), $this->mainStartTag);
            $endRecordIndex = strpos($xmlString, $this->mainEndTag, $startIndex) + strlen($this->mainEndTag);
            if ($startRecordIndex !== false && $endRecordIndex !== false) {
                $copiedContent = substr($xmlString, $startRecordIndex, $endRecordIndex - $startRecordIndex);
                return $copiedContent;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
        
    }

    public function printLines($bpXml, $start, $end){
        $fileHandle = fopen($this->bpPath . $bpXml, 'r');
        if ($fileHandle) {
            $lineNumber = 0;
            while (($line = fgets($fileHandle)) !== false) {
                $lineNumber++;
                if ($lineNumber >= $start && $lineNumber <= $end) {
                   echo $line;
                }

                if ($lineNumber > $end) {
                    break;
                }
            }
            fclose($fileHandle);
        } else {
        }
    }

    public function compare(){

    }
}