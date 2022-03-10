var xmlHttp;

	function createXMLHttpRequest()
	{
	 if (window.ActiveXObject) {
		    xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		 } else if (window.XMLHttpRequest) {
			 xmlHttp = new XMLHttpRequest();
		 }
	}

function Inint_AJAX() {
   try { return new ActiveXObject("Msxml2.XMLHTTP"); } catch(e) {} //IE
   try { return new ActiveXObject("Microsoft.XMLHTTP"); } catch(e) {} //IE
   try { return new XMLHttpRequest(); } catch(e) {} //Native Javascript
   alert("XMLHttpRequest not supported")
   return null
}


function sendpost(value) {
  var req = Inint_AJAX(); //สร้าง Object
  req.open('POST', 'modules/user/loginprocess.php', true); //กำหนด สถานะการทำงานของ AJAX แบบ POST
  req.onreadystatechange = function() { //เหตุการณ์เมื่อมีการตอบกลับ
  document.getElementById("fLogin").innerHTML="<center><br><br><img src='images/progressbar_microsoft.gif'><br>Processcing Login Please wait</center>";
    if (req.readyState==4) {
      if (req.status==200) { //ได้รับการตอบกลับเรียบร้อย
        var data=req.responseText; //ข้อความที่ได้มาจากการทำงานของ test3.php
        document.getElementById("fLogin").innerHTML=data; //แสดงผล
      }
    }
  };
  req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); //Header ที่ส่งไป
  //req.send("value="+encodeURIComponent(value)); //ทำการส่งข้อมูลผ่านคำสั่ง SEND
var query = getRequestBody(document.loginForm);
  req.send(query); //ส่งค่า
};



function getRequestBody(loginForm) {//รับ formname
  var nParams = new Array();
  for ( var n = 0 ; n < loginForm.elements.length ; n++ )
  {
		  var pParam = encodeURIComponent( loginForm.elements[n].name );
		  pParam += "=";
		  pParam += encodeURIComponent( loginForm.elements[n].value );
		  nParams.push( pParam ); //นำมาใส่ Array
  }
  return nParams.join( "&" ); //แปลง Array ให้เป็น String
}


function saveaddcar(value) {
  var req = Inint_AJAX(); //สร้าง Object
  req.open('POST', 'ajaxSubport/action/saveaddcar.php', true); //กำหนด สถานะการทำงานของ AJAX แบบ POST
  req.onreadystatechange = function() { //เหตุการณ์เมื่อมีการตอบกลับ
  document.getElementById("saveaddcar").innerHTML="<center><br><br><img src='images/progressbar_microsoft.gif'><br>Processcing Login Please wait</center>";
    if (req.readyState==4) {
      if (req.status==200) { //ได้รับการตอบกลับเรียบร้อย
        var data=req.responseText; //ข้อความที่ได้มาจากการทำงานของ test3.php
        document.getElementById("saveaddcar").innerHTML=data; //แสดงผล
      }
    }
  };
  req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); //Header ที่ส่งไป
  //req.send("value="+encodeURIComponent(value)); //ทำการส่งข้อมูลผ่านคำสั่ง SEND
var query = getInputFild(document.addcarForm);
  req.send(query); //ส่งค่า
};

function getInputFild(webForm) {//รับ formname
  var nParams = new Array();
  for ( var n = 0 ; n < webForm.elements.length ; n++ )
  {
		  var pParam = encodeURIComponent( webForm.elements[n].name );
		  pParam += "=";
		  pParam += encodeURIComponent( webForm.elements[n].value );
		  nParams.push( pParam ); //นำมาใส่ Array
   }
  return nParams.join( "&" ); //แปลง Array ให้เป็น String
}


function showGen(element) {
  var req=Inint_AJAX();
  var url = "ajaxSubport/event/showGen.php?data="  + new Date().getTime() + Math.random() + ":||:" + element;            
  document.getElementById("showgen").innerHTML='<img src="images/indicator_tiny_red.gif" alt="loadding" style="margin:6px 0px 5px 4px"/>';
  req.onreadystatechange = function () {
    if (req.readyState==4) {
      if (req.status==200) {
        var data=req.responseText; //รับค่ากลับมา
        document.getElementById("showgen").innerHTML=data; //แสดงผล
		showFace('xx');
      }
    }
  };
  req.open("GET", url, true);
  req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // set Header
  req.send(null);  //ส่งค่า
}

function showFace(element) {
  var req=Inint_AJAX();
  var url = "ajaxSubport/event/showFace.php?data="  + new Date().getTime() + Math.random() + ":||:" + element;            
  document.getElementById("showface").innerHTML='<img src="images/indicator_tiny_red.gif" alt="loadding" style="margin:6px 0px 5px 4px"/>';
  req.onreadystatechange = function () {
    if (req.readyState==4) {
      if (req.status==200) {
        var data=req.responseText; //รับค่ากลับมา
        document.getElementById("showface").innerHTML=data; //แสดงผล
      }
    }
  };
  req.open("GET", url, true);
  req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // set Header
  req.send(null);  //ส่งค่า
}

