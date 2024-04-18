<header style class="header">
<style>
        /* Importing Google font - Open Sans */

        @import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap");

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Open Sans", sans-serif;
        }

        body {
            /* height: 100vh; */
            width: 100%;
            background: linear-gradient(to bottom, #ff7171 23%, #330c43 95%);
            background: linear-gradient(to bottom, #175d69 23%, #330c43 95%);
            font-family: Poppins, sans-serif;
        }

        .header {
            position: fixed;
            top: 0;
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

        .hero-section {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            height: 97vh;
            padding: 0 15px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .hero-section .hero {
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
        }

        .hero-section .buttons a:not(:last-child) {
            margin-right: 15px;
        }

        .buttons .join {
            background-color: #ff7171;
        }

        .hero-section .buttons .learn {
            border: 1px solid #fff;
            border-radius: 0.375rem;
        }

        .hero-section .buttons a:hover {
            background-color: #ff7171;
        }

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

            .hero-section .hero {
                max-width: 100%;
                text-align: center;
            }

            .hero-section img {
                display: none;
            }
        }
    </style>
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
            .header {
                /* background-color: rgba(51, 51, 51, 0.8); */
                /* Initial background with transparency */
                color: #fff;
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

        <nav class="navbar">
            <h2 class="logo bg- px-3 py-1"><a style="color: #ff7171; font-size: 2.2rem;" class="logo_covni"
                    href="#">Cov<span style="color: #ffffff; font-weight: 500; ">ni</span></a></h2>
            <input type="checkbox" id="menu-toggle" />
            <label for="menu-toggle" id="hamburger-btn">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                    <path d="M3 12h18M3 6h18M3 18h18" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
            </label>
            <ul class="links ">
                <li><a href="">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Services</a></li>
                <!-- <li><a href="#">Portfolio</a></li> -->
                <li><a href="#">Contact</a></li>
            </ul>
            <div class="buttons">
                <a href="/" class="signin">Sign In</a>
                <a href="/" class="signup">Sign Up</a>
            </div>
        </nav>
    </header>