<?= $this->extend('_layouts/main') ?>

<?= $this->section('content') ?>
<?= $this->include('_partials/page_header', [
    'title'       => 'Tambah User',
    'breadcrumbs' => [
        ['label' => 'Dashboard', 'url' => '/dashboard'], 
        ['label' => 'Users', 'url' => '/users'],
        ['label' => 'Tambah']
    ]
]) ?>

<div class="mt-6 bg-white rounded-lg shadow border border-gray-200 dark:bg-gray-800 dark:border-gray-700 p-6">
    <form x-data="{ ...formHandler('/api/users', 'POST', '/users'), user: { username: '', email: '', password: 'password123' } }" @submit.prevent="submit(user)">
        <div class="space-y-4 max-w-md">
            <div>
                <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                <input type="text" id="username" x-model="user.username" :class="{ 'border-red-500 focus:ring-red-500 focus:border-red-500': errors.username }" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                <span x-show="errors.username" x-text="errors.username" class="text-sm text-red-600 mt-1 block"></span>
            </div>
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                <input type="email" id="email" x-model="user.email" :class="{ 'border-red-500 focus:ring-red-500 focus:border-red-500': errors.email }" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                <span x-show="errors.email" x-text="errors.email" class="text-sm text-red-600 mt-1 block"></span>
            </div>
            
            <button type="submit" :disabled="isSubmitting" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 disabled:opacity-50">
                <span x-show="isSubmitting">Menyimpan...</span>
                <span x-show="!isSubmitting">Simpan</span>
            </button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
