<html>
<head>
	<title>Contoh AJAX title</title>
	
</head>
<body>

	<h1>Request File Dari HTML </h1>
	<form>
		<input type="button" value="Request File  " onclick="getpages('{{ URL::route('req') }}','centercol')">
	</form>
	<div id="centercol">
		File request.html akan ditampilkan disini 
	</div>
	
	<script language = "javascript">
		function GetXmlHttpObject(){
			var xmlHttp=null;
			try {
				//Untuk Browser Firefox, Opera 8.0+, Safari
				xmlHttp=new XMLHttpRequest();
			}
			catch (e){
				//Untuk Browser Internet Explorer
				try {
					xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch (e){
					xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
			}
			return xmlHttp;
		}

		function getpages(url,centercol) {
			xmlHttp=GetXmlHttpObject();
			if (xmlHttp) {
				var obj = document.getElementById(centercol);
				xmlHttp.open("GET", url);
				xmlHttp.onreadystatechange = function() {
					if (xmlHttp.readyState == 1) {
						obj.innerHTML = '<img alt="Halaman Sedang Dimuat " src="img/ajax-loader.gif" alt="loading" / >';
					}
					if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
						obj.innerHTML = xmlHttp.responseText;
					}
				}
				xmlHttp.send(null);
			}
		}
	</script>

</body>


</html>
