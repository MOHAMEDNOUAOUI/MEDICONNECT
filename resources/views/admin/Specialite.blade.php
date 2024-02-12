<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
    <script src="https://cdn.tailwindcss.com"></script>
    
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
        <li class="">
            <a href="{{ route('dashboard')}}">
            <i class='bx bxs-dashboard'></i>
                <span class="text">Dashboard</span>
            </a>
        </li>

        <li class="active">
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
            

            <div class="table-data">
                <div class="head">
                    <h3>Specialite</h3>
                    <form id="addform" action="{{ route('specialite.add')}}" method="post">
                    @csrf
                    <button type="submit" name="add" id="addspecialite"><h3>Add</h3></button>
                    <input type="text" id="holder" name="holder" hidden>
                    </form>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Specialite</th>
                            <th>Usage</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        
                            

                            @foreach($specialites as $specialite)
                            <tr>
                            <td class="H">{{$specialite->Specialite}}</td>
                            <td style="text-align:left">{{$specialite->users_count}}</td>
                            <td class="actions">
                            <form action="{{ route('specialite.delete') }}" method="POST">
                                @csrf
                                <!-- For Delete -->
                                <button type="submit" name="delete" value="{{ $specialite->id }}">Delete</button>
                            </form>

                            <form class="Myform" action="{{ route('specialite.update') }}" method="POST">
                            @csrf
                            <!-- For Update -->
                            <button type="submit" id="update" name="update" value="{{ $specialite->id }}">Modify</button>
                            <!-- Hidden input field to store the button value -->
                            <input type="hidden" id="specialite_id" name="specialite_id" value="{{ $specialite->id }}">
                            <input type="text" class="specialitename" hidden name="specialitename">
                        </form>

                            </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>


            </div>
        </main>
</section>

<div class="links">
               {{ $specialites->links() }}
               </div>
   

               <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="{{asset ('assets/js/script.js')}}"></script>
</body>
</html>