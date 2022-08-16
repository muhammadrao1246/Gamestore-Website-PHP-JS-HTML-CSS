var request = new XMLHttpRequest();

function response(filename,variables,method) 
{ 
    var response_dom= new DOMParser();
    request.addEventListener('readystatechange',function (){
        if (this.readyState == 4 && this.status == 200) 
        {
               response_dom = request.responseText;
                document.getElementById('content').innerHTML=response_dom;
        }
    });  
console.log(filename+variables);
    request.open(method,filename+variables,true);
    request.send();

    
}