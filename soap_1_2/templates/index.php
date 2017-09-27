<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>ValuteCursOnDate</title>
        <link rel="stylesheet" href="css/bootstrap.min.css"/>
    </head>
    <body>
        <div class="container">
            <div class="col-md-6">
                <form method='POST' action='index.php' style="margin: 50px 0;">
                    <div class="form-group">
                        <label for="date_input">Enter the date:</label>
                        <input type='text' name='data' id="dateInput" class="form-control" placeholder="yyyy-mm-dd"/>
                    </div>
                    <button type='submit'  class="btn btn-primary">Search</button>
                </form>
            </div>
            <br>
            <div class="col-md-6"></div>
            <div class="col-md-12">
            <?php if(!empty($valutes)):?>
            <h2>Information on exchange rates for <?=$search?></h2>
            <table class="table table-striped">
                <tr>
                    <th>Currency name</th>
                    <th>Nominal</th>
                    <th>Course(RUB)</th>
                    <th>ISO Digital currency code</th>
                    <th>ISO Symbolic code of currency</th>
                </tr>
                 <?php foreach($valutes as $valute):?>
                    <tr>
                        <td><?=$valute->Vname?> </td>
                        <td><?=$valute->Vnom?> </td>
                        <td><?=$valute->Vcurs?></td>
                        <td><?=$valute->Vcode?></td>
                        <td><?=$valute->VchCode?></td>
                    </tr>
                <?php endforeach;?>
            </table>
            <?php endif;?>
            <p  class="bg-danger"><?= isset($error)?$error: "" ?></p>
            </div>
        </div>
    </body>
</html>
