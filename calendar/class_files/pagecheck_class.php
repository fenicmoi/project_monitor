<?
	class pagech_{
   function pagecheck_normal_ajax($perpage,$datalink,$page_c,$perline,$row,$parts){
										 
										 
		if(!$page_c)
		{
			$st=0; $en=$st+$perpage;
		}else{
			$po=$page_c*$perpage;
			$st=$po-$perpage;
		}
		$over=$row%$perpage;  
		$pag=($row-$over)/$perpage;
		if (($over>0)&&($pag>0))   // ************ ถ้ามีมากกว่า 1 หน้าและเศษให้เพิ่มอีก 1 หน้า
		{
			 $pag=$pag+1;
		}

		if ($pag<1) // *************************** ถ้าหน้าน้อยกว่า 1 ให้เป็น 1 
		{ 
			 $pag=1;
		}

		if ($page_c<=0) // ************************ ถ้าหน้าปัจจุบันน้อยกว่า หรือ เท่ากับ 0 
		{
			$page_c=1;  // ************************** หน้าเป็นหน้าที่ 1
		}
		if ($page_c>$pag) // ************************ ถ้าหน้าปัจจุบันน้อยกว่า หรือ เท่ากับ 0
		{
			$page_c=$pag;  // ************************** หน้าเป็นหน้าที่ 1   
		}
		 if($page_c==1)
		{
			$a=1;
		 }
		else
		{
			$a=(($page_c-1)*$perpage)+1;
		}
		echo "<table border='0' cellspacing='0' cellpadding='0' style='text-align:left;FONT-FAMILY:Tahoma;font-size:1.3em'><tr><td align='center'>&nbsp;ทั้งหมด  <font class='f-blue-b'>".number_format($row)."</font> รายการ&nbsp;,&nbsp;หน้า :</td>";
		// start  link page
		$pb=$page_c-1;
		$pn=$page_c+1;
		$space_page=10;   # ช่วงแสดง
		if ($pag>0)
		{
			if($pag>$space_page){
				if($page_c<=$space_page){ 	    
					#  ถ้า หน้าปัจุบันน้อยกว่า 5 แรก

					$sp_en=$page_c+$space_page;
					if($sp_en>$pag) $sp_en=$pag;
					$spdot1="<td>...</td>";
					# จัดการเลขสิ้นสุดเท่ากับจำนวนหน้าทั้งหมด ไม่แสดง
					if($sp_en==$pag) $sp_en--; 
					# จัดการ ... สุดท้าย แสดงเมื่อตัวเลขไม่ต่อเนื่อง
					if($sp_en>($pag-2))$spdot1="";


					for ($i=1 ; $i<=$sp_en ; $i++)
					{
					  if ($i!=$page_c)
					  {  #&page_c=<?php echo $i  ********
							$datalink.=":||:$i";
							?><td><div class='plborder' id='pl[<?php echo $i?>]' onmouseover='plmover(<?php echo $i?>)' onmouseout='plmout(<?php echo $i?>)' onclick="<?php echo $datalink?>');"><?php echo $i?></a></div></td><?php
					  } else {
							 echo"<td><div class='plborder_now'><b>$i</b></a></td>";
					  }
					}  // for
					 echo $spdot1;   
					 # &page_c=<?php echo $pag  ***************
					 $datalink.=":||:$pag";
					?><td><div class='plborder' id='pl[<?php echo $i?>]' onmouseover='plmover(<?php echo $i?>)' onmouseout='plmout(<?php echo $i?>)' onclick="<?php echo $datalink?>');"><?php echo $pag?></a></div></td><?php
				}else if($page_c>$space_page && $page_c<($pag-$space_page)){ 		
						#  ถ้า หน้าปัจุบัน อยู่ในช่วง 5 แรก ถึง 5 หน้าสุดท้าย
					$sp_st=$page_c-$space_page;
					$sp_en=$page_c+$space_page;
					$spdot="<td>...</td>";
					$spdot1="<td>...</td>";

					# จัดการเลขเริ่มเป็น  1 ไม่แสดง
					if($sp_st==1) $sp_st++; 
					# จัดการเลขสิ้นสุดเท่ากับจำนวนหน้าทั้งหมด ไม่แสดง
					if($sp_en==$pag) $sp_en--; 

					# จัดการ ... แรก แสดงเมื่อตัวเลขไม่ต่อเนื่อง
					if($sp_st <3)$spdot="";
					# จัดการ ... สุดท้าย แสดงเมื่อตัวเลขไม่ต่อเนื่อง
					if($sp_en>($pag-2))$spdot1="";

							#&page_c=1   *****
							 $datalink.=":||:1";
					?><td><div class='plborder' id='pl[<?php echo $i?>]' onmouseover='plmover(<?php echo $i?>)' onmouseout='plmout(<?php echo $i?>)' onclick="<?php echo $datalink?>');">1</a></div></td><?php echo $spdot;
					for ($i=$sp_st ; $i<=$sp_en ; $i++)
					{
					  if ($i!=$page_c)
					  {  #&page_c=<?php echo $i   *************
					   $datalink.=":||:$i";
							?><td><div class='plborder' id='pl[<?php echo $i?>]' onmouseover='plmover(<?php echo $i?>)' onmouseout='plmout(<?php echo $i?>)' onclick="<?php echo $datalink?>');"><?php echo $i?></a></div></td><?php
					  } else {
							 echo"<td><div class='plborder_now'><b>$i</b></a></td>";
					  }
					}  // for
					
					#  &page_c=<?php echo $pag  **************
					 $datalink.=":||:$pag";
					 echo $spdot1;?><td><div class='plborder' id='pl[<?php echo $i?>]' onmouseover='plmover(<?php echo $i?>)' onmouseout='plmout(<?php echo $i?>)' onclick="<?php echo $datalink?>');"><?php echo $pag?></a></div></td><?php

				}else if($page_c>=($pag-$space_page)){ 		
					#  ถ้า หน้าปัจุบันมากกว่า 5 หน้าสุดท้าย
					$spdot="<td>...</td>";
					$sp_st=$page_c-$space_page;

					# จัดการเลขเริ่มเป็น  1 ไม่แสดง
					if($sp_st==1) $sp_st++; 

					# จัดการ ... แรก แสดงเมื่อตัวเลขไม่ต่อเนื่อง
					if($sp_st <3)$spdot="";
					#  &page_c=1  ************
					$datalink.=":||:1";
					?><td><div class='plborder' id='pl[<?php echo $i?>]' onmouseover='plmover(<?php echo $i?>)' onmouseout='plmout(<?php echo $i?>)' onclick="<?php echo $datalink?>');">1</a></div></td><?php echo $spdot;
					for ($i=$sp_st  ; $i<=$pag ; $i++)
					{
					  if ($i!=$page_c)
					  {  #   &page_c=<?php echo $i    *************
					   $datalink=$alink.":||:$i";
							?><td><div class='plborder' id='pl[<?php echo $i?>]' onmouseover='plmover(<?php echo $i?>)' onmouseout='plmout(<?php echo $i?>)' onclick="<?php echo $datalink?>');"><?php echo $i?></a></div></td><?php
					  } else {
							 echo"<td><div class='plborder_now'><b>$i</b></a></td>";
					  }
					}  // for
				}
		}else{ #if($pag>$space_page){
			$alink=$datalink;
			for ($i=1 ; $i<=$pag ; $i++)
			{
			  if ($i!=$page_c)
			  { 
				  #&page_c=<?php echo $i  *****************
				   $datalink=$alink.":||:$i";
					?><td><div class='plborder' id='pl[<?php echo $i?>]' onmouseover='plmover(<?php echo $i?>)' onmouseout='plmout(<?php echo $i?>)' onclick="<?php echo $datalink?>');"><?php echo $i?></div></td><?
			  } else {
					 echo"<td><div class='plborder_now'><b>$i</b></a></td>";
				 }
			}  // for

		} # if($pag>$space_page){

		}
		echo "</tr></table>";
		$this->st=$st;

   }# function

	 
	 
	function pagecheck_normal($perpage,$datalink,$page_c,$perline,$row,$parts){
										 
		if(!$page_c)
		{
			$st=0; $en=$st+$perpage;
		}else{
			$po=$page_c*$perpage;
			$st=$po-$perpage;
		}
		$over=$row%$perpage;  
		$pag=($row-$over)/$perpage;
		if (($over>0)&&($pag>0))   // ************ ถ้ามีมากกว่า 1 หน้าและเศษให้เพิ่มอีก 1 หน้า
		{
			 $pag=$pag+1;
		}

		if ($pag<1) // *************************** ถ้าหน้าน้อยกว่า 1 ให้เป็น 1 
		{ 
			 $pag=1;
		}

		if ($page_c<=0) // ************************ ถ้าหน้าปัจจุบันน้อยกว่า หรือ เท่ากับ 0 
		{
			$page_c=1;  // ************************** หน้าเป็นหน้าที่ 1
		}
		if ($page_c>$pag) // ************************ ถ้าหน้าปัจจุบันน้อยกว่า หรือ เท่ากับ 0
		{
			$page_c=$pag;  // ************************** หน้าเป็นหน้าที่ 1   
		}
		 if($page_c==1)
		{
			$a=1;
		 }
		else
		{
			$a=(($page_c-1)*$perpage)+1;
		}
		echo "<table border='0' cellspacing='0' cellpadding='0' ><tr><td  align='center' ><font class='pagesum'>&nbsp;ทั้งหมด <font class='f-red2-b'>".number_format($row)."</font>&nbsp;รายการ ,&nbsp;หน้าที่&nbsp;&nbsp;</font></td>";
		// start  link page
		$pb=$page_c-1;
		$pn=$page_c+1;
		$space_page=8;   # ช่วงแสดง
		if ($pag>0)
		{
			if($pag>$space_page){
				if($page_c<=$space_page){ 	    
					#  ถ้า หน้าปัจุบันน้อยกว่า 5 แรก

					$sp_en=$page_c+$space_page;
					if($sp_en>$pag) $sp_en=$pag;
					$spdot1="<td>...</td>";
					# จัดการเลขสิ้นสุดเท่ากับจำนวนหน้าทั้งหมด ไม่แสดง
					if($sp_en==$pag) $sp_en--; 
					# จัดการ ... สุดท้าย แสดงเมื่อตัวเลขไม่ต่อเนื่อง
					if($sp_en>($pag-2))$spdot1="";


					for ($i=1 ; $i<=$sp_en ; $i++)
					{
					  if ($i!=$page_c)
					  {
							?><td><div class='plborder'><a href='<?php echo $datalink?>&page_c=<?php echo $i?>'><?php echo $i?></a></div></td><?php
					  } else {
							 echo"<td><div class='plborder_now'><b>$i</b></a></td>";
					  }
					}  // for
					 echo $spdot1;
					?><td><div class='plborder'><a href='<?php echo $datalink?>&page_c=<?php echo $pag?>'><?php echo $pag?></a></div></td><?php
				}else if($page_c>$space_page && $page_c<($pag-$space_page)){ 		
						#  ถ้า หน้าปัจุบัน อยู่ในช่วง 5 แรก ถึง 5 หน้าสุดท้าย
					$sp_st=$page_c-$space_page;
					$sp_en=$page_c+$space_page;
					$spdot="<td>...</td>";
					$spdot1="<td>...</td>";

					# จัดการเลขเริ่มเป็น  1 ไม่แสดง
					if($sp_st==1) $sp_st++; 
					# จัดการเลขสิ้นสุดเท่ากับจำนวนหน้าทั้งหมด ไม่แสดง
					if($sp_en==$pag) $sp_en--; 

					# จัดการ ... แรก แสดงเมื่อตัวเลขไม่ต่อเนื่อง
					if($sp_st <3)$spdot="";
					# จัดการ ... สุดท้าย แสดงเมื่อตัวเลขไม่ต่อเนื่อง
					if($sp_en>($pag-2))$spdot1="";


					?><td><div class='plborder'><a href='<?php echo $datalink?>&page_c=1'>1</a></div></td><?php echo $spdot;
					for ($i=$sp_st ; $i<=$sp_en ; $i++)
					{
					  if ($i!=$page_c)
					  {
							?><td><div class='plborder'><a href='<?php echo $datalink?>&page_c=<?php echo $i?>'><?php echo $i?></a></div></td><?php
					  } else {
							 echo"<td><div class='plborder_now'><b>$i</b></a></td>";
					  }
					}  // for
					 echo $spdot1;?><td><div class='plborder'><a href='<?php echo $datalink?>&page_c=<?php echo $pag?>'><?php echo $pag?></a></div></td><?php

				}else if($page_c>=($pag-$space_page)){ 		
					#  ถ้า หน้าปัจุบันมากกว่า 5 หน้าสุดท้าย
					$spdot="<td>...</td>";
					$sp_st=$page_c-$space_page;

					# จัดการเลขเริ่มเป็น  1 ไม่แสดง
					if($sp_st==1) $sp_st++; 

					# จัดการ ... แรก แสดงเมื่อตัวเลขไม่ต่อเนื่อง
					if($sp_st <3)$spdot="";


					?><td><div class='plborder'><a href='<?php echo $datalink?>&page_c=1'>1</a></div></td><?php echo $spdot;
					for ($i=$sp_st  ; $i<=$pag ; $i++)
					{
					  if ($i!=$page_c)
					  {
							?><td><div class='plborder'><a href='<?php echo $datalink?>&page_c=<?php echo $i?>'><?php echo $i?></a></div></td><?php
					  } else {
							 echo"<td><div class='plborder_now'><b>$i</b></a></td>";
					  }
					}  // for
				}
		}else{ #if($pag>$space_page){
			for ($i=1 ; $i<=$pag ; $i++)
			{
			  if ($i!=$page_c)
			  {
					?><td><div class='plborder'><a href='<?php echo $datalink?>&page_c=<?php echo $i?>'><?php echo $i?></a></div></td><?
			  } else {
					 echo"<td><div class='plborder_now'><b>$i</b></a></td>";
				 }
			}  // for

		} # if($pag>$space_page){

		}
		echo "</tr></table>";
		$this->st=$st;


   }# function
  
	  
   function pagecheck_normal1($perpage,$datalink,$page_c,$perline,$row,$parts,$pageselect){
										 
		if(!$page_c)
		{
			$st=0; $en=$st+$perpage;
		}else{
			$po=$page_c*$perpage;
			$st=$po-$perpage;
		}
		$over=$row%$perpage;  
		$pag=($row-$over)/$perpage;
		if (($over>0)&&($pag>0))   // ************ ถ้ามีมากกว่า 1 หน้าและเศษให้เพิ่มอีก 1 หน้า
		{
			 $pag=$pag+1;
		}

		if ($pag<1) // *************************** ถ้าหน้าน้อยกว่า 1 ให้เป็น 1 
		{ 
			 $pag=1;
		}

		if ($page_c<=0) // ************************ ถ้าหน้าปัจจุบันน้อยกว่า หรือ เท่ากับ 0 
		{
			$page_c=1;  // ************************** หน้าเป็นหน้าที่ 1
		}
		if ($page_c>$pag) // ************************ ถ้าหน้าปัจจุบันน้อยกว่า หรือ เท่ากับ 0
		{
			$page_c=$pag;  // ************************** หน้าเป็นหน้าที่ 1   
		}
		 if($page_c==1)
		{
			$a=1;
		 }
		else
		{
			$a=(($page_c-1)*$perpage)+1;
		}
		echo "<table border='0' cellspacing='0' cellpadding='0' >
		<tr><td width='20' align='right'>&nbsp;หน้า :</td>";
		// start  link page
		$pb=$page_c-1;
		$pn=$page_c+1;
		if(!$pageselect) $page_c=$pag;
		if ($pag>0)
		{
			for ($i=1 ; $i<=$pag ; $i++)
			{
				if(($i%$perline)==0)
					echo "</tr><tr><td width='50'>&nbsp;</td>";

			  if ($i!=$page_c)
			  {
					?><td>&nbsp;<a href='<?php echo $datalink?>page_c=<?php echo $i?>' class='1'><?php echo $i?></a>&nbsp;</td><?
			  } else {
					 echo"<td>&nbsp;<font class='st5'><b>$i</b>&nbsp;</td>";
				 }
			}  // for
		}
		echo "</tr></table>";
		if(!$pageselect)
			$this->nowpage=$pag;

			$this->st=$st;


   }# function
   
   } # class perSo
$dataPC=new pagech_();


