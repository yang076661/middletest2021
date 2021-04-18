<!DOCTYPE html>
<html lang="zh-tw">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>顯示成績紀錄的PHP程式</title>
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
        h3{
            text-align: center;
        }
        .content{
            margin-left: 1rem;
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
    <h1>顯示成績紀錄的PHP程式</h1>
    <div class="content">
    <?php
        $file = "score.txt";
        if(file_exists($file)){
            $content=@file($file);
            foreach($content as $value)
        	{
                echo $value."<br>";
	        }
        }
        else
            echo"<font color='red'><h3>目前無成績紀錄!<h3></font>";
    ?>
    </div>
</body>
</html>