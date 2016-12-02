<?php
namespace Kyawnaingtun\Tounicode;

trait TounicodeTrait{

  /**
   * [toUnicode description]
   * @param  [string] $value [input zawgyi]
   * @return [string]        [output unicode]
   */
  public function toUnicode($value){
    $inputValue = $this->testZgOrUni($value);
    if($inputValue == "ZawGyi") {
      return $this->replaceWithRule($value);
    }else{
      return $value;//if others, return origin value
    }
  }
  /**
   * [defineUnicodeRule description]
   * @param  [string] $value [user's input value]
   * @return [string]        [output result]
   */
  protected static function testZgOrUni($value){
      $regexUni = '/[ဃငဆဇဈဉညဋဌဍဎဏဒဓနဘရဝဟဠအ]်|ျ[က-အ]ါ|ျ[ါ-း]|\x{103e}|\x{103f}|\x{1031}[^\x{1000}-\x{1021}\x{103b}\x{1040}\x{106a}\x{106b}\x{107e}-\x{1084}\x{108f}\x{1090}]|\x{1031}$|\x{1031}[က-အ]\x{1032}|\x{1025}\x{102f}|\x{103c}\x{103d}[\x{1000}-\x{1001}]|ည်း|ျင်း|င်|န်း|ျာ|င့်/u';
      $regexZG = '/\s\x{1031}| ေ[က-အ]်|[က-အ]း/u';
      $regexMM = '/[\x{1000}-\x{109f}\x{aa60}-\x{aa7f}]+/u';

      if(preg_match($regexUni,$value))
          return "Unicode";
      else if(preg_match($regexZG,$value))
          return "ZawGyi";
      else if(preg_match($regexMM,$value))
          return "Myanmar";
      else
          return "NotMyanmar";
  }

