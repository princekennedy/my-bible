<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ mix('/js/app.js') }}" defer></script>
    <!-- <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"> -->
    <title>EnQue</title>
    <style type="text/css">
    .dropdown:hover .dropdown-menu {
        display: block;
    }

    /*        @media screen and (max-width: 900px) {
          #nav-content {
            display: none;
          }
        }        
        @media screen and (min-width: 900px) {
          #nav-content {
            
            display: block;
          }
        }*/
    </style>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    @inertia

    <script type="text/javascript">
    document.onclick = check;

    function checkParent(t, elm) {
        while (t.parentNode) {
            if (t == elm) {
                return true;
            }
            t = t.parentNode;
        }
        return false;
    }

    function check(e) {
        var target = (e && e.target) || (event && event.srcElement);
        var userMenuDiv = document.getElementById("userMenu");
        var userMenu = document.getElementById("userButton");
        var navMenuDiv = document.getElementById("nav-content");
        var navMenu = document.getElementById("nav-toggle");
        userMenu
        //User Menu

        if (!checkParent(target, userMenuDiv)) {
            // click NOT on the menu
            $(userMenuDiv).toggleClass("invisible");
            if (checkParent(target, userMenu)) {
                // click on the link
                if (userMenuDiv.classList.contains("invisible")) {
                    userMenuDiv.classList.remove("invisible");
                } else {
                    userMenuDiv.classList.add("invisible");
                }
            } else {
                // click both outside link and outside menu, hide menu
                userMenuDiv.classList.add("invisible");

            }
        }

        // Nav Menu

        if (!checkParent(target, navMenuDiv)) {
            // click NOT on the menu
            if (checkParent(target, navMenu)) {

                // $(userMenuDiv).toggleClass("invisible");

                // click on the link
                if (navMenuDiv.classList.contains("hidden")) {
                    navMenuDiv.classList.remove("hidden");
                } else {
                    navMenuDiv.classList.add("hidden");
                }
            } else {
                // click both outside link and outside menu, hide menu
                navMenuDiv.classList.add("hidden");

            }
        }

    }
    </script>
</body>

</html>