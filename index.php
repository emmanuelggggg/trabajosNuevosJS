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
        var direction='right';

        function start(){

             cv  =document.getElementById('mycanvas');
             ctx  = cv.getContext('2d');

            player =new Cuadraro(superX,superY,40,40,'red');

             paint();
        }
        // var color='red';
        // var fig='arc';
        // var press =false;    


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
                direction='right';
            }
            //abajo
            if(e.keyCode == 68 || e.keyCode == 39){
                direction='left';
            }
        })
        function paint(){

            window.requestAnimationFrame(paint);

            ctx.fillStyle ='pink';
            ctx.fillRect(0,0,500,500);
            
            player.c=rbgaRand();
            player.dibujar(ctx);
            // ctx.fillRect(superX,superY,40,40);
            // ctx.strokeRect(superX,superY,40,40);

            update();
        }
        function update(){
            
            if(direction == 'right'){
                 player.x +=10;
                if(player.x >= 500){
                    player.x = 0;
                }
            }
            if(direction == 'left'){
                 player.x -=10;
                if(player.x < 0){
                    player.x = 50;
                }
            }
            if(direction == 'down'){
                player.y +=10;
                 if(player.y >= 500){
                    player.y = 0;
                }
            }
            if(direction == 'up'){
                player.y -=10;
                 if(player.y <0){
                    player.y = 500;
                }
            }
        }
        function Cuadraro(x,y,w,n,c){
            this.x = x;
            this.y = y;
            this.w = w;
            this.n = n;
            this.c = c;

            this.dibujar = function(ctx){
                ctx.fillStyle=this.c;
                ctx.fillRect(this.x,this.y,this.w,this.n);
                ctx.strokeRect(this.x,this.y,this.w,this.n);
            }
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
    </script>
</body>
</html>