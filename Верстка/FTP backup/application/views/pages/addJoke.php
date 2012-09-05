<?php 
        $this->load->view('chunks/head');
?>
<script type="text/javascript" src="/js/addJoke.js"></script>
    <div id="wrapper">
        <div id="topLine"></div>
        <div id="Header-one-section">
            <div id="iHeader-one-section">

<?php 
        $this->load->view('chunks/logo');
?>
                <div id="rightBlock">
<?php 
        $this->load->view('chunks/topMenu');
?>
                    <div class="clear"></div>
                    <div class="dotLine1-best"></div>
<?php 
        $this->load->view('chunks/menuAdd');
?>
                    <div class="clear"></div>
                    <div class="dotLine2"></div>

                    <div id="addJokeText">
                        <h1>Добавить шутку</h1>
                    </div>
                </div>
            </div>

        </div>
<!--Начало блока добавления шутки-->
        <div id="content">
            <div id="icontent">            
            <form method="post" name="addJokeForm" id="addJokeForm">
                <div class="jokeBlock1">
                    <div class="topCont"></div>
                    <div class="middleCont">
<!--Общая информация-->
                        <p class="addjokeP">
                            Отправляя цитату через эту форму, вы подтверждаете, что читали пользовательское соглашение и согласны с ним.<br /><br />

                            Правила просты:<br />
                            1. Цитаты принимаются только через эту форму. Другого способа прислать цитату не существует.<br />
                            2. Слишком длинные цитаты никогда не проходят модерацию.<br />
                            3. Мы никогда и никому не дадим ваш e-mail. Указывать его необязательно, но вы можете сделать это, если хотите оставить нам возможность связаться с вами.<br />
                            4. Не ведитесь на флешмобы. Бездна — не форум.<br />
                            5. Если таймстампы в цитате не несут смысловой нагрузки — смело убирайте их.<br />

                        </p>
<!--Конец общая информация-->
<!--Выбор рубрики-->
                        <div id="selectSection">
                            <h2>Выберите рубрику</h2>
                            <p class="addjokeP"><span class="grayText">Пока что можно добавлять шутки в эти рубрики. В остальные мы добавляем сами :)</span></p>
                            <input type="radio" name="Section[]" class="inputRadio" id="shortSelect" checked="true" value="1" alt="300"/><label for="shortSelect"><span class="radioButPadding">Короткие</span></label><br/>
                            <input type="radio" name="Section[]" class="inputRadio" id="shortCitations" value="2" alt="1500"/><label for="shortCitations"><span class="radioButPadding">Цитаты</span></label><br/>

                            <input type="radio" name="Section[]" class="inputRadio" id="shortStories" value="3" alt="5000"/><label for="shortStories"><span class="radioButPadding">Истории</span></label><br/>
                            <input type="radio" name="Section[]" class="inputRadio" id="shortJokes" value="4" alt="1000"/><label for="shortJokes"><span class="radioButPadding">Анекдоты</span></label><br/>
                            <input type="radio" name="Section[]" class="inputRadio" id="shortStatus" value="5" alt="300"/><label for="shortStatus"><span class="radioButPadding">Статусы</span></label><br/>
                        </div>
<!--Конец выбора рубрики-->
<!--Поле добавления шутки-->
                        <h2>Поле для добавления шутки <span class="symbolsLeft">Осталось символов: <span id="symLeft">300</span></span></h2>

                        <div id="jokeTextAreaBlock">
                            <textarea name="shot" id="jokeAddTextArea" hvalue=":)">:)</textarea>
                        </div>
<!--Конец поля добавления шутки-->
<!--E-mail-->
                        <div id="e-mailInput">
                            <h2>Ваша почта</h2>
                            <p class="addjokeP"><span class="grayText">Если вдруг нам нужно будет связаться с вами. Скорее всего, это никогда не произойдет, но на всякий случай мы оставили это необязательное поле.</span></p>

                            <input type="text" value="Ваша почта" name="email" id="emailInput" hvalue="Ваша почта"/> 
                        </div>
<!--Капча-->
                        <h2>Защита от зайчатков разума</h2>
                        <div id="kapcha">
                        <img src="/core/veriWord"/>
                        </div>
                        <input type="text" name="capcha" id="emailInput"/>
<!--Кнопка Отправить-->
<div id="jError" style="color: red;"></div>
<div id="jMess" style="color: green;"></div>
                        <div id="sendButton"></div>
                        <div id="empty"></div>
                        <input type="hidden" name="addJokeSubmit" value="1"/>
                    </div>
                    <div class="bottomCont">
                        
                    </div>
                </div>
              </form>  
<!--Конец блока добавления шутки-->

        <!-- Баннер 
                <div class="mainPageBanner">
                    <a href="#" class="mainPageBannerA"></a>
                </div>
        <!-- Конец Баннера -->
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