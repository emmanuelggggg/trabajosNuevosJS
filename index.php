<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
        canvas {
            background-color: #eee;
        }
    </style>
    <canvas id=mycanvas width="500px;" height="500px;">

    </canvas>

    <script>
      var cv  =null;
        var ctx  = null;
        var superX=240,superY=240;
        var player=null
        var  player2 = null;
        var direction='right';
        var score=0;
        var speed =3;
        var pausa= false;
        var obstaculos = new Array(3);
        function start(){

             cv  =document.getElementById('mycanvas');
             ctx  = cv.getContext('2d');

            player =new Cuadraro(superX,superY,40,40,'red');
            player2 =new Cuadraro(generateRandomIntegerInRange(500),
            generateRandomIntegerInRange(100),40,40,'red');

            obstaculos[0]= new Cuadraro(100,50,120,30);
            obstaculos[1]= new Cuadraro(50,300,30,120);
            obstaculos[2]= new Cuadraro(400,200,30,120);
            
             paint();
        }
        


        document.addEventListener('keydown',function(e){
            // console.log(e);
            //arriba
            if(e.keyCode == 87 || e.keyCode == 38){
                direction='up';

            }
            // abajo
            if(e.keyCode == 83 || e.keyCode == 40){
              direction='down';
            }
            // derecha
            if(e.keyCode == 65 || e.keyCode == 37){
               direction='left';
            }
            //abajo
            if(e.keyCode == 68 || e.keyCode == 39){
                 direction='right';
            }
            if(e.keyCode == 32){
                pausa =(pausa)? false : true;
            }

             
        })
        function paint(){

            window.requestAnimationFrame(paint);

            ctx.fillStyle ='pink';
            ctx.fillRect(0,0,500,500);
            
            player.c=rbgaRand();
            player.dibujar(ctx);

            player2.dibujar(ctx);

            ctx.fillStyle='black';
            ctx.font ="15px Arial"
            ctx.fillText("Score :"+score+"  Speed :"+speed,20,20)
            // ctx.fillRect(superX,superY,40,40);
            // ctx.strokeRect(superX,superY,40,40);
            if(!pausa){
                update();
            }else{
                ctx.fillStyle='rgb(0,0,0,0.5)';
                ctx.fillRect(0,0,500,500);

                ctx.fillStyle='white';
                ctx.font ="30px Arial"
                ctx.fillText("P A U S E",230,230);
                
            }
            ctx.fillStyle='#319DA0';
            for(var i=0;i<obstaculos.length;i++){
                obstaculos[i].dibujar(ctx);
            }
            
            
            
        }
        function update(){
            
            if(direction == 'right'){
                 player.x +=speed
                if(player.x >= 500){
                    player.x = 0;
                }
            }
            if(direction == 'left'){
                 player.x -=speed;
                if(player.x < 0){
                    player.x = 50;
                }
            }
            if(direction == 'down'){
                player.y +=speed;
                 if(player.y >= 500){
                    player.y = 0;
                }
            }
            if(direction == 'up'){
                player.y -=speed;
                 if(player.y <0){
                    player.y = 500;
                }
            }
          
           
                
                if(player.se_tocan(obstaculos[0]) || player.se_tocan(obstaculos[1]) 
                    || player.se_tocan(obstaculos[2])){
                    speed =0.1;
                    
                }else{
                    if(player.se_tocan(player2)){
    
                        player2.x=generateRandomIntegerInRange(500);
                        player2.y=generateRandomIntegerInRange(500);
    
                        score += 5;
                        speed +=0.3;
    
                    }
                }
            
            
              
        }
        function Cuadraro(x,y,w,h,c){
            this.x = x;
            this.y = y;
            this.w = w;
            this.h = h;
            this.c = c;

            this.dibujar = function(ctx){
                ctx.fillStyle=this.c;
                ctx.fillRect(this.x,this.y,this.w,this.h);
                ctx.strokeRect(this.x,this.y,this.w,this.h);
            }
            this.se_tocan = function (target) { 
                if(this.x < target.x + target.w &&
                    this.x + this.w > target.x && 
                    this.y < target.y + target.h && 
                    this.y + this.h > target.y) {

                     return true;  
                }  

            };
            
        }
        window.addEventListener('load',start)
        window.requestAnimationFrame = (function () {
            return window.requestAnimationFrame ||
                window.webkitRequestAnimationFrame ||
                window.mozRequestAnimationFrame ||
                function (callback) {
                    window.setTimeout(callback, 17);
                };
        }());

      
        function rbgaRand() {
            var o = Math.round, r = Math.random, s = 255;
            return 'rgba(' + o(r()*s) + ',' + o(r()*s) + ',' + o(r()*s) + ',' + r().toFixed(1) + ')';
        }
        // Generate a random number between 2 and 10, including both 2 and 10
        function generateRandomIntegerInRange( max) {
            return Math.floor(Math.random() * (max  + 1));
        }
</script>
</body>
</html>