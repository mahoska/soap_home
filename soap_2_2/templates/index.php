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
                            <td>
                                <?=$team->msName?> 
                            </td>
                            <td>
                                <img src="<?=$team->msCountryFlag?>" 
                                     alt='flag' class='img-responsive'/>
                            </td>
                            <td>
                                <a href="<?=$team->msWikipediaURL?>">
                                    <?=$team->msWikipediaURL?>
                                </a>
                            </td>
                            <td>
                                <img src="<?=$team->msCountryFlagLarge?>"
                                     alt='flag' class='img-responsive' />
                            </td>
                        </tr>
                    <?php endforeach;?>
                </table>
                <?php endif;?>
                <p  class="bg-danger"><?= isset($error)?$error: "" ?></p>
            </div>
        </div>
    </body>
</html>
