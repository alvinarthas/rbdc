<!DOCTYPE html>
<html>
	<head>
		<title>Form Survey</title>
	</head>
	<style type="text/css">
	body{
		font-size: 12pt;
	}
		table{
			 border-collapse: collapse;
	   		border: 1px solid black;
			font-size: 12pt;
		}
		th {
		    background-color: #DDDDDD;
		    color: #333;
		    padding: 10px 0px;		    
		    border: solid 1px #AAA;
		font-size: 12pt;		    
		}
		td {
    		border: 1px solid #ddd;
    		text-align: center;
		font-size: 12pt;
		}			
		tr:nth-child(even) {background-color: #f9f9f9}
	</style>

	<body>
		<div style="text-align: center;margin-bottom: 0px">
		<center>
				<p style="font-size: 12pt;font-weight: bold;font-family: sans-serif;text-transform: uppercase;">Form Survey</p>
				<h4>RIAU BANGKIT DATA CENTER (RBDC)</h4>
		</center>
		</div>

		<div style="font-size: 10pt;">
        <form action="/action_page.php">
            Nama Lengkap :<br><input type="text" name="text" size="100"><br><br>
            Siapakah Gubernur Pilihan Anda ?  : <br><input type="text" name="text" size="100"><br><br>
            Apakah Anda Mengenal LE HARDI ?   : <br><input type="text" name="text" size="100"><br><br>
            Berapa Target perolehan Suara LE-Hardi di TPS anda ?          : <br><input type="text" name="text" size="100"><br><br>
            Siapa saingan terberat LE menurut anda ?          : <br><input type="text" name="text" size="100"><br><br>
            Siapa yg paling mempengaruhi pilihan masy di tmpat tinggal Anda ?           : <br><input type="text" name="text" size="100"><br><br>
        </form>
		</div>
	</body>
</html>