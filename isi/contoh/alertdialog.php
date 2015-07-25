<html>
<head><title></title></head>

<script src="jquery-1.11.1.min.js" type="text/javascript" ></script>
<script src="jquery-ui.min.js" type="text/javascript" ></script>
<link href="jquery-ui.css" type="text/css" rel="stylesheet" >

<style type="text/css">
#kotak-dialog {
  position:absolute;
  top:20%;
  left:50%;
  margin:0px 0px 0px -200px;
  width:400px;
  height:auto;
  background-color:#fff;
  -webkit-box-shadow:0px 1px 2px rgba(0,0,0,0.4);
  -moz-box-shadow:0px 1px 2px rgba(0,0,0,0.4);
  box-shadow:0px 1px 2px rgba(0,0,0,0.4);
  z-index:1000;
  display:none;
}

#kotak-dialog *:focus {
  outline:none;
}

#kotak-dialog h3.title {
  background-color:#3B5998;
  padding:10px 15px;
  color:#fff;
  font:normal 16px Arial,Sans-Serif;
  margin:0px 0px 0px 0px;
  position:relative;
}

#kotak-dialog h3.title a {
  position:absolute;
  top:10px;
  right:15px;
  color:#fff;
  text-decoration:none;
  cursor:pointer;
}

#kotak-dialog .isi-dialog {
  margin:15px;
  font:normal 12px Arial,Sans-Serif;
}

#kotak-dialog .button-wrapper {
  padding:10px 15px 0px;
  border-top:1px solid #ddd;
  margin-top:15px;
}

#kotak-dialog .button-wrapper button {
  background-color:#FF0C39;
  border:none;
  font:bold 12px Arial,Sans-Serif;
  color:#fff;
  padding:5px 10px;
  -webkit-border-radius:3px;
  -moz-border-radius:3px;
  border-radius:3px;
  cursor:pointer;
}

#kotak-dialog .button-wrapper button:hover {
  background-color:#aaa;
}

#dialog-overlay {
  position:fixed !important;
  position:absolute;
  z-index:999;
  top:0px;
  right:0px;
  bottom:0px;
  left:0px;
  background-color:#000;
  display:none;
}

#badan{
	width:1400px;
	height:1000px;
}
.nav{
	width:1400px;
	background:;
	height:50px;
}
</style>


<script type="text/javascript">

$(function() {
     //Tampilkan kotak dialog saat .open-dialog diklik
     $('.open-dialog').hover(function() {
          $('#kotak-dialog').show();
          $('#dialog-overlay').fadeTo("normal", 0.4);
          return false;
     });

     //Tutup kotak dialog saat .close diklik
     $('#kotak-dialog .close').click(function() {
          $('#kotak-dialog').fadeOut();
          $('#dialog-overlay').hide();
          return false;
     });

     //Aksi utama dituliskan di sini, saat tombol OK diklik
     $('#kotak-dialog .okeh').click(function() {
          alert("Awal nya Seperti Ini. Jadi seperti itu ==>");
     });
});

//Menu Melayang..
$(document).ready(function() {
    // Menentukan elemen yang dijadikan sticky yaitu .nav
    var stickyNavTop = $('.nav').offset().top; 
    var stickyNav = function(){
        var scrollTop = $(window).scrollTop();  
        // Kondisi jika discroll maka menu akan selalu diatas, dan sebaliknya        
        if (scrollTop > stickyNavTop) { 
            $('.nav').css({ 'position': 'fixed', 'top':0, 'z-index':9999 });
        } else {
            $('.nav').css({ 'position': 'relative' });
        }
    };
    // Jalankan fungsi
    stickyNav();
    $(window).scroll(function() {
        stickyNav();
    });
});
</script>


</script>
<body>
<div id="badan">
<br/><br/><br/><br/><br/>
	<div class="nav">
	
	</div>
	<div id='kotak-dialog'>
		<h3 class='title'>Tanya Pada Dirimu Sendiri :P<a href='#' class='close'>&#215;</a></h3>
		<div class='isi-dialog'>

			Kapan Mau Nikah ? :D

			<div class='button-wrapper'>
				<button class='okeh'>Tahun Ini ?</button> 
				<button class='close'>Tahun depan ?</button>
			</div>

		</div>
	</div> <!-- end kotak-dialog -->


	<div id='dialog-overlay'></div>

	<p class="open-dialog">klik</p>
</div>
</body>
</html>