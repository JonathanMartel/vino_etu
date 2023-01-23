@extends ('layouts.master')

@section('content')


<div class="container  my-12 mx-auto px-4 md:px-12">


    <h1>ADMIN DASHBOARD</h1>
	<div class="flex flex-wrap -mx-1 lg:-mx-4 cursor-pointer mx-auto">
		<div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">
			<div class="max-w-sm rounded overflow-hidden shadow-lg border-4 border-transparent hover:border-indigo-900  transition duration-300 ease-in-out">
				<div class="px-6 py-4">
					<h3 class="font-regular text-black mt-2 mb-2">Total usagers</h3>
					<p class="text-gray-700 text-base">
						24
					</p>

					<div class="mt-5 pt-5">
						<a href="#!" class=" bg-red-800 hover:bg-red-500 text-white font-regular py-2 px-4 rounded text-sm w-full">Detail</a>
					</div>
				</div>
				<div class="px-6 py-4">

				</div>
			</div>
		</div>
		<div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">
			<div class="max-w-sm rounded overflow-hidden shadow-lg border-4 border-transparent hover:border-indigo-900  transition duration-300 ease-in-out">
				<div class="px-6 py-4">
					<h3 class="font-regular text-black mt-2 mb-2">Total Cellier</h3>
					<p class="text-gray-700 text-base">
						24
					</p>

					<div class="mt-5 pt-5">
						<a href="#!" class=" bg-red-800 hover:bg-red-500 text-white font-regular py-2 px-4 rounded text-sm w-full">Detail</a>
					</div>
				</div>
				<div class="px-6 py-4">

				</div>
			</div>
		</div>
		<div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">
			<div class="max-w-sm rounded overflow-hidden shadow-lg border-4 border-transparent hover:border-indigo-900  transition duration-300 ease-in-out">
				<div class="px-6 py-4">
					<h3 class="font-regular text-black mt-2 mb-2">Total Bouteil Vin</h3>
					<p class="text-gray-700 text-base">
						24
					</p>

					<div class="mt-5 pt-5">
						<a href="#!" class=" bg-red-800 hover:bg-red-500 text-white font-regular py-2 px-4 rounded text-sm w-full">Detail</a>
					</div>
				</div>
				<div class="px-6 py-4">

				</div>
			</div>
		</div>
	</div>
