<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>抽選ページ</title>
    <link href="/umi/css/bootstrap.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <h2>みだし</h2>
    <div class="bs-component">
      <table class="table table-striped table-hover ">
        <thead>
          <tr>
            <th>日付</th>
            <th>司会者</th>
            <th>担当者①</th>
            <th>担当者②</th>
          </tr>
        </thead>
        <tbody>
        {foreach from=$tantou key=idx item=val}
          {if $idx is even}
          <tr>
            <td>{$tantou.$idx.3}</td>
            <td>{$tantou.$idx.2}</td>
            <td>{$tantou.$idx.0}</td>
            <td>{$tantou.$idx.1}</td>
          </tr>
          {else}
          <tr class="info">
            <td>{$tantou.$idx.3}</td>
            <td>{$tantou.$idx.2}</td>
            <td>{$tantou.$idx.0}</td>
            <td>{$tantou.$idx.1}</td>
          </tr>
          {/if}
        {/foreach}
        </tbody>
      </table>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- <script src="js/bootstrap.min.js"></script> -->
  </body>
</html>