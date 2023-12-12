<div class=" bg-blue-100 flex justify-between px-5 items-center  h-12">
    <div>
        <a href="{{route('home.index')}}" class="text-2xl font-bold">{{__('App Name')}}</a>
    </div>
    <nav class="flex gap-9 items-center">
        <a href="{{route('home.index')}}">{{__('Home')}}</a>
        <a href="#">About</a>
        <a href="{{route('blogs.index')}}">{{__('Blog Posts')}}</a>
        <a href="{{route('blogs.create')}}">{{__("Add Blog Posts")}}</a>
        <a href="#">{{__("Contact")}}</a>
        @guest()
        <a href="{{route('register')}}">{{__('Register')}}</a>
        <a href="{{route('login')}}">{{__('Login')}}</a>
        @endguest
        @auth()

        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
            class="text-white bg-blue-500  focus:outline-none  font-medium rounded text-sm px-5 py-2 text-center inline-flex items-center"
            type="button">{{auth()->user()->name}} <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 4 4 4-4" />
            </svg>
        </button>

        <!-- Dropdown menu -->
        <div id="dropdown"
            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-500">
            <ul class="py-2 text-sm text-gray-500 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                <li class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                    <a href="{{route('user.edit',['user'=>auth()->user()->id])}}">Profile</a>
                </li>
                <li>
                    <form class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                        action="{{route('logout')}}" method="POST">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </li>
            </ul>
        </div>

        @endauth
    </nav>
</div>