</div>




  <!-- component  Pour Gestion des Celliers pour chaque usager-->
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div>
                <h2 class="text-2xl font-semibold leading-tight">Gestion Cellier</h2>
            </div>
            <div class="my-2 flex sm:flex-row flex-col">
                <div class="flex flex-row mb-1 sm:mb-0">
                    <!-- Gestion des filtres -->
                    <div class="relative">
                        <select
                            class="appearance-none h-full rounded-l border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option>5</option>
                            <option>10</option>
                            <option>20</option>
                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">

                        </div>
                    </div>
                    <div class="relative">
                        <select
                            class="appearance-none h-full rounded-r border-t sm:rounded-r-none sm:border-r-0 border-r border-b block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:border-l focus:border-r focus:bg-white focus:border-gray-500">
                            <option>Quantité</option>
                        </select>


                    </div>
                </div>

                <!-- Section Crud Cellier -->
                <div class="block relative">
                    <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                        <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                            <path
                                d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                            </path>
                        </svg>
                    </span>
                    <input placeholder="Search"
                        class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
                </div>
            </div>
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Nom
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Quantité
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    DATE D'ACHAT
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    NOTE
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex items-center">

                                        {{-- Image svg par défaut pour les bouteilles --}}
                                        <svg width="50" height="100" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            viewBox="0 0 512 512" xml:space="preserve">
                                            <circle style="fill:#4AB8A1;" cx="256" cy="256" r="256"/>
                                            <path style="fill:#43A691;" d="M284,47.092c0-4.4-3.6-7.092-8-7.092h-8h-32c-4.4,0-8,3.6-8,8v2.048v2.048V88l8,28v80c0,0-14,0-20,0
                                                c-12,0-20,8-20,24c0,0.636,0,1.372,0,2.048c0,0.676,0,1.332,0,2.048c0,11.516,0,28.18,0,47.904c0,0.668,0,1.38,0,2.048
                                                s0,1.376,0,2.048c0,2.608,0,5.188,0,7.908c0,0.668,0,1.372,0,2.048c0,0.68,0,1.368,0,2.048c0,24.38,0,52.052,0,79.9
                                                c0,0.684,0,1.364,0,2.048c0,0.688,0,1.368,0,2.048c0,2.64,0,5.268,0,7.908c0,0.684,0,1.364,0,2.048c0,0.688,0,1.368,0,2.048
                                                c0,46.656,0,91.956,0,120.76c19.252,4.624,39.328,7.14,60,7.14c68.2,0,130.116-26.724,176-70.196L284,47.092z"/>
                                            <path style="fill:#1A1A1A;" d="M296,196c-6,0-20,0-20,0v-84h-40v84c0,0-14,0-20,0c-12,0-20,8-20,24c0,47.832,0,214.936,0,284.86
                                                c19.252,4.624,39.328,7.14,60,7.14s40.752-2.516,60-7.14c0-69.916,0-237.024,0-284.86C316,204,308,196,296,196z"/>
                                            <g>
                                                <path style="fill:#0D0D0D;" d="M264,112v84c0,0,6.116,0,12,0v-84H264z"/>
                                                <path style="fill:#0D0D0D;" d="M296,196c-2.936,0-7.804,0-12,0c12,0,20,8,20,24c0,48.428,0,219.152,0,287.436
                                                    c4.036-0.76,8.036-1.624,12-2.584c0-69.916,0-237.024,0-284.86C316,204,308,196,296,196z"/>
                                            </g>
                                            <path style="opacity:0.2;fill:#F5F5F5;enable-background:new    ;" d="M244,204h-16c-10.304,0-24,2.488-24,24v278.704
                                                c2.644,0.548,5.328,0.988,8,1.448V228c0-13.384,5.868-16,16-16h20c2.212,0,4-1.792,4-4v-72h-8V204z"/>
                                            <rect x="196" y="272" style="fill:#992B1F;" width="120" height="108"/>
                                            <rect x="196" y="284" style="fill:#FFE1D9;" width="120" height="84"/>
                                            <path style="fill:#CC584C;" d="M284,88c0,4.4-3.6,8-8,8h-40c-4.4,0-8-3.6-8-8V48c0-4.4,3.6-8,8-8h40c4.4,0,8,3.6,8,8V88z"/>
                                            <path style="fill:#BF5347;" d="M276,40h-8c4.4,0,8,3.6,8,8v40c0,4.4-3.6,8-8,8h8c4.4,0,8-3.6,8-8V48C284,43.6,280.4,40,276,40z"/>
                                            <rect x="236" y="96" style="fill:#CC584C;" width="40" height="16"/>
                                            <g>
                                                <rect x="268" y="96" style="fill:#BF5347;" width="8" height="16"/>
                                                <rect x="236" y="96" style="fill:#BF5347;" width="40" height="8"/>
                                            </g>
                                            <path style="fill:#E66356;" d="M240,88c-2.212,0-4-1.792-4-4V48c0-2.208,1.788-4,4-4s4,1.792,4,4v36C244,86.208,242.212,88,240,88z"/>
                                        </svg>

                                        <div class="ml-3">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                19 Crimes Cabernet-Sauvignon Limestone Coast
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">5</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        21 Janvier, 2023
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <span
                                        class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                        <span aria-hidden
                                            class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                        <span class="relative">10</span>
                                    </span>
                                </td>
                                {{-- Section Action Crud  --}}
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <a href="#"><svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600 hover:text-green-800"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5 13l4 4L19 7" />
                                      </svg></a>

                                      <a href="#"><svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-600 hover:text-red-800"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M6 18L18 6M6 6l12 12" />
                                      </svg></a>
                                </td>
                            </tr>


                        </tbody>
                    </table>

                    {{-- Section Pagination --}}
                    <div
                        class="px-5 py-9 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between          ">
                        <span class="text-xs xs:text-sm text--900">
                            Pagination 1 é 4 de 50 Entrées
                        </span>
                        <div class="inline-flex  mt-2 py-4 xs:mt-0">
                            <button
                                class="text-sm bg-red-800 hover:bg-red-300 text-white font-regular py-2 px-4 rounded-l">
                                Précedent
                            </button>
                            <button
                                class="text-sm bg-red-800 hover:bg-red-300 text-white font-regular py-2 px-4 rounded-r">
                                Prochain
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




  @endsection
