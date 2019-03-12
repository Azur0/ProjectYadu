@extends('layouts/app')

@section('banner')
<div class="container-fluid masthead" style="background-image: url(../images/about-header-bg.jpg);">
    <div class="overlay">
        <div class="banner-container">
            <div class="banner-text">
                <div class="banner-title">
                    Over Yadu
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm text-center">
            <h2>
                <b>Lorem ipsum</b>
            </h2>
        </div>
    </div>
    <div class="row about-text">
        <div class="col-sm text-left">
            Nam sit amet tempor sem, sit amet volutpat libero. Proin nulla ante, congue vitae semper eget, vestibulum ac est. Morbi ac est varius, pretium libero non, vulputate leo. Praesent efficitur arcu neque, ut maximus metus facilisis vel. Nulla ut egestas nunc. Vivamus cursus urna non sem maximus pharetra. Cras eget placerat mauris. Quisque arcu libero, rhoncus in massa viverra, sollicitudin imperdiet nisl. Fusce non libero vel risus consequat convallis a nec nisi. Vivamus interdum nisi non est tempor, nec maximus tortor fermentum. Nullam sed odio euismod dolor rhoncus efficitur. Vestibulum iaculis laoreet sollicitudin. Mauris magna libero, tempus vitae mollis quis, fermentum non mauris. In quis tellus massa. Vestibulum hendrerit est ante, in fermentum mauris scelerisque non.
        </div>
        <div class="col-sm text-left">
            Nam sit amet tempor sem, sit amet volutpat libero. Proin nulla ante, congue vitae semper eget, vestibulum ac est. Morbi ac est varius, pretium libero non, vulputate leo. Praesent efficitur arcu neque, ut maximus metus facilisis vel. Nulla ut egestas nunc. Vivamus cursus urna non sem maximus pharetra. Cras eget placerat mauris. Quisque arcu libero, rhoncus in massa viverra, sollicitudin imperdiet nisl. Fusce non libero vel risus consequat convallis a nec nisi. Vivamus interdum nisi non est tempor, nec maximus tortor fermentum. Nullam sed odio euismod dolor rhoncus efficitur. Vestibulum iaculis laoreet sollicitudin. Mauris magna libero, tempus vitae mollis quis, fermentum non mauris. In quis tellus massa. Vestibulum hendrerit est ante, in fermentum mauris scelerisque non.
        </div>
    </div>
    <div class="accordion" id="accordionExample">
      <div class="card">
        <div class="card-header" id="headingOne"  data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <h5 class="mb-0 btn btn-link">
            Waarom?
          </h5>
        </div>

        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
          <div class="card-body">
              Samen vaker leuke dingen doen, geeft energie.<br>
              Yadu is gebouwd om vaker spontaan leuke dingen te kunnen doen, met bekenden en onbekenden in onze eigen omgeving!<br>
              Een gloednieuwe facilitaire online dienst voor het maken van echt contact, bedoelt als online sleutel naar offline contact.
          </div>
        </div>
      </div>
      <div class="card">
          <div class="card-header" id="headingTwo"  data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <h5 class="mb-0 btn btn-link">
              Hoe?
            </h5>
          </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
          <div class="card-body">
              Via de Yadu website & app brengen wij gelijkgestemden in contact met elkaar op basis van gedeelde interesses.<br>
              Deze interesses zijn het uitgangspunt voor activiteiten om Yadu leden echt te ‘verbinden’!<br>
              Zelf kun je eenvoudig een activiteit aanmaken en je buren, vrienden of je collega’s uitnodigen en meedoen aan het initiatief van anderen.
          </div>
        </div>
      </div>
      <div class="card">
          <div class="card-header" id="headingThree"  data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
            <h5 class="mb-0 btn btn-link">
              Waarom NU?
            </h5>
          </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
          <div class="card-body">
              De groeiende behoefte van ieder mens aan zingeving en de toenemende behoefte aan echt contact is het fundament waarop Yadu het positieve verschil maakt.
          </div>
        </div>
      </div>
      <div class="card">
          <div class="card-header" id="headingFour"  data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
            <h5 class="mb-0 btn btn-link">
              Hoe werkt Yadu?
            </h5>
          </div>
        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
          <div class="card-body">
            Door leuke en leerzame “uitjes” te faciliteren op ons platform brengen wij gelijkgestemden in contact met elkaar, op basis van gedeelde interesses. In onze eigen omgeving en ook buiten je huidige netwerk om.
          </div>
        </div>
      </div>
      <div class="card">
          <div class="card-header" id="headingFive"  data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
            <h5 class="mb-0 btn btn-link">
              Wat denken wij te brengen?
            </h5>
          </div>
        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
          <div class="card-body">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
          </div>
        </div>
      </div>
      <div class="card">
          <div class="card-header" id="headingSix"  data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
            <h5 class="mb-0 btn btn-link">
              Voor wie?
            </h5>
          </div>
        <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
          <div class="card-body">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
          </div>
        </div>
      </div>
      <div class="card">
          <div class="card-header" id="headingSeven"  data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
            <h5 class="mb-0 btn btn-link">
              Wat brengt Yadu?
            </h5>
          </div>
        <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
          <div class="card-body">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
          </div>
        </div>
      </div>
      <div class="card">
          <div class="card-header" id="headingEight"  data-toggle="collapse" data-target="#collapseEight" aria-expanded="true" aria-controls="collapseEight">
            <h5 class="mb-0 btn btn-link">
              Wat denken wij te brengen?
            </h5>
          </div>
        <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordionExample">
          <div class="card-body">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
          </div>
        </div>
      </div>
      <div class="card">
          <div class="card-header" id="headingNine"  data-toggle="collapse" data-target="#collapseNine" aria-expanded="true" aria-controls="collapseNine">
            <h5 class="mb-0 btn btn-link">
              De vier Yadu pijlers
            </h5>
          </div>
        <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordionExample">
          <div class="card-body">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
          </div>
        </div>
      </div>
      <div class="card">
          <div class="card-header" id="headingTen"  data-toggle="collapse" data-target="#collapseTen" aria-expanded="true" aria-controls="collapseTen">
            <h5 class="mb-0 btn btn-link">
              Yadu staat in de startblokken als Social Enterprise
            </h5>
          </div>
        <div id="collapseTen" class="collapse" aria-labelledby="headingTen" data-parent="#accordionExample">
          <div class="card-body">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
          </div>
        </div>
      </div>
      <div class="card">
          <div class="card-header" id="headingEleven"  data-toggle="collapse" data-target="#collapseEleven" aria-expanded="true" aria-controls="collapseEleven">
            <h5 class="mb-0 btn btn-link">
              Om de dienst duurzaam en enigszins betaalbaar te houden zoeken wij organisaties om samen onze dienst voor een groter publiek toegankelijk te maken.
            </h5>
          </div>
        <div id="collapseEleven" class="collapse" aria-labelledby="headingEleven" data-parent="#accordionExample">
          <div class="card-body">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
          </div>
        </div>
      </div>
    </div>
@endsection
