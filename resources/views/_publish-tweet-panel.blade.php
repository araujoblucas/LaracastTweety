<div class="border border-blue-400 rounded-lg px-8 py-6 mb-8">
    <form name="tweetform" method="POST" action="/tweets" enctype="multipart/form-data">
        @csrf

        <textarea
            name="body"
            class="w-full"
            placeholder="What's up doc?"
            required
            autofocus
            onkeyup="limite_textarea(this.value)" id="texto"
        ></textarea>
        <span class="text-sm italic" id="cont">255</span><span class="text-sm italic"> caracters restantes </span>
            <script>
                function limite_textarea(valor) {
                    quant = 255;
                    total = valor.length;
                    if (total <= quant) {
                        resto = quant - total;
                        document.getElementById('cont').innerHTML = resto;
                    } else {
                        document.getElementById('texto').value = valor.substr(0, quant);
                    }
                }
            </script>

        <hr class="my-4">

        <div class="flex">
            <label class="flex text-center">Add Image</label>
            <input class=" p-2 w-full"
                   type="file"
                   name="imageTweet"
                   id="imageTweet"
                   accept="image/*"
            >
        </div>

        <hr class="my-4">

        <footer class="flex justify-between items-center">
            <div>
                <img
                    src="{{ current_user()->avatar }}"
                    alt="your avatar"
                    class="rounded-full mr-2"
                    width="50"
                    height="50"
                >
            </div>

            <button
                type="submit"
                class="bg-blue-500 hover:bg-blue-600 rounded-lg shadow px-10 text-sm text-white h-10"
            >
                Publish
            </button>
        </footer>
    </form>

    @error('body')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>

