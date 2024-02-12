<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
    <li class="active">
            <a href="{{ route ('doctor')}}">
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


        <li>
            <a href="{{ route('doctorpage.appointement')}}">
            <i class='bx bxs-timer'></i>
                <span class="text">Appointment</span>
            </a>
        </li>

        


        <li>
            <a href="">
            <i class='bx bx-street-view'></i>
                <span class="text">Patients</span>
            </a>
        </li>


        <li>
            <a href="">
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

        <ul class="box-info">
        <li>
                    <i></i>
                    <span class="text">
                    <h3>{{$appointements}}</h3>
                    <p>Appointements</p>
                </span>
                </li>

                <li>
                    <i></i>
                    <span class="text">
                        <h3>{{$patients}}</h3>
                        <p>Patients</p>
                    </span>
                </li>
        </ul>
            
        </main>


</section>


    
</body>
</html>