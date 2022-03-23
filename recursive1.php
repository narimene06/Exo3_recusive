<P>
<B>DEBUTTTTTT DU PROCESSUS :</B>
<BR>
<?php echo " ", date ("h:i:s"); ?>
</P>
<?php

// Fixer le temps d'execution de ce script et déclarer la variable path par le dossier docs que nous avons à traiter
set_time_limit (500);
$path= "docs";

// déclarer une fonction "explorerDir qui parcours un dossier docs
explorerDir($path);

function explorerDir($path)
{
	// ouvrir le dossier / répértoire docs et récupère un pointeur folder
	$folder = opendir($path);
	
	// vérifier la condition, tant que y a lecture succsessive des entrées du dossier continuer le parcours du script
	while($entree = readdir($folder))
	{		
		//si la variable d'entrée est différente de . et de .. (retirer les . et .. du début de liste du dossier poursuivre les séquences 
		if($entree != "." && $entree != "..")
		{
			// verifier si l'entrée se trouvant dans le docs est un dossier
			if(is_dir($path."/".$entree))
			{
				// déclarer une variable sav_path qui prend le chemin du dossier docs = path
				$sav_path = $path;
				// ce path reçoit le chemin de l'entrée soit le nouveau dossier  
				$path .= "/".$entree;
				// faire appel à la fonction explorerDir si l'entrée est un dossier 			
				explorerDir($path);
				// donc le chemin de nouveau soit changé
				$path = $sav_path;
			}
			else
			{
				// déclarer une nouvelle variable path_source qui prends l'entrée du dossier principale docs.
				$path_source = $path."/".$entree;				
				
				//ouvrir un fichier
				$file = opendir('.');
			//lire tous les fichiers 	
			while ($entree = readdir($file)){
				//convertir les noms des fichiers en minuscule et parcours des chaines de caractères pour recupération des extensions
				$extension = strtolower(strrchr($entree, '.'));
				//verification du type d'extension 
				if($extension == '.png' || $extension == '.jpg'){
					//récuperer le nom du fichier et sa taille 
					$nom_pathSource = 'path_source/' . $entree;
					$taille = getimagesize($entree);
				}
				//Inserer les valeurs d'images dans la base de données
				$requete_sql = "INSERT INTO images_db (taille, paths) VALUES (','" . $taille . "', '" . $nom_pathSource . "')";
				if (mysqli_query($connexion, $requete_sql)) {
					echo ('enregistrement effectué');
				}
				echo ("L'image est téléchargée avec succès. '<br/>'");
				//sinon
			} else {
				echo ("Le téléchargement de l'image à échoué");
			}
		}
		closedir($file);
	}
	closedir($folder);
}
	}
}
?>
<P>
<B>FINNNNNN DU PROCESSUS :</B>
<BR>
<?php echo " ", date ("h:i:s"); ?>
</P>