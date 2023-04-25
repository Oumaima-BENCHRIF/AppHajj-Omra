@extends('../layout/' . $layout)

@section('subhead')
    <title>Liste Accompagnateurs</title>
@endsection

@section('subcontent')<br>
<br>
        <div class="flex justify-center">
            <a title="gestion Accompagnateurs" class="intro-y w-10 h-10 rounded-full btn bg-slate-100 dark:bg-darkmode-400 dark:border-darkmode-400 text-slate-500 mx-2" href="{{ url('Accompagnateurs') }}">1</button>
            <a  title="listes Accompagnateurs" class="intro-y w-10 h-10 rounded-full btn btn-primary mx-2" href="{{ url('test') }}">2</a>
            <!-- <button class="intro-y w-10 h-10 rounded-full btn bg-slate-100 dark:bg-darkmode-400 dark:border-darkmode-400 text-slate-500 mx-2">3</button> -->
        </div>
    <h2 class="intro-y text-lg font-medium mt-10">Liste Accompagnateurs</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <button class="btn btn-primary shadow-md mr-2">Add New Product</button>
            <div class="dropdown">
                <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                    <span class="w-5 h-5 flex items-center justify-center">
                        <i class="w-4 h-4" data-lucide="plus"></i>
                    </span>
                </button>
                <div class="dropdown-menu w-40">
                    <ul class="dropdown-content">
                        <li>
                            <a href="" class="dropdown-item">
                                <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Print
                            </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item">
                                <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export to Excel
                            </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item">
                                <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export to PDF
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="hidden md:block mx-auto text-slate-500"> Affichage (Total lignes:{{$countListeAccompagnateurs}})</div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-slate-500">
                    <!-- <input type="text" class="form-control w-56 box pr-10" placeholder="Search...">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i> -->
                </div>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="text-center whitespace-nowrap">Code</th>
                        <th class="text-center whitespace-nowrap">Nom & prenom</th>
                        <th class="text-center whitespace-nowrap">Telephone</th>
                        <th class="text-center whitespace-nowrap">Fax</th>
                        <th class="text-center whitespace-nowrap">Adresse</th>
                        <th class="text-center whitespace-nowrap">prix</th>
                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($listes_Accompagnateurs as $key => $listesAccompagnateurs)                       
                 <tr class="intro-x">
                            <td>
                                <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{$listesAccompagnateurs->code }}</div>
                            </td>
                            <td>
                                <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{$listesAccompagnateurs->nom_prenom }}</div>
                            </td>
                            <td>
                                <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{$listesAccompagnateurs->telephone }}</div>
                            </td>
                            <td>
                                <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{$listesAccompagnateurs->fax }}</div>
                            </td>
                            <td>
                                <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{$listesAccompagnateurs->adresse }}</div>
                            </td>
                            <td>
                                <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{$listesAccompagnateurs->prix }}</div>
                            </td>
                            <?php $url_info = route('hotel_transports.infos'); ?>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <!-- update -->
                                    <button onclick="showDialogueModifierAccompagnateurs('{{ $listesAccompagnateurs->id }}')" href="javascript:;" data-tw-toggle="modal" data-tw-target="#header-footer-modal-preview" class="flex items-center mr-3">
                                        <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit
                                    </button>

                              

                                    <!-- delete -->
                                    <button onclick="showDialogueDeleteAccompagnateurs('{{ $listesAccompagnateurs->id }}')" value="{{ $listesAccompagnateurs->id }}" class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal">
                                        <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            <nav class="w-full sm:w-auto sm:mr-auto">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="w-4 h-4" data-lucide="chevrons-left"></i>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="w-4 h-4" data-lucide="chevron-left"></i>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">...</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item active">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">...</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="w-4 h-4" data-lucide="chevron-right"></i>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="w-4 h-4" data-lucide="chevrons-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <select class="w-20 form-select box mt-3 sm:mt-0">
                <option>10</option>
                <option>25</option>
                <option>35</option>
                <option>50</option>
            </select>
        </div>
        <!-- END: Pagination -->
    </div>
    
    <!-- BEGIN: Delete Confirmation Modal -->
    <div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="p-5 text-center">
                        <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                        <div class="text-3xl mt-5">Are you sure?</div>
                        <div class="text-slate-500 mt-2">Do you really want to delete these records? <br>This process cannot be undone.</div>
                    </div>
                    <form action="{{ route('Accompagnateurs.delete') }}"  method="post">

                    <div class="px-5 pb-8 text-center">
                        <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                        
                        
                          <input type="hidden" id="__id" name="__id">

                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger w-24">Delete</button>
                        
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Delete Confirmation Modal -->
   
    <!-- BEGIN: Modal update -->
                                        
                                        <!-- END: Modal update -->
                                        <!-- BEGIN: Modal update -->
                                        <div id="header-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <!-- BEGIN: Modal Header -->
                                                    <div class="modal-header">
                                                        <h2 class="font-medium text-base mr-auto">Modifier Accompagnateurs</h2>
                                                        
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
                                                    <!-- BEGIN: Modal Body -->
                                                    <?php $url_update = route('Accompagnateurs.edit'); ?>
                                            <form action="{{ route('Accompagnateurs.update') }}"  method="post">

                                                {{ csrf_field() }}
                                                    <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                                                        <div class="col-span-12 sm:col-span-6">
                                                            <label for="code" class="form-label">Code</label>
                                                            <input id="code" name="code" value="{{old('code')}}" type="text" class="form-control" placeholder="Code">
                                                        </div>

                                                        <input type="hidden" id="id_" name="id_" >

                                                        <div class="col-span-12 sm:col-span-6">
                                                            <label for="nom_prenom" class="form-label">Nom & prenom</label>
                                                            <input id="nom_prenom" name="nom_prenom"  value="{{old('nom_prenom')}}" type="text" class="form-control" placeholder="Nom & prenom">
                                                        </div>
                                                    
                                                        <div class="col-span-12 sm:col-span-6">
                                                            <label for="telephone" class="form-label">Telephone</label>
                                                            <input id="telephone" name="telephone" type="text" value="{{old('telephone')}}" class="form-control" placeholder="Telephone">
                                                        </div>
                                                     
                                                        <div class="col-span-12 sm:col-span-6">
                                                            <label for="fax" class="form-label">Fax</label>
                                                            <input id="fax" name="fax" type="text"  value="{{old('fax')}}" value="{{old('fax')}}"  class="form-control" placeholder="Fax">
                                                        </div>
                                                        <div class="col-span-12 sm:col-span-6">
                                                            <label for="adresse" class="form-label">Adresse</label>
                                                            <input id="adresse" name="adresse" type="text"  value="{{old('adresse')}}" class="form-control" placeholder="adresse">
                                                        </div>
                                                        
                                                        <div class="col-span-12 sm:col-span-6">
                                                            <label for="prix" class="form-label">Prix</label>
                                                            <input id="prix" name="prix" type="text" value="{{old('prix')}}" class="form-control" placeholder="prix">
                                                        </div>
                                                  
                                                    
                                                              
                                                    </div>

                                                    <!-- END: Modal Body -->
                                                    <!-- BEGIN: Modal Footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Cancel</button>
                                                        <button type="submit" class="btn btn-primary w-20">Send</button>
                                                    </div>
                                            </form>
                                                    <!-- END: Modal Footer -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END: Modal Content -->
                                    
                                
    <!-- end update -->
