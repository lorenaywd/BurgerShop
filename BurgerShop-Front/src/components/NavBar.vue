<script setup lang="ts">
// import { ref } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute()
const param = route.params.id || 'default'
console.log('Param from URL:', param)
</script>

<template>
    <div class="menu">
        <a href="/menu">Notre carte</a>
        <a href="/menu/boeuf">Burgers au boeuf</a>
        <a href="/menu/chicken">Burgers au poulet</a>
        <a href="/menu/fish">Burgers au poisson</a>
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
    font-size: 25px;
    display: block;
    font-family: 'Open Sans', sans-serif;
    margin-top: 20%;
    margin-left: 2%;
}
.menu {
    margin-top:1% ;
    padding: 20px;
    height:90%;
    border-right: 1px solid;
}
</style>