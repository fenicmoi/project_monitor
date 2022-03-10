<?

function bathformat($number) {
  $numberstr = array('ศูนย์','หนึ่ง','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ');
  $digitstr = array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน');

  $number = str_replace(",","",$number); //ลบ comma
  $number = explode(".",$number); //แยกจุดทศนิยมออก

  //เลขจำนวนเต็ม
  $strlen = strlen($number[0]);
  $result = '';
  for($i=0;$i<$strlen;$i++) {
    $n = substr($number[0], $i,1);
    if($n!=0) {
      if($i==($strlen-1) AND $n==1){ $result .= 'เอ็ด'; } 
      elseif($i==($strlen-2) AND $n==2){ $result .= 'ยี่'; }
      elseif($i==($strlen-2) AND $n==1){ $result .= ''; }
      else{ $result .= $numberstr[$n]; }
      $result .= $digitstr[$strlen-$i-1];
    }
  }
  
  //จุดทศนิยม
  $strlen = strlen($number[1]);
  if ($strlen>2) { //ทศนิยมมากกว่า 2 ตำแหน่ง คืนค่าเป็นตัวเลข
    $result .= 'จุด';
    for($i=0;$i<$strlen;$i++) {
      $result .= $numberstr[(int)$number[1][$i]];
    }
  } else { //คืนค่าเป็นจำนวนเงิน (บาท)
    $result .= 'บาท';
    if ($number[1]=='0' OR $number[1]=='00' OR $number[1]=='') {
      $result .= 'ถ้วน';
    } else {
      //จุดทศนิยม (สตางค์)
      for($i=0;$i<$strlen;$i++) {
        $n = substr($number[1], $i,1);
        if($n!=0){
          if($i==($strlen-1) AND $n==1){$result .= 'เอ็ด';}
          elseif($i==($strlen-2) AND $n==2){$result .= 'ยี่';}
          elseif($i==($strlen-2) AND $n==1){$result .= '';}
          else{ $result .= $numberstr[$n];}
          $result .= $digitstr[$strlen-$i-1];
        }
      }
      $result .= 'สตางค์';
    }
  }
  return $result;
}
?>