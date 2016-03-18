<?php
	if(!class_exists('##SUPER##')) 	
		include($_SERVER['DOCUMENT_ROOT'] . "/global.php");
	require_once($actions);
	
	$##INSTANCE##->forceAuthentication();
	
	$SelectedMenu = '##MENU##';
	
	##EDIT##
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="/css/default.css" rel="stylesheet" type="text/css" />
<link href="/css/default-layout.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery.min.js"></script>
<script>
var $q = jQuery.noConflict();
</script>
<script type="text/javascript" src="/js/jquery.alphanumeric.pack.js"></script>
<script type="text/javascript" src="/js/jquery.maskedinput.js"></script>
<script type="text/javascript" src="/js/global.js"></script>
<script type="text/javascript" src="js/form.js"></script>
<title><?=_PAGE_TITLE?></title>
</head>
<body>
<form action="?m=##INSTANCE##_add" method="post" name="f1" id="f1" enctype="multipart/form-data">
<div id="Container">
		   <? require_once($doc_root . '/_header.php');?>     
          <div id="MainContent">
              <div id="MainInner">
              	<h2>##TITLE## -  
           	    <?=($editing ? "Atualizando" : "Cadastrando")?> </h2>
                <p></p>
                <table id="PageLayout" border="0" cellspacing="0" cellpadding="0">
                  <tr>
				  	<td height="40">
						<input id="BtnSave" name="BtnSave" type="submit" value="Salvar">
                     ou <a href="javascript:history.back();">cancelar</a>
					</td>
				  </tr>
                  <tr>
                    <td valign="top">
                    <fieldset>
                    <legend>Preencha as informa&ccedil;&otilde;es abaixo e clique em Salvar</legend>
                    
                    <div class="Form">
					    ##FORM##
					</div>               
                    </fieldset>
					</td>
                  </tr>
                  <tr>
				  	<td height="40">
						<input id="BtnSave" name="BtnSave" type="submit" value="Salvar">
                     ou <a href="javascript:history.back();">cancelar</a>
					</td>
				  </tr>
                </table>

              </div>
          </div>
    </div> <!-- begin tag is inside _header.php -->   
    <div id="Footer">
    	<? require_once($doc_root . '/_footer.php');?>
    </div>
</div>
</form>
</body>
</html>
