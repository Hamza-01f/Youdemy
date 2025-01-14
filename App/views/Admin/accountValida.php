<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy Admin - Validation des Enseignants</title>
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
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Validation des Comptes Enseignants</h2>
                <div class="flex gap-4">
                    <select class="p-2 border border-gray-300 rounded-lg">
                        <option>Tous les statuts</option>
                        <option>En attente</option>
                        <option>Validé</option>
                        <option>Rejeté</option>
                    </select>
                    <input type="text" placeholder="Rechercher un enseignant..." 
                           class="p-2 border border-gray-300 rounded-lg w-64">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-gray-700">Enseignant</th>
                            <th class="px-6 py-3 text-left text-gray-700">Spécialité</th>
                            <th class="px-6 py-3 text-left text-gray-700">Date de demande</th>
                            <th class="px-6 py-3 text-left text-gray-700">Documents</th>
                            <th class="px-6 py-3 text-left text-gray-700">Statut</th>
                            <th class="px-6 py-3 text-left text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <img src="/api/placeholder/40/40" class="rounded-full mr-3" alt="Profile">
                                    <div>
                                        <div class="font-medium">Marie Dubois</div>
                                        <div class="text-sm text-gray-500">marie.dubois@email.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">Développement Web</td>
                            <td class="px-6 py-4">12/01/2024</td>
                            <td class="px-6 py-4">
                                <button class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-file-pdf mr-1"></i>Voir CV
                                </button>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full">En attente</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <button class="bg-green-500 text-white px-3 py-1 rounded-lg hover:bg-green-600">
                                        Valider
                                    </button>
                                    <button class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600">
                                        Rejeter
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <img src="/api/placeholder/40/40" class="rounded-full mr-3" alt="Profile">
                                    <div>
                                        <div class="font-medium">Pierre Martin</div>
                                        <div class="text-sm text-gray-500">pierre.martin@email.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">Data Science</td>
                            <td class="px-6 py-4">11/01/2024</td>
                            <td class="px-6 py-4">
                                <button class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-file-pdf mr-1"></i>Voir CV
                                </button>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full">Validé</span>
                            </td>
                            <td class="px-6 py-4">
                                <button class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600">
                                    Révoquer
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="flex justify-between items-center mt-6">
                <div class="text-gray-600">
                    Affichage de 1-10 sur 25 demandes
                </div>
                <div class="flex space-x-2">
                    <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Précédent</button>
                    <button class="px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700">1</button>
                    <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">2</button>
                    <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">3</button>
                    <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Suivant</button>
                </div>
            </div>
        </div>
    </main>
</body>
</html>