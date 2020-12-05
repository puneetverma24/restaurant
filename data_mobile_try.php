 <html>
<head>
<script>
function showHint(str) {
    if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "data_by_mobile.php?q=" + str, true);
        xmlhttp.send();
    }
}
</script>
</head>
<body>
<center>

<p><b>Nutriler:</b></p>
<form>
Name: <input type="text" style="font-size: 20px" onkeyup="showHint(this.value)">
</form>
<p>Users: <span id="txtHint"></span></p>

</center>
</body>
</html> 