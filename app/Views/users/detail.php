<?= $this->extend('_layouts/main') ?>

<?= $this->section('content') ?>
<div x-data="{ ...detailFetcher('/api/users/<?= esc($id) ?>'), editMode: false, user: { username: '', email: '' } }" 
     x-init="init().then(() => { user.username = data.username; user.email = data.email })">
    
    <?= $this->include('_partials/page_header', [
        'title'       => 'Detail User',
        'breadcrumbs' => [
            ['label' => 'Dashboard', 'url' => '/dashboard'], 
            ['label' => 'Users', 'url' => '/users'],
            ['label' => 'Detail']
        ]
    ]) ?>

    <!-- Loading -->
    <div x-show="loading" class="mt-6 text-gray-500">Memuat detail user...</div>

    <!-- Detail & Edit Forms -->
    <div x-show="!loading" class="mt-6 space-y-6" style="display: none;">
        
        <!-- View Mode -->
        <div x-show="!editMode" class="bg-white rounded-lg shadow border border-gray-200 p-6 dark:bg-gray-800 dark:border-gray-700 relative">
            <button @click="editMode = true" class="absolute top-6 right-6 text-blue-600 hover:underline">Edit</button>
            <h3 class="text-lg font-medium text-gray-900 mb-4 dark:text-white">Informasi User</h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">Username</span>
                    <span class="block mt-1 text-gray-900 dark:text-white" x-text="data.username"></span>
                </div>
                <div>
                    <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">Email</span>
                    <span class="block mt-1 text-gray-900 dark:text-white" x-text="data.email"></span>
                </div>
            </div>
            
            <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700" x-data="confirmDialog()">
                <button type="button" @click="open('Apakah Anda yakin ingin menghapus user ini?', async () => { 
                    try { 
                        await api.delete('/api/users/<?= esc($id) ?>'); 
                        window.location.href = '/users'; 
                    } catch (e) { 
                        errorHandler.catch(e); 
                    }
                })" class="text-red-600 hover:text-red-800 text-sm font-medium focus:outline-none">Hapus User</button>
                <?= $this->include('_partials/confirm_dialog') ?>
            </div>
        </div>

        <!-- Edit Mode -->
        <div x-show="editMode" class="bg-white rounded-lg shadow border border-gray-200 p-6 dark:bg-gray-800 dark:border-gray-700">
            <h3 class="text-lg font-medium text-gray-900 mb-4 dark:text-white">Edit User</h3>
            <form x-data="formHandler('/api/users/<?= esc($id) ?>', 'PUT')" 
                  @submit.prevent="submit(user).then(() => { if (Object.keys(errors).length === 0) { data.username = user.username; data.email = user.email; editMode = false; errorHandler.show('User berhasil diupdate', 'info'); } })">
                <div class="space-y-4 max-w-md">
                    <div>
                        <label for="edit_username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                        <input type="text" id="edit_username" x-model="user.username" :class="{ 'border-red-500': errors.username }" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                        <span x-show="errors.username" x-text="errors.username" class="text-sm text-red-600 mt-1 block"></span>
                    </div>
                    <div>
                        <label for="edit_email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" id="edit_email" x-model="user.email" :class="{ 'border-red-500': errors.email }" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                        <span x-show="errors.email" x-text="errors.email" class="text-sm text-red-600 mt-1 block"></span>
                    </div>
                    
                    <div class="flex items-center gap-3">
                        <button type="submit" :disabled="isSubmitting" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center disabled:opacity-50">
                            <span x-show="isSubmitting">Menyimpan...</span>
                            <span x-show="!isSubmitting">Simpan</span>
                        </button>
                        <button type="button" @click="editMode = false; user.username = data.username; user.email = data.email" class="text-gray-700 bg-white hover:bg-gray-50 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-300 text-sm font-medium px-5 py-2.5 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
<?= $this->endSection() ?>
