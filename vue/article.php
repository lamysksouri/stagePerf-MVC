<?php
include 'entete.php';

if (!empty($_GET['id'])) {
    $article = getArticle($_GET['id']);
}

?>

<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form action="<?= !empty($_GET['id']) ? "../model/modifArticle.php" : "../model/ajoutArticle.php" ?>"  method="post">
                <label for="nom_article">Nom de l'article</label>
                <input value="<?= !empty($_GET['id']) ? $article['nom_article'] : "" ?>" type="text" name="nom_article" id="nom_article" placeholder="Veuillez saisir le nom">
                <input value="<?= !empty($_GET['id']) ? $article['id'] : "" ?>" type="hidden" name="id" id="id">


                <label for="id_categorie">Catégorie</label>
                <select name="id_categorie" id="id_categorie">
                    <option disabled selected>Sélectionnez une catégorie</option> <!-- Option désactivée et sélectionnée par défaut -->
                <?php
                    $categories = getCategorie();
                    if (!empty($categories) && is_array($categories)) {
                    foreach ($categories as $key => $value) {
                    ?>
                    <option <?= !empty($_GET['id']) && $article['id_categorie'] == $value['id'] ? "selected" : "" ?> value="<?= $value['id'] ?>"> <?= $value['libelle_categorie'] ?> </option>
                    <?php
                    }
                    }
                    ?>
                </select>


                <label for="quantite">Quantité</label>
                <input value="<?= !empty($_GET['id']) ? $article['quantite'] : "" ?>" type="number" name="quantite" id="quantite" placeholder="Veuillez saisir la quantité">

                <label for="prix_unitaire">Prix unitaire</label>
                <input value="<?= !empty($_GET['id']) ? $article['prix_unitaire'] : "" ?>" type="number" name="prix_unitaire" id="prix_unitaire" placeholder="Veuillez saisir le prix">

                <label for="date_fabrication">Date de fabrication</label>
                <input value="<?= !empty($_GET['id']) ? $article['date_fabrication'] : "" ?>" type="datetime-local" name="date_fabrication" id="date_fabrication">

                <button type="submit">Valider</button>

                <?php
                if (!empty($_SESSION['message']['text'])) {
                ?>
                    <div class="alert <?= $_SESSION['message']['type'] ?>">
                        <?= $_SESSION['message']['text'] ?>
                    </div>
                <?php    
                }
                ?>
            </form>
        </div>


        <div style="display :block;" class="box">

            <form action="" method="get">

            <table class="mtable">
                <tr>
                    <th>Nom article</th>
                    <th>Catégorie</th>
                    <th>Quantité</th>
                    <th>Prix unitaire</th>
                    <th>Date fabrication</th>
                </tr>
                    <td>
                        <input type="text" name="nom_article" id="nom_article" placeholder="Veuillez saisir le nom">
                    </td>

                    <td>
                    <select name="id_categorie" id="id_categorie">
                    <option disabled selected>Sélectionnez une catégorie</option> <!-- Option désactivée et sélectionnée par défaut -->

                    <?php
                    $categories = getCategorie();
                    
                    if (!empty($categories) && is_array($categories)) {
                        foreach ($categories as $key => $value) {
                    ?>

                        <option <?= !empty($_GET['id']) && $article['id_categorie'] == $value['id'] ? "selected" : "" ?> value="<?= $value['id'] ?>"> <?= $value['libelle_categorie'] ?> </option>

                    <?php
                        }
                    }
                    ?> 
                    </select>
                    </td>

                    <td>
                        <input type="number" name="quantite" id="quantite" placeholder="Veuillez saisir la quantité">
                    </td>

                    <td>
                        <input type="number" name="prix_unitaire" id="prix_unitaire" placeholder="Veuillez saisir le prix">
                    </td>

                    <td>
                        <input type="date" name="date_fabrication" id="date_fabrication">
                    </td>



                <tr>

                </tr>
            </table>
            <br>
            <button type="submit">Chercher</button>

            </form>
            <br>

            <table class="mtable">
                <tr>
                    <th>Nom article</th>
                    <th>Catégorie</th>
                    <th>Quantité</th>
                    <th>Prix unitaire</th>
                    <th>Date fabrication</th>
                    <th>Action</th>
                </tr>
                <?php
                if (!empty($_GET)) {
                    $articles = getArticle(null, $_GET);
                } else {
                    $articles = getArticle();
                }

                    if(!empty($articles) && is_array($articles)){
                        foreach ($articles as $key => $value) {
                        ?>
                        <tr>
                            <td><?= $value['nom_article'] ?></td>
                            <td><?= $value['libelle_categorie'] ?></td>
                            <td><?= $value['quantite'] ?></td>
                            <td><?= $value['prix_unitaire'] ?></td>
                            <td><?= date('d/m/y h:i:s', strtotime($value['date_fabrication'])) ?></td>
                            <td><a href="?id=<?= $value['id'] ?>"><i class='bx bx-edit-alt'></i></a></td>
                            <td><a href="../model/supparticle.php?id=<?= $value['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article?')"><i class='bx bx-trash'></i></a></td>
                        </tr>
                        <?php
                        }
                    }
                    else{
                        echo "<tr><td colspan='7' style='text-align:center'>Aucun article trouvé</td></tr>";
                    }
                ?>
            </table>
        </div>
    </div>
</div>
</section>

<?php
include 'pied.php';
?>