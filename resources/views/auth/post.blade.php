<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('auth.postAdd') }}" enctype="multipart/form-data">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="post_title" :value="__('Post Title')" />

                <x-input id="post_title" class="block mt-1 w-full" type="text" name="post_title" :value="old('post_title')" required autofocus />
            </div>
            <div>
                <x-label for="image" :value="__('Post Image')" />

                <x-input id="image" class="block mt-1 w-full" type="file" name="image" required autofocus />
            </div>
            <div>
                <x-label for="description" :value="__('Post Description')" />
                <textarea  id="description"  name="description" cols="40" rows="5"></textarea>
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-button class="ml-4">
                    {{ __('Add Post') }}
                </x-button>
            </div>

        </form>
    </x-auth-card>
</x-guest-layout>
