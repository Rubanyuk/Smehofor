var joker={
self:{},
symbols:200,
lockTrigger:false,
init: function(){
this.self=this;
var self=this;

    $("#sendButton").click(function(){
        self.insertJoke();
    });  

    $(".inputRadio").click(function(){
        self.symbols=$(this).attr("alt");
        $("#symLeft").html(self.symbols-$('#jokeAddTextArea').val().length);
    });
    
    
        $('#jokeAddTextArea').focus(function(){
         if($(this).html()==$(this).attr("hvalue")){
            $(this).html("");
         }
            
        });
    
        $('#jokeAddTextArea').blur(function(){
         if($(this).html()==""){
            $(this).html($(this).attr("hvalue"));
         }
            
         if( (self.symbols-$(this).val().length)<0 ){
            $(this).val($(this).val().substr(0,self.symbols));            
         }            
          $("#symLeft").html(self.symbols-$(this).val().length);
        });


        $('#jokeAddTextArea').keypress(function(){            
           
         if( (self.symbols-$(this).val().length)<0 ){
            $(this).val($(this).val().substr(0,self.symbols));            
         }
             $("#symLeft").html(self.symbols-$(this).val().length);
        });

    
        $('#emailInput').focus(function(){
         if($(this).val()==$(this).attr("hvalue")){
            $(this).val("");
         }
            
        });
    
        $('#emailInput').blur(function(){
         if($(this).val()==""){
            $(this).val($(this).attr("hvalue"));
         }            
        });      
},

clearFields:function(){    
    $('#jokeAddTextArea').val('');
},
    
insertJoke: function ()
{
 var self=this.self;
         if($('#emailInput').val()==$('#emailInput').attr("hvalue")){
            $('#emailInput').val("");
         };
if(self.lockTrigger==true){
    return false;
}
self.lockTrigger=true;           
jQuery.ajax({
          url: '/ajax/addJoke',
          type: 'POST',
          data: $("#addJokeForm").serialize(),
          success: function(data) 
          {
            self.lockTrigger=false;
              var obj=jQuery.parseJSON(data);
              if(obj.type=='error'){
                    
                    $('#jMess').css('display','none');                    
                    $('#jError').css('display','block');
                    $('#jError').html(obj.answer);
              }
              
               if(obj.type=='message'){
                self.clearFields();
                    $('#jError').css('display','none');
                    $('#jMess').css('display','block');
                    $('#jMess').html(obj.answer);
               }
          }
        });

}


}


jQuery(document).ready(function(){    
    joker.init();
});