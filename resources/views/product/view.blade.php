<x-app-layout>
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            
            <!-- Header -->
            <div class="p-6 text-gray-200">
                <div class="flex items-center justify-between mb-6">
                    <a href="{{ route('product.index') }}" 
                       class="inline-flex items-center gap-3 text-gray-400 hover:text-gray-200 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Kembali
                    </a>
                </div>

                <h2 class="text-2xl font-bold text-gray-100 tracking-tight">Detail Product</h2>
                <p class="text-sm text-gray-400 mt-1">
                    #{{ $product->id }} | Viewing product
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end gap-3 px-6 pb-6">
                @can('update', $product)
                <a href="{{ route('product.edit', $product) }}" 
                   class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium rounded-lg border border-amber-500/50 text-amber-500 hover:bg-amber-500/10 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    Edit
                </a>
                @endcan

                @can('delete', $product)
                <form action="{{ route('product.delete', $product) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium rounded-lg border border-red-500/50 text-red-500 hover:bg-red-500/10 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.595 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.595-1.858L5 7m5-4v6m4-6v6m1-10V9a1 1 0 00-1 1v1M12 4v6m2-3h-4" />
                        </svg>
                        Delete
                    </button>
                </form>
                @endcan
            </div>

            <!-- Detail Card -->
            <div class="rounded-lg border border-gray-700 m-6 overflow-hidden divide-y divide-gray-700">
                
                <!-- Name -->
                <div class="flex items-center px-6 py-4 bg-gray-800">
                    <div class="w-32 shrink-0 text-sm font-medium text-gray-400">Product Name</div>
                    <div class="text-gray-200 font-semibold">{{ $product->name }}</div>
                </div>

                <!-- Quantity -->
                <div class="flex items-center px-6 py-4 bg-gray-800">
                    <div class="w-32 shrink-0 text-sm font-medium text-gray-400">Qty</div>
                    <div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium 
                            {{ $product->qty > 10 ? 'bg-green-900/50 text-green-400' : 'bg-red-900/50 text-red-400' }}">
                            {{ $product->qty }} 
                            {{ $product->qty > 10 ? 'In Stock' : 'Low Stock' }}
                        </span>
                    </div>
                </div>

                <!-- Price -->
                <div class="flex items-center px-6 py-4 bg-gray-800">
                    <div class="w-32 shrink-0 text-sm font-medium text-gray-400">Price</div>
                    <div class="text-gray-200 font-semibold">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </div>
                </div>

                <!-- Owner -->
                <div class="flex items-center px-6 py-4 bg-gray-800">
                    <div class="w-32 shrink-0 text-sm font-medium text-gray-400">Owner</div>
                    <div class="flex items-center gap-2">
                        <div class="h-7 w-7 rounded-full bg-indigo-900/50 flex items-center justify-center text-indigo-400 text-xs font-bold uppercase">
                            {{ substr($product->user->name ?? '?', 0, 1) }}
                        </div>
                        <span class="text-sm text-gray-300">
                            {{ $product->user->name ?? '-' }}
                        </span>
                    </div>
                </div>

                <!-- Created At -->
                <div class="flex items-center px-6 py-4 bg-gray-800">
                    <div class="w-32 shrink-0 text-sm font-medium text-gray-400">Created At</div>
                    <div class="text-sm text-gray-500">
                        {{ $product->created_at->format('d M Y, H:i') }}
                    </div>
                </div>

                <!-- Updated At -->
                <div class="flex items-center px-6 py-4 bg-gray-800">
                    <div class="w-32 shrink-0 text-sm font-medium text-gray-400">Updated At</div>
                    <div class="text-sm text-gray-500">
                        {{ $product->updated_at->format('d M Y, H:i') }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>