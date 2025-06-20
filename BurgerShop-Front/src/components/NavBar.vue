<script setup lang="ts">
// import { ref } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute()
const param = route.params.id || 'default'
console.log('Param from URL:', param)
</script>

<template>
    <h1 >Burger Shop</h1>
    <div class="menu">
        <a href="/menu">Notre carte</a>
        <a href="/famous">Burgers du moment</a>
        <a href="/menu/boeuf">Burgers au boeuf</a>
        <a href="/menu/chicken">Burgers au poulet</a>
        <a href="/menu/fish">Burgers au poisson</a>
        <a href="">Accompagnements</a>
        <a href="drinks">Boissons</a>
        <a href="desserts">Desserts</a>
        <a href="/sales">Promotions</a>
    </div>
</template>

<style>
h1{
    font-family: 'Lilita One', cursive;
    margin-left: 15%;

}
a:hover {
    color: #d5c75c;
    text-decoration: none;
    background-color: transparent;
}
a {
    text-decoration: none;
    color: #000000;
    font-weight: bold;
    font-size: 30px;
    display: block;
    /* margin-top: 10%; */
    font-family: 'Open Sans', sans-serif;
    margin: 20px;
}
.menu {
    padding: 20px;
    height:100%;
}
</style>