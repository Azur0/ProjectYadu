@extends('layouts/app')

@section('content')
<div class="create-event">

    <form action="/events" method="POST">
        {{ csrf_field() }}
        <div class="type">
            <h3>1. Kies het type uitje </h3>
            <div class="types">
                <div id="category_box">
                    <div class="category" title="Uitje met gezinnen" onclick="category_change_state(this, true)" data-category-id="1">
                        <img class="default" src="https://www.yadu.nu/assets/img/icons/categories/users-outline_family.svg">
                        <img class="selected" src="https://www.yadu.nu/assets/img/icons/categories/white/users-outline_family.svg">
                        <span>Uitje met gezinnen</span>
                    </div>
                    <div class="category" title="Eten" onclick="category_change_state(this, true)" data-category-id="2">
                        <img class="default" src="https://www.yadu.nu/assets/img/icons/categories/food-outline_course.svg">
                        <img class="selected" src="https://www.yadu.nu/assets/img/icons/categories/white/food-outline_course.svg">
                        <span>Eten</span>
                    </div>
                    <div class="category" title="Borrelen" onclick="category_change_state(this, true)" data-category-id="3">
                        <img class="default" src="https://www.yadu.nu/assets/img/icons/categories/food-outline_cocktail.svg">
                        <img class="selected" src="https://www.yadu.nu/assets/img/icons/categories/white/food-outline_cocktail.svg">
                        <span>Borrelen</span>
                    </div>
                    <div class="category" title="Koffie" onclick="category_change_state(this, true)" data-category-id="4">
                        <img class="default" src="https://www.yadu.nu/assets/img/icons/categories/food-outline_coffee.svg">
                        <img class="selected" src="https://www.yadu.nu/assets/img/icons/categories/white/food-outline_coffee.svg">
                        <span>Koffie</span>
                    </div>
                    <div class="category" title="Wandelen" onclick="category_change_state(this, true)" data-category-id="5">
                        <img class="default" src="https://www.yadu.nu/assets/img/icons/categories/health-outline_steps.svg">
                        <img class="selected" src="https://www.yadu.nu/assets/img/icons/categories/white/health-outline_steps.svg">
                        <span>Wandelen</span>
                    </div>
                    <div class="category" title="Uitje in stad" onclick="category_change_state(this, true)" data-category-id="6">
                        <img class="default" src="https://www.yadu.nu/assets/img/icons/categories/business-outline_building.svg">
                        <img class="selected" src="https://www.yadu.nu/assets/img/icons/categories/white/business-outline_building.svg">
                        <span>Uitje in stad</span>
                    </div>
                    <div class="category" title="Museum" onclick="category_change_state(this, true)" data-category-id="7">
                        <img class="default" src="https://www.yadu.nu/assets/img/icons/categories/business-outline_bank.svg ">
                        <img class="selected" src="https://www.yadu.nu/assets/img/icons/categories/white/business-outline_bank.svg ">
                        <span>Museum</span>
                    </div>
                    <div class="category" title="Theater/film" onclick="category_change_state(this, true)" data-category-id="8">
                        <img class="default" src="https://www.yadu.nu/assets/img/icons/categories/design-outline-2_animation-31.svg">
                        <img class="selected" src="https://www.yadu.nu/assets/img/icons/categories/white/design-outline-2_animation-31.svg">
                        <span>Theater/film</span>
                    </div>
                    <div class="category" title="Evenementen" onclick="category_change_state(this, true)" data-category-id="9">
                        <img class="default" src="https://www.yadu.nu/assets/img/icons/categories/travel-outline_festival.svg">
                        <img class="selected" src="https://www.yadu.nu/assets/img/icons/categories/white/travel-outline_festival.svg">
                        <span>Evenementen</span>
                    </div>
                    <div class="category" title="Van alles wat" onclick="category_change_state(this, true)" data-category-id="10">
                        <img class="default" src="https://www.yadu.nu/assets/img/icons/categories/travel-outline_fire.svg">
                        <img class="selected" src="https://www.yadu.nu/assets/img/icons/categories/white/travel-outline_fire.svg">
                        <span>Van alles wat</span>
                    </div>
                    <div class="category" title="Sporten" onclick="category_change_state(this, true)" data-category-id="11">
                        <img class="default" src="https://www.yadu.nu/assets/img/icons/categories/sport-outline_user-run.svg">
                        <img class="selected" src="https://www.yadu.nu/assets/img/icons/categories/white/sport-outline_user-run.svg">
                        <span>Sporten</span>
                    </div>
                    <div class="category" title="Op wielen" onclick="category_change_state(this, true)" data-category-id="12">
                        <img class="default" src="https://www.yadu.nu/assets/img/icons/categories/transportation-outline_bike.svg">
                        <img class="selected" src="https://www.yadu.nu/assets/img/icons/categories/white/transportation-outline_bike.svg">
                        <span>Op wielen</span>
                    </div>
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
        </div>
        <div>
            <h3>6. Hoeveel mensen gaan er max mee?</h3>
        </div>
        <input type="submit" name="verzenden" value="Verzend!!">
    </form>
</div>
@endsection 