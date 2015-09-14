<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AW 常駐者定例担当表</title>
    <link href="/umi/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <h2>AW 常駐者定例担当表</h2>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  </body>
</html>