<html>

<head>
	<title>Cetak PDF</title>
	<style>
		img {
			width: 100%;
		}
	</style>
	<script>
		window.print();
		window.onafterprint = function() {
			window.close();
		}
	</script>
</head>

<body>
	<img src="/dashboard/generateqr">
</body>

</html>
