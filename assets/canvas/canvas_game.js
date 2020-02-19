var myGameArea = {
  canvas : document.querySelector('.myCanvas'),
  start : function() {
    this.canvas.width = 480;
    this.canvas.height = 270;
    this.context = this.canvas.getContext("2d");
    // document.body.insertBefore(this.canvas, document.body.childNodes[0]);
  }
}
var myGamePiece;
function component(width, height, color, x, y) {
  this.width = width;
  this.height = height;
  this.speedX = 0;
  this.speedY = 0;
  this.x = x;
  this.y = y; 
  this.update = function() {
    ctx = myGameArea.context;
    ctx.fillStyle = color;
    ctx.fillRect(this.x, this.y, this.width, this.height);
  }
  this.newPos = function() {
    this.x += this.speedX;
    this.y += this.speedY; 
  } 
}
function updateGameArea() {
  myGameArea.clear();
  myGamePiece.newPos();
  myGamePiece.update();
}

function moveup() {
  myGamePiece.speedY -= 1; 
}

function movedown() {
  myGamePiece.speedY += 1; 
}

function moveleft() {
  myGamePiece.speedX -= 1;
}

function moveright() {
  myGamePiece.speedX += 1;
}
function startGame() {
  myGameArea.start();
  myGamePiece = new component(30, 30, "red", 10, 120);
}
startGame()
updateGameArea()