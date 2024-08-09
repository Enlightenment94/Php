<?php

require_once(__DIR__ . '/Xml.php');

class MySqlXml extends Xml{
    public $enlDb;

    public function __construct($bpPath, $mainStartTag, $mainEndTag, $enlDb){
        parent::__construct($bpPath, $mainStartTag, $mainEndTag); 
        $this->enlDb = $enlDb;
    }

    public function bpSimpleXMLElement(){
            $sql = "SELECT * FROM " . $tableName;
            $result = $this->enlDbPs->execSql($sql);

            $i = 0;
            $n = count($result);
            $xml = new SimpleXMLElement('<data/>');
            while($row = $result[$i]) {
                $item = $xml->addChild('row');
                foreach($row as $key => $value) {
                    try{
                        $escaped_value = htmlspecialchars($value);
                        //echo $escaped_value;
                        $item->addChild($key, $escaped_value);
                    }catch(Exception $e){
                        echo $e;
                    }
                }

                $i++;
                if($i == $n){
                    //echo $i;
                    break;
                }
            }

            $xml->asXML($this->bpPath . $outputName . 'zchData.xml');
            // Zakończenie połączenia
    }

    public function bpStr($outputName, $nRecords, $tableName){
        $sql = "SELECT * FROM " . $tableName;
        $result = $this->enlDb->execSql($sql);

        $i = 0;
        if($nRecords == 'full'){
            $nRecords = count($result);
        }
        $xml = "<data>\n";
        while($row = $result[$i]) {
            $xml .= "\t$this->mainStartTag\n";
            foreach ($row as $key => $value) {
                $xml .= "\t\t<" . $key . ">" . $value . "</" . $key . ">\n";
            }
            $xml .= "\t$this->mainEndTag\n";
            $i++;
            if($i == $nRecords){
                //echo $i;
                break;
            }
        }
        $xml .= "</data>\n";

        file_put_contents($this->bpPath . $outputName, $xml);
    }

    public function rollbackField($bpXmlName, $table ,$startTagValue, $fieldValue, $endTagValue,  $startTag, $fieldId, $endTag){
        $records = $this->enlDb->execSql("SELECT * FROM ". $table);
        $strOp = new StringOp();
        foreach($records as $el){
            $into = $el[$fieldId];
            $recXml = $this->getRecordXmlFast($bpXmlName, $startTag, $into, $endTag);
            $fieldValue = $strOp->cut($recXml, $startTagValue, $endTagValue);
            echo $el[$fieldId] . " "  .  $fieldValue . "</br>";
        }
    }
}