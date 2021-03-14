
<?php  
 //DEV
 $connect = mysqli_connect("178.128.208.156", "rizkyaddon", "Jakarta123!", "mede_mama"); 
 
 //PROD
 //$connect = mysqli_connect("localhost", "root", "Jakarta123!", "saham");  

 $query ="SELECT * FROM product";  
 $result = mysqli_query($connect, $query);  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Mede Mama - Product List</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
           <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
           <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />  
      </head>  
      <body>  
           <br /><br />  
           <div class="container">  
                <h3 align="center"><img src="images/cemalcemil.jpeg" width="150px"/>Daftar Harga Mamamede</h3>  
                <br />  
                <div class="table-responsive">  
                     <table id="kacang_data" class="table table-striped table-bordered">  
                          <thead>  
                               <tr>  
                                    <td>no</td>  
                                    <td>kode produk</td>  
                                    <td>produk</td>  
                                    <td>gambar</td>
                                    <td>harga</td>  
                               </tr>  
                          </thead>  

                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["product_code"] . "</td>";
                            echo "<td>" . $row["product_name"] . "</td>";
                            echo "<td width='20%'>" . $row["product_code"] . "</td>";
                            echo "<td>" . $row["price"] . "</td>";
                            echo "</tr>";	
                          }  
                          ?>  
                     </table>  
                </div>  
           </div>  
      </body>  
 </html> 

<?php
     function beautify_numeric($numeric){
          $digit = strlen((string)abs(intval($numeric)));
          $one_million = 1000000;
          $one_billion = 1000000000;
          $one_trillion = 1000000000000;
          $result = intval($numeric);
          //length > 7 && length <= 9 ----> M
          if( $digit > 7 && $digit <= 9){
               $raw_result = round($numeric / $one_million, 2);
               $result = $raw_result . " M";
          }
          
          //length > 9 && length <= 12 ----> B
          if( $digit > 9 && $digit <= 12){
               $raw_result = round($numeric / $one_billion, 2);
               $result = $raw_result . " B";
          }

          //length > 12 && length <= 15 ----> T
          if( $digit > 12 && $digit <= 15){
               $raw_result = round($numeric / $one_trillion, 2);
               $result = $raw_result . " T";
          }

          return $result;
     }
?>
 <script>  
 $(document).ready(function(){  
    $('#kacang_data').DataTable({
          paging: true,
          "order": [[ 0, "asc" ]],
          columns : [
              {
                  data: "Field1",
                  
              },
              {
                  data: "Field2",
                  
              },
              {
                  data: "Field3",
                  
              },
              {
                  data: "Field35",
                  render: function (data) {
                      return '<img src="images/mede.jpeg" width="100px" />';
                  }
                  
              },
              {
                  data: "Field4",
                  render: function (data, type, row, meta) {
                      if(type === 'display'){
                         var abbr = "Rp"             
                         var num = $.fn.dataTable.render.number('.', ',', 2).display(data);              
                         return "<b>" + abbr  + ' ' + num + "</br>";           
                      } else {           
                         return data;
                      }
                  },
              },
          ]
    });  
 });  
 </script> 


</body>
</html>