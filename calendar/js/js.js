
function makevisible1(cur,which){
  if (which==0)
    cur.style.background='url(images/admin_modules.gif)';
  else
    cur.style.background='url(images/indicator_square.gif) no-repeat  center center';
}

	function MM_openBrWindow(theURL,winName,features) { //v2.0
	  window.open(theURL,winName,features);
	}
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = true;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
function mOver(object) {
	document.getElementById(object).className="checkrateoVER";
}
function mOut(object) {
	document.getElementById(object).className="checkrateButton";
}

function trOver(objectid) {
	document.getElementById("trid[" + objectid + "]").style.background="#FFF";
}
function trOut(objectid) {
	document.getElementById("trid[" + objectid + "]").style.background="#D2FCA8";
}

	function reloadPage() {
		document.wForm.submit();
		return false;
	}

function check_type_number() {
		t_c=event.keyCode
			if (t_c < 48 || t_c > 57) {
			event.returnValue = false;
			alert("กรุณากรอก ข้อมูลเป็นตัวเลข ด้วยค่ะ...!");
			}
		}

function check_type_number1() {
		t_c=event.keyCode
			if (t_c < 48 || t_c > 57) {
			event.returnValue = false;
			alert("Please fill Number Only");
			}
		}

function Conf(object)
{
	if (confirm("Comfirm to Delete " + object ) ==true)
	{
		return true;
	}
	return false;
}
function ConfAdd(object)
{
	if (confirm("ยืนยันการเพิ่มข้อมูล ท่านได้ตรวจสอบความถูกต้องเรียบร้อยแล้ว " + object ) ==true)
	{
		return true;
	}
	return false;
}

function CheckEng()
{  
	if((window.event.keyCode >=49 && window.event.keyCode <=57) || (window.event.keyCode >=64 && window.event.keyCode <=90) || (window.event.keyCode >=97 && window.event.keyCode <=122) || (window.event.keyCode==32) || (window.event.keyCode==46) || (window.event.keyCode==33) || (window.event.keyCode==37))   /* 64=@  */
	{
		return true;
	}else{
		event.returnValue = false;
		alert("Please fill Eng or Number Only");
		return false;
	}
}

var checkobj
function agreesubmit(el){
	checkobj=el
	if (document.all || document.getElementById){
	for (i=0;i<checkobj.form.length;i++){  //hunt down submit button
		var tempobj=checkobj.form.elements[i]
		if(tempobj.type.toLowerCase()=="submit")
			tempobj.disabled=!checkobj.checked
	}
	}
}

function checkAll(field)
{
  for(i = 0; i < field.elements.length; i++)
     field[i].checked = true ;
}

function uncheckAll(field)
{
 for(i = 0; i < field.elements.length; i++)
    field[i].checked = false ;
}
function Confirm(link,text) 
{
  if (confirm(text))
     window.location=link
}

  function delConfirm(obj){
	var status=false;
	for(var i=0 ; i < obj.elements.length ; i++ ){
		if(obj[i].type=='checkbox'){
			if(obj[i].checked==true){
				status=true;
			}
		}
	}
	if(status==false){
		alert('กรุณาเลือกข้อมูลที่ต้องการลบ.');
		return false;
	}else{
		if(confirm('คุณมั่นใจในการลบข้อมูล?')){
			return true;
		}else{
			return false;
		}
	}
}


function mov(element){
	document.getElementById("tent[" + element + "]").className="tentMainHov";
}
function mout(element){
	document.getElementById("tent[" + element + "]").className="tentMain";
}
function cmov(element){
	document.getElementById("carmain[" + element + "]").className="carMainHov";
}
function cmout(element){
	document.getElementById("carmain[" + element + "]").className="carsborder";
}
function plmover(element){
	document.getElementById("pl[" + element + "]").className="plMouseHov";
}
function plmout(element){
	document.getElementById("pl[" + element + "]").className="plborder";
}
function goTo (page) {
/* This function is called from the navigation menu
   to jump to the designated URL. Empty values
   are ignored and "--" indicates a menu seperator    */
   
	if (page != "" ) {
		if (page == "--" ) {
			resetMenu();
		} else {
			document.location.href = page;
		}
	}
	return false;
}

function reloadPage() {
		document.webForm.submit();
		console.log('hellojava');
		return false;
}
function reloadPage1() {
		document.webForm1.submit();
		return false;
}
