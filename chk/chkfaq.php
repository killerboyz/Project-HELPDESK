<?php

if($_POST['ChkConfirm'] == "ABC"){

	echo "FAQ Topic : ".$_POST['FAQTopic']."</br>";
	echo "Type : ".$_POST['Type']."</br>";
	echo "Trouble Detail : ".$_POST['TroubleDetail']."</br>";
	echo "Priority : ".$_POST['priLvl']."</br>";
	echo "Create Ticket Succes!";

}
else {
	echo "<script>
		alert(\"Please type ABC !!\");
		window.history.back()
		</script>";
exit();
}
?>