@extends('../layout/' . $layout)

@section('subhead')
<title>Gestion Fiche d'inscription</title>
@endsection
<style>
  


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
            
            <div class="overflow-x-auto scrollbar-hidden">
                <div id="Liste_Facture" class="mt-5 table-report--tabulator"></div>
            </div>
            </div>
</div> </div>
@endsection
@section('jqscripts')
<script type="text/javascript" src="{{URL::asset('js/gestion_facturation.js')}}"></script>
@endsection