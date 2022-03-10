		 <img src='images/arrow-right.png'>&nbsp;<font class='f-glay-big'>โปรโมชั่นพิเศษของเรา</font>
			<TABLE width="100%" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD>
						<?
						$FileAboutUs = "promotion/promotion.txt";
						$FileAboutUsOpen = @fopen($FileAboutUs, "r");
						$AboutUsContent = @fread ($FileAboutUsOpen, @filesize($FileAboutUs));
						@fclose ($FileAboutUsOpen);
						$AboutUsContent = stripslashes($AboutUsContent);
						echo $AboutUsContent;
						?>
					</TD>
				</TR>
			</TABLE>