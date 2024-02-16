<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Add Tailwind CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/doctor/doctor.css')}}">
    <title>DoctorPanel</title>
</head>
<body>

<section id="sidebar">
    <div class="logo">
        <a href="">
        <i class='bx bxs-injection'></i>
        <span class="text">DoctorHUB</span>
        </a>
    </div>


    <ul class="side-menu">
    <li>
            <a href="{{ route('doctor')}}">
            <i class='bx bxs-dashboard' ></i>
                <span class="text">Dashboard</span>
            </a>
        </li>

        
        <li>
            <a href="{{ route('doctor.medicaments')}}">
            <i class='bx bx-plus-medical'></i>
                <span class="text">Medicaments</span>
            </a>
        </li>


        <li class="active">
            <a href=" {{ route ('doctorpage.appointement')}}">
            <i class='bx bxs-timer'></i>
                <span class="text">Appointment</span>
            </a>
        </li>

        


        <li>
            <a href="{{ route('doctor.patients')}}">
            <i class='bx bx-street-view'></i>
                <span class="text">Patients</span>
            </a>
        </li>


        <li>
            <a href="{{ route('doctor.folders')}}">
            <i class='bx bx-folder-open'></i>
                <span class="text">Folders</span>
            </a>
        </li>

    </ul>


    <ul class="side-menu">
			<li>
				<a href="{{ route('logout')}}" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>

</section>



<section id="content">
    <!-- navbar -->

    <nav>
			<i class='bx bx-menu' ></i>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>

			<a href="{{route('profile.edit')}}" class="profile">
				<img src="img/people.png">
			</a>
		</nav>


        <!-- main content -->

        <main>

        <div class="head">
                <h3>Appointements</h3>
                <p>You will find all your scheduled appointements below </p>
            </div>


        <div class="box-info-appointement">


        @foreach($timeslots as $time)

        @if(in_array($time , $bookedSlots))

                <div>
                    <h3 class="text-xl">{{$time}}</h3>

                    <div class="time-{{$time}}">
                <div>
                @php
                $appointment = $appointements->where('time_slot', $time)->first();
            @endphp

@if ($appointment)
                <div>
                    <p>{{ $appointment->patient->name}}</p>
                </div>
                @endif


                </div>
            </div>
                </div>

        @else
        <div>
                    <h3 class="text-xl">{{$time}}</h3>

                    <div class="time-{{$time}}">
                <p></p>
            </div>
                </div>

        @endif
        @endforeach


            

        </div>
            
        </main>


</section>


    
</body>
</html>