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
    .h-5
    {
        height: 5px;
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
    table tr,td{
        border-right: 1px solid #d2d2d2;
        border-left: 1px solid #d2d2d2;
        border-collapse:collapse;
        padding:7px 8px;
    }
    table tr th{
        background: #F4F4F4;
        font-size:15px;
        border: 1px solid #d2d2d2;
        padding-top:10px;
        padding-bottom:10px;
    }
    table tr td{
        font-size:13px;
    
       
    }
   
    table{
        margin-top: 20px !important;
       
        border-collapse:collapse;
        border-bottom:1px solid #d2d2d2;
       
        
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

.h-100
{
    height: 100%;
}
.mt20{
    margin-top: 18px;
}
.tbl{
        border: 1px solid #d2d2d2;
      
        border-collapse:collapse;
    }



</style>
<body>
<div class="w-50  logo mt-10">
<img src="https://www.nicesnippets.com/image/imgpsh_fullsize.png"> 
    </div>  
<div class="w-50 float-left  mt-10">

         
        <table class=" w-85 mt-10">
        <tr>
          <td class="tbl">Code Client</td> <td  class="tbl" id="numfichier"> {{$info_facture->Code_client}}</td>
       </tr>
      

       <tr>
        <td class="tbl" > Facture N°</td> <td class="tbl" id='numfacture'>{{ $info_facture->numero_facture }} </td>
        </tr>
       <tr> 
           <td class="tbl" >Dossier N°</td> <td id='numdossier' class="tbl"> {{ $info_facture->Numero_dossier }}</td>
           </tr>
       <tr>
           <td class="tbl" >Bon de Commande</td> <td id='bncommande' class="tbl"> {{ $info_facture->bon_commande }}</td>
           </tr>
       <tr>
          <td class="tbl" >Date</td> <td id="date_inscri" class="tbl"> {{ $info_facture->date }}</td>
          </tr>
       <tr>
          <td class="tbl" >Vos Réf</td> <td  class="tbl" id="ref"> </td> 
    </tr>
    
  </table> 
    </div>
<div class="add-detail mt20">
  <div class="w-50 float-left mt-10 info">
    <p id="nom" class="center">{{ $info_facture->Nom_client }}</p>
       <p id="adresse" class="center">{{ $info_facture->adresse }}</p>
       <p id="ville" class="center">{{ $info_facture->ville}}</p>
    </div>
  
    <div style="clear: both;"></div>
</div>



    <table class="table w-100 mt-10 ">
        <tr >
            <th class="w-50 ">Désignation</th>
            <th class="">Arrivés</th>
            <th class="">Départs</th>
            <th class="">TOTAL</th>
        </tr>
        <tr>
            <td class="pl5">{{ $info_facture->designation }}</td>
            <td >{{ $info_facture->date_Arrives }}</td>
            <td >{{ $info_facture->date_departs }}</td>
            <td ></td>
        </tr>
    
        @foreach($detail_facture as $info_detail)    
        <tr>
            <td >{{ $info_detail->nom_complet }}</td>
            <td></td>
            <td></td>
            <td>{{ $info_detail->prix }}</td>
        </tr>
        @endforeach
    </table>

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
