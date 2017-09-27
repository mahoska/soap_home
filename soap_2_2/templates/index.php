<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Football teams</title>
        <link rel="stylesheet" href="css/bootstrap.min.css"/>
    </head>
    <body>
        <div class="container">
            <div style='margin: 50px 0'>
                <?php if(!empty($teams)):?>
                <h2>Information about football teams</h2>
                <table class="table table-striped">
                    <tr>
                        <th>Name</th>
                        <th>CountryFlag(icon)</th>
                        <th>WikipediaURL</th>
                        <th>CountryFlag</th>
                    </tr>
                     <?php foreach($teams as $team):?>
                        <tr>
                            <td><?=$team->sName?> </td>
                            <td><img src="<?=$team->sCountryFlag?>" alt='flag' class='img-responsive'/> </td>
                            <td><a href="<?=$team->sWikipediaURL?>"><?=$team->sWikipediaURL?></a></td>
                            <td><img src="<?=$team->sCountryFlagLarge?>" alt='flag' class='img-responsive' /></td>
                        </tr>
                    <?php endforeach;?>
                </table>
                <?php endif;?>
                <p  class="bg-danger"><?= isset($error)?$error: "" ?></p>
            </div>
        </div>
    </body>
</html>
