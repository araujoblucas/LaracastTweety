<x-master>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <section class="px-8">
        <main class="container mx-auto">
            <div class="lg:flex lg:justify-center">
                <div class="lg:w-32">
                    @include ('_sidebar-links')

                    @if(cache()->has('messageError'))
                        <div id="Message" class="flex absolute bg-red-200 rounded-lg"
                             style="transition: 3s ease-in; margin-top: 300px; margin-left:-100px">
                            {{ cache()->pull('messageError')}}
                        </div>
                    @endif

                    @if (cache()->has('messageSuccess'))
                        <div id="Message" class="flex absolute bg-green-200 p-5  rounded-lg"
                             style="margin-top: 300px; margin-left:-100px">
                            {{ cache()->pull('messageSuccess') }}
                        </div>
                    @endif

                </div>

               <script>
                   $().ready(function() {
                       setTimeout(function () {
                           $('#Message').hide(); // "foo" é o id do elemento que seja manipular.
                       }, 2500); // O valor é representado em milisegundos.
                   });
               </script>

                <div class="lg:flex-1 lg:mx-10 lg:mb-10" style="max-width: 700px">
                    {{ $slot }}
                </div>

                @auth
                    <div class="lg:w-1/6 h-1">
                        @include ('_friends-list')
                    </div>
                @endauth
            </div>
        </main>
    </section>
</x-master>
