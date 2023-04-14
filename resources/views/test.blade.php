<div class="flex flex-col mt-10 lg:flex-row pb-5 -mx-5">

<div class="flex flex-1 px-5 items-center justify-center lg:justify-start">

    <div class="validate-form flex flex-col-reverse xl:flex-row flex-col">

        <div class="flex-1 mt-6 xl:mt-6">
            <div class="grid grid-cols-12 gap-x-5">

                <div class="col-span-12 2xl:col-span-6">

                    <div class="intro-y col-span-2 sm:col-span-1">
                        <label for="num_passeport" class="form-label">N°passeport</label>
                        <input id="num_passeport" name="num_passeport" type="number" min="0" placeholder="Entrer N°passeport" class="form-control" required>
                    </div>

                    <div class="intro-y col-span-2 sm:col-span-2">
                        <label for="date_obtention_visa" class="form-label">Date d'obtention Visa</label>
                        <input id="date_obtention_visa" name="date_obtention_visa" type="date" class="form-control" required>
                    </div>

                    <div class="intro-y col-span-2 sm:col-span-2">
                        <label for="num_visa" class="form-label">N°Visa</label>
                        <input id="num_visa" name="num_visa" type="number" min="0" placeholder="Entrer N°Visa" class="form-control" required>
                    </div>

                </div>

                <div class="col-span-12 2xl:col-span-6">

                    <div class="intro-y col-span-2 sm:col-span-2">
                        <label for="date_delivrance" class="form-label">Date délivrance</label>
                        <input id="date_delivrance" name="date_delivrance" type="date" class="form-control" required>
                    </div>

                    <div class="intro-y col-span-2 sm:col-span-2">
                        <label for="etat_passeport" class="form-label">Etat passeport</label>
                        <select id="etat_passeport" name="etat_passeport" data-placeholder="Sélectionnez Situation familiale" class="form-control w-full">
                            <option value="1">En Cours</option>
                            <option value="2">Au Consulat</option>
                            <option value="3">Visé</option>
                            <option value="4">Passe Remis</option>
                            <option value="5">Sans Visa</option>
                        </select>
                    </div>

                    <div class="intro-y col-span-2 sm:col-span-2">
                        <label for="Province" class="form-label">Province</label>
                        <input id="Province" name="Province" type="text" placeholder="Entrer Province" class="form-control" required>
                    </div>

                </div>

            </div>
        </div>
        <div class="grid grid-cols-2 gap-x-5"></div>
        <div class="flex-1 mt-6 xl:mt-6">
            <div class="grid grid-cols-12 gap-x-5">

                <div class="col-span-12 2xl:col-span-6">

                    <div class="intro-y col-span-2 sm:col-span-2">
                        <label for="date_expiration_visa" class="form-label">Date d'expiration</label>
                        <input id="date_expiration_visa" name="date_expiration_visa" type="date" class="form-control" required>
                    </div>

                    <div class="intro-y col-span-2 sm:col-span-2">
                        <label for="Num_Inscription" class="form-label">N°Inscription(HAJ)</label>
                        <input id="Num_Inscription" name="Num_Inscription" type="text" placeholder="Entrer N°Inscription" class="form-control" required>
                    </div>

                    <div class="intro-y col-span-2 sm:col-span-2">
                        <label for="Type_visa" class="form-label">Type de visa</label>
                        <select id="Type_visa" name="Type_visa" data-search="true" class="form-control w-full" required>
                        </select>
                    </div>

                </div>

                <div class="col-span-12 2xl:col-span-6">

                    <div class="intro-y col-span-2 sm:col-span-2">
                        <label for="Lieu_delivrance" class="form-label">Lieu de délivrance(محل الاصدار)</label>
                        <input id="Lieu_delivrance" name="Lieu_delivrance" type="text" class="form-control" required>
                    </div>

                    <div class="intro-y col-span-2 sm:col-span-2">
                        <label for="num_agence" class="form-label">Agence</label>
                        <select id="code_societe" name="num_agence" data-search="true" class="form-control w-full" required>
                        </select>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
        <div class="border-2 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
            <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                <img class="rounded-md" id="img_passp" alt="Sélectionnez votre image" src="{{ asset('build/assets/images/update_img.jpg') }}">
                <div title="Remove this profile photo?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="mx-auto cursor-pointer relative mt-5">
                <button type="button" class="btn w-full" style="background-color: #015C92; color: #ffffff;">Change Photo</button>
                <input type="file" accept="image/*" id="img_pass" name="img_pass" class="w-full h-full top-0 left-0 absolute opacity-0">
            </div>
        </div>
    </div>

</div>

</div>
