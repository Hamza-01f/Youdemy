<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy Admin - Gestion des Contenus</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-gray-800 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Youdemy Admin</h1>
            <div class="space-x-4">
                <span class="font-medium">Admin: Sarah Martin</span>
                <button class="bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded-lg">
                    <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                </button>
            </div>
        </div>
    </nav>

    <main class="container mx-auto p-6">
        <!-- Tabs -->
        <div class="bg-white rounded-lg shadow-lg mb-6">
            <div class="border-b">
                <nav class="flex space-x-8 px-6" aria-label="Tabs">
                    <button class="px-3 py-4 text-sm font-medium text-indigo-600 border-b-2 border-indigo-600">
                        Cours
                    </button>
                    <button class="px-3 py-4 text-sm font-medium text-gray-500 hover:text-gray-700">
                        Catégories
                    </button>
                    <button class="px-3 py-4 text-sm font-medium text-gray-500 hover:text-gray-700">
                        Tags
                    </button>
                </nav>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <button class="w-full bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 flex items-center justify-center">
                    <i class="fas fa-plus mr-2"></i>Ajouter un Cours
                </button>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <button class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 flex items-center justify-center">
                    <i class="fas fa-folder-plus mr-2"></i>Nouvelle Catégorie
                </button>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <button class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 flex items-center justify-center">
                    <i class="fas fa-tags mr-2"></i>Gérer les Tags
                </button>
            </div>
        </div>

        <!-- Content Management -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Gestion des Cours</h2>
                <div class="flex gap-4">
                    <select class="p-2 border border-gray-300 rounded-lg">
                        <option>Toutes les catégories</option>
                        <option>Développement Web</option>
                        <option>Design</option>
                        <option>Marketing</option>
                    </select>
                    <select class="p-2 border border-gray-300 rounded-lg">
                        <option>Tous les statuts</option>
                        <option>Publié</option>
                        <option>Brouillon</option>
                        <option>En révision</option>
                    </select>
                    <input type="text" placeholder="Rechercher un cours..." 
                           class="p-2 border border-gray-300 rounded-lg w-64">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-gray-700">Cours</th>
                            <th class="px-6 py-3 text-left text-gray-700">Catégorie</th>
                            <th class="px-6 py-3 text-left text-gray-700">Tags</th>
                            <th class="px-6 py-3 text-left text-gray-700">Enseignant</th>
                            <th class="px-6 py-3 text-left text-gray-700">Statut</th>
                            <th class="px-6 py-3 text-left text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <img src="/api/placeholder/48/36" class="rounded mr-3" alt="Course">
                                    <div>
                                        <div class="font-medium">Introduction à JavaScript</div>
                                        <div class="text-sm text-gray-500">Mis à jour il y a 2 jours</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">Développement Web</td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-2">
                                    <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded-full text-sm">JavaScript</span>
                                    <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded-full text-sm">Frontend</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">Marie Dubois</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full">Publié</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <button class="text-blue-600 hover:text-blue-800" title="Éditer">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-yellow-600 hover:text-yellow-800" title="Désactiver">
                                        <i class="fas fa-pause"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-800" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <!-- Add more course rows as needed -->
                    </tbody>
                </table>
            </div>

            <!-- Categories Section (Initially Hidden) -->
            <div class="hidden">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-lg shadow border">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-bold">Développement Web</h3>
                            <div class="flex space-x-2">
                                <button class="text-blue-600"><i class="fas fa-edit"></i></button>
                                <button class="text-red-600"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm mb-2">45 cours</p>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: 75%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tags Section (Initially Hidden) -->
            <div class="hidden">
                <div class="flex flex-wrap gap-4">
                    <div class="bg-white p-4 rounded-lg shadow border flex items-center space-x-4">
                        <span class="font-medium">JavaScript</span>
                        <span class="text-sm text-gray-500">(124 cours)</span>
                        <div class="flex space-x-2">
                            <button class="text-blue-600"><i class="fas fa-edit"></i></button>
                            <button class="text-red-600"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="flex justify-between items-center mt-6">
                <div class="text-gray-600">
                    Affichage de 1-10 sur 48 cours
                </div>
                <div class="flex space-x-2">
                    <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Précédent</button>
                    <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">1</button>
                    <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">2</button>
                    <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">3</button>
                    <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Suivant</button>
                </div>
            </div>
        </div>
    </main>
</body>