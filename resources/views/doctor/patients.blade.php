<!DOCTYPE html>
<html lang="en">

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('assets/css/doctor/doctor.css')}}">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Add Tailwind CSS via CDN -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
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


    <li>
        <a href=" {{ route ('doctorpage.appointement')}}">
        <i class='bx bxs-timer'></i>
            <span class="text">Appointment</span>
        </a>
    </li>

   


    <li class="active">
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
            <i class='bx bx-menu'></i>
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>

            <a href="{{route('profile.edit')}}" class="profile">
                <img src="img/people.png">
            </a>
        </nav>


        <!-- main content -->

        <main>

            <div class="head">
                <h3>All of your patients</h3>
                <p>Treat them well dont you forget :D</p>
            </div>


            <div class="box-info-patients">

    @foreach($patients as $patient)
                <li>
                    <i>profile</i>

                    <div>
                        <h3>{{$patient->name}}</h3>
                        <p>{{$patient->email}}</p>
                        <p>{{$patient->phonenumber}}</p>
                    </div>
                </li>

@endforeach
                
            </div>

        </main>


    </section>



</body>

</html>