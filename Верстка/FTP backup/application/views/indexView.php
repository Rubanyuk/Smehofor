<?php 
        $this->load->view('chunks/head');

?>
<script type="text/javascript" src="/js/uniPag.js"></script>
<script type="text/javascript" src="/js/showJokes.js"></script>

<script type="text/javascript" >

jQuery(document).ready(function(){    
    showJokes.init();   
});
</script>
    <div id="wrapper">
        <div id="topLine"></div>
        <div id="Header">
            <div id="iHeader">
<?php 
        $this->load->view('chunks/logo');
?>
                <div id="rightBlock">
<?php 
        $this->load->view('chunks/topMenu');
?>
                    <div class="clear"></div>
                    <p><span class="strong">SmehoFor</span> — это зеленый свет для качественного юмора: смешных шуток, историй, цитат и пр. Сортировка действует по принципу светофора: если шутка удачная - ставим зеленый цвет и она будет радовать посетителей своим искрометным юмором. Если так себе - желтый, а если совсем никак - то красный.  Ещё мы не боимся смотреть правде в лицо, поэтому у нас есть кнопки Хуйня, Пиздежь и Баян.</p>
                    <div class="dotLine1"></div>
<?php
       $this->load->view('chunks/menu');
?>
                    <div class="clear"></div>
                    <div class="dotLine2"></div>
                        <input type="text" class="searchInput bluring"  id="searchInput" hvalue="Текст или номер цитаты" value="Текст или номер цитаты"/><a href="javascript:;" id="findBtn"><input type="button" class="searchBut" name="searchButton" value=""/></a>
                
                    <!--Пагинация для первой страницы-->
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
<!--Начало блоков с шутками-->
<div id="info">

</div>
        <div id="content">
            <div id="icontent">
<div id="jokeContainer">
</div> 
<!--Пагинация для первой страницы-->
                     <div id="pagination2">
                     <p></p>                       
                    </div>
        <!--Конец Нижняя пагинация-->         
            </div>
        </div>
<!--Конец блоков с шутками-->        
        <div id="footer">
        
            <div id="ifooter">
                <div class="dotLine3"></div>
<?php 
        $this->load->view('chunks/menuAdd');
        $this->load->view('chunks/pageFooter');
?>
            </div>
        </div>
        <div id="bottomLine"></div>
    </div>

</body>
</html>      