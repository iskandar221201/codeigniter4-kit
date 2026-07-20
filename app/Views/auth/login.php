<?= $this->extend('_layouts/auth') ?>

<?= $this->section('content') ?>
<div class="flex items-center justify-center min-h-screen bg-gray-50 dark:bg-gray-900">
    <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-lg shadow dark:bg-gray-800">
        <h2 class="text-2xl font-bold text-center text-gray-900 dark:text-white">Login</h2>
        
        <form 
            x-data="{
                ...formHandler('/api/auth/login', 'POST'),
                email: '',
                password: '',
                generalError: '',
                async doLogin() {
                    this.isSubmitting = true;
                    this.errors = {};
                    this.generalError = '';
                    try {
                        const formData = { email: this.email, password: this.password };
                        const data = await api.post('/api/auth/login', formData);
                        auth.setToken(data.token);
                        auth.setUsername(data.username || data.email || '');
                        window.location.href = '/dashboard';
                    } catch (err) {
                        if (err?.errors) {
                            this.errors = err.errors;
                        } else {
                            this.generalError = err?.message || 'Email atau password salah.';
                        }
                    } finally {
                        this.isSubmitting = false;
                    }
                }
            }" 
            @submit.prevent="doLogin()"
            class="space-y-4"
        >
            <!-- Email Field -->
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    x-model="email"
                    :class="{ 'border-red-500 focus:ring-red-500 focus:border-red-500': errors.email }"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                    required
                >
                <span x-show="errors.email" x-text="errors.email" class="text-sm text-red-600 dark:text-red-500 mt-1 block"></span>
            </div>
            
            <!-- Password Field -->
            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    x-model="password"
                    :class="{ 'border-red-500 focus:ring-red-500 focus:border-red-500': errors.password }"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                    required
                >
                <span x-show="errors.password" x-text="errors.password" class="text-sm text-red-600 dark:text-red-500 mt-1 block"></span>
            </div>
            
            <!-- General Error -->
            <div x-show="generalError" x-text="generalError" class="p-3 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-900 dark:text-red-300"></div>

            <!-- Submit Button -->
            <button 
                type="submit" 
                :disabled="isSubmitting"
                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 disabled:opacity-50 disabled:cursor-not-allowed"
            >
                <span x-show="isSubmitting">Loading...</span>
                <span x-show="!isSubmitting">Login</span>
            </button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
