                <ul class="menuList jokesMenu">
                <?php
                
/*                 
                $menuObj="";
                for($i=0; $i<count($menu);$i++){
                    
                     if($menu[$i]['id']==$id){
                        $menuObj.='<li><a href="/'.$menu[$i]['alias'].'" class="menuListActive">'.$menu[$i]['pagetitle'].'</a></li>';
                     }else{
                        $menuObj.='<li><a href="/'.$menu[$i]['alias'].'" >'.$menu[$i]['pagetitle'].'</a></li>';
                     }   
                }
                echo $menuObj;                
                
*/                

                 ?>
<li><a rel="1" href="javascript:;">Короткие</a></li>
<li><a rel="2" href="javascript:;">Цитаты</a></li>
<li><a rel="3" href="javascript:;">Истории</a></li>
<li><a rel="4" href="javascript:;">Анекдоты</a></li>
<!--<li><a rel="6" href="javascript:;">Демотиваторы</a></li>-->
<li><a rel="5" href="javascript:;">Статусы</a></li>
<!--<li><a rel="7" href="javascript:;">Видео</a></li>-->
<li><a rel="0" class="menuListActive" href="javascript:;">Все</a></li>
                </ul>
                <div class="clear"></div>
                <ul class="menuList">
               	    <li><a class="sort menuListActive" href="javascript:;" rel="new">Новые</a></li>
                   	<li><a class="sort" href="javascript:;" rel="rnd" >Случайные</a></li>
                   	<li><a class="sort" href="/best" rel="best">Лучшие</a></li>
                   	<li><a href="/add" <?php 
                       if($this->Page->alias=="add") echo 'class="menuListActive"';                        
                       ?> >Добавить</a></li>
                </ul>

   