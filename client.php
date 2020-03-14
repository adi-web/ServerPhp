<html>
<head>
<title>ajax</title>
<script>

var xhr=new XMLHttpRequest();

//get methodd funziona per dare id mettere ?id=67
//xhr.open("GET",'http://localhost/apiTpst/M_Classes.php?id=20',true);
//xhr.send();
xhr.onload=function()
{
    document.getElementById("risposta").innerHTML=xhr.response;
};

xhr.onerror=function()
{
    alert("errore");
};

 // POST funziona
//xhr.open("POST",'http://localhost/apiTpst/M_Classes.php?year=2021&section=5bia' , true);
//xhr.send();
//torna delete
//xhr.open("DELETE",'http://localhost/apiTpst/M_Classes.php?id=63',true);
//xhr.send();
/*xhr.open("PATCH",'http://localhost/apiTpst/M_student.php',true);
xhr.send(JSON.stringify({

"id":1698,
"name":"null",
"surname":"mucaj",
"taxCode":"6666666666666",
"sidiCode":"4444444444"

}));*/

xhr.open("PUT",'http://localhost/apiTpst/M_Classes.php',true);
xhr.send(JSON.stringify({

"id":61,
"year":2023,
"section":"null"

}));
</script>
</head>
<body>
<h1>MEUCCI </h1>
<p>risposta</p>
<div id="risposta"></div>
</body>
</html>

