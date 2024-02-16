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

<input type="text" hidden id="doctorId" value="{{$doctorId}}">



<div class="wrapper">


    <div class="profile">

    <div class="icon"></div>

    <div class="flex items-center justify-center flex-col">
        <h3 class="text-xl font-bold">{{$doctorinfos->name}}</h3>
        <p>{{$doctorinfos->specialite->Specialite}}</p>
    </div>


    <div class="flex items-center justify-center flex-col">
        <p>Contact</p>
        <p>Email : {{$doctorinfos->email}}</p>
        <p>Phone : {{$doctorinfos->phonenumber}}</p>

        <p>Rating</p>


        <p>
        @for ($i = 0; $i < 5; $i++)
    
        @if ($avgrating > 0)
        @for ($i = 1; $i <= 5; $i++)
    @if ($i <= $avgrating)
        <i data-key="{{$i}}" class='stars text-2xl bx bxs-star'></i>
    @else
        <i data-key="{{$i}}" class='stars text-2xl bx bx-star'></i>
    @endif
@endfor
        @break



    @else
        <i data-key="{{$i+1}}" class='stars text-2xl bx bx-star'></i>
    @endif
@endfor



        </p>



    </div>

    </div>

    <div class="appointements">

      <div class="h1 flex gap-3 items-end">
        <h1 class="text-2xl">Appointements | </h1>
        <h3><a href="{{route('home')}}">Home</a> > <span>@foreach($doctor as $one)
        {{$one->name}}
    @endforeach</span></h3>
      </div>  
    

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
                        @else
                        <p class="reserved">{{$value}}</p>
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


    <div class="dicher">
        <h1 class="text-2xl">Here you can find all the appointements for this particular Doctor</h1>
        <p>choose one in particular</p>
    </div>

</div>


<!-- FORM FOR THE APPOINTEMENT SCHEDUL -->
<form id="myForm" action="{{ route('appointement.add') }}" method="post" hidden>
@csrf
    <input type="text" id="time_slot" name="time_slot">
    <input type="text" id="doctor_id" name="doctor_id">
</form>

<!-- FORM FOR THE RATING -->

<form id="RATE" action="{{ route('rating.add') }}" method="post" hidden>
@csrf
    <input type="text" id="rating" name="rating">
    <input type="text" id="doctorrating_id" name="doctor_id">
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


var stars = document.querySelectorAll('.stars');


stars.forEach(function(star) {
    star.addEventListener('mouseover', function() {
        let id = this.getAttribute('data-key');

        stars.forEach(function(s, i) {
            if (i < id) {
                s.style.color = "blue";
            }

        });
    });

    star.addEventListener('mouseout', function() {
        stars.forEach(function(s) {
            s.style.color = "";
        });
    });



    star.addEventListener('click' , function(s){
        var rating = this.getAttribute('data-key');
        var doctorid = document.querySelector('#doctorId').value;

        console.log(doctorid);

        document.querySelector('#rating').value = rating;

        document.querySelector('#doctorrating_id').value = doctorid;




        document.querySelector('#RATE').submit();
    } )
});



// rate form

RATE


var rating
var rating
var doctorrating_id






</script>
</body>
</html>