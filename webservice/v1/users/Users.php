<?php
/* ======================================================================== *
 * @filename:		Users.php												*
 * @topic:			Users 													*
 *																			*
 * @author(s): 		Said KHALID												*
 * @contact(s):		khalidsaid.box@gmail.com								*
 * @remarks:		-														*
 *																			*
 * Date       | Developer      | Changes description						*
 * ------------------------------------------------------------------------ *
 * 15/01/2016 | S.KHALID      | Creation									*
 * ------------------------------------------------------------------------ *
 * JJ/MM/AAAA | ...			   | ...			 							*
 * =========================================================================*/
 
class Users {	

    /**
     * Updates user's password.
     *
     * @url PUT /users/password/update/$id_user/$newpass
     */
    public function updatePassword($id_user = null, $newpass = null) {
		try {
			global $con;
			/* Statement declaration */
			$sql = 	"UPDATE users ".
					"SET password = :newpass ".
					"WHERE id_user = :id_user";
					
			/* Statement values & execution */
			$stmt = $con->prepare($sql);
			$stmt->bindParam(':newpass', $newpass);
			$stmt->bindParam(':id_user', $id_user);
			
			/* Statement execution */
			$stmt->execute();
			
			/* Handle errors */
			if ($stmt->errno)
			  throw new PDOException($stmt->error);
			else
			  return array("success" => "OK");
			
			/* Close statement */
			$stmt->close();
		} catch(PDOException $e) {
			return array("error" => "".$e->getMessage());
		}
    }
	
