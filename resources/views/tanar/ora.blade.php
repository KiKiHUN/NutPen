
@extends('layout')

@section('navbar')
<li class="nav-item">
    <a class="nav-link" href="/Dashboard">
        <i class="fa-solid fa-house-chimney"></i>
        Főoldal
        <span class="sr-only">(current)</span>
    </a>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fa-solid fa-circle-check"></i>
        <span>
            Értékelés <i class="fas fa-angle-down"></i>
        </span>
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="/ertekeles">Listázás</a>
        <a class="dropdown-item" href="/ertekeles/tantargyvalaszt">Új</a>
    </div>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fa-solid fa-clock"></i>
        <span>
            Órák <i class="fas fa-angle-down"></i>
        </span>
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="/ora">Órarend</a>
        <a class="dropdown-item" href="/hianyzas">Hiányzás</a>
    </div>
</li>

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-cog"></i>
        <span>
            Beállítások <i class="fas fa-angle-down"></i>
        </span>
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="/fiok">Fiók</a>
        <a class="dropdown-item" href="/logout">Kilépés</a>
    </div>
</li>
@endsection

@section('content')

<div class="row tm-content-row">
    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
        <br></br>
    </div>
    <div class="col-14 tm-block-col">
            <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                <h2 class="tm-block-title">Órarend megtekintése</h2>
                <table id='dtBasicExample' class="table table-bordered table-striped table-sm ">
                    <thead>
                        <tr>  
                        <th></th>
                        <th>07:00</th>
                        <th>08:00</th>
                        <th>09:00</th>
                        <th>10:00</th>
                        <th>11:00</th>
                        <th>12:00</th>
                        <th>13:00</th>
                        <th>14:00</th>
                        <th>15:00</th>
                        <th>16:00</th>
                        </tr>
                    </thead>
                <tbody id="myTable">

                <tr>
                <td>Hétfő</td>
            <?php $array = array("", "", "", "","","","","","","","","","","","","",""); ?>
            @foreach($orarend as $subject)

                @if($subject->day == '5'){
                        <?php $array[$subject->start_time] = $subject->nev; ?>
                        <?php $array[$subject->end_time] =  $subject->nev; ?>
                        @if($subject -> end_time - $subject -> start_time >= 2){
                            <?php $gap_class = $subject -> end_time - $subject -> start_time ?>
                            <?php $array[$subject->start_time + $gap_class -1] = $subject->nev; ?>
                        }
                        @endif
                } 
                @endif
                
            @endforeach
            <?php $i = 0; ?>
            @foreach($array as $item)
                @if($i >= 7){
                    <td>{{$item}}</td>
                }
                @else{
                    <?php $i++; ?>
                }
                @endif
            @endforeach
            </tr>

            <tr>
            <td>Kedd</td>
            <?php $array = array("", "", "", "","","","","","","","","","","","","",""); ?>
               @foreach($orarend as $subject)

                @if($subject->day == '2'){
                        <?php $array[$subject->start_time] = $subject->nev; ?>
                        <?php $array[$subject->end_time] = $subject->nev; ?>
                        @if($subject -> end_time - $subject -> start_time >= 2){
                            <?php $gap_class = $subject -> end_time - $subject -> start_time ?>
                            <?php $array[$subject->start_time + $gap_class -1] = $subject->nev; ?>
                        }
                        @endif
                } 
                @endif
                
            @endforeach
            <?php $i = 0; ?>
            @foreach($array as $item)
                @if($i >= 7){
                    <td>{{$item}}</td>
                }
                @else{
                    <?php $i++; ?>
                }
                @endif
            @endforeach
            </tr>

            <tr>
            <td>Szerda</td>
            <td> <?php echo " " ?> </td>
            <td> <?php echo " " ?> </td>
            <td> <?php echo " " ?> </td>
            <td> <?php echo " " ?> </td>
            <td> <?php echo " " ?> </td>
            <td> <?php echo " " ?> </td>
            <td> <?php echo " " ?> </td>
            <td> <?php echo " " ?> </td>
            <td> <?php echo " " ?> </td>
            <td> <?php echo " " ?> </td>
            </tr>

            <tr>
            <td>Csütörtök</td>
            <?php $array = array("", "", "", "","","","","","","","","","","","","",""); ?>

                 @foreach($orarend as $subject)

                @if($subject->day == '1'){
                        <?php $array[$subject->start_time] = $subject->nev; ?>
                        <?php $array[$subject->end_time] = $subject->nev; ?>
                        @if($subject -> end_time - $subject -> start_time >= 2){
                            <?php $gap_class = $subject -> end_time - $subject -> start_time ?>
                            <?php $array[$subject->start_time + $gap_class -1] = $subject->nev; ?>
                        }
                        @endif
                } 
                @endif
                
            @endforeach
            <?php $i = 0; ?>
            @foreach($array as $item)
                @if($i >= 7){
                    <td>{{$item}}</td>
                }
                @else{
                    <?php $i++; ?>
                }
                @endif
            @endforeach
            </tr>

            <tr>
            <td>Péntek</td>
            <?php $array = array("", "", "", "","","","","","","","","","","","","",""); ?>
                @foreach($orarend as $subject)

                    @if($subject->day == '4'){
                        <?php $array[$subject->start_time] = $subject->nev; ?>
                        <?php $array[$subject->end_time] = $subject->nev; ?>
                        @if($subject -> end_time - $subject -> start_time >= 2){
                            <?php $gap_class = $subject -> end_time - $subject -> start_time ?>
                            <?php $array[$subject->start_time + $gap_class -1] = $subject->nev; ?>
                        }
                        @endif
                    } 
                    @endif
                
                @endforeach
            <?php $i = 0; ?>
                @foreach($array as $item)
                    @if($i >= 7){
                        <td>{{$item}}</td>
                    }
                    @else{
                        <?php $i++; ?>
                    }
                    @endif
                @endforeach
            </tr>

                </tbody>
                    </tbody>
            </div>
        </div>
    </div>
</div>
  @endsection
