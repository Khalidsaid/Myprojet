<!--
-------------------------------------------------------------
 Topic	 : Exemple PHP traitement de l'autoréponse de paiement
 Version : P615

 		Dans cet exemple, les données de la transaction	sont
		décryptées et sauvegardées dans un fichier log.

-------------------------------------------------------------
-->

<?php
	include("config.php");
	// Récupération de la variable cryptée DATA
	$message="message=$HTTP_POST_VARS[DATA]";

	// Initialisation du chemin du fichier pathfile (à modifier)
	    //   ex :
	    //    -> Windows : $pathfile="pathfile=c:/repertoire/pathfile"
	    //    -> Unix    : $pathfile="pathfile=/home/repertoire/pathfile"
	    
	$pathfile="pathfile=http://reserveruncab.com/sogenactif/param/pathfile";

	//Initialisation du chemin de l'executable response (à modifier)
	//ex :
	//-> Windows : $path_bin = "c:/repertoire/bin/response"
	//-> Unix    : $path_bin = "/home/repertoire/bin/response"
	//

	$path_bin = "http://reserveruncab.com/sogenactif/bin/static/response";

	// Appel du binaire response
  	$message = escapeshellcmd($message);
  	$result=exec("$path_bin $pathfile $message");

	//	Sortie de la fonction : !code!error!v1!v2!v3!...!v29
	//		- code=0	: la fonction retourne les données de la transaction dans les variables v1, v2, ...
	//				: Ces variables sont décrites dans le GUIDE DU PROGRAMMEUR
	//		- code=-1 	: La fonction retourne un message d'erreur dans la variable error


	//	on separe les differents champs et on les met dans une variable tableau

	$tableau = explode ("!", $result);

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
	$complementary_info= $tableau[20];
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
	
	$codecommande = $_GET['ref'];

	// Initialisation du chemin du fichier de log (à modifier)
    //   ex :
    //    -> Windows : $logfile="c:\\repertoire\\log\\logfile.txt";
    //    -> Unix    : $logfile="/home/repertoire/log/logfile.txt";
    //

	//$logfile="/home/reserverrz/www/sogenactif/sample/logs.txt";

	// Ouverture du fichier de log en append

	//$fp=fopen($logfile, "a");

	//  analyse du code retour

  if (( $code == "" ) && ( $error == "" ) )
 	{
  	//fwrite($fp, "erreur appel response\n");
  	print ("executable response non trouve $path_bin\n");
 	}

	//	Erreur, sauvegarde le message d'erreur

	else if ( $response_code != 0 ){
			$sql = mysql_query("insert into sogenactif(coderetour,error,merchant_id,merchant_country,amount,transaction_id,payment_means,transmission_date,payment_time,payment_date,
		response_code, payment_certificate,authorisation_id,currency_code,card_number,cvv_flag,cvv_response_code,bank_response_code,complementary_code,complementary_info,
		return_context,caddie,receipt_complement,merchant_language,language,customer_id,customer_email,customer_ip_address,capture_day,capture_mode,data,order_validity,
		transaction_condition,statement_reference,card_validity,score_value,score_color,score_info,score_threshold, score_profile, codecommande)values('".$code."','".$error."','".$merchant_id."',
		'".$merchant_country."','".$amount."','".$transaction_id."','".$payment_means."','".$transmission_date."','".$payment_time."','".$payment_date."','".$response_code."',
		'".$payment_certificate."','".$authorisation_id."','".$currency_code."','".$card_number."','".$cvv_flag."','".$cvv_response_code."','".$bank_response_code."','".$complementary_code."',
		'".$complementary_info."','".$return_context."','".$caddie."','".$receipt_complement."','".$merchant_language."','".$language."','".$customer_id."','".$customer_email."',
		'".$customer_ip_address."','".$capture_day."','".$capture_mode."','".$data."','".$order_validity."','".$transaction_condition."','".$statement_reference."',
		'".$card_validity."','".$score_value."','".$score_color."','".$score_info."','".$score_threshold."','".$score_profile."','".$codecommande."');");
		
        //fwrite($fp, " API call error.\n");
        //fwrite($fp, "Error message :  $error\n");
 	}
	else {

	// OK, Sauvegarde des champs de la réponse

	 	$sql = mysql_query("insert into sogenactif(coderetour,error,merchant_id,merchant_country,amount,transaction_id,payment_means,transmission_date,payment_time,payment_date,
		response_code, payment_certificate,authorisation_id,currency_code,card_number,cvv_flag,cvv_response_code,bank_response_code,complementary_code,complementary_info,
		return_context,caddie,receipt_complement,merchant_language,language,customer_id,customer_email,customer_ip_address,capture_day,capture_mode,data,order_validity,
		transaction_condition,statement_reference,card_validity,score_value,score_color,score_info,score_threshold, score_profile, codecommande)values('".$code."','".$error."','".$merchant_id."',
		'".$merchant_country."','".$amount."','".$transaction_id."','".$payment_means."','".$transmission_date."','".$payment_time."','".$payment_date."','".$response_code."',
		'".$payment_certificate."','".$authorisation_id."','".$currency_code."','".$card_number."','".$cvv_flag."','".$cvv_response_code."','".$bank_response_code."','".$complementary_code."',
		'".$complementary_info."','".$return_context."','".$caddie."','".$receipt_complement."','".$merchant_language."','".$language."','".$customer_id."','".$customer_email."',
		'".$customer_ip_address."','".$capture_day."','".$capture_mode."','".$data."','".$order_validity."','".$transaction_condition."','".$statement_reference."',
		'".$card_validity."','".$score_value."','".$score_color."','".$score_info."','".$score_threshold."','".$score_profile."','".$codecommande."');");
		
	}

	//fclose ($fp);


?>