		   /**
     * Add user.
     * @noAuth
     * @url POST /users/adduser/$prenom/nom/$nom/mdp/$mdp/email/$email/adresse/$adresse/mobilephone/$mobilephone/parrain/$parrain
     */
    public function adduser($prenom=null, $nom=null, $mdp=null, $email=null, $adresse=null, $mobilephone=null, $parrain=null) {
		try {
			global $con;
			/* Statement declaration */
			$sql = 	"INSERT INTO users (prenom, nom, mdp, email, adresse, mobilephone, parrain, dateadd) 
					 VALUES (:prenom, :nom, :mdp, :email, :adresse, :mobilephone, :parrain, NOW());";
			
			
		/* Statement values & execution */
			$stmt = $con->prepare($sql);
			$stmt->bindParam(':prenom', $prenom);
			$stmt->bindParam(':nom', $nom);
			$stmt->bindParam(':mdp', $mdp);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':adresse', $adresse);
			$stmt->bindParam(':mobilephone', $mobilephone);
			$stmt->bindParam(':parrain', $parrain);
			/* Statement execution */
			$stmt->execute();
			
			/* Handle errors */
			if ($stmt->errno)
			  throw new PDOException($stmt->error);
			else
			  return array("success" => "OK");
			
		/* Close statement */
			$stmt->close();
		} catch(PDOException $e) {
			return array("error" => $e->getMessage());
		}
    }
	
		   /**
     * Reservation.
     * @noAuth
     * @url POST /users/reservation/depart/$depart/arrivee/$arrivee/prix/$prix/email/$email/id_user/$id_user
     */
    public function reservation($depart=null, $arrivee=null, $prix=null, $email=null, $id_user=null) {
		try {
			global $con;
			/* Statement declaration */
			$sql = 	"INSERT INTO reservation (depart, arrivee, email, prix, id_user, date) 
					 VALUES (:depart, :arrivee, :email, :prix, :id_user, NOW());";
			
			
		/* Statement values & execution */
			$stmt = $con->prepare($sql);
			$stmt->bindParam(':depart', $depart);
			$stmt->bindParam(':arrivee', $arrivee);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':prix', $prix);
			$stmt->bindParam(':id_user', $id_user);
			/* Statement execution */
			$stmt->execute();
			
			/* Handle errors */
			if ($stmt->errno)
			  throw new PDOException($stmt->error);
			else
			  return array("success" => "OK");
			
		/* Close statement */
			$stmt->close();
		} catch(PDOException $e) {
			return array("error" => $e->getMessage());
		}
    }
	
	 /**
     * Returns price infos.
     *
	 * @noAuth
     * @url GET /users/getPrix
     */
    public function getPrix() {
		try {
			global $con;			
			/* Statement declaration */
			$sql = 	"SELECT * ".
					"FROM prixkm ";
				
					
			/* Statement values & execution */
			$stmt = $con->prepare($sql);
			
			/* Statement execution */
			$stmt->execute();
			
			/* Handle errors */
			if ($stmt->errno)
			  throw new PDOException($stmt->error);
			else
			  return $stmt->fetchAll(PDO::FETCH_OBJ);
			
			/* Close statement */
			$stmt->close();
		} catch(PDOException $e) {
			return array("error" => $e->getMessage());
		}
    }
	
	 /**
     * Returns shop infos.
     *
	 * @noAuth
     * @url GET /users/openOrclose
     */
    public function openOrclose() {
		try {
			global $con;			
			/* Statement declaration */
			$sql = 	"SELECT * ".
					"FROM etat_boutique ";
				
					
			/* Statement values & execution */
			$stmt = $con->prepare($sql);
			
			/* Statement execution */
			$stmt->execute();
			
			/* Handle errors */
			if ($stmt->errno)
			  throw new PDOException($stmt->error);
			else
			  return $stmt->fetchAll(PDO::FETCH_OBJ);
			
			/* Close statement */
			$stmt->close();
		} catch(PDOException $e) {
			return array("error" => $e->getMessage());
		}
    }
	
	 /**
     * Returns price infos.
     *
	 * @noAuth
     * @url GET /users/getPrixDuree
     */
    public function getPrixDuree() {
		try {
			global $con;			
			/* Statement declaration */
			$sql = 	"SELECT * ".
					"FROM prixduree ";
				
					
			/* Statement values & execution */
			$stmt = $con->prepare($sql);
			
			/* Statement execution */
			$stmt->execute();
			
			/* Handle errors */
			if ($stmt->errno)
			  throw new PDOException($stmt->error);
			else
			  return $stmt->fetchAll(PDO::FETCH_OBJ);
			
			/* Close statement */
			$stmt->close();
		} catch(PDOException $e) {
			return array("error" => $e->getMessage());
		}
    }
	
	 /**
     * Returns price infos.
     *
	 * @noAuth
     * @url GET /users/getCodepromo
     */
    public function getCodepromo() {
		try {
			global $con;			
			/* Statement declaration */
			$sql = 	"SELECT * 
					FROM codepromo 
					WHERE datefin > CURDATE() ";
				
					
			/* Statement values & execution */
			$stmt = $con->prepare($sql);
			
			/* Statement execution */
			$stmt->execute();
			
			/* Handle errors */
			if ($stmt->errno)
			  throw new PDOException($stmt->error);
			else
			  return $stmt->fetchAll(PDO::FETCH_OBJ);
			
			/* Close statement */
			$stmt->close();
		} catch(PDOException $e) {
			return array("error" => $e->getMessage());
		}
    }
	
	 
	
    /**
     * Returns user infos (email, name, ...).
     *
	 * @noAuth
     * @url GET /users/$id_user
     */
    public function getUser($id_user = null) {
		try {
			global $con;			
			/* Statement declaration */
			$sql = 	"SELECT * ".
					"FROM users ".
					"WHERE id_user = :id_user";
					
			/* Statement values & execution */
			$stmt = $con->prepare($sql);
			$stmt->bindParam(':id_user', $id_user);
			
			/* Statement execution */
			$stmt->execute();
			
			/* Handle errors */
			if ($stmt->errno)
			  throw new PDOException($stmt->error);
			else
			  return $stmt->fetchAll(PDO::FETCH_OBJ);
			
			/* Close statement */
			$stmt->close();
		} catch(PDOException $e) {
			return array("error" => $e->getMessage());
		}
    }
	
	
	/**
     * Used to PUT;DELETE requests.
     *
	 * @url OPTIONS /users/$id_user/profilepicture/$image
	 * @url OPTIONS /users/password/update/$id_user/$newpass
     */
    public function optionsUnusedMethods($id = null, $data) { return ""; }

}
?>