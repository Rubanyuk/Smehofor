<?php 
        $this->load->view('chunks/head');
?>
<script type="text/javascript" src="/js/uniPag.js"></script>
<script type="text/javascript" src="/js/showJokes.js"></script>
<script type="text/javascript" >

jQuery(document).ready(function(){    
    showJokes.init({'order':'best','data':$("#today").attr("rel")});   
});
</script>

    <div id="wrapper">
        <div id="topLine"></div>
        <div id="Header-best">
            <div id="iHeader-best">
<?php 
        $this->load->view('chunks/logo');
?>
                <div id="rightBlock">
                    <ul id="topList-best">
                    	<li><a href="/page?page=about" title="О проекте">О проекте</a></li>
                    	<li><a href="/page?page=news" title="Новости">Новости</a></li>
                    	<li><a href="/page?page=faq" title="FAQ">FAQ</a></li>
                    	<li><a href="/page?page=reclamma" title="Реклама">Реклама</a></li>
                    </ul>
                    <div class="clear"></div>
                    <div class="dotLine1-best"></div>
                    <ul class="menuList jokesMenu">
<li><a rel="1" href="javascript:;">Короткие</a></li>
<li><a rel="2" href="javascript:;">Цитаты</a></li>
<li><a rel="3" href="javascript:;">Истории</a></li>
<li><a rel="4" href="javascript:;">Анекдоты</a></li>
<!--<li><a rel="6" href="/#6">Демотиваторы</a></li>-->
<li><a rel="5" href="javascript:;">Статусы</a></li>
<!--<li><a rel="7" href="/#7">Видео</a></li>-->
<li><a rel="0" href="javascript:;" class="menuListActive">Все</a></li>
                    </ul>
                    <div class="clear"></div>
                    <ul class="menuList">
                    	<li><a href="/" title="Новые">Новые</a></li>
                    	<li><a href="/" title="Случайные">Случайные</a></li>
                    	<li><a href="javascript:;" class="menuListActive" title="Лучшие">Лучшие</a></li>
                    	<li><a href="/add" title="Добавить">Добавить</a></li>
                    </ul>
                    <div class="clear"></div>
                    <ul class="menuListBest dataList">
                    	<li>
                            <a href="javascript:;" id="today" class="menuListBestActive" title="Сегодня" rel="<?php echo date("Y-m-d 00:00:00|Y-m-d 24:00:00") ?>">Сегодня</a>
                        </li>
                    	<li>
<?php
$start_week= date('Y-m-d H:i:s', strtotime(date('Y').'W'.date('W').'1'));
$end_week= date('Y-m-d H:i:s', strtotime(date('Y').'W'.date('W').'7'));

$first_day_month=date('Y-m-01 00:00:00');
$last_day_month=date('Y-m-t 00:00:00');

?>                        
                            <a href="javascript:;" title="За неделю" rel="<?php echo $start_week."|".$end_week; ?>">За неделю</a>
                        </li>
                    	<li>
                            <a href="javascript:;" title="За месяц" rel="<?php echo $first_day_month."|".$last_day_month; ?>">За месяц</a>
                        </li>
                    	<li>
                            <a href="javascript:;" title="2012" rel="2012-01-01 00:00:00|2012-12-31 00:00:00">2012</a>
                        </li>
                    </ul>
                    <div class="clear"></div>
                    <ul class="menuListBest dataList">
<?php 
$moths=array('Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь');        

$m=date("m")-1;
$obj='';
for($i=0;$i<12;$i++):
if($i>5):
    if($i<=$m){
        
        $first_day_month=date('Y-').($i+1).'-01 00:00:00';
        $last_day_month=date('Y-m-t H:i:s', strtotime(date('Y-').($i+1).'-01 00:00:00'));
      $obj.='
      <li>
         <a href="javascript:;" title="'.$moths[$i].'" rel="'.$first_day_month.'|'.$last_day_month.'">'.$moths[$i].'</a>
      </li>';
    }else{
      $obj.='<li class="menuListBestFutTime" title="'.$moths[$i].'">'.$moths[$i].'</li>';  
    }
endif;    
endfor;

