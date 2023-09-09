<!DOCTYPE html>
<html>
<head>
<title>Tribus-Prototypes</title>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="styleCustom.css">
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
<script src='https://cdn.jsdelivr.net/npm/p5@1.3.1/lib/p5.min.js'>
</script>
<script>
console.log("STARTING...");
//GLOBAL
let bg;

function setCharAt(str,index,chr) {
    if(index > str.length-1) return str;
    return str.substring(0,index) + chr + str.substring(index+1);
}

function getRandomChar(){
	
	let s = "&#"+Math.floor(random(77824,78077))+";";
	return s;
}


function preload() {
  bg = loadImage('TribusFont2.png');
}

function setup() {
	
	let myCanvas = createCanvas(527, 198);
	myCanvas.parent('canvas1Div');
}

let FrameCounter = 0;
let s = "";
let charCounter = 0;

function draw() {
	background(255);
	background(bg);
	//filter(GRAY);
	
	if(FrameCounter % 3 == 0){
		
		s+=getRandomChar();
		if(charCounter % 20 == 0 && charCounter != 0){
			s+="<br>";
		}
		if(charCounter >= 400){
			s = "";
			charCounter = 0;
		}
		
		c = random(0, s.length-1);
		
		while(s.charAt(c) != ';'  && s.length > 20){
			c = random(0, s.length-1);

		}
		
		s = setCharAt(s,c,getRandomChar());
		document.getElementById("rG").innerHTML = s;
		console.log(s);
		charCounter++;
	}
	FrameCounter++;
}



</script>
</head>
<body>


<div id='content'>
	<img style='margin-right:10px;' id='headerLogo' src='TribusFont2.png'>
	<h1>-Prototypes</h1>
	<div class='aPrototypePost'>
		<h3 style='font-size:400%;'>&#x1300e; 
									&#x13002; 
									&#x1302C;  	
									&#78434;  	
									&#77824; 
									ⱙ 
								    𓂀
									</h3>
		<p style='font-size:1000%;'>𓂀</p>
		<div id='canvas1Div'></div>
		<img style='margin-top:10px; width:90%;' id='' src='matRain.png'>
		<p style='font-size:400%;' id='rG'></p>
	</div>



</div>



</body>
</html>