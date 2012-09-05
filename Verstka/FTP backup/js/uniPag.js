function unipag(data){
var pagObject=[];

var pagStruct={
    left:0,
    right:0,    
    list:[]
};

var throwFirst=10;
var throwSecond=50;
var throwThird=100;

var page=parseInt(data.page);

var pagesRadius=3;
if(data.pagesRadius!=undefined){pagesRadius=data.pagesRadius}

//------------//вычисление стартовой и конечной страниц//------------//
var pagesAmount=data.pages.length-1;

if(pagesAmount<=0){
    pagObject.push(0);
    return (pagObject);    
    }
pagesRadius--;
pc=page-pagesRadius;

pcEnd=page+pagesRadius;
if(pc<0){pc=0;}

if(pcEnd>pagesAmount){pcEnd=pagesAmount;}
if(page<=pagesAmount){pagStruct.right=page+1;}
if(page>1){pagStruct.left=page-1;}

//------------//this.end//------------//
    if( pc>0 )
      {
           if(page-throwThird>0){pagObject.push(page-throwThird)}else{pagObject.push(0)} 
           if(page-throwSecond>0){pagObject.push(page-throwSecond)} 
           if(page-throwFirst>0){pagObject.push(page-throwFirst)}           
      }
////////&laquo; gen end

//------------//content//------------//
    for (var i=pc;i<pcEnd;i++)
     {
       pagObject.push(i);     
     }
//------------//contentEnd//------------//
            if(page+throwFirst<pagesAmount){pagObject.push(page+throwFirst)}
            if(page+throwSecond<pagesAmount){pagObject.push(page+throwSecond)}
            if(page+throwThird<pagesAmount){pagObject.push(page+throwThird)}else{pagObject.push(pagesAmount);}        
////////&raquo; gen end

pagStruct.list=pagObject;
return (pagStruct);
/////////-------------paginationEND-------------/////////
};
