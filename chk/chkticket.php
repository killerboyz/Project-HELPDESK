<?php

if($_POST['ChkConfirm'] == "ABC"){

	echo "Ticket Topic : ".$_POST['TicketTopic']."</br>";
	echo "Type : ".$_POST['Type']."</br>";
	echo "Trouble Detail : ".$_POST['TroubleDetail']."</br>";
	echo "Priority : ".$_POST['priLvl']."</br>";
	echo "Create Ticket Succes!";

}
else {
	echo "<script>
		alert(\"Please type ABC !!\");
		window.history.back();
		</script>";
exit();
}
?>