<!doctype html>
<html lang="en">

<head>
	<title>Scan QR</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>
	<div class="container text-center">
		<div id="scan" style="margin-top: 1em"></div>
		<a style="margin-top: 1em" class="btn btn-primary text-white" href="/dashboard">Kembali</a>
	</div>
	<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
	<script>
		const html5QrCode = new Html5Qrcode('scan')
		const qrCodeSuccessCallback = async (result) => {
			html5QrCode.stop()
			if (result) {
				await $.ajax({
					url: '/dashboard/processqr',
					method: 'POST',
					success: (res) => {
						if (res.success) {
							alert(res.message)
						} else {
							alert(res.message)
						}
					},
					error: (err) => {
						alert(err)
					}
				})
			}
			window.close()
		}
		const config = {
			fps: 10,
			rememberLastUsedCamera: true,
			supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_CAMERA],
			// aspectRatio: 1.333334,
			qrbox: {
				width: 450,
				height: 450,
			},
		}
		html5QrCode.start({
			facingMode: 'environment'
		}, config, qrCodeSuccessCallback)
	</script>
</body>

</html>
