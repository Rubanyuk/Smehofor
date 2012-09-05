<?php 
        $this->load->view('chunks/head');
?>
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
                        <h1><?php echo $title;?></h1>
                    </div>
                </div>
            </div>

        </div>
<!--Начало блока добавления шутки-->
        <div id="content">
            <div id="icontent">

            <div class="topCont"></div>
            <div class="middleCont">
            <p class="addjokeP">            
                <?php echo $content;?>
            </p>    
            </div>
            
             <div class="bottomCont"></div>
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