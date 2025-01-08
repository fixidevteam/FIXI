<x-app-layout :subtitle="'C’est quoi fixi+'">
    <div class="p-4 sm:ml-64">
        <div class="p-2 border-2 border-gray-200 border-dashed rounded-lg mt-14">
            {{-- content (slot on layouts/app.blade.php)--}}
            <nav
                class="flex px-5 py-3 text-gray-700 bg-white overflow-hidden shadow-sm sm:rounded-lg "
                aria-label="Breadcrumb">
                <ol
                    class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a
                            href="{{ route('dashboard') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-700">
                            Accueil
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg
                                class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400"
                                aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 6 10">
                                <path
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m1 9 4-4-4-4" />
                            </svg>
                            <a
                                href="{{ route('fixiPlus.index') }}"
                                class="inline-flex items-center text-sm font-medium text-gray-700">
                                C'est quoi FIXI+
                            </a>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        {{-- content --}}
        <div class="p-2 border-2 border-gray-200 border-dashed rounded-lg mt-4">
            <div class="px-5 py-3 text-gray-700 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-between items-center my-6">
                    <h2 class="text-2xl font-bold leading-9 tracking-tight text-gray-900">C'est quoi FIXI+ ?</h2>
                </div>
                {{--  --}}
                <div>
                    <p class="text-gray-700 mb-6">
                        <strong>Bienvenue sur FIXI+</strong>, votre plateforme dédiée à la gestion simplifiée de vos besoins automobiles et administratifs.
                    </p>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Avec FIXI+, accédez à une gamme complète de services conçus pour vous offrir une expérience fluide et intuitive :</h2>
                    <ul class="list-disc list-inside text-gray-700 space-y-2">
                        <li>
                            <strong>Gérez vos documents :</strong> Ajoutez, organisez et suivez vos papiers personnels et administratifs, ainsi que ceux de votre véhicule. Recevez des alertes pour les échéances importantes.
                        </li>
                        <li>
                            <strong>Découvrez nos garages partenaires :</strong> Trouvez facilement des garages de confiance dans votre ville et bénéficiez de services de qualité adaptés à vos besoins.
                        </li>
                        <li>
                            <strong>Optimisez vos démarches :</strong> Simplifiez la gestion de vos opérations d’entretien et de réparation grâce à des outils intuitifs et performants.
                        </li>
                    </ul>
                    <h2 class="text-xl font-semibold text-gray-800 mt-6 mb-4">Pourquoi choisir FIXI+ ?</h2>
                    <ul class="list-disc list-inside text-gray-700 space-y-2">
                        <li><strong>Simplicité et praticité :</strong> Tout ce dont vous avez besoin est réuni sur une seule plateforme.</li>
                        <li><strong>Gain de temps :</strong> Localisez les garages les plus proches et suivez vos opérations en un clic.</li>
                        <li><strong>Confiance et fiabilité :</strong> Collaborations avec des garages agréés et des professionnels qualifiés.</li>
                    </ul>
                    <p class="text-gray-700 mt-6">
                        Rejoignez la communauté FIXI+ dès aujourd’hui et profitez d’une gestion moderne, intelligente et connectée de vos services automobiles !
                    </p>
                </div>
                {{--  --}}
            </div>
        {{-- contet close colse --}}
    </div>
    {{-- footer --}}
    <div class="p-2 border-2 border-gray-200 border-dashed rounded-lg mt-4">
        @include('layouts.footer')
    </div>
    </div>
</x-app-layout>