@extends('../layout/' . $layout)

@section('subhead')
<title>Gestion Fiche d'inscription</title>
@endsection
<style>
    .tbl{
        border: 1px solid #d2d2d2;
        padding: 5px;
        border-collapse:collapse;
    }
   
    button {
  display: block;
}

button.hidden {
  display: none;
}
button.hidden {
  display: none;
}


 </style>

@section('subcontent')
<link rel="stylesheet" href="{{URL::asset('css/tabulator.css')}}">
<div class="px-5 sm:px-20 mt-10 pt-10 ">
    <div class="grid grid-cols-6 gap-4">
        <div class="intro-y col-span-12 sm:col-span-6">
            @if (session()->has('danger'))
            <!-- BEGIN -->

            <div class="alert alert-danger alert-dismissible show flex items-center mbt-2 text-size" role="alert">
                <i data-lucide="alert-octagon" class="w-6 h-6 mr-2"></i> <strong class="text-light"> {{ session()->get('danger') }}</strong>
                <button type="button" class="btn-close text-white" data-tw-dismiss="alert" aria-label="Close">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
            <!-- END -->
            @endif
            @if (session()->has('success'))
            <!-- BEGIN -->
            <div class="alert alert-success alert-dismissible show flex items-center mb-5" role="alert">
                <i data-lucide="alert-triangle" class="w-6 h-6 mr-2"></i> <strong class="text-light"> {{ session()->get('success') }}</strong>
                <button type="button" class="btn-close" data-tw-dismiss="alert" aria-label="Close">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
            <!-- END -->
            @endif
        </div>
    </div>
</div>
<div class="tab-content mt-5">

    <div id="example-tab-3" class="tab-pane leading-relaxed active" role="tabpanel" aria-labelledby="example-3-tab">
        <div class="tab-content intro-y box py-5 px-5  mt-5" id="example-tab-3" class="tab-pane leading-relaxed active" role="tabpanel" aria-labelledby="example-3-tab">
            
            <div class="py-5 px-5  mt-5">
                <div class="font-medium text-center text-lg">Modifier factures</div>
            </div>
            

            <form id="edit_facture" name="edit_facture" action="{{ url('edit_facture') }}" method="post">
                {{ csrf_field() }}
               <div class="form-inline">
                <div class="w50 intro-y mr-2">
                  @foreach($facture as $info)
  
                 <table class="table-info  w-full mt-10">
                 <tr class="tbl"><input type="hidden" id="_id" name="_id" value="{{$info->id}}">
               
                 <td class="tbl"> Code Client</td> <td  class="tbl">{{$info->Code_client}}</td>
                 <input type="hidden" id="Code_client" name="Code_client" value="{{$info->Code_client}}"> 
               
                 </tr>
                 <tr class="tbl">
        <td class="tbl"> Facture N°</td> <td  class="tbl">{{$info->numero_facture}}
        <input type="hidden" id="numero_facture" name="numero_facture" value="{{$info->numero_facture}}"> 
         </td>
        </tr>
       <tr class="tbl"> 
           <td class="tbl">Dossier N°</td> <td  class="tbl"> {{$info->Numero_dossier}}
           <input type="hidden" id="Numero_dossier" name="Numero_dossier" value="{{$info->Numero_dossier}}"> 
           </tr>
       <tr class="tbl">
           <td class="tbl">Bon de Commande</td> <td class="tbl">{{$info->bon_commande}}
           <input type="hidden" id="bon_commande" name="bon_commande" value="{{$info->bon_commande}}"> 
           </td>
           </tr>
       <tr class="tbl">
          <td class="tbl" >Date</td> <td  class="tbl">{{$info->date}}
          <input type="hidden" id="date" name="date" value="{{$info->date}}"> 
          </td>
          </tr >
       <tr>
          <td class="tbl">Vos Réf</td> <td class="tbl" id="ref"> </td> 

    </tr>
    
  </table> 
 
    </div>

 <div class="w50 intro-y info ml-2 text-center" style="margin-bottom: auto; margin-top: 4.5%;">
    <div class="py-2">
   
     <p  class="center mb-1">{{$info->Nom_client}}</p><input type="hidden" id="Nom_client" name="Nom_client" value="{{$info->Nom_client}}"> 
       <p  class="center mb-1">{{$info->adresse}}</p><input type="hidden" id="adresse" name="adresse" value="{{$info->adresse}}"> 
       <p  class="center">{{$info->ville}}</p><input type="hidden" id="ville" name="ville" value="{{$info->ville}}"> 
       @endforeach
    </div>
  
    <div style="clear: both;"></div>
 </div>

</div>


<div class="overflow-x-auto mt-3">
    <table class="table table-striped  mt-3" id="mytable">
        <thead class="table-header">
            <tr>
            <th class="whitespace-nowrap">Déscription</th>
          <th class="whitespace-nowrap">Arrivés</th>
          <th class="whitespace-nowrap">départs</th>
         
          <th class="whitespace-nowrap">TOTAL</th>
            </tr>
        </thead>

        <tbody>
            <tr>
            <td class="editable" data-field="désignation"> {{$info->designation}}</td>
         
              <td class="editable" data-field="arrives">{{ $info->date_Arrives}} </td>
             
              <td  class="editable" data-field="departs">{{ $info->date_departs}}</td>
             
              <td class="editable" data-field="total"></td>
            </tr>
        @foreach($detail_facture as $table)
          
          <tr>
              <td style="padding-left: 40px;" class="editable" data-field="désignation"> {{ $table->nom_complet}}</td>
              <td class="editable" data-field="arrives"></td>
              <td class="editable" data-field="departs"></td>
              <td class="editable" data-field="total">{{ $table->prix}}</td>
              
           
          </tr>
      @endforeach
        </tbody>
    </table>
  
</div>
<div class="form-inline mt-5">
  <div class="intro-y w50"></div>
  <div class="intro-y w50">
                    <div style="font-size: 1rem; padding-right:10px;" class="lable-total " align="right">
                        <p>TOTAL :  <span>330.00</span></p>
                      
                    </div>
                    
                    <div style="clear: both;"></div>
    </div> </div>
    <div align="right" class="mt-3">
    
      <button type="submit" id="button1" class="btn btn-primary mt-3"  onclick="toggleButtons()">Modifier </button>
    
   
    
    
    <a id='print_facture' class="btn btn-primary hidden" >Print</a>
      
   
      </form>
     
    </div>
   </div>
</div>
@if (Auth::user()->permissions->contains('name','Update_facture'))
<script>
     const cells = document.querySelectorAll('td');
    cells.forEach(cell => {
        cell.addEventListener('click', () => {
            const currentValue = cell.innerText;
            cell.innerHTML = `<input type="text" value="${currentValue}">`;
            const input = cell.querySelector('input');
            input.focus();
            input.addEventListener('blur', () => {
                const newValue = input.value;
                cell.innerText = newValue;
               
            });
        });
    });

    function toggleButtons() {
  var button1 = document.getElementById("button1");
  var button2 = document.getElementById("print_facture");
  console
  button1.classList.add("hidden");
  button2.classList.remove("hidden");
}
</script> 
@endif
@endsection
@section('jqscripts')
<script type="text/javascript" src="{{URL::asset('js/gestion_facturation.js')}}"></script>

@endsection