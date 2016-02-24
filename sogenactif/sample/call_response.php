<!--
-------------------------------------------------------------
 Topic		: Exemple PHP traitement de la réponse de paiement
 Version 	: P615

	Dans cet exemple, les données de la transaction	sont
	décryptées et affichées sur le navigateur de l'internaute.

-------------------------------------------------------------
-->


<!--	Affichage du header html -->

<?php
	include("../../config.php");

	
	print ("<HTML><HEAD><TITLE>SOGENACTIF - Paiement Securise sur Internet</TITLE></HEAD>");
	print ("<BODY bgcolor=#ffffff>");
	print ("<Font color=#000000>");
	print ("<center><H1>Test de l'API plug-in SOGENACTIF</H1></center><br><br>");

	// Récupération de la variable cryptée DATA
	$message="message=$_POST[DATA]";
	
	// Initialisation du chemin du fichier pathfile (à modifier)
    //   ex :
    //    -> Windows : $pathfile="pathfile=c:/repertoire/pathfile";
    //    -> Unix    : $pathfile="pathfile=/home/repertoire/pathfile";
   
   $pathfile="pathfile=/home/reserverrz/www/sogenactif/param/pathfile";

	// Initialisation du chemin de l'executable response (à modifier)
	// ex :
	// -> Windows : $path_bin = "c:/repertoire/bin/response";
	// -> Unix    : $path_bin = "/home/repertoire/bin/response";
	//

	$path_bin = "/home/reserverrz/www/sogenactif/bin/static/response";

	// Appel du binaire response
  	$message = escapeshellcmd($message);
	$result=exec("$path_bin $pathfile $message");


	//	Sortie de la fonction : !code!error!v1!v2!v3!...!v29
	//		- code=0	: la fonction retourne les données de la transaction dans les variables v1, v2, ...
	//				: Ces variables sont décrites dans le GUIDE DU PROGRAMMEUR
	//		- code=-1 	: La fonction retourne un message d'erreur dans la variable error


	//	on separe les differents champs et on les met dans une variable tableau

	$tableau = explode ("!", $result);

	//	Récupération des données de la réponse
	
	$code = $tableau[1];
	$error = $tableau[2];
	$merchant_id = $tableau[3];
	$merchant_country = $tableau[4];
	$amount = $tableau[5];
	$transaction_id = $tableau[6];
	$payment_means = $tableau[7];
	$transmission_date= $tableau[8];
	$payment_time = $tableau[9];
	$payment_date = $tableau[10];
	$response_code = $tableau[11];
	$payment_certificate = $tableau[12];
	$authorisation_id = $tableau[13];
	$currency_code = $tableau[14];
	$card_number = $tableau[15];
	$cvv_flag = $tableau[16];
	$cvv_response_code = $tableau[17];
	$bank_response_code = $tableau[18];
	$complementary_code = $tableau[19];
	$complementary_info = $tableau[20];
	$return_context = $tableau[21];
	$caddie = $tableau[22];
	$receipt_complement = $tableau[23];
	$merchant_language = $tableau[24];
	$language = $tableau[25];
	$customer_id = $tableau[26];
	$order_id = $tableau[27];
	$customer_email = $tableau[28];
	$customer_ip_address = $tableau[29];
	$capture_day = $tableau[30];
	$capture_mode = $tableau[31];
	$data = $tableau[32];
	$order_validity = $tableau[33];  
	$transaction_condition = $tableau[34];
	$statement_reference = $tableau[35];
	$card_validity = $tableau[36];
	$score_value = $tableau[37];
	$score_color = $tableau[38];
	$score_info = $tableau[39];
	$score_threshold = $tableau[40];
	$score_profile = $tableau[41];

	$auth = $authorisation_id;

	//  analyse du code retour
	
	if ($code == 0)
	{

		$sql = mysql_query("insert into sogenactif(coderetour,error,merchant_id,merchant_country,amount,transaction_id,payment_means,transmission_date,payment_time,payment_date,
		response_code, payment_certificate,authorisation_id,currency_code,card_number,cvv_flag,cvv_response_code,bank_response_code,complementary_code,complementary_info,
		return_context,caddie,receipt_complement,merchant_language,language,customer_id,customer_email,customer_ip_address,capture_day,capture_mode,data,order_validity,
		transaction_condition,statement_reference,card_validity,score_value,score_color,score_info,score_threshold, score_profile)values('".$code."','".$error."','".$merchant_id."',
		'".$merchant_country."','".$amount."','".$transaction_id."','".$payment_means."','".$transmission_date."','".$payment_time."','".$payment_date."','".$response_code."',
		'".$payment_certificate."','".$authorisation_id."','".$currency_code."','".$card_number."','".$cvv_flag."','".$cvv_response_code."','".$bank_response_code."','".$complementary_code."',
		'".$complementary_info."','".$return_context."','".$caddie."','".$receipt_complement."','".$merchant_language."','".$language."','".$customer_id."','".$customer_email."',
		'".$customer_ip_address."','".$capture_day."','".$capture_mode."','".$data."','".$order_validity."','".$transaction_condition."','".$statement_reference."',
		'".$card_validity."','".$score_value."','".$score_color."','".$score_info."','".$score_threshold."','".$score_profile."');");
	
		if ($sql)
		{
			//echo "Insertion réussi !!";
			header('Location:../../paiementValide.php');
		} else
		{
			echo "Erreur durant l'insertion !";
		}
		//header('Location:../../paiementValide.php');
	}
	
	

  if (( $code == "" ) && ( $error == "" ) )
 	{
  	print ("<BR><CENTER>erreur appel response</CENTER><BR>");
  	print ("executable response non trouve $path_bin");
 	}

	//	Erreur, affiche le message d'erreur

	else if ( $code != 0 ){
		//print ("<center><b><h2>Erreur appel API de paiement.</h2></center></b>");
		//print ("<br><br><br>");
		//print (" message erreur : $error <br>");
		
		 mysql_query("insert into sogenactif(coderetour,error,merchant_id,merchant_country,amount,transaction_id,payment_means,transmission_date,payment_time,payment_date,
		response_code, payment_certificate,authorisation_id,currency_code,card_number,cvv_flag,cvv_response_code,bank_response_code,complementary_code,complementary_info,
		return_context,caddie,receipt_complement,merchant_language,language,customer_id,customer_email,customer_ip_address,capture_day,capture_mode,data,order_validity,
		transaction_condition,statement_reference,card_validity,score_value,score_color,score_info,score_threshold, score_profile)values('".$code."','".$error."','".$merchant_id."',
		'".$merchant_country."','".$amount."','".$transaction_id."','".$payment_means."','".$transmission_date."','".$payment_time."','".$payment_date."','".$response_code."',
		'".$payment_certificate."','".$authorisation_id."','".$currency_code."','".$card_number."','".$cvv_flag."','".$cvv_response_code."','".$bank_response_code."','".$complementary_code."',
		'".$complementary_info."','".$return_context."','".$caddie."','".$receipt_complement."','".$merchant_language."','".$language."','".$customer_id."','".$customer_email."',
		'".$customer_ip_address."','".$capture_day."','".$capture_mode."','".$data."','".$order_validity."','".$transaction_condition."','".$statement_reference."',
		'".$card_validity."','".$score_value."','".$score_color."','".$score_info."','".$score_threshold."','".$score_profile."');");
		//header('Location:../../paiementAnnule.php');
	}

	// OK, affichage des champs de la réponse
	else {
		
	# OK, affichage du mode DEBUG si activé
	print (" $error <br>");
		
	
	print("<br><br><hr></b></h4>");
	}
	

	print ("</body></html>");


?>
