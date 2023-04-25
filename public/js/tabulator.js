(function () {
    jQuery.ajax({
        url: "/liste_gestion_dossier",
        type: "GET", // Le nom du fichier indiqué dans le formulaire
        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
        // dataFilter: 'json', //forme data
        success: function (responce) {
            // Je récupère la réponse du fichier PHP
            $tabledata = "";
            jQuery.each(responce.liste_gestion_dossier, function (key, item) {
                $tabledata = responce.liste_gestion_dossier;
            });
            var table = new Tabulator("#players", {
                printAsHtml: true,
                printStyled: true,
                // height: 220,
                data: $tabledata,
                layout: "fitColumns",
                pagination: "local",
                paginationSize: 5,
                paginationSizeSelector: [10, 20, 30, 40],
                placeholder: "No matching records found",
                tooltips: true,
                columns: [
                    {
                        title: "Hijri date",
                        minWidth: 200,
                        field: "hijri_date",
                        sorter: "number",
                        hozAlign: "left",
                        headerFilter: "input",
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                        formatter(cell, formatterParams) {
                            return `<div class="flex lg:justify-center">
                    <div class="w-10 h-10 image-fit zoom-in">
                    <img alt="Midone - HTML Admin Template" class="tooltip rounded-full" src="build/assets/images/preview-14.jpg"> </div>\
                    </div>
                    <div class="w-10 h-10 image-fit zoom-in -ml-5">
                    <img alt="Midone - HTML Admin Template" class="tooltip rounded-full" src="build/assets/images/preview-15.jpg"> </div>\
                    </div>
                </div>`;
                        },
                    },
                    {
                        title: "Nom dossier",
                        minWidth: 200,
                        responsive: 0,
                        field: "nom_dossier",
                        sorter: "string",
                        vertAlign: "middle",
                        headerFilter: "input",
                        print: false,
                        download: false,
                        formatter(cell, formatterParams) {
                            return `<div>
                    <div class="font-medium whitespace-nowrap">${
                        cell.getData().nom_dossier
                    }</div>
                    <div class="text-slate-500 text-xs whitespace-nowrap">${
                        cell.getData().nom_dossier
                    }</div>
                </div>`;
                        },
                    },
                    {
                        title: "Date début",
                        field: "Date_debut",
                        minWidth: 200,
                        sorter: "string",
                        hozAlign: "center",
                        vertAlign: "middle",
                        headerFilter: true,
                        print: false,
                        download: false,
                    },
                    {
                        title: "Date fin",
                        field: "Date_fin",
                        sorter: "number",
                        hozAlign: "center",
                    },
                    {
                        title: "Action",
                        minWidth: 200,
                        field: "actions",
                        responsive: 1,
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                        formatter(cell, formatterParams) {
                            let a =
                                $(`<div class="flex lg:justify-center items-center">
                    <a class="edit flex items-center mr-3" href="javascript:;">
                        <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit
                    </a>
                    <a class="delete flex items-center text-danger" href="javascript:;">
                        <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete
                    </a>
                </div>`);
                            $(a)
                                .find(".edit")
                                .on("click", function () {
                                    alert("EDIT");
                                });

                            $(a)
                                .find(".delete")
                                .on("click", function () {
                                    alert("DELETE");
                                });

                            return a[0];
                        },
                    },
                    // For print format
                    {
                        title: "Nom dossier",
                        field: "nom_dossier",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Hijri date",
                        field: "hijri_date",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Date début",
                        field: "Date_debut",
                        visible: false,
                        print: true,
                        download: true,
                    },
                ],
                rowClick: function (e, row) {
                    alert("Row " + row.getData().playerid + " Clicked!!!!");
                },
            });
            // Redraw table onresize
            window.addEventListener("resize", () => {
                // table.redraw();
                createIcons({
                    icons,
                    "stroke-width": 1.5,
                    nameAttr: "data-lucide",
                });
            });
            // Filter function
            function filterHTMLForm() {
                let field = $("#tabulator-html-filter-field").val();
                let type = $("#tabulator-html-filter-type").val();
                let value = $("#tabulator-html-filter-value").val();
                table.setFilter(field, type, value);
            }
            // On submit filter form
            $("#tabulator-html-filter-form")[0].addEventListener(
                "keypress",
                function (event) {
                    let keycode = event.keyCode ? event.keyCode : event.which;
                    if (keycode == "13") {
                        event.preventDefault();
                        filterHTMLForm();
                    }
                }
            );
            // On click go button
            $("#tabulator-html-filter-go").on("click", function (event) {
                filterHTMLForm();
            });

            // On reset filter form
            $("#tabulator-html-filter-reset").on("click", function (event) {
                $("#tabulator-html-filter-field").val("name");
                $("#tabulator-html-filter-type").val("like");
                $("#tabulator-html-filter-value").val("");
                filterHTMLForm();
            });
            // Export
          
            $("#tabulator-export-json").on("click", function (event) {
                table.download("json", "data.json");
            });

            $("#tabulator-export-xlsx").on("click", function (event) {
               
                table.download("xlsx", "data.xlsx", {
                    sheetName: "Products",
                });
            });

           
            // Print
            $("#tabulator-print").on("click", function (event) {
                table.print();
            });
        },
    });
})();
