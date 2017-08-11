<table>
	<caption>Таблица со списком файлов</caption>
    <tr>
        <th>Название файла/папки</th>
        <th>Размер, байты</th>
        <th>Тип</th>
    	<th>Дата последней модификации</th>
    </tr>
<?foreach($rows as $key=>$value) {?>
    <tr>
	    <td style="text-align: left;"><?=$value['name'];?></td>
	    <td><?=$value['size'];?></td>
	    <td><?=$value['extension'];?></td>
	    <td><?=$value['modified'];?></td>
    </tr>
 <?}?>
 </table>
