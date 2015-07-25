	<script type="text/javascript">
		var d = new Date();
		var curr_hour = d.getHours();
		var curr_min = d.getMinutes();
		curr_min = curr_min + "";
		if (curr_min.length == 1) {
			curr_min = "0" + curr_min;
		}
		document.write(curr_hour + " : " + curr_min + " WIB &nbsp;&nbsp;");
	</script>