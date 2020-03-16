<html>
<head>
<title>ajax</title>
<script>

var xhr=new XMLHttpRequest();

//get methodd funziona per dare id mettere ?id=67
/*xhr.open("GET",'http://localhost/apiTpst/M_Student.php/89',true);
xhr.send();*/
xhr.onload=function()
{
    document.getElementById("risposta").innerHTML=xhr.response;
};

xhr.onerror=function()
{
    alert("errore");
};

 // POST funziona
//xhr.open("POST",'http://localhost/apiTpst/M_Classes.php' , true);
//xhr.send();
//torna delete
xhr.open("DELETE",'http://localhost/apiTpst/M_Classes.php/64',true);
xhr.send();
/*
xhr.open("PATCH",'http://localhost/apiTpst/M_Student.php',true);
xhr.send(JSON.stringify({
"id":1719,
"name":"admir",
"surname":"MUCAJ"

}));*/

/*xhr.open("PUT",'http://localhost/apiTpst/M_Student.php',true);
xhr.open("PUT",'http://localhost/apiTpst/M_Classes.php',true);
xhr.send(JSON.stringify({

"id":64,
"year":2030,
"section":"4bia"


}));*/
</script>
</head>
<body>
<h1>MEUCCI </h1>
<p>risposta</p>
<div id="risposta"></div>
</body>
</html>

