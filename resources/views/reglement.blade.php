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
    .w-30{
        width:30%;   
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
        margin-top: 150px !important;
        border-collapse:collapse;
        border-bottom:1px solid #d2d2d2;
    }
    .box-text p{
        line-height:10px;
    }
    .total-part{
        font-size:16px;
        line-height:12px;
    }
.info{
    border: 1px solid #d2d2d2;
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
    .center{
       margin: auto;
       margin-top: 40px;
       width: 40%;
       border:1px solid #d2d2d2;
       padding: 15px;
       font-size: larger;
       text-align: center;
    }
    .right{
        float: right;
        display:block ;
        padding: 5px;
        margin: 5px;
        margin-bottom: 10em;
    }
    .float-left{
        float:left;
        border:1px solid #d2d2d2;
        padding: 10px;
        margin-top: 5em;
        margin-bottom:2em;
    }
    .text-centre
    {
        text-align: center;
    }
</style>
<body> 
<div class="center mt-10">
            Récépissé Réglement Client
        </div> 
    <div class="right">Edité le : {{$date}}</div>

       
    <div class=" float-left ">N°Recu:  {{$numero}}</div>
    <table class="table w-100  ">
        <tr >
        <th class=" ">Date</th>
        <th class="">JRL</th>
            <th class="w-30">Désignation</th>
            <th class="">client</th>
            <th class="">mode</th>
            <th class="">TOTAL</th>
        </tr>
        @foreach($regleement as $info_regle) 
        <tr>
            <td class="pl5">{{$info_regle->date_r}}</td>
            <td >{{$info_regle->jornal}}</td>
            <td >{{$info_regle->libelle}}</td>
            <td >{{$info_regle->client}}</td>
            <td >{{$info_regle->mode}}</td>
            <td >{{$info_regle->montant}}</td>
        </tr>
    @endforeach
    </table>


    <div  class="footer w-100">
<div class="info text-centre ">Fcturation selon le régime de la marge article 125 qualer du CGI</div>  

<p class="text text-centre">Direction Generale:47bis,Bd.MyYoussef angle Bd.D4ANFA6caablanca-Tel:(212)2220 80 76/77Direction Generale:47bis, </br>      
Direction Generale:47bis,Bd.MyYoussef </p>   
    </div>
</html>