@endsection
<script>
    function showDialogueDeleteAccompagnateurs(id) { 
    console.log(id);
    document.getElementById("__id").value = id;
    // ajaxPost;

}

function showDialogueModifierAccompagnateurs(id) { 

console.log(id);
document.getElementById("id_").value = id;

// ajaxPost(url, (obj) => {
   
//     // --------------------------- fill
//     const nv = obj.Hotel_transports;
//     document.getElementById("id_").value = nv.id;
//     document.getElementById("code").value = nv.code;
//     document.getElementById("nom").value = nv.nom;
//     document.getElementById("ville").value = nv.ville;
//     document.getElementById("emplacement").value = nv.emplacement;
//     document.getElementById("telephone").value = nv.telephone;
//     document.getElementById("fax").value = nv.fax;
//     document.getElementById("adresse").value = nv.adresse;
//     document.getElementById("compte_comptable_ramadan").value = nv.compte_comptable_ramadan;
//     document.getElementById("compte_comptable_mouloud").value = nv.compte_comptable_mouloud;
//     document.getElementById("prix").value = nv.prix;
//     document.getElementById("email").value = nv.email;
//     document.getElementById("categorie").value = nv.categorie;
//     document.getElementById("nom_en_arabe").value = nv.nom_en_arabe;
//     document.getElementById("type").value = nv.type;
//       // console.log(document.getElementById("url_update").value);
// });
}
</script>