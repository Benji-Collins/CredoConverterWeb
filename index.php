<!doctype html>
<html>
<head>

<title>CredoConverter</title>

<meta charset="UTF-8">

<style type="text/css">
/* For elements */
* {
    box-sizing: border-box;
}
.title {
    text-align: center;
    cursor: default;
}
body {
	padding-top: 15em;
	color: #FFFFFF;
	font-family: Arial,Helvetica,sans-serif;
	display:flex;
	justify-content:center;
	align-items:center;
}
.url:focus,
.url:active,
.go:focus,
.go:active {
	outline: none;
}
.input {
	width: 100%;
	margin: none;
	background-color: #0000004D;
	color: #FFFFFF;
	border: none;
	outline: none;
	font-size: 14px;
	padding: .5em;
}
.go {
	width: 100%;
	background-color: #0000004D;
	color: #FFFFFF;
	cursor: pointer;
}
.go {
	padding: .5em;
	border: none;
	font-size: 14px;
}
.container {
	padding: 1em;
	margin: 1em auto;
	width: 40em;
	background: #00000040;
	z-index: 2;
}
.container:after {
	display: table;
	content: '';
	clear: both;
}
.notice {
    text-align: center;
    padding-top: 1em;
    cursor: default;
}
canvas {
    position: absolute;
    top: 0;
    z-index: -1;
}
#form {
	display: flex;
	justify-content: space-between;
}
/* For links */
a {
    color: #FFFFFF;
    cursor: pointer;
	text-decoration: underline;
}
a:link {
    color: #FFFFFF; 
    background-color: transparent; 
    text-decoration: underline;
}

a:visited {
    color: #FFFFFF;
    background-color: transparent;
    text-decoration: underline;
}

a:hover {
    color: #FFFFFF;
    background-color: transparent;
    text-decoration: underline;
}

a:active {
    color: #FFFFFF;
    background-color: transparent;
    text-decoration: underline;
}
/* For transparency */
::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
    color: #bfbfbf;
    opacity: 1; /* Firefox */
}
::-ms-input-placeholder { /* Internet Explorer 10-11 */
    color: #bfbfbf;
}
::-ms-input-placeholder { /* Microsoft Edge */
    color: #bfbfbf;
}
#input1, #input2, #input3 {
	width: 30%;
}
#input1 {
	order: 1;
}
#input2 {
	order: 2;
}
#input3 {
	order: 3;
}
#input4 {
	order: 4;
}
p {
	font-size: 12px;
	text-align: center;
}
#invisible {
	color: #ffffff00;
}
.results {
	display: block;
	font-size: 15px;
	line-height: 24px;
}
#resultswrapper {
	padding-top: 1em;
}
</style>
</head>
<body>

<div class="container">
	<div class="title">
		<h1>CredoConverter</h1>
	</div>
	
		
	<div id="frm">
	
		<form method="post" id="form">
			<div id="input1">
				<p>Your total CREDO:</p>
				<input class="input" name="credo_total" type="text" autocomplete="off">
			</div>
			<div id="input2">
				<p>Total you paid for CREDO in $:</p>
				<input class="input" name="total_paid" type="text" autocomplete="off">
			</div>
			<div id="input3">
				<p>Current CREDO price in ETH:</p>
				<input class="input" name="credo_eth" type="text" autocomplete="off">
			</div>
			<div id="input4">
				<p id="invisible">Hi</p>
				<input class="go" type="submit" value="Go">
			</div>
		</form>
		
		<script type="text/javascript">
			document.getElementsByName("credo_total")[0].focus();
		</script>

		<?php
			if(array_key_exists('credo_total',$_POST))
			{
				calculate();
			}
			
			function calculate()
			{
				if (is_numeric($_POST['credo_total']))
				{
					$credo_total = $_POST['credo_total'];
				}
				if (is_numeric($_POST['total_paid']))
				{
					$total_paid = $_POST['total_paid'];
				}
				if (is_numeric($_POST['credo_eth']))
				{
					$credo_eth = $_POST['credo_eth'];
				}
				
				$command = "python CredoConverterWeb.py " . $credo_total . " " . $total_paid . " " . $credo_eth;
				$rawoutput = exec($command);

				list($eth_price, $credo_price, $credo_value, $difference) = explode(":", $rawoutput);
				echo '<div id="resultswrapper"><div class="results">Current ETH price in AUD: ' . $eth_price . '</div><div class="results">Current CREDO price in AUD: ' . $credo_price . '</div><div class="results">Your CREDO is currently worth: ' . $credo_value . '</div><div class="results">Your CREDO is (approximately) worth ' . $difference . ' than what you paid.</div></div>';
			}
		?>
	</div>
	
<div class="notice">
    Find full instructions and more info at <a href="https://github.com/Benji-Collins/CredoConverterWeb/">my Github</a>.
        </div></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/trianglify/1.1.0/trianglify.min.js"></script>
<script>
    var colours = ["YlGn", "YlGnBu", "GnBu", "BuGn", "PuBuGn", "PuBu", "BuPu", "RdPu", "Purples", "Blues", "Greens", "RdYlBu", "Spectral", "RdYlGn"];
    var pattern = Trianglify({
        width: window.innerWidth,
        height: window.innerHeight,
        cell_size: 60 + Math.random() * 100,
        x_colors: colours[Math.floor(Math.random()*colours.length)],
        y_colors: 'match_x',
        stroke_width: 2
    });
    document.body.appendChild(pattern.canvas())
</script>
</body>
</html>
