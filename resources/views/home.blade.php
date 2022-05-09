<x-layout titlePage="Home">
    {{-- ======== START ::: TITLE SECTION ======== --}}
    <section class="py-8">
        <div class="layout border shadow p-4 px-6 rounded-xl">
            {{-- ======== header section ======== --}}
            <h1 class="text-3xl text-center font-semibold mb-8">Laravel Cache Tutorial</h1>
            {{-- ======== content section ======== --}}
            <p class="text-lg">Please read the documentation first at
                <a class="text-blue-500 hover:underline"
                    href="https://github.com/dptsi/laravel-tutorial/blob/master/Laravel-session-and-caching/cache.md"
                    target="__blank">Link Github</a>.
                In this website, you can interact with laravel cache at directly. This website is using database driver
                for the cache, the reason is to manipulate the data so we can retrieve all the keys and show it in one
                page.
            </p>
        </div>
    </section>
    {{-- ======== END ::: TITLE SECTION ======== --}}
    {{-- ======== START ::: LIST CONTENT SECTION ======== --}}
    <section class="py-8">
        <div class="layout border shadow p-4 px-6 rounded-xl">
            {{-- ======== header section ======== --}}
            <div class="flex mb-8 justify-between items-center">
                <h1 class="text-3xl text-center font-semibold ">Content of The Cache Now</h1>
                @if (count($allCacheData) > 0)
                    <form action="{{ route('cache/deleteAll') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Are you sure?')" type="submit"
                            class="inline-block px-6 py-2 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">
                            Delete All Content
                        </button>
                    </form>
                @endif
            </div>
            @if (count($allCacheData) > 0)
                <p class="text-lg mb-2">You can delete all the contents of the cache using <span
                        class="text-red-500">Cache::flush()</span> on <span
                        class="text-red-500">CacheController/deleteAll()</span> method.
                </p>
            @endif
            {{-- ======== content section ======== --}}
            <div>
                <p class="text-lg">These are the contents of the cache, you can check it on
                    <span class="text-red-500">CacheController/getAllCacheKeys()</span> method (the hour is using
                    another timezone):
                </p>
                <ol class="mt-4 text-lg list-decimal space-y-2 mx-4 grid grid-cols-2 gap-3">
                    @foreach ($allCacheData as $cache)
                        <li>
                            <span class="font-bold"> Key :
                                {{ trim(str_replace('laravel_cache', '', $cache->key)) }}
                            </span>
                            <br>

                            @php
                                preg_match('/"([^"]+)"/', $cache->value, $value);
                            @endphp
                            <span class="font-bold"> Value : {{ $value[1] }} </span>
                            <br>

                            <span class="font-bold"> Expiration :
                                {{ \Carbon\Carbon::parse($cache->expiration)->format('Y-m-d H:i') }}
                            </span>
                            {{-- {{ $cache->expiration }} --}}

                            <div class="mt-2 flex space-x-3">
                                <form action="{{ route('cache/delete', $cache->key) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you sure?')" type="submit"
                                        class="inline-block px-6 py-2 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">
                                        Delete
                                    </button>
                                </form>
                                <form action="{{ route('cache/pull', $cache->key) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button onclick="return confirm('Are you sure?')" type="submit"
                                        class="inline-block px-6 py-2 bg-yellow-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-yellow-600 hover:shadow-lg focus:bg-yellow-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-yellow-700 active:shadow-lg transition duration-150 ease-in-out">
                                        Retrieve and Delete
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </section>
    {{-- ======== END ::: LIST CONTENT SECTION ======== --}}
    {{-- ======== START ::: ADD NEW KEY SECTION ======== --}}
    <section class="py-8">
        <div class="layout border shadow p-4 px-6 rounded-xl">
            {{-- ======== header section ======== --}}
            <h1 class="text-3xl text-center font-semibold mb-8">Add New Keys</h1>
            {{-- ======== content section ======== --}}
            <div>
                <p class="text-lg">You can add new keys using <span class="text-red-500">Cache::put('key',
                        'value',
                        expiration)</span> on
                    <span class="text-red-500">CacheController/addNewKey(Request $request)</span> method:
                </p>
                <form class="mt-4" action="{{ route('cache/post') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-3 gap-3">
                        <x-inputField idInput="key" name="key" label="Key Name" placeholder="username" type="text"
                            required=true />
                        <x-inputField idInput="cache_value" name="cache_value" label="Cache Value"
                            placeholder="Abdul Rahman" type="text" required=true />
                        <x-inputField idInput="expiration" name="expiration" label="Expiration (seconds)"
                            placeholder="60" value="60" type="number" min="10" max="3600" />
                    </div>
                    <button type="submit" data-mdb-ripple="true" data-mdb-ripple-color="light"
                        class="block mx-auto px-16 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Click
                        Add New Key</button>
                </form>
            </div>
        </div>
    </section>
    {{-- ======== END ::: ADD NEW KEY SECTION ======== --}}
    {{-- ======== START ::: RETRIEVE AND DELETE SECTION ======== --}}
    @if (Session::has('dataPulled'))
        <section class="py-8">
            <div class="layout border shadow p-4 px-6 rounded-xl">
                {{-- ======== header section ======== --}}
                <h1 class="text-3xl text-center font-semibold mb-8">Retrieve and Delete</h1>
                {{-- ======== content section ======== --}}
                <div>
                    <p class="text-lg mb-2">You can retrieve the value and also delete them using <span
                            class="text-red-500">Cache::pull('key'), with that method, you will get the keys and
                            values
                            and also delete them from cache. You can check it on </span> on
                        <span class="text-red-500">CacheController/pullKey(Request $request)</span> method.
                    </p>

                    <p class="text-xl text-center font-bold mb-2">Retrieved Key : {{ Session::get('dataPulled') }}</p>
                </div>
            </div>
        </section>
    @endif
    {{-- ======== END ::: RETRIEVE AND DELETE SECTION ======== --}}
</x-layout>
