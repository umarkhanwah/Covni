
<header style="background:black;" class="header">
<!-- <header style="background-color: #33333331;" class="header"> -->

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@700&family=Montserrat:ital,wght@0,100;0,500;1,200&display=swap');

            .logo_covni {
                letter-spacing: 5px;
                font-weight: 900;
                font-family: 'Cairo', sans-serif;
                text-shadow: 0px 0px 100px white;
                color: #d80000;
                font-size: 5rem;
                z-index: 100;
                transform: scale(1.5);
                /* font-family: 'Montserrat', sans-serif; */
            }

            .logo_covni a {
                color: #ff7171;
                font-size: 5rem;
                /* font-family: 'Montserrat', sans-serif; */
            }
        </style>
    <style>
        /* Importing Google font - Open Sans */

        @import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap");

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Open Sans", sans-serif;
        }

        /* body {
            width: 100%;
            background: linear-gradient(to bottom, #ff7171 23%, #330c43 95%);
            background: linear-gradient(to bottom, #175d69 23%, #330c43 95%);
            font-family: Poppins, sans-serif;
        } */

        .header {
            position: fixed;
            top: 0;
            /* background: silver; */
            left: 0;
            width: 100%;
        }

        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px 15px;
        }

        .navbar .logo a {
            font-size: 1.8rem;
            text-decoration: none;
            color: #fff;
        }

        .navbar .links {
            display: flex;
            align-items: center;
            list-style: none;
            gap: 35px;
        }

        .navbar .links a {
            font-weight: 500;
            text-decoration: none;
            color: #fff;
            padding: 10px 0;
            transition: 0.2s ease;
        }

        .navbar .links a:hover {
            color: #ff7171;
        }
        .navbar .links .active{
         font-weight: bold;
            color: #ff7171;
        }
        /* .active{
            color: #ff7171;
        } */
        .navbar .buttons a {
            text-decoration: none;
            color: #fff;
            font-size: 1rem;
            padding: 15px 0;
            transition: 0.2s ease;
        }

        .navbar .buttons a:not(:last-child) {
            margin-right: 30px;
        }

        .navbar .buttons .signin:hover {
            color: #ff7171;
        }

        .navbar .buttons .signup {
            border: 1px solid #fff;
            padding: 10px 20px;
            border-radius: 0.375rem;
            text-align: center;
            transition: 0.2s ease;
        }

        .navbar .buttons .signup:hover {
            background-color: #ff7171;
            color: #fff;
        }

        /* .hero-section {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            min-height: 97vh;
            padding: 0 15px;
            
            max-width: 1200px;
            margin: 5% auto;
        } */

        /* .hero-section .hero {
            max-width: 50%;
            color: #fff;
        }

        .hero h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 20px;
            color: #c9c7c7;
        }

        .hero-section .img img {
            width: 517px;
        }

        .hero-section .buttons {
            margin-top: 40px;
        }

        .hero-section .buttons a {
            text-decoration: none;
            color: #fff;
            padding: 12px 24px;
            border-radius: 0.375rem;
            font-weight: 600;
            transition: 0.2s ease;
            display: inline-block;
        } */

        /* .hero-section .buttons a:not(:last-child) {
            margin-right: 15px;
        } */

        .buttons .join {
            background-color: #ff7171;
        }

        /* .hero-section .buttons .learn {
            border: 1px solid #fff;
            border-radius: 0.375rem;
        }

        .hero-section .buttons a:hover {
            background-color: #ff7171;
        } */

        /* Hamburger menu styles */

        #menu-toggle {
            display: none;
        }

        #hamburger-btn {
            font-size: 1.8rem;
            color: #fff;
            cursor: pointer;
            display: none;
            order: 1;
        }

        @media screen and (max-width: 1023px) {
            .navbar .logo a {
                font-size: 1.5rem;
            }

            .links {
                position: fixed;
                left: -100%;
                top: 75px;
                width: 100%;
                height: 100vh;
                padding-top: 50px;
                background: #175d69;
                flex-direction: column;
                transition: 0.3s ease;
            }

            .navbar #menu-toggle:checked~.links {
                left: 0;
            }

            .navbar #hamburger-btn {
                display: block;
            }

            .header .buttons {
                display: none;
            }

            }
        </style>
        <style>
            .header {
                /* background-color: rgba(51, 51, 51, 0.8); */
                /* Initial background with transparency */
                color: #fff;
                background-color: rgba(0, 0, 0, 0.546);
                transition: background-color 0.3s ease-in-out, backdrop-filter 0.3s ease-in-out;
                z-index: 100;
                backdrop-filter: blur(0px);
                /* Initial blur amount */
            }

            .header.scrolled {
                background-color: rgba(0, 0, 0, 0.546);
                /* Background color on scroll with more opacity */
                color: #333;
                box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
                backdrop-filter: blur(10px);
                /* Increase blur amount on scroll */
                margin: 10px 0px 10px 0px;
                border-radius: 100px;
            }
        </style>
        <script>// Get a reference to the header element
            // Get a reference to the header and container elements
            const header = document.querySelector('.header');
            const container = document.querySelector('.container');

            // Function to add or remove the "scrolled" class based on scroll position
            function toggleHeaderAndContainerClass() {
                if (window.scrollY > 0) {
                    header.classList.add('scrolled');
                    container.classList.add('scrolled-container'); // Add your custom class name
                } else {
                    header.classList.remove('scrolled');
                    container.classList.remove('scrolled-container'); // Remove your custom class name
                }
            }

            // Listen for the "scroll" event and call the toggleHeaderAndContainerClass function
            window.addEventListener('scroll', toggleHeaderAndContainerClass);
        </script>
        <nav class="navbar" >
        <h2 class="logo bg-black px-3 py-1"><a style="color: #ff7171; font-size: 2.2rem;" class="logo_covni"
                    href="#">Cov<span style="color: #ffffff; font-weight: 500; ">ni</span></a></h2>

            <input type="checkbox" id="menu-toggle" />
            <label for="menu-toggle" id="hamburger-btn">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                    <path d="M3 12h18M3 6h18M3 18h18" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
            </label>
            <ul class="links ">
                <li><a href="/home" class="{{ request()->is('home') ? 'active' : '' }}">Home</a></li>
                <li><a href="/#about">About</a></li>
                <li><a href="/#services">Services</a></li>
                <!-- <li><a href="#">Portfolio</a></li> -->
                @if(Auth::guard('hospital')->check() || Auth::guard('user')->check() || Auth::guard('admin')->check())
                    <!-- <li>
                        <a class="{{ request()->is('tests') ? 'active' : '' }}" href="/tests" >Tests</a>
                    </li> -->
                    <!-- <li>
                        <a class="{{ request()->is('tests') ? 'active' : '' }}" href="/tests" >Tests</a>
                    </li> -->
                    <li>
                        <!-- <a class=" {{ request()->is('dashboard') ? 'active' : '' }}" href="/dashboard" >Dashboard</a> -->
                        <a class=" active" href="/dashboard" >Dashboard</a>
                    </li>
                @endif
         
                
                <li><a href="/#contact">Contact</a></li>
            </ul>
            <div class="buttons dropdown">
                   @if(Auth::guard('user')->check() || Auth::guard('admin')->check() || Auth::guard('hospital')->check())
                        <div class="dropdown">

                        <a href="#dropdown" class="nav-link active dropdown-toggle" type="button" id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            
                            @auth('hospital')
                                {{ auth('hospital')->user()->name }}
                            @endauth
                            @auth('user')
                                {{ auth('user')->user()->name }}
                            @endauth
                            @auth('admin')
                                {{ auth('admin')->user()->name }}
                            @endauth
                            
                        </a>
                        <div class="dropdown-menu " aria-labelledby="triggerId" id="dropdown">
                            @auth('hospital')
                                <a href="{{route('h_edit',auth('hospital')->user()->id)}}" class="dropdown-item text-dark text-center" href="#">Edit Profile</a>
                                <a href="/h_logout" class="dropdown-item text-dark text-center">Logout</a>
                                @endauth
                                @auth('user')
                                <a href="{{route('u_edit',auth('user')->user()->id)}}" class="dropdown-item text-dark text-center" href="#">Edit Profile</a>
                                <a href="/u_logout" class="dropdown-item text-dark text-center">Logout</a>
                                @endauth
                                @auth('admin')
                                <a href="{{route('u_edit',auth('admin')->user()->id)}}" class="dropdown-item text-dark text-center" href="#">Edit Profile</a>
                                <a href="/a_logout" class="dropdown-item text-dark text-center">Logout</a>
                            @endauth
                            
                            
                        </div>   
                                </div>
<!-- <ul class="list" >
   
    @auth('hospital')
        <li href="{{route('h_edit',auth('hospital')->user()->id)}}" class="dropdown-item" href="#">Edit Profile</li>
        <a href="/h_logout" class="dropdown-item">Logout</a>
        @endauth
        @auth('user')
        <li href="{{route('u_edit',auth('user')->user()->id)}}" class="dropdown-item" href="#">Edit Profile</li>
        <a href="/u_logout" class="dropdown-item">Logout</a>
        @endauth
        @auth('admin')
        <li href="{{route('u_edit',auth('admin')->user()->id)}}" class="dropdown-item" href="#">Edit Profile</li>
        <a href="/a_logout" class="dropdown-item">Logout</a>
    @endauth
    
    
</ul>    -->
<!-- {{-- @yield('dropdown') --}} -->
@else
<a href="/" class="signin">Sign In</a>
<a href="/" class="signup">Sign Up</a>
@endif  
            </div>
        </nav>
</header>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.2/dist/js/bootstrap.bundle.min.js"></script>

