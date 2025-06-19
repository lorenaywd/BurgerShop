<script setup lang="ts">
import { ref } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute()
const param = route.params.id || 'default'
console.log('Param from URL:', param)
</script>

<template>
    <div class="menu">
        <h1 >Burger Shop</h1>
        <a href="/famous">Burgers du moment</a>
        <a href="/burgers/boeuf">Burgers au boeuf</a>
        <a href="/burgers/chicken">Burgers au poulet</a>
        <a href="/burgers/fish">Burgers au poisson</a>
        <a href="">Accompagnements</a>
        <a href="drinks">Boissons</a>
        <a href="desserts">Desserts</a>
        <a href="/sales">Promotions</a>
    </div>
</template>

<style>
body{
    background-color: 
}
h1{
    background-color: #EDE8D0;
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
    margin-top: 10%;
    font-family: 'Open Sans', sans-serif;
    /* margin: 20px; */
}
.menu {
    background-color: #EDE8D0;
    padding: 20px;
    height:100%;

}
</style>