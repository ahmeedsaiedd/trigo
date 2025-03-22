@extends('admin.layouts.app')

@section('title', 'Add Product | Trigo')

@section('content')
    <div class="mb-8">
        <h2 class="my-6 text-3xl font-bold text-gray-800 dark:text-gray-100">Add New Product</h2>
        <p class="text-gray-600 dark:text-gray-400">Fill out the form below to create a new product.</p>
    </div>

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-lg">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Container -->
    <div class="w-full bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Product Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                        required placeholder="Enter product name">
                </div>

                <!-- SKU (Disabled with Real-Time Preview) -->
                <div>
                    <label for="sku" class="block text-sm font-medium text-gray-700 dark:text-gray-300">SKU</label>
                    <input type="text" name="sku" id="sku" value="" disabled
                        class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-400 cursor-not-allowed">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">SKU is auto-generated based on product name.</p>
                </div>

                <!-- Price (EGP) -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Price (EGP)</label>
                    <input type="number" name="price" id="price" step="0.01" value="{{ old('price') }}"
                        class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                        required placeholder="e.g., 299.99">
                </div>

                <!-- After Sale Price (EGP) -->
                <div>
                    <label for="after_sale_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">After Sale Price (EGP)</label>
                    <input type="number" name="after_sale_price" id="after_sale_price" step="0.01" value="{{ old('after_sale_price') }}"
                        class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                        placeholder="e.g., 199.99 (optional)">
                </div>

                <!-- Stock -->
                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Stock Quantity</label>
                    <input type="number" name="stock" id="stock" value="{{ old('stock') }}"
                        class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                        required placeholder="e.g., 100">
                </div>

                <!-- Category -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                    <select name="category_id" id="category_id"
                        class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                        required>
                        <option value="">Select a category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Colors (Multi-Checkbox) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Colors (Optional)</label>
                    <div class="mt-2 space-y-2">
                        @foreach (['Red', 'Blue', 'Green', 'Black', 'White'] as $color)
                            <div class="flex items-center">
                                <input type="checkbox" name="colors[]" id="color_{{ strtolower($color) }}" value="{{ $color }}"
                                    {{ in_array($color, old('colors', [])) ? 'checked' : '' }}
                                    class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                                <label for="color_{{ strtolower($color) }}" class="ml-2 text-sm text-gray-700 dark:text-gray-300">{{ $color }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Sizes (Multi-Checkbox) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sizes (Optional)</label>
                    <div class="mt-2 space-y-2">
                        @foreach (['S', 'M', 'L', 'XL', 'XXL'] as $size)
                            <div class="flex items-center">
                                <input type="checkbox" name="sizes[]" id="size_{{ strtolower($size) }}" value="{{ $size }}"
                                    {{ in_array($size, old('sizes', [])) ? 'checked' : '' }}
                                    class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                                <label for="size_{{ strtolower($size) }}" class="ml-2 text-sm text-gray-700 dark:text-gray-300">{{ $size }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                    <select name="status" id="status"
                        class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                        required>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                </div>

                <!-- Warranty -->
                <div>
                    <label for="warranty" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Warranty (Months)</label>
                    <input type="number" name="warranty" id="warranty" value="{{ old('warranty') }}"
                        class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                        placeholder="e.g., 12 (optional)">
                </div>

                <!-- Is Featured -->
                <div class="flex items-center">
                    <label for="is_featured" class="text-sm font-medium text-gray-700 dark:text-gray-300 mr-3">Is Featured?</label>
                    <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                        class="h-5 w-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                </div>
            </div>

            <!-- Description (Plain Textarea) -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                <textarea name="description" id="description"
                    class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                    rows="5" placeholder="Describe your product...">{{ old('description') }}</textarea>
            </div>

            <!-- Main Image -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Main Image</label>
                <input type="file" name="image" id="image"
                    class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-200 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-600 dark:file:text-gray-200 dark:hover:file:bg-gray-500 transition duration-200"
                    required>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">JPEG, PNG, JPG (max 20MB)</p>
            </div>

            <!-- Gallery Images -->
            <div>
                <label for="gallery" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gallery Images (Optional)</label>
                <input type="file" name="gallery[]" id="gallery" multiple
                    class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-200 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-600 dark:file:text-gray-200 dark:hover:file:bg-gray-500 transition duration-200">
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">JPEG, PNG, JPG (max 2MB each)</p>
            </div>

            <!-- Submit Button with Hover -->
            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-800 hover:shadow-lg transition duration-300 ease-in-out">
                    Save Product
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        // Real-Time SKU Generation
        document.addEventListener('DOMContentLoaded', function () {
            const nameInput = document.getElementById('name');
            const skuInput = document.getElementById('sku');

            function generateSKU(name) {
                if (!name) {
                    skuInput.value = 'SKU-XXXX-XXXXXXXXXX'; // Default placeholder
                    return;
                }
                const namePrefix = name.slice(0, 3).toUpperCase(); // First 3 letters of name
                const randomString = Math.random().toString(36).substr(2, 4).toUpperCase(); // 4-char random
                const timestamp = Math.floor(Date.now() / 1000); // Unix timestamp
                skuInput.value = `SKU-${namePrefix}-${randomString}-${timestamp}`;
            }

            // Initial SKU based on old value (if any)
            generateSKU(nameInput.value);

            // Update SKU on name input
            nameInput.addEventListener('input', function () {
                generateSKU(this.value);
            });
        });
    </script>
@endpush