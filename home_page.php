<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Список файлов</title>
    <style>
        table {
            font-family: arial, sans-serif;
            font-size: 14px;
            border-collapse: collapse;
            width: 100%;
        }
        td,
        th {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }
        tr:nth-child(even) {
            background-color: #dddddd;
        }
        caption {
          margin: 10px auto;
          font-size: 16px;
        }
        .hide {
          display: none;
        }
    </style>
</head>

<body>
    <div data-attr="table-data"><?php include_once('partial.php');?></div>
    <div style="margin-top: 10px;">
      <a href='#' data-attr="update-data">Обновить данные</a>
      <span data-attr="wait" class="hide">Обновление данных...</span>
    </div>


    <script>
      var elHref = document.querySelector('[data-attr="update-data"]'),
          elSpan = document.querySelector('[data-attr="wait"]');

      elHref.addEventListener('click', function(e) {
        e.preventDefault();

        elHref.classList.add('hide');
        elSpan.classList.remove('hide');

        var xhr = new XMLHttpRequest();
        xhr.open("POST", '/', true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function() {
            if(xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
              elHref.classList.remove('hide');
              elSpan.classList.add('hide');

              var elDivTable = document.querySelector('[data-attr="table-data"]');
              elDivTable.innerHTML = xhr.responseText;
            }
        }
        xhr.send("updateData=true"); 
      });
    </script>
</body>
</html>