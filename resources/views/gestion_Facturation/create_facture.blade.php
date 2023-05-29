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
                <div class="font-medium text-center text-lg">Gestion facturation</div>
            </div>
            
            <form id="Add_facture" name="Add_facture" action="{{ url('facturation_store') }}" method="post">
                {{ csrf_field() }}
               <div class="form-inline">
                <div class="w50 intro-y mr-2">
                 
                  <input type="hidden" id="id_fiche" name="id_fiche" value="{{$id}}"> 
                 <table class="table-info  w-full mt-10">
                 <tr class="tbl">
                 <input type="hidden" id="numfichier" name="numfichier" value="{{$code_client}}"> 
                 <td class="tbl"> Code Client</td> <td  class="tbl">{{$code_client}}</td>
                 </tr>
                 <tr class="tbl">
        <td class="tbl"> Facture N°</td> <td   class="tbl">{{$numfacture}}
            <input type="hidden" id="numfacture" name="numfacture" value="{{$numfacture}}">
         </td>
        </tr>
       <tr class="tbl"> 
           <td class="tbl">Dossier N°</td> <td id='numdossier' class="tbl"> {{$numdossier}}
            <input type="hidden" name="num_dossier" value="{{$numdossier}}"></td>
           </tr>
       <tr class="tbl">
           <td class="tbl">Bon de Commande</td> <td  class="tbl">{{$bon_commande}}
           <input type="hidden" id="bon_commande" name="bon_commande" value="{{$bon_commande}}"> 
           </td>
           </tr>
       <tr class="tbl">
          <td class="tbl" >Date</td> <td  class="tbl">{{$date}}
          <input type="hidden" id="date_fiche_inscription" name="date_fiche_inscription" value="{{$date}}"> 
          </td>
          </tr >
       <tr>
          <td class="tbl">Vos Réf</td> <td class="tbl" id="ref"> </td> 
    </tr>
    
  </table> 
  
    </div>

 <div class="w50 intro-y info ml-2 text-center" style="margin-bottom: auto; margin-top: 4.5%;">
    <div class="py-2">
    
     <p  id='nom_c' class="center mb-1">{{$nom}}</p><input type="hidden" id="nom" name="nom" value="{{$nom}}"> 
       <p id='adresse_s'  class="center mb-1">{{$adresse}}</p><input type="hidden" id="adresse" name="adresse" value="{{$adresse}}"> 
       <p  id="ville_c" class="center">{{$ville_client}}</p><input type="hidden" id="ville_client" name="ville_client" value="{{$ville_client}}"> 
     
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
            <td class="editable" data-field="désignation"> {{ $designation}}</td>
            <input type="hidden" id="designation" name="designation" value="{{ $designation}}"> 
              <td class="editable" data-field="arrives">{{ $date_retour }} </td>
              <input type="hidden" id="date_retour" name="date_retour" value="{{ $date_retour }}"> 
              <td  class="editable" data-field="departs">{{ $date_depart }}</td>
              <input type="hidden" id="date_depart" name="date_depart" value="{{ $date_depart }}"> 
              <td class="editable" data-field="total"></td>
            </tr>
       
        @foreach($Detail_Fiche as $table)
          
          <tr>
              <td style="padding-left: 40px;" class="editable" data-field="désignation"> {{ $table->nom_complet }}</td>
              <td class="editable" data-field="arrives"></td>
              <td class="editable" data-field="departs"></td>
              <td class="editable" data-field="total"> {{ $table->prix }}</td>
            
           
          </tr>
      @endforeach
        </tbody>
    </table>
  
</div>
<div class="form-inline mt-5">
  <div class="intro-y w50"></div>
  <div class="intro-y w50">
                    <div style="font-size: 1rem; padding-right:10px;" class="lable-total " align="right">
                        <p>TOTAL :  <span>{{$total}}</span></p>
                        <input type="hidden" id="total" name="total" value="{{$total}}"> 
                    </div>
                    
                    <div style="clear: both;"></div>
    </div> </div>
    <div align="right" class="mt-3">
    @if($exist==false) 
      <button type="submit" id="button1" class="btn btn-primary mt-3"  onclick="toggleButtons()">Enregister </button>
      @endif  
    </form>
    
    @if($exist==false)   
    <a id='print' class="btn btn-primary hidden" >Imprimer</a>
      
      @endif  
      @if($exist==true)  
      <button href="javascript:;" id='situation' data-tw-toggle="modal" data-tw-target="#Situation_Facture_Modal" class="btn btn-outline-success ">
                        <span class=" h-5 flex items-center justify-center">
                            <div class="col-span-6 sm:col-span-3 lg:col-span-2 xl:col-span-1">
                            Situation Facture
                            </div>
                        </span>
                    </button>
      
      <a id='print'  class="btn btn-primary"  >Imprimer</a>
    
      @endif 
      </form>
     
    </div>
   </div>
   <!-- BEGIN: Situation Facture Modal  -->
