<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" ></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
 

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Display&family=Poppins:wght@200&display=swap" rel="stylesheet">
    

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <style>
       
            #particles-js {
           
      
            width: 100%;
            height: 100%;
            background-color: #FFF;
            background-image: url("");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 50% 50%;
            }
     



            .news {
                width: 160px

            }

            .news-scroll a {
                text-decoration: none
            }

            .dot {
                height: 6px;
                width: 6px;
                margin-left: 3px;
                margin-right: 3px;
                margin-top: 2px !important;
                background-color: rgb(207, 23, 23);
                border-radius: 50%;
                display: inline-block
            }
              
            .div1{
               
                

               text-align: center;
               
                position: absolute;  
                left: 50%;                       
                top: 60%;                        
                transform: translate(-50%, -50%); 

              
  
            }

              .div1 h1{
                   font-weight: bold;
                   color: black;
                }
                .div1 h4{

                   color: grey;
                }
                .div1 button{

                   margin-top:2rem;
                }
            .annonce{
               
                transform: rotate(-20deg);
                position: absolute;  
                left: 10%;                       
                top: 30%;     
                background:red;
                color:white;
                text: 2rem;
                padding:0.5rem;
                font-weight: bold;
     
            }

            img{
                position: absolute;  
                right: 10%;                       
                top: 30%;   
                width: 130px;
                height:130px;
            }
            .button{
                 position: absolute;  
                 left: 50%;                       
                 top: 70%;  
            }
                     
    </style> 
    
</head>
<body>
   
 <div id="app" >
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm " >
            <div class="container">
                <a class="navbar-brand" href="{{ route('front.index')}}">
                    Système eVote
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
               
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('front.index')}}">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">A propos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">Régles</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="">Contact</a>
                        </li>

                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Connexion</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Inscription</a>
                                </li>
                            @endif
                        @else
                                @if ( Auth::user()->role ==="admin" )
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.index') }}">Espace Admin</a>
                                    </li>
                                @elseif ( Auth::user()->role ==="user" )
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('electeur.index') }}">Espace Electeur</a>
                                </li>
                                @else
                                    <li class="nav-item">
                                         <a class="nav-link" href="{{ route('candidat.index') }}">Espace Candidat</a>
                                     </li>
 
                                @endif
                        
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Déconnexion
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
       


    
 
        <div id="particles-js"   >
                <nav class="navbar_f navbar-expand-md navbar-light bg-evote shadow-sm " >
                                    <div class="container text-white">
                                        <div class="d-flex justify-content-between align-items-center breaking-news bg-evote">
                                            <div class="d-flex flex-row flex-grow-1 flex-fill  bg-evote py-3 text-white px-1 news "><span class="d-flex align-items-center">Système eVote</span></div>
                                            <marquee class="news-scroll" behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();">
                                            <a class="text-white">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. 
                                            </a> <span class="dot"></span> <a class="text-white">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
                                            </a> <span class="dot"></span> <a class="text-white">Duis aute irure dolor in reprehenderit in voluptate velit esse </a> </marquee>
                                        </div>
                                    </div>
                </nav>

            <div class="div1">
                <h1> Système eVote- le vote en ligne simplifié</h1>
                <h4> lorem ipsum noro lorm tokoyou jourt jkdou lorem ipsum noro lorm tokoyou jourt jkdou</h4>
                <button type="button" class="btn btn-warning">Inscrivez-vous maintenant</button>
            </div>
            <div class="annonce">
                    Du 01 ou 04 Mars 2022, <br>
                    votez pour vos représentants<br>
                    sur www.systeme.evote.fr   
            </div>  
           
                 <img 
                src="/uploads/vote.jpg"
                alt="">    
                        
            
        </div>
           
    
    

</div>
 <script>
 var text1 = ["Système eVote - le vote en ligne simplifié", "Système eVote - 100% sécurisé", "Système eVote - voter quand vous voulez, où vous voulez et de l'appareil que vous voulez"];
 var text2 = ["lorem ipsum noro lorm tokoyou jourt jkdou lorem ipsum noro lorm tokoyou jourt jkdou",
  "lorem ipsum noro lorm tokoyou jourt jkdou lorem ipsum noro lorm tokoyou jourt jkdou", 
  "lorem ipsum noro lorm tokoyou jourt jkdou lorem ipsum noro lorm tokoyou jourt jkdou"];
var counter = 0;
var elem1 = document.querySelector("h1");
var elem2 = document.querySelector("h4");
var inst = setInterval(change, 3000);

function change() {
  elem1.innerHTML = text1[counter];
  elem2.innerHTML = text2[counter];
  counter++;
  if (counter >= text1.length) {
    counter = 0;
  }
}
 </script>




    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
     <script>
    particlesJS("particles-js", {
  "particles": {
    "number": {
      "value": 80,
      "density": {
        "enable": true,
        "value_area": 800
      }
    },
    "color": {
      "value": ["#BD10E0","#B8E986","#50E3C2","#FFD300","#E86363"]
    },
    "shape": {
      "type": "circle",
      "stroke": {
        "width": 0,
        "color": "#b6b2b2"
      }
    },
    "opacity": {
      "value": 0.5211089197812949,
      "random": false,
      "anim": {
        "enable": true,
        "speed": 1,
        "opacity_min": 0.1,
        "sync": false
      }
    },
    "size": {
      "value": 8.017060304327615,
      "random": true,
      "anim": {
        "enable": true,
        "speed": 12.181158184520175,
        "size_min": 0.1,
        "sync": true
      }
    },
    "line_linked": {
      "enable": true,
      "distance": 150,
      "color": "#c8c8c8",
      "opacity": 0.4,
      "width": 1
    },
    "move": {
      "enable": true,
      "speed": 1,
      "direction": "none",
      "random": false,
      "straight": false,
      "out_mode": "bounce",
      "bounce": false,
      "attract": {
        "enable": false,
        "rotateX": 600,
        "rotateY": 1200
      }
    }
  },
  "interactivity": {
    "detect_on": "canvas",
    "events": {
      "onhover": {
        "enable": false,
        "mode": "repulse"
      },
      "onclick": {
        "enable": false,
        "mode": "push"
      },
      "resize": true
    },
    "modes": {
      "grab": {
        "distance": 400,
        "line_linked": {
          "opacity": 1
        }
      },
      "bubble": {
        "distance": 400,
        "size": 40,
        "duration": 2,
        "opacity": 8,
        "speed": 3
      },
      "repulse": {
        "distance": 200,
        "duration": 0.4
      },
      "push": {
        "particles_nb": 4
      },
      "remove": {
        "particles_nb": 2
      }
    }
  },
  "retina_detect": true
});
</script>
<script>
  document.addEventListener("DOMContentLoaded", function(){
  window.addEventListener('scroll', function() {
      if (window.scrollY > 10) {
        document.querySelector('.navbar').classList.add('fixed-top');
       
      } else {
        document.querySelector('.navbar').classList.remove('fixed-top');
        
      } 
  });
});
</script>
{{-- <script>

(function($){
    $(document).ready(function(){
        var offset = $(".navbar").offset().top;
        $(document).scroll(function(){
            var scrollTop = $(document).scrollTop();
            if(scrollTop > offset){
                $(".navbar").css("position", "fixed");
            }
            else {
                $(".navbar").css("position", "static");
            }
        });
    });
});


</script> --}}
    
</body>
</html>
