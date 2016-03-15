<?
if(!class_exists('##SUPER##')) 	
		include($_SERVER['DOCUMENT_ROOT'] . "/global.php");
	require_once($actions);
	
	$##INSTANCE##->forceAuthentication();
	
	$SelectedMenu = '##MENU##';
	
	$ObjList = $##INSTANCE##->Listing();
	
	
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
<script type="text/javascript" src="js/index.js"></script>
<title><?=_PAGE_TITLE?></title>
</head>
<body>
<form action="?" method="post" name="f1" id="f1">
<div id="Container">
		   <? require_once($doc_root . '/_header.php');?>     
          <div id="MainContent">
              <div id="MainInner">
              	<h2>##TITLE##</h2>
                <p></p>
                <table id="PageLayout" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="40" valign="middle">
					  <span class="floatleft">
						<input name="BtnNovo" type="button" id="BtnNovo" value="Novo">
						<input name="BtnEditar" type="button" id="BtnEditar" value="Editar">
						<input name="BtnExcluir" type="button" id="BtnExcluir" value="Excluir">
					  </span></td>
                  </tr>
                  <tr>
                    <td align="left">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left">
                    <table width="100%" class="TableGridView" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <th width="30" scope="col">&nbsp;</th>
                        <th scope="col" class="aleft">Nome</th>
                        <th scope="col" class="aleft">Email</th>
                      </tr>
					  <? foreach( ($ObjList ? $ObjList : array()) as $Obj) { ?>
                      <tr>
                        <td align="center">
                        <input type="checkbox" name="id" id="id" value="<?=$Obj->##CHANGE##?>"></td>
                        <td  class="aleft"><?=$Obj->##CHANGE##?></td>
                        <td  class="aleft"><?=$Obj->##CHANGE##?></td>
                      </tr>
					  <? } ?>
                    </table></td>
                  </tr>
                  <tr>
                    <td align="left">&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="40" valign="middle">&nbsp;</td>
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
