<?php
	class resizePIC{
	   function resizeJPG_($images,$exportfiles,$width,$parts){
				$size=GetimageSize($images);
				if($size[0]<$width)
					$width=$size[0];
				$height=round($width*$size[1]/$size[0]);
				$images_orig = ImageCreateFromJPEG($images);
				$photoX = ImagesX($images_orig);
				$photoY = ImagesY($images_orig); 
				$images_fin = ImageCreateTrueColor($width, $height); 
				ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY); 
				ImageJPEG($images_fin,$parts.$exportfiles);   #  สร้างรูปใหม่ ไว้ใน parts ทีต้องการ
				ImageDestroy($images_orig);
				ImageDestroy($images_fin); 
				#copy($exportfiles,$parts.$exportfiles);
				#unlink($exportfiles);
	   }
	   function resizeGIF_($images,$exportfiles,$width,$parts){
				$size=GetimageSize($images);
				if($size[0]<$width)
					$width=$size[0];
				$height=round($width*$size[1]/$size[0]);
				$images_orig = ImageCreateFromGIF($images);
				$photoX = ImagesX($images_orig);
				$photoY = ImagesY($images_orig); 
				$images_fin = ImageCreateTrueColor($width, $height); 
				ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY); 
				ImageGIF($images_fin,$parts.$exportfiles); 
				ImageDestroy($images_orig);
				ImageDestroy($images_fin); 
				#copy($exportfiles,$parts.$exportfiles);
				#unlink($exportfiles);
	   }
   } # class perSo
$dataPic=new resizePIC();