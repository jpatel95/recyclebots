// Create the canvas
var canvas = document.createElement("canvas");
var ctx = canvas.getContext("2d");
canvas.width = 720;
canvas.height = 400;
var startTime = 0;
var elapsedTime = 0;
document.getElementById("gameContainer").appendChild(canvas);

var gameState = false;

// Background image
var bgReady = false;
var bgImage = new Image();
bgImage.onload = function () {
	bgReady = true;
};
bgImage.src = "images/background-01.png";

// RecycleBin image
var recycleBinReady = false;
var recycleBinX = 10;
var recycleBinY = canvas.height-95;
var recycleBinImage = new Image();
recycleBinImage.onload = function () {
	recycleBinReady = true;
};
recycleBinImage.src = "images/gameImages/recycling-bin.png";

// TrashBin image
var trashBinReady = false;
var trashBinX = canvas.width-90;
var trashBinY = canvas.height-100;
var trashBinImage = new Image();
trashBinImage.onload = function () {
	trashBinReady = true;
};
trashBinImage.src = "images/gameImages/trash-can.png";

// earthDude image
var earthDudeReady = false;
var earthDudeHasItem = false;
var earthDudeImage = new Image();
earthDudeImage.onload = function () {
	earthDudeReady = true;
	earthDude.x = canvas.width / 2;
	earthDude.y = canvas.height / 2;
};
earthDudeImage.src = "images/gameImages/earth-dude.png";

// item image
var itemReady = false;
var itemRecyclable = false;
var itemImage = new Image();
itemImage.onload = function () {
	itemReady = true;
};
itemImage.src = "images/gameImages/img1.png";

// Game objects
var earthDude = {
	speed: 275 // movement in pixels per second
};
var item = {};
var score = 0;

// Handle keyboard controls
var keysDown = {};

addEventListener("keydown", function (e) {
	keysDown[e.keyCode] = true;
}, false);

addEventListener("keyup", function (e) {
	delete keysDown[e.keyCode];
}, false);

// Reset the the item after player puts it in a bin
var reset = function () {
	earthDudeHasItem=false;
	document.getElementById("scoreParagraph").innerHTML="Score: "+score;
	var itemNumber = Math.floor(Math.random()*10 + 1);
	itemImage.src="images/gameImages/img"+itemNumber+".png";
	item.x = 100 + (Math.random() * (canvas.width - 150));
	item.y = 30 + (Math.random() * (canvas.height - 150));
	item.number = itemNumber;
};

// Update game objects
var update = function (modifier) {
	if (87 in keysDown) { //up
		earthDude.y -= earthDude.speed * modifier;
	}
	if (83 in keysDown) { //down
		earthDude.y += earthDude.speed * modifier;
	}
	if (65 in keysDown) { //l
		earthDude.x -= earthDude.speed * modifier;
	}
	if (68 in keysDown) { //right
		earthDude.x += earthDude.speed * modifier;
	}

	// Did earthDude pick up the object?
	if (earthDude.x <= (item.x + 32) && item.x <= (earthDude.x + 32)
		&& earthDude.y <= (item.y + 32) && item.y <= (earthDude.y + 32)) {
			earthDudeHasItem = true; //the guy picked up the item
			itemImage.src=""; //removes the image from the canvas
			document.getElementById("gameEventParagraph").innerHTML="Item Picked Up";
	}
	
	//check to see if they put it in the bin
	if(earthDudeHasItem){
		//checks to see if earthDude brought the item to the recycling bin
		if (earthDude.x <= (recycleBinX + 75) && earthDude.x >= (recycleBinX)
			&& (earthDude.y +50) <= (recycleBinY + 100) && (earthDude.y + 50) >= (recycleBinY)) {
				if(item.number%2==1){ //odd numbered items are recyclable
					score+=1
					document.getElementById("gameEventParagraph").innerHTML="Correct! +1";
				}
				else{
					score-=1;
					document.getElementById("gameEventParagraph").innerHTML="Incorrect! -1";
				}
				reset();
		}
		
		//checks to see if earthDude brought the item to the trash bin
		else if ((earthDude.x +75) <= (trashBinX + 75) && (earthDude.x+75) >= (trashBinX)
			&& (earthDude.y +50) <= (trashBinY + 100) && (earthDude.y +50)>= (trashBinY)) {
				if(item.number%2==0){ //odd numbered items are recyclable
					score+=1;
					document.getElementById("gameEventParagraph").innerHTML="Correct! +1";
				}
				else{
					score-=1;
					document.getElementById("gameEventParagraph").innerHTML="Incorrect! -1";
				}
				reset();
		}
	}
};

// Draw everything
var render = function () {
	document.getElementById("timeParagraph").innerHTML="Time: "+elapsedTime;
	if (bgReady) {
		ctx.drawImage(bgImage, 0, 0);
	}

	if (trashBinReady) {
		ctx.drawImage(trashBinImage, trashBinX, trashBinY);
	}
	
	if (recycleBinReady) {
		ctx.drawImage(recycleBinImage, recycleBinX, recycleBinY);
	}
	
	if (earthDudeReady) {
		ctx.drawImage(earthDudeImage, earthDude.x, earthDude.y);
	}

	if (itemReady) {
		ctx.drawImage(itemImage, item.x, item.y);
	}
};

// The main game loop
var main = function () {
	if(gameState){ //playing game
		var now = Date.now();
		var delta = now - then;

		elapsedTime=Math.floor((now-startTime)/1000);
		if(elapsedTime>=60){
			stopGame();
		}
		if(earthDude.x>=canvas.width-50){
			earthDude.x=canvas.width-50;
		}
		if(earthDude.x<=0){
			earthDude.x=0;
		}
		if(earthDude.y>=canvas.height-50){
			earthDude.y=canvas.height-50;
		}
		if(earthDude.y<=0){
			earthDude.y=0;
		}
		
		update(delta / 1000);
		render();
	
		then = now;
	
		requestAnimationFrame(main);	
	}
	else{
		//Game not playing
	}
};

function startGame(){
	gameState=true;
	$("#movingTimer").css('left','0px');
	$("#movingTimer").css('visibility','visible');
    $("#movingTimer").animate({left: '100%'}, 60000);
	$("#scoreParagraph").css('visibility','visible');
	$("#timeParagraph").css('visibility','visible');
	document.getElementById("gameEventParagraph").innerHTML="Game Started";
	$("#gameEventParagraph").css('visibility','visible');
	score=0;
	startTime = Date.now();
	document.getElementById("scoreParagraph").innerHTML="Score: "+score;
	document.getElementById("finalScoreParagraph").innerHTML="";
	$(canvas).css('visibility','visible');
	main();
}

function stopGame(){
	gameState=false;
	$("#movingTimer").stop();
	$("#movingTimer").css('visibility','hidden');
	$("#timeParagraph").css('visibility','hidden');
	$("#gameEventParagraph").css('visibility','hidden');
	$("#scoreParagraph").css('visibility','hidden');
	document.getElementById("finalScoreParagraph").innerHTML="Final Score: "+score;
	$(canvas).css('visibility','hidden');
	main();
}

var w = window;
requestAnimationFrame = w.requestAnimationFrame || w.webkitRequestAnimationFrame || w.msRequestAnimationFrame || w.mozRequestAnimationFrame;


var then = Date.now();
reset();
main();