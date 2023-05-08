<template>
    <div class="loader"></div>
</template>
<script>
    export default {}
</script>
<style>
    .loader{
        width: 1rem;
        height: 1rem;
        background-color: transparent;
        border-radius: 5rem;
        border-left: 0.3rem solid #fff;
        position: relative;
        transform: rotate(0deg);
        animation: spinning 1s linear infinite;
    }

    @keyframes spinning {
        0% {
            transform: rotate(0deg);
        }
        0% {
            transform: rotate(-360deg);
        }
    }

</style>