<!DOCTYPE html>
<html>

<a href="/index.php">首页的路</a>

<p>

    


</p>
<div >
     <canvas  id="myCanvas" width="800" height="500"></canvas>

            <script>
                  var canvas = document.getElementById('myCanvas');
                  var contex = canvas.getContext('2d');

               contex.beginPath();
                contex.moveTo(265,20);
                  contex.bezierCurveTo(-160,310,225,540,345,300);
                  contex.bezierCurveTo(380,420,350,380,540,350);
                   contex.bezierCurveTo(400,200,400,10,500,60);
                  contex.bezierCurveTo(200,20,390,290,70,300);
                  contex.bezierCurveTo(360,185,120,5,265,20);

                  contex.closePath();
                  contex.lineWidth =5;
                  contex.strokeStyle = 'green';
                contex.stroke();

            </script>
</div>
<div>
<canvas  id="myCanvas3" width="870" height="550"></canvas>

<script>
    var canvas = document.getElementById('myCanvas3');
    var contex = canvas.getContext('2d');

    contex.beginPath();
    contex.moveTo(380,50);
    contex.bezierCurveTo(-300,300,200,550,400,300);
    contex.bezierCurveTo(550,100,320,280,620,400);
    contex.bezierCurveTo(480,250,500,120,600,50);
    contex.bezierCurveTo(400,280,300,50,180,300);
    contex.bezierCurveTo(200,120,10,0,380,50);

    contex.closePath();
    contex.lineWidth =6;
    contex.strokeStyle = 'blue';
    contex.stroke();

</script>
</div>
<div >
    <canvas  id="myCanvas5" width="800" height="500"></canvas>

    <script>
        var canvas = document.getElementById('myCanvas5');
        var contex = canvas.getContext('2d');

        contex.beginPath();
        contex.moveTo(265,20);
        contex.bezierCurveTo(-200,300,225,540,400,260);
        contex.bezierCurveTo(380,400,400,360,540,380);
        contex.bezierCurveTo(400,200,400,10,500,60);
        contex.bezierCurveTo(200,20,390,220,200,240);
        contex.bezierCurveTo(260,185,120,5,265,20);

        contex.closePath();
        contex.lineWidth =8;
        contex.strokeStyle = '#f3d';
        contex.stroke();

    </script>
</div>

<canvas id="myCanvas2" width="800" height="500"></canvas>
    <script>
        var canvas = document.getElementById('myCanvas2');
        var contex = canvas.getContext('2d');

        contex.beginPath();
        contex.moveTo(285,50);
        contex.bezierCurveTo(1,125,200,310,320,200);
        contex.bezierCurveTo(100,220,-180,320,360,260);

        contex.bezierCurveTo(240,320,330,160,560,260);
        contex.bezierCurveTo(422,150,422,120,390,100);
        contex.bezierCurveTo(422,150,422,120,390,100);

        contex.bezierCurveTo(430,40,370,30,340,50);
        contex.bezierCurveTo(320,5,200,10,250,40);



        contex.closePath();
        contex.lineWidth =5;
        contex.strokeStyle = 'red';
        contex.stroke();

        </script>