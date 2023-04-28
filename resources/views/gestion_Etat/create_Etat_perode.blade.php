@extends('../layout/' . $layout)
<?php

use Illuminate\Support\Facades\Session;

?>
@section('subhead')
<title>Gestion état par Hôtel</title>
<style>
    #table_data
    {
        display: none;
    }
</style>
@endsection
<link rel="stylesheet" href="{{URL::asset('css/tabulator.css')}}">
@section('subcontent')

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


<!-- BEGIN: gestion Agents -->
<div class="tab-content mt-5">

    <div id="example-tab-3" class="tab-pane leading-relaxed active" role="tabpanel" aria-labelledby="example-3-tab">
        <div class="tab-content intro-y box py-5 px-5  mt-5" id="example-tab-3" class="tab-pane leading-relaxed active" role="tabpanel" aria-labelledby="example-3-tab">

            <div class="px-5 mt-10 mb-6">
                <div class="font-medium text-center text-lg">gestion Etal par periode par vol</div>
            </div>
            <form id="search_allotement" action="{{route('Etat_Vol.list_Allotement')}}" method="get">
                {{ csrf_field() }}
                <div class="py-5 px-2  container">
                    <div class="form-inline">
                    <div class="input-form w4 px-1 @if ($errors->get('num_vol')) has-error @endif">
                            <label for="num_vol" class="form-label text-size mbt-2">numero de vol</label>

                            <input id="num_vol" type="text" class="form-control py-1 @if($errors->get('num_vol')) is-invalid @endif" name="num_vol">

                            @if($errors->get('num_vol'))
                            @foreach($errors->get('num_vol') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>
 

                        <div class="intro-y w4 px-1  @if ($errors->get('code_agents')) has-error @endif">
                            <label class="form-label mbt-2 text-size">de</label>
                            <input type="date" class="form-control py-1 @if($errors->get('date_depart')) is-invalid @endif" name="start_date">
                            @if($errors->get('date_depart'))
                            @foreach($errors->get('date_depart') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="intro-y w4 px-1  @if ($errors->get('date_reteur')) has-error @endif">
                            <label for="date_reteur" class="form-label mbt-2 text-size">à</label>
                            <input  type="date" class="form-control py-1 @if($errors->get('date_reteur')) is-invalid @endif"name="end_date">
                            @if($errors->get('date_reteur'))
                            @foreach($errors->get('date_reteur') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="input-form w4 px-1 @if ($errors->get('compagnies')) has-error @endif">
                            <label for="compagnies" class="form-label text-size mbt-2">compagnies</label>

                            <select id="compagnies" name="compagnies" data-search="true" class="form-control py-1">
                            </select>

                            @if($errors->get('compagnies'))
                            @foreach($errors->get('compagnies') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>
                
                     

                  
                  </div>
                        <div class="form-inline justify-content-end">
                            <!-- <a class="btn btn-secondary w-24" href="{{ url('liste_Agents') }}">Liste</a> -->
                            <button type="Submit"  class="btn btn-primary mt-6 py-1 mr-1">Envoyer</button>
                        </div>
                       
            </form>
            </div>
        <!-- debut de liste TO -->
        <div class="grid grid-cols-12 gap-6">
                        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center ">
                        </div>
                        <!-- BEGIN: Data List -->
                        <div id="table_data" class=" intro-y col-span-12 overflow-auto lg:overflow-visible" style="overflow-x:auto;">
                            <div class="intro-y box">
                                <div class="flex flex-col sm:flex-row sm:items-end xl:items-start pading">
                                    <form id="tabulator-html-filter-form" class="xl:flex sm:mr-auto">

                                    </form>
                                    <div class="flex mt-2 sm:mt-0">
                                        <button id="tabulator-print-To" class="btn btn-outline-primary  w-1/2 sm:w-auto mr-2">
                                            <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Print
                                        </button>
                                        <div class="dropdown w-1/2 sm:w-auto">    
                                            <button class="dropdown-toggle btn btn-outline-dark w-full sm:w-auto" aria-expanded="false" data-tw-toggle="dropdown">
                                                <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export <i data-lucide="chevron-down" class="w-4 h-4 ml-auto sm:ml-2"></i>
                                            </button>
                                            <div class="dropdown-menu w-40">
                                                <ul class="dropdown-content">
                                                   
                                                    <li>
                                                        <a id="tabulator-export-json" href="javascript:;" class="dropdown-item">
                                                            <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export JSON
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a id="tabulator-export-xlsx" href="javascript:;" class="dropdown-item">
                                                            <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export XLSX
                                                        </a>
                                                    </li>
                                                   
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              
                                <div class="overflow-x-auto scrollbar-hidden">
                                    <div id="liste_EtatVol" class="mt-5 table-report--tabulator"></div>
                                </div>
                            </div>
                        </div>
                        <!-- END: Data List -->
                    </div>
                    <!-- Fin de liste date depart -->
    </div>

</div>



 

</div>





</div>
<!-- END: gestion Etat vol-->


</div>


@endsection
@section('jqscripts')
<script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>
<script type="text/javascript" src="{{URL::asset('js/Gestion_Etat.js')}}"></script>

@endsection