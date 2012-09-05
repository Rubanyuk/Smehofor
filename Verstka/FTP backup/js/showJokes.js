var showJokes={
type:0,
page:1,
self:{},
pages:[],
pagesRadius:5,
order:'new',
data:0,
borodan:0,
u:encodeURIComponent(location.href),
t:encodeURIComponent(document.title),

init: function(hash){
  this.self=this;
  
  var self=this;
  
  if(hash!=null){
    if(hash.page!=null){
        self.page=hash.page;
    }
     
    if(hash.data!=null){
        self.data=hash.data;
    }

    if(hash.type!=null){
        self.type=hash.type;
    }

    if(hash.order!=null){
        self.order=hash.order;
    }
  }  
  self.get();
//socials
$("li.shareVk").live('click',function(){
    window.open('http://vk.com/share.php?url='+self.u+'\', \'_blank\', \'scrollbars=0, resizable=1, menubar=0, left=200, top=200, width=554, height=421, toolbar=0, status=0');
});

$("li.shareMailru").live('click',function(){
    window.open('http://connect.mail.ru/share?url='+self.u+'&title='+self.t+'" title="РџРѕРґРµР»РёС‚СЊСЃСЏ РІ РњРѕРµРј РњРёСЂРµ@Mail.Ru"');
});

$("li.shareFb").live('click',function(){
    window.open('http://www.facebook.com/sharer.php?u='+self.u+'&t='+self.t+'\', \'_blank\', \'scrollbars=0, resizable=1, menubar=0, left=200, top=200, width=550, height=440, toolbar=0, status=0');
});

$("li.shareOd").live('click',function(){
    window.open('http://www.odnoklassniki.ru/dk?st.cmd=addShare&st._surl='+self.u+'&title='+self.t+'\', \'_blank\', \'scrollbars=0, resizable=1, menubar=0, left=200, top=200, width=550, height=440, toolbar=0, status=0');
});

$("li.shareLj").live('click',function(){
    window.open('http://www.livejournal.com/update.bml?event='+self.u+'&subject='+self.t+'" title="РћРїСѓР±Р»РёРєРѕРІР°С‚СЊ РІ LiveJournal"');
});

$("li.shareTwitter").live('click',function(){
    window.open('http://twitter.com/share?text='+self.t+'&url='+self.u+'\', \'_blank\', \'scrollbars=0, resizable=1, menubar=0, left=200, top=200, width=550, height=440, toolbar=0, status=0');
});

    $(".bayan li").live('click',function(){
        if($(this).hasClass('pushed')){
            return false;
        }
        $(this).parent().find("li.pushed").removeClass('pushed');
        $(this).addClass("pushed");
        
        var id=$(this).parent().parent().parent().find("input").val();
        var rate=$(this).attr("alt");
        var bayan=0;
        var boroda=0;
        
        if(rate==1){
            bayan=1;
        }else{
            boroda=1;
        }
        
        self.setBayan(bayan,boroda,id);
         var cook=CookiesManager.getCookie("bayanJoke");
         
        if(cook!=null){
            
            var cookArr=cook.split("|");
            var deleteCell=-1;
            
                for (var i=0;i<cookArr.length;i++){
                     if(cookArr[i].indexOf(id)>0){
                         deleteCell=i;                                   
                      }
                };
            if(deleteCell!=-1){
                cookArr.splice(deleteCell,1);
            }         
                    
            cookArr.push('{"0": '+id+', "1":'+rate+'}');
            cook=cookArr.join("|");
        }else{
            cook='{"0": '+id+', "1":'+rate+'}';
        }
            
        CookiesManager.setCookie("bayanJoke",cook,500000);         
    });
    
    
    $(".noPushed li").live('click',function(){
        if($(this).hasClass('pushed')){
            return false;
        }        
        $(this).parent().find("li.pushed").removeClass('pushed');
        $(this).addClass("pushed");
 //       $(this).parent().parent().removeClass("noPushed");
        var id=$(this).parent().parent().parent().find("input").val();
        var rate=$(this).attr("alt");
        self.setVoice(rate,id);
                                        
        var cook=CookiesManager.getCookie("memberJoke");
        if(cook!=null){
            
            var cookArr=cook.split("|");
            var deleteCell=-1;
            var rateCook=0;
                for (var i=0;i<cookArr.length;i++){
                     if(cookArr[i].indexOf(id)>0){
                         deleteCell=i;
                         var cookData=jQuery.parseJSON(cookArr[i]);
                         rateCook=parseInt(cookData[1]);                          
                      }
                };
            if(deleteCell!=-1){
                cookArr.splice(deleteCell,1);
            }         
                    
            cookArr.push('{"0": '+id+', "1":'+rate+'}');
            cook=cookArr.join("|");
        }else{
            cook='{"0": '+id+', "1":'+rate+'}';
        }
            
        CookiesManager.setCookie("memberJoke",cook,500000);
        
        
        var ratingNum=$(this).parent().parent().parent().find(".ratingNum");
        
        ratingNum.html(parseInt(ratingNum.html())+parseInt(rate)-rateCook);
    });

  
    $("#pagination1 a, #pagination2 a").live('click',function(){
        self.page=$(this).attr("rel");
        self.get();
    });

    $("a.sort").click(function(){
        $("a.sort").removeClass("menuListActive");
        $(this).addClass("menuListActive");
        self.order=$(this).attr("rel");
        self.page=1;
        self.get();
    });
  
    $(".jokesMenu a").click(function(){
        $(".jokesMenu a").removeClass("menuListActive");
        $(this).addClass("menuListActive");
        self.type=$(this).attr("rel");
        self.page=1;
        self.get();
    });  
    
        $('input.bluring').focus(function(){
         if($(this).val()==$(this).attr("hvalue")){
            $(this).val("");
         }
            
        });
    
        $('input.bluring').blur(function(){
         if($(this).val()==""){
            $(this).val($(this).attr("hvalue"));
         }
         });

    $("#findBtn").click(function(){
        var find=$('#searchInput').val();
        
        if(find.length<2 || find==$("#searchInput").attr("hvalue")){
            return false;
        }
    
        self.page=1;
        self.find(find);
    }); 
    
    $("#searchInput").keyup(function(eventObject){
        
        if(eventObject.which!=13){
            return false;
        }
        
        var find=$(this).val();
        
        if(find.length<2 || find==$("#searchInput").attr("hvalue")){
            return false;
        }
    
        self.page=1;
        self.find(find);
    });     

    $("#bayanFind").live('click',function(){
        $(".bayanBoroda a").removeClass("menuListBestActive");
        
        if(self.borodan==2){
            self.borodan=0;
        }else{
            $(this).addClass("menuListBestActive");
            self.borodan=2;
        }
        
       self.page=1;       
       self.get(); 
    });


    $("#borodaFind").live('click',function(){
        $(".bayanBoroda a").removeClass("menuListBestActive");
        
        if(self.borodan==1){            
            self.borodan=0;
        }else{                                           
            $(this).addClass("menuListBestActive");
            self.borodan=1;
        }     
       self.page=1;
       
       self.get(); 
    });
        
    $("a.jokeSection").live('click',function(){

       self.type=$(this).attr("rel");
       $(".jokesMenu a").removeClass("menuListActive");               
       $(".jokesMenu [rel="+self.type+"]").addClass("menuListActive"); 
       self.page=1;
       self.get(); 
    });     
    
    
    $("ul.dataList a").live('click',function(){
        $("ul.dataList a").removeClass("menuListBestActive");
        $(this).addClass("menuListBestActive");
        
        self.data=$(this).attr("rel");           
        self.page=1;
        self.get(); 
    });     
},

setVoice: function(voice,id){
 jQuery.ajax({
          url: '/ajax/addVoice',
          type: 'POST',
          data: 'voice='+voice+'&jokeID='+id,
          success: function(data) 
          {
                $("#info").html(data);
          }
          
        })    
}, 
    

setBayan: function(bayan,boroda,id){
 jQuery.ajax({
          url: '/ajax/addBayan',
          type: 'POST',
          data: 'bayan='+bayan+'&boroda='+boroda+'&jokeID='+id,
          success: function(data) 
          {
                $("#info").html(data);
          }
          
        })    
}, 

find: function(find){
    var self=this.self;
 jQuery.ajax({
          url: '/ajax/jokeFounder',
          type: 'POST',
          data: 'type='+self.type+'&page='+self.page+'&order='+self.order+'&find='+find,
          success: function(data) 
          {
              var obj=jQuery.parseJSON(data);
              if(obj.type=='error')
              {
                    self.showVoid('По вашему запросу ничего не найдено');
                    $('#pagination1 p, #pagination2 p').empty();
              }
               if(obj.type=='message')
               {
                    self.list(obj.jokes);
                    self.pages=new Array(obj.count);
                    self.pagination();
                    
               }

          }
        });    
},

    
get: function(){
    var self=this.self;
 jQuery.ajax({
          url: '/ajax/showContent',
          type: 'POST',
          data: 'type='+self.type+'&page='+self.page+'&order='+self.order+'&data='+self.data+'&borodan='+self.borodan,
          success: function(data) 
          {
              var obj=jQuery.parseJSON(data);
              if(obj.type=='error')
              {
                    self.showVoid('Шуток с такими параметрами не найдено');
                    $('#pagination1 p, #pagination2 p').empty();

              }
               if(obj.type=='message')
               {
                    self.list(obj.jokes);
                    self.pages=new Array(obj.count);
                    self.pagination();
                    
                    var cook=CookiesManager.getCookie("memberJoke");

                    if(cook!=null){
                         self.checkLikeCookie(cook,obj);
                    }
                                                            
                    var cook=CookiesManager.getCookie("bayanJoke");

                    if(cook!=null){
                        self.checkBayanCookie(cook,obj);
                    }
                                        
               }

          }
        });
 
},

checkBayanCookie: function(cook,obj){
                    var cookArr=cook.split("|");
                                         
                    for (var i=0;i<cookArr.length;i++){                      
                        for (var j=0; j<obj.jokes.length; j++){
                            var objID=obj.jokes[j].id;
                            
                            if(cookArr[i].indexOf(objID)>0){
                                var cookJSON=jQuery.parseJSON(cookArr[i]);
                                if(cookJSON[1]==1)
                                    $("input[value='"+cookJSON[0]+"']").parent().find("li.buttonDontBeleive").addClass("pushed");

                                if(cookJSON[1]==2)
                                    $("input[value='"+cookJSON[0]+"']").parent().find("li.buttonBajan").addClass("pushed");

                            }
                         
                        }
                         
                        
                    }     
},

checkLikeCookie: function(cook,obj){
                    var cookArr=cook.split("|");
                                         
                    for (var i=0;i<cookArr.length;i++){                      
                        for (var j=0; j<obj.jokes.length; j++){
                            var objID=obj.jokes[j].id;
                            
                            if(cookArr[i].indexOf(objID)>0){
                                var cookJSON=jQuery.parseJSON(cookArr[i]);
                                if(cookJSON[1]==1)
                                    $("input[value='"+cookJSON[0]+"']").parent().find("li.buttonLike").addClass("pushed");

                                if(cookJSON[1]==0)
                                    $("input[value='"+cookJSON[0]+"']").parent().find("li.buttonMiddle").addClass("pushed");
                                    
                                if(cookJSON[1]==-1)
                                    $("input[value='"+cookJSON[0]+"']").parent().find("li.buttonDisLike").addClass("pushed");                                                                        
                                                          
                            // $("input[value='"+cookJSON[0]+"']").parent().removeClass("noPushed");   
                            }
                         
                        }
                         
                        
                    }     
},

 pagination: function(){
 var self=this.self;   
 $('#pagination1 p, #pagination2 p').empty();

 var pags=unipag({pages: this.pages, page:this.page,pagesRadius:this.pagesRadius});
 if(self.pages.length<=1)
        return false;

 var pagObj=pags.list;
 if(pags.left){
    $('#pagination1 p, #pagination2 p').append(
        '<span class="grayAarrows" title="Назад"><a href="javascript:;" style="text-decoration:none" rel="'+
        pags.left+'">&#8592;</a></span>&nbsp;&nbsp;');
 }          
 for (var i=0;i<pagObj.length;i++)
 {

     if(this.page!=(pagObj[i]+1)){
            $('#pagination1 p, #pagination2 p').append('<a href="javascript:;" rel="'+(pagObj[i]+1)+'">'+(pagObj[i]+1)+'</a>&nbsp;&nbsp;');
     }else{
            $('#pagination1 p, #pagination2 p').append('<span>'+(pagObj[i]+1)+'</span>&nbsp;&nbsp;');    
     }
 }   
 
 if(pags.right){
    $('#pagination1 p, #pagination2 p').append(
        '<span class="grayAarrows" title="Вперед"><a href="javascript:;" style="text-decoration:none" rel="'+
        pags.right+'">&#8594;</a></span>');
 } 
    
 },
 
  showVoid: function(msg){
    $("#jokeContainer").empty();

    $('.voidTpl .middleCont p').html(msg);
                      
    $('.voidTpl').clone()
            .removeClass("voidTpl")
            .appendTo("#jokeContainer");
   
 },
 
 list: function(data){
    $("#jokeContainer").empty();

    for (var i=0;i<data.length;i++){
        $('.jokeTpl .ratingNum').html(data[i].rate);
        $('.jokeTpl span.jokeIDs').html(data[i].id);
        $('.jokeTpl .jokeID').val(data[i].id);
        
        
        var types = ['Все','Короткие','Цитаты','Истории','Анекдоты','Статусы','Демотиваторы','Видео'];
                
        $('.jokeTpl a.jokeSection').html(types[data[i].type]);
        $('.jokeTpl a.jokeSection').attr("rel",data[i].type);

        $('.jokeTpl .middleCont p').html(data[i].content);
        
        if(data[i].name!=null){
            $('.jokeTpl .middleCont p').html('<img src="/upload/img/'+data[i].name+' ">');
        }
        
        var months = ['января','февраля','марта','апреля','мая','июня','июля','августа','сентября','октабря','ноября','декабря'];
        var time = new Date(data[i].data*1000);
        var month = months[time.getMonth()];
        var hours = time.getHours();
        var minutes = time.getMinutes();
        if(minutes<10){
            minutes='0'+minutes;
        }
        var days = time.getDate();
        
       $('.jokeTpl .jokeAddTime').html(days+' '+month+' '+hours+':'+minutes);        

        $('.jokeTpl').clone()
            .removeClass("jokeTpl")
            .appendTo("#jokeContainer");
   }
   
   $('.jokeTpl .jokeID').val(0);
 }
 
 };
 
 