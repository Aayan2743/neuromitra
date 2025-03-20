<nav class="nxl-navigation">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="#" class="b-brand">
                <!-- ========   change your logo hear   ============ -->
                <img src="https://neuromitra.com/wp-content/uploads/2024/07/hy.jpg" alt="" width="140px" height="30px" class="logo logo-lg" />
                <img src="{{asset('icon/appicon.png')}}" alt="" class="logo logo-sm" />
            </a>
        </div>
        <div class="navbar-content">
            <ul class="nxl-navbar">
                <li class="nxl-item nxl-caption">
                    <label>Navigation</label>
                </li>

                <li class="nxl-item nxl-hasmenu">
                    <a href="{{route('dashboard')}}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-airplay"></i></span>
                        <span class="nxl-mtext">Dashboards</span><span class="nxl-arrow"></span>
                    </a>
                    
                </li>


                @if(Auth()->user()->user_type==2)
                <li class="nxl-item nxl-hasmenu">
                    <a href="{{route('add.therapist')}}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-users"></i></i></span>
                        <span class="nxl-mtext">Add Therapist</span><span class="nxl-arrow"></span>
                    </a>
                    
                </li>
              

                <li class="nxl-item nxl-hasmenu">
                    <a href="{{route('add.addpatient')}}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-users"></i></i></span>
                        <span class="nxl-mtext">Add Clients </span><span class="nxl-arrow"></span>
                    </a>
                    
                </li>

                <li class="nxl-item nxl-hasmenu">
                    <a href="{{route('create_assessment.index')}}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-users"></i></i></span>
                        <span class="nxl-mtext">Assesement For Kids </span><span class="nxl-arrow"></span>
                    </a>
                    
                </li>

                <li class="nxl-item nxl-hasmenu">
                    <a href="{{route('kids.result')}}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-users"></i></i></span>
                        <span class="nxl-mtext">Assesement Results For Kids </span><span class="nxl-arrow"></span>
                    </a>
                    
                </li>

                <li class="nxl-item nxl-hasmenu">
                    <a href="{{route('create_assesement_for_adults.index')}}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-users"></i></i></span>
                        <span class="nxl-mtext">Assesement For Adults </span><span class="nxl-arrow"></span>
                    </a>
                    
                </li>

               
                <li class="nxl-item nxl-hasmenu">
                    <a href="{{route('adults.result')}}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-users"></i></i></span>
                        <span class="nxl-mtext">Assesement Results For Adults </span><span class="nxl-arrow"></span>
                    </a>
                    
                </li> 

             


                @elseif(Auth()->user()->user_type==3)
                <!--     <li class="nxl-item nxl-hasmenu">-->
                <!--    <a href="{{route('getmypatients')}}" class="nxl-link">-->
                <!--        <span class="nxl-micon"><i class="feather-users"></i></i></span>-->
                <!--        <span class="nxl-mtext">My Clients</span><span class="nxl-arrow"></span>-->
                <!--    </a>-->
                    
                <!--</li>-->

                {{-- <li class="nxl-item nxl-hasmenu">
                    <a href="{{route('searchclients')}}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-users"></i></i></span>
                        <span class="nxl-mtext">Search Clients</span><span class="nxl-arrow"></span>
                    </a>
                    
                </li> --}}

                @endif
                
                  
           
            </ul>
           
        </div>
    </div>
</nav>