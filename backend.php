<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
  <style>
    hr { height:5px;border-top:4px solid #000;}  
    .clr:after {content: " ";display: block;height: 0;clear: both;}
    .title button {float:right;margin:10px;}
    .title h1 {float:left;}
    td:last-child{padding-left:0;}
    h1 {padding:0;margin:0;}
    @media (min-width: 1200px){
        .container {
            width: 1280px;
            max-width: 100%;
        }
    }

  </style>
  <script language="JavaScript" type="text/javascript">
    //导出execl
        var idTmr;
        function  getExplorer() {  
          var explorer = window.navigator.userAgent ;  
          //ie  
          if (explorer.indexOf("MSIE") >= 0) {  
              return 'ie';  
          }  
          //firefox  
          else if (explorer.indexOf("Firefox") >= 0) {  
              return 'Firefox';  
          }  
          //Chrome  
          else if(explorer.indexOf("Chrome") >= 0){  
              return 'Chrome';  
          }  
          //Opera  
          else if(explorer.indexOf("Opera") >= 0){  
              return 'Opera';  
          }  
          //Safari  
          else if(explorer.indexOf("Safari") >= 0){  
              return 'Safari';  
          }  
      }
      function method5(tableid){
        if(getExplorer() == 'ie'){
                var curTbl = document.getElementById(tableid);  
                var oXL = new ActiveXObject("Excel.Application");  
                var oWB = oXL.Workbooks.Add();  
                var xlsheet = oWB.Worksheets(1);  
                var sel = document.body.createTextRange();  
                sel.moveToElementText(curTbl);  
                sel.select();  
                sel.execCommand("Copy");  
                xlsheet.Paste();  
                oXL.Visible = true;  
  
                try {  
                    var fname = oXL.Application.GetSaveAsFilename("Excel.xls", "Excel Spreadsheets (*.xls), *.xls");  
                } catch (e) {  
                    print("Nested catch caught " + e);  
                } finally {  
                    oWB.SaveAs(fname);  
                    oWB.Close(savechanges = false);  
                    oXL.Quit();  
                    oXL = null;  
                    idTmr = window.setInterval("Cleanup();", 1);  
                }  
        }
        else 
        {
          tableToExecl(tableid);
        }
      } 
      function Cleanup() {
        window.clearInterval(idTmr);
        CollectGarbage();
      } 
      var tableToExecl = (function(){
          var uri = 'data:application/vnd.ms-excel;base64,',  
                      template = '<html><head><meta charset="UTF-8"></head><body><table>{table}</table></body></html>',  
                      base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) },  
                      format = function(s, c) {  
                          return s.replace(/{(\w+)}/g,  
                                  function(m, p) { return c[p]; }) }  
              return function(table, name) {  
                  if (!table.nodeType) table = document.getElementById(table)  
                  var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}  
                  window.location.href = uri + base64(format(template, ctx))  
              }  
      })()
  </script>
</head>
<body>
  

<?php 
    $con = mysql_connect('localhost','root','8876');
    if (!$con)
    {
      die('Could not connect: ' . mysql_error());
    }
    mysql_select_db('mail');
    mysql_query("set names utf8");    
    $sqlselect = "select * from information order by id";
    $result = mysql_query($sqlselect);

?>

<div class="container">
    <br>
    <div class="title clr">
      <h1>定制需求信息</h1>
      <button type="button" class="btn btn-success" onclick="method5('tableExcel')">导出execl</button>
    </div>
    <hr>
    <table id="tableExcel" class="table clr">
      <tr>
            <!--<th>ID</th>-->
            <th>姓名</th>
            <th>电话</th>
            <th>邮箱</th>
            <th>所属行业</th>
            <th>公司名称</th>
            <th>开发需求描述</th>
            <th>开发案例参考</th>
            <th>期望完成时间</th>
            <th>期望完成预算</th>

            <th>操作</th>
      </tr>
    <?php
    
    while ($row = mysql_fetch_assoc($result)) {
        echo "<tr>";  
        //打印出$row这一行  
?>
        <td><?php echo $row['name'] ?></td>
        <td><?php echo $row['phone'] ?></td>
        <td><?php echo $row['email'] ?></td>
        <td><?php echo $row['company_type'] ?></td>
        <td><?php echo $row['company_name'] ?></td>
        <td><?php echo $row['company_info'] ?></td>
        <td><?php echo $row['dev_example'] ?></td>
        <td><?php echo $row['deadline'] ?></td>
        <td><?php echo $row['money'] ?></td> 
        <td><a class="btn btn-danger" href="delete.php?id=<?php echo $row['id'] ?>" role="button">删除</a></td>  
        <?php
        echo "</tr>";  
    } ?>
  
  </table>
</div>


</body>
</html>

