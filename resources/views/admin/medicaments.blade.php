<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Add Tailwind CSS via CDN -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    
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

        <li>
            <a href="{{ route ('dashboard.specialite')}}">
            <i class='bx bx-hard-hat'></i>
                <span class="text">Specialite</span>
            </a>
        </li>

        <li class="active">
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
                    <h3>Medicaments</h3>
                    <button name="add" id="addmedicament" data-bs-toggle="modal" data-bs-target="#exampleModal"><h3>Add</h3></button>

                    

                    <form action="{{ route('medic.add')}}" method="post">
                @csrf


                    
<!-- Modal ADD -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Medicament panel</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body d-flex flex-column gap-3">
        <div class="medic d-flex flex-column gap-1">
        <label for="medicament">Medicament name</label>
        <input type="text" class="border border-1 border-dark" name="medicament">
        </div>

       <div class="desc d-flex flex-column gap-1">
        <label for="description">Medicament description</label>
        <textarea name="description" class="border border-1 border-dark" id="" cols="30" rows="10"></textarea>
       </div>
        
       <div class="number d-flex flex-column gap-1">
        <label for="number">Medicament Price</label>
        <input type="number" name="price" class="border border-1 border-dark w-25">
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary bg-primary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary text-dark fw-bold" >Save changes</button>
      </div>
    </div>
  </div>
</div>






                    </form>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Medicament</th>
                            <th>Price</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($medicaments as $medic)

                        <tr>
                            <td>{{$medic->id}}</td>
                            <td id="nametext">{{$medic->medicament}}</td>
                            <td id="pricetext">{{$medic->price}} DH</td>
                            <td style="display:none" id="descriptiontext">{{$medic->description}}</td>
                            <td class="actions">



                            <form action="{{ route('medic.delete') }}" method="POST">
                                @csrf
                                <!-- For Delete -->
                                <button type="submit" name="delete" value="{{ $medic->id }}">Delete</button>
                            </form>

                            
                            <!-- For Update -->
                            <button type="button" id="updatemedic" data-bs-toggle="modal" data-bs-target="#medicmodify" value="{{ $medic->id }}">Modify</button>
                       




                            </td>
                        </tr>

                        @endforeach
                        
                            

                    </tbody>
                </table>


            </div>
        </main>
</section>


<form class="medicform" action="{{ route('medic.modify') }}" method="POST">
                            @csrf


<!-- Modal modify -->
<div class="modal fade" id="medicmodify" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Medicament panel</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body d-flex flex-column gap-3">

      
                           
        <div class="medic d-flex flex-column gap-1">
        <label for="medicament">Medicament name</label>
        <input type="text" id="medicamentinput" class="border border-1 border-dark" name="medicament">
        <input type="text" style="display:none" name="id_medicament" id="id_medicament">
        </div>

       <div class="desc d-flex flex-column gap-1">
        <label for="description">Medicament description</label>
        <textarea name="description" id="descriptioninput" class="border border-1 border-dark" id="" cols="30" rows="10"></textarea>
       </div>
        
       <div class="number d-flex flex-column gap-1">
        <label for="number">Medicament Price</label>
        <input type="number" id="priceinput" name="price" class="border border-1 border-dark w-25">
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary bg-primary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary text-dark fw-bold" >Save changes</button>
        
      </div>
     
    </div>
  </div>
</div>
</form>

<div class="links">
               {{ $medicaments->links() }}
               </div>
   


               <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
               <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="{{asset ('assets/js/script2.js')}}"></script>
</body>
</html>





