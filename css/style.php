<?php header ("Content-type: text/css"); ?>
.newUser {
 -webkit-animation: color_change 1s infinite alternate;
 -moz-animation: color_change 1s infinite alternate;
 -ms-animation: color_change 1s infinite alternate;
 -o-animation: color_change 1s infinite alternate;
 animation: color_change 1s infinite alternate;
}

@-webkit-keyframes color_change {
 from { color: red; }
 to { color: white; }
}
@-moz-keyframes color_change {
 from { color: red; }
 to { color: white; }
}
@-ms-keyframes color_change {
 from { color: red; }
 to { color: white; }
}
@-o-keyframes color_change {
 from { color: red; }
 to { color: white; }
}
@keyframes color_change {
 from { color: red; }
 to { color: white; }
}
body 
{
	background-color:#202020;
	margin-top: 0px;
	margin-bottom: 0px;

}
html {
	font-family: Verdana, Geneva, sans-serif;
	font-weight: bold;
}
#wrapper
{
	width: 100%;
	height: 100%;
	min-width: 680px;
	position: fixed;
}
label
{

	font-size: 14px;
	font-weight: bold;
}
formtext
{
	display: inline-block;
    min-width: 150px;
	margin-right: 25px;
    text-align: right;
}
input
{
	float: right;
	margin-left: 10px;
	outline-color: red;
}
p
{
	text-align: right;
}
#main
{
	position: relative;
	margin-top: 50px;
	right: 8px;
	width: 100%;
	height: 95%;
	background-color:#404040;
	color: #FFFFFF;
	-moz-box-shadow: 0 0 5px 5px #404040;
	-webkit-box-shadow: 0 0 5px 5px #404040;
	box-shadow: 0 0 5px 5px #404040;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	border-radius: 4px;
	overflow-y: -moz-scrollbars-none;
}
#center
{
	position: relative;
	margin-top: 25px;
	margin-bottom: 25px;
	width: 640px;
	height: 360;
	-moz-box-shadow: 0 0 10px 2px #200000;
	-webkit-box-shadow: 0 0   10px 2px #200000;
	box-shadow: 0 0 10px 2px #200000;
}
#login
{
	position: relative;
	margin: 0 auto;
}
#textfield
{
	background-color:#404040; 
	border: 0;color: #FFFFFF;
	-moz-border-radius: 4px; 
	-webkit-border-radius: 4px; 
	border-radius: 4px;
}
#searchbar
{
	display: inline-block;
	position: absolute;
	max-width: 500px;
	height: 28px;
	right: 20px;
	margin-top: 5px;
	-moz-box-shadow: 0 0 10px 2px #FFFFFF;
	-webkit-box-shadow: 0 0   10px 2px #FFFFFF;
	box-shadow: 0 0 10px 2px #FFFFFF;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	border-radius: 4px;
	align:center;
}
#header
{
	color: #FFFFFF;
	position: relative;
	display: inline-block;
	float: left;
	margin-top: 5px;
	padding-right: 5px;
	padding-left: 5px;
    background-color: #101010;
    max-width: 700px;
	height: 28px;
	-moz-box-shadow: 0 0 10px 2px #FFFFFF;
	-webkit-box-shadow: 0 0   10px 2px #FFFFFF;
	box-shadow: 0 0 10px 2px #FFFFFF;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	border-radius: 4px;
	

}
#submit
{
	background-color: #101010;
	font: bold 12px/18px sans-serif;
	margin-left: 5px;
	color: #FFFFFF;
	border: 0;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	border-radius: 4px;
}
#submit:hover
{
	color: red;
	cursor:pointer;
	-webkit-transition: all 0.2s;
	-moz-transition: all 0.2s;
	-ms-transition: all 0.2s;
	-o-transition: all 0.2s;
	transition: all 0.2s;

}
#button
{
	background-color: #303030;
	font: bold 16px/18px sans-serif;
	color: #FFFFFF;
	border: 0;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	border-radius: 4px;
	margin-top: 5px;
	float: right;
}
#button:hover
{
	color: red;
	cursor:pointer;
	-webkit-transition: all 0.2s;
	-moz-transition: all 0.2s;
	-ms-transition: all 0.2s;
	-o-transition: all 0.2s;
	transition: all 0.2s;
}
h1 
{
	font-size: 23px;
	text-align: center;
}
h2 
{
	color: red;
	font-size: 12px;
	text-align: center;
}
h3 
{
	color: green;
	font-size: 12px;
	text-align: center;
}

