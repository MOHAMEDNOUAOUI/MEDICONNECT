<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
    <title>Dashboard</title>
</head>
<body>

<section id="sidebar">
<!-- LOGO -->
    <a href="" class="logo">
    <i class='bx bxs-shield-plus'></i>
        <span class="text">AdminHUB</span>
    </a>

    <!-- UL here -->

    <ul class="side-menu top">
        <li class="active">
            <a href="{{ route('dashboard')}}">
            <i class='bx bxs-dashboard' ></i>
                <span class="text">Dashboard</span>
            </a>
        </li>

        <li>
            <a href="{{ route ('dashboard.specialite')}}">
            <i class='bx bx-hard-hat'></i>
                <span class="text">Specialite</span>
            </a>
        </li>

        <li>
            <a href="{{ route('dashboard.medicaments')}}">
            <i class='bx bx-plus-medical'></i>
                <span class="text">Medicaments</span>
            </a>
        </li>
    </ul>

    <!-- logout section -->

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
            <ul class="box-info statistiques">

                <li>
                    <i></i>
                    <span class="text">
                    <h3>{{$specialitestats}}</h3>
                    <p>Specialites</p>
                </span>
                </li>

                <li>
                    <i></i>
                    <span class="text">
                        <h3>{{$patients}}</h3>
                        <p>Patients</p>
                    </span>
                </li>

                <li>
                    <i></i>
                    <span class="text">
                        <h3>{{$doctors}}</h3>
                        <p>Doctors</p>
                    </span>
                </li>
            </ul>

            <div class="table-data">

                <div class="Patients">

                </div>

                <div class="doctors">
                    
                </div>

            </div>
        </main>
</section>
    
</body>
</html>