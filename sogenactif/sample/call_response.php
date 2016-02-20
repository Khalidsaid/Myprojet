<!--
-------------------------------------------------------------
 Topic		: Exemple PHP traitement de la r�ponse de paiement
 Version 	: P615

	Dans cet exemple, les donn�es de la transaction	sont
	d�crypt�es et affich�es sur le navigateur de l'internaute.

-------------------------------------------------------------
-->


<!--	Affichage du header html -->

<?php

	print ("<HTML><HEAD><TITLE>SOGENACTIF - Paiement Securise sur Internet</TITLE></HEAD>");
	print ("<BODY bgcolor=#ffffff>");
	print ("<Font color=#000000>");
	print ("<center><H1>Test de l'API plug-in SOGENACTIF</H1></center><br><br>");

	// R�cup�ration de la variable crypt�e DATA
	$message="message=$HTTP_POST_VARS[DATA]";
	
	// Initialisation du chemin du fichier pathfile (� modifier)
    //   ex :
    //    -> Windows : $pathfile="pathfile=c:/repertoire/pathfile";
    //    -> Unix    : $pathfile="pathfile=/home/repertoire/pathfile";
   
   $pathfile="pathfile=../param/pathfile";

	// Initialisation du chemin de l'executable response (� modifier)
	// ex :
	// -> Windows : $path_bin = "c:/repertoire/bin/response";
	// -> Unix    : $path_bin = "/home/repertoire/bin/response";
	//

	$path_bin = "../bin/static/response";

	// Appel du binaire response
  	$message = escapeshellcmd($message);
	$result=exec("$path_bin $pathfile $message");


	//	Sortie de la fonction : !code!error!v1!v2!v3!...!v29
	//		- code=0	: la fonction retourne les donn�es de la transaction dans les variables v1, v2, ...
	//				: Ces variables sont d�crites dans le GUIDE DU PROGRAMMEUR
	//		- code=-1 	: La fonction retourne un message d'erreur dans la variable error


	//	on separe les differents champs et on les met dans une variable tableau

	$tableau = explode ("!", $result);

	//	R�cup�ration des donn�es de la r�ponse

	$code = $tableau[1];
	$error = $tableau[2];



	//  analyse du code retour

  if (( $code == "" ) && ( $error == "" ) )
 	{
  	print ("<BR><CENTER>erreur appel response</CENTER><BR>");
  	print ("executable response non trouve $path_bin");
 	}

	//	Erreur, affiche le message d'erreur

	else if ( $code != 0 ){
		print ("<center><b><h2>Erreur appel API de paiement.</h2></center></b>");
		print ("<br><br><br>");
		print (" message erreur : $error <br>");
	}

	// OK, affichage des champs de la r�ponse
	else {
		
	# OK, affichage du mode DEBUG si activ�
	print (" $error <br>");
		
	
	print("<br><br><hr></b></h4>");
	}

	print ("</body></html>");


?>
