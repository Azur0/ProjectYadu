@extends('layouts/app')

@section('content')
<script>
                    window.onload = function() { 
                        var textarea = document.getElementById('desc');
                        var text = document.getElementById('title');
                        var len_d = parseInt(textarea.getAttribute("maxlength"), 10); 
                        var len_t = parseInt(text.getAttribute("maxlength"), 10); 
                        document.getElementById('chars_desc').innerHTML = len_d - textarea.value.length;
                        document.getElementById('chars_title').innerHTML = len_t - text.value.length;
                    }
                    function update_counter_title(text){
                        var len = parseInt(text.getAttribute("maxlength"), 10); 
                        document.getElementById('chars_title').innerHTML = len - text.value.length;
                    }
                    function update_counter_desc(textarea){
                        var len = parseInt(textarea.getAttribute("maxlength"), 10); 
                        document.getElementById('chars_desc').innerHTML = len - textarea.value.length;
                    }
                </script>
<div class="create-event">
    <form action="/events" method="POST">
        {{ csrf_field() }}
        <div class="type">
            <h3>1. Kies het type uitje </h3>
            <div class="types">
                <div id="category_box">

                    <input type="radio" id="1" name="type" value="1" checked>
                    <label for="1" class="category" title="Uitje met gezinnen">
                        <img class="default" src="https://www.yadu.nu/assets/img/icons/categories/users-outline_family.svg">
                        <img class="selected" src="https://www.yadu.nu/assets/img/icons/categories/white/users-outline_family.svg">
                        <span>Uitje met gezinnen</span>
                    </label>
                    <input type="radio" id="2" name="type" value="2">
                    <label for="2" class="category" title="Eten">
                        <img class="default" src="https://www.yadu.nu/assets/img/icons/categories/food-outline_course.svg">
                        <img class="selected" src="https://www.yadu.nu/assets/img/icons/categories/white/food-outline_course.svg">
                        <span>Eten</span>
                    </label>

                    <input type="radio" id="3" name="type" value="3">
                    <label for="3" class="category" title="Borrelen">
                        <img class="default" src="https://www.yadu.nu/assets/img/icons/categories/food-outline_cocktail.svg">
                        <img class="selected" src="https://www.yadu.nu/assets/img/icons/categories/white/food-outline_cocktail.svg">
                        <span>Borrelen</span>
                    </label>
                    
                    <!--
                    <div class="category" title="Koffie">
                        <img class="default" src="https://www.yadu.nu/assets/img/icons/categories/food-outline_coffee.svg">
                        <img class="selected" src="https://www.yadu.nu/assets/img/icons/categories/white/food-outline_coffee.svg">
                        <span>Koffie</span>
                    </div>
                    <div class="category" title="Wandelen">
                        <img class="default" src="https://www.yadu.nu/assets/img/icons/categories/health-outline_steps.svg">
                        <img class="selected" src="https://www.yadu.nu/assets/img/icons/categories/white/health-outline_steps.svg">
                        <span>Wandelen</span>
                    </div>
                    <div class="category" title="Uitje in stad">
                        <img class="default" src="https://www.yadu.nu/assets/img/icons/categories/business-outline_building.svg">
                        <img class="selected" src="https://www.yadu.nu/assets/img/icons/categories/white/business-outline_building.svg">
                        <span>Uitje in stad</span>
                    </div>
                    <div class="category" title="Museum">
                        <img class="default" src="https://www.yadu.nu/assets/img/icons/categories/business-outline_bank.svg ">
                        <img class="selected" src="https://www.yadu.nu/assets/img/icons/categories/white/business-outline_bank.svg ">
                        <span>Museum</span>
                    </div>
                    <div class="category" title="Theater/film">
                        <img class="default" src="https://www.yadu.nu/assets/img/icons/categories/design-outline-2_animation-31.svg">
                        <img class="selected" src="https://www.yadu.nu/assets/img/icons/categories/white/design-outline-2_animation-31.svg">
                        <span>Theater/film</span>
                    </div>
                    <div class="category" title="Evenementen">
                        <img class="default" src="https://www.yadu.nu/assets/img/icons/categories/travel-outline_festival.svg">
                        <img class="selected" src="https://www.yadu.nu/assets/img/icons/categories/white/travel-outline_festival.svg">
                        <span>Evenementen</span>
                    </div>
                    <div class="category" title="Van alles wat">
                        <img class="default" src="https://www.yadu.nu/assets/img/icons/categories/travel-outline_fire.svg">
                        <img class="selected" src="https://www.yadu.nu/assets/img/icons/categories/white/travel-outline_fire.svg">
                        <span>Van alles wat</span>
                    </div>
                    <div class="category" title="Sporten">
                        <img class="default" src="https://www.yadu.nu/assets/img/icons/categories/sport-outline_user-run.svg">
                        <img class="selected" src="https://www.yadu.nu/assets/img/icons/categories/white/sport-outline_user-run.svg">
                        <span>Sporten</span>
                    </div>
                    <div class="category" title="Op wielen">
                        <img class="default" src="https://www.yadu.nu/assets/img/icons/categories/transportation-outline_bike.svg">
                        <img class="selected" src="https://www.yadu.nu/assets/img/icons/categories/white/transportation-outline_bike.svg">
                        <span>Op wielen</span>
                    </div>-->
                </div>

            </div>
        </div>
        <div class="pic">
            <h3>2. Kies een foto voor je event </h3>
        </div>
        <div class="loc">
            <h3>3. Kies de (verzamel)locatie </h3>
        </div>
        <div class="date">
            <h3>4. Kies de datum en tijd</h3>

        </div>
        <div>
            <h3>5. Beschrijf je uitje</h3>
            <div class="description">
                <input type="text" id="title" name="title" placeholder="Titel" oninput="update_counter_title(this)" maxlength="30" required>
                <span id="chars_title"></span> characters remaining
                <textarea id="desc" name="description" placeholder="Omschrijving.." oninput="update_counter_desc(this)" maxlength="150" required></textarea>
                <span id="chars_desc"></span> characters remaining
               
            </div>
        </div>
        <div>
            <!-- Met inspect element krijg ik het nog voor elkaar om meer dan 25 in te stellen, dit moet ik nog veranderen door js scriptje ofzo toe te voegen! -->
            <h3>6. Hoeveel mensen gaan er max mee?</h3>
            <div class="description">
            <input type="number" name="people" min="1" max="25" value="1" required >
            <span class="number_desc">mensen kunnen mee (incl. jezelf)</span>
            </div>
        </div>
        <input class="submit" type="submit" name="verzenden" value="Verzend!!">
    </form>
</div>
@endsection 