echo $obj;
?>
                       
                    </ul>
                    <div class="clear"></div>
                    <ul class="menuListBest bayanBoroda">
                    	<li><a href="javascript:;" title="Не верю ;)" id="borodaFind">Не верю ;)</a></li>
                    	<li><a href="javascript:;" class="menuListBestBajan" title="Баян" id="bayanFind">[:||||||:]</a></li>
                    </ul>
                    <div class="clear"></div>
                    <div class="dotLine2"></div>
                    <!--<form id="searchForm">
                        <input type="text" class="searchInputBest"  src="" name="123" value="Текст или номер цитаты"/><a href="#"><input type="submit" class="searchButBest" name="searchButton" value=""/></a>
                    </form>-->
                    <div id="pagination1">
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
<div style="display: none;">        
                <div class="jokeBlock1 jokeTpl" >
                    <div class="topCont">
                        <div class="jokeRating ">
                        <input type="hidden" class="jokeID" value="0">
                            <div class="ratingNum">0</div>                            
                            <div class="ratingButtons noPushed">                            
                                <ul>
                                	<li class="buttonLike" alt="1"></li>
                                	<li class="buttonMiddle" alt="0"></li>
                                	<li class="buttonDisLike" alt="-1"></li>
                                </ul>

                            </div>
                            
                            <div class="disLikeButtons bayan">
                                <ul>
                                	<li class="buttonDontBeleive" alt="1"></li>
                                	<li class="buttonBajan" alt="2"></li>
                                </ul>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="middleCont">
                        <p>
                        </p>
                        <div class="SocNetIcons">
                        <ul>                           	                               	    
                                <li class="shareOd"></li>
                                <li class="shareLj"></li>                                
                                <li class="shareMailru"></li>
                                <li class="shareFb"></li>
                                <li class="shareTwitter"></li>
                                <li class="shareVk"></li>
                         </ul>       

                        </div>
                    </div>
                    <div class="bottomCont">
                        <p class="jokeTimeAndNum"><a class="jokeSection" href="javascript:;" rel="0">Цитаты</a>&nbsp;&nbsp;&nbsp;&nbsp;<span class="jokeAddTime"></span>&nbsp;&nbsp; #<span class="jokeIDs"></span></p>
                    </div>
                </div>
                
                
                
                <div class="jokeBlock1 voidTpl" >
                    <div class="topCont">
                    </div>
                    <div class="clear"></div>
                    <div class="middleCont">
                        <p>
                        </p>

                    </div>
                    <div class="bottomCont">
                        
                    </div>
                </div>                
</div>                      
<div id="info"></div>        

        <div id="content">
            <div id="icontent">
<div id="jokeContainer">
                    <div class="topCont">
                    </div>
                    <div class="clear"></div>
                    <div class="middleCont">
                        <p>Сегодня никто не шутил</p>
                    </div>
                    <div class="bottomCont">
                        
                    </div>
</div> 
<!--Пагинация для первой страницы-->
                     <div id="pagination2">
                        <p></p>
                    </div>
        <!--Конец Нижняя пагинация-->         
            </div>
        </div>

        <div id="footer">
        
            <div id="ifooter">
                <div class="dotLine3"></div>
                
                <ul class="menuList jokesMenu">

<li><a rel="1" href="/#1">Короткие</a></li>
<li><a rel="2" href="/#2">Цитаты</a></li>
<li><a rel="3" href="/#3">Истории</a></li>
<li><a rel="4" href="/#4">Анекдоты</a></li>
<!--<li><a rel="6" href="/#6">Демотиваторы</a></li>-->
<li><a rel="5" href="/#5">Статусы</a></li>
<!--<li><a rel="7" href="/#7">Видео</a></li>-->
<li><a rel="0" href="/#0">Все</a></li>
                </ul>
                <div class="clear"></div>
                <ul class="menuList">
               	    <li><a class="sort" href="/#new" rel="new">Новые</a></li>
                   	<li><a class="sort" href="/#rnd" rel="rnd" >Случайные</a></li>
                   	<li><a href="javascript:;" class="menuListActive">Лучшие</a></li>
                   	<li><a href="/add">Добавить</a></li> 
                </ul>                
<?php 

        $this->load->view('chunks/pageFooter');
?>

            </div>
        </div>
        <div id="bottomLine"></div>
    </div>

</body>
</html>