 <?php
 include("config.php");
	if (!isset($_SESSION['myvtclogin']))
    header("location:connexion.php");
	$user = mysql_fetch_array(mysql_query("select * from myvtc_users where email='" . $_SESSION['myvtclogin'] . "'"));


	$price=$_GET['p'];
	$ref=$_GET['ref'];
	$pp = number_format((int)$price);
	
	
	
	if($pp < 100)
	{
	$tt = str_pad((string)$pp, 4, '0', STR_PAD_RIGHT);
	} 
	
	if($pp > 99 && $pp < 1000)
	{
	$tt = str_pad((string)$pp, 5, '0', STR_PAD_RIGHT);
	}
	
	print ("<HTML><HEAD><TITLE>ReserverUnCab - Paiement Securis&eacute;</TITLE></HEAD>");
	print ("<BODY bgcolor=#ffffff>");
	print ("<Font color=#000000>");
	print ("<center><H1>ReserverUnCab - Paiement Securis&eacute;</H1></center><br><br>");


	//		Affectation des param�tres obligatoires
	$tt=100;
	$parm="merchant_id=081368548400012";
	$parm="$parm merchant_country=fr";
	$parm="$parm amount=$tt";
	$parm="$parm currency_code=978";


	// Initialisation du chemin du fichier pathfile (� modifier)
	    //   ex :
	    //    -> Windows : $parm="$parm pathfile=c:/repertoire/pathfile";
	    //    -> Unix    : $parm="$parm pathfile=/home/repertoire/pathfile";
	    
	$parm="$parm pathfile=./sogenactif/param/pathfile";

	//		Si aucun transaction_id n'est affect�, request en g�n�re
	//		un automatiquement � partir de heure/minutes/secondes
	//		R�f�rez vous au Guide du Programmeur pour
	//		les r�serves �mises sur cette fonctionnalit�
	//
	//		$parm="$parm transaction_id=123456";



	//		Affectation dynamique des autres param�tres
	// 		Les valeurs propos�es ne sont que des exemples
	// 		Les champs et leur utilisation sont expliqu�s dans le Dictionnaire des donn�es
	//
 		$parm="$parm normal_return_url=http://reserveruncab.com/sogenactif/sample/call_response.php?ref=$ref";
		$parm="$parm cancel_return_url=http://reserveruncab.com/sogenactif/sample/call_response.php?ref=$ref";
		$parm="$parm automatic_response_url=http://reserveruncab.com/sogenactif/sample/call_autoresponse.php?ref=$ref";
			$parm="$parm language=fr";
	//		$parm="$parm payment_means=CB,2,VISA,2,MASTERCARD,2";
	//		$parm="$parm header_flag=no";
	//		$parm="$parm capture_day=";
	//		$parm="$parm capture_mode=";
	//		$parm="$parm bgcolor=";
	//		$parm="$parm block_align=";
	//		$parm="$parm block_order=";
	//		$parm="$parm textcolor=";
	//		$parm="$parm receipt_complement=";
	//		$parm="$parm caddie=mon_caddie";
	//		$parm="$parm customer_id=";
	//		$parm="$parm customer_email=";
	//		$parm="$parm customer_ip_address=";
	//		$parm="$parm data=";
	//		$parm="$parm return_context=";
	//		$parm="$parm target=";
	//		$parm="$parm order_id=";


	//		Les valeurs suivantes ne sont utilisables qu'en pr�-production
	//		Elles n�cessitent l'installation de vos fichiers sur le serveur de paiement
	//
	// 		$parm="$parm normal_return_logo=";
	// 		$parm="$parm cancel_return_logo=";
	// 		$parm="$parm submit_logo=";
	// 		$parm="$parm logo_id=";
	// 		$parm="$parm logo_id2=";
	// 		$parm="$parm advert=";
	// 		$parm="$parm background_id=";
	// 		$parm="$parm templatefile=";


	//		insertion de la commande en base de donn�es (optionnel)
	//		A d�velopper en fonction de votre syst�me d'information

	// Initialisation du chemin de l'executable request (� modifier)
	// ex :
	// -> Windows : $path_bin = "c:/repertoire/bin/request";
	// -> Unix    : $path_bin = "/home/repertoire/bin/request";
	//

	$path_bin = "./sogenactif/bin/static/request";


	//	Appel du binaire request
	// La fonction escapeshellcmd() est incompatible avec certaines options avanc�es
  	// comme le paiement en plusieurs fois qui n�cessite  des caract�res sp�ciaux 
  	// dans le param�tre data de la requ�te de paiement.
  	// Dans ce cas particulier, il est pr�f�rable d.ex�cuter la fonction escapeshellcmd()
  	// sur chacun des param�tres que l.on veut passer � l.ex�cutable sauf sur le param�tre data.
	$parm = escapeshellcmd($parm);	
	$result=exec("$path_bin $parm");

	//	sortie de la fonction : $result=!code!error!buffer!
	//	    - code=0	: la fonction g�n�re une page html contenue dans la variable buffer
	//	    - code=-1 	: La fonction retourne un message d'erreur dans la variable error

	//On separe les differents champs et on les met dans une variable tableau

	$tableau = explode ("!", "$result");

	//	r�cup�ration des param�tres

	$code = $tableau[1];
	$error = $tableau[2];
	$message = $tableau[3];

	//  analyse du code retour

  if (( $code == "" ) && ( $error == "" ) )
 	{
  	print ("<BR><CENTER>erreur appel request</CENTER><BR>");
  	print ("executable request non trouve $path_bin");
 	}

	//	Erreur, affiche le message d'erreur

	else if ($code != 0){
		print ("<center><b><h2>Erreur appel API de paiement.</h2></center></b>");
		print ("<br><br><br>");
		print (" message erreur : $error <br>");
	}

	//	OK, affiche le formulaire HTML
	else {
		print ("<br><br>");
		
		# OK, affichage du mode DEBUG si activ�
		print (" $error <br>");
		
		print ("  $message <br>");
	}

print ("</BODY></HTML>");

?>
