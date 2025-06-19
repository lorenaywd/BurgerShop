<script setup lang="ts">
import { ref } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute()
const param = route.params.id || 'default'
console.log('Param from URL:', param)
</script>

<template>
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
a:hover {
    color: #d5c75c;
    text-decoration: underline;
    background-color: transparent;
}
a {
    text-decoration: none;
    color: #000000;
    font-weight: bold;
    display: block;
    margin: 20px;
}
.menu {
    background-color: #EDE8D0;
    padding: 20px;
    margin: auto;
}
</style>