<div id="example-tab-2" class="tab-pane leading-relaxed p-5" role="tabpanel" aria-labelledby="example-2-tab">
    <div id="Situation_Facture_Modal" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!-- BEGIN: Modal Header -->
                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">Situation Facture</h2>
                    <div class="dropdown sm:hidden">
                        <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown">
                            <i data-lucide="more-horizontal" class="w-5 h-5 text-slate-500"></i>
                        </a>
                        <div class="dropdown-menu w-40">
                            <ul class="dropdown-content">
                                <li>
                                    <a href="javascript:;" class="dropdown-item">
                                        <i data-lucide="file" class="w-4 h-4 mr-2"></i> Download Docs
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- END: Modal Header -->
                <!-- BEGIN: Modifier  Modal Body -->
                    <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                        <div class="col-span-12 sm:col-span-6">
                            <label for="T_Facture" class="form-label">Total Facture</label>
                            <input type="text" id="T_Facture" name="T_Facture" class="form-control" disabled>
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="R_Facture" class="form-label">Reste sur Facture</label>
                            <input type='text' class="form-control" id="R_Facture" name="R_Facture" disabled />
                        </div>
                        <div class="col-span-12 ">
                        <div class="overflow-x-auto scrollbar-hidden">
                        <div id="S_facture" class="mt-5 table-report--tabulator"></div>
                       </div>
                       </div>
                    </div>

                    <!-- END: Modal Body -->
                   
            </div>
        </div>
    </div>
</div>
<!-- END: Situation Facture Modal -->
</div>
@if($exist==false) 
@if (Auth::user()->permissions->contains('name','Update_facture'))
<script>
     const cells = document.querySelectorAll('td');
    cells.forEach(cell => {
        cell.addEventListener('click', () => {
            const currentValue = cell.innerText;
            cell.innerHTML = `<input type="text" class="form-control py-1 " value="${currentValue}">`;
            const input = cell.querySelector('input');
            input.focus();
            input.addEventListener('blur', () => {
                const newValue = input.value;
                cell.innerText = newValue;
               
            });
        });
    });

    const adresse = document.getElementById('adresse_s');
const adresse2 = document.getElementById('adresse');
adresse.addEventListener('click', () => {
  const currentValue = adresse.innerText.trim();
  adresse.innerHTML = `<input type="text" class="form-control py-1 " value="${currentValue}">`;
  const input = adresse.querySelector('input');
 
      input.focus();
      input.addEventListener('blur', () => {
        const newValue = input.value;
      
        adresse.innerText = newValue;
        adresse2.value = newValue;
      });
});


const ville_c = document.getElementById('ville_c');
const ville = document.getElementById('ville');
ville_c.addEventListener('click', () => {
  const currentValue = ville_c.innerText.trim();
  ville_c.innerHTML = `<input type="text" class="form-control py-1 " value="${currentValue}">`;
  const input = ville_c.querySelector('input');
 
      input.focus();
      input.addEventListener('blur', () => {
        const newValue = input.value;
      
        ville_c.innerText = newValue;
        ville.value = newValue;
      });
});


const nom_c = document.getElementById('nom_c');
const Nom_client = document.getElementById('Nom_client');
nom_c.addEventListener('click', () => {
  const currentValue = nom_c.innerText.trim();
  nom_c.innerHTML = `<input type="text" class="form-control py-1 " value="${currentValue}">`;
  const input = nom_c.querySelector('input');
 
      input.focus();
      input.addEventListener('blur', () => {
        const newValue = input.value;
      
        nom_c.innerText = newValue;
        Nom_client.value = newValue;
      });
});

    function toggleButtons() {
      alert('enregster');
  var button1 = document.getElementById("button1");
  var button2 = document.getElementById("print");
  console
  button1.classList.add("hidden");
  button2.classList.remove("hidden");
}
</script> 
@endif
@endif  
@endsection
@section('jqscripts')
<script type="text/javascript" src="{{URL::asset('js/gestion_facturation.js')}}"></script>

@endsection