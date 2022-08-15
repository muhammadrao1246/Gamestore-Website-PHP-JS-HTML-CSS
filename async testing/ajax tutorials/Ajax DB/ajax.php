<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajax Implementation</title>
</head>
<body>
    <div>
        <h3>
            Ajax Testing To change Graph
        </h3>
        <div>
            <input type="text" id="field">
        </div>
        <div id="content">

        </div>
        <button class="btn" onclick="response(this);">
            Search Record
        </button>
    </div>


<script>
var request = new XMLHttpRequest();
    
function response(btn) 
    {
        btn.style.backgroundColor="white";
        
        
        request.onreadystatechange=function() {
            if ( request.readyState == 4 && request.status == 200 ) 
            {
                document.getElementById('content').innerHTML = request.responseText;
                alert(request.statusText);
            } 
        };
        

        request.onload = request.open('GET','result.php?id="'+document.getElementById('field').value+'"',true);
        request.send();
    }
</script>
</body>
</html>