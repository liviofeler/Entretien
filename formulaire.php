<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <!--librairie fontawesome-->

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />
        <link rel="stylesheet" href="./style.css" />
        <script src="./index.js" defer></script>
        <title> Formulaire d'avis client </title>
    </head>
    <body>
      <div class="rating-box">
        <img src="stars.png" class="star">
          <h1> Formulaire d'avis </h1>
          <form class="formulaire" method="POST" action="" enctype="multipart/form-data">

              <p>
                  <label for="mail">Adresse mail :</label><br/>
                  <input type="email" placeholder="Email" name="email" id="mail"/>
              </p>

                <p>
                  <label for="pseudo">Pseudo :</label><br/>
                  <input type="text" placeholder="Pseudo" name="pseudo" id="pseudo" />
                </p>

                <p>
                  <label for="commentaire">Commentaire :</label><br/>
                  <textarea name="commentaire" id="commentaire"  placeholder="Commentaire" rows="6" cols="30"></textarea>
                </p>
                <!--Etoile-->
                <p>
                  <label> Avis : </label>
                  <span class="fas fa-star" data-star="1"></span>
                  <span class="fa fa-star" data-star="2"></span>
                  <span class="fas fa-star" data-star="3"></span>
                  <span class="fas fa-star" data-star="4"></span>
                  <span class="fas fa-star" data-star="5"></span>

                </p>
                <label for="fileUpload">Fichier:</label>
                <input type="file" name="fichier" id="fileUpload">

                <input type="submit" name="envoyer" value="Envoyer l'avis!"/>
          </form>
      </div>
      <div class="comment-box">
        <h2> Commentaires</h2>
        <?php
        try
        {
          $bdd = new PDO('mysql:host=localhost;dbname=formulaire;charset=utf8', 'root', 'root');
        }
        catch (Exception $e)
        {
                die('Erreur : ' . $e->getMessage());
        }
        // récupération des avis précédent
        $requeteSelectAvis = $bdd -> query("SELECT * From utilisateur ORDER BY date_avis ");

        while ($donnees = $requeteSelectAvis->fetch())
        {
          echo $donnees['date_avis']." : <strong> ".$donnees['mail']."</strong> (".$donnees['pseudo'].") "."<br/>";
          echo "<em>".$donnees['commentaire']."</em><br/>";

        }
        $requeteSelectAvis->closeCursor();
        ?>
      </div>
      <?php
      //Traitement de l'upload
      $lien_photo="";
      if(isset($_POST['envoyer']))
      {
        $repertoire_upload = 'fichiers_upload/';
        $fichier_temporaire = $_FILES['fichier']['tmp_name'];
        //echo $fichier_temporaire;
        if( !is_uploaded_file($fichier_temporaire) )
          {
              exit("Le fichier est introuvable");
          }
          // on vérifie maintenant l'extension
          $type_file = $_FILES['fichier']['type'];

          if( !strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'png') && !strstr($type_file, 'gif') )
          {
              exit("Le fichier n'est pas une image");
          }
          // on copie le fichier dans le dossier de destination
          $nom_fichier = $_FILES['fichier']['name'];

          if( !move_uploaded_file($fichier_temporaire, $repertoire_upload . $nom_fichier) )
          {
            exit("Impossible de copier le fichier dans $repertoire_upload");
          }
          $lien_photo = $repertoire_upload . $nom_fichier;
            echo "Le fichier a bien été uploadé";
            //Insertion du lien dans la base
      }

      //Insertion des données en base de données
        if(isset($_POST['email']) AND isset($_POST['pseudo']) AND isset ($_POST['commentaire']))
        {
          $reqInsertInto = $bdd->prepare('INSERT INTO utilisateur (mail, pseudo, commentaire,date_avis,lien_photo) VALUES(:mail, :pseudo, :commentaire, :date_avis, :lien_photo)');
          $dateTimeNow = date('Y-m-d h:i:s');
          $reqInsertInto->execute(array(
	        'mail' => $_POST['email'],
	        'pseudo' => $_POST['pseudo'],
	        'commentaire' => $_POST['commentaire'],
	        'date_avis' => $dateTimeNow,
          'lien_photo'=>$lien_photo
	         ));

        }
       ?>

    </body>
</html>
