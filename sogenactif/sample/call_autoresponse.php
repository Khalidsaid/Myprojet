<!--
-------------------------------------------------------------
 Topic	 : Exemple PHP traitement de l'autoréponse de paiement
 Version : P615

 		Dans cet exemple, les données de la transaction	sont
		décryptées et sauvegardées dans un fichier log.

-------------------------------------------------------------
-->

<?php
	include("../../config.php");
	require '../../phpmailer/class.phpmailer.php';
	
	$ref = $_GET['ref'];
	$ll = mysql_query("select myvtc_users.type_user, myvtc_users.id, myvtc_users.prenom, myvtc_users.nom, myvtc_users.email as email, myvtc_users.tel, reservation_attente.depart,reservation_attente.arrivee,reservation_attente.id,DATE_FORMAT(reservation_attente.dtdeb, '%d/%m/%Y') as dtdeb,reservation_attente.codecommande,reservation_attente.prix,reservation_attente.heure from myvtc_users inner join reservation_attente on reservation_attente.id_user = myvtc_users.id where  reservation_attente.codecommande='". $ref ."' order by reservation_attente.id desc limit 1")or die(mysql_error());
	
	$commande = mysql_fetch_array($ll);
	
	
	// Récupération de la variable cryptée DATA
	$message="message=$_POST[DATA]";

	// Initialisation du chemin du fichier pathfile (à modifier)
	    //   ex :
	    //    -> Windows : $pathfile="pathfile=c:/repertoire/pathfile"
	    //    -> Unix    : $pathfile="pathfile=/home/repertoire/pathfile"
	    
	$pathfile="pathfile=/home/reserverrz/www/sogenactif/param/pathfile";

	//Initialisation du chemin de l'executable response (à modifier)
	//ex :
	//-> Windows : $path_bin = "c:/repertoire/bin/response"
	//-> Unix    : $path_bin = "/home/repertoire/bin/response"
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
		

		
		$mail2->Host = 'SSL0.OVH.NET';                 // Specify main and backup server
		$mail2->Port = 465; 

		$mail2 = new PHPMailer;

		$mail2->IsHTML(true); 
		$mail2->CharSet = 'UTF-8';  
		$mail2->Host = 'smtp.gmail.com';                 // Specify main and backup server
		$mail2->Port = 26;                                    // Set the SMTP port
		$mail2->SMTPAuth = true;                               // Enable SMTP authentication
		$mail2->Username = 'contact@reserveruncab.com';                // SMTP username
		$mail2->Password = 'Balloo94';      
		$adresse_destinataire = 'contact@reserveruncab.com';						   
		$mail2->From = 'contact@reserveruncab.com';
		$mail2->FromName = 'ReserverUnCab';
		$mail2->AddAddress($adresse_destinataire, $adresse_destinataire); // Add address


		$mail2->Subject = 'Notification de reservation ReserverUnCab.com';
		$mail2->Body    = "Salam Alaykoum,<br><br>

		Cher Chauffeur, Une reservation sur le site ReserverUnCab.com a &eacute;t&eacute; effectu&eacute; avec succ&egrave;s !<br><br>
		
		Type: " . $commande["type_user"] . " <br><br>
		Client : " . $commande["prenom"] . "<br><br>
		Tel : " . $commande["tel"] . " <br><br>
		Date : " . $commande['dtdeb'] ." à ".$commande['heure']. "<br><br>
		D&eacute;part : " . $commande['depart'] . "<br><br>
		Arriv&eacute;e : " . $commande['arrivee'] . "<br><br>
		Prix : " . $commande['prix'] . "€<br><br>
	

		L'&eacute;quipe ReserverUnCab.com.";


	   // Pour finir, on envoi l'e-mail
	   $mail2->send();  
   
   
   
   
   $chaine = utf8_encode('<table border="0" style="width:100%">
            <tr>
                <td colspan="2" style="margin-right: 50px;"><img src="http://www.reserveruncab.com/images/logo.png" alt="" /></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center"><h2>Facture N&deg; ' . $commande['codecommande'] . '</h2></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: left"><br><br><br><br>Bonjour ' . $commande["prenom"] . ',<br><br>Ci-dessous, vous trouvez le d&eacute;tail de votre commande : <br><br><br></td>
            </tr>
             <tr>
                 <td colspan="2" >
                     <table border="1" style="width:600px">
                         <tr>
                             <td style="height:25px; width:200px">D&eacute;part</td>
                             <td> ' . $commande['depart'] . '</td>
                         </tr>
                         <tr style="height:35px">
                             <td style="height:25px">Arriv&eacute;e</td>
                             <td> ' . $commande['arrivee'] . '</td>
                         </tr>
                         <tr style="height:35px">
                             <td style="height:25px">Date</td>
                             <td> ' . $commande['dtdeb']  . '</td>
                         </tr>
                         <tr style="height:35px">
                             <td style="height:25px">Heure</td>
                             <td> ' . $commande['heure'] . '</td>
                         </tr>
                         <tr style="height:35px">
                             <td style="height:25px">Prix TTC</td>
                             <td> ' . $commande['prix'] . ' euros</td>
                         </tr>
                     </table>
                 </td>
               
            </tr>
            <tr>
                <td colspan="2" style="margin-right: 50px; padding-top:200px">L\'&eacute;quipe ReserverUnCab.com</td>
            </tr>
        </table>');

   

    require_once('../../html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('P','A4','fr');
    $html2pdf->WriteHTML($chaine);
    $content_PDF = $html2pdf->Output('', true);
	file_put_contents('Facture_' . $commande["codecommande"] . '.pdf', $content_PDF);
   
    $mail->Host = 'SSL0.OVH.NET';                 // Specify main and backup server
	$mail->Port = 465; 

	$mail = new PHPMailer;

	$mail->IsHTML(true); 
	$mail->CharSet = 'UTF-8';  
	$mail->Host = 'smtp.gmail.com';                 // Specify main and backup server
	$mail->Port = 26;                                    // Set the SMTP port
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'contact@reserveruncab.com';                // SMTP username
	$mail->Password = 'Balloo94';                  // SMTP password
                           // Enable encryption, 'ssl' also accepted

	$adresse_destinataire = 'khalidsaid.box@gmail.com';						   
	$mail->From = 'contact@reserveruncab.com';
	$mail->FromName = 'ReserverUnCab';
	$mail->AddAddress($commande['email'], $commande['email']); // Add address


	$mail->Subject = 'Validation de paiement ReserverUnCab.com';
	$mail->Body    = "Bonjour " . $commande["prenom"] . ",<br><br>

	F&eacute;cilitation ! Votre paiement sur le site ReserverUnCab.com a &eacute;t&eacute; effectu&eacute; avec succ&egrave;s.<br><br>

	Voici le d&eacute;tail de votre commande :<br><br>
	Date : " . $commande['dtdeb'] ." à ".$commande['heure']. "<br><br>
	D&eacute;part : " . $commande['depart'] . "<br><br>
	Arriv&eacute;e : " . $commande['arrivee'] . "<br><br>
	Prix : " . $commande['prix'] . "€<br><br>

	L'&eacute;quipe ReserverUnCab.com.";


	$mail->AddAttachment("Facture_" . $commande['codecommande'] . ".pdf");  
   // Pour finir, on envoi l'e-mail
   $mail->send();
		
	}

	//fclose ($fp);


?>
