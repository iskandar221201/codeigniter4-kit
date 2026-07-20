<?= $this->extend('_layouts/main') ?>

<?= $this->section('content') ?>
<?= $this->include('_partials/page_header', [
    'title'       => 'Dashboard',
    'breadcrumbs' => [['label' => 'Dashboard']]
]) ?>

<div class="mt-6 bg-white rounded-lg shadow border border-gray-200 p-6 dark:bg-gray-800 dark:border-gray-700">
    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Selamat Datang di Dashboard!</h2>
    <p class="text-gray-600 dark:text-gray-400">
        Anda telah berhasil login. Ini adalah halaman dashboard utama.
    </p>
</div>
<?= $this->endSection() ?>
