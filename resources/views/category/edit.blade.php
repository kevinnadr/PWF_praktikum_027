<x-app-layout>
    <div style="min-height: 100vh; background-color: #0f172a; padding: 5rem 1rem; display: flex; align-items: center; justify-content: center;">
        <div style="width: 100%; max-width: 42rem; background-color: #1e293b; border-radius: 1.5rem; border: 1px solid #374151; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);">
            <div style="padding: 3rem;">
                
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 2.5rem;">
                    <a href="{{ route('category.index') }}" style="color: #9ca3af; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#ffffff'" onmouseout="this.style.color='#9ca3af'">
                        <svg xmlns="http://www.w3.org/2000/svg" style="height: 2rem; width: 2rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                    <h2 style="font-size: 1.875rem; font-weight: 700; color: #ffffff; margin: 0;">Edit Category</h2>
                </div>

                <form action="{{ route('category.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div style="margin-bottom: 2.5rem;">
                        <label for="name" style="display: block; font-size: 0.75rem; font-weight: 700; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 0.75rem; margin-left: 0.25rem;">CATEGORY</label>
                        <input type="text" name="name" id="name" 
                               value="{{ old('name', $category->name) }}"
                               style="width: 100%; background-color: #ffffff; border: 2px solid transparent; border-radius: 1rem; padding: 1rem 1.5rem; color: #111827; font-size: 1.125rem; outline: none; transition: all 0.2s; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);"
                               placeholder="Electronic" required>
                        @error('name')
                            <p style="color: #f87171; font-size: 0.875rem; margin-top: 0.75rem; margin-left: 0.5rem;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div style="display: flex; align-items: center; justify-content: flex-end; gap: 2rem; margin-top: 3rem;">
                        <a href="{{ route('category.index') }}" 
                           style="font-size: 0.875rem; font-weight: 700; color: #9ca3af; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#ffffff'" onmouseout="this.style.color='#9ca3af'">
                            Cancel
                        </a>
                        <button type="submit" 
                                style="padding: 0.875rem 2.5rem; background-color: #4f46e5; border: none; color: #ffffff; font-size: 0.875rem; font-weight: 700; border-radius: 1rem; cursor: pointer; transition: all 0.2s; box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);" onmouseover="this.style.backgroundColor='#4338ca'" onmouseout="this.style.backgroundColor='#4f46e5'">
                            Update Category
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
