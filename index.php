
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
                            echo "<td>" . $row["price_to_customer"] . "</td>";
                            echo "</tr>";	
                          }  
                          ?>  
                     </table>  
                </div>  
           </div>  
      </body>  
 </html> 
 <script>  
 $(document).ready(function(){  
     var kacang_table = $('#kacang_data').DataTable({
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
               }
          ],
          "fnCreatedRow": function( nRow, aData, iDataIndex ) {
               $(nRow).attr('id', aData['Field1']);
          }
     });   
     
     $('#kacang_data').on( 'click', 'tbody tr td:last-child b', function (e) {
          /*
          e.preventDefault()
          let id = $(this).parent().parent().attr('id')
          let harga = trimRupiahFormat($(this).text())
          harga = harga.substring(0,harga.length-2)
          let input = document.createElement('input');
          input.setAttribute('type', 'text')
          input.setAttribute('onchange', 'check('+id+','+harga+')')
          input.setAttribute('value', harga)
          input.id = "harga_"
          $(this).parent().append(input)
          $(this).remove()
          */
     });

     function trimRupiahFormat(rupiah_format){
          let number_format = rupiah_format.replace("Rp", "").replace(".", "").replace(",","");
          return number_format
     }
     
 });  

function check(id, harga){
     let trobject = $('tr#'+id+" td:last-child input");
     let new_harga = $(trobject).val()


     $.post( 
          "edit_harga.php", 
          { 
               id: id, 
               harga: new_harga 
          },
          function(response) {
               let harga_text = document.createElement('b');
               harga_text.innerHTML = formatMoney(new_harga);
               $(trobject).parent().append(harga_text)
               $(trobject).remove()
          }
     );
}

function formatMoney(amount, decimalCount = 2, decimal = ",", thousands = ".") {
  try {
    decimalCount = Math.abs(decimalCount);
    decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

    const negativeSign = amount < 0 ? "-" : "";

    let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
    let j = (i.length > 3) ? i.length % 3 : 0;

    return "Rp " + negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
  } catch (e) {
    console.log(e) 
  }
};
 </script> 


</body>
</html>