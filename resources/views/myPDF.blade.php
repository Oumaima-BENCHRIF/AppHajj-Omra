<!DOCTYPE html>
<html>
<head>
    <title>Larave Generate Invoice PDF - Nicesnippest.com</title>
</head>
<style type="text/css">
    body{
        font-family: 'Roboto Condensed', sans-serif;
    }
    .m-0{
        margin: 0px;
    }
    .p-0{
        padding: 0px;
    }
    .pt-5{
        padding-top:5px;
    }
    .mt-10{
        margin-top:10px;
    }
    .text-center{
        text-align:center !important;
    }
    .w-100{
        width: 100%;
    }
    .w-50{
        width:50%;   
    }
    .w-85{
        width:85%;  
    }
    .w-15{
        width:15%;   
    }
    .logo img{
        width:45px;
        height:45px;
        padding-top:30px;
    }
    .logo span{
        margin-left:8px;
        top:19px;
        position: absolute;
        font-weight: bold;
        font-size:25px;
    }
    .gray-color{
        color:#5D5D5D;
    }
    .text-bold{
        font-weight: bold;
    }
    .border{
        border:1px solid black;
    }
    table tr,th,td{
        border: 1px solid #d2d2d2;
        border-collapse:collapse;
        padding:7px 8px;
    }
    table tr th{
        background: #F4F4F4;
        font-size:15px;
    }
    table tr td{
        font-size:13px;
    }
    table{
        border-collapse:collapse;
        
    }
    .box-text p{
        line-height:10px;
    }
    .float-left{
        float:left;
    }
    .total-part{
        font-size:16px;
        line-height:12px;
    }
    .total-right p{
        padding-right:20px;
    }
    .display-f
    {
        display: inline;
    }
.info{
    border: 1px solid #d2d2d2;
}
.center{
    text-align: center;
}
.footer
{
    position: fixed;
     bottom: 0; 
     height: 30px;
}
.text
{
    font-size:10px;
}
.d-block
{
    display: block;
}

</style>
<body>
<div class="w-50  logo mt-10">
<img src="https://www.nicesnippets.com/image/imgpsh_fullsize.png"> 
    </div>  
<div class="w-50 float-left  mt-10">

        <table class="table w-85 mt-10">
      
      <tr>
          <td> Code Client</td> <td>{{$data->Code_client}}</td>
       </tr>
       <tr>
        <td> Facture N°</td> <td> </td>
        </tr>
       <tr> 
           <td>Dossier N°</td> <td> </td>
           </tr>
       <tr>
           <td>Bon de Commande</td> <td> </td>
           </tr>
       <tr>
          <td>Date</td> <td> </td>
          </tr>
       <tr>
          <td>Vos Réf</td> <td> </td> 
    </tr>
  </table> 
    </div>
<div class="add-detail mt-10">
 
    <div class="w-50 float-left mt-10 info">
    <p class="center">Nom</p>
       <p class="center">Adresse</p>
       <p class="center">Ville</p>
    </div>
  
    <div style="clear: both;"></div>
</div>


<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50">Désignation</th>
            <th class="w-50">Arrivés</th>
            <th class="w-50">Départs</th>
            <th class="w-50">Qte</th>
            <th class="w-50">Nts</th>
            <th class="w-50">P.U</th>
            <th class="w-50">TOTAL</th>
        </tr>
        <tr>
            <td >Cash On DeliveryCashOnDeliveryCashOn Delivery Cash On Delivery</td>
            <td>Free </td>
            <td>Cash </td>
            <td>Free </td>
            <td>Cash </td>
            <td>Free </td>
            <td>Cash </td>
            
        </tr>
    </table>
</div>
<div class="table-section bill-tbl w-100 mt-10">
 
                    <div class="total-left w-85 float-left" align="right">
                        <p>Sub Total</p>
                      
                    </div>
                    <div class="total-right w-15 float-left text-bold" align="right">
                      
                        <p>$330.00</p>
                    </div>
                    <div style="clear: both;"></div>
    </div> 
    <div  class="footer w-100">
<div class="info center ">Fcturation selon le régime de la marge article 125 qualer du CGI</div>  

<p class="center text ">Direction Generale:47bis,Bd.MyYoussef angle Bd.D4ANFA6caablanca-Tel:(212)2220 80 76/77Direction Generale:47bis, </br>      
Direction Generale:47bis,Bd.MyYoussef </p>   
    </div>
</html>
