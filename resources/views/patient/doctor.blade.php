<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Add Tailwind CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <link rel="stylesheet" href="{{asset ('assets/css/patient/doctor.css')}}">
    <title>Doctor,

    @foreach($doctor as $one)
        {{$one->name}}
    @endforeach

    </title>
</head>
<body>


<nav class="border-gray-200 dark:bg-gray-900">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
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
                            <a href="{{ route('logout')}}">
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




<div class="wrapper">

    <div class="profile">

    </div>

    <div class="appointements">
        
    <h1 class="text-2xl">Appointements</h1>

        <div class="top">
        <i class='bx bx-sun'></i>
            <div>
            <h4>Morning</h4>
            <p>8:00 AM to 12:00 AM</p>
            </div>
        </div>
        
        @foreach($doctor as $one)
        @php
                    $bookedSlots = $one->appointmentsAsDoctor->where('appointment_date', $Datezone)->pluck('time_slot')->toArray();
                @endphp
        @endforeach
        

       <div class="timers AM">
       @foreach($timeslot as $time => $value)
       @if($time < 4)
       @if(!in_array($value, $bookedSlots))
                        <p data-key="{{$one->id}}" class="appointementtime">{{$value}}</p>
                    @endif
       @endif
                    
                @endforeach
       </div>


       <div class="top">
       <i class='bx bx-moon'></i>
            <div>
            <h4>Evening</h4>
            <p>13:00 PM to 17:00 PM</p>
            </div>
        </div>

       <div class="timers PM">
       @foreach($timeslot as $time => $value)
                    @if($time > 3)
                    @if(!in_array($value, $bookedSlots))
                        <p data-key="{{$one->id}}" class="appointementtime">{{$value}}</p>
                    @endif
                    @endif
                @endforeach
       </div>

    </div>

</div>


<!-- FORM FOR THE APPOINTEMENT SCHEDUL -->
<form id="myForm" action="{{ route('appointement.add') }}" method="post" hidden>
@csrf
    <input type="text" id="time_slot" name="time_slot">
    <input type="text" id="doctor_id" name="doctor_id">
</form>



<div class="comments">

<div class="Cinfo">
<h3 class="text-3xl">Comments ({{$commentscount}})</h3>
<p>Start a discussion,not a fire.Post with kidness.</p>
</div>


<div class="commentsection">

<div class="sectionforinput">
    <p>profile</p>
   <form id="form" action="{{route('comment.add')}}" method="post">
   @csrf
   <input type="text" id="comment" name="comment" placeholder="Add a comment...">
   @foreach($doctor as $one)
   <input type="text" hidden name="doctor_id" value="{{$one->id}}">
   @endforeach
   </form>
</div>


<div class="sec">
@foreach($comments as $comment)

<div class="secunder">
    <p>Profile</p>


    <div class="holder">
    
    <div>
    <h3>{{$comment->patient->name}}</h3>
    <p>{{$comment->created_at_diff}}</p>
    </div>
    <h3>{{$comment->comment}}</h3>

    </div>


</div>

@endforeach
</div>
    
</div>
    
</div>





<script>

    document.querySelectorAll('.appointementtime').forEach(function(element) {
  element.addEventListener('click' , function() {
    
    let timeInput = document.querySelector('#time_slot');
    let doctorIdInput = document.querySelector('#doctor_id');

    let id = this.getAttribute('data-key');

    timeInput.value = this.textContent;
    doctorIdInput.value = id;

    document.querySelector('#myForm').submit();
  })
});



document.querySelector('#comment').addEventListener('keypress' , function(event) {
    if(event.key === 'Enter'){
        event.preventDefault();

        document.querySelector('#form').submit();
    }
})





</script>
</body>
</html>