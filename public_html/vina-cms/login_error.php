<html>
<title>Administrator</title>
<link rel="SHORTCUT ICON" href="favicon.jpg" type="image/png">
</html>
<style type="text/css">
<!--
.ahgcrewstyle{color:#F00;}
.ahg{color:#0F0;}
-->
</style>
</head><body oncontextmenu="return false" alink="gray" bgcolor="black" vlink="gray" link="gray" text="gray">
<p></p><center>
<script language="javascript">
document.onmousedown=disableclick;
status="Right Click Disabled";
Function disableclick(e)
{
  if(event.button==2)
   {
     alert(status);
     return false;  
   }
}
</script>
<script type="text/javascript"> 
TypingText = function(element, interval, cursor, finishedCallback) {
  if((typeof document.getElementById == "undefined") || (typeof element.innerHTML == "undefined")) {
    this.running = true;
    return;
  }
  this.element = element;
  this.finishedCallback = (finishedCallback ? finishedCallback : function() { return; });
  this.interval = (typeof interval == "undefined" ? 100 : interval);
  this.origText = this.element.innerHTML;
  this.unparsedOrigText = this.origText;
  this.cursor = (cursor ? cursor : "");
  this.currentText = "";
  this.currentChar = 0;
  this.element.typingText = this;
  if(this.element.id == "") this.element.id = "typingtext" + TypingText.currentIndex++;
  TypingText.all.push(this);
  this.running = false;
  this.inTag = false;
  this.tagBuffer = "";
  this.inHTMLEntity = false;
  this.HTMLEntityBuffer = "";
}
TypingText.all = new Array();
TypingText.currentIndex = 0;
TypingText.runAll = function() {
  for(var i = 0; i < TypingText.all.length; i++) TypingText.all[i].run();
}
TypingText.prototype.run = function() {
  if(this.running) return;
  if(typeof this.origText == "undefined") {
    setTimeout("document.getElementById('" + this.element.id + "').typingText.run()", this.interval);
    return;
  }
  if(this.currentText == "") this.element.innerHTML = "";
  if(this.currentChar < this.origText.length) {
    if(this.origText.charAt(this.currentChar) == "<" && !this.inTag) {
      this.tagBuffer = "<";
      this.inTag = true;
      this.currentChar++;
      this.run();
      return;
    } else if(this.origText.charAt(this.currentChar) == ">" && this.inTag) {
      this.tagBuffer += ">";
      this.inTag = false;
      this.currentText += this.tagBuffer;
      this.currentChar++;
      this.run();
      return;
    } else if(this.inTag) {
      this.tagBuffer += this.origText.charAt(this.currentChar);
      this.currentChar++;
      this.run();
      return;
    } else if(this.origText.charAt(this.currentChar) == "&" && !this.inHTMLEntity) {
      this.HTMLEntityBuffer = "&";
      this.inHTMLEntity = true;
      this.currentChar++;
      this.run();
      return;
    } else if(this.origText.charAt(this.currentChar) == ";" && this.inHTMLEntity) {
      this.HTMLEntityBuffer += ";";
      this.inHTMLEntity = false;
      this.currentText += this.HTMLEntityBuffer;
      this.currentChar++;
      this.run();
      return;
    } else if(this.inHTMLEntity) {
      this.HTMLEntityBuffer += this.origText.charAt(this.currentChar);
      this.currentChar++;
      this.run();
      return;
    } else {
      this.currentText += this.origText.charAt(this.currentChar);
    }
    this.element.innerHTML = this.currentText;
    this.element.innerHTML += (this.currentChar < this.origText.length - 1 ? (typeof this.cursor == "function" ? this.cursor(this.currentText) : this.cursor) : "");
    this.currentChar++;
    setTimeout("document.getElementById('" + this.element.id + "').typingText.run()", this.interval);
  } else {
    this.currentText = "";
    this.currentChar = 0;
        this.running = false;
        this.finishedCallback();
  }
}
</script>  
<br /><center>
<p align="center"> <font style="color:#808080;font-size:80px;font-family: 'Iceland', cursive;font-weight:700;"> 
<script> 
farbbibliothek = new Array();
farbbibliothek[0] = new Array("#FF0000","#FF1100","#FF2200","#FF3300","#FF4400","#FF5500","#FF6600","#FF7700","#FF8800","#FF9900","#FFaa00","#FFbb00","#FFcc00","#FFdd00","#FFee00","#FFff00","#FFee00","#FFdd00","#FFcc00","#FFbb00","#FFaa00","#FF9900","#FF8800","#FF7700","#FF6600","#FF5500","#FF4400","#FF3300","#FF2200","#FF1100"); 
farbbibliothek[1] = new Array("#00FF00","#000000","#00FF00","#00FF00"); 
farbbibliothek[2] = new Array("#00FF00","#FF0000","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00"); 
farbbibliothek[3] = new Array("#FF0000","#FF4000","#FF8000","#FFC000","#FFFF00","#C0FF00","#80FF00","#40FF00","#00FF00","#00FF40","#00FF80","#00FFC0","#00FFFF","#00C0FF","#0080FF","#0040FF","#0000FF","#4000FF","#8000FF","#C000FF","#FF00FF","#FF00C0","#FF0080","#FF0040"); 
farbbibliothek[4] = new Array("#FF0000","#EE0000","#DD0000","#CC0000","#BB0000","#AA0000","#990000","#880000","#770000","#660000","#550000","#440000","#330000","#220000","#110000","#000000","#110000","#220000","#330000","#440000","#550000","#660000","#770000","#880000","#990000","#AA0000","#BB0000","#CC0000","#DD0000","#EE0000"); 
farbbibliothek[5] = new Array("#000000","#000000","#000000","#FFFFFF","#FFFFFF","#FFFFFF"); 
farbbibliothek[6] = new Array("#0000FF","#FFFF00"); 
farben = farbbibliothek[4];
function farbschrift() 
{ 
for(var i=0 ; i<Buchstabe.length; i++) 
{ 
document.all["a"+i].style.color=farben[i]; 
} 
farbverlauf(); 
} 
function string2array(text) 
{ 
Buchstabe = new Array(); 
while(farben.length<text.length) 
{ 
farben = farben.concat(farben); 
} 
k=0; 
while(k<=text.length) 
{ 
Buchstabe[k] = text.charAt(k); 
k++; 
} 
} 
function divserzeugen() 
{ 
for(var i=0 ; i<Buchstabe.length; i++) 
{ 
document.write("<span id='a"+i+"' class='a"+i+"'>"+Buchstabe[i] + "</span>"); 
} 
farbschrift(); 
} 
var a=1; 
function farbverlauf() 
{ 
for(var i=0 ; i<farben.length; i++) 
{ 
farben[i-1]=farben[i]; 
} 
farben[farben.length-1]=farben[-1]; 
setTimeout("farbschrift()",30); 
} 
//BaoKun #SadBoys1992...
var farbsatz=1; 
function farbtauscher() 
{ 
farben = farbbibliothek[farbsatz]; 
while(farben.length<text.length) 
{ 
farben = farben.concat(farben); 
} 
farbsatz=Math.floor(Math.random()*(farbbibliothek.length-0.0001)); 
} 
setInterval("farbtauscher()",5000); 
text= " || Nhập sai quá 3 lần || "; //h 
string2array(text); 
divserzeugen(); 
//document.write(text);</script> 
<?
$_SESSION["login_admin_user"] = "";
$_SESSION["login_admin_pass"] = "";
?>
<br />
<p id="message"><font style="color:#FF0000;font-size:50px;font-family: 'Iceland', cursive;">
LOGIN ADMIN <br /> <font style="color:white;font-size:120px;font-family: 'Iceland', cursive;font-weight:700;text-shadow:0px 0px 30px red, 0px 0px 60px red;"><span class="blink_tex">Has Been Locked</span></font>
<br>
<font style="color:#04B404;font-weight:bold;font-size:22px;font-family: cursive;text-shadow: 0 0 25px blue, 0px 0px 50px blue;line-height: 38px;display: block;margin-bottom: 20px;margin-top: 20px">Có nhiều người dành cả cuộc đời để tìm được tình yêu đích thực. <br> Nhưng có vài người thì việc ráng nhớ cái mật khẩu cũng mất hết mọe nửa cuộc đời.</font>

<font size="6" color="#000000" style="font-weight: bold; text-shadow: 0 0 6px #FF0000, 0 0 5px #FF0000, 0 0 5px #FF0000;">Contact Us :
</font>
<a href="tel:0943426600" style='text-decoration: none;'><font color='#FFFFFF' size='6' face='Agency FB' style='text-decoration: none; font-weight: bold; text-shadow: 0 0 6px #FF0000, 0 0 5px #FF0000, 0 0 5px #FF0000;'>VinaDesign - 0943 426 600</font></font></a><br><br>
<footer id="det" style="position:fixed; left:0px; right:0px; bottom:0px; text-align:center; border-top: 1px solid #FF0000; border-bottom: 1px solid #FF0000">
<font color="#000000" size="5" face="Agency FB" style="font-weight: bold; text-shadow: 0 0 6px #FF0000, 0 0 5px #FF0000, 0 0 5px #FF0000;">We Are :
</font>
<marquee align="center" direction="left" behavior="alternate" scrollamount="2" scrolldelay="50" width="80%"><font color="#FFFFFF" style="font-weight: bold; font-size:25px; text-shadow: 0 0 6px #FF0000, 0 0 5px #FF0000, 0 0 5px #FF0000;"><?=admin_company?>#Team | <?=admin_name?>#<?=admin_email?> | <?=admin_phone?></FONT></marquee>

</footer>
<style type="text/css">

.blink_text {-webkit-animation-name: blinker;-webkit-animation-duration: 3s;-webkit-animation-timing-function: linear;-webkit-animation-iteration-count: infinite;-moz-animation-name: blinker;-moz-animation-duration: 3s;-moz-animation-timing-function: linear;-moz-animation-iteration-count: infinite;animation-name: blinker;animation-duration: 3s;animation-timing-function: linear;animation-iteration-count: infinite;color: red;}
@-moz-keyframes blinker {  0% { opacity: 5.0; }50% { opacity: 0.0; }100% { opacity: 5.0; }}
@-webkit-keyframes blinker {  0% { opacity: 5.0; }50% { opacity: 0.0; }100% { opacity: 5.0; }}
@keyframes blinker {  0% { opacity: 5.0; }50% { opacity: 0.0; }100% { opacity: 5.0; }}
</style> 
<style>
*{margin: 0; padding: 0;}
body {background: #000000; scrollbar-track-color: #000000;scrollbar-darkshadow-color: #000000; scrollbar-face-color: #000000; scrollbar-shadow-color: #FFFFFF; scrollbar-highlight-color: #FFFFFF; scrollbar-3dlight-color: #000000;  scrollbar-arrow-color: #FFFFFF; color:#8E959E;overflow: hidden;}
@media (max-width: 991px){
    body{overflow:inherit;}
}
.name { text-decoration: none;}
/*@-moz-keyframes roll { 100% { -moz-transform: rotate(720deg); } }
@-o-keyframes roll { 100% { -o-transform: rotate(720deg); } }
@-webkit-keyframes roll { 100% { -webkit-transform: rotate(720deg); } }
body{-moz-animation-name: roll;-moz-animation-duration: 3s;-moz-animation-iteration-count: 1;-o-animation-name: roll;-o-animation-duration: 3s;-o-animation-iteration-count: 1;-webkit-animation-name: roll;-webkit-animation-duration: 3s;-webkit-animation-iteration-count: 1;}*/
</style>
<script type="text/javascript" src="js/rain.js"></script>
<script type="text/javascript" src="js/rain.js"></script>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,300italic,400italic,600italic,700italic,700,800,800italic' rel='stylesheet' type='text/css'>
<script type="text/javascript"> 
new TypingText(document.getElementById("message"), 50, function(i){ var ar = new Array("\\", "|", "/", "-"); return " " + ar[i.length % ar.length]; });
//Type out examples:
TypingText.runAll();

