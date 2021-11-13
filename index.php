<!DOCTYPE html>
<html>
<head>
	<title>Caesar Cipher</title>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
	<div>
		<h1>Encryption <---> Decryption Techniques</h1> 
		<table>
			<tr>
				<td> String :</td>
				<td><input type="text" id="string" placeholder="Enter string"></td>
			</tr>
			<tr>
				<td> Technique :</td> 
		   		<td>
		   			<select id="technique">
		   				<option value="">Choose</option>
				        <option value="ceasar">Caesar Cipher</option>
				        <option value="playfair">Play fair</option>
				        <option value="RC4">RC4</option>
				        <option value="RSA">RSA</option>
		        	</select>
		        </td>
		    </tr>
		    <tr class="offset" style="display: none">
		    	<td> Offset :</td>
				<td><input type="number" id="offset" placeholder="Enter Offset"></td>
		    </tr>
		    <tr class="key" style="display: none">
		    	<td> Key :</td>
				<td><input type="text" id="key" placeholder="Enter Key"></td>
		    </tr>
		    <tr>
				<td> Type :</td> 
		   		<td>
		   			<select id="type">
				        <option value="encrypt">Encryption</option>
				        <option value="decrypt">Decryption</option>
		        	</select>
		        </td>
		    </tr>
			<tr>
				<td>Result :</td>
				<td><input type="text" id="result" placeholder="Result" disabled></td>
			</tr>
		</table> 
	</div>

	<script type="text/javascript" src="jquery.min.js"></script>
	<script type="text/javascript" src="scripts.js"></script>
</body>
</html>