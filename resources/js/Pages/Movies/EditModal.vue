<template>

<div class="fixed z-10 inset-0 overflow-y-auto max-h-screen" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center max-h-screen text-center sm:block mx-4 sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block max-h-screen h-100 align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:align-middle sm:max-w-7xl sm:w-full sm:p-6">
            <div class="bg-white overflow-hidden flex">

            <!-- Sidebar -->
            <div class="hidden md:flex md:flex-shrink-0">
                <div class="w-64 flex flex-col">
                    <div class="border-r border-gray-200 pt-5 pb-4 flex flex-col flex-grow overflow-y-auto">

                        <!-- Title -->
                        <div class="flex-shrink-0 px-4 flex items-center">
                            <h2 class="h-8 w-auto font-bold text-xl">Movies</h2>
                        </div>

                        <!-- Sub-Page Links -->
                        <div class="flex-grow mt-5 flex flex-col">
                            <nav class="flex-1 bg-white px-2 space-y-1">

                                <!-- Movie Details -->
                                <a href="#" class="bg-gray-100 text-gray-900 group rounded-md py-2 px-2 flex items-center text-sm font-medium">
                                    <svg class="text-gray-500 mr-3 flex-shrink-0 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                                    Details
                                </a>

                                <a href="#" class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group rounded-md py-2 px-2 flex items-center text-sm font-medium">
                                    <svg class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                    Posters
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--  Body -->
            <div class="flex-1 max-w-4xl mx-auto w-0 flex flex-col md:px-8 xl:px-0">

                <!-- Open Sidebar Button (Mobile) -->
                <button class="border-r border-gray-200 px-4 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 md:hidden">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" /></svg>
                </button>

                <!-- Viewport -->
                <main class="flex-1 relative overflow-y-auto focus:outline-none">
                    <div class="py-6">
                        <div class="px-4 sm:px-6 md:px-0">
                            <h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>
                        </div>
                        <div class="px-4 sm:px-6 md:px-0">
                            <!-- Replace with your content -->
                            <div class="py-4">
                                <div class="h-96 border-4 border-dashed border-gray-200 rounded-lg"></div>
                            </div>
                            <!-- /End replace -->
                        </div>
                    </div>
                </main>
            </div>
            </div>
        </div>
    </div>
</div>

</template>

<script>
export default {
    
}
</script>