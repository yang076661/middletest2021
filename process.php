<!DOCTYPE html>
<html lang="zh-tw">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>計算成績的PHP程式</title>
    <style>
        *{
            margin: 0;
        }
        .btn{
            display:flex;
            justify-content:space-around;
            margin-top: 0.5rem;
            margin-bottom: 0.8rem;
        }
        .btn1{
            width: 10rem;
            height: 3rem;
            font-size: 1rem;
            background-color: #EEC900;
        }
        .btn2{
            width: 10rem;
            height: 3rem;
            font-size: 1rem;
            background-color: #EEC900;
        }
        .btn3{
            width: 10rem;
            height: 3rem;
            font-size: 1rem;
            background-color: #EEC900;
        }
        h1{
            background-color:teal;
            height: 3rem;
            text-align: center;
            color: white;
            margin-bottom: 1.5rem;
        }
        h2{
            color:red;
        }
        .fs{
            font-size:1.3rem;
        }
        p{
            margin:0.2rem 0rem;
        }
        .pos{
            margin-left: 30%;
        }
    </style>
</head>
<body>
    <div class="btn">
        <form action="entry.html">
            <input type="submit" value="登錄學生成績" class="btn1">
        </form>
        <form action="showdata.php">
            <input type="submit" value="顯示成績紀錄" class="btn2">
        </form>
        <form action="index.html">
            <input type="submit" value="回主功能頁面" class="btn3">
        </form>
    </div>
    <h1>計算成績的PHP程式</h1>
    <div class="pos">
        <h2>*資料接收方式 : POST</h2>
        <div class="fs">
        <?php
            $date=getdate();
            $mon=$date['mon'];
            $day=$date['mday'];
            $y=$date['year'];
            $h=$date['hours'];
            $min=$date['minutes'];
            $sec=$date['seconds'];
            $time = $y."/".$mon."/".$day."-".($h+6).":".$min;
            if(isset($_POST["club"])){
                $club = $_POST["club"];
            }
            $chinese = $_POST["Chinese"];
            $english = $_POST["English"];
            $math = $_POST["Math"];
            $date = $_POST["date"];
            $date2 = str_replace("-","/",$date);
            $age=explode("/",$date2);

            $file = "score.txt";
            $fileindex=fopen($file,"a+");
            if(isset($_POST["club"])){
                $clubtxt0 = $club[0];
                $clubtxt1 = "";
                for($i=1; $i<count($club); $i++){
                    $clubtxt1 = $clubtxt1."/".$club[$i];     
                }
                $clubtxt = $clubtxt0.$clubtxt1;
            }
            if(isset($clubtxt))
                $str=$time.",{$_POST['id']},{$_POST['name']},{$_POST['gender']},{$_POST['grade']}{$_POST['department']},{$clubtxt},{$chinese},{$english},{$math}\n";
            else
                $str=$time.",{$_POST['id']},{$_POST['name']},{$_POST['gender']},{$_POST['grade']}{$_POST['department']},{$chinese},{$english},{$math}\n";   
            $write_ok=fwrite($fileindex,$str);
            fclose($fileindex);

            $Grades = $chinese+ $english+ $math;
            $Grades_avg = $Grades / 3;
            function rank($Grades_avg){
                $x = $Grades_avg;
                switch ($x) {
                    case $x == 100:
                        echo "<font color='blue'>( 優良 )</font>";
                        break;
                    case $x >= 90:
                        echo "<font color='blue'>( 甲等 )</font>";
                        break;
                    case $x >= 80:
                        echo "<font color='blue'>( 乙等 )</font>";
                        break;
                    case $x >= 70:
                        echo "<font color='blue'>( 丙等 )</font>";
                        break;
                    case $x >= 60:
                        echo "<font color='blue'>( 丁等 )</font>";
                        break;
                    case $x < 60:
                        echo "<font color='blue'>( 不及格 )</font>";
                    break;
                }
            }
            function age($y2,$m2,$d2,$y1,$m1,$d1){
                $age = $y2-$y1;
                if($m1 <= $m2)
                {
                    $age = $age-1;
                    if($m1 >= $m2 and $d1 >= $d2)
                        $age = $age+1;
                }
                return $age;
            }
            echo "<p>* 學號 : {$_POST["id"]}</p>";
            echo "<p>* 姓名 : {$_POST["name"]}</p>";
            echo "<p>* 生理性別 : {$_POST["gender"]}</p>";
            echo "<p>* 年級 : {$_POST["grade"]} 年級</p>";
            echo "<p>* 生日 : {$date2}</p>";
            $real_age = age($y,$mon,$day,$age[0],$age[1],$age[2]);
            echo "<p>* 年齡 : {$real_age}</p>";  
            echo "<p>* 系別 : {$_POST["department"]}</p>";
            if(!isset($_POST["club"])){
                echo "<p>* 社團 : 無</p>";
            }
            else{
                echo "<p>* 社團 : {$club[0]}";
                for($i=1; $i<count($club); $i++){
                    echo "/".$club[$i];
                }
                echo "</p>";
            }
            echo"<p>* 國文成績 : {$chinese}</p>";
            echo"<p>* 英文成績 : {$english}</p>";
            echo"<p>* 數學成績 : {$math}</p><br>";
            if($_POST["gender"] == "M")
                echo"{$_POST["name"]} 先生 好 ! 您的總分 : {$Grades} 平均 : ".round($Grades_avg, 1)." ";
            else
                echo"{$_POST["name"]} 小姐 好 ! 您的總分 : {$Grades} 平均 : ".round($Grades_avg, 1)." ";
                rank($Grades_avg);
        ?>
        </div>
    </div>
</body>
</html>