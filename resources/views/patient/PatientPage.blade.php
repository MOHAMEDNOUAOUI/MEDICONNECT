<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Add Tailwind CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset ('assets/css/patient/style.css')}}">
    <title>Document</title>
</head>

<body>


    <section id="page1" class="bg-stone-700">


    <nav class="border-gray-200 dark:bg-gray-900">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <a href="{{route('home')}}" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
                    <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Mediconnect</span>
                </a>
                <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
                <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                    <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg  md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0  dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">

                        <li>
                            <a href="#" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">Home</a>
                        </li>

                        


                        <li>
                            <a class="" href="">
                               Appointements</a>
                        </li>

                        <li>
                            <a href="{{ route('logout')}}">
                                logout</a>
                        </li>



                        <li>
                            <a href="{{route('profile.edit')}}">
                                <img src="img/people.png">
                            </a>
                        </li>


                       
                        

                    </ul>
                </div>
            </div>
        </nav>


        <div id="content">
            <div class="left">
                <h1 class="text-5xl">TAKE THE BEST MEDICAL TREATEMENT FOR URSAFETY</h1>
            </div>

            <div class="right">
                <img src="{{ asset ('assets/images/doctor.png')}}" alt="">
            </div>
        </div>

        <div id="page1bottom">
            <h1 class="text-3xl uppercase text-white">Discover more about every doctor</h1>
            <button id="checkout">
                <i class='text-5xl bx bx-chevrons-down'></i>
            </button>

        </div>



    </section>



    <section id="page2">
        <div class="wrapper">

                <ul class="boxer">

                @foreach($doctors as $doctor)


    <li class="box-li">
        <div class="info">
        <div class="favorite">
        <h3 class="text-xl uppercase">{{$doctor->name}}</h3>
        


        <!-- FAVOURITE PART -->
@if(count($favourite) > 0)

@foreach($favourite as $favouri)
        @if($favouri->doctor_id == $doctor->id)
        <i data-key="{{$doctor->id}}" class="bx bxs-heart"></i>
        @else
        <i data-key="{{$doctor->id}}" class="bx bx-heart"></i>
        @endif
@endforeach

   
@else
<i data-key="{{$doctor->id}}" class="bx bx-heart"></i>
@endif


<form id="favform" action="{{ route('favourite.add')}}" method="post" hidden>
@csrf
    <input type="text" id="doctorid" name="doctorid">
</form>


        </div>
            <p class="text-lg">{{$doctor->specialite->Specialite}}</p>
            

            <div class="timeappointement">
                @php
                    $bookedSlots = $doctor->appointmentsAsDoctor->where('appointment_date', $Datezone)->pluck('time_slot')->toArray();
                @endphp

            @if(count($bookedSlots) < 8)
                <p data-key="{{$doctor->name}}" class="Av available">doctor available</p>
                @else 
                <p data-key="{{$doctor->name}}" class="Av notavailable">doctor is not available</p>
            @endif
            </div>
        </div>
    </li>



@endforeach







                </ul>
    


        <div class="rightop">
            <h3>Favourites</h3>
        </div>



            <div class="links">
                {{$doctors->links()}}
            </div>
        </div>
    </section>

    




    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>


    <script>



document.querySelectorAll('.Av').forEach(function(element) {
    element.addEventListener('click' , function() {
        let doctorname = this.getAttribute('data-key');
        console.log(doctorname);

        window.location.href = '/doctor/' + doctorname;
    })
})


        


        document.querySelectorAll('.bx').forEach(function(heart) {
            if(heart.classList.contains('bx-heart') || heart.classList.contains('bxs-heart')){
                heart.addEventListener('mouseover' , function(e) {
                if(e.target.classList.contains('bx-heart')){
                    e.target.classList.remove('bx-heart');
                    e.target.classList.add('bxs-heart');
                }
                else{
                    e.target.classList.remove('bxs-heart');
                    e.target.classList.add('bx-heart');
                }
                
            })


            heart.addEventListener('mouseout' , function(e){
                if(e.target.classList.contains('bx-heart')){
                    e.target.classList.remove('bx-heart');
                    e.target.classList.add('bxs-heart');
                }
                else{
                    e.target.classList.remove('bxs-heart');
                    e.target.classList.add('bx-heart');
                }
            })


            heart.addEventListener('click' , function(e) {
                if(e.target.classList.contains('bx-heart')){
                    e.target.classList.remove('bx-heart');
                    e.target.classList.add('bxs-heart');
                }
                else{
                    e.target.classList.remove('bxs-heart');
                    e.target.classList.add('bx-heart');
                }


                document.querySelector('#doctorid').value = heart.getAttribute('data-key');
                document.querySelector('#favform').submit();




            })
            }
            
        })




    </script>


</body>

</html>