<?php
echo'<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html" charset="utf-8"><meta name=Generator content="Siebel for Aliplast"><meta name=Developer content="Jens De Schrijver">
		<style>
			/* Font Definitions */
			@font-face{font-family: "Century Gothic";panose-1:2 11 5 2 2 2 2 2 2 4;mso-font-charset:0;mso-generic-font-family:swiss;mso-font-pitch:variable;mso-font-signature:647 0 0 0 159 0;}
			/* Style Definitions */
			body{padding: 20px;font-family:"Century Gothic","Helvetica Neue", "Helvetica", "Verdena", "Arial", "sans-serif";}
			.normal, p.normal, li.normal, div.normal{mso-style-unhide:no;mso-style-qformat:yes;mso-style-parent:"";margin:0cm;margin-bottom:.0001pt;mso-pagination:widow-orphan;font-size:11.0pt;font-family:"Century Gothic","Helvetica Neue", "Helvetica", "Verdena", "Arial", "sans-serif";mso-fareast-font-family:Calibri;mso-fareast-theme-font:minor-latin;mso-bidi-font-family:"Times New Roman";mso-fareast-language:EN-US;}
			p{margin: 0 0 15px 0;font-family:"Century Gothic","Helvetica Neue", "Helvetica", "Verdena", "Arial", "sans-serif";}
			hr{color:#BFBFBF; border-bottom:solid #BFBFBF 1.0pt; border-left: none; border-right: none; border-top: none; width: 100%; margin-top: 50px;text-align: left;}
			.footer, .footer p {color: #7F7F7F;font-size: 10.0pt;font-family:"Century Gothic","Helvetica Neue", "Helvetica", "Verdena", "Arial", "sans-serif";}
			.footer a {color: #7F7F7F;text-decoration: none;font-family:"Century Gothic","Helvetica Neue", "Helvetica", "Verdena", "Arial", "sans-serif";}
			table td{min-height: 12.35pt;border: none;padding: 0 5.4pt 0 5.4pt;font-family:"Century Gothic","Helvetica Neue", "Helvetica", "Verdena", "Arial", "sans-serif";}
			table td.leftcolumn{border-right:solid #BFBFBF 1.0pt;width:121.9pt; font-family:"Century Gothic","Helvetica Neue", "Helvetica", "Verdena", "Arial", "sans-serif";}
			b{font-weight: bold;font-family:"Century Gothic","Helvetica Neue", "Helvetica", "Verdena", "Arial", "sans-serif";}
		</style>
	</head>
	<body class="normal"><div><div id="header"><p><b>' . $this->messenger_model->getMailText('greeting', $lang) . '</b></p></div>';
?>