  /**
   * [defineUnicodeRule description]
   * @param  [string] $rule [unicode convert rules]
   * @param  [string] $outputValue [input zawgyi]
   * @return [string]        [output unicode]
   */
  protected static function replaceWithRule($outputValue)
  {
    $rule = [
         ["from" => "(\u103D|\u1087)","to" =>"\u103E"],
         ["from" => "\u103C","to" =>"\u103D"],
         ["from" => "(\u103B|\u107E|\u107F|\u1080|\u1081|\u1082|\u1083|\u1084)","to" =>"\u103C"],
         ["from" => "(\u103A|\u107D)","to" =>"\u103B"],
         ["from" => "\u1039","to" =>"\u103A"],
         ["from" => "\u106A","to" =>"\u1009"],
         ["from" => "\u106B","to" =>"\u100A"],
         ["from" => "\u106C","to" =>"\u1039\u100B"],
         ["from" => "\u106D","to" =>"\u1039\u100C"],
         ["from" => "\u106E","to" =>"\u100D\u1039\u100D"],
         ["from" => "\u106F","to" =>"\u100D\u1039\u100E"],
         ["from" => "\u1070","to" =>"\u1039\u100F"],
         ["from" => "(\u1071|\u1072)","to" =>"\u1039\u1010"],
         ["from" => "\u1060","to" =>"\u1039\u1000"],
         ["from" => "\u1061","to" =>"\u1039\u1001"],
         ["from" => "\u1062","to" =>"\u1039\u1002"],
         ["from" => "\u1063","to" =>"\u1039\u1003"],
         ["from" => "\u1065","to" =>"\u1039\u1005"],
         ["from" => "\u1068","to" =>"\u1039\u1007"],
         ["from" => "\u1069","to" =>"\u1039\u1008"],
         ["from" => "/(\u1073|\u1074)/g","to" =>"\u1039\u1011"],
         ["from" => "\u1075","to" =>"\u1039\u1012"],
         ["from" => "\u1076","to" =>"\u1039\u1013"],
         ["from" => "\u1077","to" =>"\u1039\u1014"],
         ["from" => "\u1078","to" =>"\u1039\u1015"],
         ["from" => "\u1079","to" =>"\u1039\u1016"],
         ["from" => "\u107A","to" =>"\u1039\u1017"],
         ["from" => "\u107C","to" =>"\u1039\u1019"],
         ["from" => "\u1085","to" =>"\u1039\u101C"],
         ["from" => "\u1033","to" =>"\u102F"],
         ["from" => "\u1034","to" =>"\u1030"],
         ["from" => "\u103F","to" =>"\u1030"],
         ["from" => "\u1086","to" =>"\u103F"],
         ["from" => "\u1088","to" =>"\u103E\u102F"],
         ["from" => "\u1089","to" =>"\u103E\u1030"],
         ["from" => "\u108A","to" =>"\u103D\u103E"],
         ["from" => "([\u1000-\u1021])\u1064","to" =>"\u1004\u103A\u1039$1"],
         ["from" => "([\u1000-\u1021])\u108B","to" =>"\u1004\u103A\u1039$1\u102D"],
         ["from" => "([\u1000-\u1021])\u108C","to" =>"\u1004\u103A\u1039$1\u102E"],
         ["from" => "([\u1000-\u1021])\u108D","to" =>"\u1004\u103A\u1039$1\u1036"],
         ["from" => "\u108E","to" =>"\u102D\u1036"],
         ["from" => "\u108F","to" =>"\u1014"],
         ["from" => "\u1090","to" =>"\u101B"],
         ["from" => "\u1091","to" =>"\u100F\u1039\u1091"],
         ["from" => "\u1019\u102C(\u107B|\u1093)","to" =>"\u1019\u1039\u1018\u102C"],
         ["from" => "(\u107B|\u1093)","to" =>"\u103A\u1018"],
         ["from" => "(\u1094|\u1095)","to" =>"\u1037"],
         ["from" => "\u1096","to" =>"\u1039\u1010\u103D"],
         ["from" => "\u1097","to" =>"\u100B\u1039\u100B"],
         ["from" => "\u103C([\u1000-\u1021])([\u1000-\u1021])?","to" =>"$1\u103C$2"],
         ["from" => "([\u1000-\u1021])\u103C\u103A","to" =>"\u103C$1\u103A"],
         ["from" => "\u1031([\u1000-\u1021])(\u103E)?(\u103B)?","to" =>"$1$2$3\u1031"],
         ["from" => "([\u1000-\u1021])\u1031(\u103B|\u103C|\u103D)","to" =>"$1$2\u1031"],
         ["from" => "\u1032\u103D","to" =>"\u103D\u1032"],
         ["from" => "\u103D\u103B","to" =>"\u103B\u103D"],
         ["from" => "\u103A\u1037","to" =>"\u1037\u103A"],
         ["from" => "\u102F(\u102D|\u102E|\u1036|\u1037)\u102F","to" =>"\u102F$1"],
         ["from" => "\u102F\u102F","to" =>"\u102F"],
         ["from" => "(\u102F|\u1030)(\u102D|\u102E)","to" =>"$2$1"],
         ["from" => "(\u103E)(\u103B|\u1037)","to" =>"$2$1"],
         ["from" => "\u1025(\u103A|\u102C)","to" =>"\u1009$1"],
         ["from" => "\u1025\u102E","to" =>"\u1026"],
         ["from" => "\u1005\u103B","to" =>"\u1008"],
         ["from" => "\u1036(\u102F|\u1030)","to" =>"$1\u1036"],
         ["from" => "\u1031\u1037\u103E","to" =>"\u103E\u1031\u1037"],
         ["from" => "\u1031\u103E\u102C","to" =>"\u103E\u1031\u102C"],
         ["from" => "\u105A","to" =>"\u102B\u103A"],
         ["from" => "\u1031\u103B\u103E","to" =>"\u103B\u103E\u1031"],
         ["from" => "(\u102D|\u102E)(\u103D|\u103E)","to" =>"$2$1"],
         ["from" => "\u102C\u1039([\u1000-\u1021])","to" =>"\u1039$1\u102C"],
         ["from" => "\u103C\u1004\u103A\u1039([\u1000-\u1021])","to" =>"\u1004\u103A\u1039$1\u103C"],
         ["from" => "\u1039\u103C\u103A\u1039([\u1000-\u1021])","to" =>"\u103A\u1039$1\u103C"],
         ["from" => "\u103C\u1039([\u1000-\u1021])","to" =>"\u1039$1\u103C"],
         ["from" => "\u1036\u1039([\u1000-\u1021])","to" =>"\u1039$1\u1036"],
         ["from" => "\u1092","to" =>"\u100B\u1039\u100C"],
         ["from" => "\u104E","to" =>"\u104E\u1004\u103A\u1038"],
         ["from" => "\u1040(\u102B|\u102C|\u1036)","to" =>"\u101D$1"],
         ["from" => "\u1025\u1039","to" =>"\u1009\u1039"]
         ];
    for($i=0; $i < count($rule); $i++) {
      $data = $rule[$i];
      $from = "~".json_decode('"'.$data["from"].'"')."~u";
      $to = json_decode('"'.$data["to"].'"');
      $outputValue = preg_replace($from, $to, $outputValue);
    }
    return $outputValue;
  }
}
