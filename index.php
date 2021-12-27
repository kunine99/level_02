<?php
include_once "base.php";


?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0040)http://127.0.0.1/test/exercise/collage/? -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>卓越科技大學校園資訊系統11</title>
    <link href="./css/css.css" rel="stylesheet" type="text/css">
    <script src="./js/jquery-1.9.1.min.js"></script>
    <script src="./js/js.js"></script>
</head>

<body>
    <div id="cover" style="display:none; ">
        <div id="coverr">
            <a style="position:absolute; right:3px; top:4px; cursor:pointer; z-index:9999;" onclick="cl(&#39;#cover&#39;)">X</a>
            <div id="cvr" style="position:absolute; width:99%; height:100%; margin:auto; z-index:9898;"></div>
        </div>
    </div>

    <div id="main">

        <?php include "front/header.php"; ?>

        <div id="ms">
            <div id="lf" style="float:left;">
                <div id="menuput" class="dbor">
                    <!--主選單放此-->
                    <span class="t botli">主選單區</span>
                    <!-- 既然我要在這邊放東西，我就要撈資料 -->
                    <?php
                        $mains=$Menu->all(['parent'=>0,'sh'=>1]);
                        foreach($mains as $main){
                            echo "<div class='mainmu'>";
                            echo "<a href='{$main['href']}'>";
                            echo $main['name'];
                            echo "</a>";
                            if($Menu->math('count','*',['parent'=>$main['id']])>0){
                                $subs=$Menu->all(['parent'=>$main['id']]);
                                echo "<div class='mw'>";
                                foreach ($subs as $sub) {
                                    echo "<div class='mainmu2'>";
                                    echo "<a href='{$sub['href']}'>{$sub['name']}</a>";
                                    echo "</div>";
                                }
                                echo "</div>";
                            }
                            echo "</div>";
                        }


                    ?>
                </div>
                <div class="dbor" style="margin:3px; width:95%; height:20%; line-height:100px;">
                    <span class="t">進站總人數 :<?= $Total->find(1)['total']; ?></span>
                </div>
            </div>
            <?php

            $do = isset($_GET["do"]) ? $_GET["do"] : 'main';
            $file = "./front/" . $do . ".php";
            if (file_exists($file)) {
                include $file;
            } else {
                //echo "檔案不存在";
                include "./front/main.php";
            }
            ?>
            
            
            <div class="di di ad" style="height:540px; width:23%; padding:0px; margin-left:22px; float:left; ">
                <!--右邊-->
                <!-- 有登入就返回管理，沒有就回 -->
                <button style="width:100%; margin-left:auto; margin-right:auto; margin-top:2px; height:50px;" onclick="lo(&#39;?do=login&#39;)">管理登入</button>
                <!-- 上面主選單 -->
                <div style="width:89%; height:480px;" class="dbor">   
                
                    <span class="t botli">校園映象區</span>
                    <div class="t" onclick="pp(1)"><img src="icon/up.jpg"></div>
                        <?php 
                            $imgs=$Image->all(['sh'=>1]);
                            foreach($imgs as $key => $img){
                        ?>
                        <div class="im cent" id="ssaa<?=$key;?>">
                            <img src="img/<?=$img['img'];?>" style="width:150px;height:103px;border:3px solid orange;margin:1px">
                        </div>
                        <?php 
                            }
                        ?>
                        <div class="t" class="t" onclick="pp(2)"><img src="icon/dn.jpg"></div>
                    <script>


                        var nowpage = 0,
                            num = <?=$Image->math("count","*",['sh'=>1]);?>;

                        // pp s t 都是亂取的 沒什麼特殊含義
                        function pp(x) {
                            var s, t;
                            // 用switch做其實比較好
                            if (x == 1 && nowpage - 1 >= 0) {
                                nowpage--;
                            }
                            // 當某個條件成立的時候我就把我的頁數+1表示你可以往下，x功能就是在控制上下
                            if (x == 2 && (nowpage + 3)< num ) {
                                nowpage++;
                            }
                            $(".im").hide() //把所有class是im的都隱藏起來，隱藏起來後用for這個東西
                            //s這個東西從0開始算，s小於2，s每次+1，這樣0 1 2 迴圈共跑3次..?
                            //我只會用.im隱藏 但id會顯示
                            for (s = 0; s <= 2; s++) {

                                t = s * 1 + nowpage * 1;
                                $("#ssaa" + t).show()
                            }
                        }
                        pp(1) //瀏覽器從serive仔入的當下我先pp(1)，先pp1 才會有三張圖片出來
                    </script>
                </div>
            </div>
        </div>
        <div style="clear:both;"></div>
        <div style="width:1024px; left:0px; position:relative; background:#FC3; margin-top:4px; height:123px; display:block;">
            <span class="t" style="line-height:123px;"><?= $Bottom->find(1)['bottom']; ?></span>
        </div>
    </div>

</body>

</html>