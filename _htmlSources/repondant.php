<?php
?>
<h2>titre de l'enquéte</h2>
<h3>Description :</h3>
<p><?php echo'text text text text text text text text text text text text <br>
text text text text text text text text text text text text text <br>
text text text text text text text text text text text text text  <br>
text text text text text text text text text text text text <br>
text text text text text text text text text text text text text <br>
text text text text text text text text text text text text text.  <br>'
?></p>
<div>
<form action="" method="post">
    Question < :(Type Texte)<br>
        <textarea name="question1" value=""></textarea><br>
    Question 2 :(Type Nombre)<br>
        <input type="number" name="Question2" value=""/><br>
    Question 3 :(Type QCM)nb>=5<br>
        <select name="choix">
            <option>choix1</option>
            <option>choix2</option>
            <option>choix3</option>
            <option>choix4</option>
            <option>choix5</option>
            <option>choix6</option>
        </select><br>
    Question 3 :(Type QCM)nb<5<br>
            <input type="checkbox" name="proposition1" value="Proposition1"/>Proposition1
            <input type="checkbox" name="proposition2" value="Proposition2"/>Proposition2
            <input type="checkbox" name="proposition3" value="Proposition3"/>Proposition3<br>
            <input type="submit" value="Envoyer vos réponses " name="envoyer" /> 
</form> 
</div>