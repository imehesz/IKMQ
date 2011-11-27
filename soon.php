<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Coming Soon!</title>
<script language="JavaScript">
TargetDate = "12/31/2011 12:00 AM";
BackColor = "palegreen";
ForeColor = "navy";
CountActive = true;
CountStepper = -1;
LeadingZero = true;
DisplayFormat = "%%D%% <span class='date-text'>Days</span> %%H%% <span class='date-text'>Hours</span> %%M%% <span class='date-text'>Minutes</span> %%S%% <span class='date-text'>Seconds</span>";
FinishMessage = "It is finally here!";
</script>

<style>

body {
margin: 0px;
padding: 0px;
		 font-family: Arial, Helvetica, sans-serif;
width: 100%;
height: 100%;
background: url( images/uwall.jpg );
color: #fff;
}

#page {
margin: 100px 0px 100px 0px;
		text-align: center;
width: 100%;
}

#footer {
		font-size: 10px;
		line-height: 12px;
		margin-top: 20px;
		padding-top: 20p;
color: #ddd;
float: left;
width: 100%;
	   text-align: center;
}

#footer a {
	   text-decoration: none;
	   color: #ddd;
}

#footer a:hover {
color: #566D7E;
}

#cntdwn
{
	font-size:46px;
}

.date-text
{
	color: #aaa;
	font-size: 14px;
}

h1 { text-shadow: 0px 8px 12px #aaa }
</style>
</head>
<body>
<div id='page'>
<h1 title="It's a lame coming soon page ... I know :/">COMING SOON</h1>
<span id='cntdwn'></span>
<p>This website is coming soon, please check back later.</p>
<p style="margin-top:50px;">
	<a href="http://twitter.com/I_Know_Quotes" target="_blank" title="Follow us on Twitter!"><img border="0" src="images/twitter_small.jpg"></a> 
	<a href="http://www.facebook.com/pages/IKQ/210513355644472" target="_blank" title="LIKE us on Facebook!"><img border="0" src="images/facebook_small.jpg"></a>
</p>
</div>
<div id="footer">
<p>&copy; <a href="http://iknowquotes.com" title="Home">IKnowQuotes</a> <?php echo date('Y', time() ) ?>.</p>
</div>
</body>
<script>
function calcage(secs, num1, num2) {
  s = ((Math.floor(secs/num1))%num2).toString();
  if (LeadingZero && s.length < 2)
    s = "0" + s;
  return "<b>" + s + "</b>";
}

function CountBack(secs) {
  if (secs < 0) {
    document.getElementById("cntdwn").innerHTML = FinishMessage;
    return;
  }
  DisplayStr = DisplayFormat.replace(/%%D%%/g, calcage(secs,86400,100000));
  DisplayStr = DisplayStr.replace(/%%H%%/g, calcage(secs,3600,24));
  DisplayStr = DisplayStr.replace(/%%M%%/g, calcage(secs,60,60));
  DisplayStr = DisplayStr.replace(/%%S%%/g, calcage(secs,1,60));

  document.getElementById("cntdwn").innerHTML = DisplayStr;
  if (CountActive)
    setTimeout("CountBack(" + (secs+CountStepper) + ")", SetTimeOutPeriod);
}

function putspan(backcolor, forecolor) {
 document.write("<span id='cntdwn' style='background-color:" + backcolor + "; color:" + forecolor + "'></span>");
}

if (typeof(BackColor)=="undefined")
  BackColor = "white";
if (typeof(ForeColor)=="undefined")
  ForeColor= "black";
if (typeof(TargetDate)=="undefined")
  TargetDate = "12/31/2020 5:00 AM";
if (typeof(DisplayFormat)=="undefined")
  DisplayFormat = "%%D%% <span style='color:#f00;'>Days</span>, %%H%% Hours, %%M%% Minutes, %%S%% Seconds.";
if (typeof(CountActive)=="undefined")
  CountActive = true;
if (typeof(FinishMessage)=="undefined")
  FinishMessage = "";
if (typeof(CountStepper)!="number")
  CountStepper = -1;
if (typeof(LeadingZero)=="undefined")
  LeadingZero = true;

CountStepper = Math.ceil(CountStepper);
if (CountStepper == 0)
  CountActive = false;
var SetTimeOutPeriod = (Math.abs(CountStepper)-1)*1000 + 990;
//putspan(BackColor, ForeColor);
var dthen = new Date(TargetDate);
var dnow = new Date();
if(CountStepper>0)
  ddiff = new Date(dnow-dthen);
else
  ddiff = new Date(dthen-dnow);
gsecs = Math.floor(ddiff.valueOf()/1000);
CountBack(gsecs);
</script>
</html>