function sGen(element) {
  var req=Inint_AJAX();
  var url = "ajaxSubport/event/searchGen.php?data="  + new Date().getTime() + Math.random() + ":||:" + element;            
  document.getElementById("showgen").innerHTML='<img src="images/indicator_tiny_red.gif" alt="loadding" style="margin:6px 0px 5px 4px"/>';
  req.onreadystatechange = function () {
    if (req.readyState==4) {
      if (req.status==200) {
        var data=req.responseText; //รับค่ากลับมา
        document.getElementById("showgen").innerHTML=data; //แสดงผล
		showFace('xx');
      }
    }
  };
  req.open("GET", url, true);
  req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // set Header
  req.send(null);  //ส่งค่า
}

function sFace(element) {
  var req=Inint_AJAX();
  var url = "ajaxSubport/event/searchFace.php?data="  + new Date().getTime() + Math.random() + ":||:" + element;            
  document.getElementById("showface").innerHTML='<img src="images/indicator_tiny_red.gif" alt="loadding" style="margin:6px 0px 5px 4px"/>';
  req.onreadystatechange = function () {
    if (req.readyState==4) {
      if (req.status==200) {
        var data=req.responseText; //รับค่ากลับมา
        document.getElementById("showface").innerHTML=data; //แสดงผล
      }
    }
  };
  req.open("GET", url, true);
  req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // set Header
  req.send(null);  //ส่งค่า
}




function showtentcars(element) {
  var req=Inint_AJAX();
  var url = "../showtentcars.php?data="  + new Date().getTime() + Math.random() + ":||:" + element;            
  document.getElementById("tentcars").innerHTML="<p class='loading'><img src='../../images/roller.gif' alt='loadding' style='margin:auto;'/></p>";
  req.onreadystatechange = function () {
    if (req.readyState==4) {
      if (req.status==200) {
        var data=req.responseText; //รับค่ากลับมา
        document.getElementById("tentcars").innerHTML=data; //แสดงผล
      }
    }
  };
  req.open("GET", url, true);
  req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // set Header
  req.send(null);  //ส่งค่า
}

function updateSale(element) {
  var req=Inint_AJAX();
  var url = "ajaxSubport/event/carssele.php?data="  + new Date().getTime() + Math.random() + ":||:Sale:||:" + element;            
  document.getElementById("carssele[" + element + "]").innerHTML="<img src='images/indicator_tiny_red.gif' alt='loadding' style='margin:auto;'/>";
  req.onreadystatechange = function () {
    if (req.readyState==4) {
      if (req.status==200) {
        var data=req.responseText; //รับค่ากลับมา
        document.getElementById("carssele[" + element + "]").innerHTML=data; //แสดงผล
      }
    }
  };
  req.open("GET", url, true);
  req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // set Header
  req.send(null);  //ส่งค่า
}

function updateNotSale(element) {
  var req=Inint_AJAX();
  var url = "ajaxSubport/event/carssele.php?data="  + new Date().getTime() + Math.random() + ":||:Not:||:" + element;            
  document.getElementById("carssele[" + element + "]").innerHTML="<img src='images/indicator_tiny_red.gif' alt='loadding' style='margin:auto;'/>";
  req.onreadystatechange = function () {
    if (req.readyState==4) {
      if (req.status==200) {
        var data=req.responseText; //รับค่ากลับมา
        document.getElementById("carssele[" + element + "]").innerHTML=data; //แสดงผล
      }
    }
  };
  req.open("GET", url, true);
  req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // set Header
  req.send(null);  //ส่งค่า
}

function showcarPreview(element) {
  var req=Inint_AJAX();
    var url = "../ajaxSubport/event/showCarImg.php?data="  + new Date().getTime() + Math.random() + ":||:" + element;            
  document.getElementById("carImgBig").innerHTML="<img src='../images/desmm_load_w.gif' alt='loadding' style='margin:100px auto;'/><br>กำลังโหลดภาพ...!";
  req.onreadystatechange = function () {
    if (req.readyState==4) {
      if (req.status==200) {
        var data=req.responseText; //รับค่ากลับมา
        document.getElementById("carImgBig").innerHTML=data; //แสดงผล
      }
    }
  };
  req.open("GET", url, true);
  req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // set Header
  req.send(null);  //ส่งค่า
}

function ShowFinance(value) {
  var req = Inint_AJAX(); //สร้าง Object
  req.open('POST', '../ajaxSubport/event/Finance.php', true); //กำหนด สถานะการทำงานของ AJAX แบบ POST
  req.onreadystatechange = function() { //เหตุการณ์เมื่อมีการตอบกลับ
  document.getElementById("showFN").innerHTML="<img src='../images/roller.gif' alt='loadding' style='margin:0px auto;'/>";
    if (req.readyState==4) {
      if (req.status==200) { //ได้รับการตอบกลับเรียบร้อย
        var data=req.responseText; //ข้อความที่ได้มาจากการทำงานของ test3.php
        document.getElementById("showFN").innerHTML=data; //แสดงผล
      }
    }
  };
  req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); //Header ที่ส่งไป
  //req.send("value="+encodeURIComponent(value)); //ทำการส่งข้อมูลผ่านคำสั่ง SEND
var query = getInputFild(document.formFN);
  req.send(query); //ส่งค่า
};

