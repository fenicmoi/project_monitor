<?
	class convert_date{
		function format_date1($timestamp,$format) {
			$month = array("01", "02", "03", "04", "05", "06", "07", "08", "09","10","11", "12");
			preg_match_all("/[[:alpha:]]/",$format,$character);
			for($i=0;$i<count($character[0]);$i++) {
			if($character[0][$i] == 'M') {
			$formatted = $month[date("n",$timestamp)-1]; 
			}
			else {
			$formatted = date($character[0][$i],$timestamp);
			}
			$format = preg_replace("/".$character[0][$i]."/",$formatted,$format,1);
			}
			return($format);
		}   
	function conDateformat_($date){
			return substr($date,6,4)."-".substr($date,3,2)."-".substr($date,0,2);
	}

	function dayInYear_($date){
			return ($this->format_date1(strtotime($date),'z')+1);
	}

	function dayInMonth_($y,$m){
			return $this->format_date1(strtotime($y."-".sprintf("%02d",$m)."-01 00:00:00"),'t');
	}

	function daySTB_($y){   # วันที่เริ่มต้นปีงบประมาณ
			return ($this->format_date1(strtotime($y."-10-01  00:00:00"),'z')+1);
	}

	function dayIY_($y){   # จำนวนวันของปีงบประมาณ
			return ($this->format_date1(strtotime($y."-12-31  00:00:00"),'z')+1);
	}

	function thisdate_(){
			return $this->format_date1(time(),'Y-M-d H:i:s');
	}
	function day_sh($d,$lang){
		$dth = array("อา","จ","อ","พ","พฤ","ศ","ส");
		$deng = array("sun","mon","tue","wed","thu","fri","sat");
		if($lang=="en") return $deng[$d]; else if($lang=="th") return $dth[$d];
	}
	function day_full($d,$lang){
		$dth = array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");
		$deng = array("sunday","monday","tuesday","wednesday","thursday","friday","saturday");
		if($lang=="en") return $deng[$d]; else if($lang=="th") return $dth[$d];
	}
	function mon_sh($m,$lang){
		$meng=array("","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
		$mth=array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		if($lang=="en") return $meng[$m]; else if($lang=="th") return $mth[$m];
	}

	function mon_full($m,$lang){
		$meng=array("","January","February","March","April","May","June","July","August","September","October","November","December");
		$mth=array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		if($lang=="en") return $meng[$m]; else if($lang=="th") return $mth[$m];
	}


	function convert_($dat,$parts){
		$daxsh = array("อา","จ","อ","พ","พฤ","ศ","ส");
		$dax = array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");

		$oldstamp =  strtotime($dat);
		$wan = $this->format_date1($oldstamp,"w");
		$this->yea=$yea = substr($dat,0,4);
		$yea2 = substr($dat,0,4)+543;
		$yea1 = substr($dat,2,2);
		$mos = substr($dat,5,2);
		$this->mos1=$mos1 = substr($dat,5,2);
		$da = substr($dat,8,2);
		$He = substr($dat,11,2);
		$In = substr($dat,14,2);
		$this->da=$da=(int)$da;

		$mo=$mos;

		$this->fulldate="วัน ".$daxsh[$wan]." ที่ ".$da." ".$mos." ".($yea+543)." ,$He:$In น.";
		$this->fulldate1="วัน ".$dax[$wan]." ที่ ".$da." ".$mos." ".($yea+543)." ,$He:$In น.";
		$this->fulldate2=$dax[$wan]." ที่ ".$da." ".$mos." ".($yea+543)." ,$He:$In น.";
		$this->sumdate=$da." ".$mos." ".($yea+543)." ,$He:$In";
		$this->sumdatesh=$da." ".$mo1." ".($yea+543);
		$this->sumdatesh1=$da." ".$mo1." ".(($yea+543)-2500)." ,$He:$In";
		$this->sumdatesh2=$da." ".$mo1." ".(($yea+543)-2500)." $He:$In";
		$this->sumdatesh3=$daxsh[$wan]." ,".$da." ".$mo1." ".(($yea+543)-2500)." ,$He:$In";
		$this->sumdate1=$da." ".$mos." ".($yea+543);
	} # function


	function DateConvertSH($dat,$parts){
		$yea1 = substr($dat,0,4);
		$mos = substr($dat,5,2);
		$da = substr($dat,8,2)*1;
		$m=$mos*1;
		if($dat>0)
			return $this->mon_sh($m,"th")." ".($yea1+543);
		else
			return "";
	} # function

	function DateConvertSH1($dat,$parts){
		$yea1 = substr($dat,0,4);
		$mos = substr($dat,5,2)*1;
		$da = substr($dat,8,2)*1;
		return $this->mon_full($mos,"th")." ".($yea1+543);
	} # function

	function DateConvertSH2($dat,$parts){
			$oldstamp =  strtotime($dat);
			$wan = $this->format_date1($oldstamp,"w");
			$yea = substr($dat,0,4);
			$mos = substr($dat,5,2)*1;
			$da = substr($dat,8,2)*1;
			$He = substr($dat,11,2);
			$In = substr($dat,14,2);
			$Is = substr($dat,17,2);
			return $da." ".$this->mon_sh($mos,"th")." ".$yea."&nbsp;,&nbsp;$He:$In";
	} # function

	function DateConvertSH3($dat,$parts){
		$yea1 = substr($dat,0,4);
		$mos = substr($dat,5,2)*1;
		$da = substr($dat,8,2)*1;
		return $da." ".$this->mon_sh($mos,"th")." ".substr(($yea1+543),2,2);
	} # function

	function DateConvertSH4($dat,$parts){
			$oldstamp =  strtotime($dat);
			$wan = $this->format_date1($oldstamp,"w");
			$yea = substr($dat,0,4);
			$yea2 = substr($dat,0,4)+543;
			$yea1 = substr($dat,2,2);
			$mos = substr($dat,5,2)*1;
			$mos1 = substr($dat,5,2);
			$da = substr($dat,8,2);
			$da=$da*1;
		return $this->day_full($wan,"th")." ที่ ".$da." ".$this->mon_full($mos,"th")." ".$yea2;
	} # function

	function DateConvertSH5($dat,$parts){
		$yea1 = substr($dat,0,4);
		$mos = substr($dat,5,2)*1;
		$da = substr($dat,8,2)*1;
		return $da." ".$this->mon_sh($mos,"th")." ".substr(($yea1+543),2,2);
	} # function

	function DateConvertSH6($dat,$parts){
		$yea1 = substr($dat,0,4);
		$mos = substr($dat,5,2)*1;
		$da = substr($dat,8,2)*1;
		return $da." ".$this->mon_sh($mos,"th")." ".($yea1+543);
	} # function

	function DateToDay($dat,$parts){
			$oldstamp =  strtotime($dat);
			$wan = $this->format_date1($oldstamp,"w");
			return $this->day_sh($wan,"en");
	} # function


	function DateConvertFull($dat,$parts){
			$oldstamp =  strtotime($dat);
			$wan = $this->format_date1($oldstamp,"w");
			$yea = substr($dat,0,4);
			$mos = substr($dat,5,2);
			$da = substr($dat,8,2)*1;
			$He = substr($dat,11,2);
			$In = substr($dat,14,2);
			$Is = substr($dat,17,2);
			return $da." ".$this->mon_full($mos,"th")." ".($yea+543)."&nbsp;,$He:$In:$Is";
	} # function

	function DateConvertFull1($dat,$parts){
			$yea = substr($dat,0,4);
			$mos = substr($dat,5,2)*1;
			$da = substr($dat,8,2)*1;
			$He = substr($dat,11,2);
			$In = substr($dat,14,2);
			$Is = substr($dat,17,2);
			return $da." ".$this->mon_full($mos,"th")." ".($yea+543);
	} # function

	function DateConvertFullD($dat,$parts){
			$oldstamp =  $dat;
			$wan = $this->format_date1($oldstamp,"w");
			$da = $this->format_date1($oldstamp,'d');
			$mos = $this->format_date1($oldstamp,'M')*1;
			$yea =$this->format_date1($oldstamp,'Y');
			$He = $this->format_date1($oldstamp,'H:i:s');
			return $da." ".$this->mon_full($mos,"en")." ".($yea+543)."&nbsp;,$He";
	} # function


	function DateConvertFullAll($dat,$parts){
		$oldstamp =  strtotime($dat);
		$wan = $this->format_date1($oldstamp,"w");
		$yea = substr($dat,0,4);
		$mos = substr($dat,5,2)*1;
		$da = substr($dat,8,2)*1;
		$He = substr($dat,11,2);
		$In = substr($dat,14,2);
		$Is = substr($dat,17,2);
		return $this->day_full($wan,"th")." ที่ ".$da." ".$this->mon_full($mos,"th")." พ.ศ. ".($yea+543)."&nbsp;เวลา&nbsp;$He:$In:$Is";
	} # function

	function DateConvertFull2($dat,$parts){
		$oldstamp =  strtotime($dat);
		$wan = $this->format_date1($oldstamp,"w");
		$yea = substr($dat,0,4);
		$yea2 = substr($dat,0,4)+543;
		$yea1 = substr($dat,2,2);
		$mos = substr($dat,5,2)*1;
		$mos1 = substr($dat,5,2);
		$da = substr($dat,8,2)*1;
		$He = substr($dat,11,2);
		$In = substr($dat,14,2);
		$Is = substr($dat,17,2);
		return $this->day_sh($wan,"th")." ที่ ".$da." ".$this->mon_full($mos,"th")." พ.ศ. ".($yea+543)."&nbsp;เวลา&nbsp;$He:$In";
	} # function

	function DateConvertSHAll($dat,$parts){
		$oldstamp =  strtotime($dat);
		$wan = $this->format_date1($oldstamp,"w");
		$yea = substr($dat,0,4);
		$mos = substr($dat,5,2)*1;
		$da = substr($dat,8,2)*1;
		return $this->day_sh($wan,"th")." ที่ ".$da." ".$this->mon_sh($mos,"th")." พ.ศ. ".($yea+543);
	} # function


	   function revert_($dat,$parts){

				$a = strcspn($dat," ");
				$da = substr($dat,0,$a);
				$s2 = substr($dat,$a+1);
				$a = strcspn($s2," ");
				$mos = substr($s2,0,$a);
				$s3 = substr($s2,$a+1);


				switch($mos){
				  case "มกราคม" : {
											  $mon1="01";
											  $mon2="ม.ค.";
									  }break;
				  case "กุมภาพันธ์" : {
											  $mon1="02";  
											  $mon2="ก.พ.";
									  }break;
				  case "มีนาคม" : {
											  $mon1="03";  
											  $mon2="มี.ค.";
									  }break;
				  case "เมษายน" : {
											  $mon1="04";  
											  $mon2="เม.ย.";
									  }break;
				  case "พฤษภาคม" : {
											  $mon1="05";  
											  $mon2="พ.ค.";
									  }break;
				  case "มิถุนายน" : {
											  $mon1="06";  
											  $mon2="มิ.ย.";
									  }break;
				  case "กรกฎาคม" : {
											  $mon1="07";  
											  $mon2="ก.ค.";
									  }break;
				  case "สิงหาคม" : {
											  $mon1="08";  
											  $mon2="ส.ค.";
									  }break;
				  case "กันยายน" : {
											  $mon1="09";  
											  $mon2="ก.ย.";
									  }break;
				  case "ตุลาคม" : {
											  $mon1="10";  
											  $mon2="ต.ค.";
									  }break;
				  case "พฤศจิกายน" : {
											  $mon1="11";  
											  $mon2="พ.ย.";
									  }break;
				  case "ธันวาคม" : {
											  $mon1="12"; 
											  $mon2="ธ.ค.";
									  }break;
			}
			if(strlen($da)==1)
				$da="0".$da;
			$yea1=$s3;
			$this->sumdat=$yea1.$mon1.$da;
		}
	   
	   function DateConvertTime($dat,$parts){
			$this->DateSub=$He = substr($dat,0,10);
			$this->He=$He = substr($dat,11,2);
			$this->Ln=$In = substr($dat,14,2);
			return ($He*1).":".$In."";
		} # function
	   function DateConvertTime1($dat,$parts){
			$this->DateSub=$He = substr($dat,0,10);
			$this->He=$He = substr($dat,11,2);
			$this->Ln=$In = substr($dat,14,2);
			return ($He*1).":".$In."";
		} # function
 }#class
$conDate=new convert_date();
?>