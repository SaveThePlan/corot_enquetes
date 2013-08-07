<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>


<h3>Suppression des résultats de l'enquête <?php echo 'titre'?></h3> 

<p>Voulez vous supprimer les données concernant l'enquête <?php echo 'titre'?> ?</p>


<form method="POST">
<input type="radio" name="suppresion" value="oui"/>oui
<input type="radio" name="suppresion" value="non"/>non</br>
<input type="submit" name="valider" value="valider"/>

</form>
