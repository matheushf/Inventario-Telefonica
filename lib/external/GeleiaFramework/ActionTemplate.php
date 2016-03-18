case "##INSTANCE##_add": {
	if($_POST) {
		if($_POST['id'] != "") {
			if($##INSTANCE##->Update()) {
				Useful::JsAlert("##ENTITY## atualizado com sucesso.");
				Useful::JsRedirect("index.php");
			} else {
				Useful::JsAlert("Falha ao atualizar.");
				Useful::JsRedirect("index.php?msg=falha ao atualizar");
			}
		} else {
			if($##INSTANCE##->Save()) {
				Useful::JsAlert("##ENTITY## salvo com sucesso.");
				Useful::JsRedirect("index.php");
			}
		}
	}			
	break;
} //end ##INSTANCE##_add


case "##INSTANCE##_delete" : {
	if($_POST) {
		if($##INSTANCE##->Delete($_POST['Id'])) {
			echo "true";
			return true;
		} else {
			echo 'false';
			return false;
		}
	}
	break;
} //end ##INSTANCE##_delete