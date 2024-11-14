<aside class="relative bg-sidebar h-screen w-60 hidden sm:block shadow-xl">
    <div class="p-6">
        <a href="#" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
        <button
            class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 hover:scale-105 transform transition-transform duration-200 flex items-center justify-center">
            <i class="fas fa-plus mr-3"></i> <a href="javascript:void(0)" id="create-new-product">New Tiket</a>
        </button>
    </div>
    <nav class="text-white text-base font-semibold pt-3">
        <a href="{{ route('admin') }}" class="flex items-center  text-white py-4 pl-6 nav-item">
            <i class="fas fa-tachometer-alt mr-2"></i>
            Dashboard
        </a>
        <a href="{{ route('user') }}" class="flex items-center  text-white py-4 pl-6 nav-item">
            <i class="fas fa-sticky-note mr-2"></i>
            User Management
        </a>


    </nav>

</aside>
