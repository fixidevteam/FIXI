<x-mechanic-app-layout>
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
                            href="{{ route('mechanic.dashboard') }}"
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
                                href="{{ route('mechanic.chart') }}"
                                class="inline-flex items-center text-sm font-medium text-gray-700">
                                Analytique
                            </a>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        {{-- content --}}
        <div class="p-2 border-2 border-gray-200 border-dashed rounded-lg mt-4">
            {{-- content (slot on layouts/app.blade.php)--}}
            <div class=" px-5 py-3 text-gray-700 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="mt-10 text-2xl font-bold leading-9 tracking-tight text-gray-900">Analytique</h2>
                <div class="container">
                    <h2 class="text-sm md:text-base">Suivi des opérations et des clients (3 derniers mois)</h2>
                    <div class="my-4">
                        <canvas id="operationsChart"></canvas>
                        <canvas id="clientsChart" class="mt-4"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- contet close colse --}}
        {{-- footer --}}
        <div class="p-2 border-2 border-gray-200 border-dashed rounded-lg mt-4">
            @include('layouts.footer')
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            fetch("{{ route('mechanic.analytics.data') }}")
                .then(response => response.json())
                .then(data => {
                    const months = ['Janv', 'Fév', 'Mars', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sept', 'Oct', 'Nov', 'Déc'];
                    
                    // Prepare data for operations chart
                    const operationsData = data.operations.map(op => ({
                        month: months[op.month - 1],
                        total: op.total_operations
                    }));
                    
                    const clientsData = data.clients.map(cl => ({
                        month: months[cl.month - 1],
                        total: cl.total_clients
                    }));
        
                    const operationLabels = operationsData.map(op => op.month);
                    const operationCounts = operationsData.map(op => op.total);
        
                    const clientLabels = clientsData.map(cl => cl.month);
                    const clientCounts = clientsData.map(cl => cl.total);
        
                    // Operations chart
                    new Chart(document.getElementById('operationsChart'), {
                        type: 'bar',
                        data: {
                            labels: operationLabels,
                            datasets: [{
                                label: 'Opérations effectuées',
                                data: operationCounts,
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
        
                    // Clients chart
                    new Chart(document.getElementById('clientsChart'), {
                        type: 'line',
                        data: {
                            labels: clientLabels,
                            datasets: [{
                                label: 'Clients servis',
                                data: clientCounts,
                                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                                borderColor: 'rgba(153, 102, 255, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });
        });
        </script>
</x-mechanic-app-layout>