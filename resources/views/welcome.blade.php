<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>

        <!-- Styles -->
        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
        <link
            href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
            rel="stylesheet"
        />

    </head>
    <body class="antialiased">

        <div class="max-w-wd w-4/12 mx-auto bg-slate-100 rounded-lg p-4 mt-12">
            <form method="post" action="/" enctype="multipart/form-data">
                @csrf

                <div class="mb-6">
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Title</label>
                    <input
                        type="text" name="title" value="{{ old('title') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-3 w-full focus:ring-blue-500"
                    >
                    @error('title')
                        <div class="text-red-400 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                    <textarea
                        name="description" id="message" cols="30" rows=4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300"
                        placeholder="Leave a comment..."
                        value="{{ old('description') }}"
                    ></textarea>
                    @error('description')
                        <div class="text-red-400 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-6">
                    <input type="file" class="filepond" name="image" multiple credits="false" />
                </div>

                <button
                    type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded py-3 px-6"
                >Create</button>

            </form>
        </div>

        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
        <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

        <script>
            FilePond.registerPlugin(FilePondPluginImagePreview);
            const inputElement = document.querySelector('input[type="file"]');
            const pond = FilePond.create(inputElement);

            FilePond.setOptions({
                server: {
                    process: '/upload',
                    revert: '/delete',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
            });


            </script>

    </body>
</html>
