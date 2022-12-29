@extends('layout')

@section('navbar')
    <li class="nav-item">
        <a class="nav-link" href="/Dashboard">
            <i class="fa-solid fa-house-chimney"></i>
            Főoldal
            <span class="sr-only">(current)</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link " href="/ertekeles">
            <i class="fa-solid fa-cross"></i>
            Értékelések
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="/ora">
            <i class="fa-solid fa-clock"></i>
            Órarend
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/hianyzas">
            <i class="fa-solid fa-person-circle-question"></i>
            Késések
        </a>
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

<!-- row -->
<div class="row tm-content-row">
    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
        <br></br>
    </div>
    <div class="col-14 tm-block-col">
            <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                <h2 class="tm-block-title">Órarend megtekintése</h2>
                <table id="myTable" class="table table-bordered table-striped table-sm ">
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
            @foreach($subjects as $subject)

                @if($subject->day == '1'){
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
               @foreach($subjects as $subject)

                @if($subject->day == '2' || $subject->day == '5'){
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
            <?php $array = array("", "", "", "","","","","","","","","","","","","",""); ?>
              @foreach($subjects as $subject)

                @if($subject->day == '3'){
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
            <td>Csütörtök</td>
            <?php $array = array("", "", "", "","","","","","","","","","","","","",""); ?>

                 @foreach($subjects as $subject)

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

            <tr>
            <td>Péntek</td>
            <?php $array = array("", "", "", "","","","","","","","","","","","","",""); ?>
                @foreach($subjects as $subject)

                    @if($subject->day == '5'){
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
            </table>
            </div>
        </div>
    </div>
</div>
  @endsection