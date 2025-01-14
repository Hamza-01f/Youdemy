<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy Admin - Gestion des Utilisateurs</title>
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
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Total Utilisateurs</p>
                        <p class="text-2xl font-bold text-gray-800">4,521</p>
                    </div>
                    <div class="p-3 bg-blue-100 rounded-full">
                        <i class="fas fa-users text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Utilisateurs Actifs</p>
                        <p class="text-2xl font-bold text-gray-800">3,984</p>
                    </div>
                    <div class="p-3 bg-green-100 rounded-full">
                        <i class="fas fa-user-check text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Comptes Suspendus</p>
                        <p class="text-2xl font-bold text-gray-800">412</p>
                    </div>
                    <div class="p-3 bg-yellow-100 rounded-full">
                        <i class="fas fa-user-clock text-yellow-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Nouveaux (30j)</p>
                        <p class="text-2xl font-bold text-gray-800">125</p>
                    </div>
                    <div class="p-3 bg-purple-100 rounded-full">
                        <i class="fas fa-user-plus text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Management Table -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Gestion des Utilisateurs</h2>
                <div class="flex gap-4">
                    <select class="p-2 border border-gray-300 rounded-lg">
                        <option>Tous les rôles</option>
                        <option>Étudiant</option>
                        <option>Enseignant</option>
                        <option>Admin</option>
                    </select>
                    <select class="p-2 border border-gray-300 rounded-lg">
                        <option>Tous les statuts</option>
                        <option>Actif</option>
                        <option>Suspendu</option>
                        <option>Inactif</option>
                    </select>
                    <input type="text" placeholder="Rechercher un utilisateur..." 
                           class="p-2 border border-gray-300 rounded-lg w-64">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-gray-700">Utilisateur</th>
                            <th class="px-6 py-3 text-left text-gray-700">Rôle</th>
                            <th class="px-6 py-3 text-left text-gray-700">Date d'inscription</th>
                            <th class="px-6 py-3 text-left text-gray-700">Dernière connexion</th>
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
                                        <div class="font-medium">Jean Dupont</div>
                                        <div class="text-sm text-gray-500">jean.dupont@email.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full">Étudiant</span>
                            </td>
                            <td class="px-6 py-4">15/12/2023</td>
                            <td class="px-6 py-4">Il y a 2 heures</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full">Actif</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <button class="text-yellow-600 hover:text-yellow-800" title="Suspendre">
                                        <i class="fas fa-pause"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-800" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <img src="/api/placeholder/40/40">
          <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <img src="/api/placeholder/40/40" class="rounded-full mr-3" alt="Profile">
                                    <div>
                                        <div class="font-medium">Marie Lefevre</div>
                                        <div class="text-sm text-gray-500">marie.lefevre@email.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full">Enseignant</span>
                            </td>
                            <td class="px-6 py-4">02/11/2022</td>
                            <td class="px-6 py-4">Il y a 3 jours</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full">Suspendu</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <button class="text-green-600 hover:text-green-800" title="Activer">
                                        <i class="fas fa-check-circle"></i>
                                    </button>
                                    <button class="text-yellow-600 hover:text-yellow-800" title="Suspendre">
                                        <i class="fas fa-pause"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-800" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <img src="/api/placeholder/40/40" class="rounded-full mr-3" alt="Profile">
                                    <div>
                                        <div class="font-medium">Thomas Dupuis</div>
                                        <div class="text-sm text-gray-500">thomas.dupuis@email.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full">Admin</span>
                            </td>
                            <td class="px-6 py-4">25/08/2020</td>
                            <td class="px-6 py-4">Il y a 1 semaine</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full">Actif</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <button class="text-green-600 hover:text-green-800" title="Activer">
                                        <i class="fas fa-check-circle"></i>
                                    </button>
                                    <button class="text-yellow-600 hover:text-yellow-800" title="Suspendre">
                                        <i class="fas fa-pause"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-800" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <footer class="bg-gray-800 text-white py-4">
        <div class="container mx-auto text-center">
            <p>&copy; 2025 Youdemy. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>
