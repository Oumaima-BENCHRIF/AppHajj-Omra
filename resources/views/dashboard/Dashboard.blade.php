@extends('../layout/' . $layout)
<?php

use Illuminate\Support\Facades\Session;

?>
@section('subhead')
<title>Dashbord</title>
@endsection
<style>
            .report-box .report-box__icon {
             width: 10em !important;
             height: 5em !important;
            }
            .justify-content-center
            {
                justify-content: center ;
            }

        </style>

@section('subcontent')
<div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12 2xl:col-span-9">
                        <div class="grid grid-cols-12 gap-6">
                            <!-- BEGIN: General Report -->
                            <div class="col-span-12 mt-8">
                                <div class="intro-y flex items-center h-10">
                                    <h2 class="text-lg font-medium truncate mr-5">
                                        General Report
                                    </h2>
                                </div>
                                <div class="grid grid-cols-12 gap-6 mt-5">
                                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                        <div class="report-box zoom-in">
                                            <div class="box p-5">
                                                <div class="flex">
                                                    <i data-lucide="shopping-cart" class="report-box__icon text-primary"></i> 
                                               
                                                </div>
                                                <div class="text-3xl font-medium leading-8 mt-6 text-center">Commandes</div>
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                        <div class="report-box zoom-in">
                                            <div class="box p-5">
                                                <div class="flex">
                                                    <i data-lucide="credit-card" class="report-box__icon text-pending"></i> 
                                                   
                                                </div>
                                                <div class="text-3xl font-medium leading-8 mt-6 text-center">Régluments</div>
                                      
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                        <div class="report-box zoom-in">
                                            <div class="box p-5">
                                                <div class="flex">
                                                    <i data-lucide="monitor" class="report-box__icon text-warning"></i> 
                                                   
                                                </div>
                                                <div class="text-3xl font-medium leading-8 mt-6 text-center">Rapports</div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                        <div class="report-box zoom-in">
                                            <div class="box p-5">
                                                <div class="flex">
                                                    <i data-lucide="user" class="report-box__icon text-success"></i> 
                                                    
                                                </div>
                                                <div class="text-3xl font-medium leading-8 mt-6 text-center">Clients</div>
                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                               
                            </div>
                            <div class="col-span-12 lg:col-span-6 mt-8">
                                <div class="report-box-2 intro-y mt-12 sm:mt-5">
                                    
                                    <div class="box ">
                                        <div class="flex items-center justify-content-center border-b border-slate-200/60 py-5 px-2">
                                            <div class="font-medium text-base truncate">Situation du Stock(Etrées/Sorties )</div><a href="" class="ml-auto flex items-center text-primary"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="refresh-ccw" data-lucide="refresh-ccw" class="lucide lucide-refresh-ccw w-4 h-4 mr-3"><path d="M3 2v6h6"></path><path d="M21 12A9 9 0 006 5.3L3 8"></path><path d="M21 22v-6h-6"></path><path d="M3 12a9 9 0 0015 6.7l3-2.7"></path></svg> Reload Data </a>
                                        </div> 
                                        <div class="sm:flex">
                                        <div class=" py-4 px-2 flex flex-col justify-center flex-1">
                                            <div class="intro-x">
                                                <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                                    <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                                        <img alt="Midone - HTML Admin Template" src="dist/images/Capture1.png">
                                                    </div>
                                                    <div class="ml-4 mr-auto">
                                                        <div class="font-medium">total stock</div>
                                                        <div class="text-slate-500 text-xs mt-0.5">0</div>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                            <div class="intro-x">
                                                <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                                    <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                                        <img alt="Midone - HTML Admin Template" src="dist/images/Capture3.png">
                                                    </div>
                                                    <div class="ml-4 mr-auto">
                                                        <div class="font-medium">ARTICLES VENDUS</div>
                                                        <div class="text-slate-500 text-xs mt-0.5">43</div>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                            <div class="intro-x">
                                                <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                                    <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                                        <img alt="Midone - HTML Admin Template" src="dist/images/Capture5.png">
                                                    </div>
                                                    <div class="ml-4 mr-auto">
                                                        <div class="font-medium">STOCK DISPONIBLE</div>
                                                        <div class="text-slate-500 text-xs mt-0.5">1400</div>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" py-4 px-2 flex flex-col justify-center flex-1 border-t sm:border-t-0 sm:border-l border-slate-200 dark:border-darkmode-300 border-dashed">
                                            <div class="intro-x">
                                                <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                                    <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                                        <img alt="Midone - HTML Admin Template" src="dist/images/Capture2.png">
                                                    </div>
                                                    <div class="ml-4 mr-auto">
                                                        <div class="font-medium">CHEFRE D'AFFIRE</div>
                                                        <div class="text-slate-500 text-xs mt-0.5">10</div>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                            <div class="intro-x">
                                                <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                                    <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                                        <img alt="Midone - HTML Admin Template" src="dist/images/Capture4.png">
                                                    </div>
                                                    <div class="ml-4 mr-auto">
                                                        <div class="font-medium">CHEFRE D'AFFIRE VENDUS</div>
                                                        <div class="text-slate-500 text-xs mt-0.5">55</div>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                            <div class="intro-x">
                                                <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                                    <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                                        <img alt="Midone - HTML Admin Template" src="dist/images/Capture6.png">
                                                    </div>
                                                    <div class="ml-4 mr-auto">
                                                        <div class="font-medium">CHEFRE D'AFFIRE DISPO</div>
                                                        <div class="text-slate-500 text-xs mt-0.5">3020</div>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    <div class="intro-x mx-2">
                                        <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                            <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                                <img alt="Midone - HTML Admin Template" src="dist/images/Capture7.png">
                                            </div>
                                            <div class="ml-4 mr-auto">
                                                <div class="font-medium">STOCK EPUISE</div>
                                                <div class="text-slate-500 text-xs mt-0.5">3020</div>
                                            </div>
                                           
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-12 lg:col-span-6 mt-8">
                                <div class="report-box-2 intro-y mt-12 sm:mt-5">
                                    
                                    <div class="box ">
                                        <div class="flex items-center justify-content-center border-b border-slate-200/60 py-5 px-2">
                                            <div class="font-medium text-base truncate">Situation du Paiments/Factures </div><a href="" class="ml-auto flex items-center text-primary"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="refresh-ccw" data-lucide="refresh-ccw" class="lucide lucide-refresh-ccw w-4 h-4 mr-3"><path d="M3 2v6h6"></path><path d="M21 12A9 9 0 006 5.3L3 8"></path><path d="M21 22v-6h-6"></path><path d="M3 12a9 9 0 0015 6.7l3-2.7"></path></svg> Reload Data </a>
                                        </div> 
                                        <div class="sm:flex">
                                        <div class=" py-4 px-2 flex flex-col justify-center flex-1">
                                            <div class="intro-x">
                                                <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                                    <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                                        <img alt="Midone - HTML Admin Template" src="dist/images/Capture8.png">
                                                    </div>
                                                    <div class="ml-4 mr-auto">
                                                        <div class="font-medium">TOTAL FACTURES</div>
                                                        <div class="text-slate-500 text-xs mt-0.5">0</div>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                            <div class="intro-x">
                                                <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                                    <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                                        <img alt="Midone - HTML Admin Template" src="dist/images/Capture9.png">
                                                    </div>
                                                    <div class="ml-4 mr-auto">
                                                        <div class="font-medium">MONTANT PAYE</div>
                                                        <div class="text-slate-500 text-xs mt-0.5">43</div>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                            <div class="intro-x">
                                                <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                                    <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                                        <img alt="Midone - HTML Admin Template" src="dist/images/Capture10.png">
                                                    </div>
                                                    <div class="ml-4 mr-auto">
                                                        <div class="font-medium">MONTANT IMPAYE</div>
                                                        <div class="text-slate-500 text-xs mt-0.5">1400</div>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                            <div class="intro-x">
                                                <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                                    <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                                        <img alt="Midone - HTML Admin Template" src="dist/images/Capture4.png">
                                                    </div>
                                                    <div class="ml-4 mr-auto">
                                                        <div class="font-medium">PENEFICE/PERTE</div>
                                                        <div class="text-slate-500 text-xs mt-0.5">10</div>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" py-4 px-2 flex flex-col justify-center flex-1 border-t sm:border-t-0 sm:border-l border-slate-200 dark:border-darkmode-300 border-dashed">
                                           
                                           
                                            <div class="intro-y box p-5 ">
                                                <div class="">
                                                    <div class="h-[213px]">
                                                        <canvas id="report-pie-chart" width="173" height="213" style="display: block; box-sizing: border-box; height: 213px; width: 173px;"></canvas>
                                                    </div>
                                                </div>
                                                <div class="w-52 sm:w-auto mx-auto ">
                                                    <div class="flex items-center">
                                                        <div class="w-2 h-2 bg-primary rounded-full mr-3"></div>
                                                        <span class="truncate">17 - 30 Years old</span> <span class="font-medium ml-auto">62%</span> 
                                                    </div>
                                                    <div class="flex items-center mt-4">
                                                        <div class="w-2 h-2 bg-pending rounded-full mr-3"></div>
                                                        <span class="truncate">31 - 50 Years old</span> <span class="font-medium ml-auto">33%</span> 
                                                    </div>
                                                    <div class="flex items-center mt-4">
                                                        <div class="w-2 h-2 bg-warning rounded-full mr-3"></div>
                                                        <span class="truncate">&gt;= 50 Years old</span> <span class="font-medium ml-auto">10%</span> 
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                </div>
@endsection