ul 
{
  text-align: Left;
  display: inline;
  margin: 0;
  padding: 15px 4px 17px 0;
  list-style: none;
}
ul li 
{
  color: #FFFFFF;
  font: bold 12px/18px sans-serif;
  display: inline-block;
  margin-right: -4px;
  position: relative;
  padding: 5px 7px;
  background-color: #101010;
  cursor: pointer;
  -webkit-transition: all 0.2s;
  -moz-transition: all 0.2s;
  -ms-transition: all 0.2s;
  -o-transition: all 0.2s;
  transition: all 0.2s;
}
ul li:hover 
{
  color: red;
}
.wrapper
{
    display: table;
    table-layout: relative;
    width: 610px;
	min-height: 550px;
	margin:0 auto;
}
#videocontainer
{
	display: inline-block;
	float: left;
	height: 400px;
	width: 640px;
	margin-left: 50px;
	text-align: center
}
.metadataContainer
{
	display: inline-block;
	height: 300px;
	width: 182px;
	margin-top: 50px;
	float: right;
	top: 0px;
	margin-right: 50px;
	text-align: center;
	
}
#contentWrapper 
{
    width:1000px;
    height:500px;
    margin: 0 auto;
    text-align:center;
}
#moviePosterContainer
{
	display: inline-block;
	height: 260px;
	width: 168px;
	margin-bottom: 10px;
	text-align: center;
	margin-right:7px;
	margin-left: 7px;
	white-space:nowrap;
	overflow: hidden;
	vertical-align: top;
}
#moviePosterContainer:hover
{
	cursor:pointer;
	background-color: #202020;
	-moz-box-shadow: 0 0 5px 5px #FFFFFF;
	-webkit-box-shadow: 0 0 5px 5px #FFFFFF;
	box-shadow: 0 0 5px 5px #FFFFFF;
}

#posters
{
	width: 150px;
	height: 222px;
	margin-top: 5px;
	-webkit-box-shadow: 5px 5px 5px 0px rgba(0,0,0,0.75);
	-moz-box-shadow: 5px 5px 5px 0px rgba(0,0,0,0.75);
	box-shadow: 5px 5px 5px 0px rgba(0,0,0,0.75);
	bottom: 0;
}
#recentlyAddedWrapper
{
    max-width:95%;
    height:300px;
    margin: 0 auto;
	white-space: nowrap;
	background-color: #303030;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	border-radius: 4px;
	overflow-x: -moz-scrollbars-none;
}
#recentlyAddedWrapper2
{
    max-width:95%;
    height:300px;
    margin: 0 auto;
	white-space: nowrap;
	background-color: #303030;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	border-radius: 4px;
	overflow-x: -moz-scrollbars-none;
	display: none;
}
.tableDiv {
	margin:0px;padding:0px;
	width:100%;
}.tableDiv table{
    border-collapse: collapse;
    border-spacing: 0;

}.tableDiv tr:last-child td:last-child {
	-moz-border-radius-bottomright:0px;
	-webkit-border-bottom-right-radius:0px;
	border-bottom-right-radius:0px;
}
.tableDiv table tr:first-child td:first-child {
	-moz-border-radius-topleft:0px;
	-webkit-border-top-left-radius:0px;
	border-top-left-radius:0px;
}
.tableDiv table tr:first-child td:last-child {
	-moz-border-radius-topright:0px;
	-webkit-border-top-right-radius:0px;
	border-top-right-radius:0px;
}.tableDiv tr:last-child td:first-child{
	-moz-border-radius-bottomleft:0px;
	-webkit-border-bottom-left-radius:0px;
	border-bottom-left-radius:0px;
}.tableDiv tr:hover td{
	
}
.tableDiv tr:nth-child(odd){ background-color:#adadad; }
.tableDiv tr:nth-child(even)    { background-color:#6b6b6b; }
.tableDiv td{
	vertical-align:middle;
	align: center;
	border:1px solid #000000;
	border-width:0px 1px 1px 0px;
	text-align:left;
	padding:7px;
	font-size:14px;
	font-family:Arial;
	font-weight:bold;
	color:White;
}.tableDiv tr:last-child td{
	border-width:0px 1px 0px 0px;
}.tableDiv tr td:last-child{
	border-width:0px 0px 1px 0px;
}.tableDiv tr:last-child td:last-child{
	border-width:0px 0px 0px 0px;
}
.tableDiv tr:first-child td{
	background:-o-linear-gradient(bottom, #b7b7b7 5%, #b7b7b7 100%);	
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #b7b7b7), color-stop(1, #b7b7b7) );
	background:-moz-linear-gradient( center top, #b7b7b7 5%, #b7b7b7 100% );
	background-color:#b7b7b7;
	border:0px solid #000000;
	text-align:center;
	border-width:0px 0px 1px 1px;
	font-size:14px;
	font-family:Arial Black;
	font-weight:bold;
	color:#ffffff;
}
.tableDiv tr:first-child:hover td{
	background:-o-linear-gradient(bottom, #b7b7b7 5%, #b7b7b7 100%);	
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #b7b7b7), color-stop(1, #b7b7b7) );
	background:-moz-linear-gradient( center top, #b7b7b7 5%, #b7b7b7 100% );
	background-color:#b7b7b7;
}
.tableDiv tr:first-child td:first-child{
	border-width:0px 0px 1px 0px;
}
.tableDiv tr:first-child td:last-child{
	border-width:0px 0px 1px 1px;
}
.rotate 
{
-webkit-transform: rotate(-90deg);
-moz-transform: rotate(-90deg);
-ms-transform: rotate(-90deg);
-o-transform: rotate(-90deg);
}