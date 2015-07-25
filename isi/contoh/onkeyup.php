
      <html>
    <head>

    <script src="../js/jquery-1.11.1.min.js"  type="text/javascript"></script>
<script src="../js/jquery-ui.min.js"  type="text/javascript"></script>

    <script type="text/javascript">
    function lookup(a){
		if(a.length==0)
		{$("#suggestions").hide()
    }else{
    $.post("carinama.php",{queryString:""+a+""},
    function(b){if(b.length>0)
    {
    $("#suggestions").show();$("#autoSuggestionsList").html(b)}
    }
    )
    }
    }function fill(a){$("#inputString").val(a);setTimeout("$(‘#suggestions’).hide();",200)}
    </script>
    <style type="text/css">
    .suggestionsBox{
    position:relative;
    left:30px;
    margin:0 auto;
    width:300px;
    background-color:#212427;
    -moz-border-radius:7px;
    -webkit-border-radius:7px;
    border:2px solid #000;
    color:#fff}
    .suggestionList{
    margin:0;
    padding:0}
    .suggestionList
    li{
    margin:0 0 3px 0;
    padding:3px;
    cursor:pointer}
    .suggestionList
    li:hover
    {
    background-color:#659cd8}
    .tengah{
    margin:0 auto;padding-top:10px;
    padding-left:310px;
    font-family:Helvetica;
    font-size:14px}
    .judul{padding-left:390px;
    font-family:Helvetica,Geneva,sans-serif}
    </style>

    <table border="0" align=’center’>
    <tr><td>
    <form method="POST" action="index.php">
    <input type =’text’ name = ‘KUNCI’ placeholder="Inputkan Nama Disini" id="inputString" onkeyup="lookup(this.value)" onblur="fill()">
    <input type =’submit’ name = ‘CARI’ value=’CARI’>
    <font style="font-size:12px"><br><!–b>Mencari Data 1 Bulan = "01/2013"</b–></font>

    <font style="font-size:12px"><br><!–b>Mencari Berdasarkan tanggal Format = "05/11/2012"<br>
    Mencari Data 1 Bulan = "01/2013"</b–>
    </font>
    <div class="suggestionsBox" id="suggestions" style="display:none">
    <img src="upArrow.png" style="position:relative;top:-12px;left:30px" alt="upArrow" />
    <div class="suggestionList" id="autoSuggestionsList">
    &nbsp;
    </div>
    </div>
    </td></tr>
    </form>
    </table>

  

    </body>
    </html> 